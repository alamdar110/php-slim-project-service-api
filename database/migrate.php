<?php

declare(strict_types=1);

use App\Database\Connection;

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(dirname(__DIR__))->safeLoad();
$pdo = (new Connection($_ENV))->pdo();

$sql = file_get_contents(__DIR__ . '/migrations/001_create_project_service_tables.sql');
$pdo->exec($sql);

echo "Migrations completed.\n";
