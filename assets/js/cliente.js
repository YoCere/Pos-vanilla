function MNuevoCliente(){
    $("#modal-default").modal("show")
    var obj=""
    $.ajax({
        type:"POST",
        url:"vista/cliente/FNuevoCliente.php",
        data:obj,
        success:function(data){
            $("#content-default").html(data)
        }
    })
}

function regCliente(){
    var formData=new FormData($("#FRegCliente")[0])
        $.ajax({
            type:"POST",
            url:"controlador/ClienteControlador.php?ctrRegCliente",
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                if(data="ok"){
                    Swal.fire({
                        title: "Cliente registrado correctamente",
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

function MEditCliente(id){

    $("#modal-default").modal("show");
   
    var obj="";
    $.ajax({
   
       type:"POST",
       url:"vista/uliente/FEditCliente.php?id="+id,
       data: obj,
       success: function(data) {
           $("#content-default").html(data);
       }
    })



    
} //final
function editCliente(){
    console.log("Hola")
    var formData=new FormData($("#FEditCliente")[0])
    if(formData.get("password")==formData.get("vrPassword")){
        $.ajax({
            type:"POST",
            url:"controlador/clienteControlador.php?ctrEditCliente",
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                if(data="ok"){
                    Swal.fire({
                        title: "Cliente actualizado correctamente",
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
function MEliCliente(id){
    var obj={
        id:id
    }
    Swal.fire({
        title:"Estas seguro de eliminar este uliente",
        showDenyButton:true,
        showCancelButton:false,
        confirmButtonTex:'Confirmar',
        denyButtonText:'Cancelar',
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    type:"POST",
                    url:"controlador/clienteControlador.php?ctrEliCliente",
                    data:obj,
                    success:function(data){
                    if(data=="ok"){
                        location.reload()
                        }else{
                            Swal.fire({
                                icon: "El uliente pudo ser eliminado",
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