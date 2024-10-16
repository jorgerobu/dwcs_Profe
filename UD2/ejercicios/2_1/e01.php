<?php
    /**
     * Función que permite calcular el IVA
     *
     * @param float $precio
     * @param integer $iva
     * @return float 
     */
    function calcularIva(float $precio, int $iva=21):float
    {
        return $precio*($iva/100);
    }
?>
<!-- Probamos la función -->
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculo de IVA</title>
 </head>
 <body>
    <?php 
        //Definimos un precio y un IVA para probar la función.
        $precio=150.35;
        $iva=7;
    ?>
    <h1>El iva (<?php echo $iva;?>%) para el precio <?php echo $precio;?> es</h1>
    <h2><?php echo calcularIva($precio,$iva);?></h2>
 </body>
 </html>