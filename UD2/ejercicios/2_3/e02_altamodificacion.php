<?php
include("e02_functions.php");
//Si nos entra un id significa que entramos por modificar.
$modificar = isset($_GET["id"]);
//Obtengo los datos que me puedan enviar por post.
$nombre = $_POST['nombre'] ?: null;
$plataforma = $_POST['plataforma'] ?: null;
$anio = $_POST['anio'] ?: null;
$genero = $_POST['genero'] ?: null; //Me puede llegar como una cadena vacía. En este caso lo cambio a null.

//Si nos entran los atributos significa que los tenemos que refrescar en la BD.
if (isset($nombre) && isset($plataforma) && isset($anio)) {
    //Creamos el objeto con los datos. Presta atención a que este objeto no tiene id.
    $vj = new Videojuego($nombre, $plataforma, $genero, $anio);
    if ($modificar) { //Es una modificación
        //Establecemos el id del objeto
        $vj->setId($_GET['id']);
        modificar_videojuego($vj);
    } else { //Es un alta
        alta_videojuego($vj);
    }
    // NOVEDAD: Redirijo a la página de listado.
    header('Location: e02.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Videojuegos</title>
</head>

<body>
    <?php include("e02_header.html"); ?>
    <h1>Datos del videojuego</h1>
    <!-- Debemos comprobar si estamos modificando o haciendo un alta -->
    <?php
    if ($modificar) {
        //Obtenemos los datos actuales del videojuego y los mostramos en el formulario
        $vj = get_videojuego($_GET['id']);
        echo '<form action="?id=' . $vj->getId() . '" method="post">
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" value="' . $vj->getNombre() . '" required><br>
        <label for="plataforma">Plataforma</label><br>
        <input type="text" name="plataforma" value="' . $vj->getPlataforma() . '" required><br>
        <label for="anio">Año de lanzamiento</label><br>
        <input type="number" name="anio" value="' . $vj->getAnio_lanzamiento() . '" required><br>
        <label for="genero">Género</label><br>
        <input type="text" name="genero" value="' . $vj->getGenero() . '"><br>
        <button type="submit">Registrar</button>
    </form>';
    } else {
        echo '<form action="" method="post">
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" required><br>
        <label for="plataforma">Plataforma</label><br>
        <input type="text" name="plataforma" required><br>
        <label for="anio">Año de lanzamiento</label><br>
        <input type="number" name="anio" required><br>
        <label for="genero">Género</label><br>
        <input type="text" name="genero"><br>
        <button type="submit">Registrar</button>
    </form>';
    }
    ?>

</body>

</html>