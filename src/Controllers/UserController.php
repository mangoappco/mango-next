<?php

// Activa el modo estricto de tipos para detectar valores incorrectos.
declare(strict_types=1);

// Esta clase pertenece a la capa de controladores de ManGo!.
namespace Mango\Controllers;

// Importa el modelo que contiene las consultas de usuarios.
use Mango\Models\UserModel;

// Coordina las acciones relacionadas con los usuarios.
final class UserController
{
    // Recibe el modelo mediante inyección de dependencias.
    public function __construct(private UserModel $userModel)
    {
    }

    // Obtiene los usuarios que la vista debe mostrar.
    public function index(): array
    {
        // Delega la consulta al modelo y devuelve sus resultados.
        return $this->userModel->findAll();
    }
}