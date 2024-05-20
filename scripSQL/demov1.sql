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

CREATE TABLE productos (
	idProd INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Identificador unico producto',
    nombreProd VARCHAR(255) NOT NULL COMMENT 'Nombre del producto',
    descripcionProd TEXT COMMENT 'Descripcion del producto',
    cotizable BOOLEAN COMMENT 'Flag, indica si le producto es de cotizacion o no',
    precioProd DECIMAL(10, 2) COMMENT 'Precio del producto',
    stockProd INT COMMENT 'Unidades disponibles del producto',
    estaListadoProd BOOLEAN DEFAULT FALSE COMMENT 'TRUE cuando se autoriza el producto',
    fchCreacionProd DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creacion producto',
    activoProd BOOLEAN DEFAULT TRUE COMMENT 'Eliminacion logica producto',
    vendedorProd INT NOT NULL COMMENT 'Usuario que publica el producto',
    categoriaProd INT COMMENT 'Categoria del producto',
    
     FOREIGN KEY (categoriaProd) REFERENCES categorias(id),
     FOREIGN KEY (vendedorProd) REFERENCES usuarios(iduser)
    );