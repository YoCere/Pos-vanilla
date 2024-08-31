<?php
$ruta=parse_url($_SERVER["REQUEST_URI"]);

if(isset($ruta["query"])){
    if($ruta["query"]=="ctrRegCliente"||
        $ruta["query"]=="ctrEditCliente"||
        $ruta["query"]=="ctrBusCliente"||
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
        
        $data=array(
            "razon_social_cliente"=>$_POST["razon_social_cliente"],
            "nit_ci_cliente"=>$_POST["nit_ci_cliente"],
            "direccion_cliente"=>$_POST["direccion_cliente"],
            "nombre_cliente"=>$_POST["nombre_cliente"],
            "telefono_cliente"=>$_POST["telefono_cliente"],
            "email_cliente"=>$_POST["email_cliente"],
            "idCliente"=>$_POST["idCliente"]
            
            
        );
        ModeloCliente::mdlEditCliente($data);
        
    }
    static public function ctrEliCliente(){
        require "../modelo/ClienteModelo.php";
        $id=$_POST["id"];
        $respuesta=ModeloCliente::mdlEliCliente($id);
        echo $respuesta;
    }

    static public function ctrBusCliente() {
        require "../modelo/clienteModelo.php";

        $nitCliente=$_POST["nitCliente"];
        $respuesta=ModeloCliente::mdlBusCliente($nitCliente);
        echo json_encode($respuesta);
    }
}