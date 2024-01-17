<?php
use DI\Container;
use DI\ContainerBuilder;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../src/definitions.php');
$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

$errorSettings = $container->get('Config')->getErrorSettings();
$errorMiddleware = $app->addErrorMiddleware(
    $errorSettings['displayErrorDetails'], 
    $errorSettings['logErrors'], 
    $errorSettings['logErrorDetails']);
include __DIR__ . '/../routes/api.php';
include __DIR__ . '/../routes/web.php';


$app->run();