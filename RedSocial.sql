DROP DATABASE IF EXISTS DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA;
CREATE DATABASE DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA CHARACTER SET utf8 COLLATE utf8_general_ci;
USE DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA;

CREATE TABLE perfil(
  ID_PERFIL int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PERFIL varchar(10)
)ENGINE=innoDB;

CREATE TABLE usuario(
  ID_USUARIO int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NOMBRE varchar(20),
  APELLIDO varchar(20),
  DNI int(8),
  EMAIL varchar(100) UNIQUE NOT NULL,
  CLAVE varchar(40) NOT NULL,
  PERFIL int(2) UNSIGNED NOT NULL,
  FOREIGN KEY (PERFIL) REFERENCES perfil(ID_PERFIL) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=innoDB;

CREATE TABLE publicacion(
  ID_PUBLICACION int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  TITULO varchar (50),
  DESCRIPCION text NOT NULL,
  FECHA_PUBLICACION date,
  FKID_USUARIO int(2) UNSIGNED NOT NULL,
  FOREIGN KEY (FKID_USUARIO) REFERENCES usuario(ID_USUARIO) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=innoDB;

CREATE TABLE comentario(
  ID_COMENTARIO int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  COMENTARIO text,
  FECHA date,
  FKID_USUARIO int(2) UNSIGNED NOT NULL,
  FKID_PUBLICACION int(2) UNSIGNED NOT NULL,

  FOREIGN KEY (FKID_USUARIO) REFERENCES usuario(ID_USUARIO) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (FKID_PUBLICACION) REFERENCES publicacion(ID_PUBLICACION) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=innoDB;

INSERT INTO perfil(PERFIL)
VALUES ('Dueño'),('INQUILINO');

  INSERT INTO usuario (NOMBRE, APELLIDO, DNI, EMAIL, CLAVE, PERFIL)
  VALUES
    ('Marco', 'Gonzalez', '12345678','marco.gonzalez@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1),
    ('Maria', 'Gomez',  '12345678','margomez@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
    ('Laura', 'Fernandez',  '12345678','fernandezL@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
    ('Juan', 'Diaz',  '12345678','diaz.juan@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2);

INSERT INTO publicacion (TITULO,DESCRIPCION, FECHA_PUBLICACION, FKID_USUARIO)
VALUES
('Departamento Villa Urquiza','Departamento situado en Villa Urquita. Tres ambientes con cochera', '2018-06-16', 1),
('Busco Departamento','Busco departamento de un ambiente en zona belgrano', '2018-09-30', 2);
DROP DATABASE IF EXISTS DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA;
CREATE DATABASE DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA CHARACTER SET utf8 COLLATE utf8_general_ci;
USE DW4_ALTAMIRANO_LUCIO_PALMIERI_JULIETA;

CREATE TABLE perfil(
  ID_PERFIL int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PERFIL varchar(10)
)ENGINE=innoDB;

CREATE TABLE usuario(
  ID_USUARIO int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  NOMBRE varchar(20),
  APELLIDO varchar(20),
  DNI int(8),
  EMAIL varchar(100) UNIQUE NOT NULL,
  CLAVE varchar(40) NOT NULL,
  PERFIL int(2) UNSIGNED NOT NULL,
  FOREIGN KEY (PERFIL) REFERENCES perfil(ID_PERFIL) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=innoDB;

CREATE TABLE publicacion(
  ID_PUBLICACION int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  TITULO varchar (50),
  DESCRIPCION text NOT NULL,
  FECHA_PUBLICACION date,
  FKID_USUARIO int(2) UNSIGNED NOT NULL,
  FOREIGN KEY (FKID_USUARIO) REFERENCES usuario(ID_USUARIO) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=innoDB;

CREATE TABLE comentario(
  ID_COMENTARIO int(2) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  COMENTARIO text,
  FECHA date,
  FKID_USUARIO int(2) UNSIGNED NOT NULL,
  FKID_PUBLICACION int(2) UNSIGNED NOT NULL,

  FOREIGN KEY (FKID_USUARIO) REFERENCES usuario(ID_USUARIO) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (FKID_PUBLICACION) REFERENCES publicacion(ID_PUBLICACION) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=innoDB;

INSERT INTO perfil(PERFIL)
VALUES ('Dueño'),('INQUILINO');

  INSERT INTO usuario (NOMBRE, APELLIDO, DNI, EMAIL, CLAVE, PERFIL)
  VALUES
    ('Marco', 'Gonzalez', '12345678','marco.gonzalez@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1),
    ('Maria', 'Gomez',  '12345678','margomez@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2),
    ('Laura', 'Fernandez',  '12345678','fernandezL@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
    ('Juan', 'Diaz',  '12345678','diaz.juan@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2);

INSERT INTO publicacion (TITULO,DESCRIPCION, FECHA_PUBLICACION, FKID_USUARIO)
VALUES
('Departamento Villa Urquiza','Departamento situado en Villa Urquita. Tres ambientes con cochera', '2018-06-16', 1),
('Busco Departamento','Busco departamento de un ambiente en zona belgrano', '2018-09-30', 2);
