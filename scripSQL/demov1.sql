create database demo_v1;

use demo_v1;

create table usuarios(
iduser int auto_increment primary key,
correo varchar(255),
pass varchar(255),
nombreuser varchar(255),
tipo_usuario tinyint
);

insert into usuarios (correo, pass, nombreuser, tipo_usuario) values ('perro@animal.com', '123', 'DOG', 2);


select * from usuarios;