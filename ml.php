  <?php

    require __DIR__ .  '/vendor/autoload.php';  

    MercadoPago\SDK::setAccessToken("APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948"); // Either Production or SandBox AccessToken
    MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

    
    $preference = new MercadoPago\Preference();
        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();

        $item->id =1234;
        $item->description =  "Dispositivo móvil de Tienda e-commerce";
        $item->title = $_POST['title'] ;
        $item->quantity = 1;
        $item->unit_price = $_POST['price'];
        $item->picture_url = __DIR__ ."/" . $_POST['img'];
        $preference->items = array($item);

        $preference->payment_methods = array(
            "excluded_payment_methods" => array(
              array("id" => "amex")
            ),
            "excluded_payment_types" => array(
              array("id" => "atm")
            ),
            "installments" => 6
          );

        $payer = new MercadoPago\Payer();
        $payer->name = "Lalo";
        $payer->surname = "Landa";
        $payer->email = "test_user_58295862@testuser.com";
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

        

        /*$preference->back_urls = array(
            "success" => "/success",
            "failure" => "/failure",
            "pending" => "/pending"
        );*/

        //$preference->auto_return = "approved";
        $preference->external_reference = "charlychavee2@gmail.com";
        //$preference->notification_url = "/webhook.php";
        //$preference->collector_id = "592190948";
        //$preference->collector_id = "592190948";


        $preference->save();

         /*curl -X GET "https://api.mercadopago.com/v1/customers/8058997674329963/cards" -H "Authorization: Bearer APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948"
          
           curl -X GET "https://api.mercadopago.com/v1/customers/search?first_name=Lalo" -H "Authorization: Bearer APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948" 

            curl -X POST "https://api.mercadopago.com/v1/customers" -H "Authorization: Bearer APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948" -d "{'email': 'bruno@gmail.com','first_name': 'Bruce','last_name': 'Wayne','phone': {'area_code': '023','number': '12345678'},'identification': { 'type': 'DNI','number': '12345678'},'address': {'zip_code': 'SG1 2AX','street_name': 'Old Knebworth Ln'},'description': 'Lorem Ipsum'}" 

             curl -X GET "https://api.mercadopago.com/merchant_orders?status=&preference_id=&application_id=&payer_id=&sponsor_id=&external_reference=&site_id=&marketplace=&date_created_from=&date_created_to=&last_updated_from=&last_updated_to=&items=&limit=&offset=&order_status=" -H "Authorization: Bearer APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948"*/
  ?>