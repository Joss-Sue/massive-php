create database demo_v1;

use demo_v1;

create table usuarios(
iduser int auto_increment primary key,
correo varchar(255),
contrasena varchar(255),
nombre varchar(255),
direccion varchar(255),
tipo_usuario varchar(10),
activo boolean default 1,
fecha_ingreso timestamp default current_timestamp
);

create table categorias(
id int auto_increment primary key,
nombre varchar(255),
descripcion text,
usuarioMod int,
activo boolean default 1,
 FOREIGN KEY (usuarioMod) REFERENCES usuarios(iduser)
);