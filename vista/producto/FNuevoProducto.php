<form action="" method="post" id="FRegProducto">
    <div class="modal-header bg-primary">
        <h4 class="modal-title">Editar producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Otros campos del formulario -->
        <div class="form-group">
            <label for="cod_producto">Codigo del producto</label>
            <input type="text" class="form-control" name="cod_producto" id="cod_producto" >
        </div>

        <div class="form-group">
            <label for="cod_producto_sin	">Codigo del producto sin</label>
            <input type="number" class="form-control" name="cod_producto_sin" id="cod_producto_sin">
        </div>

        <div class="form-group">
            <label for="nombre_producto">Nombre del producto</label>
            <input type="text" class="form-control" name="nombre_producto" id="nombre_producto">
        </div>

        <div class="form-group">
            <label for="precio_producto">Precio del producto</label>
            <input type="number" class="form-control" name="precio_producto" id="precio_producto" step="0.01">
        </div>

        <div class="form-group">
            <label for="unidad_medida">Unidad de medida</label>
            <input type="text" class="form-control" name="unidad_medida" id="unidad_medida" >
        </div>
        <div class="form-group">
            <label for="unidad_medida_sin">Unidad de medida sin</label>
            <input type="number" class="form-control" name="unidad_medida_sin" id="unidad_medida_sin" >
        </div>
        <div class="form-group">
            <label for="imagen_producto">imagen_producto</label>
            <input type="text" class="form-control" name="imagen_producto" id="imagen_producto">
        </div>
        <div class="form-group">
            <label for="disponible">Disponible</label>
            <select class="form-control" name="disponible" id="disponible">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
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
      regProducto()
    }
  });
  $('#FRegProducto').validate({
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