<?php

require_once "../../controlador/facturaControlador.php";
require_once "../../modelo/facturaModelo.php";

$id = $_GET["id"];
$factura = ControladorFactura::ctrInfoFactura($id);
$producto=json_decode($factura["detalle"], true);
?>

<div class="modal-header bg-info">
    <h4 class="modal-title">Información de Factura</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-6">
            <table class="table">
                <tr>
                    <th># Factura</th>
                    <td><?php echo $factura["cod_factura"]; ?></td>
                </tr>
                <tr>
                    <th>Cliente:</th>
                    <td><?php echo $factura["razon_social_cliente"]. "  -  ".$factura["nit_ci_cliente"]; ?></td>
                </tr>
                <tr>
                    <th>Fecha</th>
                    <td><?php echo $factura["fecha_emision"]; ?></td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td>
                    <th>Estado</th>
                    <td><?php
                      if ($factura["estado_factura"] == 1) {
                      ?>
                      <span class="badge badge-success">Emitido</span>
                    <?php
                      } else {
                    ?>
                      <span class="badge badge-danger">Anulado</span>
                    <?php
                      } ?></td> 
                    </td>
                </tr>
                <tr>
                    <th>Emitido por:</th>
                    <td><?php echo $factura["usuario"]; ?></td>
                </tr>
               
            </table>
        </div>
        <div class="col-sm-6" style="text-align:center">
           <table class="table">
            <thead>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Total</th>
            </thead>

            <tbody>
                <?php
                foreach($producto as $value){
                ?>
                <tr>
                    <td><?php echo $value["descripcion"]; ?></td>
                    <td><?php echo $value["cantidad"]; ?></td>
                    <td><?php echo $value["precioUnitario"]; ?></td>
                    <td><?php echo $value["montoDescuento"]; ?></td>
                    <td><?php echo $value["subtotal"]; ?></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="4"><b>Total</b></td>
                    <td><?php echo $factura["neto"]; ?></td>
                </tr>
                </tbody>

           </table>
        </div>
    </div>
</div>



</div>