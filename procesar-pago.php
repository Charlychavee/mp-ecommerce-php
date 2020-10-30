<?php

require './vendor/autoload.php';

/* 
información a enviar si no se ha pasado los campos requeridos. 
Campos requeridos: product_name, product_price, product_amount
*/
$data = ["status" => 400, "msg" => 'campos insuficientes', "preferencia" => null];

// validamos que nos hayan enviado los campos requeridos
if (isset($_POST["product_name"]) && isset($_POST["product_price"]) && isset($_POST["product_amount"])) {


    /* get data from .env */
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    /* access keys */
    $access_token = $_ENV['ACCESS_TOKEN'];
    $public_key = $_ENV['PUBLIC_KEY'];
    $collector_id = $_ENV['COLLECTOR_ID'];
    $integrator_id = $_ENV['INTEGRATOR_ID'];

    /* seller user data */
    $user_id = $_ENV['USER_ID'];
    $user_email = $_ENV['USER_EMAIL'];
    $user_password = $_ENV['USER_PASSWORD'];

    // Agrega credenciales
    MercadoPago\SDK::setAccessToken($access_token);

    // seteamos el integrator-id
    MercadoPago\SDK::setIntegratorId($integrator_id);

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->id = '1234';
    $item->title = $_POST["product_name"];
    $item->description = "Dispositivo móvil de Tienda e-commerce";
    $item->quantity = $_POST["product_amount"];
    $item->unit_price = $_POST["product_price"];
    // agregamos el item a la preferencia
    $preference->items = array($item);

    // agregamos información del pagador
    $payer = new MercadoPago\Payer();
    $payer->name = "Lalo";
    $payer->surname = "Landa";
    $payer->email = $user_email;
    $payer->phone = array(
        "area_code" => "52",
        "number" => "5549737300"
    );
    $payer->address = array(
        "street_name" => "Insurgentes Sur",
        "street_number" => 1602,
        "zip_code" => "03940"
    );
    // agregamos el pagador a la preferencia
    $preference->payer = $payer;

    // seteamos los medios de pago aceptados
    /* la documentacion propone excluir el metodo de pago "atm", pero el mismo no se obtuvo al hacer un get a https://api.mercadopago.com/v1/payment_methods?public_key=
        igualmente agregamos la exclusion para seguir la documentacion
    */
    $preference->payment_methods = array(
        "excluded_payment_methods" => array(
            array("id" => "amex") 
        ),
        "excluded_payment_methods" => array(
            array("id" => "atm") 
        ),
        "installments" => 6 // define la cantidad maxima de cuotas a permitir
    );

    // agregamos el correo en external_reference, según lo indicado en la guia
    $preference->external_reference = "charlychavee2@gmail.com";
    // seteamos el autoretorno tras pago aprobado
    $preference->auto_return = "approved";
    $preference->back_urls = array(
        "success" => "./success.php",
        "failure" => "./failure.php",
        "pending" => "./pending.php"
    );

    // seteamos el endpoint para las notificaciones de estados de pago
    $preference->notification_url = "./notifications.php?source_news=webhooks";

    // registramos la preferencia
    $preference->save();

    // seteamos el objeto de retorno
    $data = ["status" => 200, "msg" => 'exito, redirigiendo a mercado pago!', "preferencia" => $preference];

    // respuesta
    echo json_encode($data);
} else {
    // respuesta
    echo json_encode($data);
}
