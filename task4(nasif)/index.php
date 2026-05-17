<?php

// =========================
// SESSION
// =========================

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}


// =========================
// AUTO FINE GENERATION
// =========================

require_once __DIR__ .
'/helpers/fine_helper.php';

generate_fines();


// =========================
// ROUTER
// =========================

require_once 'routers.php';

$router = new Router();

require_once 'routes/web.php';

$router->dispatch();