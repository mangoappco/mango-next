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
}
