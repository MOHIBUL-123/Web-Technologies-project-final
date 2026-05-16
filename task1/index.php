<?php

// =========================
// SESSION
// =========================

if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}


// =========================
// ROUTER
// =========================

require_once 'routers.php';

$router = new Router();

require_once 'routes/web.php';

$router->dispatch();