<?php

$valor = "ninguna";

if(isset($_COOKIE['acceso'])){
    if($_COOKIE['acceso']==$valor){
        $valor = 1;
    }else{
        $valor = intval($_COOKIE['acceso']) + 1;
    }
}

setcookie("acceso",$valor,time()+120);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hola cookie</h1>
    <h2>
        <?php
            echo "Has accedido $valor veces";
        ?>
    </h2>
    
</body>
</html>