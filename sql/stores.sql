DELIMITER $$
USE `phpescom`$$

CREATE PROCEDURE `sp_autentica`(
	IN _curp VARCHAR(18),
    IN _clave VARCHAR(100)
)
BEGIN
	DECLARE clave_correcta VARCHAR(100);
    
    IF (SELECT COUNT(*) FROM usuario WHERE curp = _curp) = 0 THEN
		SELECT false as respuesta, "El usuario no existe" as mensaje;
    ELSE
		SELECT aes_decrypt( clave, 'phpescom' ) INTO clave_correcta
		FROM usuario WHERE curp = _curp;
		
		IF clave_correcta = _clave THEN
			SELECT true as respuesta, "Inicio exitoso" as mensaje;
		ELSE
			SELECT false as respuesta, "Contraseña incorrecta" as mensaje;
		END IF;
	END IF;
END$$

DELIMITER ;
;