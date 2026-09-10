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

    // Verifica la contraseña actual y prepara el cambio de contraseña.
    public function cambiarContrasena(int $id, array $datos): array
    {
        // Obtiene los valores enviados sin incluir el identificador desde el formulario.
        $actual = (string) ($datos['contrasena_actual'] ?? '');
        $nueva = (string) ($datos['contrasena_nueva'] ?? '');
        $confirmacion = (string) ($datos['contrasena_confirmacion'] ?? '');
        $errores = [];

        // Busca el hash usando el usuario autenticado.
        $hashActual = $this->modeloUsuario->buscarHashContrasenaPorId($id);

        // Comprueba que la contraseña actual sea correcta.
        if ($hashActual === null || !password_verify($actual, $hashActual)) {
            $errores[] = 'La contraseña actual no es correcta.';
        }

        // Exige una longitud mínima para la nueva contraseña.
        if (strlen($nueva) < 8) {
            $errores[] = 'La nueva contraseña debe tener al menos 8 caracteres.';
        }

        // Comprueba que ambos campos nuevos coincidan.
        if ($nueva !== $confirmacion) {
            $errores[] = 'La confirmación no coincide con la nueva contraseña.';
        }

        // Devuelve los errores sin guardar ningún cambio.
        if ($errores !== []) {
            return ['errores' => $errores];
        }

        // Solicita al modelo guardar el nuevo hash.
        $this->modeloUsuario->cambiarContrasena($id, $nueva);

        // Informa que el cambio terminó correctamente.
        return ['errores' => []];
    }

    // Solicita una recuperación sin revelar si el correo está registrado.
    public function solicitarRecuperacion(string $correo): array
    {
        // Busca el usuario asociado al correo recibido.
        $usuario = $this->modeloUsuario->buscarPorCorreo($correo);

        // Devuelve siempre el mismo resultado visible para evitar enumerar cuentas.
        $resultado = [
            'mensaje' => 'Si el correo existe, se generó un enlace de recuperación.',
            'enlace' => null,
        ];

        // No genera tokens para correos inexistentes o usuarios inactivos.
        if ($usuario === null || (int) $usuario['activo'] !== 1) {
            return $resultado;
        }

        // Genera un token aleatorio que solo se conocerá por el enlace enviado.
        $token = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);
        $expiraEn = date('Y-m-d H:i:s', time() + 3600);

        // Guarda el hash durante una hora.
        $this->modeloUsuario->crearTokenRecuperacion((int) $usuario['id'], $tokenHash, $expiraEn);

        // Devuelve el enlace solo para simular el correo en desarrollo.
        $resultado['enlace'] = 'index.php?accion=restablecer&token=' . urlencode($token);

        return $resultado;
    }

    // Valida un token y establece la nueva contraseña.
    public function restablecerContrasena(string $token, array $datos): array
    {
        // Obtiene el registro usando únicamente el hash del token recibido.
        $tokenHash = hash('sha256', $token);
        $recuperacion = $this->modeloUsuario->buscarRecuperacionValida($tokenHash);
        $nueva = (string) ($datos['contrasena_nueva'] ?? '');
        $confirmacion = (string) ($datos['contrasena_confirmacion'] ?? '');
        $errores = [];

        // Rechaza tokens inexistentes, vencidos o usados.
        if ($recuperacion === null) {
            $errores[] = 'El enlace no es válido o ya expiró.';
        }

        // Aplica la misma regla mínima del cambio autenticado.
        if (strlen($nueva) < 8) {
            $errores[] = 'La nueva contraseña debe tener al menos 8 caracteres.';
        }

        if ($nueva !== $confirmacion) {
            $errores[] = 'La confirmación no coincide con la nueva contraseña.';
        }

        if ($errores !== []) {
            return ['errores' => $errores];
        }

        // Cambia la contraseña y consume el token en la misma operación lógica.
        $this->modeloUsuario->cambiarContrasena((int) $recuperacion['usuario_id'], $nueva);
        $this->modeloUsuario->marcarRecuperacionUsada((int) $recuperacion['recuperacion_id']);

        return ['errores' => []];
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