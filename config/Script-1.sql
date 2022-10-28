-- traductor.idiomas definition
CREATE DATABASE traductor;

CREATE TABLE `idiomas` (
  `id_idioma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_idioma` varchar(255) NOT NULL,
  `descripcion_idioma` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_idioma`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- traductor.traductor definition

CREATE TABLE `traductor` (
  `id_traductor` int(11) NOT NULL AUTO_INCREMENT,
  `palabra_espaniol` char(20) NOT NULL,
  `palabra_nueva` char(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `imagen` mediumblob NOT NULL,
  PRIMARY KEY (`id_traductor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;