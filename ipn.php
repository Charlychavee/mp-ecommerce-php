<?php

$json_event = file_get_contents('php://input', true);
$json_event_decode = json_decode($json_event);
$logFile = fopen("log-mp-json.txt", 'a') or die("Error creando archivo");
fwrite($logFile, print_r($json_event, true));
fclose($logFile);

$logFile = fopen("log-mp-json-dos.txt", 'a') or die("Error creando archivo");
fwrite($logFile, print_r($json_event, true));
fclose($logFile);

require_once 'vendor/autoload.php'; 
MercadoPago\SDK::setAccessToken('APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948');

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
    var_dump($payment);
    var_dump($plan);
    echo'</pre>';
}

ob_clean();
header("HTTP/1.1 200 OK");
?>
