<?php

namespace Config;

use PDO;
use PDOException;

class Database
{
    public function connect(): PDO
    {
        $env = parse_ini_file(__DIR__ . '/.env');

        $host = $env['DB_HOST'];
        $database = $env['DB_NAME'];
        $username = $env['DB_USER'];
        $password = $env['DB_PASS'];

        try {
            $dsn = "mysql:host={$host};dbname={$database};charset=utf8mb4";

            $connection = new PDO($dsn, $username, $password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $connection;

        } catch (PDOException $e) {
            throw new PDOException('Error al conectar con la base de datos.');
        }
    }
}