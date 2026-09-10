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
            return [
                'errores' => ['El correo o la contraseña son incorrectos.'],
                'datos' => ['correo' => $correo],
                'usuario' => null,
            ];
        }

        // Devuelve el usuario válido para que Application pueda iniciar su sesión.
        return [
            'errores' => [],
            'datos' => ['correo' => $correo],
            'usuario' => $usuario,
        ];
    }
}