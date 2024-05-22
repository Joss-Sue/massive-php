<?php
include_once '../config/bd_conexion.php';
session_start();

class ProductoClass{

    public static $conexion;

    public static function inicializarConexion() {
        self::$conexion = BD::crearInstancia();
    }

    static function registrarProducto($nombre, $descripcion, $cotizable, $precio, $stock, $vendedor, $categoria){
        self::inicializarConexion();
        
        try{
        $sqlInsert="insert into productos (nombreProd, descripcionProd, cotizable, precioProd, stockProd, vendedorProd,categoriaProd)
        values (:nombre, :descripcion, :cotizable, :precio, :stock, :vendedor, :categoria);";
        $consultaInsert= self::$conexion->prepare($sqlInsert);
        $consultaInsert->execute([
                                    ':nombre'=>$nombre,
                                    ':descripcion'=>$descripcion,
                                    ':cotizable'=>$cotizable,
                                    ':precio'=>$precio,
                                    ':stock'=>$stock,
                                    ':vendedor'=>$vendedor,
                                    ':categoria'=>$categoria]);
        return array(true,"insertado con exito");
        
        }catch(PDOException $e){
            if ($e->errorInfo[1] == 1062) {
                $cadena = "La categoria ya ha sido registrada.";
                return array(false, $cadena);
            } else {
                return array(false, "Error al crear el producto: " . $e->getMessage());
            }
        }
    }

    static function editarProducto($id, $nombre, $descripcion, $precio, $stock, $vendedor, $categoria){
        self::inicializarConexion();
        $producto = ProductoClass::buscarProductoByID($id);
        
    
        if($producto==null) {
           return array(false,"error en id");
        }
        try{
            $sqlUpdate="update productos set nombreProd = :nombre, descripcionProd = :descripcion, 
            precioProd = :precio, stockProd = :stock, vendedorProd = :vendedor, categoriaProd = :categoria 
            where idProd= :id;";
            $sentencia = self::$conexion-> prepare($sqlUpdate);
            $sentencia -> execute([ ':id'=>$id,
                                    ':nombre'=>$nombre,
                                    ':descripcion'=>$descripcion,
                                    ':precio'=>$precio,
                                    ':stock'=>$stock,
                                    ':vendedor'=>$vendedor,
                                    ':categoria'=>$categoria
                                    ]);
            return array(true,"actualizado con exito");
        }catch(PDOException $e){
            return array(false, "Error al editar categoria: " . $e->getMessage());
        }
        

        return array(true,"actualizado con exito");
                                
    }

    static function autorizarAdmin($id, $idAdmin){
        self::inicializarConexion();
        $producto = ProductoClass::buscarProductoByID($id);
        
    
        if($producto==null) {
           return array(false,"error en id");
        }
        try{
            $sqlUpdate="update productos set estaListadoProd = 1, adminAutoriza = :idAdmin where idProd= :id";
            $sentencia = self::$conexion-> prepare($sqlUpdate);
            $sentencia -> execute([ ':id'=>$id,
                                    ':idAdmin'=>$idAdmin
                                    ]);
            return array(true,"actualizado con exito");
        }catch(PDOException $e){
            return array(false, "Error al editar categoria: " . $e->getMessage());
        }
        

        return array(true,"actualizado con exito");
                                
    }

    static function eliminarProducto($id){
        self::inicializarConexion();
        $categoria = ProductoClass::buscarProductoByID($id);
        
    
        if($categoria==null) {
           return array(false, "error en id");
        }
        try{
        $sqlUpdate="update productos set activoProd = false where idProd = :id";
        $sentencia2 = self::$conexion-> prepare($sqlUpdate);
        $sentencia2 -> execute(['id'=>$id]);
            //echo '<script>alert("You have been logged out.")</script>;'
            return array(true, "eliminado exitoso");
        }catch(PDOException $e){
            return array(false, "Error al eliminar categoria: " . $e->getMessage());
        }
                                
    }

    static function buscarProductoByID($id){
        
        self::inicializarConexion();
        $sql="select * from productos where idProd=:id and activoProd = 1";
        $sentencia = self::$conexion-> prepare($sql);
        $sentencia -> execute(['id'=>$id]);
    
        $producto = $sentencia->fetch(PDO::FETCH_ASSOC);
        
    
        if(!$producto) {
           return null;
        }else{
            return $producto;
        }
    }

    static function contarFilas($sentenciaSQL){
        
        self::inicializarConexion();
        $sentencia = self::$conexion-> prepare($sentenciaSQL);
        $sentencia -> execute(['id'=>$id]);
    
        $producto = $sentencia->fetch(PDO::FETCH_ASSOC);
        
    
        if(!$producto) {
           return null;
        }else{
            return $producto;
        }
    }

    static function buscarAllProductos($pagina){
        $pagina=($pagina-1)*2;
        self::inicializarConexion();
        if($_SESSION['tipo_usuario']=="comprador"){
        $sql="select* from productos where activoProd = 1 order by fchCreacionProd desc limit 2 offset :pagina";
        }elseif($_SESSION['tipo_usuario']=="admin"){
            $sql="select * from productos where activoProd = 1 and estaListadoProd = 0 order by fchCreacionProd asc limit 2 offset :pagina";
        }
        $sentencia = self::$conexion-> prepare($sql);
        //$sentencia -> execute([':pagina'=> 2]);
        $sentencia->bindValue(':pagina', $pagina, PDO::PARAM_INT);
        $sentencia->execute();
        
    
        $productos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
        if(!$productos) {
           return null;
        }else{
            return $productos;
        }
    }

    static function buscarAllProductosVendedorAdmin($pagina){
        $pagina=($pagina-1)*2;
        self::inicializarConexion();
        if($_SESSION['tipo_usuario']=="vendedor"){
        $sql="select* from productos where activoProd = 1 where vendedorProd = :id order by fchCreacionProd desc limit 2 offset :pagina";
        }elseif($_SESSION['tipo_usuario']=="admin"){
            $sql="select * from productos where activoProd = 1 and adminAutoriza = :id";
        }
        $sentencia = self::$conexion-> prepare($sql);
        //$sentencia -> execute([':pagina'=> 2]);
        $sentencia->bindValue(':pagina', $pagina, PDO::PARAM_INT);
        $sentencia->execute([
            ':id'=>$_SESSION['usuario_id']
        ]);
        
    
        $productos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    
        if(!$productos) {
           return null;
        }else{
            return $productos;
        }
    }

}
?>