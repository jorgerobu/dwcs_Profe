<?php

/**
 * Devuelve el sumatorio de hasta 5 números.
 *
 * @param integer $n1
 * @param integer $n2
 * @param integer $n3
 * @param integer $n4
 * @param integer $n5
 * @return float
 */
function sumatorio(float $n1 = 0, float $n2 = 0, float $n3 = 0, float $n4 = 0, float $n5 = 0): float
{
    return $n1 + $n2 + $n3 + $n4 + $n5;
}

//Obtenemos los valores enviados por el cliente.
$n1 = $_GET['n1'] ?: 0;
$n2 = $_GET['n2'] ?: 0;
$n3 = $_GET['n3'] ?: 0;
$n4 = $_GET['n4'] ?: 0;
$n5 = $_GET['n5'] ?: 0;
?>

<!-- Para probar este ejemplo pediremos al usuario que introduzca los números en un formulario -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumatorio</title>
    <style>
        .numeros{
            width: 40px;
        }
    </style>
</head>

<body>
    <form action="" method="get">

        <input class="numeros" type="text" name="n1" value=<?php echo $n1; ?>> +
        <input class="numeros" type="text" name="n2" value=<?php echo $n2; ?>> +
        <input class="numeros" type="text" name="n3" value=<?php echo $n3; ?>> +
        <input class="numeros" type="text" name="n4" value=<?php echo $n4; ?>> +
        <input class="numeros" type="text" name="n5" value=<?php echo $n5; ?>>
        <button type="submit">Sumar</button>

        <?php
        if (isset($_GET['n1']) || isset($_GET['n2']) || isset($_GET['n3']) || isset($_GET['n4']) || isset($_GET['n5'])) {
            echo '<h2>Sumatorio: ' . sumatorio($n1, $n2, $n3, $n4, $n5) . '</h2>';
        }
        ?>
    </form>
</body>

</html>