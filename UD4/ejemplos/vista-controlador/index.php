<?php
//Esto es el controlador
// Conectamos con la base de datos
$db = new PDO('mysql:host=mariadb; dbname=articulos', 'root', 'bitnami');
//Lanzamos una consulta para recuperar los artículos que haya en la BD
$res = $db->query('SELECT fecha, titulo FROM articulo');

$articles = [];
while ($row = $res->fetch()) {
    $articles[] = $row;
}

$db = null;

include("showAllArticles.php");
