<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Carga el autoloader generado por Composer.
// dirname(__DIR__) sube desde public/ hasta la raíz del proyecto.
require dirname(__DIR__) . '/vendor/autoload.php';

// Crea una instancia de la aplicación principal.
// Composer encuentra esta clase gracias al autoload PSR-4.
$application = new Mango\Core\Application();

// Inicia el flujo principal de la aplicación.
$application->run();