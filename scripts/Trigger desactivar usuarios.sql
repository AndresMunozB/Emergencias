CREATE OR REPLACE FUNCTION desactivar_usuario() RETURNS TRIGGER AS
$$
	BEGIN
		UPDATE usuarios
		SET bloqueado = TRUE
		WHERE id = old.id;
		
		RETURN null;
	END;
$$ 
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS desactivar_usuario
ON usuarios;

CREATE TRIGGER desactivar_usuario
BEFORE DELETE ON usuarios
FOR EACH ROW EXECUTE PROCEDURE desactivar_usuario();