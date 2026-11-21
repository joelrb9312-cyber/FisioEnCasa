<?php
namespace App\Controllers;

use App\Models\Pagos;
use Core\Response;
use Core\Request;
use PDO;

class PagosController
{
    private Pagos $model;

    public function __construct(PDO $db)
    {
        $this->model = new Pagos($db);
    }

    public function index(): void
    {
        $pagos = $this->model->obtenerTodos();
        Response::success($pagos, 'Pagos obtenidos correctamente');
    }

    public function show(int $id): void
    {
        $pago = $this->model->obtenerPorId($id);

        if (!$pago) {
            Response::error('Pago no encontrado', 404);
        }

        Response::success($pago, 'Pago encontrado');
    }

    public function store(): void
    {
        $datos = Request::body();

        if (
            empty($datos['id_reserva']) ||
            !isset($datos['monto']) ||
            empty($datos['metodo_pago'])
        ) {
            Response::error('Todos los campos son obligatorios');
        }

        if (!is_numeric($datos['monto']) || $datos['monto'] <= 0) {
            Response::error('El monto debe ser mayor a cero');
        }

        $metodos = ['Efectivo', 'Yape', 'Plin', 'Tarjeta'];

        if (!in_array($datos['metodo_pago'], $metodos)) {
            Response::error('Método de pago inválido');
        }

        try {
    if ($this->model->crear($datos)) {
        Response::success(null, 'Pago registrado correctamente', 201);
    }

    Response::error('Error al registrar el pago', 500);

} catch (\PDOException $e) {
    Response::error('La reserva indicada no existe', 400);
}
    }

    public function update(int $id): void
    {
        $pago = $this->model->obtenerPorId($id);

        if (!$pago) {
            Response::error('Pago no encontrado', 404);
        }

        $datos = Request::body();

        if (
            empty($datos['id_reserva']) ||
            !isset($datos['monto']) ||
            empty($datos['metodo_pago'])
        ) {
            Response::error('Todos los campos son obligatorios');
        }

        if (!is_numeric($datos['monto']) || $datos['monto'] <= 0) {
            Response::error('El monto debe ser mayor a cero');
        }

        $metodos = ['Efectivo', 'Yape', 'Plin', 'Tarjeta'];

        if (!in_array($datos['metodo_pago'], $metodos)) {
            Response::error('Método de pago inválido');
        }

        if ($this->model->actualizar($id, $datos)) {
            Response::success(null, 'Pago actualizado correctamente');
        }

        Response::error('Error al actualizar el pago', 500);
    }

    public function destroy(int $id): void
    {
        $pago = $this->model->obtenerPorId($id);

        if (!$pago) {
            Response::error('Pago no encontrado', 404);
        }

        if ($this->model->eliminar($id)) {
            Response::success(null, 'Pago eliminado correctamente');
        }

        Response::error('Error al eliminar el pago', 500);
    }
}
