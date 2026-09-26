<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece al núcleo de ManGo!.
namespace Mango\Core;

// Carbon es la librería de manejo de fechas instalada mediante Composer.
use Carbon\Carbon;

// Centraliza el formato de fechas relativas de ManGo!.
final class Fechas
{
    // Convierte una fecha de la base de datos en texto relativo con fecha larga.
    // Devuelve ambos textos en líneas separadas para que la vista las separe.
    public static function relativa(string $fecha): string
    {
        // Interpreta la fecha guardada por MySQL en la zona horaria de Colombia.
        $carbon = Carbon::parse($fecha, 'America/Bogota')->locale('es');

        // Obtiene el texto relativo en mayúscula inicial, por ejemplo "Hace 5 minutos".
        $relativa = ucfirst($carbon->diffForHumans());

        // Obtiene la fecha larga con mes abreviado, por ejemplo "26 de Sep de 2026 a la 1:07 pm".
        $larga = $carbon->format('j \d\e M \d\e Y \a \l\a\s g:i a');

        // Devuelve el texto relativo y la fecha en dos líneas separadas.
        return "{$relativa}\n({$larga})";
    }
}
