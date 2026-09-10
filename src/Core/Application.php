<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Indica que esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Importa el controlador que coordina la consulta de usuarios.
use Mango\Controladores\ControladorUsuarios;

// Importa el controlador que coordina la autenticación.
use Mango\Controladores\ControladorLogin;

// Importa el modelo que trabaja con la tabla usuarios.
use Mango\Modelos\ModeloUsuario;

// Representa el punto de coordinación principal de la aplicación.
final class Application
{
    // Ejecuta la aplicación.
    public function run(): void
    {
        // Configura la cookie y las reglas de seguridad antes de iniciar la sesión.
        $this->configurarSesion();

        // Inicia la sesión para poder conservar mensajes entre peticiones.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtiene el token que protegerá los formularios que modifican datos.
        $tokenCsrf = $this->obtenerTokenCsrf();

        // Obtiene la ruta raíz para que Config pueda localizar el archivo .env.
        $rootPath = dirname(__DIR__, 2);

        // Lee la acción solicitada desde la URL y usa la lista como valor predeterminado.
        $accion = $_GET['accion'] ?? 'listar';

        // Muestra el formulario de login antes de cargar la conexión a la base de datos.
        if ($accion === 'login' && $_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Prepara los valores iniciales que la vista necesita.
            $errores = [];
            $datos = ['correo' => ''];

            // Carga la vista del formulario de acceso.
            require $rootPath . '/src/Vistas/login.php';
            return;
        }

        // Cierra la sesión únicamente mediante un formulario POST protegido.
        if ($accion === 'cerrar-sesion') {
            // Rechaza cualquier intento de cerrar sesión mediante GET.
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                echo 'El cierre de sesión requiere una petición POST.';
                return;
            }

            // Rechaza el formulario si el token no pertenece a la sesión actual.
            if (!$this->tokenCsrfValido($_POST['token_csrf'] ?? null)) {
                http_response_code(403);
                echo 'La solicitud no es válida.';
                return;
            }

            // Elimina todos los datos almacenados en la sesión.
            $_SESSION = [];
            session_destroy();

            // Envía al usuario al formulario de acceso.
            header('Location: index.php?accion=login');
            exit;
        }

        // Carga la configuración del proyecto.
        $config = new Config($rootPath);

        // Crea la conexión reutilizable con la base de datos.
        $database = new Database($config);

        // Crea el modelo y le entrega la conexión que necesita.
        $modeloUsuario = new ModeloUsuario($database->connection());

        // Crea el controlador y le entrega el modelo correspondiente.
        $controladorUsuarios = new ControladorUsuarios($modeloUsuario);

        // Crea el controlador que validará las credenciales del login.
        $controladorLogin = new ControladorLogin($modeloUsuario);

        // Procesa el formulario de login mediante POST.
        if ($accion === 'login') {
            // Prepara los valores que la vista conservará si hay errores.
            $errores = [];
            $datos = ['correo' => trim((string) ($_POST['correo'] ?? ''))];

            // Valida primero que el formulario pertenezca a esta sesión.
            if (!$this->tokenCsrfValido($_POST['token_csrf'] ?? null)) {
                $errores[] = 'La solicitud no es válida. Recarga el formulario e inténtalo de nuevo.';
            } else {
                // Envía las credenciales al controlador especializado.
                $resultado = $controladorLogin->autenticar($_POST);
                $errores = $resultado['errores'];
                $datos = $resultado['datos'];
            }

            // Si las credenciales son correctas, crea la sesión autenticada.
            if ($errores === []) {
                // Regenera el identificador para evitar fijación de sesión.
                session_regenerate_id(true);

                // Guarda solo datos necesarios, nunca la contraseña ni su hash.
                $_SESSION['usuario'] = [
                    'id' => $resultado['usuario']['id'],
                    'correo' => $resultado['usuario']['correo'],
                    'tipo' => $resultado['usuario']['tipo'],
                ];

                // Guarda un mensaje temporal y vuelve a la lista.
                $_SESSION['mensaje'] = 'Inicio de sesión correcto.';
                header('Location: index.php?accion=bienvenida');
                exit;
            }

            // Vuelve a mostrar el formulario con los errores encontrados.
            require $rootPath . '/src/Vistas/login.php';
            return;
        }

        // Impide acceder al CRUD si la sesión todavía no está autenticada.
        if (!$this->usuarioAutenticado()) {
            header('Location: index.php?accion=login');
            exit;
        }

        // Muestra la página de bienvenida al usuario autenticado.
        if ($accion === 'bienvenida') {
            // Obtiene los datos seguros guardados durante el login.
            $usuarioAutenticado = $_SESSION['usuario'];

            // Recupera el mensaje temporal de una operación anterior.
            $mensaje = $_SESSION['mensaje'] ?? null;

            // Elimina el mensaje para que se muestre una sola vez.
            unset($_SESSION['mensaje']);

            // Carga la vista de bienvenida.
            require $rootPath . '/src/Vistas/bienvenida.php';
            return;
        }

        // Permite al usuario autenticado cambiar únicamente su propia contraseña.
        if ($accion === 'cambiar-contrasena') {
            $errores = [];

            // Procesa el formulario solo cuando llega mediante POST.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Rechaza el formulario si el token no pertenece a la sesión.
                if (!$this->tokenCsrfValido($_POST['token_csrf'] ?? null)) {
                    $errores[] = 'La solicitud no es válida. Recarga el formulario e inténtalo de nuevo.';
                } else {
                    // Usa el id de la sesión, nunca uno enviado por el navegador.
                    $resultado = $controladorLogin->cambiarContrasena(
                        (int) $_SESSION['usuario']['id'],
                        $_POST
                    );
                    $errores = $resultado['errores'];
                }

                // Redirige a la bienvenida después de guardar correctamente.
                if ($errores === []) {
                    $_SESSION['mensaje'] = 'Contraseña actualizada correctamente.';
                    header('Location: index.php?accion=bienvenida');
                    exit;
                }
            }

            // Carga el formulario con los errores, si los hubiera.
            require $rootPath . '/src/Vistas/cambiar-contrasena.php';
            return;
        }

        // Muestra el formulario cuando se solicita la acción de creación.
        if ($accion === 'crear') {
            // Solo los administradores pueden crear usuarios.
            if (!$this->esAdministrador()) {
                $this->mostrarAccesoDenegado($rootPath);
                return;
            }

            $errores = [];
            $datos = [];

            // Procesa el formulario únicamente cuando el navegador lo envía mediante POST.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Rechaza el formulario si el token no coincide con el de la sesión.
                if (!$this->tokenCsrfValido($_POST['token_csrf'] ?? null)) {
                    $errores[] = 'La solicitud no es válida. Recarga el formulario e inténtalo de nuevo.';
                } else {
                    $resultado = $controladorUsuarios->guardar($_POST);
                    $errores = $resultado['errores'];
                    $datos = $resultado['datos'];
                }

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
                require $rootPath . '/src/Vistas/errores/404.php';
                return;
            }

            // Carga la vista de detalle y le entrega el usuario encontrado.
            $esAdministrador = $this->esAdministrador();
            require $rootPath . '/src/Vistas/usuarios/detalle.php';
            return;
        }

        // Obtiene el identificador cuando se solicita editar un usuario.
        if ($accion === 'editar') {
            // Solo los administradores pueden editar usuarios.
            if (!$this->esAdministrador()) {
                $this->mostrarAccesoDenegado($rootPath);
                return;
            }

            $id = (int) ($_GET['id'] ?? 0);
            $usuario = $controladorUsuarios->obtener($id);

            // Muestra un error sencillo si el identificador no corresponde a un usuario.
            if ($usuario === null) {
                http_response_code(404);
                require $rootPath . '/src/Vistas/errores/404.php';
                return;
            }

            $errores = [];
            $datos = $usuario;

            // Procesa los cambios únicamente cuando llegan mediante POST.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Rechaza el formulario si el token no coincide con el de la sesión.
                if (!$this->tokenCsrfValido($_POST['token_csrf'] ?? null)) {
                    $errores[] = 'La solicitud no es válida. Recarga el formulario e inténtalo de nuevo.';
                } else {
                    $resultado = $controladorUsuarios->actualizar($id, $_POST);
                    $errores = $resultado['errores'];
                    $datos = array_merge($datos, $resultado['datos']);
                }

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
            // Solo los administradores pueden eliminar usuarios.
            if (!$this->esAdministrador()) {
                $this->mostrarAccesoDenegado($rootPath);
                return;
            }

            // Obtiene el usuario para mostrarlo en la confirmación o validar el borrado.
            $id = (int) ($_GET['id'] ?? 0);
            $usuario = $controladorUsuarios->obtener($id);

            // Muestra un error sencillo si el identificador no corresponde a un usuario.
            if ($usuario === null) {
                http_response_code(404);
                require $rootPath . '/src/Vistas/errores/404.php';
                return;
            }

            // Procesa la eliminación únicamente cuando el formulario utiliza POST.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Rechaza la eliminación si el token no coincide con el de la sesión.
                if (!$this->tokenCsrfValido($_POST['token_csrf'] ?? null)) {
                    http_response_code(403);
                    echo 'La solicitud no es válida.';
                    return;
                }

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

        // Lee y normaliza el texto de búsqueda enviado mediante GET.
        $busqueda = trim((string) ($_GET['buscar'] ?? ''));

        // Indica a la vista si debe mostrar acciones administrativas.
        $esAdministrador = $this->esAdministrador();

        // Ejecuta la acción que obtiene la lista filtrada de usuarios.
        $usuarios = $controladorUsuarios->index($busqueda);

        // Recupera el mensaje temporal creado por una operación anterior.
        $mensaje = $_SESSION['mensaje'] ?? null;

        // Elimina el mensaje para que solo aparezca una vez.
        unset($_SESSION['mensaje']);

        // Carga la vista y le proporciona los usuarios obtenidos.
        require $rootPath . '/src/Vistas/usuarios/index.php';
    }

    // Genera y devuelve un token estable durante la sesión del usuario.
    private function obtenerTokenCsrf(): string
    {
        // Genera un token nuevo si la sesión todavía no tiene uno válido.
        if (!isset($_SESSION['token_csrf']) || !is_string($_SESSION['token_csrf'])) {
            $_SESSION['token_csrf'] = bin2hex(random_bytes(32));
        }

        // Devuelve el token que las vistas incluirán en sus formularios.
        return $_SESSION['token_csrf'];
    }

    // Configura las opciones de seguridad de la sesión antes de abrirla.
    private function configurarSesion(): void
    {
        // Evita reutilizar identificadores de sesión no registrados por el servidor.
        ini_set('session.use_strict_mode', '1');

        // Usa un nombre propio para diferenciar la sesión de ManGo! de otras aplicaciones.
        session_name('MANGO_SESION');

        // Configura la cookie para que JavaScript no pueda leerla.
        session_set_cookie_params([
            // Mantiene la cookie disponible para las rutas de la aplicación.
            'path' => '/',

            // Solo permite enviar la cookie en solicitudes del mismo sitio.
            'samesite' => 'Lax',

            // Impide que JavaScript acceda al identificador de sesión.
            'httponly' => true,

            // Activa Secure automáticamente cuando la aplicación usa HTTPS.
            'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        ]);
    }

    // Comprueba que el token recibido pertenezca a la sesión actual.
    private function tokenCsrfValido(mixed $token): bool
    {
        // Obtiene el token almacenado en la sesión.
        $tokenSesion = $_SESSION['token_csrf'] ?? null;

        // Rechaza valores que no sean cadenas o que no existan en la sesión.
        if (!is_string($token) || !is_string($tokenSesion)) {
            return false;
        }

        // Compara los valores de forma segura contra ataques de temporización.
        return hash_equals($tokenSesion, $token);
    }

    // Comprueba si existe una sesión de usuario válida.
    private function usuarioAutenticado(): bool
    {
        // Obtiene los datos del usuario guardados durante el login.
        $usuario = $_SESSION['usuario'] ?? null;

        // Una sesión autenticada debe contener un arreglo con un identificador.
        return is_array($usuario) && isset($usuario['id']);
    }

    // Comprueba si el usuario autenticado tiene permisos administrativos.
    private function esAdministrador(): bool
    {
        // Compara el tipo guardado en la sesión con el tipo permitido.
        return ($_SESSION['usuario']['tipo'] ?? null) === 'admin';
    }

    // Muestra una respuesta 403 cuando el usuario no tiene permiso suficiente.
    private function mostrarAccesoDenegado(string $rootPath): void
    {
        // Informa al navegador que la acción está prohibida.
        http_response_code(403);

        // Carga una vista comprensible para el usuario.
        require $rootPath . '/src/Vistas/errores/403.php';
    }
}