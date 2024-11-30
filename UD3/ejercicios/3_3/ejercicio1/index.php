<?php
    $estilo_acual = "default";
    if(isset($_GET['clear'])){
        setcookie("estilo",$estilo_acual,time()-100);
        header("Location:index.php");
    }
    if(isset($_COOKIE['estilo'])){
        $estilo_acual = $_COOKIE['estilo'];
    }
    if(isset($_POST['estilo'])){
        $estilo_acual = $_POST['estilo'];
        setcookie("estilo",$estilo_acual,time()+604800);
    }
    $estilo_acual .= '.css';
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?=$estilo_acual?>">
        <title>Ejercicio 3.3.1</title>
    </head>
    <body>
        <form action="" method="post">
            <label for="estilo">Estilo</label>
            <select name="estilo">
                <option value="default" <?= $estilo_acual=='default.css'?'selected':'' ?>>Default</option>
                <option value="oscuro" <?= $estilo_acual=='oscuro.css'?'selected':'' ?>>Oscuro</option>
                <option value="claro" <?= $estilo_acual=='claro.css'?'selected':'' ?>>Claro</option>
                <option value="matrix" <?= $estilo_acual=='matrix.css'?'selected':'' ?>>Matrix</option>
            </select>
            <a href="?clear=y">Limpiar</a>
            <button type="submit">Guardar</button>
        </form>
        <h1>Lorem ipsum</h1>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean iaculis dignissim finibus. Vestibulum vitae tempor quam. Curabitur faucibus dui felis, quis laoreet sem tristique sed. Maecenas non convallis massa, eget vulputate nulla. Fusce fringilla enim justo, ut dictum felis feugiat at. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque pretium ante at lectus dapibus, vitae bibendum nulla gravida. Pellentesque non odio urna. Aenean laoreet a mauris at sodales. In vel sem vel justo sollicitudin lobortis. Nulla facilisi. Curabitur vel mattis nisl. Praesent dapibus tincidunt fringilla. Interdum et malesuada fames ac ante ipsum primis in faucibus.
        <h2>Donec in eros eu diam convallis mollis a ut velit</h2>
        <p>
            Donec in eros eu diam <strong>convallis mollis a ut velit</strong>. Donec id purus enim. Morbi porta lacus venenatis erat consectetur efficitur. Nam molestie diam tellus, vitae bibendum tortor sagittis nec. Fusce id finibus dui. Integer tempor convallis nulla, at pulvinar leo feugiat et. Praesent ut risus ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur vel lobortis odio. Vestibulum et mi odio.
        </p>
        <h2>Duis quis accumsan eros, sit amet luctus urna</h2>
        <p>
        Sed semper convallis diam, sed feugiat felis iaculis eget. <strong>Proin a varius</strong> magna, ac bibendum lectus. Curabitur at tristique urna. Duis ut feugiat magna. Pellentesque volutpat urna sed lacinia aliquam. Aenean at est lacus. Pellentesque orci ex, tincidunt non purus sit amet, finibus hendrerit arcu. In vitae ante et nisl semper hendrerit.
        </p>
    </body>
</html>