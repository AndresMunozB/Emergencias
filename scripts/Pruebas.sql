-- DATOS PRELIMINARES
-- Ingresar catástrofe
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-05-26', 'Terremoto', 'Ajkdhaskf', 'Metropolitana', 'Estación Central');
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-06-26', 'Tsunami', 'MAREPOTOOOO!', 'Metropolitana', 'San Bernardo');
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-06-26', 'Diluvio', 'MAREasfOO!', 'Metropolitana', 'San Bernardo');
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-06-26', 'Tsunami', '123fasf', 'Metropolitana', 'San Miguel');
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-06-26', 'Incendio', 'MAfasfsagOTOOOO!', 'Metropolitana', 'El Bosque');
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-06-26', 'Incendio', 'MAdasfO!', 'Metropolitana', 'La Florida');
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-06-26', 'Tsunami', '4124AREPOTOOOO!', 'Metropolitana', 'San Bernardo');
INSERT INTO catastrofes (FECHA, TIPO, DESCRIPCION, REGION, COMUNA) VALUES ('2017-06-26', 'Incendio', 'MAR33333', 'Metropolitana', 'San Bernardo');
-- Ingresar usuario
INSERT INTO users (RUT, PASSWORD, NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_NACIMIENTO, CORREO, TELEFONO) VALUES ('19.522.760-8', 'Clave123', 'Mario', 'Álvarez', 'Molina', '1996-09-28', 'mario.alvarez.m@usach.cl', '92595002');

-- PRUEBA APOYOS ECONÓMICOS
INSERT INTO apoyos_economicos VALUES (1, '24.500-03', 30000000, 0);
INSERT INTO medidas (CATASTROFE_ID, USER_ID, FECHA_LIMITE, VOLUNTARIOS, MEDIDA_TYPE, MEDIDA_ID) VALUES (1, 1, '2017-05-31', 10, 'economico', 1);

-- Actualizar monto actual
UPDATE apoyos_economicos
SET monto_actual = 14000000
WHERE id = 1;

-- Actualizar avance en medida
SELECT actualizar_avance_medida(medida_id) AS avance_medida
FROM apoyos_economicos
WHERE id = 1;

-- Mostrar tupla apoyo económico-medida
SELECT * FROM medidas INNER JOIN apoyos_economicos ON id = medida_id;

-- PRUEBA VOLUNTARIADOS
-- Ingresar medida
INSERT INTO voluntariados  VALUES (1, 'Desc. vol. 1', 'Perfil 1', 'Calle 1', 'ABC123', 'Santiago', 'Metropolitana');
INSERT INTO medidas (CATASTROFE_ID, USER_ID, FECHA_LIMITE, VOLUNTARIOS, MEDIDA_TYPE, MEDIDA_ID) VALUES (1, 1, '2017-05-31', 10, 'voluntariado', 1);
INSERT INTO tareas (MEDIDA_ID, DESCRIPCION, FINALIZADA) VALUES (1, 'Descripcion 1', FALSE);
INSERT INTO tareas (MEDIDA_ID, DESCRIPCION, FINALIZADA) VALUES (1, 'Descripcion 2', FALSE);
INSERT INTO tareas (MEDIDA_ID, DESCRIPCION, FINALIZADA) VALUES (1, 'Descripcion 3', FALSE);

-- Actualizar estado tarea
UPDATE tareas
SET finalizada = TRUE
WHERE id = 2;

-- Actualizar avance en medida
SELECT actualizar_avance_medida(medida_id) AS avance_medida
FROM tareas 
WHERE medida_id = 2 AND id = 2;

-- Mostrar tupla voluntariado-medida
SELECT * FROM medidas INNER JOIN voluntariados ON id = medida_id;

-- PRUEBA EVENTO A BENEFICIO
INSERT INTO EVENTOS_A_BENEFICIO(ID,CALLE,NUMERO,COMUNA,REGION) VALUES (1, 'Agua Santa',2554,'Independencia','Metropolitana');
INSERT INTO medidas(CATASTROFE_ID, USER_ID, FECHA_LIMITE, VOLUNTARIOS, MEDIDA_TYPE, MEDIDA_ID) VALUES (1,1,'2017-07-10',10,'evento',1);
INSERT INTO materiales(MEDIDA_ID,NOMBRE,NECESARIO,RECIBIDO) VALUES (3, 'Material 1', 100, 0);
INSERT INTO materiales(MEDIDA_ID,NOMBRE,NECESARIO,RECIBIDO) VALUES (3, 'Material 2', 50, 0);
INSERT INTO materiales(MEDIDA_ID,NOMBRE,NECESARIO,RECIBIDO) VALUES (3, 'Material 3', 20, 0);
INSERT INTO ACTIVIDADES(MEDIDA_ID,NOMBRE,DESCRIPCION,REALIZADA) VALUES (1,'Pool party','fiesta en la piscina',FALSE);
INSERT INTO ACTIVIDADES(MEDIDA_ID,NOMBRE,DESCRIPCION,REALIZADA) VALUES (1,'tallarinata','muchos tallarines',FALSE);
INSERT INTO ACTIVIDADES(MEDIDA_ID,NOMBRE,DESCRIPCION,REALIZADA) VALUES (1,'bingo','viejitos jugando',FALSE);
INSERT INTO ACTIVIDADES(MEDIDA_ID,NOMBRE,DESCRIPCION,REALIZADA) VALUES (1,'Pool party 2.0','revancha de la pool party anterior',FALSE);

-- Actualizar estado de actividad
UPDATE materiales 
set recibido = 30
where id = 1;

UPDATE materiales 
set recibido = 40
where id = 2;

-- Actualizar avance en medida
SELECT actualizar_avance_medida(medida_id) AS avance_medida
FROM materiales 
where medida_id = 3 and id = 1;

SELECT actualizar_avance_medida(medida_id) AS avance_medida
FROM materiales 
where medida_id = 3 and id = 2;

-- Mostrar tupla evento-medida
SELECT * FROM medidas INNER JOIN EVENTOS_A_BENEFICIO ON id = medida_id;

SELECT * FROM materiales

-- PRUEBA RECOLECCIÓN

INSERT INTO MEDIDAS(CATASTROFE_ID,USUARIO_ID,FECHA_LIMITE,TIPO) VALUES (2,1,'2017-05-31','recoleccion');
INSERT INTO RECOLECCIONES(MEDIDA_ID,CALLE,NUMERO,COMUNA,REGION) VALUES(4,'EL SALTO','666','RECOLETA','METROPOLITANA');
INSERT INTO APORTES(MEDIDA_ID,NOMBRE,NECESARIO) VALUES(4,'cama',10);
INSERT INTO APORTES(MEDIDA_ID,NOMBRE,NECESARIO) VALUES(4,'frazadas',50);
INSERT INTO APORTES(MEDIDA_ID,NOMBRE,NECESARIO) VALUES(4,'litros de agua',2000);


-- Actualizar estado aportes

UPDATE aportes
SET recibido = 5 
WHERE ID = 1;

UPDATE aportes
SET recibido = 2000 
WHERE ID = 3;

-- Actualizar avance en medida

SELECT actualizar_avance_medida(medida_id) AS avance_medida
FROM aportes 
where medida_id = 4 and id = 1;

SELECT actualizar_avance_medida(medida_id) AS avance_medida
FROM aportes 
where medida_id = 4 and id = 3;

-- Mostrar tupla recolección-medida
SELECT * FROM medidas INNER JOIN recolecciones ON id = medida_id;

-- PRUEBA ELIMINACIÓN USUARIO
DELETE FROM usuarios WHERE id = 1;
SELECT * FROM usuarios