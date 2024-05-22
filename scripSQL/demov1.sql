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
    calificacionPromedio DECIMAL(5,2) DEFAULT 0.00 COMMENT 'Calificacion promedio del producto',
    ventasTotales INT COMMENT 'Ventas totales que ha tenido el producto',
    
     FOREIGN KEY (categoriaProd) REFERENCES categorias(id),
     FOREIGN KEY (vendedorProd) REFERENCES usuarios(iduser)
    );

CREATE TABLE carritos(
	idCart INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Serializacion carrito',
    activoCart BOOLEAN DEFAULT TRUE COMMENT 'Eliminacion logica', 
	usuarioCart int unique NOT NULL COMMENT 'Usuario al que pertenece el carrito',
    totalItems int default 0 comment 'Contiene el total de items del carrito del usuario',
    foreign key (usuarioCart) references usuarios(iduser)
    );

    DELIMITER //
	CREATE TRIGGER after_user_insert
	AFTER INSERT
		ON usuarios FOR EACH ROW
	BEGIN
		INSERT INTO carritos(usuarioCart) VALUES (NEW.iduser);
	END;
	//
    DELIMITER ;

    create table productosCarrito(
        idProdCarrito int auto_increment primary key comment 'Llave primaria del item',
        productoID int,
        cantidad int comment 'Cantidad de productos requeridos',
        idCarrito int comment'Llave foreana al carrito al que pertenece',
        activo boolean default 1 comment 'Borrado logico',

        foreign key (productoID) references productos(idProd),
        foreign key (idCarrito) references carritos(idCart)
    );

    DELIMITER //
    CREATE TRIGGER after_itemcarrito_insert
    AFTER INSERT
    ON productosCarrito FOR EACH ROW
    BEGIN
       UPDATE carritos
       SET totalItems = (SELECT COUNT(*) FROM productosCarrito where idCarrito = NEW.idCarrito and activo = 1 ) where idCart = NEW.idCarrito;
    END;
    //
    DELIMITER ;


    DELIMITER //
    CREATE PROCEDURE ActualizarInsertarCarrito(
        IN param_idCarrito INT,
        IN param_Cantidad INT,
        IN param_carritoProduc INT
    )
    BEGIN
        IF EXISTS (SELECT 1 FROM productosCarrito WHERE productoID = param_carritoProduc and idCarrito = param_idCarrito and activo = 1) THEN
            UPDATE productosCarrito
            SET cantidad = cantidad + param_Cantidad
            WHERE productoID = param_carritoProduc AND idCarrito = param_idCarrito and activo=1;
        ELSE
            INSERT INTO productosCarrito(idCarrito, cantidad, productoID)
            VALUES(param_idCarrito, param_Cantidad, param_carritoProduc);
        END IF;
    END //
    DELIMITER ;

CREATE TABLE comentarios_valoraciones (
	id INT PRIMARY KEY AUTO_INCREMENT COMMENT "Id del comentario con su respectiva valoracion",
    comentario TEXT COMMENT "Comentario del producto",
    valoracion DECIMAL(5,2) COMMENT "Valoracion del usuario del producto",
    idProdVal INT COMMENT "Llave foranea que contiene la referencia al producto",
    idUsuarioVal INT COMMENT "Llave foranea que contiene la referencia al usuario que realiza la valoracion",
    fechaValoracion TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT "fecha de la valoracion",
    activo BOOLEAN DEFAULT TRUE COMMENT "Borrado logico",
    
    foreign key (idProdVal) references productos(idProd),
    foreign key (idUsuarioVal) references usuarios(iduser)
);

DELIMITER //
CREATE TRIGGER actualizar_promedio
AFTER INSERT ON comentarios_valoraciones
FOR EACH ROW
BEGIN
    DECLARE total INT;
    DECLARE sumatoria DECIMAL(5,2);
    DECLARE promedio DECIMAL(5,2);

    SELECT COUNT(*), SUM(valoracion) INTO total, sumatoria
    FROM comentarios_valoraciones
    WHERE idProdVal = NEW.idProdVal;

    SET promedio = sumatoria / total;

    UPDATE productos
    SET calificacionPromedio = promedio
    WHERE idProd = NEW.idProdVal;
END;//
DELIMITER ;

CREATE TABLE multimediaProductos (
	id INT AUTO_INCREMENT PRIMARY KEY COMMENT "Llave primaria de la tabla",
    tipoMultimedia VARCHAR(10) COMMENT "Tipo de dato multimedia, video o imagen",
    ruta VARCHAR(255) COMMENT "Ruta del archivo",
    idProductoMulti INT COMMENT "Producto al cual se hace referencia",
    activo BOOLEAN  DEFAULT 1 COMMENT "Borrado logico",
        
    FOREIGN KEY (idProductoMulti) REFERENCES productos(idProd)
);


CREATE TABLE pedidos(
	id INT AUTO_INCREMENT PRIMARY KEY COMMENT "Llave primaria de la tabla",
    fechaPedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT "fecha del pedido",
    totalPedido DECIMAL (10,5) COMMENT "Precio total del pedido",
    estatusPedido VARCHAR(25) DEFAULT "En camino" COMMENT "Estatus del pedido",
    idUsuarioPedido INT COMMENT "Usuario que le pertence el pedido",
    activo BOOLEAN DEFAULT TRUE COMMENT "Borrado logico",
    
    FOREIGN KEY (idUsuarioPedido) REFERENCES usuarios(iduser)
);

DELIMITER //
CREATE PROCEDURE crearPedido(in param_totalPedido decimal(5,2), in param_idUsario int, out param_last_id int)
BEGIN
    -- Primero, insertamos en la primera tabla
    INSERT INTO pedidos (totalPedido, idUsuarioPedido) VALUES (param_totalPedido, param_idUsario);

    -- Obtenemos el ID generado por el auto_increment
    SET param_last_id = LAST_INSERT_ID();

END //
DELIMITER ;

CREATE TABLE ventas(
	id INT AUTO_INCREMENT PRIMARY KEY COMMENT "Llave primaria de la tabla",
    articulosTotales int comment "Cantidad total de articulos comprados",
    idPedido INT COMMENT "Llave foranea al pedido al que pertenece",
    idProductoVenta int comment "Llave foranea al producto comprado",
    activo BOOLEAN DEFAULT TRUE COMMENT "Borrado logico",
    
    FOREIGN KEY (idPedido) REFERENCES pedidos(id),
    FOREIGN KEY (idProductoVenta) REFERENCES productos(idProd)
);

DELIMITER //
CREATE PROCEDURE insertarVenta(in param_articulosTotales int, in param_idPedido INT,
    in param_idProductoVenta int)
BEGIN
   
    INSERT INTO ventas (articulosTotales, idPedido, idProductoVenta) VALUES (param_articulosTotales, param_idPedido, param_idProductoVenta);

END //
DELIMITER ;



