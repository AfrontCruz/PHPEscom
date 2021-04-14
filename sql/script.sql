CREATE DATABASE phpescom;
USE phpescom;

CREATE TABLE usuario(
	nombre VARCHAR(100) DEFAULT "",
    paterno VARCHAR(60) DEFAULT "",
    materno VARCHAR(60) DEFAULT "",
    fechaNacimiento DATE DEFAULT '2000-01-01',
    curp VARCHAR(18) NOT NULL PRIMARY KEY,
    sexo VARCHAR(9) DEFAULT "OTRO",
    clave VARBINARY(100) NOT NULL
);

USE `phpescom`;
DROP procedure IF EXISTS `sp_insert_usuario`;

DELIMITER $$
USE `phpescom`$$
CREATE PROCEDURE `sp_insert_usuario` (
	IN nombre VARCHAR(100),
    IN paterno VARCHAR(70),
    IN materno VARCHAR(70),
    IN fechaNacimiento DATE,
    IN curp VARCHAR(18),
    IN sexo VARCHAR(9),
    IN clave VARCHAR(100)
)
BEGIN
	INSERT INTO usuario ( nombre, paterno, materno, fechaNacimiento, curp, sexo, clave )
	VALUES 
	( nombre, paterno, materno, fechaNacimiento, curp, sexo, aes_encrypt( clave,'phpescom') );
END$$

DELIMITER ;

INSERT INTO usuario ( nombre, paterno, materno, fechaNacimiento, curp, sexo, clave )
VALUES 
( 'OSCAR DANIEL', 'JUÁREZ', 'CRUZ', '1997-10-07', 'JUCO971007HDFRRS06', 'Masculino', aes_encrypt( 'root', 'phpescom' ) ),
( 'CRISTIAN EDUARDO', 'CARRILLO', 'SOTO', '2001-08-09', 'CASC010809HDFRTRA7','Masculino', aes_encrypt('rootadmin','phpescom') );

SELECT 
	curp,
	aes_decrypt( clave, 'phpescom' )
FROM phpescom.usuario;