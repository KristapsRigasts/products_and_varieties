<?php

use App\Controllers\ProductsController;
use App\Repositories\JsonProductRepository;
use App\Repositories\ProductRepository;
use App\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

$builder = new DI\ContainerBuilder();

$builder->addDefinitions([
    ProductRepository::class => DI\create(JsonProductRepository::class),
]);

$container = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/', [ProductsController::class, 'index']);
    $r->addRoute('GET', '/{id:\d+}', [ProductsController::class, 'show']);
    $r->addRoute('POST', '/{id:\d+}', [ProductsController::class, 'information']);

});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:

        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];

        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $controller = $handler[0];
        $method = $handler[1];

        /** @var View $response */
        $response = ($container->get($controller))->$method($vars);

        $loader = new FilesystemLoader('app/Views');
        $twig = new Environment($loader);

        if($response instanceof View) {
            echo $twig->render($response->getPath() . '.html', $response->getVariables());
        }

        break;
}