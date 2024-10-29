<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación</title>
</head>
<body>
    <h1>
    <?php
        include("e1_functions.php");
        if(isset($_POST['nic']) && isset($_POST['pass'])&&comprobar_usuario($_POST['nic'],$_POST['pass'])){
            echo "Acceso concedido.";
        }else{
            echo "Acceso denegado.";
        }

    ?>
    </h1>
    
</body>
</html>