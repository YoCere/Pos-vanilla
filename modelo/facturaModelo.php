<?php
require_once "conexion.php";

class ModeloFactura{

    
    static public function mdlInfoFacturas(){
        $stmt=Conexion::conectar()->prepare("select * from factura");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    static public function mdlRegFactura($data){
        $loginFactura=$data["loginFactura"];
        $password=$data["password"];
        $perfil=$data["perfil"];

        $stmt=Conexion::conectar()->prepare("insert into Factura(login_Factura, password, perfil) 
        values ('$loginFactura', '$password','$perfil')");
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

    }
   
    static public function mdlInfoFactura($id){
        $stmt=Conexion::conectar()->prepare("select * from factura where id_Factura=$id");
            $stmt->execute();

            return $stmt->fetch();
    }
   
    static public function mdlEliFactura($id){
        $stmt=Conexion::conectar()->prepare("delete from factura where id_Factura=$id");

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }
    }

    static public function mdlNumFactura(){
        $stmt=Conexion::conectar()->prepare("select max(id_factura) from factura");
        $stmt->execute();

        return $stmt->fetch();
    
    }

    static public function mdlNuevoCufd($data){
        $cufd=$data["cufd"];
        $fechaVigCufd=$data["fechaVigCufd"];
        $codControlCufd=$data["codControlCufd"];

        $stmt=Conexion::conectar()->prepare("insert into cufd(codigo_cufd, codigo_control, fecha_vigencia) 
        values ('$cufd', '$codControlCufd','$fechaVigCufd')");
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }
    }

    static public function mdlUltimoCufd(){
        $stmt=Conexion::conectar()->prepare("SELECT * FROM cufd WHERE id_cufd=(select max(id_cufd) from cufd);");
            $stmt->execute();

            return $stmt->fetch();
    }
}
