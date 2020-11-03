<?php

$json_event = file_get_contents('php://input', true);
$json_event_decode = json_decode($json_event);
$logFile = fopen("log-mp-json.txt", 'a') or die("Error creando archivo");
fwrite($logFile, "\n\n" .  print_r($json_event, true));
fwrite($logFile, "\n\n--------------");
fclose($logFile);

$logFile = fopen("log-mp-json-dos.txt", 'a') or die("Error creando archivo");
fwrite($logFile, "\n\n" .  print_r($json_event_decode, true));
fwrite($logFile, "\n\n--------------");
fclose($logFile);


$logFile = fopen("log-mp-json-get.txt", 'a') or die("Error creando archivo");
fwrite($logFile, "\n\n" .  print_r($_GET, true));
fwrite($logFile, "\n\n--------------");
fclose($logFile);

if(isset($_POST)){
    
    $logFile = fopen("log-mp-json-post.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n\n" .  print_r($_POST, true));
    fwrite($logFile, "\n\n--------------");
    fclose($logFile);
}



require_once 'vendor/autoload.php'; 
MercadoPago\SDK::setAccessToken('APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181');
/*
switch($_POST["type"]) {
    case "payment":
        //$payment = MercadoPago\Payment.find_by_id($_POST["id"]);
        $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);

        $logFile = fopen("log-mp-dos.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, print_r($payment, true));
        fclose($logFile);

        $logFile = fopen("log-mp-tres.txt", 'a') or die("Error creando archivo");
        fwrite($logFile, print_r($merchant_order, true));
        fclose($logFile);
        break;
    case "plan":
        $plan = MercadoPago\Plan.find_by_id($_POST["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription.find_by_id($_POST["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice.find_by_id($_POST["id"]);
        break;

    echo '<pre>'; 
    //var_dump($payment);
    //var_dump($plan);
    echo'</pre>';
}*/

if ($_GET["topic"] == "payment") {
    
    $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
    $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);

    $logFile = fopen("log-mp-tres.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n\n" . print_r($payment, true));
    fwrite($logFile, "\n\n--------------");
    fclose($logFile);

    $logFile = fopen("log-mp-cuatro.txt", 'a') or die("Error creando archivo");
    fwrite($logFile, "\n\n" . print_r($merchant_order, true));
    fwrite($logFile, "\n\n--------------");
    fclose($logFile);
}else{
    
}

ob_clean();
header("HTTP/1.1 200 OK");

/*https://sandbox.mercadopago.com.mx/checkout/v1/redirect/c1ee5242-231d-4d0c-9e8f-13542b6e7164/congrats/approved/?preference-id=592190948-093c7fbc-0df4-46d2-a694-c124dc5b2b8d&p=5f834c3c15fccb03a634d95a44988835

http://charlychavee-mp-ecommerce-php.herokuapp.com/success.php?collection_id=1230862677&collection_status=approved&payment_id=1230862677&status=approved&external_reference=charlychavee2@gmail.com&payment_type=credit_card&merchant_order_id=1929922604&preference_id=592190948-093c7fbc-0df4-46d2-a694-c124dc5b2b8d&site_id=MLM&processing_mode=aggregator&merchant_account_id=null


https://sandbox.mercadopago.com.mx/checkout/v1/redirect/c97f149e-e09e-40cd-8517-4280cb45b361/congrats/approved/?preference-id=592190948-5c424773-6965-41fc-8f7b-3868943a39d2&p=5f834c3c15fccb03a634d95a44988835

https://www.cositec.com.mx/proyectos/ecommerce/success.php?collection_id=1230862731&collection_status=approved&payment_id=1230862731&status=approved&external_reference=charlychavee2@gmail.com&payment_type=credit_card&merchant_order_id=1929962902&preference_id=592190948-5c424773-6965-41fc-8f7b-3868943a39d2&site_id=MLM&processing_mode=aggregator&merchant_account_id=null*/
?>


