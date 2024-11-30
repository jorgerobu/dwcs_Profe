<?php
include('Producto.php');
function get_conexion()
{
    $pdo = null;
    try {
        $pdo = new PDO('mysql:host=mariadb;dbname=e_335', 'root', 'bitnami');
    } catch (\Throwable $th) {
        die('Error en la conexion' . $th->getMessage());
    }

    return $pdo;
}

function get_productos()
{
    $pdo = get_conexion();
    $sql = 'SELECT id_producto, nombre, descripcion, precio FROM PRODUCTO';
    $resultado = $pdo->query($sql);
    $prods = [];
    foreach ($resultado as $row) {
        $p = new Producto();
        $p->setId($row['id_producto']);
        $p->setNombre($row['nombre']);
        $p->setDescripcion($row['descripcion']);
        $p->setPrecio($row['precio']);
        $prods[] = $p;
    }
    $resultado = null;
    $pdo = null;

    return $prods;
}

function add_carrito()
{
    $pdo = get_conexion();
    $sql = 'INSERT INTO CARRITO(id_carrito) VALUES (NULL)';
    $pdo->exec($sql);

    $sql = 'SELECT MAX(id_carrito) FROM CARRITO';
    $result = $pdo->query($sql);
    $id_carrito =  $result->fetch()[0];
    $result = null;
    $pdo = null;
    return $id_carrito;
}

function add_producto($id_carrito, $id_producto)
{
    $pdo = get_conexion();
    $sql = 'INSERT INTO CARRITO_PRODUCTO(id_carrito, id_producto) VALUES (?,?)';

    $statement = $pdo->prepare($sql);

    $statement->bindValue(1, $id_carrito);
    $statement->bindValue(2, $id_producto);
    $toret = false;
    try {
        $toret = $statement->execute();
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $statement = null;
        $pdo = null;
    }

    return $toret;
}

function get_productos_carrito($id_carrito)
{
    $pdo = get_conexion();
    $sql = 'SELECT p.id_producto, p.nombre, p.descripcion, p.precio FROM PRODUCTO p INNER JOIN CARRITO_PRODUCTO cp ON cp.id_producto = p.id_producto WHERE cp.id_carrito = ?';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $id_carrito, PDO::PARAM_INT);
    $prods = [];
    try {
        $statement->execute();
        foreach ($statement as $row) {
            $p = new Producto();
            $p->setId($row['id_producto']);
            $p->setNombre($row['nombre']);
            $p->setDescripcion($row['descripcion']);
            $p->setPrecio($row['precio']);
            $prods[] = $p;
        }
    } catch (PDOException $th) {
        error_log($th->getMessage());
    } finally {
        $statement = null;
        $pdo = null;
    }

    return $prods;
}
