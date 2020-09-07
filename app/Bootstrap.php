<?php

declare(strict_types = 1);

namespace App;

require_once __DIR__.'/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'development';

/**
*  Register the error handler
*/

$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
}
else{
    $whoops->pushHandler(function($e){
    	echo 'Todo: Friendly error page and send an email to the developer';
    });
}

$whoops->register();

$injector = include('Dependencies.php');

/*
$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');
*/

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$routeDefinitionCallback = function(\FastRoute\RouteCollector $r){
    $routes = include('Routes.php');
    foreach($routes as $route){
        $r->addRoute(...$route);
    }
};
    
$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

switch($routeInfo[0]){
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response = new \Symfony\Component\HttpFoundation\Response(
            'Not found',
            404
        );
    break;
    
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new \Symfony\Component\HttpFoundation\Response(
            'Method not allowed',
            405
        );
     break;
     
    case \FastRoute\Dispatcher::FOUND:
        [$controllerName, $method] = explode('#', $routeInfo[1]);
        $vars = $routeInfo[2];
        $injector = include('Dependencies.php');
        $controller = $injector->make($controllerName);
        $response = $controller->$method($request, $vars);
    break;
        
   /*
        $handler = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];
        $class = $injector->make($handler);
        $class->$method($vars);
    break;
    */
}


/*
foreach($response->getHeaders() as $header){
	header($header, false);
}
echo $response->getContent();
*/

if (!$response instanceof \Symfony\Component\HttpFoundation\Response) {
    throw new \Exception('Controller methods must return a Response object');
}

$response->prepare($request);
$response->send();
