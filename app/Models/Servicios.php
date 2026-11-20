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

    public function obtenerTodos(): array
    {
        $sql = "
            SELECT
                id_servicio,
                nombre,
                descripcion,
                precio
            FROM servicios
            ORDER BY nombre
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}