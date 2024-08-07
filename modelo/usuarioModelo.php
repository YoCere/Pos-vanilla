<?php
require_once "conexion.php";

class ModeloUsuario{

    static public function mdlAccesoUsuario($usuario){
        $stmt=Conexion::conectar()->prepare("select * from usuario where login_usuario='$usuario'");
        $stmt->execute();

        return $stmt->fetch();
        
    }
    static public function mdlInfoUsuarios(){
        $stmt=Conexion::conectar()->prepare("select * from usuario");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    static public function mdlRegUsuario($data){
        $loginUsuario=$data["loginUsuario"];
        $password=$data["password"];
        $perfil=$data["perfil"];

        $stmt=Conexion::conectar()->prepare("insert into usuario(login_usuario, password, perfil) 
        values ('$loginUsuario', '$password','$perfil')");
        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

    }
}