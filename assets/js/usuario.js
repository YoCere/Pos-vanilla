function MNuevoUsuario(){
    $("#modal-default").modal("show")
    var obj=""
    $.ajax({
        type:"POST",
        url:"vista/usuario/FNuevoUsuario.php",
        data:obj,
        success:function(data){
            $("#content-default").html(data)
        }
    })
}

function regUsuario(){
    var formData=new FormData($("#FRegUsuario")[0])
    console.log(formData.get("login"));
    if(formData.get("password")==formData.get("vrPassword")){
        $.ajax({
            type:"POST",
            url:"controlador/usuarioControlador.php?ctrRegUsuario",
            data:obj,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                console.log(data)
            }
        })
    }
}