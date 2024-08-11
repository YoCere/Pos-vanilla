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
    if(formData.get("password")==formData.get("vrPassword")){
        $.ajax({
            type:"POST",
            url:"controlador/usuarioControlador.php?ctrRegUsuario",
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                if(data="ok"){
                    Swal.fire({
                        title: "Usuario registrado correctamente",
                        width: 600,
                        padding: "3em",
                        color: "#716add",
                        background: "#fff url(/images/trees.png)",
                        backdrop: `
                          rgba(0,0,123,0.4)
                          url("/images/nyan-cat.gif")
                          left top
                          no-repeat
                        `,showConfirmButton:false
                        })
                        
                        setTimeout(function(){
                            location.reload()},1200)
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>'
                      });
                }
            }
        })
    }
}

function MEditUsuario(id){

    $("#modal-default").modal("show");
   
    var obj="";
    $.ajax({
   
       type:"POST",
       url:"vista/usuario/FEditUsuario.php?id="+id,
       data: obj,
       success: function(data) {
           $("#content-default").html(data);
       }
    })



    
} //final
function editUsuario(){
    console.log("Hola")
    var formData=new FormData($("#FEditUsuario")[0])
    if(formData.get("password")==formData.get("vrPassword")){
        $.ajax({
            type:"POST",
            url:"controlador/usuarioControlador.php?ctrEditUsuario",
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                if(data="ok"){
                    Swal.fire({
                        title: "Usuario actualizado correctamente",
                        width: 600,
                        padding: "3em",
                        color: "#716add",
                        background: "#fff url(/images/trees.png)",
                        backdrop: `
                          rgba(0,0,123,0.4)
                          url("assets/images/nyan-cat.gif")
                          left top
                          no-repeat
                        `,showConfirmButton:false
                        })
                        
                        setTimeout(function(){
                            location.reload()},1200)
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        footer: '<a href="#">Why do I have this issue?</a>'
                      });
                }          
            }
        })
    }
}
function MELiUsuario(id){
    var obj={
        id:id
    }
    Swal.fire({
        title:"Estas seguro de eliminar este usuario",
        showDenyButton:true,
        showCancelButton:false,
        confirmButtonTex:'Confirmar',
        denyButtonText:'Cancelar',
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    type:"POST",
                    url:"controlador/usuarioControlador.php?ctrEliUsuario",
                    data:obj,
                    success:function(data){
                    if(data=="ok"){
                        location.reload()
                        }else{
                            Swal.fire({
                                icon: "El usuario pudo ser eliminado",
                                title: "Oops...",
                                text: "Something went wrong!",
                                footer: '<a href="#">Why do I have this issue?</a>',
                                timer: 1000
                              });
                        }
                    }
                })
            }
    })
}