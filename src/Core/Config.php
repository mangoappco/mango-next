<?php

// Activa el modo estricto de tipos para detectar usos incorrectos de valores.
declare(strict_types=1);

// Esta clase pertenece al núcleo de la aplicación.
namespace Mango\Core;

// Importa la clase de la librería externa que lee archivos .env.
use Dotenv\Dotenv;

// Centraliza el acceso a la configuración de ManGo!.
final class Config
{
    // Recibe la ruta raíz del proyecto, donde esperamos encontrar el archivo .env.
    public function __construct(string $rootPath)
    {
        // Crea un lector de variables usando la carpeta raíz del proyecto.
        // createImmutable() evita que los valores ya existentes sean sobrescritos.
        // safeLoad() carga .env si existe y no falla si todavía no lo hemos creado.
        Dotenv::createImmutable($rootPath)->safeLoad();
    }

    // Busca una variable de configuración y permite definir un valor alternativo.
    public function get(string $key, ?string $default = null): ?string
    {
        // Si la variable existe en $_ENV, devuelve su valor; si no, devuelve $default.
        return $_ENV[$key] ?? $default;
    }
}
