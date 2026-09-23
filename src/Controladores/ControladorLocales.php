<?php

declare(strict_types=1);

namespace Mango\Controladores;

use Mango\Core\ServicioArchivos;
use Mango\Modelos\ModeloLocal;

final class ControladorLocales
{
    public function __construct(
        private ModeloLocal $modeloLocal,
        private ServicioArchivos $servicioArchivos
    ) {
    }

    public function index(string $busqueda = ''): array
    {
        return $this->modeloLocal->buscarTodos($busqueda);
    }

    public function obtener(int $id): ?array
    {
        return $this->modeloLocal->buscarPorId($id);
    }

    public function obtenerMarcas(): array
    {
        return $this->modeloLocal->buscarMarcas();
    }

    public function guardar(array $datos, ?array $archivoImagen, string $rootPath): array
    {
        [$normalizado, $errores] = $this->normalizarYValidar($datos);

        if ($errores !== []) {
            return [
                'errores' => $errores,
                'datos' => $normalizado,
            ];
        }

        $resultadoImagen = $this->servicioArchivos->guardarImagenLocal($archivoImagen, $rootPath);
        if ($resultadoImagen['errores'] !== []) {
            return [
                'errores' => $resultadoImagen['errores'],
                'datos' => $normalizado,
            ];
        }

        try {
            $this->modeloLocal->crear(
                (int) $normalizado['marca_id'],
                $normalizado['codigo'] !== '' ? (string) $normalizado['codigo'] : null,
                (string) $normalizado['nombre'],
                (string) $normalizado['direccion'],
                $normalizado['telefono'] !== '' ? (string) $normalizado['telefono'] : null,
                $normalizado['ciudad'] !== '' ? (string) $normalizado['ciudad'] : null,
                $normalizado['barrio'] !== '' ? (string) $normalizado['barrio'] : null,
                (string) $normalizado['tipo_local'],
                $normalizado['apertura'] !== '' ? (string) $normalizado['apertura'] : null,
                $normalizado['cierre'] !== '' ? (string) $normalizado['cierre'] : null,
                (float) $normalizado['propina_porcentaje'],
                $resultadoImagen['ruta']
            );
        } catch (\Throwable $exception) {
            if ($resultadoImagen['ruta'] !== null) {
                $this->servicioArchivos->eliminarImagenLocal($resultadoImagen['ruta'], $rootPath);
            }

            throw $exception;
        }

        return [
            'errores' => [],
            'datos' => [],
        ];
    }

    public function actualizar(
        int $id,
        array $datos,
        ?array $archivoImagen,
        string $rootPath,
        ?string $imagenActual,
        bool $eliminarImagen
    ): array {
        [$normalizado, $errores] = $this->normalizarYValidar($datos, $id);

        $hayArchivoNuevo = $archivoImagen !== null
            && ($archivoImagen['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;

        if ($eliminarImagen && $hayArchivoNuevo) {
            $errores[] = 'Selecciona una nueva imagen o elimina la actual, pero no ambas opciones.';
        }

        if ($errores !== []) {
            return [
                'errores' => $errores,
                'datos' => array_merge($normalizado, ['imagen' => $imagenActual]),
            ];
        }

        $resultadoImagen = $eliminarImagen
            ? ['errores' => [], 'ruta' => null]
            : ($hayArchivoNuevo
                ? $this->servicioArchivos->guardarImagenLocal($archivoImagen, $rootPath)
                : ['errores' => [], 'ruta' => $imagenActual]);

        if ($resultadoImagen['errores'] !== []) {
            return [
                'errores' => $resultadoImagen['errores'],
                'datos' => array_merge($normalizado, ['imagen' => $imagenActual]),
            ];
        }

        $imagenFinal = $resultadoImagen['ruta'] ?? null;

        try {
            $this->modeloLocal->actualizar(
                $id,
                (int) $normalizado['marca_id'],
                $normalizado['codigo'] !== '' ? (string) $normalizado['codigo'] : null,
                (string) $normalizado['nombre'],
                (string) $normalizado['direccion'],
                $normalizado['telefono'] !== '' ? (string) $normalizado['telefono'] : null,
                $normalizado['ciudad'] !== '' ? (string) $normalizado['ciudad'] : null,
                $normalizado['barrio'] !== '' ? (string) $normalizado['barrio'] : null,
                (string) $normalizado['tipo_local'],
                $normalizado['apertura'] !== '' ? (string) $normalizado['apertura'] : null,
                $normalizado['cierre'] !== '' ? (string) $normalizado['cierre'] : null,
                (float) $normalizado['propina_porcentaje'],
                $imagenFinal
            );
        } catch (\Throwable $exception) {
            if ($imagenFinal !== null && $imagenFinal !== $imagenActual) {
                $this->servicioArchivos->eliminarImagenLocal($imagenFinal, $rootPath);
            }

            throw $exception;
        }

        if (($imagenFinal !== null && $imagenActual !== $imagenFinal) || $eliminarImagen) {
            $this->servicioArchivos->eliminarImagenLocal($imagenActual, $rootPath);
        }

        return [
            'errores' => [],
            'datos' => [],
        ];
    }

    public function desactivar(int $id): void
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('El identificador del local no es válido.');
        }

        $this->modeloLocal->desactivar($id);
    }

    public function reactivar(int $id): void
    {
        if ($id <= 0) {
            throw new \InvalidArgumentException('El identificador del local no es válido.');
        }

        $this->modeloLocal->reactivar($id);
    }

    private function normalizarYValidar(array $datos, ?int $idExcluir = null): array
    {
        $marcaId = (int) ($datos['marca_id'] ?? 0);
        $codigo = trim((string) ($datos['codigo'] ?? ''));
        $nombre = trim((string) ($datos['nombre'] ?? ''));
        $direccion = trim((string) ($datos['direccion'] ?? ''));
        $telefono = trim((string) ($datos['telefono'] ?? ''));
        $ciudad = trim((string) ($datos['ciudad'] ?? ''));
        $barrio = trim((string) ($datos['barrio'] ?? ''));
        $tipoLocal = trim((string) ($datos['tipo_local'] ?? 'sucursal'));
        $apertura = trim((string) ($datos['apertura'] ?? ''));
        $cierre = trim((string) ($datos['cierre'] ?? ''));
        $propinaPorcentaje = trim((string) ($datos['propina_porcentaje'] ?? '0'));

        $errores = [];

        if ($marcaId <= 0 || $this->modeloLocal->buscarMarcaActivaPorId($marcaId) === null) {
            $errores[] = 'Selecciona una marca válida.';
        }

        if ($codigo !== '' && $this->modeloLocal->codigoExiste($codigo, $idExcluir)) {
            $errores[] = 'Ya existe un local con ese código.';
        }

        if ($nombre === '') {
            $errores[] = 'El nombre del local es obligatorio.';
        }

        if ($direccion === '') {
            $errores[] = 'La dirección del local es obligatoria.';
        }

        if ($telefono !== '' && mb_strlen($telefono) > 20) {
            $errores[] = 'El teléfono no puede superar los 20 caracteres.';
        }

        if ($ciudad !== '' && mb_strlen($ciudad) > 100) {
            $errores[] = 'La ciudad no puede superar los 100 caracteres.';
        }

        if ($barrio !== '' && mb_strlen($barrio) > 100) {
            $errores[] = 'El barrio no puede superar los 100 caracteres.';
        }

        $tiposPermitidos = ['sucursal', 'bodega', 'franquicia', 'punto_venta', 'otro'];
        if (!in_array($tipoLocal, $tiposPermitidos, true)) {
            $errores[] = 'Selecciona un tipo de local válido.';
        }

        $horaRegex = '/^(?:[01]\d|2[0-3]):[0-5]\d(?:[:][0-5]\d)?$/';
        if (($apertura !== '' || $cierre !== '') && ($apertura === '' || $cierre === '')) {
            $errores[] = 'Si defines un horario, debes indicar apertura y cierre.';
        }

        if ($apertura !== '' && !preg_match($horaRegex, $apertura)) {
            $errores[] = 'La hora de apertura no es válida.';
        }

        if ($cierre !== '' && !preg_match($horaRegex, $cierre)) {
            $errores[] = 'La hora de cierre no es válida.';
        }

        if ($apertura !== '') {
            $apertura = substr($apertura, 0, 5);
        }

        if ($cierre !== '') {
            $cierre = substr($cierre, 0, 5);
        }

        if (!is_numeric($propinaPorcentaje)) {
            $errores[] = 'La propina debe ser un valor numérico.';
        } else {
            $propinaNumerica = (float) $propinaPorcentaje;
            if ($propinaNumerica < 0 || $propinaNumerica > 100) {
                $errores[] = 'La propina debe estar entre 0 y 100.';
            }
        }

        $normalizado = [
            'marca_id' => $marcaId,
            'codigo' => $codigo,
            'nombre' => $nombre,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'ciudad' => $ciudad,
            'barrio' => $barrio,
            'tipo_local' => $tipoLocal,
            'apertura' => $apertura,
            'cierre' => $cierre,
            'propina_porcentaje' => is_numeric($propinaPorcentaje) ? (float) $propinaPorcentaje : 0.0,
        ];

        return [$normalizado, $errores];
    }
}