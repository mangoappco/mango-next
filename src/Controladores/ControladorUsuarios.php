<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de controladores de ManGo!.
namespace Mango\Controladores;

// Importa el modelo que contiene las consultas de usuarios.
use Mango\Modelos\ModeloUsuario;

// Coordina las acciones relacionadas con los usuarios.
final class ControladorUsuarios
{
    // Recibe el modelo mediante inyección de dependencias.
    public function __construct(private ModeloUsuario $modeloUsuario)
    {
    }

    // Obtiene los usuarios que la vista debe mostrar.
    public function index(): array
    {
        // Delega la consulta al modelo y devuelve sus resultados.
        return $this->modeloUsuario->buscarTodos();
    }

    // Valida los datos recibidos y solicita al modelo crear el usuario.
    public function guardar(array $datos): array
    {
        // Normaliza los textos para evitar guardar espacios innecesarios.
        $correo = trim((string) ($datos['correo'] ?? ''));
        $contrasena = (string) ($datos['contrasena'] ?? '');
        $nombres = trim((string) ($datos['nombres'] ?? ''));
        $apellidos = trim((string) ($datos['apellidos'] ?? ''));
        $tipo = trim((string) ($datos['tipo'] ?? 'usuario'));
        $errores = [];

        // Comprueba que el correo tenga un formato válido.
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El correo electrónico no es válido.';
        }

        // Comprueba que la contraseña no esté vacía.
        if ($contrasena === '') {
            $errores[] = 'La contraseña es obligatoria.';
        }

        // Comprueba los campos de nombre obligatorios.
        if ($nombres === '') {
            $errores[] = 'Los nombres son obligatorios.';
        }

        if ($apellidos === '') {
            $errores[] = 'Los apellidos son obligatorios.';
        }

        // Si hay errores, devuelve los datos para volver a mostrarlos en el formulario.
        if ($errores !== []) {
            return [
                'errores' => $errores,
                'datos' => [
                    'correo' => $correo,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'tipo' => $tipo,
                ],
            ];
        }

        // El modelo aplica el hash y guarda el usuario en la base de datos.
        $this->modeloUsuario->crear($correo, $contrasena, $nombres, $apellidos, $tipo);

        // Devuelve un resultado exitoso para que la aplicación redirija a la lista.
        return [
            'errores' => [],
            'datos' => [],
        ];
    }
}