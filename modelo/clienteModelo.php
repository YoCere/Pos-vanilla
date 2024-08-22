<?php
require_once "conexion.php";

class ModeloCliente{


    static public function mdlInfoClientes(){
        $stmt=Conexion::conectar()->prepare("select * from cliente");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    static public function mdlRegCliente($data){
        $razon_social_cliente=$data["razon_social_cliente"];
        $nit_ci_cliente=$data["nit_ci_cliente"];
        $direccion_cliente=$data["direccion_cliente"];
        $nombre_cliente=$data["nombre_cliente"];
        $telefono_cliente=$data["telefono_cliente"];
        $email_cliente=$data["email_cliente"];        

        $stmt=Conexion::conectar()->prepare("insert into Cliente(razon_social_cliente, nit_ci_cliente, direccion_cliente, nombre_cliente, telefono_cliente, email_cliente) 
        values ('$razon_social_cliente','$nit_ci_cliente','$direccion_cliente','$nombre_cliente','$telefono_cliente','$email_cliente')");
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

    }
    static public function mdlActualizarAcceso($fechaHora, $id){
        $stmt=Conexion::conectar()->prepare("update cliente set ultimo_login='$fechaHora' where id_cliente='$id'");
        
        if($stmt->execute()){
          return "ok";
        }else{
          return "error";
        }
    }
    static public function mdlInfoCliente($id){
        $stmt=Conexion::conectar()->prepare("select * from cliente where id_cliente=$id");
            $stmt->execute();

            return $stmt->fetch();
    }
    static public function mdlEditCliente($data){
        
        
        $password=$data["password"];
        $perfil=$data["perfil"];
        $estado=$data["estado"];
        $id=$data["id"]; 

        $stmt=Conexion::conectar()->prepare("update cliente set password='$password', perfil='$perfil',
        estado='$estado' where id_cliente=$id");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }
    static public function mdlEliCliente($id){
        $stmt=Conexion::conectar()->prepare("delete from cliente where id_cliente=$id");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }
}
