<?php
require_once 'vendor/autoload.php';

define('ACCESS_TOKEN', 'APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948');
define('PUBLIC_KEY', 'APP_USR-158fff95-0bdf-4149-9abc-c8b0ac7f289f');
define('INTEGRATOR_ID', 'dev_24c65fb163bf11ea96500242ac130004');

define('MAX_CUOTAS', 6);
define('TARJETAS_EXCLUIDAS', [
    ['id' => 'amex'],
]);
define('MEDIOS_DE_PAGO_EXCLUIDOS', [
    ['id' => 'atm'],
]);

define('BASE_URL', dirname('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']));

MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
MercadoPago\SDK::setPublicKey(PUBLIC_KEY);
MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);
