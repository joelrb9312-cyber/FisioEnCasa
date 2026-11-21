<?php

namespace App\Models;

use PDO;

class Servicios
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // LISTAR TODOS
    public function obtenerTodos(): array
    {
        $sql = "
            SELECT
                id_servicio,
                nombre,
                descripcion,
                precio,
                duracion_minutos
            FROM servicios
            ORDER BY nombre
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // CONSULTAR POR ID
    public function obtenerPorId(int $id): array|false
    {
        $sql = "SELECT * FROM servicios WHERE id_servicio = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    // CREAR
    public function crear(array $datos): bool
    {
        $sql = "
            INSERT INTO servicios
                (nombre, descripcion, precio, duracion_minutos)
            VALUES
                (:nombre, :descripcion, :precio, :duracion_minutos)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'precio' => $datos['precio'],
            'duracion_minutos' => $datos['duracion_minutos']
        ]);
    }

    // ACTUALIZAR
    public function actualizar(int $id, array $datos): bool
    {
        $sql = "
            UPDATE servicios
            SET
                nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio,
                duracion_minutos = :duracion_minutos
            WHERE id_servicio = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'precio' => $datos['precio'],
            'duracion_minutos' => $datos['duracion_minutos']
        ]);
    }

    // ELIMINAR
    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM servicios WHERE id_servicio = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}