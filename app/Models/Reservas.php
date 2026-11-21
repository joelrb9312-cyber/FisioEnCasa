<?php
namespace App\Models;

use PDO;

class Reservas
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function obtenerTodos(): array
    {
        $sql = "SELECT * FROM reservas";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $sql = "SELECT * FROM reservas WHERE id_reserva = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO reservas (id_paciente, id_servicio, id_horario, estado)
                VALUES (:id_paciente, :id_servicio, :id_horario, :estado)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_paciente' => $datos['id_paciente'],
            'id_servicio' => $datos['id_servicio'],
            'id_horario' => $datos['id_horario'],
            'estado' => $datos['estado']
        ]);
    }

    public function actualizar(int $id, array $datos): bool
    {
        $sql = "UPDATE reservas
                SET id_paciente = :id_paciente,
                    id_servicio = :id_servicio,
                    id_horario = :id_horario,
                    estado = :estado
                WHERE id_reserva = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_paciente' => $datos['id_paciente'],
            'id_servicio' => $datos['id_servicio'],
            'id_horario' => $datos['id_horario'],
            'estado' => $datos['estado'],
            'id' => $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM reservas WHERE id_reserva = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
