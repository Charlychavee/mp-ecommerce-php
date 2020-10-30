<?php

require_once "./db-handler.php";

// obtenemos el contenido del request
$notification = file_get_contents('php://input');

//$dbHandler = new DbHandler();

//$respuesta = $dbHandler->insertNotification($notification);

$dbHandler = DbHandler::getInstancia();
$respuesta = $dbHandler->insertNotification($notification);

if($respuesta["status"] == 400) http_response_code(400);

// devolvemos una respuesta con estado 200 al cliente
http_response_code(200);

var_dump(json_encode($respuesta));