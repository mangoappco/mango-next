<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de controladores de ManGo!.
namespace Mango\Controladores;

// Importa el modelo que contiene las consultas de usuarios.
use Mango\Modelos\ModeloUsuario;

// Importa el servicio que valida y almacena imágenes.
use Mango\Core\ServicioArchivos;

// Coordina las acciones relacionadas con los usuarios.
final class ControladorUsuarios
{
    // Recibe el modelo mediante inyección de dependencias.
    public function __construct(
        private ModeloUsuario $modeloUsuario,
        private ServicioArchivos $servicioArchivos
    )
    {
    }

    // Obtiene los usuarios que coinciden con la búsqueda solicitada.
    public function index(string $busqueda = ''): array
    {
        // Delega la búsqueda al modelo y devuelve sus resultados.
        return $this->modeloUsuario->buscarTodos($busqueda);
    }

    // Busca los datos necesarios para cargar el formulario de edición.
    public function obtener(int $id): ?array
    {
        // Delega la búsqueda por identificador al modelo.
        return $this->modeloUsuario->buscarPorId($id);
    }

    // Valida los datos recibidos y solicita al modelo crear el usuario.
    public function guardar(array $datos, ?array $archivoFoto, string $rootPath): array
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

        // Evita registrar dos usuarios con el mismo correo.
        if ($errores === [] && $this->modeloUsuario->correoExiste($correo)) {
            $errores[] = 'Ya existe un usuario con ese correo electrónico.';
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

        // Valida y guarda la imagen solo cuando los datos básicos ya son correctos.
        $resultadoArchivo = $this->servicioArchivos->guardarImagenUsuario($archivoFoto, $rootPath);

        if ($resultadoArchivo['errores'] !== []) {
            return [
                'errores' => $resultadoArchivo['errores'],
                'datos' => [
                    'correo' => $correo,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'tipo' => $tipo,
                ],
            ];
        }

        // El modelo aplica el hash y guarda el usuario en la base de datos.
        try {
            $this->modeloUsuario->crear(
                $correo,
                $contrasena,
                $nombres,
                $apellidos,
                $tipo,
                $resultadoArchivo['ruta']
            );
        } catch (\Throwable $exception) {
            // Si falla la base de datos, elimina la imagen que ya se había guardado.
            $this->servicioArchivos->eliminarImagenUsuario($resultadoArchivo['ruta'], $rootPath);
            throw $exception;
        }

        // Devuelve un resultado exitoso para que la aplicación redirija a la lista.
        return [
            'errores' => [],
            'datos' => [],
        ];
    }

    // Valida los datos editados y solicita al modelo actualizar el usuario.
    public function actualizar(
        int $id,
        array $datos,
        ?array $archivoFoto,
        string $rootPath,
        ?string $fotoActual,
        bool $eliminarFoto
    ): array
    {
        // Normaliza los datos recibidos desde el formulario.
        $correo = trim((string) ($datos['correo'] ?? ''));
        $contrasena = (string) ($datos['contrasena'] ?? '');
        $nombres = trim((string) ($datos['nombres'] ?? ''));
        $apellidos = trim((string) ($datos['apellidos'] ?? ''));
        $tipo = trim((string) ($datos['tipo'] ?? 'usuario'));
        $errores = [];

        // Convierte la casilla del formulario en una decisión booleana.
        $solicitaEliminarFoto = $eliminarFoto;

        // Comprueba que el identificador sea válido.
        if ($id <= 0) {
            $errores[] = 'El identificador del usuario no es válido.';
        }

        // Comprueba los datos que siempre son obligatorios.
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El correo electrónico no es válido.';
        }

        // Evita usar el correo de otro usuario, pero permite conservar el propio.
        if ($errores === [] && $this->modeloUsuario->correoExiste($correo, $id)) {
            $errores[] = 'Ya existe otro usuario con ese correo electrónico.';
        }

        if ($nombres === '') {
            $errores[] = 'Los nombres son obligatorios.';
        }

        if ($apellidos === '') {
            $errores[] = 'Los apellidos son obligatorios.';
        }

        // Evita que una misma petición intente reemplazar y eliminar la imagen.
        $hayArchivoNuevo = $archivoFoto !== null
            && ($archivoFoto['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;
        if ($solicitaEliminarFoto && $hayArchivoNuevo) {
            $errores[] = 'Selecciona una nueva imagen o elimina la actual, pero no ambas opciones.';
        }

        // Devuelve los datos y errores para volver al formulario si algo falla.
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

        // Valida y guarda la nueva imagen solo cuando los demás datos son correctos.
        $resultadoArchivo = $solicitaEliminarFoto
            ? ['errores' => [], 'ruta' => null]
            : $this->servicioArchivos->guardarImagenUsuario($archivoFoto, $rootPath);

        if ($resultadoArchivo['errores'] !== []) {
            return [
                'errores' => $resultadoArchivo['errores'],
                'datos' => [
                    'correo' => $correo,
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'tipo' => $tipo,
                    'foto_perfil' => $fotoActual,
                ],
            ];
        }

        // Conserva la ruta anterior si no se seleccionó una imagen nueva.
        $fotoNueva = $resultadoArchivo['ruta'] ?? null;

        // Solicita al modelo actualizar los datos del usuario.
        try {
            $this->modeloUsuario->actualizar(
                $id,
                $correo,
                $nombres,
                $apellidos,
                $tipo,
                $contrasena,
                $fotoNueva,
                $solicitaEliminarFoto
            );
        } catch (\Throwable $exception) {
            // Si falla la base de datos, conserva la imagen anterior y elimina la nueva.
            if ($fotoNueva !== null) {
                $this->servicioArchivos->eliminarImagenUsuario($fotoNueva, $rootPath);
            }

            throw $exception;
        }

        // Elimina el archivo anterior solo después de actualizar la base de datos.
        if (($fotoNueva !== null && $fotoActual !== $fotoNueva) || $solicitaEliminarFoto) {
            $this->servicioArchivos->eliminarImagenUsuario($fotoActual, $rootPath);
        }

        // Indica que la actualización terminó correctamente.
        return [
            'errores' => [],
            'datos' => [],
        ];
    }

    // Valida el identificador y solicita al modelo desactivar el usuario.
    public function desactivar(int $id): void
    {
        // Evita enviar una eliminación con un identificador inexistente o inválido.
        if ($id <= 0) {
            throw new \InvalidArgumentException('El identificador del usuario no es válido.');
        }

        // Delega la desactivación al modelo.
        $this->modeloUsuario->desactivar($id);
    }

    // Valida el identificador y solicita al modelo reactivar el usuario.
    public function reactivar(int $id): void
    {
        // Evita enviar una reactivación con un identificador inexistente o inválido.
        if ($id <= 0) {
            throw new \InvalidArgumentException('El identificador del usuario no es válido.');
        }

        // Delega la reactivación al modelo.
        $this->modeloUsuario->reactivar($id);
    }
}