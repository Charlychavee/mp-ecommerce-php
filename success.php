


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda e-commerce</title>
    <link href="./assets/app/app.css" rel="stylesheet"/>
</head>
<body>

    <div class="container">
        <div class="notification">
            <div class="card">
                <div class="card-body">
                    <span class="card-title">Pago realizado exitosamente!</span>
                    <span>Collection ID: <?php if (isset($_GET["collection_id"])) echo $_GET["collection_id"] ?></span>
                    <span>External reference: <?php if (isset($_GET["external_reference"])) echo $_GET["external_reference"] ?></span>
                    <span>Payment type: <?php if (isset($_GET["payment_type"])) echo $_GET["payment_type"] ?></span>
                </div>
                <div class="card-footer">
                    <a href="./index.php">Ir al inicio</a>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>