function buscar(){
    if($("#txtUsuario").val() !="" && $("#txtPass").val() != ""){
        $.ajax({
            url:"loginBG.php",
            type:"POST",
            data:{
                'case':'buscarUsuario',
                'usuario':$("#txtUsuario").val(),
                'pass':$("#txtPass").val(),      
            },
            dataType:'json',
            success:function(response){
                if(response.success){
                    console.log('Datos encontrados:',response.datos[0].usuario +" "+ response.datos[0].pass);
                    window.location.href="principal.php"; 
                }
                  else{
                    alert('Credenciales falsas'); 
                }        
            },
            error:function(xhr,status,error){
                console.error('Error en la solicitud:', error);
                console.error('Estado:', status);
                console.error('Respuesta del servidor:', xhr.responseText);
                let resp = JSON.parse(xhr.responseText);  
                alert(resp.message);         
            }   
        });
    }
    else{
        alert("Datos vacios");
    }
}
function registrarUsuario(){
    if($("#txtUsuarioRegistro").val() != "" && $("#txtPassRegistro").val() != ""){
        $.ajax({
            url:"loginBG.PHP",
            method:"POST",
            data:{
                'case':'registrarUsuario',
                'usuario':$("#txtUsuarioRegistro").val(),
                'pass':$("#txtPassRegistro").val(),
            },
            dataType:'json',     
            success:function(response){
                if(response.success){
                    window.location.href= "login.php";
                    alert('Datos guardados');
                }
                else{
                    alert("Error al guardar datos");
                }
            },
            error:function(xhr,status,error){
                console.error('Error en la solicitud:', error);
                console.error('Estado:', status);
                console.error('Respuesta del servidor:', xhr.responseText);
                alert('Ocurrió un error al realizar la solicitud.');   
            }
        });
    }
    else{
        alert("Espacios vacios");
    }
}