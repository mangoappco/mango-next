<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece al núcleo de la aplicación.
namespace Mango\Core;

// PDO es la extensión de PHP que permite conectarse a bases de datos.
use PDO;

// PDOException representa los errores producidos al conectarse o consultar.
use PDOException;

// RuntimeException representa un error de ejecución que podemos comunicar a la aplicación.
use RuntimeException;

// Centraliza la conexión de ManGo! con la base de datos.
final class Database
{
    // Guarda la conexión después de crearla para no abrirla varias veces en el mismo objeto.
    private ?PDO $connection = null;

    // Recibe Config mediante inyección de dependencias.
    public function __construct(private Config $config)
    {
    }

    // Devuelve una conexión PDO lista para utilizarse.
    public function connection(): PDO
    {
        // Si todavía no existe una conexión, la crea.
        if ($this->connection === null) {
            $this->connection = $this->connect();
        }

        // Devuelve la conexión existente o la que acabamos de crear.
        return $this->connection;
    }

    // Construye la conexión usando los valores del archivo .env.
    private function connect(): PDO
    {
        // Lee el servidor de MySQL y usa 127.0.0.1 como valor predeterminado.
        $host = $this->config->get('DB_HOST', '127.0.0.1');

        // Lee el puerto de MySQL y usa 3306 como valor predeterminado.
        $port = $this->config->get('DB_PORT', '3306');

        // Lee el nombre de la base de datos.
        $database = $this->config->get('DB_DATABASE');

        // Lee el usuario de MySQL.
        $username = $this->config->get('DB_USERNAME');

        // Lee la contraseña y utiliza una cadena vacía si no existe.
        $password = $this->config->get('DB_PASSWORD', '');

        // Construye la dirección que PDO utilizará para conectarse a MySQL.
        $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

        try {
            // Abre la conexión y configura opciones importantes de seguridad y consistencia.
            return new PDO($dsn, $username, $password, [
                // Hace que PDO lance excepciones cuando ocurre un error.
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                // Devuelve cada fila como un array asociativo con nombres de columnas.
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

                // Pide a MySQL que prepare realmente las consultas en lugar de emularlas.
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $exception) {
            // Evita exponer detalles internos de conexión directamente al usuario.
            throw new RuntimeException(
                'No se pudo conectar a la base de datos.',
                0,
                $exception
            );
        }
    }
}
