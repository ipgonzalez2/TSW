/*CREACIÓN DE TABLAS*/

DROP DATABASE IF EXISTS `MYDAL`;
CREATE DATABASE `MYDAL` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
--
-- SELECCIONAMOS PARA USAR
--
USE `MYDAL`;
--
-- DAMOS PERMISO USO Y BORRAMOS EL USUARIO QUE QUEREMOS CREAR POR SI EXISTE
--
GRANT USAGE ON * . * TO `MYDAL`@`localhost`;
	DROP USER `MYDAL`@`localhost`;

--
-- CREAMOS EL USUARIO Y LE DAMOS PASSWORD,DAMOS PERMISO DE USO Y DAMOS PERMISOS SOBRE LA BASE DE DATOS.
--
CREATE USER IF NOT EXISTS `MYDAL`@`localhost` IDENTIFIED BY 'mydal19';
GRANT USAGE ON *.* TO `MYDAL`@`localhost` REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `MYDAL`.* TO `MYDAL`@`localhost` WITH GRANT OPTION;
--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS USUARIO(

	NOMBRE VARCHAR(255) NOT NULL,
	PASSWORD VARCHAR(255) NOT NULL,
	EMAIL VARCHAR(255) NOT NULL,
	CONSTRAINT PK_USUARIO PRIMARY KEY(EMAIL)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS CARPETA(

	ID BINARY(16) NOT NULL,
    NOMBRE VARCHAR(255) NOT NULL,
    PROPIETARIO VARCHAR(255) NOT NULL,
    PADRE BINARY(16),

	CONSTRAINT FK_PROPIETARIO FOREIGN KEY(PROPIETARIO) REFERENCES USUARIO(EMAIL),
	CONSTRAINT PK_CARPETA PRIMARY KEY(ID)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

ALTER TABLE CARPETA ADD FOREIGN KEY(PADRE) REFERENCES CARPETA(ID);


CREATE TABLE IF NOT EXISTS FICHERO(
	ID BINARY(16) NOT NULL,
	NOMBRE VARCHAR(255) NOT NULL,
    PADRE BINARY(16) NOT NULL,

	CONSTRAINT FK_PADRE FOREIGN KEY(PADRE) REFERENCES CARPETA(ID),
	CONSTRAINT PK_FICHERO PRIMARY KEY(ID)

)ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;


