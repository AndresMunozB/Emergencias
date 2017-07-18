/*==============================================================*/
/* DBMS name:      PostgreSQL 9.x                               */
/* Created on:     25-05-2017 14:28:56                          */
/*==============================================================*/

drop table if exists HISTORIALES;

drop table if exists MIEMBROS;

drop table if exists ENTIDADES;

drop table if exists COMENTARIOS;

drop table if exists VOLUNTARIOS;

drop table if exists APOYOS_ECONOMICOS;

drop table if exists ACTIVIDADES;

drop table if exists EVENTOS_A_BENEFICIO;

drop table if exists APORTES;

drop table if exists RECOLECCIONES;

drop table if exists TAREAS;

drop table if exists VOLUNTARIADOS;

drop table if exists MATERIALES;

drop table if exists OBJETIVOS;

drop table if exists MEDIDAS;

drop table if exists CATASTROFES;

drop table if exists USUARIOS;

/*==============================================================*/
/* Table: ACTIVIDADES                                           */
/*==============================================================*/
create table ACTIVIDADES (
   ID                   SERIAL               not null,
   MEDIDA_ID            INT4                 not null,
   NOMBRE               VARCHAR(16)          not null,
   DESCRIPCION          TEXT                 not null,
   REALIZADA            BOOL                 not null default FALSE,
   constraint PK_ACTIVIDADES primary key (ID)
);

/*==============================================================*/
/* Table: APORTES                                               */
/*==============================================================*/
create table APORTES (
   ID                   SERIAL               not null,
   MEDIDA_ID            INT4                 not null,
   NOMBRE               VARCHAR(16)          not null,
   NECESARIO            INT8                 not null default 1,
   RECIBIDO             INT8                 not null default 0,
   constraint PK_APORTES primary key (ID)
);

/*==============================================================*/
/* Table: APOYOS_ECONOMICOS                                     */
/*==============================================================*/
create table APOYOS_ECONOMICOS (
   MEDIDA_ID            INT4                 not null,
   NUMERO_DE_CUENTA     VARCHAR(32)          not null,
   MONTO_MINIMO         MONEY                not null,
   MONTO_ACTUAL         MONEY                not null default 0,
   constraint PK_APOYOS_ECONOMICOS primary key (MEDIDA_ID)
);

/*==============================================================*/
/* Table: CATASTROFES                                           */
/*==============================================================*/
create table CATASTROFES (
   ID                   SERIAL               not null,
   FECHA                DATE                 not null,
   TIPO                 TEXT                 not null,
   DESCRIPCION          TEXT                 null,
   REGION               VARCHAR(32)          not null,
   COMUNA               VARCHAR(32)          not null,
   constraint PK_CATASTROFES primary key (ID)
);

/*==============================================================*/
/* Table: COMENTARIOS                                           */
/*==============================================================*/
create table COMENTARIOS (
   ID                   INT4                 not null,
   USUARIO_ID           INT4                 not null,
   MEDIDA_ID            INT4                 not null,
   TEXTO                TEXT                 not null,
   FECHA                TIMESTAMP            not null,
   ID_COMENTARIO        INT4                 null,
   constraint PK_COMENTARIOS primary key (ID)
);

/*==============================================================*/
/* Table: ENTIDADES                                             */
/*==============================================================*/
create table ENTIDADES (
   ID                   SERIAL               not null,
   NOMBRE               VARCHAR(32)          not null,
   TIPO                 VARCHAR(16)          not null,
   constraint PK_ENTIDADES primary key (ID)
);

/*==============================================================*/
/* Table: EVENTOS_A_BENEFICIO                                   */
/*==============================================================*/
create table EVENTOS_A_BENEFICIO (
   MEDIDA_ID            INT4                 not null,
   CALLE                VARCHAR(32)          null,
   NUMERO               VARCHAR(8)           null,
   COMUNA               VARCHAR(32)          null,
   REGION               VARCHAR(32)          null,
   constraint PK_EVENTOS_A_BENEFICIO primary key (MEDIDA_ID)
);

/*==============================================================*/
/* Table: HISTORIALES                                           */
/*==============================================================*/
create table HISTORIALES (
   USUARIO_ID           INT4                 not null,
   FECHA                TIMESTAMP            not null,
   OPERACION            TEXT                 not null,
   VALOR_ANTERIOR       TEXT                 null,
   VALOR_ACTUAL         TEXT                 not null
);

/*==============================================================*/
/* Table: MATERIALES                                            */
/*==============================================================*/
create table MATERIALES (
   ID                   SERIAL               not null,
   MEDIDA_ID            INT4                 not null,
   NOMBRE               VARCHAR(32)          not null,
   NECESARIO            INT8                 not null default 1,
   RECIBIDO             INT8                 not null default 0,
   constraint PK_MATERIALES primary key (ID)
);

/*==============================================================*/
/* Table: MEDIDAS                                               */
/*==============================================================*/
create table MEDIDAS (
   ID                   SERIAL               not null,
   CATASTROFE_ID        INT4                 not null,
   USUARIO_ID           INT4                 not null,
   FECHA_LIMITE         TIMESTAMP            not null,
   VOLUNTARIOS          INT4                 not null default 0,
   APROBADA             BOOL                 not null default FALSE,
   TIPO                 VARCHAR(16)          not null,
   AVANCE               FLOAT4               not null default 0,
   constraint PK_MEDIDAS primary key (ID)
);

/*==============================================================*/
/* Table: MIEMBROS                                              */
/*==============================================================*/
create table MIEMBROS (
   USUARIO_ID           INT4                 not null,
   ENTIDAD_ID           INT4                 not null,
   CARGO                VARCHAR(32)          null,
   constraint PK_MIEMBROS primary key (USUARIO_ID, ENTIDAD_ID)
);

/*==============================================================*/
/* Table: OBJETIVOS                                             */
/*==============================================================*/
create table OBJETIVOS (
   MEDIDA_ID            INT4                 not null,
   DESCRIPCION          TEXT                 not null,
   constraint PK_OBJETIVOS primary key (MEDIDA_ID, DESCRIPCION)
);

/*==============================================================*/
/* Table: RECOLECCIONES                                         */
/*==============================================================*/
create table RECOLECCIONES (
   MEDIDA_ID            INT4                 not null,
   CALLE                VARCHAR(32)          null,
   NUMERO               VARCHAR(8)           null,
   COMUNA               VARCHAR(32)          null,
   REGION               VARCHAR(32)          null,
   constraint PK_RECOLECCIONES primary key (MEDIDA_ID)
);

/*==============================================================*/
/* Table: TAREAS                                                */
/*==============================================================*/
create table TAREAS (
   ID                   SERIAL               not null,
   MEDIDA_ID            INT4                 not null,
   DESCRIPCION          TEXT                 not null,
   FINALIZADA           BOOL                 not null default FALSE,
   constraint PK_TAREAS primary key (ID)
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS (
   ID                   SERIAL               not null,
   RUT                  VARCHAR(16)          not null,
   CONTRASENA           VARCHAR(32)          not null,
   NOMBRE               VARCHAR(32)          not null,
   APELLIDO_PATERNO     VARCHAR(16)          not null,
   APELLIDO_MATERNO     VARCHAR(16)          not null,
   FECHA_DE_NACIMIENTO  DATE                 not null,
   CORREO               VARCHAR(64)          not null,
   TELEFONO             VARCHAR(16)          null,
   BLOQUEADO            BOOL                 not null default FALSE,
   constraint PK_USUARIOS primary key (ID)
);

/*==============================================================*/
/* Table: VOLUNTARIADOS                                         */
/*==============================================================*/
create table VOLUNTARIADOS (
   MEDIDA_ID            INT4                 not null,
   DESCRIPCION          TEXT                 not null,
   PERFIL_DEL_VOLUNTARIO TEXT                 not null,
   CALLE                VARCHAR(32)          not null,
   NUMERO               VARCHAR(8)           not null,
   COMUNA               VARCHAR(32)          not null,
   REGION               VARCHAR(32)          not null,
   constraint PK_VOLUNTARIADOS primary key (MEDIDA_ID)
);

/*==============================================================*/
/* Table: VOLUNTARIOS                                           */
/*==============================================================*/
create table VOLUNTARIOS (
   USUARIO_ID           INT4                 not null,
   MEDIDA_ID            INT4                 not null,
   constraint PK_VOLUNTARIOS primary key (USUARIO_ID, MEDIDA_ID)
);

alter table ACTIVIDADES
   add constraint FK_ACTIVIDA_REFERENCE_EVENTOS_ foreign key (MEDIDA_ID)
      references EVENTOS_A_BENEFICIO (MEDIDA_ID)
      on delete restrict on update restrict;

alter table APORTES
   add constraint FK_APORTES_REFERENCE_RECOLECC foreign key (MEDIDA_ID)
      references RECOLECCIONES (MEDIDA_ID)
      on delete restrict on update restrict;

alter table APOYOS_ECONOMICOS
   add constraint FK_APOYOS_E_REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

alter table COMENTARIOS
   add constraint FK_COMENTAR_REFERENCE_USUARIOS foreign key (USUARIO_ID)
      references USUARIOS (ID)
      on delete restrict on update restrict;

alter table COMENTARIOS
   add constraint FK_COMENTAR_REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

alter table COMENTARIOS
   add constraint FK_COMENTAR_REFERENCE_COMENTAR foreign key (ID_COMENTARIO)
      references COMENTARIOS (ID)
      on delete restrict on update restrict;

alter table EVENTOS_A_BENEFICIO
   add constraint FK_EVENTOS__REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

alter table HISTORIALES
   add constraint FK_HISTORIA_REFERENCE_USUARIOS foreign key (USUARIO_ID)
      references USUARIOS (ID)
      on delete restrict on update restrict;

alter table MATERIALES
   add constraint FK_MATERIAL_REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

alter table MEDIDAS
   add constraint FK_MEDIDAS_REFERENCE_USUARIOS foreign key (USUARIO_ID)
      references USUARIOS (ID)
      on delete restrict on update restrict;

alter table MEDIDAS
   add constraint FK_MEDIDAS_REFERENCE_CATASTRO foreign key (CATASTROFE_ID)
      references CATASTROFES (ID)
      on delete restrict on update restrict;

alter table MIEMBROS
   add constraint FK_MIEMBROS_REFERENCE_ENTIDADE foreign key (ENTIDAD_ID)
      references ENTIDADES (ID)
      on delete restrict on update restrict;

alter table MIEMBROS
   add constraint FK_MIEMBROS_REFERENCE_USUARIOS foreign key (USUARIO_ID)
      references USUARIOS (ID)
      on delete restrict on update restrict;

alter table OBJETIVOS
   add constraint FK_OBJETIVO_REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

alter table RECOLECCIONES
   add constraint FK_RECOLECC_REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

alter table TAREAS
   add constraint FK_TAREAS_REFERENCE_VOLUNTAR foreign key (MEDIDA_ID)
      references VOLUNTARIADOS (MEDIDA_ID)
      on delete restrict on update restrict;

alter table VOLUNTARIADOS
   add constraint FK_VOLUNTAR_REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

alter table VOLUNTARIOS
   add constraint FK_VOLUNTAR_REFERENCE_USUARIOS foreign key (USUARIO_ID)
      references USUARIOS (ID)
      on delete restrict on update restrict;

alter table VOLUNTARIOS
   add constraint FK_VOLUNTAR_REFERENCE_MEDIDAS foreign key (MEDIDA_ID)
      references MEDIDAS (ID)
      on delete restrict on update restrict;

