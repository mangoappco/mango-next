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
        // Inicia la sesión para poder conservar mensajes entre peticiones.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

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
                    // Guarda un mensaje temporal que se mostrará después de la redirección.
                    $_SESSION['mensaje'] = 'Usuario creado correctamente.';

                    header('Location: index.php');
                    exit;
                }
            }

            // Carga el formulario de creación con los errores y datos actuales.
            require $rootPath . '/src/Vistas/usuarios/crear.php';
            return;
        }

        // Muestra los datos públicos de un usuario individual.
        if ($accion === 'ver') {
            // Obtiene el identificador recibido en la URL.
            $id = (int) ($_GET['id'] ?? 0);
            $usuario = $controladorUsuarios->obtener($id);

            // Muestra un error sencillo si el usuario no existe.
            if ($usuario === null) {
                http_response_code(404);
                echo 'Usuario no encontrado.';
                return;
            }

            // Carga la vista de detalle y le entrega el usuario encontrado.
            require $rootPath . '/src/Vistas/usuarios/detalle.php';
            return;
        }

        // Obtiene el identificador cuando se solicita editar un usuario.
        if ($accion === 'editar') {
            $id = (int) ($_GET['id'] ?? 0);
            $usuario = $controladorUsuarios->obtener($id);

            // Muestra un error sencillo si el identificador no corresponde a un usuario.
            if ($usuario === null) {
                http_response_code(404);
                echo 'Usuario no encontrado.';
                return;
            }

            $errores = [];
            $datos = $usuario;

            // Procesa los cambios únicamente cuando llegan mediante POST.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $resultado = $controladorUsuarios->actualizar($id, $_POST);
                $errores = $resultado['errores'];
                $datos = array_merge($datos, $resultado['datos']);

                // Si no hubo errores, vuelve a la lista actualizada.
                if ($errores === []) {
                    // Guarda un mensaje temporal que se mostrará después de la redirección.
                    $_SESSION['mensaje'] = 'Usuario actualizado correctamente.';

                    header('Location: index.php');
                    exit;
                }
            }

            // Carga la vista de edición con los datos actuales o los datos corregidos.
            require $rootPath . '/src/Vistas/usuarios/editar.php';
            return;
        }

        // Elimina un usuario únicamente cuando la petición utiliza POST.
        if ($accion === 'eliminar') {
            // Obtiene el usuario para mostrarlo en la confirmación o validar el borrado.
            $id = (int) ($_GET['id'] ?? 0);
            $usuario = $controladorUsuarios->obtener($id);

            // Muestra un error sencillo si el identificador no corresponde a un usuario.
            if ($usuario === null) {
                http_response_code(404);
                echo 'Usuario no encontrado.';
                return;
            }

            // Procesa la eliminación únicamente cuando el formulario utiliza POST.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Solicita al controlador eliminar el usuario confirmado.
                $controladorUsuarios->eliminar($id);

                // Vuelve a la lista después de eliminarlo.
                // Guarda un mensaje temporal que se mostrará después de la redirección.
                $_SESSION['mensaje'] = 'Usuario eliminado correctamente.';

                header('Location: index.php');
                exit;
            }

            // Carga la vista que pide confirmar la eliminación.
            require $rootPath . '/src/Vistas/usuarios/eliminar.php';
            return;
        }

        // Ejecuta la acción que obtiene la lista de usuarios.
        $usuarios = $controladorUsuarios->index();

        // Recupera el mensaje temporal creado por una operación anterior.
        $mensaje = $_SESSION['mensaje'] ?? null;

        // Elimina el mensaje para que solo aparezca una vez.
        unset($_SESSION['mensaje']);

        // Carga la vista y le proporciona los usuarios obtenidos.
        require $rootPath . '/src/Vistas/usuarios/index.php';
    }
}