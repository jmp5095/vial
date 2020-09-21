create database invias_db;


CREATE TABLE rol(
  rol_id serial primary key,
  rol_nombre varchar(30)
);
CREATE TABLE permiso(
  per_id serial primary key,
  per_nombre varchar(30)
);
CREATE TABLE permiso_rol(
  per_rol_id serial primary key,
  id_permiso int,
  id_rol int,
  FOREIGN KEY (id_permiso) REFERENCES permiso(per_id),
  FOREIGN KEY (id_rol) REFERENCES rol(rol_id)
);
create table usuario(
  usu_id serial primary key,
  usu_cedula varchar(30),
  usu_nombre varchar(30),
  usu_apellido varchar(30),
  usu_correo varchar(30),
  usu_estado boolean,
  rol_id int,
  FOREIGN KEY (rol_id) REFERENCES rol(rol_id)
);
CREATE TABLE estado_via(
  est_via_id serial primary key,
  est_via_nombre varchar(30)
);
CREATE TABLE deterioro(
  det_id serial primary key,
  det_nombre varchar(30),
  det_descripcion text
);
CREATE TABLE caso(
  cas_id serial primary key,
  cas_resultado int,
  cas_estado boolean,
  id_usuario int,
  id_estado_via int,
  id_deterioro int,
  FOREIGN KEY (id_usuario) REFERENCES usuario(usu_id),
  FOREIGN KEY (id_estado_via) REFERENCES estado_via(est_via_id),
  FOREIGN KEY (id_deterioro) REFERENCES deterioro(det_id)
);
CREATE TABLE comuna(
  com_id serial primary key,
  com_nombre varchar(30)
);
CREATE TABLE barrio(
  bar_id serial primary key,
  bar_nombre varchar(30),
  id_comuna int,
  FOREIGN KEY (id_comuna) REFERENCES comuna(com_id)
);
CREATE TABLE entorno(
  ent_id serial primary key,
  ent_nombre varchar(30)
);
CREATE TABLE tipo_pavimento(
  tip_pav_id serial primary key,
  tip_pav_nombre varchar(30)
);
CREATE TABLE tipo_via(
  tip_via_id serial primary key,
  tip_via_nombre varchar(30)
);
CREATE TABLE tramo(
  tra_id serial primary key,
  tra_codigo varchar(15),
  id_tipo_pavimento int,
  id_barrio int,
  id_entorno int,
  FOREIGN KEY (id_tipo_pavimento) REFERENCES tipo_pavimento(tip_pav_id),
  FOREIGN KEY (id_barrio) REFERENCES barrio(bar_id),
  FOREIGN KEY (id_entorno) REFERENCES entorno(ent_id)
);
CREATE TABLE entorno_tramo(
  ent_tra_id serial primary key,
  id_entorno int,
  id_tramo int,
  FOREIGN KEY (id_entorno) REFERENCES entorno(ent_id),
  FOREIGN KEY (id_tramo) REFERENCES tramo(tra_id)

);

CREATE TABLE orden(
  ord_id serial primary key,
  ord_descripcion text,
  ord_pdf varchar(50),
  id_caso int,
  id_usuario int,
  FOREIGN KEY (id_caso) REFERENCES caso(cas_id),
  FOREIGN KEY (id_usuario) REFERENCES usuario(usu_id)
);
CREATE TABLE elemento_complementario(
  ele_com_id serial primary key,
  ele_com_descripcion varchar(50)
);
