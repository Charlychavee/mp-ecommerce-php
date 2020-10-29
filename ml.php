  <?php

    require_once 'vendor/autoload.php'; // You have to require the library from your Composer vendor folder

    MercadoPago\SDK::setAccessToken("APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948"); // Either Production or SandBox AccessToken

    $payer = new MercadoPago\Payer();
      $payer->name = "Lalo";
      $payer->surname = "Landa";
      $payer->email = "charles@hotmail.com";
      $payer->date_created = "2018-06-02T12:58:41.425-04:00";
      $payer->phone = array(
        "area_code" => "52",
        "number" => "5549737300"
      );
      
      $payer->address = array(
        "street_name" => " Insurgentes Sur",
        "street_number" =>  1602,
        "zip_code" => "03940"
      );

    $preference = new MercadoPago\Preference();
      // ...
      $preference->payment_methods = array(
        "excluded_payment_methods" => array(
          array("id" => "amex")
        ),
        "excluded_payment_types" => array(
          array("id" => "atm")
        ),
        "installments" => 6
      );

  ?>