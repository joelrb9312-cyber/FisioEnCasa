<?php
namespace App\Controllers;

use App\Models\Reservas;
use Core\Response;
use Core\Request;
use PDO;

class ReservasController
{
    private Reservas $model;

    public function __construct(PDO $db)
    {
        $this->model = new Reservas($db);
    }

    public function index(): void
    {
        $reservas = $this->model->obtenerTodos();
        Response::success($reservas, 'Reservas obtenidas correctamente');
    }

    public function show(int $id): void
    {
        $reserva = $this->model->obtenerPorId($id);

        if (!$reserva) {
            Response::error('Reserva no encontrada', 404);
        }

        Response::success($reserva, 'Reserva encontrada');
    }

    public function store(): void
    {
        $datos = Request::body();

        if (
            empty($datos['id_paciente']) ||
            empty($datos['id_servicio']) ||
            empty($datos['id_horario']) ||
            empty($datos['estado'])
        ) {
            Response::error('Todos los campos son obligatorios');
        }

        $estados = ['Pendiente', 'Confirmada', 'Cancelada'];

        if (!in_array($datos['estado'], $estados)) {
            Response::error('Estado de reserva inválido');
        }

       try {
    if ($this->model->crear($datos)) {
        Response::success(null, 'Reserva registrada correctamente', 201);
    }

    Response::error('Error al registrar la reserva', 500);

} catch (\PDOException $e) {
    Response::error('El paciente, servicio u horario indicado no existe o no está disponible', 400);
}
    }

    public function update(int $id): void
    {
        $reserva = $this->model->obtenerPorId($id);

        if (!$reserva) {
            Response::error('Reserva no encontrada', 404);
        }

        $datos = Request::body();

        if (
            empty($datos['id_paciente']) ||
            empty($datos['id_servicio']) ||
            empty($datos['id_horario']) ||
            empty($datos['estado'])
        ) {
            Response::error('Todos los campos son obligatorios');
        }

        $estados = ['Pendiente', 'Confirmada', 'Cancelada'];

        if (!in_array($datos['estado'], $estados)) {
            Response::error('Estado de reserva inválido');
        }

        if ($this->model->actualizar($id, $datos)) {
            Response::success(null, 'Reserva actualizada correctamente');
        }

        Response::error('Error al actualizar la reserva', 500);
    }

    public function destroy(int $id): void
    {
        $reserva = $this->model->obtenerPorId($id);

        if (!$reserva) {
            Response::error('Reserva no encontrada', 404);
        }

        if ($this->model->eliminar($id)) {
            Response::success(null, 'Reserva eliminada correctamente');
        }

        Response::error('Error al eliminar la reserva', 500);
    }
}
