CREATE DATABASE control_acceso;
use control_acceso;

CREATE TABLE usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50),
    user VARCHAR(50) NOT NULL UNIQUE,
    pass CHAR(64) NOT NULL COMMENT 'Clave codificada SHA56 Hexadecimal',
    email VARCHAR(200) NOT NULL UNIQUE

);

CREATE TABLE token(
    token CHAR(32) PRIMARY KEY COMMENT 'Token de 16 Bytes expresado en Hexadecimal',
    usuario_id INT NOT NULL,
    caducidad DATE,
    CONSTRAINT fk_token_usuario FOREIGN KEY(usuario_id) REFERENCES usuario(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE permiso(
    id DECIMAL(2,0) PRIMARY KEY,
    nombre VARCHAR(10) NOT NULL,
    descripcion VARCHAR(256)
);

CREATE TABLE endpoint(
    id INT AUTO_INCREMENT PRIMARY KEY,
    uri VARCHAR(50) NOT NULL
);
-- Tabla que asocia permisos a un endpoint para un token concreto.
CREATE TABLE autorizacion(
    token CHAR(32) NOT NULL,
    permiso_id DECIMAL(2,0) NOT NULL,
    endpoint_id INT NOT NULL,
    CONSTRAINT pk_autorizacion PRIMARY KEY(token, permiso_id, endpoint_id),
    CONSTRAINT fk_autorizacion_token FOREIGN KEY(token) REFERENCES token(token)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_autorizacion_permiso FOREIGN KEY(permiso_id) REFERENCES permiso(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_autorizacion_endpoint FOREIGN KEY(endpoint_id) REFERENCES endpoint(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Datos base
INSERT INTO permiso(id,nombre,descripcion) VALUES (1,'GET_ONE','Permite recuperar un elemento del endpoint'), 
(2,'GET','Permite recuperar todos los elementos del endpoint'), 
(3,'POST','Permite crear nuevos elementos del endpoint'),
(4,'PUT','Permite modificar un elemento del endpoint'),
(5,'DELETE','Permite eliminar un elemento del endpoint');

INSERT INTO endpoint(uri) VALUES ('banda'), ('disco'), ('pista');