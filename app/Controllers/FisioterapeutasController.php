<?php

namespace App\Controllers;

use App\Models\Fisioterapeutas;
use Core\Response;
use Core\Request;

class FisioterapeutasController
{
    private Fisioterapeutas $fisioterapeutas;

    public function __construct($db)
    {
        $this->fisioterapeutas = new Fisioterapeutas($db);
    }

    public function index(): void
    {
        $fisioterapeutas = $this->fisioterapeutas->obtenerTodos();
        Response::success($fisioterapeutas, 'Lista de fisioterapeutas');
    }

    public function show(int $id): void
    {
        $fisioterapeuta = $this->fisioterapeutas->obtenerPorId($id);

        if (!$fisioterapeuta) {
            Response::error('Fisioterapeuta no encontrado', 404);
            return;
        }

        Response::success($fisioterapeuta, 'Fisioterapeuta encontrado');
    }

    public function store(): void
    {
        $datos = Request::body();

        if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['especialidad'])) {
            Response::error('Nombre, apellido y especialidad son obligatorios', 400);
            return;
        }

        if ($this->fisioterapeutas->crear($datos)) {
            Response::success(null, 'Fisioterapeuta creado correctamente', 201);
        } else {
            Response::error('No se pudo crear el fisioterapeuta', 500);
        }
    }

    public function update(int $id): void
    {
        $datos = Request::body();

        if (empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['especialidad'])) {
            Response::error('Nombre, apellido y especialidad son obligatorios', 400);
            return;
        }

        if (!$this->fisioterapeutas->obtenerPorId($id)) {
            Response::error('Fisioterapeuta no encontrado', 404);
            return;
        }

        if ($this->fisioterapeutas->actualizar($id, $datos)) {
            Response::success(null, 'Fisioterapeuta actualizado correctamente');
        } else {
            Response::error('No se pudo actualizar el fisioterapeuta', 500);
        }
    }

    public function destroy(int $id): void
    {
        if (!$this->fisioterapeutas->obtenerPorId($id)) {
            Response::error('Fisioterapeuta no encontrado', 404);
            return;
        }

        if ($this->fisioterapeutas->eliminar($id)) {
            Response::success(null, 'Fisioterapeuta eliminado correctamente');
        } else {
            Response::error('No se pudo eliminar el fisioterapeuta', 500);
        }
    }
}