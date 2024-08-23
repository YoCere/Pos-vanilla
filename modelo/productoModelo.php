<?php
require_once "conexion.php";

class Modeloproducto{

   
    static public function mdlInfoProductos(){
        $stmt=Conexion::conectar()->prepare("select * from producto");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    static public function mdlRegProducto($data){
        $codProducto = $data["cod_producto"];
        $codProductoSin = $data["cod_producto_sin"];
        $nombreProducto = $data["nombre_producto"];
        $precioProducto = $data["precio_producto"];
        $unidadMedida = $data["unidad_medida"];
        $unidadMedidaSin = $data["unidad_medida_sin"];
        $imagenProducto = $data["imagen_producto"];
        $disponible = $data["disponible"];
        
        $stmt = Conexion::conectar()->prepare("INSERT INTO producto (cod_producto, cod_producto_sin, nombre_producto, precio_producto, unidad_medida, unidad_medida_sin, imagen_producto, disponible) 
        VALUES ('$codProducto', '$codProductoSin', '$nombreProducto', '$precioProducto', '$unidadMedida', '$unidadMedidaSin', '$imagenProducto', '$disponible')");
        
        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo()); // Esto mostrará el error SQL si ocurre
            return "error";
        }

    }
    static public function mdlActualizarAcceso($fechaHora, $id){
        $stmt=Conexion::conectar()->prepare("update producto set ultimo_login='$fechaHora' where id_producto='$id'");
        
        if($stmt->execute()){
          return "ok";
        }else{
          return "error";
        }
    }
    static public function mdlInfoProducto($id){
        $stmt=Conexion::conectar()->prepare("select * from producto where id_producto=$id");
            $stmt->execute();

            return $stmt->fetch();
    }
    static public function mdlEditProducto($data){
        
        
        $password=$data["password"];
        $perfil=$data["perfil"];
        $estado=$data["estado"];
        $id=$data["id"]; 

        $stmt=Conexion::conectar()->prepare("update producto set password='$password', perfil='$perfil',
        estado='$estado' where id_producto=$id");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }
    static public function mdlEliProducto($id){
        $stmt=Conexion::conectar()->prepare("delete from producto where id_producto=$id");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }
}
