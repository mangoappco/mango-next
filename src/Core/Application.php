<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Indica que esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Importa el controlador que coordina la consulta de usuarios.
use Mango\Controladores\ControladorUsuarios;

// Importa el modelo que trabaja con la tabla usuarios.
use Mango\Modelos\ModeloUsuario;

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
        $modeloUsuario = new ModeloUsuario($database->connection());

        // Crea el controlador y le entrega el modelo correspondiente.
        $controladorUsuarios = new ControladorUsuarios($modeloUsuario);

        // Lee la acción solicitada desde la URL y usa la lista como valor predeterminado.
        $accion = $_GET['accion'] ?? 'listar';

        // Muestra el formulario cuando se solicita la acción de creación.
        if ($accion === 'crear') {
            $errores = [];
            $datos = [];

            // Procesa el formulario únicamente cuando el navegador lo envía mediante POST.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $resultado = $controladorUsuarios->guardar($_POST);
                $errores = $resultado['errores'];
                $datos = $resultado['datos'];

                // Si no hubo errores, vuelve a la lista para mostrar el usuario creado.
                if ($errores === []) {
                    header('Location: index.php');
                    exit;
                }
            }

            // Carga el formulario de creación con los errores y datos actuales.
            require $rootPath . '/src/Vistas/usuarios/crear.php';
            return;
        }

        // Ejecuta la acción que obtiene la lista de usuarios.
        $usuarios = $controladorUsuarios->index();

        // Carga la vista y le proporciona los usuarios obtenidos.
        require $rootPath . '/src/Vistas/usuarios/index.php';
    }
}