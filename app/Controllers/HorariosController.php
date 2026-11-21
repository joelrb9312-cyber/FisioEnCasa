<?php

namespace App\Controllers;

use App\Models\Horarios;
use Core\Response;
use Core\Request;
use PDO;

class HorariosController
{
    private Horarios $horarios;

    public function __construct(PDO $db)
    {
        $this->horarios = new Horarios($db);
    }

    public function index(): void
    {
        $datos = $this->horarios->obtenerTodos();
        Response::success($datos, 'Horarios obtenidos correctamente');
    }

    public function show(int $id): void
    {
        $horario = $this->horarios->obtenerPorId($id);

        if (!$horario) {
            Response::error('Horario no encontrado', 404);
        }

        Response::success($horario, 'Horario encontrado');
    }

    public function store(): void
    {
        $datos = Request::body();

        if (
            empty($datos['id_fisioterapeuta']) ||
            empty($datos['fecha']) ||
            empty($datos['hora_inicio']) ||
            empty($datos['hora_fin'])
        ) {
            Response::error('Todos los campos obligatorios deben completarse', 400);
        }

        if ($datos['hora_fin'] <= $datos['hora_inicio']) {
            Response::error('La hora de fin debe ser posterior a la hora de inicio', 400);
        }

        $datos['estado'] = $datos['estado'] ?? 'Disponible';

        if (!in_array($datos['estado'], ['Disponible', 'Ocupado'])) {
            Response::error('Estado inválido', 400);
        }

        if ($this->horarios->crear($datos)) {
            Response::success(null, 'Horario creado correctamente', 201);
        }

        Response::error('Error al crear el horario', 500);
    }

    public function update(int $id): void
    {
        $datos = Request::body();

        if (
            empty($datos['id_fisioterapeuta']) ||
            empty($datos['fecha']) ||
            empty($datos['hora_inicio']) ||
            empty($datos['hora_fin']) ||
            empty($datos['estado'])
        ) {
            Response::error('Todos los campos son obligatorios', 400);
        }

        if ($datos['hora_fin'] <= $datos['hora_inicio']) {
            Response::error('La hora de fin debe ser posterior a la hora de inicio', 400);
        }

        if (!in_array($datos['estado'], ['Disponible', 'Ocupado'])) {
            Response::error('Estado inválido', 400);
        }

        if (!$this->horarios->obtenerPorId($id)) {
            Response::error('Horario no encontrado', 404);
        }

        if ($this->horarios->actualizar($id, $datos)) {
            Response::success(null, 'Horario actualizado correctamente');
        }

        Response::error('Error al actualizar el horario', 500);
    }

    public function destroy(int $id): void
    {
        if (!$this->horarios->obtenerPorId($id)) {
            Response::error('Horario no encontrado', 404);
        }

        if ($this->horarios->eliminar($id)) {
            Response::success(null, 'Horario eliminado correctamente');
        }

        Response::error('Error al eliminar el horario', 500);
    }
}
