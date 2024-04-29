<?php

    require_once __DIR__ . '/includes/app.php';

    use Controllers\LoginController;
    use MVC\Router;

    $router = new Router();

    $router->get('/login', [LoginController::class, 'login']);
    $router->post('/login', [LoginController::class, 'login']);

    $router->comprobarRutas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola</title>
</head>
<body>
    <form action="/login" method="POST" >
        <input type="hidden" value="juan@example.com" name="correo">
        <input type="hidden" value="password1" name="password">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>