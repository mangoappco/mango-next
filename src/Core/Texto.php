<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Centraliza los textos de la aplicación para que las vistas solo muestren.
final class Texto
{
    // Convierte el estado de un registro en su etiqueta visible.
    public static function estado(bool $activo): string
    {
        return $activo ? 'Activo' : 'Inactivo';
    }
}
