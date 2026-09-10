<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de modelos de ManGo!.
namespace Mango\Models;

// PDO permite ejecutar consultas preparadas contra MySQL.
use PDO;

// Representa los usuarios almacenados en la tabla usuarios.
final class UserModel
{
    // Recibe la conexión desde fuera para mantener la clase fácil de probar.
    public function __construct(private PDO $connection)
    {
    }

    // Busca un usuario por su correo electrónico.
    public function findByEmail(string $email): ?array
    {
        // La consulta utiliza un parámetro nombrado para evitar concatenar datos del formulario.
        $statement = $this->connection->prepare(
            'SELECT id, correo, contrasena, nombres, apellidos, tipo, activo
             FROM usuarios
             WHERE correo = :correo
             LIMIT 1'
        );

        // Asocia el correo recibido con el parámetro de la consulta.
        $statement->execute(['correo' => $email]);

        // Obtiene una fila o false si no existe un usuario con ese correo.
        $user = $statement->fetch();

        // Convierte false en null para que el método tenga un resultado consistente.
        return $user === false ? null : $user;
    }

    // Obtiene todos los usuarios para mostrarlos en la lista del CRUD.
    public function findAll(): array
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
    public function create(
        string $email,
        string $password,
        string $firstName,
        string $lastName,
        string $type = 'usuario'
    ): int {
        // Convierte la contraseña original en un hash seguro antes de guardarla.
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // La consulta preparada separa los datos del código SQL.
        $statement = $this->connection->prepare(
            'INSERT INTO usuarios
                (correo, contrasena, nombres, apellidos, tipo)
             VALUES
                (:correo, :contrasena, :nombres, :apellidos, :tipo)'
        );

        // Ejecuta la inserción con los valores recibidos como parámetros.
        $statement->execute([
            'correo' => $email,
            'contrasena' => $passwordHash,
            'nombres' => $firstName,
            'apellidos' => $lastName,
            'tipo' => $type,
        ]);

        // Devuelve el identificador asignado por AUTO_INCREMENT.
        return (int) $this->connection->lastInsertId();
    }
}
