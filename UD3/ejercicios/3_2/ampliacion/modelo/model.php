<?php
//FUNCIONES DE ACCESO A LOS DATOS
include('usuario.php');
include('partida.php');
function get_conexion()
{
    $pdo = null;
    try {
        $pdo = new PDO('mysql:host=mariadb;dbname=juego_numero', 'root', 'bitnami');
    } catch (\Throwable $th) {
        die('Error en la conexion' . $th->getMessage());
    }

    return $pdo;
}

function alta_partida(Partida $p)
{
    $pdo = get_conexion();

    //Calculo de $num_partidas
    $num_partidas = 0;
    $sql = 'select count(*) AS num from PARTIDA where id_usuario=?';
    $query = $pdo->prepare($sql);
    $query->bindValue(1, $p->getId_usuario(), PDO::PARAM_INT);
    try {
        $query->execute();
        $num_partidas = intval($query->fetch()[0]);
    } catch (PDOException $th) {
        $query = null;
        $pdo = null;
        return false;
    }
    $num_partidas++;

    $sql = 'INSERT INTO PARTIDA(id_usuario, numero, intentos, tiempo) VALUES (:id_usr,:num,:intentos,:tiempo)';

    $query = $pdo->prepare($sql);
    $query->bindValue(':id_usr', $p->getId_usuario(), PDO::PARAM_INT);
    $query->bindValue(':num', $num_partidas, PDO::PARAM_INT);
    $query->bindValue(':intentos', $p->getIntentos(), PDO::PARAM_INT);
    $query->bindValue(':tiempo', $p->getTiempo(), PDO::PARAM_INT);
    $retorno = false;
    try {
        $retorno = $query->execute();
    } catch (PDOException $th) {

        $retorno = false;
    } finally {
        $query = null;
        $pdo = null;
    }
    return $retorno;
}


function alta_usuario(Usuario $u)
{
    $pdo = get_conexion();
    $sql = 'INSERT INTO USUARIO(nombre) VALUES (?)';
    $query = $pdo->prepare($sql);
    $query->bindValue(1, $u->getNombre(), PDO::PARAM_STR);
    $retorno = false;
    try {
        $retorno = $query->execute();
    } catch (PDOException $th) {

        $retorno = false;
    } finally {
        $query = null;
        $pdo = null;
    }

    return $retorno;
}
// $u = new Usuario('pepe');
// echo alta_usuario($u) ? 'Usuario registrado.' : 'No se ha podido registrar';

function get_usuario(string $nombre)
{
    $pdo = get_conexion();
    $sql = 'SELECT nombre, id_usuario FROM USUARIO WHERE nombre = ?';
    $query = $pdo->prepare($sql);
    $query->bindValue(1, $nombre, PDO::PARAM_STR);
    $usuario = null;
    try {
        $query->execute();
        if ($query->rowCount() == 1) {
            $resultado = $query->fetch();
            $usuario = new Usuario($resultado['nombre'], $resultado['id_usuario']);
        }
    } catch (PDOException $th) {
    } finally {
        $query = null;
        $pdo = null;
    }

    return $usuario;
}

function get_usuarios()
{
    $pdo = get_conexion();
    $sql = 'SELECT nombre, id_usuario FROM USUARIO';
    
    $usuarios = [];
    try {
        $query = $pdo->query($sql);
        if ($query) {
            foreach($query as $u){
                $usuario = new Usuario($u['nombre'], $u['id_usuario']);
                $usuarios[] = $usuario;
            }
        }
    } catch (PDOException $th) {
    } finally {
        $query = null;
        $pdo = null;
    }

    return $usuarios;
}

function get_partidas(Usuario $u = null) {
    $pdo = get_conexion();
    $sql = 'SELECT id_usuario, numero, intentos, tiempo FROM PARTIDA WHERE ? IS NULL OR id_usuario=?';
    $query = $pdo->prepare($sql);
    $idUsuario = $u==null?null:$u->getId_usuario();
    $query->bindValue(1,$idUsuario);
    $query->bindValue(2,$idUsuario);
    $partidas = [];
    try {
        $resultado = $query->execute();
     
        if ($resultado) {
            foreach($query as $p){
                $partida = new Partida();
                $partida->setId_usuario($p['id_usuario'])
                ->setNumero($p['numero'])
                ->setIntentos($p['intentos'])
                ->setTiempo($p['tiempo']);
                $partidas[] = $partida;
            }
        }
    } catch (PDOException $th) {

    } finally {
        $query = null;
        $pdo = null;
    }

    return $partidas;
}

// echo "Pruebas...<br>";
// echo "1-Creando usuarios...<br>";
// $u = new Usuario('pepe');
// echo alta_usuario($u) ? 'Usuario 1 registrado.<br>' : 'No se ha podido registrar<br>';
// $u = new Usuario('marta');
// echo alta_usuario($u) ? 'Usuario 2 registrado.<br>' : 'No se ha podido registrar<br>';
// echo "2-Creando partidas...<br>";
// $p = new Partida();
// $p->setId_usuario(2)->setIntentos(5)->setTiempo(400);
// echo alta_partida($p) ? 'Partida 1 registrada.<br>' : 'No se ha podido registrar<br>';
// $p->setId_usuario(2)->setIntentos(10)->setTiempo(120);
// echo alta_partida($p) ? 'Partida 2 registrada.<br>' : 'No se ha podido registrar<br>';
// echo "3-Recuperando usuario pepe<br>";
// print_r(get_usuario("pepe"));
// echo "<br>3.1-Recuperando usuario que no existe<br>";
// print_r(get_usuario("lola"));
// echo "<br>4-Recuperando usuarios<br>";
// print_r(get_usuarios());
// echo "<br>5-Recuperando partidas<br>";
// print_r(get_partidas());
// echo "<br>5.1-Recuperando partidas del usuario 1<br>";
// print_r(get_partidas(new Usuario('da igual',1)));