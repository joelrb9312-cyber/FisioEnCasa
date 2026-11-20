<?php

namespace App\Controllers;

use App\Models\Servicios;
use Core\Request;
use Core\Response;
use PDO;

class ServiciosController
{
    private Servicios $servicios;

    public function __construct(PDO $db)
    {
        $this->servicios = new Servicios($db);
    }

    public function index(): void
    {
        $servicios = $this->servicios->obtenerTodos();

        Response::success(
            $servicios,
            'Servicios obtenidos correctamente'
        );
    }
}