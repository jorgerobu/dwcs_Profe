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

/**
 *  Devuelve un objeto con una id determinada.
 *
 * @param integer $id
 * @return Videojuego|false
 */
function get_videojuego(int $id): Videojuego|false
{
    $db = conexion_bd();
    $sql = "SELECT id, nombre, plataforma, anio_lanzamiento AS  anio, genero FROM videojuegos WHERE id=?";
    $query = $db->prepare($sql);
    $query->bindValue(1, $id, PDO::PARAM_INT);
    $query->execute();
    $r = $query->fetch();
    //Si no hay ningún objeto con ese id devuelve false
    if (!isset($r)) {
        return false;
    }
    $vj = new Videojuego($r['nombre'], $r['plataforma'], $r['genero'], $r['anio'], $r['id']);
    $query = null;
    $db = null;

    return $vj;
}


/**
 * Devuelve los videojuegos de la base de datos desde un offset y limitando la respuesta a un limite.
 *
 * @param integer $limit Limite de filas devueltas.
 * @param integer $offset Cantidad de filas que ha de saltarse.
 * @return array COnjunto de Videojuegos.
 */
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
        $vj = new Videojuego($r['nombre'], $r['plataforma'], $r['genero'], $r['anio'], $r['id']);
        array_push($videojuegos, $vj);
    }
    $query = null;
    $db = null;

    return $videojuegos;
}

/**
 * Elimina un videojuego en base a su ID.
 *
 * @param integer $id
 * @return bool Verdadero si se ha eliminado el videojuego o falso en caso contrario.
 */
function eliminar_videojuego(int $id): bool
{
    $db = conexion_bd();
    $sql = "DELETE FROM videojuegos WHERE id=?";
    $query = $db->prepare($sql);
    $query->bindValue(1, $id, PDO::PARAM_INT);
    $resultado = $query->execute();
    //Comprobamos que el execute ha funcionado y que ha eliminado solo un registro.
    $resultado = $resultado && $query->rowCount() == 1;
    $query = null;
    $db = null;
    return $resultado;
}

/**
 * Crea un nuevo videojuego en la base de datos.
 *
 * @param Videojuego $vj
 * @return boolean
 */
function alta_videojuego(Videojuego $vj): bool
{
    $db = conexion_bd();
    $sql = "INSERT INTO videojuegos(nombre,plataforma,anio_lanzamiento,genero) VALUES (:nombre, :plataforma, :anio, :genero)";
    $query = $db->prepare($sql);
    $query->bindValue(':nombre', $vj->getNombre(), PDO::PARAM_STR);
    $query->bindValue(':plataforma', $vj->getPlataforma(), PDO::PARAM_STR);
    $query->bindValue(':anio', $vj->getAnio_lanzamiento(), PDO::PARAM_INT);
    $query->bindValue(':genero', $vj->getGenero()); //No le pongo el tipo porque puede ser un NULL.
    $resultado = $query->execute();
    //Comprobamos que el execute ha funcionado y que ha eliminado solo un registro.
    $resultado = $resultado && $query->rowCount() == 1;
    $query = null;
    $db = null;
    return $resultado;
}

/**
 * Modifica un videojuego ya almacenado en la BD. El objeto que se le pasa debe tener el atributo id.
 *
 * @param Videojuego $vj
 * @return boolean
 */
function modificar_videojuego(Videojuego $vj): bool
{
    $db = conexion_bd();
    $sql = "UPDATE videojuegos 
            SET nombre = :nombre, plataforma=:plataforma, genero=:genero, anio_lanzamiento=:anio
            WHERE id=:id";
    $query = $db->prepare($sql);
    $query->bindValue(':nombre', $vj->getNombre(), PDO::PARAM_STR);
    $query->bindValue(':plataforma', $vj->getPlataforma(), PDO::PARAM_STR);
    $query->bindValue(':anio', $vj->getAnio_lanzamiento(), PDO::PARAM_INT);
    $query->bindValue(':genero', $vj->getGenero()); //No le pongo el tipo porque puede ser un NULL.
    $query->bindValue(':id', $vj->getID());
    $resultado = $query->execute();
    //Comprobamos que el execute ha funcionado y que ha eliminado solo un registro.
    $resultado = $resultado && $query->rowCount() == 1;
    $query = null;
    $db = null;
    return $resultado;
}
