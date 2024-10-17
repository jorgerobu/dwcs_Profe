<?php

/**
 * Devuelve el volumen de un cilindro.
 *
 * @param float $radio
 * @param float $altura
 * @return float
 */
function volumenCilindro(float $radio, float $altura): float
{
    return $radio**2 *$altura;
}

//Obtenemos los valores enviados por el cliente.
$r = $_GET['radio'] ?: 0;
$h = $_GET['altura'] ?: 0;

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volumen cilindro</title>
    <!-- BONUS: css para dibujar el cilindro. -->
    <style>
   

    /* Contenedor del cilindro */
    .cilindro {
      margin-top: 50px;
      margin-bottom: 50px;
      margin-left: auto;
      margin-right: auto;
      position: relative;
      height: <?php echo $h*10;?>px; /*Le damos la altura del cilindro escalada por 10*/
      width:<?php echo $r*20;?>px; /*Le damos el ancho del cilindro (2 veces el radio) escalado por 10*/
      background: linear-gradient(to bottom, #fabf87, #ffba77);
      border-radius: 1%;
      box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.75);
      
    }

    /* Tapa superior del cilindro */
    .cilindro::before {
      text-align: left;
      content: '<?php echo str_repeat("--",intval($r)). $r.'m'; ?>'; /*Esto es para representar el radio de la base. El método str_repeat repite una cadena el numero de veces indicado. */
      position: absolute;
      top: -14px;
      left: 0;
      width: 100%;
      height: 30px;
      background: radial-gradient(circle at center, #f79731, #ffe69c);
      border-radius: 50%;
    }

    /* Tapa inferior del cilindro */
    .cilindro::after {
      content: '';
      position: absolute;
      bottom: -14px;
      left: 0;
      width: 100%;
      height: 30px;
      background: radial-gradient(circle at center, #d7af88, #db9f5d);
      border-radius: 50%;
    }

    body{
        padding: 30px;
        text-align: center;
    }
  </style>
    
</head>

<body>
    <h1>Calculadora de cilindros</h1>
    <form action="" method="get">
        <label for="radio">Radio</label>
        <input  type="text" name="radio" value=<?php echo $r; ?>> 
        <label for="altura">Altura</label>
        <input  type="text" name="altura" value=<?php echo $h; ?>> 

        <button type="submit">Volumen</button>

        <?php
        if ($r!=0 && $h!=0) {
           echo '<div class="cilindro"></div>';
           echo '<strong>Volumen: '.volumenCilindro($r,$h).' m3</strong>';
        }
        ?>
    </form>
</body>

</html>