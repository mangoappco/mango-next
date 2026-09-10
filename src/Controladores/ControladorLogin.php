<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de controladores de ManGo!.
namespace Mango\Controladores;

// Importa el modelo que consulta los usuarios almacenados.
use Mango\Modelos\ModeloUsuario;

// Coordina la validación de las credenciales de acceso.
final class ControladorLogin
{
    // Define la cantidad máxima de intentos fallidos permitidos.
    private const INTENTOS_MAXIMOS = 5;

    // Define el tiempo de bloqueo en segundos: cinco minutos.
    private const DURACION_BLOQUEO = 300;

    // Recibe el modelo mediante inyección de dependencias.
    public function __construct(private ModeloUsuario $modeloUsuario)
    {
    }

    // Valida las credenciales y devuelve el usuario autenticado si son correctas.
    public function autenticar(array $datos): array
    {
        // Normaliza el correo y obtiene la contraseña enviada por el formulario.
        $correo = trim((string) ($datos['correo'] ?? ''));
        $contrasena = (string) ($datos['contrasena'] ?? '');
        $errores = [];

        // Rechaza temporalmente nuevos intentos si se alcanzó el límite.
        $segundosRestantes = $this->segundosBloqueoRestantes();

        if ($segundosRestantes > 0) {
            return [
                'errores' => [
                    'Demasiados intentos fallidos. Intenta nuevamente en '
                    . $segundosRestantes
                    . ' segundos.',
                ],
                'datos' => ['correo' => $correo],
                'usuario' => null,
            ];
        }

        // Comprueba que el correo tenga un formato válido.
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El correo electrónico no es válido.';
        }

        // Comprueba que se haya escrito una contraseña.
        if ($contrasena === '') {
            $errores[] = 'La contraseña es obligatoria.';
        }

        // Detiene la búsqueda si los datos básicos no son válidos.
        if ($errores !== []) {
            return [
                'errores' => $errores,
                'datos' => ['correo' => $correo],
                'usuario' => null,
            ];
        }

        // Busca el usuario sin exponer la contraseña almacenada a la vista.
        $usuario = $this->modeloUsuario->buscarPorCorreo($correo);

        // Rechaza usuarios inexistentes, inactivos o con contraseña incorrecta.
        if (
            $usuario === null
            || (int) $usuario['activo'] !== 1
            || !password_verify($contrasena, (string) $usuario['contrasena'])
        ) {
            // Registra el fallo antes de devolver el mensaje genérico.
            $intentos = $this->registrarIntentoFallido();

            // Informa del bloqueo solo cuando se alcanzó el máximo configurado.
            $mensaje = $intentos >= self::INTENTOS_MAXIMOS
                ? 'Demasiados intentos fallidos. Intenta nuevamente en '
                    . self::DURACION_BLOQUEO
                    . ' segundos.'
                : 'El correo o la contraseña son incorrectos.';

            return [
                'errores' => [$mensaje],
                'datos' => ['correo' => $correo],
                'usuario' => null,
            ];
        }

        // Limpia los fallos anteriores después de una autenticación correcta.
        unset($_SESSION['intentos_login']);

        // Devuelve el usuario válido para que Application pueda iniciar su sesión.
        return [
            'errores' => [],
            'datos' => ['correo' => $correo],
            'usuario' => $usuario,
        ];
    }

    // Devuelve los segundos que faltan para terminar el bloqueo actual.
    private function segundosBloqueoRestantes(): int
    {
        // Obtiene los datos del límite guardados en la sesión.
        $intentos = $_SESSION['intentos_login'] ?? [];
        $bloqueadoHasta = (int) ($intentos['bloqueado_hasta'] ?? 0);

        // Calcula el tiempo restante, sin devolver valores negativos.
        return max(0, $bloqueadoHasta - time());
    }

    // Registra un fallo y devuelve la cantidad acumulada.
    private function registrarIntentoFallido(): int
    {
        // Obtiene el contador actual o comienza desde cero.
        $intentos = $_SESSION['intentos_login'] ?? [];
        $cantidad = (int) ($intentos['cantidad'] ?? 0) + 1;

        // Guarda el contador actualizado en la sesión.
        $_SESSION['intentos_login'] = [
            'cantidad' => $cantidad,
            'bloqueado_hasta' => $cantidad >= self::INTENTOS_MAXIMOS
                ? time() + self::DURACION_BLOQUEO
                : 0,
        ];

        return $cantidad;
    }
}