<?php

declare(strict_types=1);

namespace App\Database;

use PDO;

final class Connection
{
    public function __construct(private readonly array $env)
    {
    }

    public function pdo(): PDO
    {
        $host = $this->env['DB_HOST'] ?? '127.0.0.1';
        $port = $this->env['DB_PORT'] ?? '3306';
        $database = $this->env['DB_DATABASE'] ?? 'project_service';
        $username = $this->env['DB_USERNAME'] ?? 'root';
        $password = $this->env['DB_PASSWORD'] ?? '';

        return new PDO(
            "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
}
