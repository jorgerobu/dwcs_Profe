CREATE DATABASE musica;
USE musica;

CREATE TABLE banda(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    num_integrantes DECIMAL(2,0) NOT NULL,
    genero VARCHAR(50) NOT NULL,
    nacionalidad VARCHAR (50)
);