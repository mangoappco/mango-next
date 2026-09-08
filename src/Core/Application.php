<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Indica que esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Representa el punto de coordinación principal de la aplicación.
final class Application
{
    // Guarda el servicio que administra la conexión con la base de datos.
    private Database $database;

    // Recibe la ruta raíz para que Config pueda localizar el archivo .env.
    public function __construct(string $rootPath)
    {
        // Lee la configuración del entorno desde la raíz del proyecto.
        $config = new Config($rootPath);

        // Construye Database entregándole la configuración que necesita.
        $this->database = new Database($config);
    }

    // Ejecuta la aplicación.
    public function run(): void
    {
        // Solicita la conexión; aquí se abre realmente la conexión con MySQL.
        $connection = $this->database->connection();

        // Ejecuta una consulta mínima para comprobar que la conexión responde.
        $result = $connection->query('SELECT 1')->fetchColumn();

        // Muestra el resultado de la prueba temporal.
        echo 'Conexión exitosa con mango_next. Resultado: ' . $result;
    }
}