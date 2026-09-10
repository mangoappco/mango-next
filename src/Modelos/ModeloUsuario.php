<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de modelos de ManGo!.
namespace Mango\Modelos;

// PDO permite ejecutar consultas preparadas contra MySQL.
use PDO;

// Permite registrar errores de auditoría sin interrumpir el flujo principal.
use PDOException;

// Representa los usuarios almacenados en la tabla usuarios.
final class ModeloUsuario
{
    // Recibe la conexión desde fuera para mantener la clase fácil de probar.
    public function __construct(private PDO $connection)
    {
    }

    // Registra una acción de seguridad sin guardar datos secretos.
    public function registrarActividad(?int $usuarioId, ?string $correo, string $accion): void
    {
        // Obtiene datos técnicos de la petición actual.
        $direccionIp = $_SERVER['REMOTE_ADDR'] ?? null;
        $agenteUsuario = $_SERVER['HTTP_USER_AGENT'] ?? null;

        try {
            // Guarda la actividad mediante una consulta preparada.
            $statement = $this->connection->prepare(
                'INSERT INTO registro_actividad
                    (usuario_id, correo, accion, direccion_ip, agente_usuario)
                 VALUES
                    (:usuario_id, :correo, :accion, :direccion_ip, :agente_usuario)'
            );
            $statement->execute([
                'usuario_id' => $usuarioId,
                'correo' => $correo,
                'accion' => $accion,
                'direccion_ip' => $direccionIp,
                'agente_usuario' => $agenteUsuario,
            ]);
        } catch (PDOException $exception) {
            // Un fallo de auditoría no debe impedir el login o la recuperación.
            error_log('No se pudo registrar actividad: ' . $exception->getMessage());
        }
    }

    // Busca un usuario por su correo electrónico.
    public function buscarPorCorreo(string $correo): ?array
    {
        // La consulta utiliza un parámetro nombrado para evitar concatenar datos del formulario.
        $statement = $this->connection->prepare(
            'SELECT id, correo, contrasena, nombres, apellidos, tipo, activo
             FROM usuarios
             WHERE correo = :correo
             LIMIT 1'
        );

        // Asocia el correo recibido con el parámetro de la consulta.
        $statement->execute(['correo' => $correo]);

        // Obtiene una fila o false si no existe un usuario con ese correo.
        $usuario = $statement->fetch();

        // Convierte false en null para que el método tenga un resultado consistente.
        return $usuario === false ? null : $usuario;
    }

    // Busca un usuario por su identificador para cargar el formulario de edición.
    public function buscarPorId(int $id): ?array
    {
        // Prepara una consulta que filtra por el identificador recibido.
        $statement = $this->connection->prepare(
            'SELECT id, correo, nombres, apellidos, tipo, activo
             FROM usuarios
             WHERE id = :id
             LIMIT 1'
        );

        // Ejecuta la consulta usando un parámetro preparado.
        $statement->execute(['id' => $id]);

        // Obtiene el usuario o false si no existe.
        $usuario = $statement->fetch();

        // Devuelve null cuando no se encontró el identificador.
        return $usuario === false ? null : $usuario;
    }

    // Obtiene únicamente el hash necesario para verificar la contraseña actual.
    public function buscarHashContrasenaPorId(int $id): ?string
    {
        // Prepara una consulta que no expone el hash completo a la vista.
        $statement = $this->connection->prepare(
            'SELECT contrasena
             FROM usuarios
             WHERE id = :id
             LIMIT 1'
        );

        // Ejecuta la consulta con el identificador de la sesión.
        $statement->execute(['id' => $id]);

        // Obtiene el hash o false si el usuario ya no existe.
        $hash = $statement->fetchColumn();

        // Devuelve null cuando no se encontró el usuario.
        return $hash === false ? null : (string) $hash;
    }

    // Crea un token temporal y devuelve el valor que se enviaría por correo.
    public function crearTokenRecuperacion(int $usuarioId, string $tokenHash, string $expiraEn): void
    {
        // Invalida tokens anteriores del mismo usuario.
        $invalidar = $this->connection->prepare(
            'UPDATE recuperacion_contrasenas
             SET usado_en = CURRENT_TIMESTAMP
             WHERE usuario_id = :usuario_id
               AND usado_en IS NULL'
        );
        $invalidar->execute(['usuario_id' => $usuarioId]);

        // Guarda únicamente el hash del token, nunca el token original.
        $statement = $this->connection->prepare(
            'INSERT INTO recuperacion_contrasenas
                (usuario_id, token_hash, expira_en)
             VALUES
                (:usuario_id, :token_hash, :expira_en)'
        );
        $statement->execute([
            'usuario_id' => $usuarioId,
            'token_hash' => $tokenHash,
            'expira_en' => $expiraEn,
        ]);
    }

    // Elimina tokens vencidos o que ya fueron utilizados.
    public function limpiarTokensRecuperacion(): void
    {
        // Los tokens usados y expirados ya no pueden tener ninguna utilidad.
        $statement = $this->connection->prepare(
            'DELETE FROM recuperacion_contrasenas
             WHERE usado_en IS NOT NULL
                OR expira_en <= CURRENT_TIMESTAMP'
        );

        // Ejecuta la limpieza sin recibir datos del formulario.
        $statement->execute();
    }

    // Busca un token vigente y devuelve el usuario asociado.
    public function buscarRecuperacionValida(string $tokenHash): ?array
    {
        // Solo acepta tokens no usados y que todavía no hayan expirado.
        $statement = $this->connection->prepare(
            'SELECT r.id AS recuperacion_id, r.usuario_id, u.correo
             FROM recuperacion_contrasenas AS r
             INNER JOIN usuarios AS u ON u.id = r.usuario_id
             WHERE r.token_hash = :token_hash
               AND r.usado_en IS NULL
               AND r.expira_en > CURRENT_TIMESTAMP
               AND u.activo = 1
             LIMIT 1'
        );
        $statement->execute(['token_hash' => $tokenHash]);
        $recuperacion = $statement->fetch();

        return $recuperacion === false ? null : $recuperacion;
    }

    // Marca un token como usado para impedir reutilizarlo.
    public function marcarRecuperacionUsada(int $recuperacionId): void
    {
        // Actualiza el momento exacto en que el token se consumió.
        $statement = $this->connection->prepare(
            'UPDATE recuperacion_contrasenas
             SET usado_en = CURRENT_TIMESTAMP
             WHERE id = :id'
        );
        $statement->execute(['id' => $recuperacionId]);
    }

    // Comprueba si un correo ya pertenece a otro usuario.
    public function correoExiste(string $correo, ?int $idExcluir = null): bool
    {
        // Prepara la consulta base para buscar coincidencias por correo.
        $sql = 'SELECT COUNT(*) FROM usuarios WHERE correo = :correo';

        // Guarda el correo que se utilizará como parámetro preparado.
        $parametros = ['correo' => $correo];

        // En edición excluye el usuario actual para permitir conservar su correo.
        if ($idExcluir !== null) {
            $sql .= ' AND id <> :id_excluir';
            $parametros['id_excluir'] = $idExcluir;
        }

        // Ejecuta la consulta de existencia.
        $statement = $this->connection->prepare($sql);
        $statement->execute($parametros);

        // Devuelve true cuando existe al menos una coincidencia.
        return (int) $statement->fetchColumn() > 0;
    }

    // Obtiene todos los usuarios o los que coinciden con una búsqueda.
    public function buscarTodos(string $busqueda = ''): array
    {
        // Define la consulta con las columnas necesarias para la tabla.
        $sql = 'SELECT id, correo, nombres, apellidos, tipo, activo, creado_en, actualizado_en
                FROM usuarios';

        // Prepara los valores que se enviarán a la consulta.
        $parametros = [];

        // Agrega filtros cuando el usuario escribió un texto de búsqueda.
        if ($busqueda !== '') {
            $sql .= ' WHERE correo LIKE :busqueda_correo
                      OR nombres LIKE :busqueda_nombres
                      OR apellidos LIKE :busqueda_apellidos
                      OR tipo LIKE :busqueda_tipo';

            // Los comodines permiten encontrar el texto en cualquier posición.
            $valorBusqueda = '%' . $busqueda . '%';

            // Cada marcador nombrado recibe su propio valor para funcionar con PDO real.
            $parametros['busqueda_correo'] = $valorBusqueda;
            $parametros['busqueda_nombres'] = $valorBusqueda;
            $parametros['busqueda_apellidos'] = $valorBusqueda;
            $parametros['busqueda_tipo'] = $valorBusqueda;
        }

        // Ordena los resultados más recientes primero.
        $sql .= ' ORDER BY id DESC';

        // Prepara y ejecuta la consulta con sus parámetros.
        $statement = $this->connection->prepare($sql);
        $statement->execute($parametros);

        // Devuelve todas las filas como un arreglo de usuarios.
        return $statement->fetchAll();
    }

    // Crea un usuario guardando la contraseña como un hash irreversible.
    public function crear(
        string $correo,
        string $contrasena,
        string $nombres,
        string $apellidos,
        string $tipo = 'usuario'
    ): int {
        // Convierte la contraseña original en un hash seguro antes de guardarla.
        $passwordHash = password_hash($contrasena, PASSWORD_DEFAULT);

        // La consulta preparada separa los datos del código SQL.
        $statement = $this->connection->prepare(
            'INSERT INTO usuarios
                (correo, contrasena, nombres, apellidos, tipo)
             VALUES
                (:correo, :contrasena, :nombres, :apellidos, :tipo)'
        );

        // Ejecuta la inserción con los valores recibidos como parámetros.
        $statement->execute([
            'correo' => $correo,
            'contrasena' => $passwordHash,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'tipo' => $tipo,
        ]);

        // Devuelve el identificador asignado por AUTO_INCREMENT.
        return (int) $this->connection->lastInsertId();
    }

    // Actualiza los datos de un usuario sin cambiar su contraseña por accidente.
    public function actualizar(
        int $id,
        string $correo,
        string $nombres,
        string $apellidos,
        string $tipo,
        string $contrasena = ''
    ): void {
        // Define los datos que siempre se actualizan.
        $datos = [
            'id' => $id,
            'correo' => $correo,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'tipo' => $tipo,
        ];

        // Si se recibió una contraseña, la actualiza usando un hash seguro.
        if ($contrasena !== '') {
            $datos['contrasena'] = password_hash($contrasena, PASSWORD_DEFAULT);

            $statement = $this->connection->prepare(
                'UPDATE usuarios
                 SET correo = :correo,
                     contrasena = :contrasena,
                     nombres = :nombres,
                     apellidos = :apellidos,
                     tipo = :tipo
                 WHERE id = :id'
            );
        } else {
            // Si la contraseña está vacía, conserva el hash existente.
            $statement = $this->connection->prepare(
                'UPDATE usuarios
                 SET correo = :correo,
                     nombres = :nombres,
                     apellidos = :apellidos,
                     tipo = :tipo
                 WHERE id = :id'
            );
        }

        // Ejecuta la actualización con los datos separados del SQL.
        $statement->execute($datos);
    }

    // Guarda un nuevo hash de contraseña para un usuario concreto.
    public function cambiarContrasena(int $id, string $contrasena): void
    {
        // Convierte la nueva contraseña en un hash irreversible.
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Prepara la actualización para separar datos y SQL.
        $statement = $this->connection->prepare(
            'UPDATE usuarios
             SET contrasena = :contrasena
             WHERE id = :id'
        );

        // Guarda el hash asociado al usuario autenticado.
        $statement->execute([
            'id' => $id,
            'contrasena' => $hash,
        ]);
    }

    // Desactiva un usuario sin eliminarlo de la base de datos.
    public function desactivar(int $id): void
    {
        // Prepara una consulta que conserva el registro y cambia su estado.
        $statement = $this->connection->prepare(
            'UPDATE usuarios
             SET activo = 0
             WHERE id = :id'
        );

        // Ejecuta la desactivación con un parámetro preparado.
        $statement->execute(['id' => $id]);
    }

    // Reactiva un usuario conservando todos sus datos existentes.
    public function reactivar(int $id): void
    {
        // Prepara una consulta que cambia únicamente el estado del usuario.
        $statement = $this->connection->prepare(
            'UPDATE usuarios
             SET activo = 1
             WHERE id = :id'
        );

        // Ejecuta la reactivación con un parámetro preparado.
        $statement->execute(['id' => $id]);
    }
}
