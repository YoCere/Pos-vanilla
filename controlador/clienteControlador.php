<?php
$ruta=parse_url($_SERVER["REQUEST_URI"]);

if(isset($ruta["query"])){
    if($ruta["query"]=="ctrRegCliente"||
        $ruta["query"]=="ctrEditCliente"||
        $ruta["query"]=="ctrEliCliente"){    
        $metodo=$ruta["query"];
        $cliente=new ControladorCliente();
        $cliente->$metodo();
    }
}

class ControladorCliente{
    
    static public function ctrInfoClientes(){
        $respuesta=ModeloCliente::mdlInfoClientes();
        return $respuesta;
    }
    static public function ctrRegCliente(){
        require "../modelo/clienteModelo.php";
        
        $data=array(
            "razon_social_cliente"=>$_POST["razon_social_cliente"],
            "nit_ci_cliente"=>$_POST["nit_ci_cliente"],
            "direccion_cliente"=>$_POST["direccion_cliente"],
            "nombre_cliente"=>$_POST["nombre_cliente"],
            "telefono_cliente"=>$_POST["telefono_cliente"],
            "email_cliente"=>$_POST["email_cliente"]
        );
        $respuesta=ModeloCliente::mdlRegCliente($data);
        echo $respuesta;
    }
    static public function ctrInfoCliente($id){
        $respuesta=ModeloCliente::mdlInfoCliente($id);
        return $respuesta;
    }
    static public function ctrEditCliente(){
        require "../modelo/clienteModelo.php";
        if($_POST["password"]==$_POST["password"]){
            $password=$_POST["password"];
        }else{
            $password=password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
        $data=array(
            "password"=>$password,
            "id"=>$_POST["idCliente"],
            "perfil"=>$_POST["perfil"],
            "estado"=>$_POST["estado"]
        );
        ModeloCliente::mdlEditCliente($data);
        //echo $respuesta;
    }
    static public function ctrEliCliente(){
        require "../modelo/ClienteModelo.php";
        $id=$_POST["id"];
        $respuesta=ModeloCliente::mdlEliCliente($id);
        echo $respuesta;
    }
}