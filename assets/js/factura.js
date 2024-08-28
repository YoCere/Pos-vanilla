//variables globales
var host="http://localhost:5000/"
function verificarComunicacion(){
    var obj=""

    $.ajax({
        type:"POST",
        url:host+"api/CompraVenta/comunicacion",
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