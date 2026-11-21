<?php
namespace App\Models;

use PDO;

class Pagos
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function obtenerTodos(): array
    {
        $sql = "SELECT * FROM pagos";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $sql = "SELECT * FROM pagos WHERE id_pago = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): bool
    {
        $sql = "INSERT INTO pagos (id_reserva, monto, metodo_pago)
                VALUES (:id_reserva, :monto, :metodo_pago)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_reserva' => $datos['id_reserva'],
            'monto' => $datos['monto'],
            'metodo_pago' => $datos['metodo_pago']
        ]);
    }

    public function actualizar(int $id, array $datos): bool
    {
        $sql = "UPDATE pagos
                SET id_reserva = :id_reserva,
                    monto = :monto,
                    metodo_pago = :metodo_pago
                WHERE id_pago = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id_reserva' => $datos['id_reserva'],
            'monto' => $datos['monto'],
            'metodo_pago' => $datos['metodo_pago'],
            'id' => $id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM pagos WHERE id_pago = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
