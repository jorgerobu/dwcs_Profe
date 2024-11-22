<?php
//FUNCIONES DE ACCESO A LOS DATOS
include('usuario.php');
include('partida.php');
function get_conexion(){
    $pdo = null;
    try {
        $pdo = new PDO('mysql:host=mariadb;dbname=juego_numero','root','bitnami');
    } catch (\Throwable $th) {
        die('Error en la conexion'.$th->getMessage());
    }

    return $pdo;
}

function alta_partida(Partida $p){
    $pdo = get_conexion();

    //Calculo de $num_partidas
    $num_partidas = 0;
    $sql = 'select count(*) AS num from PARTIDA where id_usuario=?';
    $query = $pdo->prepare($sql);
    $query->bindValue(1,$p->getId_usuario(),PDO::PARAM_INT);
    try {
        $query->execute();
        $num_partidas = intval($query->fetch()[0]);
    } catch (PDOException $th) {
        $query = null;
        $pdo = null;
    }



    $sql = 'INSERT INTO PARTIDA(id_usuario, numero, intentos, tiempo) VALUES (:id_usr,:num,:intentos,:tiempo)';

    $query = $pdo->prepare($sql);
    $query->bindValue(':id_usr',$p->getId_usuario(),PDO::PARAM_INT);
    $retorno = false;
    try {
        $retorno = $query->execute();
    } catch (PDOException $th) {
        
        $retorno = false;
    }finally{
        $query = null;
        $pdo = null;
    }
    
}


function alta_usuario(Usuario $u){
    $pdo = get_conexion();
    $sql = 'INSERT INTO USUARIO(nombre) VALUES (?)';
    $query = $pdo->prepare($sql);
    $query->bindValue(1,$u->getNombre(),PDO::PARAM_STR);
    $retorno = false;
    try {
        $retorno = $query->execute();
    } catch (PDOException $th) {
        
        $retorno = false;
    }finally{
        $query = null;
        $pdo = null;
    }

    return $retorno;
}
// $u = new Usuario('pepe');
// echo alta_usuario($u) ? 'Usuario registrado.' : 'No se ha podido registrar';

function get_usuario(string $nombre){
    
}

function get_usuarios(){
    
}

function get_partidas(Usuario $u = null){
    
}