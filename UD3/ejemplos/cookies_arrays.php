<?php
    $array = array('manzana','pera','cereza');
    if(isset($_COOKIE['frutas'])){
        // $array = explode(":",$_COOKIE['frutas']);
        $array = json_decode($_COOKIE['frutas'],true);

    }
    
    // $array_string = implode(":",$array);
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