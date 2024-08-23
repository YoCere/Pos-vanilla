<?php
$ruta=parse_url($_SERVER["REQUEST_URI"]);

if(isset($ruta["query"])){
    if($ruta["query"]=="ctrRegProducto"||
        $ruta["query"]=="ctrEditProducto"||
        $ruta["query"]=="ctrEliProducto"){    
        $metodo=$ruta["query"];
        $producto=new Controladorproducto();
        $producto->$metodo();
    }
}

class ControladorProducto{
    
    static public function ctrInfoProductos(){
        $respuesta=ModeloProducto::mdlInfoproductos();
        return $respuesta;
    }
    static public function ctrRegProducto(){
        require "../modelo/productoModelo.php";

        $data=array(
            "cod_producto" => $_POST["cod_producto"],
            "cod_producto_sin" => $_POST["cod_producto_sin"],
            "nombre_producto" => $_POST["nombre_producto"],
            "precio_producto" => $_POST["precio_producto"],
            "unidad_medida" => $_POST["unidad_medida"],
            "unidad_medida_sin" => $_POST["unidad_medida_sin"],
            "imagen_producto" => $_POST["imagen_producto"],
            "disponible" => $_POST["disponible"]
            
        );
        $respuesta=ModeloProducto::mdlRegProducto($data);
        echo $respuesta;
    }
    static public function ctrInfoProducto($id){
        $respuesta=ModeloProducto::mdlInfoProducto($id);
        return $respuesta;
    }
    static public function ctrEditProducto(){
        require "../modelo/productoModelo.php";
        if($_POST["password"]==$_POST["password"]){
            $password=$_POST["password"];
        }else{
            $password=password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
        $data=array(
            "password"=>$password,
            "id"=>$_POST["idProducto"],
            "perfil"=>$_POST["perfil"],
            "estado"=>$_POST["estado"]
        );
        ModeloProducto::mdlEditProducto($data);
        //echo $respuesta;
    }
    static public function ctrEliProducto(){
        require "../modelo/productoModelo.php";
        $id=$_POST["id"];
        $respuesta=ModeloProducto::mdlEliProducto($id);
        echo $respuesta;
    }
}