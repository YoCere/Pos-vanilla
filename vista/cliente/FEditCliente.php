<?php

require_once "../../controlador/clienteControlador.php";
require_once "../../modelo/clienteModelo.php";

$id=$_GET["id"];
$cliente=ControladorCliente::ctrInfoCliente($id);

?>
<form action="" method="post" id="FEditCliente">
    <div class="modal-header bg-primary">
        <h4 class="modal-title">Editar Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Otros campos del formulario -->
        <div class="form-group">
            <label for="razon_social_cliente">Razón Social</label>
            <input type="text" class="form-control" name="razon_social_cliente" id="razon_social_cliente" value="<?php echo $cliente["razon_social_cliente"]; ?>">
        </div>

        <div class="form-group">
            <label for="nit_ci_cliente">NIT/CI</label>
            <input type="text" class="form-control" name="nit_ci_cliente" id="nit_ci_cliente" value="<?php echo $cliente["nit_ci_cliente"]; ?>">
        </div>

        <div class="form-group">
            <label for="direccion_cliente">Dirección</label>
            <input type="text" class="form-control" name="direccion_cliente" id="direccion_cliente" value="<?php echo $cliente["direccion_cliente"]; ?>">
        </div>

        <div class="form-group">
            <label for="nombre_cliente">Nombre del Cliente</label>
            <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente" value="<?php echo $cliente["nombre_cliente"]; ?>">
        </div>

        <div class="form-group">
            <label for="telefono_cliente">Teléfono</label>
            <input type="text" class="form-control" name="telefono_cliente" id="telefono_cliente" value="<?php echo $cliente["telefono_cliente"]; ?>">
        </div>

        <div class="form-group">
            <label for="email_cliente">Email</label>
            <input type="email" class="form-control" name="email_cliente" id="email_cliente" value="<?php echo $cliente["email_cliente"]; ?>">
        </div>

        <!-- Agrega aquí el campo oculto para el ID del cliente -->
        <input type="hidden" name="idCliente" id="idCliente" value="<?php echo $cliente['id_cliente']; ?>">
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
      editCliente()
    }
  });
  $('#FEditCliente').validate({
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