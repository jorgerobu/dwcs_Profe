CREATE DATABASE IF NOT EXISTS juego_numero;

USE juego_numero;

CREATE TABLE USUARIO(
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE PARTIDA(
    id_usuario INT,
    numero INT,
    intentos TINYINT UNSIGNED,
    tiempo INT UNSIGNED,
    CONSTRAINT partida_pk PRIMARY KEY(id_usuario, numero),
    CONSTRAINT partida_usuario_fk FOREIGN KEY(id_usuario) 
        REFERENCES USUARIO(id_usuario) ON UPDATE CASCADE ON DELETE RESTRICT
);