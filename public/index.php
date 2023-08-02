<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\ProductoController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);
$router->get('/productos', [ProductoController::class,'index'] );
$router->post('/API/productos/guardar', [ProductoController::class,'guardarAPI'] );
$router->get('/API/productos/buscar', [ProductoController::class,'buscarAPI'] );

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
