//variables globales
var host="http://localhost:5000"
var codSistema="775FA42BE90F7B78EF98F57"
var cuis="9272DC05"
var nitEmpresa=338794023
var token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJTdXBlcmppY2hvMzMiLCJjb2RpZ29TaXN0ZW1hIjoiNzc1RkE0MkJFOTBGN0I3OEVGOThGNTciLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0ydGpDM05ERXdNZ1lBOFFXMzNRa0FBQUE9IiwiaWQiOjYxODYwOCwiZXhwIjoxNzMzOTYxNjAwLCJpYXQiOjE3MDI0OTc2NjAsIm5pdERlbGVnYWRvIjozMzg3OTQwMjMsInN1YnNpc3RlbWEiOiJTRkUifQ.4K_pQUXnIhgI5ymmXoyL43i0pSk3uKCgLMkmQeyl67h7j55GSRsH120AD44pR0aQ1UX_FNYzWQBYrX6pWLd-1w"
var rsEmpresa="NEOMAC SRL"
var telEmpresa="9422560"
var dirEmpresa="Calle Pucara 129 AVENIDA 7MO ANILLO NRO. 7550 ZONA/BARRIO: TIERRAS NUEVAS UV:0135 MZA: 007"
var cufd;
var codControlCufd;
var fechaVigCufd;

function verificarComunicacion(){
    var obj=""

    $.ajax({
        type:"POST",
        url:host+"/api/CompraVenta/comunicacion",
        data:obj,
        cache:false,
        contentType:"application/json",
        processData:false,
        success:function(data){
            if(data["transaccion"]==true){
                document.getElementById("comunicacionSiat").innerHTML="Conectado"
                document.getElementById("comunicacionSiat").className="badge badge-success"
            }
        }
    }).fail(function(jqXHR, textStatus, errorThrown){
        if(jqXHR.status==0){
            document.getElementById("comunicacionSiat").innerHTML="Desconectado"
            document.getElementById("comunicacionSiat").className="badge badge-danger"
        }
    })
}

setInterval(verificarComunicacion,3000)

function busCliente(){
    let nitCliente=document.getElementById("nitCliente").value

    var obj={
        nitCliente:nitCliente
    }
    $.ajax({
        type:"POST",
        url:"controlador/clienteControlador.php?ctrBusCliente",
        data:obj,
        dataType:"json",
        success:function(data){
            if(data["email_cliente"]==""){
                document.getElementById("emailCliente").value="null"
            }else{
                document.getElementById("emailCliente").value=data["email_cliente"]
            }
            document.getElementById("rsCliente").value=data["razon_social_cliente"]
            document.getElementById("idCliente").value=data["id_cliente"]
            numFactura()
        }

    })
}

//generar numero de factura

function numFactura(){
    let obj=""
    
    $.ajax({
        type:"POST",
        url:"controlador/facturaControlador.php?ctrNumFactura",
        data:obj,
        success:function(data){
            console.log(data)
            document.getElementById("numFactura").value=data
        }
    })
}

function busProducto(){
    let codProducto=document.getElementById("codProducto").value

    var obj={
        codProducto:codProducto
    }
    $.ajax({
        type:"POST",
        url:"controlador/productoControlador.php?ctrBusProducto",
        data:obj,
        dataType:"json",
        success:function(data){
            document.getElementById("conceptoPro").value=data["nombre_producto"];
            document.getElementById("uniMedida").value=data["unidad_medida"];
            document.getElementById("preUnitario").value=data["precio_producto"];

            document.getElementById("uniMedidaSin").value=data["unidad_medida_sin"];
            document.getElementById("codProductoSin").value=data["cod_producto_sin"];

            
        }

    })
}

function calcularPreProducto(){
    let cantPro=parseInt(document.getElementById("cantProducto").value)
    let descProducto=parseFloat(document.getElementById("descProducto").value)
    let preUnit=parseFloat(document.getElementById("preUnitario").value)

    let preProducto=preUnit*cantPro
    
    document.getElementById("preTotal").value=preProducto-descProducto
}

//Carrito-------------------
var arregloCarrito=[]
var listaDetalle=document.getElementById("listaDetalle")

function agregarCarrito(){
    let actEconomica=document.getElementById("actEconomica").value
    let codProducto=document.getElementById("codProducto").value
    let codProductoSin=parseInt(document.getElementById("codProductoSin").value)
    let conceptoPro=document.getElementById("conceptoPro").value
    let cantProducto=parseInt(document.getElementById("cantProducto").value)
    let uniMedida=document.getElementById("uniMedida").value
    let uniMedidaSin=parseInt(document.getElementById("uniMedidaSin").value)
    let preUnitario=parseFloat(document.getElementById("preUnitario").value)
    let descProducto=parseFloat(document.getElementById("descProducto").value)
    let preTotal=parseFloat(document.getElementById("preTotal").value)

    let objDetalle={
        actividadEconomica:actEconomica,
        codigoProductoSin:codProductoSin,
        codigoProducto:codProducto,
        descripcion:conceptoPro,
        cantidad:cantProducto,
        unidadMedida:uniMedidaSin,
        precioUnitario:preUnitario,
        montoDescuento:descProducto,
        subtotal:preTotal
    }

    arregloCarrito.push(objDetalle)
    dibujarTablaCarrito()

    //vaciar el formulario del carrito

    document.getElementById("codProducto").value=""
    document.getElementById("codProductoSin").value=""
    document.getElementById("conceptoPro").value=""
    document.getElementById("cantProducto").value="1"
    document.getElementById("uniMedida").value=""
    document.getElementById("uniMedidaSin").value=""
    document.getElementById("preUnitario").value="0.00"
    document.getElementById("descProducto").value="0.00"
    document.getElementById("preTotal").value="0.00"

}

function dibujarTablaCarrito(){
    listaDetalle.innerHTML=""

    arregloCarrito.forEach((detalle)=>{
        let fila=document.createElement("tr")
        fila.innerHTML='<td>'+detalle.descripcion+'</td>'+
        '<td>'+detalle.cantidad+'</td>'+
        '<td>'+detalle.precioUnitario+'</td>'+
        '<td>'+detalle.montoDescuento+'</td>'+
        '<td>'+detalle.subtotal+'</td>'

        let tdEliminar=document.createElement("td")
        let botonEliminar=document.createElement("button")
        botonEliminar.classList.add("btn", "btn-danger")
        botonEliminar.innerText="Eliminar"
        botonEliminar.onclick=()=>{
            eliminarCarrito(detalle.codigoProducto)
        }
        tdEliminar.appendChild(botonEliminar)
        fila.appendChild(tdEliminar)

        listaDetalle.appendChild(fila)
    })

    calcularTotal()
}

function eliminarCarrito(cod){
    arregloCarrito=arregloCarrito.filter((detalle)=>{
        if(cod!=detalle.codigoProducto){
            return detalle
        }
    })
    dibujarTablaCarrito()
}

function calcularTotal(){
    let totalCarrito=0

    for(var i=0; i<arregloCarrito.length; i++){
        totalCarrito=totalCarrito+parseFloat(arregloCarrito[i].subtotal)
    }
    document.getElementById("subTotal").value=totalCarrito
    let descAdicional=parseFloat(document.getElementById("descAdicional").value)
    document.getElementById("totApagar").value=totalCarrito-descAdicional
}

//Obtencion de CUFD
function solicitudCufd(){
    return new Promise((resolve, reject)=>{
        var obj={
            codigoAmbiente:2,
            codigoModalidad:2,
            codigoPuntoVenta:0,
            codigoPuntoVentaSpecified:true,
            codigoSistema:codSistema,
            codigoSucursal:0,
            nit:nitEmpresa,
            cuis:cuis
        }
        $.ajax({
            type:"POST",
            url:host+"/api/Codigos/solicitudCufd?token="+token,
            data:JSON.stringify(obj),
            cache:false,
            contentType:"application/json",
            success:function(data){
                cufd=data["codigo"]
                codControlCufd=data["codigoControl"]
                fechaVigCufd=data["fechaVigencia"]

                resolve(cufd)
            }
        })
    })
    
    
}
//Registrar cufd

function registrarNuevoCufd(){
    solicitudCufd().then(ok=>{
        if(ok!="" || ok!=null){
            var obj={
                "cufd":cufd,
                "fechaVigCufd":fechaVigCufd,
                "codControlCufd":codControlCufd
            }
            $.ajax({
                type:"POST",
                data:obj,
                url:"controlador/facturaControlador.php?ctrNuevoCufd",
                cache:false,
                success:function(data){
                    if(data=="ok"){
                    $("#panelInfo").before("<span class='text-primary'>Cufd registrado</span><br>")
                }else{
                    $("#panelInfo").before("<span class='text-warning'>Error de registro CUFD...</span><br>")
                }
            }
            })
        }
    })
    
}

function verfificarVigenciaCufd(){
    let date=new Date()

    //obteniendo el ultimo registro de cufd

    var obj=""
    $.ajax({
        type:"POST",
        url:"controlador/facturaControlador.php?ctrUltimoCufd",
        data:obj,
        cache:false,
        dataType:"json",
        success:function(data){    
            //comprobacion
            //let VigCufdActual=new Date(data["fecha_vigencia"])
            //let VigCufdActual = new Date(data["fecha_vigencia"]);
            //console.log("Fecha actual: ", date);
            //console.log("Fecha de vigencia CUFD: ", VigCufdActual);
            //console.log("Fecha actual: ", date);
            //console.log("Fecha de vigencia CUFD: ", VigCufdActual);
            //if(date.getTime()>VigCufdActual.getTime()){
            //let now = new Date();
            //let VigCufdActual = new Date(data["fecha_vigencia"]);

            // Convertir a zona horaria local (Bolivia Time GMT-4)
            //let nowLocal = new Date(now.toLocaleString("en-US", { timeZone: "America/La_Paz" }));
            //let VigCufdActualLocal = new Date(VigCufdActual.toLocaleString("en-US", { timeZone: "America/La_Paz" }));

            // Comparar
            //if (nowLocal.getTime() > VigCufdActualLocal.getTime()) {
            let vigCufdActual=new Date(data["fecha_vigencia"])
            console.log(vigCufdActual)
            console.log(date)

            if(date.getTime()>vigCufdActual.getTime()){
                $("#panelInfo").before("<span class='text-warning'>Cufd caducado!!</span><br>")
                $("#panelInfo").before("<span class='text-warning'>Registrando cufd...</span><br>")
                registrarNuevoCufd()
            }else{
                $("#panelInfo").before("<span class='text-warning'>Cufd vigente, haciendo procesos magicos...</span><br>")
                $("#panelInfo").before("<span class='text-warning'>procesos magicos, finalizados</span><br>")
                //Actualizando variables
                cufd=data["codigo_cufd"]
                codControlCufd=data["codigo_control"]
                fechaVigCufd=data["fecha_vigencia"]
            }
        }
    })
}

//========================
//Tranformar fecha a formato ISO 8601
//=======================

function transformarFecha(fechaISO){
    let fecha_iso=fechaISO.split("T")
    let hora_iso=fecha_iso[1].split(".")

    let fecha=fecha_iso[0]
    let hora=hora_iso[0]

    let fecha_hora=fecha+" "+hora
    return fecha_hora
}


//========================
//validacion de formulario
//=======================
function validarFormulario(){
    let numFactura=document.getElementById("numFactura").value
    let nitCliente=document.getElementById("nitCliente").value
    let emailCliente=document.getElementById("emailCliente").value
    let rsCliente=document.getElementById("rsCliente").value

    if(numFactura==null || numFactura.length==0){
        $("#panelInfo").before("<span class='text-danger'>Asegurate de llenar los campos faltantes</span><br>")
        return false
    }else if(nitCliente==null || nitCliente.length==0){
        $("#panelInfo").before("<span class='text-danger'>Asegurate de llenar los campos faltantes</span><br>")
        return false
    }else if(emailCliente==null || emailCliente.length==0){
        $("#panelInfo").before("<span class='text-danger'>Asegurate de llenar los campos faltantes</span><br>")
        return false
    }else if(rsCliente==null || rsCliente.length==0){
        $("#panelInfo").before("<span class='text-danger'>Asegurate de llenar los campos faltantes</span><br>")
        return false
    }
    return true
}


//obtener leyenda
function extraerLeyenda(){
    var obj=""
    $.ajax({
        type:"POST",
        url:"controlador/facturaControlador.php?ctrLeyenda",
        cache:false,
        dataType:"json",
        success:function(data){
            leyenda=data["desc_leyenda"]
        }
    })
}

function emitirFactura(){
    if(validarFormulario()==true){
        
    let date = new Date()
    let numFactura=parseInt(document.getElementById("numFactura").value)
    let fechaFactura=date.toISOString()
    let rsCliente=document.getElementById("rsCliente").value
    let tpDocumento=parseInt(document.getElementById("tpDocumento").value)
    let nitCliente=document.getElementById("nitCliente").value
    let metPago=parseInt(document.getElementById("metPago").value)
    let totApagar=parseFloat(document.getElementById("totApagar").value)
    let descAdicional=parseFloat(document.getElementById("descAdicional").value)
    let subTotal=parseFloat(document.getElementById("subTotal").value)
    let usuarioLogin=document.getElementById("usuarioLogin").innerHTML
    let actEconomica=document.getElementById("actEconomica").value
    let emailcliente=document.getElementById("emailCliente").value

    var obj={
        codigoAmbiente:2,
        codigoDocumentoSector:1,
        codigoEmision:1,
        codigoModalidad:2,
        codigoPuntoVenta:0,
        codigoPuntoVentaSpecified:true,
        codigoSistema: codSistema,
        codigoSucursal: 0,
        cufd:cufd,
        cuis:cuis,
        nit:nitEmpresa,
        tipoFacturaDocumento:1,
        archivo:null,
        fechaEnvio:fechaFactura,
        hashArchivo:"",
        codigoControl:codControlCufd,
        factura:{
            cabecera:{
                nitEmisor:nitEmpresa,
                razonSocialEmisor: rsEmpresa,
                municipio: "Santa Cruz",
                telefono: telEmpresa,
                numeroFactura:numFactura,
                cuf:"String",
                cufd:cufd,
                codigoSucursal:0,
                direccion:dirEmpresa,
                codigoPuntoVenta:0,
                fechaEmision:fechaFactura,
                nombreRazonSocial:rsCliente,
                codigoTipoDocumentoIdentidad:tpDocumento,
                numeroDocumento:nitCliente,
                complemento:"",
                codigoCliente:nitCliente,
                codigoMetodoPago:metPago,
                numeroTarjeta:null,
                montoTotal:totApagar,
                montoTotalSujetoIva:totApagar,
                codigoMoneda:1,
                tipoCambio:1,
                montoTotalMoneda:totApagar,
                montoGiftCard:0,
                descuentoAdicional:descAdicional,
                codigoExcepcion:0,
                cafc:null,
                leyenda:leyenda,
                usuario:usuarioLogin,
                codigoDocumentoSector:1
            },
            detalle:arregloCarrito
        }
    }
    
    $.ajax({
        type:"POST",
        url:host+"/api/CompraVenta/recepcion",
        data:JSON.stringify(obj),
        cache:false,
        contentType:"application/json",
        processData:false,
        success:function(data){
            console.log(data)
            if(data["codigoResultado"]!=908){
                $("panelInfo").before("<span class='text-danger'>Error, factura no emitida!!!</span><br>")
            }else{
                $("panelInfo").before("<span>Registrando factura... </span><br>")
                
                let datos={
                codigoResultado:data["codigoResultado"],
                codigoRecepcion:data["datoAdicional"]["codigoRecepcion"],
                cuf:data["datoAdicional"]["cuf"],
                sentDate:data["datoAdicional"]["sentDate"],
                xml:data["datoAdicional"]["xml"],
                }
                registrarFactura(datos)
            }
        }

    })

    }
}

function registrarFactura(datos){
    let numFactura=document.getElementById("numFactura").value
    let idCliente=document.getElementById("idCliente").value
    let subTotal=parseFloat(document.getElementById("subTotal").value)
    let descAdicional=parseFloat(document.getElementById("descAdicional").value)
    let totApagar=parseFloat(document.getElementById("totApagar").value)
    let fechaEmision=transformarFecha(datos["sentDate"])
    let idUsuario=document.getElementById("idUsuario").value
    let usuarioLogin=document.getElementById("usuarioLogin").innerHTML

    let obj={
        "codFactura":numFactura,
        "idCliente":idCliente,
        "detalle":JSON.stringify(arregloCarrito),
        "neto":subTotal,
        "descuento":descAdicional,
        "total":totApagar,
        "fechaEmision":fechaEmision,
        "cufd":cufd,
        "cuf":datos["cuf"],
        "xml":datos["xml"],
        "idUsuario":idUsuario,
        "usuario":usuarioLogin,
        "leyenda":leyenda
    }

    $.ajax({
        type:"POST",
        url:"controlador/facturaControlador.php?ctrRegistrarFactura",
        data:obj,
        cache:false,
        success:function(data){
            if(data=="ok"){
                Swal.fire({
                    icon:"success",
                    showConfirmButton:false,
                    tittle:"Factura registrada"
                })
                setTimeout(function(){
                    location.reload()
                },1000)
            }else{
                Swal.fire({
                    icon:"error",
                    showConfirmButton:false,
                    tittle:"Error de registro intente de nuevo",
                    timmer:1500
                })
            }
            }
        })
}

function MVerFactura(id){
    $("#modal-xl").modal("show");
   
  var obj="";
  $.ajax({
 
     type:"POST",
     url:"vista/factura/MVerFactura.php?id="+id,
     data: obj,
     success: function(data) {
         $("#content-xl").html(data);
     }
  })
}

function MEliFactura(cuf){

    let obj={
      codigoAmbiente:2,
      codigoPuntoVenta:0,
      codigoPuntoVentaSpecified:true,
      codigoSistema:codSistema,
      codigoSucursal:0,
      nit:nitEmpresa,
      codigoDocumentoSector:1,
      codigoEmision:1,
      codigoModalidad:2,
      cufd:cufd,
      cuis:cuis,
      tipoFacturaDocumento:1,
      codigoMotivo:1,
      cuf:cuf}

    Swal.fire({
      title:"¿Está seguro de anular la factura seleccionada?",
      showDenyButton:true,
      showCancelButton:false,
      confirmButtonText:'Confirmar',
      denyButtonText:'Cancelar'
  }).then((result)=>{
      if(result.isConfirmed){
          $.ajax({
              type:"POST",
              url:host+"/api/CompraVenta/anulacion",
              data:JSON.stringify(obj),
              cache:false,
              contentType:"application/json",
              processData:false,
              success: function(data) {
                if(data["codigoEstado"]==905){
                  anularFactura(cuf)
                }
                else{
                  Swal.fire({
                    icon:'error',
                    title:"ERROR",
                    text:"Anulación rechazada",
                    showConfirmButton:false,
                    timer:1000
                })
                }
              }
          })
      }
  })
  }
  function anularFactura(cuf){
    let obj={
      cuf:cuf
    }
    $.ajax({
      type:"POST",
      url:"controlador/facturaControlador.php?ctrAnularFactura",
      data:obj,
      success: function(data) {
        if(data=="ok"){
          Swal.fire({
            icon:'success',
            title:"Factura Anulada ",
            showConfirmButton:false,
            timer:1000
        })
        setTimeout(function(){
          location.reload()
        },1200)
        }else{
          Swal.fire({
            icon:'error',
            title:"ERROR",
            text:"Error al anular",
            showConfirmButton:false,
            timer:1000
        })
        }
      }
  })
  }