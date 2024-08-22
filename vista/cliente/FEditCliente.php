<?php

require_once "../../controlador/clienteControlador.php";
require_once "../../modelo/clienteModelo.php";

$id=$_GET["id"];
$cliente=ControladorCliente::ctrInfoCliente($id);

?>
<form action="" id="FEditCliente">
            <div class="modal-header">
              <h4 class="modal-title">Editar datos de cliente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <label for="login">Razon social cliente</label>
                <input type="text" class="form-control" name="razon_social_cliente" id="razon_social_client">
              </div>
              <div class="form-group">
                <label for="login">NIT CI cliente</label>
                <input type="text" class="form-control" name="nit_ci_cliente" id="nit_ci_cliente">
              </div>
              <div class="form-group">
                <label for="login">direccion_cliente</label>
                <input type="text" class="form-control" name="direccion_cliente" id="direccion_cliente">
              </div>
              <div class="form-group">
                <label for="login">Nombre Cliente</label>
                <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente">
              </div>
              <div class="form-group">
                <label for="login">Telefono Cliente</label>
                <input type="text" class="form-control" name="telefono_cliente" id="telefono_cliente">
              </div>
              <div class="form-group">
                <label for="login">Email Cliente</label>
                <input type="text" class="form-control" name="email_cliente" id="email_cliente">
              </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
</form>

<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      editcliente()
    }
  });
  $('#FEditcliente').validate({
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