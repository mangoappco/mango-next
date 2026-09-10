<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de modelos de ManGo!.
namespace Mango\Modelos;

// PDO permite ejecutar consultas preparadas contra MySQL.
use PDO;

// Representa los usuarios almacenados en la tabla usuarios.
final class ModeloUsuario
{
    // Recibe la conexión desde fuera para mantener la clase fácil de probar.
    public function __construct(private PDO $connection)
    {
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

    // Obtiene todos los usuarios para mostrarlos en la lista del CRUD.
    public function buscarTodos(): array
    {
        // Selecciona únicamente los datos necesarios para la tabla de usuarios.
        $statement = $this->connection->query(
            'SELECT id, correo, nombres, apellidos, tipo, activo, creado_en, actualizado_en
             FROM usuarios
             ORDER BY id DESC'
        );

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

    // Elimina un usuario usando su identificador.
    public function eliminar(int $id): void
    {
        // Prepara una consulta que solo puede eliminar el identificador recibido.
        $statement = $this->connection->prepare(
            'DELETE FROM usuarios
             WHERE id = :id'
        );

        // Ejecuta la eliminación con un parámetro preparado.
        $statement->execute(['id' => $id]);
    }
}
