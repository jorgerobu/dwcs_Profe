<?php
    $array = array('manzana','pera','cereza');
    if(isset($_COOKIE['frutas'])){
        //Así lo haríamos directamente con el array.
        // $array = explode(":",$_COOKIE['frutas']);

        //De esta forma pasamos los datos a json. Esto también podemos hacerlo con objetos.
        $array = json_decode($_COOKIE['frutas'],true);

    }
    //Asi lo haríamos directamente con el array.
    // $array_string = implode(":",$array);

    //De esta forma pasamos los datos a json. Esto también podemos hacerlo con objetos.
    $array_string = json_encode($array);


    setcookie("frutas",$array_string);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Almacenando varios valores</h1>
    <ul>
        <?php
            foreach($array as $f){
                echo '<li>'.$f.'</li>';
            }
        ?>

    </ul>
</body>
</html>