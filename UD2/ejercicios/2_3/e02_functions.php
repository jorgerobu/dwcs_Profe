<?php
define('DB_DSN', 'mysql:host=mariadb;dbname=videoteca');
define('DB_USER', 'root');
define('DB_PASS', 'bitnami');
include("Videojuego.php");
/**
 * Devuelve una conexion con la base de datos.
 *
 * @return PDO
 */
function conexion_bd()
{
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        die('Fallo en la conexión de con la BD. ' . $e->getMessage());
    }
    return $db;
}

function get_videojuegos(int $limit, int $offset)
{
    $db = conexion_bd();
    $sql = "SELECT id, nombre, plataforma, anio_lanzamiento AS  anio, genero FROM videojuegos ORDER BY nombre, plataforma LIMIT ? OFFSET ?";
    $query = $db->prepare($sql);
    $query->bindValue(1, $limit, PDO::PARAM_INT);
    $query->bindValue(2, $offset, PDO::PARAM_INT);
    $query->execute();

    $videojuegos = array();
    foreach ($query as $r) {
        $vj = new Videojuego($r['id'], $r['nombre'], $r['plataforma'], $r['genero'], $r['anio']);
        array_push($videojuegos, $vj);
    }
    $query = null;
    $db = null;

    return $videojuegos;
}
