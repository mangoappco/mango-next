<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Indica que esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Importa el controlador que coordina la consulta de usuarios.
use Mango\Controllers\UserController;

// Importa el modelo que trabaja con la tabla usuarios.
use Mango\Models\UserModel;

// Representa el punto de coordinación principal de la aplicación.
final class Application
{
    // Ejecuta la aplicación.
    public function run(): void
    {
        // Obtiene la ruta raíz para que Config pueda localizar el archivo .env.
        $rootPath = dirname(__DIR__, 2);

        // Carga la configuración del proyecto.
        $config = new Config($rootPath);

        // Crea la conexión reutilizable con la base de datos.
        $database = new Database($config);

        // Crea el modelo y le entrega la conexión que necesita.
        $userModel = new UserModel($database->connection());

        // Crea el controlador y le entrega el modelo correspondiente.
        $userController = new UserController($userModel);

        // Ejecuta la acción que obtiene la lista de usuarios.
        $users = $userController->index();

        // Carga la vista y le proporciona los usuarios obtenidos.
        require $rootPath . '/src/Views/users/index.php';
    }
}