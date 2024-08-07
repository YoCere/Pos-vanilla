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
        
    }
}