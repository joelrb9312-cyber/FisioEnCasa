<?php

namespace App\Models;

use PDO;

class Fisioterapeutas
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function obtenerTodos(): array
    {
        $sql = "SELECT * FROM fisioterapeutas ORDER BY apellido, nombre";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function obtenerPorId(int $id): array|false
    {
        $sql = "SELECT * FROM fisioterapeutas WHERE id_fisioterapeuta = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO fisioterapeutas
                (nombre, apellido, especialidad, telefono)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $datos['nombre'],
            $datos['apellido'],
            $datos['especialidad'],
            $datos['telefono'] ?? null
        ]);
    }

    public function actualizar(int $id, array $datos): bool
    {
        $sql = "UPDATE fisioterapeutas
                SET nombre = ?, apellido = ?, especialidad = ?, telefono = ?
                WHERE id_fisioterapeuta = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $datos['nombre'],
            $datos['apellido'],
            $datos['especialidad'],
            $datos['telefono'] ?? null,
            $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM fisioterapeutas
                WHERE id_fisioterapeuta = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}