$(document).ready(function(){
    crearDataTable("idTableMaterias");
    buscarMaterias();
});

function buscarMaterias(){
    $.ajax({
        url:"materiaBG.php",
        method:"GET",
        data:{
            'case':'buscarMaterias'
        },
        dataType:'json',
        success:function(response){
            $("#idTableMaterias").DataTable().clear().draw();
            $.each(response.datos,function(i,materia){
                $("#idTableMaterias").DataTable().row.add({
                    "0":materia.Codigo,
                    "1":materia.Nombre,
                    "2":iconoAccionesMaterias(materia.Codigo)
                }).draw();
            })
        },
        error:function(xhr,status,error){
            console.error('Error en la solicitud:', error);
            console.error('Estado:', status);
            console.error('Respuesta del servidor:', xhr.responseText);
            let resp = JSON.parse(xhr.responseText);  
            alert(resp.message);    
        }
    })
}


function modalMateria(idMateria=""){
    
    if(idMateria !=""){
        $.ajax({
            url:"materiaBG.php",
            method:"GET",
            data:{
            'case':'buscarMateria',
            'idMateria':idMateria
            },
            dataType:'json',
            success:function(response){
                $("#txtCodigo").val(response.datos[0].Codigo);
                $("#txtNombre").val(response.datos[0].Nombre);
            },
            error:function(xhr,error,status){
                console.error('Error en la solicitud:', error);
                console.error('Estado:', status);
                console.error('Respuesta del servidor:', xhr.responseText);
                let resp = JSON.parse(xhr.responseText);  
                alert(resp.message);   
            }
        });
    }else{
        $("#txtCodigo").val("");
        $("#txtNombre").val("");
    }
    $("#modalMateria").modal('show');
}
function guardarMateria(){
    $.ajax({
        url:'materiaBG.php',
        method:$("#txtCodigo").val()!=""?"PUT":"POST",
        data:{
            'case':$("#txtCodigo").val()!=""?'modificarMateria':'guardarMateria',
            'idMateria':$("#txtCodigo").val(),
            'nombre':$("#txtNombre").val()
        },
        success:function(response){
            alert("Datos guardados correctamente");
            $("#modalMateria").modal('hide');
            buscarMaterias();
        },
        error:function(xhr,error,status){
            console.error('Error en la solicitud:', error);
            console.error('Estado:', status);
            console.error('Respuesta del servidor:', xhr.responseText);
            let resp = JSON.parse(xhr.responseText);  
            alert(resp.message);   
        }
    });

}

function modalEliminarMateria(idMateria){
    $("#modalEliminarMateria").modal('show');
    $("#btnEliminarMateria").unbind('click');
    $("#btnEliminarMateria").click(function(){
        $.ajax({
            url:'materiaBG.php',
            method:'DELETE',
            data:{
                'case':'eliminarMateria',
                'idMateria':idMateria
            },
            dataType:'json',
            success:function(){
                alert("Materia eliminada exitosamente");
                $("#modalEliminarMateria").modal('hide');
                buscarMaterias();
            },
            error:function(xhr,status,error){
                console.error('Error en la solicitud:', error);
                console.error('Estado:', status);
                console.error('Respuesta del servidor:', xhr.responseText);
                let resp = JSON.parse(xhr.responseText);  
                alert(resp.message);    
            }
        });
    });  
}
function iconoAccionesMaterias(idMateria){
    var retorno = "";
    retorno =  retorno + '<buttom type="buttom" onclick="modalMateria('+idMateria+')" class="btn btn-primary" >Editar</buttom>'
    retorno =  retorno + '<buttom type="buttom" onclick="modalEliminarMateria('+idMateria+')" style="margin-left:5px;" class="btn btn-danger">Eliminar</buttom>'
    return retorno;
}