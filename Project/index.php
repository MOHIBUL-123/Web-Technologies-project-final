<?php




if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}




require_once __DIR__ .
'/helpers/fine_helper.php';

generate_fines();




require_once 'routers.php';

$router = new Router();

require_once 'routes/web.php';

$router->dispatch();