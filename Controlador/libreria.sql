CREATE DATABASE IF NOT EXISTS libreria DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE libreria;

CREATE TABLE compras (
  Id int(11) NOT NULL,
  numeroventa int(11) NOT NULL,
  nombre varchar(50) NOT NULL,
  imagen varchar(50) NOT NULL,
  precio decimal(10,2) NOT NULL,
  cantidad int(4) NOT NULL,
  subtotal decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE productos (
  id int(5) NOT NULL,
  nombre varchar(50) NOT NULL,
  descripcion text,
  imagenes text,
  precio decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO productos (id, nombre, descripcion, imagenes, precio) VALUES
(1, 'Boli Bic azul', 'Boli Bic azul', 'bicAzul.jpg', '0.60'),
(2, 'Goma Milan', 'Goma de borrar Milan', 'gomaMilan.jpg', '1.20'),
(3, 'Lapiz Bicolor', 'Lapiz de color azul y rojo', 'lapizBicolor.jpg', '2.30'),
(4, 'Lapiz Milan', 'Lapiz de grafico marca Milan', 'lapizMilan.jpg', '0.90'),
(5, 'Libreta', 'Libreta azul', 'libreta.jpg', '3.00'),
(6, 'Regla', 'Regla de medicion', 'regla.jpg', '1.75'),
(7, 'Tijeras Milan', 'Tijeras para cortar marca Milan', 'tijerasMilan.jpg', '3.75'),
(8, 'Cinta transparente', 'Fiso para pegar', 'fiso.jpg', '0.90'),
(9, 'Grapadora', 'Grapadora para grapar', 'grapadora.jpg', '4.35'),
(10, 'Carpeta', 'Carpeta para archivar', 'carpeta.jpg', '6.00'),
(11, 'Folios', 'Un monton de folios', 'folios.jpg', '1.00');

CREATE TABLE usuarios (
  Id int(11) NOT NULL,
  Nombre varchar(30) NOT NULL,
  Apellido varchar(50) NOT NULL,
  Usuario varchar(20) NOT NULL,
  Password varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO usuarios (Id, Nombre, Apellido, Usuario, Password) VALUES
(1, 'admin', 'admin', 'admin', 'admin'),
(2, 'Sergio', 'Suarez', 'Sergio', 'Sergio');

ALTER TABLE compras
  ADD PRIMARY KEY (Id);

ALTER TABLE productos
  ADD PRIMARY KEY (id);

ALTER TABLE usuarios
  ADD PRIMARY KEY (Id);

ALTER TABLE compras
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE productos
  MODIFY id int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE usuarios
  MODIFY Id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
