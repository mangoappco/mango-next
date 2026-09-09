<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Indica que esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Representa el punto de coordinación principal de la aplicación.
final class Application
{
    // Ejecuta la aplicación.
    public function run(): void
    {
        // Mensaje temporal mientras construimos el flujo real de la aplicación.
        echo 'ManGo! está funcionando desde Mango\\Core\\Application 🚀';
    }
}