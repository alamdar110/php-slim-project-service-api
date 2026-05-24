<?php

declare(strict_types=1);

use App\Database\Connection;
use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$root = dirname(__DIR__);
if (file_exists($root . '/.env')) {
    Dotenv\Dotenv::createImmutable($root)->safeLoad();
}

$container = new Container();
$container->set(Connection::class, fn () => new Connection($_ENV));

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware((bool)($_ENV['APP_DEBUG'] ?? false), true, true);

(require $root . '/config/routes.php')($app);

$app->run();
