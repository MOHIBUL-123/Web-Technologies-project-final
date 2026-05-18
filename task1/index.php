<?php




if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}




require_once 'routers.php';

$router = new Router();

require_once 'routes/web.php';

$router->dispatch();