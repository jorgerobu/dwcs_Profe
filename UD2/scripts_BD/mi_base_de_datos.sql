-- Creamos el usuario si no existe.
CREATE USER IF NOT EXISTS 'usuarioBD'@'%' IDENTIFIED BY 'abc123';
GRANT ALL ON *.* TO 'usuarioBD'@'%';
-- Creamos la base de datos.
CREATE DATABASE IF NOT EXISTS mi_base_de_datos;
USE mi_base_de_datos;
CREATE TABLE IF NOT EXISTS clientes(
	id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    telefono VARCHAR(9)
);