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

    // LISTAR TODOS
    public function index(): void
    {
        $servicios = $this->servicios->obtenerTodos();

        Response::success(
            $servicios,
            'Servicios obtenidos correctamente'
        );
    }

    // CONSULTAR POR ID
    public function show(int $id): void
    {
        $servicio = $this->servicios->obtenerPorId($id);

        if (!$servicio) {
            Response::error('Servicio no encontrado', 404);
            return;
        }

        Response::success(
            $servicio,
            'Servicio encontrado correctamente'
        );
    }

    // CREAR
    public function store(): void
    {
        $datos = Request::body();

        if (
            empty($datos['nombre']) ||
            !isset($datos['precio']) ||
            !isset($datos['duracion_minutos'])
        ) {
            Response::error('Faltan campos obligatorios', 400);
            return;
        }

        if (
            !is_numeric($datos['precio']) ||
            $datos['precio'] <= 0 ||
            !is_numeric($datos['duracion_minutos']) ||
            $datos['duracion_minutos'] <= 0
        ) {
            Response::error('Precio o duración inválidos', 400);
            return;
        }

        $resultado = $this->servicios->crear($datos);

        if (!$resultado) {
            Response::error('Error al crear el servicio', 500);
            return;
        }

        Response::success(
            null,
            'Servicio creado correctamente',
            201
        );
    }

    // ACTUALIZAR
    public function update(int $id): void
    {
        $servicio = $this->servicios->obtenerPorId($id);

        if (!$servicio) {
            Response::error('Servicio no encontrado', 404);
            return;
        }

        $datos = Request::body();

        if (
            empty($datos['nombre']) ||
            !isset($datos['precio']) ||
            !isset($datos['duracion_minutos'])
        ) {
            Response::error('Faltan campos obligatorios', 400);
            return;
        }

        if (
            !is_numeric($datos['precio']) ||
            $datos['precio'] <= 0 ||
            !is_numeric($datos['duracion_minutos']) ||
            $datos['duracion_minutos'] <= 0
        ) {
            Response::error('Precio o duración inválidos', 400);
            return;
        }

        $resultado = $this->servicios->actualizar($id, $datos);

        if (!$resultado) {
            Response::error('Error al actualizar el servicio', 500);
            return;
        }

        Response::success(
            null,
            'Servicio actualizado correctamente'
        );
    }

    // ELIMINAR
    public function destroy(int $id): void
    {
        $servicio = $this->servicios->obtenerPorId($id);

        if (!$servicio) {
            Response::error('Servicio no encontrado', 404);
            return;
        }

        $resultado = $this->servicios->eliminar($id);

        if (!$resultado) {
            Response::error('Error al eliminar el servicio', 500);
            return;
        }

        Response::success(
            null,
            'Servicio eliminado correctamente'
        );
    }
}