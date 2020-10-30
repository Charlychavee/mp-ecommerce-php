<?php

class DbHandler {

    private static $instancia = null;
    private $db = null;

    function __construct(){
        require_once "./vendor/autoload.php";

        /* get data from .env */
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // set db_string value
        $db_string = $_ENV['DB_STRING'];

        $client = new MongoDB\Client($db_string);

        $this->db = $client->mp_ecommerce;
    }

    public static function getInstancia(){
        if(self::$instancia == null){
            self::$instancia = new DbHandler();
        }
        return self::$instancia;
    }

    public function insertNotification($notification = '{"test": "sin datos"}'){
        try {
            $collection = $this->db->notifications;
            
            // agregamos la notificacion
            $respuestaDB = $collection->insertOne(json_decode($notification, true));

            $data = ["status" => 200, "msg" => "exito", "insertedDocuments" => $respuestaDB->getInsertedCount(), "oid" => $respuestaDB->getInsertedId()];

            return $data;
        
        } catch (Exception $e) {
            $data = ["status" => 400, "msg" => "error", "insertedDocuments" => 0, "oid" => ""];
           // echo 'Exception: ',  $e->getMessage(), "\n";
           return $data;
        }
    }

}

/* require_once "./vendor/autoload.php";


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$db_string = $_ENV['DB_STRING'];

$client = new MongoDB\Client($db_string);

$db = $client->mp_ecommerce;

try {
    $collection = $db->notifications;

    $insertOneResult = $collection->insertOne(['_id' => 1, 'name' => 'Alice']);

    printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

    var_dump($insertOneResult->getInsertedId());

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}


public function insertNotification(){

} */