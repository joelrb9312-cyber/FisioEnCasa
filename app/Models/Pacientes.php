<?php

namespace App\Models;

use PDO;

class Pacientes
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function obtenerTodos(): array
    {
        $sql = "SELECT * FROM pacientes ORDER BY apellido, nombre";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function obtenerPorId(int $id): array|false
    {
        $sql = "SELECT * FROM pacientes WHERE id_paciente = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO pacientes (nombre, apellido, dni, telefono)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $datos['nombre'],
            $datos['apellido'],
            $datos['dni'],
            $datos['telefono'] ?? null
        ]);
    }

    public function actualizar(int $id, array $datos): bool
    {
        $sql = "UPDATE pacientes
                SET nombre = ?, apellido = ?, dni = ?, telefono = ?
                WHERE id_paciente = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $datos['nombre'],
            $datos['apellido'],
            $datos['dni'],
            $datos['telefono'] ?? null,
            $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM pacientes WHERE id_paciente = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}