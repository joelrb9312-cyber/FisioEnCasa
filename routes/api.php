<?php

use App\Controllers\ServiciosController;

$serviciosController = new ServiciosController($db);

$router->get(
    '/api/servicios',
    [$serviciosController, 'index']
);