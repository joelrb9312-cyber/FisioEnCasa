<?php

use App\Controllers\ServiciosController;

$serviciosController = new ServiciosController($db);

// LISTAR TODOS
$router->get(
    '/api/servicios',
    [$serviciosController, 'index']
);

// CONSULTAR POR ID
$router->get(
    '/api/servicios/{id}',
    [$serviciosController, 'show']
);

// CREAR
$router->post(
    '/api/servicios',
    [$serviciosController, 'store']
);

// ACTUALIZAR
$router->put(
    '/api/servicios/{id}',
    [$serviciosController, 'update']
);

// ELIMINAR
$router->delete(
    '/api/servicios/{id}',
    [$serviciosController, 'destroy']
);




use App\Controllers\PacientesController;

$pacientesController = new PacientesController($db);

$router->get('/api/pacientes', [$pacientesController, 'index']);
$router->get('/api/pacientes/{id}', [$pacientesController, 'show']);
$router->post('/api/pacientes', [$pacientesController, 'store']);
$router->put('/api/pacientes/{id}', [$pacientesController, 'update']);
$router->delete('/api/pacientes/{id}', [$pacientesController, 'destroy']);




use App\Controllers\FisioterapeutasController;

$fisioterapeutasController = new FisioterapeutasController($db);

$router->get('/api/fisioterapeutas', [$fisioterapeutasController, 'index']);
$router->get('/api/fisioterapeutas/{id}', [$fisioterapeutasController, 'show']);
$router->post('/api/fisioterapeutas', [$fisioterapeutasController, 'store']);
$router->put('/api/fisioterapeutas/{id}', [$fisioterapeutasController, 'update']);
$router->delete('/api/fisioterapeutas/{id}', [$fisioterapeutasController, 'destroy']);




use App\Controllers\HorariosController;

$horariosController = new HorariosController($db);

$router->get('/api/horarios', [$horariosController, 'index']);
$router->get('/api/horarios/{id}', [$horariosController, 'show']);
$router->post('/api/horarios', [$horariosController, 'store']);
$router->put('/api/horarios/{id}', [$horariosController, 'update']);
$router->delete('/api/horarios/{id}', [$horariosController, 'destroy']);




use App\Controllers\PagosController;

$pagosController = new PagosController($db);

$router->get('/api/pagos', [$pagosController, 'index']);
$router->get('/api/pagos/{id}', [$pagosController, 'show']);
$router->post('/api/pagos', [$pagosController, 'store']);
$router->put('/api/pagos/{id}', [$pagosController, 'update']);
$router->delete('/api/pagos/{id}', [$pagosController, 'destroy']);




use App\Controllers\ReservasController;

$reservasController = new ReservasController($db);

$router->get('/api/reservas', [$reservasController, 'index']);
$router->get('/api/reservas/{id}', [$reservasController, 'show']);
$router->post('/api/reservas', [$reservasController, 'store']);
$router->put('/api/reservas/{id}', [$reservasController, 'update']);
$router->delete('/api/reservas/{id}', [$reservasController, 'destroy']);
