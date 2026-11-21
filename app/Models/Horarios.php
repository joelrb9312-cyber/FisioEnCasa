<?php
namespace App\Models;

use PDO;

class Horarios
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function obtenerTodos(): array
    {
        $sql = "SELECT * FROM horarios";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $sql = "SELECT * FROM horarios WHERE id_horario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO horarios
                (id_fisioterapeuta, fecha, hora_inicio, hora_fin, estado)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $datos['id_fisioterapeuta'],
            $datos['fecha'],
            $datos['hora_inicio'],
            $datos['hora_fin'],
            $datos['estado'] ?? 'Disponible'
        ]);
    }

    public function actualizar(int $id, array $datos): bool
    {
        $sql = "UPDATE horarios
                SET id_fisioterapeuta = ?,
                    fecha = ?,
                    hora_inicio = ?,
                    hora_fin = ?,
                    estado = ?
                WHERE id_horario = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $datos['id_fisioterapeuta'],
            $datos['fecha'],
            $datos['hora_inicio'],
            $datos['hora_fin'],
            $datos['estado'],
            $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM horarios WHERE id_horario = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
