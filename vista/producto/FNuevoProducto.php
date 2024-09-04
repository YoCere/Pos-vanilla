<form action="" method="post" id="FRegProducto">
    <div class="modal-header bg-primary">
        <h4 class="modal-title">Editar producto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Otros campos del formulario -->
         <div class="form-inline form-row">
        <div class="form-group col-sm-5 mr-5">
            <label for="cod_producto">Codigo del producto</label>
            <input type="text" class="form-control" name="cod_producto" id="cod_producto" >
        </div >

        <div class="form-group col-sm-5 mr-3" >
            <label for="cod_producto_sin	">Codigo del producto sin</label>
            <input type="number" class="form-control" name="cod_producto_sin" id="cod_producto_sin">
        </div>
        </div>
        <div class="form-group">
            <label for="nombre_producto">nombre</label>
            <input type="text" class="form-control" name="nombre_producto" id="nombre_producto">
        </div>

        <div class="form-inline form-row">
        <div class="form-group col-sm-5 mr-5">
            <label for="precio_producto">Precio del producto</label>
            <input type="number" class="form-control" name="precio_producto" id="precio_producto" step="0.01">
        </div>
        <div class="form-group col-sm-5 mr-3">
            <label for="unidad_medida">Unidad de medida</label>
            <input type="text" class="form-control" name="unidad_medida" id="unidad_medida" >
        </div>
        </div>
        <div class="form-group">
            <label for="unidad_medida_sin">Unidad de medida sin</label>
            <input type="number" class="form-control" name="unidad_medida_sin" id="unidad_medida_sin" >
        </div>
        <div class="form-inline form-row ">
          <div class="form-group mr-3">
                    <label for="exampleInputFile">Subir imagen dell producto</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input  " id="imgProducto" name="imgProducto" onchange="previsualizar()">
                            <label class="custom-file-label" for="imgProducto">Elegir archivo</label>
                          </div>
                        </div>
                      
                    </div>
                    <div class="col-sm-6 mr-3">
                      <div class="form-group" style="text-align: center;">
                          <img src="assets/dist/img/producto.png" alt="" width="150" class="img-thumbail previsualizar">
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
        
        
        
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
      cod_producto: {
        required: true,
        minlength: 3
      },
      cod_producto_sin: {
        required: true,
        minlength: 1
      },
      nombre: {
        required: true,
        minlength: 3
      },
      unidad_medida: {
        required: true,
        minlength: 1
      },
      unidad_medida_sin: {
        required: true,
        minlength: 1
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

function previsualizar() {
    const imgInput = document.getElementById('imgProducto');
    const imgPreview = document.querySelector('.previsualizar');

    if (imgInput.files && imgInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imgPreview.src = e.target.result;
        }
        reader.readAsDataURL(imgInput.files[0]);
    }
}

</script>