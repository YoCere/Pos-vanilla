  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
       
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <!-- Encabezado -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">Encabezado</div>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group row col-md-9">
            <div class="form-group col-md-3">  
              <label for="">#Factura</label>
              <input type="number" class="form-control" name="numFactura" id="numFactura" readonly ">
            </div>

            <div class="form-group col-md-3">
              <label for="">Actividad Economica</label>
                <select name="actEconomica" id="actEconomica" class="form-control">
                  <option value="106140">Servicios de comercio</option>
                </select>
            </div>
            
            <div class="form-group col-md-3">
              <label for="">Tipo de docuemento</label>
                <select name="tpDocumento" id="tpDocumento" class="form-control">
                  <option value="1">Ninguno</option>
                  <option value="1">Cedula de identidad</option>
                  <option value="5">NIT</option>
                </select>
            </div>

            <div class="form-group col-md-3">
              <label for="">NIT/CI</label>
              <div class="input-group">
              <input type="text" class="form-control" list="listaClientes" name="nitCliente" id="nitCliente">
                <div class="input-group-append">
                  <button class="btn btn-outline-secundary" type="button" onclick="busCliente()" onkeyup="numFactura()">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
            <datalist id="listaClientes">
              <?php
              $cliente = ControladorCliente::ctrInfoClientes();
              foreach($cliente as $value){
                ?>
                <option value="<?php echo $value["nit_ci_cliente"]?>"><?php echo $value["razon_social_cliente"]?>
                  </option>

                <?php
              }
              ?>
            </datalist>

            <div class="form-group col-md-6">
              <label for="">E-mail</label>
              <input type="email" class="form-control" name="emailCliente" id="emailCliente">
            </div>

            <div class="form-group col-md-6">
              <label for="">Razon Social</label>
              <input type="email" class="form-control" name="rsCliente" id="rsCliente">
            </div>

            

          </div>
          
          <div class="form-group row col-md-3">
            <div class="card">
                <div class="input-group sm-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Subtotal</span>
                  </div>
                  <input type="text" class="form-control" name="subTotal" id="subTotal" value="0.00" readonly>
                </div>
                
                <div class="input-group sm-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Descuento</span>
                  </div>
                  <input type="text" class="form-control" name="descAdicional" id="descAdicional" value="0.00"
                  onkeyup="calcularTotal()">
                </div>

                <div class="input-group sm-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Total</span>
                  </div>
                  <input type="text" class="form-control" name="totApagar" id="totApagar" value="0.00" readonly>
                </div>
                
                <div class="card-footer">
                  <label for="">Metodo de Pago</label>
                  <div class="input-group">
                    <select name="metPago" id="metPago" class="form-control">
                      <option value="1">Efectivo</option>
                    </select>

                    <div class="callaout callaout-info direct-chat-menssages" style="height: 100px; width: 290px;">
            <span class="list-unstyled" id="panelInfo"></span>
           </div>
                  </div>
                </div>
            </div>
          </div>
           <!--Panel de avisos-->
           
        </div>
      </div>
      <div class="card-footer">
        <button class="btn btn-success" onclick="emitirFactura()">Guardar</button>
      </div>

      <!-- Carrito -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">Encabezado</div>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="form-group col-md-2">
            <label for="">Cod. Producto</label>
            <div class="input-group form-group">
            <input type="text" class="form-control" list="listaProductos" name="codProducto" id="codProducto">
            <input type="hidden" id="codProductoSin" name="codProductoSin">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="busProducto()">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>

            <datalist id="listaProductos">
              <?php
              $productos = ControladorProducto::ctrInfoProductos();
              foreach($productos as $value){
                ?>
                <option value="<?php echo $value["cod_producto"]?>"><?php echo $value["nombre_producto"]?>
                  </option>

                <?php
              }
              ?>
            </datalist>
          
          </div>
          <div class="form-group col-md-4">
            <label for="">Concepto</label>
            <div class="input-group form-group">
              <input type="text" class="form-control" name="conceptoPro" id="conceptoPro" readonly>
            </div>
          </div>

          <div class="form-group col-md-1">
            <label for="">Cantidad</label>
            <div class="input-group form-group">
              <input type="text" class="form-control" name="cantProducto" id="cantProducto" onkeyup="calcularPreProducto()">
            </div>
          </div>

          <div class="form-group col-md-1">
            <label for="">U. medida</label>
            <div class="input-group form-group">
              <input type="text" class="form-control" name="uniMedida" id="uniMedida">
              <input type="hidden" id="uniMedidaSin" name="uniMedidaSin">
            </div>
          </div>

          <div class="form-group col-md-1">
            <label for="">P.Unitario</label>
            <div class="input-group form-group">
              <input type="text" class="form-control" name="preUnitario" id="preUnitario" readonly value="0.00" >
            </div>
          </div>

          <div class="form-group col-md-1">
            <label for="">Descuento</label>
            <div class="input-group form-group">
              <input type="text" class="form-control" name="descProducto" id="descProducto" value="0.00" onkeyup="calcularPreProducto()">
            </div>
          </div>

          <div class="form-group col-md-1">
            <label for="">P. Total</label>
            <div class="input-group form-group">
              <input type="text" class="form-control" name="preTotal" id="preTotal" readonly value="0.00">
            </div>
          </div>

          <div class="form-group col-md-1">
            <label for="">&nbsp;</label>
            <div class="input-group form-group">
              <button class="btn btn-info btn-circle form-control" onclick="agregarCarrito()">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>

        </div>
      </div>
      <div class="card-footer">
        <table class="table">
              <thead>
                <tr>
                  <th>Descripcion</th>
                  <th>Cantidad</th>
                  <th>P. Unitario</th>
                  <th>Descuento</th>
                  <th>P. Total</th>
                  <th>&nbsp;</th>
                </tr>
                <tbody id="listaDetalle"></tbody>
              </thead>
        </table>
      </div>
    </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>

  <script>
    
   
    setTimeout(()=>{
      verfificarVigenciaCufd()
    }, 4000 )
    setTimeout(()=>{
      extraerLeyenda()
    }, 4000 )
  </script>