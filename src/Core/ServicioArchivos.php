<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Gestiona los archivos que llegan desde formularios.
final class ServicioArchivos
{
    // Guarda una imagen de usuario y devuelve su ruta pública relativa.
    public function guardarImagenUsuario(?array $archivo, string $rootPath): array
    {
        // Permite crear un usuario sin imagen.
        if ($archivo === null || ($archivo['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return [
                'errores' => [],
                'ruta' => null,
            ];
        }

        // Rechaza cualquier error producido durante la carga.
        if (($archivo['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            return [
                'errores' => ['No se pudo cargar la imagen de perfil.'],
                'ruta' => null,
            ];
        }

        // Limita el tamaño para evitar archivos innecesariamente grandes.
        if ((int) ($archivo['size'] ?? 0) > 2 * 1024 * 1024) {
            return [
                'errores' => ['La imagen de perfil no puede superar los 2 MB.'],
                'ruta' => null,
            ];
        }

        // Comprueba el tipo real del archivo, no solo la extensión enviada por el navegador.
        $informacionArchivo = finfo_open(FILEINFO_MIME_TYPE);
        $tipoMime = $informacionArchivo === false
            ? false
            : finfo_file($informacionArchivo, (string) ($archivo['tmp_name'] ?? ''));

        if ($informacionArchivo !== false) {
            finfo_close($informacionArchivo);
        }

        $extensionesPermitidas = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
        ];

        if (!is_string($tipoMime) || !isset($extensionesPermitidas[$tipoMime])) {
            return [
                'errores' => ['La imagen debe ser JPG o PNG.'],
                'ruta' => null,
            ];
        }

        // Confirma que el archivo contiene una imagen válida y obtiene sus dimensiones.
        $dimensiones = @getimagesize((string) ($archivo['tmp_name'] ?? ''));
        if ($dimensiones === false) {
            return [
                'errores' => ['El archivo recibido no contiene una imagen válida.'],
                'ruta' => null,
            ];
        }

        // Exige GD y soporte JPG para entregar imágenes pequeñas y optimizadas.
        if (
            !function_exists('imagecreatetruecolor')
            || !function_exists('imagecreatefromjpeg')
            || !function_exists('imagecreatefrompng')
            || !function_exists('imagejpeg')
            || !function_exists('imageflip')
            || !function_exists('imagerotate')
        ) {
            return [
                'errores' => ['El servidor no tiene habilitado el procesamiento de imágenes.'],
                'ruta' => null,
            ];
        }

        // Define la carpeta física donde se guardan las imágenes de usuarios.
        $directorio = $rootPath . '/public/uploads/usuarios';

        if (!is_dir($directorio) && !mkdir($directorio, 0755, true) && !is_dir($directorio)) {
            return [
                'errores' => ['No se pudo preparar el almacenamiento de imágenes.'],
                'ruta' => null,
            ];
        }

        $imagenOriginal = match ($tipoMime) {
            'image/jpeg' => @imagecreatefromjpeg((string) $archivo['tmp_name']),
            'image/png' => @imagecreatefrompng((string) $archivo['tmp_name']),
            default => false,
        };

        if ($imagenOriginal === false) {
            return [
                'errores' => ['No se pudo procesar la imagen de perfil.'],
                'ruta' => null,
            ];
        }

        // Corrige la orientación indicada por EXIF antes de cambiar el tamaño.
        if ($tipoMime === 'image/jpeg' && function_exists('exif_read_data')) {
            $metadatos = @exif_read_data((string) $archivo['tmp_name']);
            $orientacion = (int) ($metadatos['Orientation'] ?? 1);

            switch ($orientacion) {
                case 2:
                    imageflip($imagenOriginal, IMG_FLIP_HORIZONTAL);
                    break;
                case 3:
                    $imagenOrientada = imagerotate($imagenOriginal, 180, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 4:
                    imageflip($imagenOriginal, IMG_FLIP_VERTICAL);
                    break;
                case 5:
                    imageflip($imagenOriginal, IMG_FLIP_HORIZONTAL);
                    $imagenOrientada = imagerotate($imagenOriginal, 90, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 6:
                    $imagenOrientada = imagerotate($imagenOriginal, 270, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 7:
                    imageflip($imagenOriginal, IMG_FLIP_HORIZONTAL);
                    $imagenOrientada = imagerotate($imagenOriginal, 270, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 8:
                    $imagenOrientada = imagerotate($imagenOriginal, 90, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
            }
        }

        // Conserva la proporción y limita el lado mayor a 600 píxeles.
        $anchoOriginal = imagesx($imagenOriginal);
        $altoOriginal = imagesy($imagenOriginal);
        $ladoMaximo = 600;
        $factor = min(1, $ladoMaximo / max($anchoOriginal, $altoOriginal));
        $anchoNuevo = max(1, (int) round($anchoOriginal * $factor));
        $altoNuevo = max(1, (int) round($altoOriginal * $factor));

        $imagenOptimizada = imagecreatetruecolor($anchoNuevo, $altoNuevo);
        // JPG no admite transparencia, por lo que las imágenes transparentes tendrán fondo blanco.
        $colorBlanco = imagecolorallocate($imagenOptimizada, 255, 255, 255);
        imagefill($imagenOptimizada, 0, 0, $colorBlanco);
        imagealphablending($imagenOptimizada, true);
        imagecopyresampled(
            $imagenOptimizada,
            $imagenOriginal,
            0,
            0,
            0,
            0,
            $anchoNuevo,
            $altoNuevo,
            $anchoOriginal,
            $altoOriginal
        );

        // Todas las imágenes de perfil se guardan como JPG para mantener un estándar único.
        $nombreArchivo = bin2hex(random_bytes(16)) . '.jpg';
        $rutaFisica = $directorio . '/' . $nombreArchivo;
        $rutaRelativa = 'uploads/usuarios/' . $nombreArchivo;

        $imagenGuardada = imagejpeg($imagenOptimizada, $rutaFisica, 85);
        imagedestroy($imagenOriginal);
        imagedestroy($imagenOptimizada);

        if (!$imagenGuardada) {
            if (is_file($rutaFisica)) {
                unlink($rutaFisica);
            }

            return [
                'errores' => ['No se pudo optimizar y guardar la imagen de perfil.'],
                'ruta' => null,
            ];
        }

        return [
            'errores' => [],
            'ruta' => $rutaRelativa,
        ];
    }

    // Elimina una imagen anterior que pertenece al almacenamiento de usuarios.
    public function eliminarImagenUsuario(?string $rutaRelativa, string $rootPath): void
    {
        // No intenta eliminar nada cuando el usuario todavía no tiene imagen.
        if ($rutaRelativa === null || $rutaRelativa === '') {
            return;
        }

        // Solo permite eliminar archivos dentro de la carpeta esperada.
        $prefijoPermitido = 'uploads/usuarios/';
        if (!str_starts_with($rutaRelativa, $prefijoPermitido)) {
            return;
        }

        $rutaFisica = $rootPath . '/public/' . $rutaRelativa;
        if (is_file($rutaFisica)) {
            unlink($rutaFisica);
        }
    }

    // Guarda una imagen de local y devuelve su ruta pública relativa.
    public function guardarImagenLocal(?array $archivo, string $rootPath): array
    {
        if ($archivo === null || ($archivo['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return [
                'errores' => [],
                'ruta' => null,
            ];
        }

        if (($archivo['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            return [
                'errores' => ['No se pudo cargar la imagen del local.'],
                'ruta' => null,
            ];
        }

        if ((int) ($archivo['size'] ?? 0) > 2 * 1024 * 1024) {
            return [
                'errores' => ['La imagen del local no puede superar los 2 MB.'],
                'ruta' => null,
            ];
        }

        $informacionArchivo = finfo_open(FILEINFO_MIME_TYPE);
        $tipoMime = $informacionArchivo === false
            ? false
            : finfo_file($informacionArchivo, (string) ($archivo['tmp_name'] ?? ''));

        if ($informacionArchivo !== false) {
            finfo_close($informacionArchivo);
        }

        $extensionesPermitidas = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
        ];

        if (!is_string($tipoMime) || !isset($extensionesPermitidas[$tipoMime])) {
            return [
                'errores' => ['La imagen debe ser JPG o PNG.'],
                'ruta' => null,
            ];
        }

        $dimensiones = @getimagesize((string) ($archivo['tmp_name'] ?? ''));
        if ($dimensiones === false) {
            return [
                'errores' => ['El archivo recibido no contiene una imagen válida.'],
                'ruta' => null,
            ];
        }

        if (
            !function_exists('imagecreatetruecolor')
            || !function_exists('imagecreatefromjpeg')
            || !function_exists('imagecreatefrompng')
            || !function_exists('imagejpeg')
            || !function_exists('imageflip')
            || !function_exists('imagerotate')
        ) {
            return [
                'errores' => ['El servidor no tiene habilitado el procesamiento de imágenes.'],
                'ruta' => null,
            ];
        }

        $directorio = $rootPath . '/public/uploads/locales';

        if (!is_dir($directorio) && !mkdir($directorio, 0755, true) && !is_dir($directorio)) {
            return [
                'errores' => ['No se pudo preparar el almacenamiento de imágenes.'],
                'ruta' => null,
            ];
        }

        $imagenOriginal = match ($tipoMime) {
            'image/jpeg' => @imagecreatefromjpeg((string) $archivo['tmp_name']),
            'image/png' => @imagecreatefrompng((string) $archivo['tmp_name']),
            default => false,
        };

        if ($imagenOriginal === false) {
            return [
                'errores' => ['No se pudo procesar la imagen del local.'],
                'ruta' => null,
            ];
        }

        if ($tipoMime === 'image/jpeg' && function_exists('exif_read_data')) {
            $metadatos = @exif_read_data((string) $archivo['tmp_name']);
            $orientacion = (int) ($metadatos['Orientation'] ?? 1);

            switch ($orientacion) {
                case 2:
                    imageflip($imagenOriginal, IMG_FLIP_HORIZONTAL);
                    break;
                case 3:
                    $imagenOrientada = imagerotate($imagenOriginal, 180, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 4:
                    imageflip($imagenOriginal, IMG_FLIP_VERTICAL);
                    break;
                case 5:
                    imageflip($imagenOriginal, IMG_FLIP_HORIZONTAL);
                    $imagenOrientada = imagerotate($imagenOriginal, 90, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 6:
                    $imagenOrientada = imagerotate($imagenOriginal, 270, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 7:
                    imageflip($imagenOriginal, IMG_FLIP_HORIZONTAL);
                    $imagenOrientada = imagerotate($imagenOriginal, 270, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
                case 8:
                    $imagenOrientada = imagerotate($imagenOriginal, 90, 0);
                    if ($imagenOrientada !== false) {
                        imagedestroy($imagenOriginal);
                        $imagenOriginal = $imagenOrientada;
                    }
                    break;
            }
        }

        $anchoOriginal = imagesx($imagenOriginal);
        $altoOriginal = imagesy($imagenOriginal);
        $ladoMaximo = 900;
        $factor = min(1, $ladoMaximo / max($anchoOriginal, $altoOriginal));
        $anchoNuevo = max(1, (int) round($anchoOriginal * $factor));
        $altoNuevo = max(1, (int) round($altoOriginal * $factor));

        $imagenOptimizada = imagecreatetruecolor($anchoNuevo, $altoNuevo);
        $colorBlanco = imagecolorallocate($imagenOptimizada, 255, 255, 255);
        imagefill($imagenOptimizada, 0, 0, $colorBlanco);
        imagealphablending($imagenOptimizada, true);
        imagecopyresampled(
            $imagenOptimizada,
            $imagenOriginal,
            0,
            0,
            0,
            0,
            $anchoNuevo,
            $altoNuevo,
            $anchoOriginal,
            $altoOriginal
        );

        $nombreArchivo = bin2hex(random_bytes(16)) . '.jpg';
        $rutaFisica = $directorio . '/' . $nombreArchivo;
        $rutaRelativa = 'uploads/locales/' . $nombreArchivo;

        $imagenGuardada = imagejpeg($imagenOptimizada, $rutaFisica, 85);
        imagedestroy($imagenOriginal);
        imagedestroy($imagenOptimizada);

        if (!$imagenGuardada) {
            if (is_file($rutaFisica)) {
                unlink($rutaFisica);
            }

            return [
                'errores' => ['No se pudo optimizar y guardar la imagen del local.'],
                'ruta' => null,
            ];
        }

        return [
            'errores' => [],
            'ruta' => $rutaRelativa,
        ];
    }

    // Elimina una imagen anterior que pertenece al almacenamiento de locales.
    public function eliminarImagenLocal(?string $rutaRelativa, string $rootPath): void
    {
        if ($rutaRelativa === null || $rutaRelativa === '') {
            return;
        }

        $prefijoPermitido = 'uploads/locales/';
        if (!str_starts_with($rutaRelativa, $prefijoPermitido)) {
            return;
        }

        $rutaFisica = $rootPath . '/public/' . $rutaRelativa;
        if (is_file($rutaFisica)) {
            unlink($rutaFisica);
        }
    }
}
