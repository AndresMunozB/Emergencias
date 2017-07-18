-- ###################################################################################
-- PROCEDIMIENTOS ALMACENADOS
-- ###################################################################################
-- Calcular avance apoyo económico
DROP FUNCTION IF EXISTS avance_apoyo_economico(INTEGER);
CREATE FUNCTION avance_apoyo_economico(INTEGER) RETURNS FLOAT AS
$$
	DECLARE monto_minimo MONEY := (
		SELECT monto_minimo
		FROM apoyos_economicos
		WHERE id = $1);
		
	DECLARE monto_actual MONEY := (
		SELECT monto_actual
		FROM apoyos_economicos
		WHERE id = $1);

	DECLARE avance_recaudacion FLOAT := monto_actual * 100 / monto_minimo;
	
	BEGIN
		IF avance_recaudacion > 100 THEN
			avance_recaudacion := 100;
		END IF;

		RETURN avance_recaudacion;
	END
$$
LANGUAGE plpgsql;

-- Calcular avance evento a beneficio
DROP FUNCTION IF EXISTS avance_evento_beneficio(INTEGER);
CREATE FUNCTION avance_evento_beneficio(INTEGER) RETURNS FLOAT AS
$$
	DECLARE avance_materiales FLOAT := 0;
	
	DECLARE total_materiales INTEGER := (
		SELECT count(medida_id)
		FROM materiales
		WHERE medida_id = $1);

	DECLARE avance_parcial FLOAT;

	DECLARE material materiales%rowtype;

	BEGIN
		FOR material IN
		SELECT *
		FROM materiales
		WHERE medida_id = $1
		LOOP
			avance_parcial := material.recibido * 100 / material.necesario;
			IF avance_parcial > 100 THEN
				avance_parcial := 100;
			END IF;
			
			avance_materiales := avance_materiales + avance_parcial;
		END LOOP;

		RETURN avance_materiales / total_materiales;
	END;
$$
LANGUAGE plpgsql;

-- Calcular avance recolección
DROP FUNCTION IF EXISTS avance_recoleccion(INTEGER);
CREATE FUNCTION avance_recoleccion(INTEGER) RETURNS FLOAT AS
$$
	DECLARE avance_aportes FLOAT := 0;
	
	DECLARE total_aportes INTEGER := (
		SELECT count(medida_id)
		FROM aportes
		WHERE medida_id = $1);

	DECLARE avance_parcial FLOAT;

	DECLARE aporte aportes%rowtype;
	
	BEGIN
		FOR aporte IN
		SELECT *
		FROM aportes
		WHERE medida_id = $1
		LOOP
			avance_parcial := aporte.recibido * 100 / aporte.necesario;
			IF avance_parcial > 100 THEN
				avance_parcial := 100;
			END IF;
			
			avance_aportes := avance_aportes + avance_parcial;
		END LOOP;
				
		RETURN avance_aportes / total_aportes;
	END
$$
LANGUAGE plpgsql;

-- Calcular avance voluntariado
DROP FUNCTION IF EXISTS avance_voluntariado(INTEGER);
CREATE FUNCTION avance_voluntariado(INTEGER) RETURNS FLOAT AS
$$
	DECLARE tareas_finalizadas FLOAT := 0;

	DECLARE total_tareas INTEGER := (
		SELECT count(id) 
		FROM tareas
		WHERE medida_id = $1);
		
	DECLARE tarea tareas%rowtype;
	
	BEGIN
		FOR tarea IN
		SELECT * FROM tareas 
		WHERE medida_id = $1
		LOOP
			IF tarea.finalizada THEN
				tareas_finalizadas := tareas_finalizadas + 1;
			END IF;
		END LOOP;

		RETURN tareas_finalizadas * 100 / total_tareas;
	END
$$
LANGUAGE plpgsql;

-- Determinar y actualizar avance de medida
DROP FUNCTION IF EXISTS actualizar_avance_medida(INTEGER);
CREATE FUNCTION actualizar_avance_medida(INTEGER) RETURNS FLOAT AS
$$
	DECLARE id_medida INTEGER := (SELECT id FROM medidas WHERE medida_id = $1);
	
	DECLARE tipo VARCHAR(16) := (
		SELECT medida_type
		FROM medidas
		WHERE id = id_medida);

	DECLARE avance_medida FLOAT;
		
	BEGIN
		IF tipo = 'economico' THEN
			avance_medida := avance_apoyo_economico($1);
		ELSIF tipo = 'evento' THEN
			avance_medida := avance_evento_beneficio($1);
		ELSIF tipo = 'recoleccion' THEN
			avance_medida := avance_recoleccion($1);
		ELSE
			avance_medida := avance_voluntariado($1);
		END IF;

		UPDATE medidas m
		SET avance = avance_medida
		WHERE id = id_medida;

		RETURN avance_medida;
	END
$$
LANGUAGE plpgsql;

-- ###################################################################################
-- TRIGGERS
-- ###################################################################################
-- ACTUALIZAR AVANCE TRIGGER
CREATE OR REPLACE FUNCTION actualizar_avance_medida_trigger() RETURNS TRIGGER AS
$$
	
	DECLARE tipo VARCHAR(16) := (
		CASE TG_TABLE_NAME
		WHEN 'apoyos_economicos' THEN 'economico'
		WHEN 'materiales' THEN 'evento'
		WHEN 'aportes' THEN 'recoleccion'
		ELSE 'voluntariado' END);
	
	DECLARE id_medida INTEGER;

	DECLARE avance_medida FLOAT;
		
	BEGIN
		IF tipo = 'economico' THEN
			id_medida := (SELECT id FROM medidas WHERE medida_id = new.id AND medida_type = tipo);
			avance_medida := avance_apoyo_economico(new.id);
		ELSIF tipo = 'evento' THEN
			id_medida := new.medida_id;
			avance_medida := avance_evento_beneficio(id_medida);
		ELSIF tipo = 'recoleccion' THEN
			id_medida := (SELECT id FROM medidas WHERE medida_id = new.medida_id AND medida_type = tipo);
			avance_medida := avance_recoleccion(new.medida_id);
		ELSE
			id_medida := (SELECT id FROM medidas WHERE medida_id = new.medida_id AND medida_type = tipo);
			avance_medida := avance_voluntariado(new.medida_id);
		END IF;

		UPDATE medidas m
		SET avance = avance_medida
		WHERE m.id = id_medida;

		UPDATE users
		SET password = tipo
		WHERE id = 1;

		RETURN new;
	END
$$
LANGUAGE plpgsql;

-- TRIGGERS
DROP TRIGGER IF EXISTS avance_apoyo_economico
ON apoyos_economicos;

CREATE TRIGGER avance_apoyo_economico
AFTER UPDATE ON apoyos_economicos
FOR EACH ROW EXECUTE PROCEDURE actualizar_avance_medida_trigger();

DROP TRIGGER IF EXISTS avance_evento_beneficio
ON eventos_a_beneficio;

CREATE TRIGGER avance_evento_beneficio
AFTER UPDATE ON eventos_a_beneficio
FOR EACH ROW EXECUTE PROCEDURE actualizar_avance_medida_trigger();

DROP TRIGGER IF EXISTS avance_recoleccion
ON aportes;

CREATE TRIGGER avance_recoleccion
AFTER UPDATE ON aportes
FOR EACH ROW EXECUTE PROCEDURE actualizar_avance_medida_trigger();

DROP TRIGGER IF EXISTS avance_voluntariado
ON tareas;

CREATE TRIGGER avance_voluntariado
AFTER UPDATE ON tareas
FOR EACH ROW EXECUTE PROCEDURE actualizar_avance_medida_trigger();