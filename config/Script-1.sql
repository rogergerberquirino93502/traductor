-- traductor.idiomas definition

CREATE TABLE `idiomas` (
  `id_idioma` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_idioma` varchar(255) NOT NULL,
  PRIMARY KEY (`id_idioma`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;


-- traductor.palabras definition

CREATE TABLE `palabras` (
  `id_palabra` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_palabra` varchar(255) NOT NULL,
  PRIMARY KEY (`id_palabra`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;


-- traductor.traductor definition

CREATE TABLE `traductor` (
  `id_traductor` int(11) NOT NULL AUTO_INCREMENT,
  `id_palabra` int(11) NOT NULL,
  `palabra_nueva` char(255) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  PRIMARY KEY (`id_traductor`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

delete from traductor;