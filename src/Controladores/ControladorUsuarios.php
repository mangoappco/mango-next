<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de controladores de ManGo!.
namespace Mango\Controladores;

// Importa el modelo que contiene las consultas de usuarios.
use Mango\Modelos\ModeloUsuario;

// Coordina las acciones relacionadas con los usuarios.
final class ControladorUsuarios
{
    // Recibe el modelo mediante inyección de dependencias.
    public function __construct(private ModeloUsuario $modeloUsuario)
    {
    }

    // Obtiene los usuarios que la vista debe mostrar.
    public function index(): array
    {
        // Delega la consulta al modelo y devuelve sus resultados.
        return $this->modeloUsuario->buscarTodos();
    }
}