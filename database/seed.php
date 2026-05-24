<?php

declare(strict_types=1);

use App\Database\Connection;

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(dirname(__DIR__))->safeLoad();
$pdo = (new Connection($_ENV))->pdo();

$pdo->exec("INSERT INTO projects (name, customer_name, status) VALUES ('Demo Workflow Rollout', 'Demo Operations Ltd', 'active')");

echo "Seed data inserted.\n";
