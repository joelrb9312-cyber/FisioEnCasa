<?php

namespace App\Controllers;

use App\Models\Pacientes;
use Core\Response;
use Core\Request;

class PacientesController
{
    private Pacientes $pacientes;

    public function __construct($db)
    {
        $this->pacientes = new Pacientes($db);
    }

    public function index(): void
    {
        $pacientes = $this->pacientes->obtenerTodos();
        Response::success($pacientes, 'Lista de pacientes');
    }

    public function show(int $id): void
    {
        $paciente = $this->pacientes->obtenerPorId($id);

        if (!$paciente) {
            Response::error('Paciente no encontrado', 404);
            return;
        }

        Response::success($paciente, 'Paciente encontrado');
    }

    public function store(): void
    {
        $datos = Request::body();

        if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['dni'])) {
            Response::error('Nombre, apellido y DNI son obligatorios', 400);
            return;
        }

        if (!preg_match('/^[0-9]{8}$/', $datos['dni'])) {
            Response::error('El DNI debe contener exactamente 8 números', 400);
            return;
        }

        if ($this->pacientes->crear($datos)) {
            Response::success(null, 'Paciente creado correctamente', 201);
        } else {
            Response::error('No se pudo crear el paciente', 500);
        }
    }

    public function update(int $id): void
    {
        $datos = Request::body();

        if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['dni'])) {
            Response::error('Nombre, apellido y DNI son obligatorios', 400);
            return;
        }

        if (!preg_match('/^[0-9]{8}$/', $datos['dni'])) {
            Response::error('El DNI debe contener exactamente 8 números', 400);
            return;
        }

        if (!$this->pacientes->obtenerPorId($id)) {
            Response::error('Paciente no encontrado', 404);
            return;
        }

        if ($this->pacientes->actualizar($id, $datos)) {
            Response::success(null, 'Paciente actualizado correctamente');
        } else {
            Response::error('No se pudo actualizar el paciente', 500);
        }
    }

    public function destroy(int $id): void
    {
        if (!$this->pacientes->obtenerPorId($id)) {
            Response::error('Paciente no encontrado', 404);
            return;
        }

        if ($this->pacientes->eliminar($id)) {
            Response::success(null, 'Paciente eliminado correctamente');
        } else {
            Response::error('No se pudo eliminar el paciente', 500);
        }
    }
}