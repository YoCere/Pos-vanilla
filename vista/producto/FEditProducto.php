<?php
require_once "../../controlador/productoControlador.php";
require_once "../../modelo/productoModelo.php";

$id=$_GET["id"];
$producto=ControladorProducto::ctrInfoProducto($id);

?>

<form action="" id="FEditProducto">
            <form action="" method="post" id="FEditProducto">
    <div class="modal-header bg-primary">
        <h4 class="modal-title">Editar Producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Otros campos del formulario -->

        <div class="form-group">
            <label for="cod_producto">Codigo del producto</label>
            <input type="text" class="form-control" name="cod_producto" id="cod_producto" value="<?php echo $producto["cod_producto"]; ?>">
        </div>

        <div class="form-group">
            <label for="cod_producto_sin">Codigo del producto sin</label>
            <input type="number" class="form-control" name="cod_producto_sin" id="cod_producto_sin" value="<?php echo $producto["cod_producto_sin"]; ?>">
        </div>

        <div class="form-group">
            <label for="nombre_producto">Nombre del producto</label>
            <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" value="<?php echo $producto["nombre_producto"]; ?>">
        </div>

        <div class="form-group">
            <label for="precio_producto">Precio del producto</label>
            <input type="number" class="form-control" name="precio_producto" id="precio_producto" value="<?php echo $producto["precio_producto"]; ?>">
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
            <input type="text" class="form-control" name="unidad_medida" id="unidad_medida" value="<?php echo $producto["unidad_medida"]; ?>">
        </div>

        <div class="form-group">
            <label for="unidad_medida_sin">Unidad de Medida SIN</label>
            <input type="number" class="form-control" name="unidad_medida_sin" id="unidad_medida_sin" value="<?php echo $producto["unidad_medida_sin"]; ?>">
        </div>

        <div class="form-group">
            <label for="imagen_producto">Imagen del Producto</label>
            <input type="text" class="form-control" name="imagen_producto" id="imagen_producto" value="<?php echo $producto["imagen_producto"]; ?>">
        </div>

        <div class="form-group">
              
              <label for="">Disponibilidad</label>

        <div class="row">
        <div class="col-sm-6">
        <div class="custom-control custom-radio">
         <input class="custom-control-input" type="radio" id="disponible" name="disponible"
         <?php if($producto["disponible"]=="1"):?>checked<?php endif;?> value="1">
        <label for="disponible" class="custom-control-label">Disponible</label>
        </div>
        </div>

        <div class="col-sm-6">
        <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" id="Nodisponible" name="disponible" 
        <?php if($producto["disponible"]=="0"):?>checked<?php endif;?> value="0">
        <label for="Nodisponible" class="custom-control-label">No disponible</label>
        </div>
        </div>
        </div>
        </div>

        <!-- Campo oculto para el ID del producto -->
        <input type="hidden" name="id_producto" id="id_producto" value="<?php echo $producto['id_producto']; ?>">
    </div>

    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      editProducto()
    }
  });
  $('#FEditProducto').validate({
    rules: {
      password: {
        required: true,
        minlength: 3
      },
      vrPassword: {
        required: true,
        minlength: 3
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>