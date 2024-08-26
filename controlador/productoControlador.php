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
        $imagen=$_FILES["imgProducto"];
        $imgNombre=$imagen["name"];
        $imgTmp=$imagen["tmp_name"];
        move_uploaded_file($imgTmp,"../assets/dist/img/productos/".$imgNombre);
        $data=array(
            "cod_producto" => $_POST["cod_producto"],
            "cod_producto_sin" => $_POST["cod_producto_sin"],
            "descripcion" => $_POST["descripcion"],
            "precio_producto" => $_POST["precio_producto"],
            "unidad_medida" => $_POST["unidad_medida"],
            "unidad_medida_sin" => $_POST["unidad_medida_sin"],
            "imagen_producto" =>$imgNombre,
           
            
        );
        $respuesta=ModeloProducto::mdlRegProducto($data);
        echo $respuesta;
    }
    static public function ctrInfoProducto($id){
        $respuesta=ModeloProducto::mdlInfoProducto($id);
        return $respuesta;
    }
    static function ctrEditProducto()
    {
        require "../modelo/productoModelo.php";

        $data = array(
        "cod_producto" => $_POST["cod_producto"],
        "cod_producto_sin" => $_POST["cod_producto_sin"],
        "descripcion" => $_POST["descripcion"],
        "precio_producto" => $_POST["precio_producto"],
        "unidad_medida" => $_POST["unidad_medida"],
        "unidad_medida_sin" => $_POST["unidad_medida_sin"],
        "imagen_producto" => $_POST["imagen_producto"],
        "disponible" => $_POST["disponible"],
        "id_producto" => $_POST["id_producto"] 
    );
    
        ModeloProducto::mdlEditProducto($data);
        $respuesta = ModeloProducto::mdlEditProducto($data);

        echo $respuesta;
    }
    static public function ctrEliProducto(){
        require "../modelo/productoModelo.php";
        $id=$_POST["id"];
        $respuesta=ModeloProducto::mdlEliProducto($id);
        echo $respuesta;
    }
}