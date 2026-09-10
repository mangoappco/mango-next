<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Carga el autoloader generado por Composer.
// dirname(__DIR__) sube desde public/ hasta la raíz del proyecto.
require dirname(__DIR__) . '/vendor/autoload.php';

// Crea una instancia de la aplicación principal.
// Composer encuentra esta clase gracias al autoload PSR-4.
$application = new Mango\Core\Application();

try {
	// Inicia el flujo principal de la aplicación.
	$application->run();
} catch (Throwable $exception) {
	// Registra los detalles técnicos en el servidor, no en la pantalla del usuario.
	error_log($exception->__toString());

	// Informa al navegador que ocurrió un error interno.
	http_response_code(500);

	// Carga una vista clara para comunicar el error sin exponer información sensible.
	require dirname(__DIR__) . '/src/Vistas/errores/500.php';
}