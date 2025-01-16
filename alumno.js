$(document).ready(function(){  
    crearDataTable("tablaAlumnos");
    buscarAlumnos();
    buscarLocalidad();
    crearDatePicker("datepicker");
});
function buscarAlumnos(){
    $.ajax({
        url:'loginBG.php',
        method:'GET',
        data:{
            'case':'buscarAlumnos'
        },
        dataType:'json',
        success:function(response){
            $("#tablaAlumnos").DataTable().clear().draw();
            $.each(response.datos,function(i,alumno){
             
                $("#tablaAlumnos").DataTable().row.add({
                    "0":alumno.Codigo,
                    "1":alumno.Nombre,
                    "2":alumno.Apellido,
                    "3":alumno.DNI,
                    "4":alumno.FechaNac,
                    "5":alumno.Localidad,
                    "6":iconoAccionesAlumnos(alumno.Codigo)
                }).draw();
            });
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
function iconoAccionesAlumnos(codigo){
    var retorno="";
    retorno = retorno + '<button type="button" onclick="mostrarModalAlumnos('+codigo+')" class="btn btn-primary">Editar</button>'
    return retorno;
}

function buscarLocalidad(){
    $.ajax({
        url:"alumnoBG.php",
        method:"GET",
        data:{
            'case': "buscarLocalidades",           
        },
        dataType:"json",
        success:function(response){
            $('#sltLocalidad').empty();
            $.each(response.datos,function(i,localidad){
                $("#sltLocalidad").append(new Option(localidad.Nombre,localidad.Codigo));
            });
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
function mostrarModalAlumnos(codigo=""){
    if(codigo != ""){
        $.ajax({
            url : "alumnoBG.php",
            method: "POST",
            data:{
                'case':'buscarAlumno',
                'idAlumno':codigo
            },
            dataType:"json",
            success:function(response){
                $("#codigoAlumno").val(response.datos[0].Codigo);
                $("#txtNombre").val(response.datos[0].Nombre);    
                $("#txtApellido").val(response.datos[0].Apellido);  
                $("#txtDNI").val(response.datos[0].DNI);           
                $("#datepicker").val(response.datos[0].FechaNac);           
                $("#sltLocalidad").val(response.datos[0].CodLocalidad);
            },
            error:function(error,status,xhr){
                console.error('Error en la solicitud:', error);
                console.error('Estado:', status);
                console.error('Respuesta del servidor:', xhr.responseText);
                let resp = JSON.parse(xhr.responseText);  
                alert(resp.message); 
            }
        });
    }
    else{
        $("#txtNombre").val("");
        $("#txtApellido").val("");
        $("#txtDNI").val("");
        $("#datepicker").val(obtenerFechaHoy());
        $("#sltLocalidad").val(1);
    }
    $("#modalDatosAlumnos").modal('show');
}
function guardarDatos(){
    $.ajax({
        url: "alumnoBG.php",
        method:$("#codigoAlumno").val()!=""?"PUT":"POST",
        data:{
            'case':$("#codigoAlumno").val()!=""?'modificarAlumno':'guardarAlumno',
            'idAlumno': $("#codigoAlumno").val(),
            'nombre': $("#txtNombre").val(),    
            'apellido' : $("#txtApellido").val(),  
            'dni': $("#txtDNI").val(),           
            'fechaNac': $("#datepicker").val(),           
            'codLocalidad': $("#sltLocalidad").val()
        },
        dataType:'json',
        success:function(response){
            if(response.success){
                alert("Datos guardados correctamente");
                buscarAlumnos();
            }
            else{
                alert("Datos no guardados correctamente");
            }
        },
        error:function(error,status, xhr){
            console.error('Error en la solicitud:', error);
            console.error('Estado:', status);
            console.error('Respuesta del servidor:', xhr.responseText);
            let resp = JSON.parse(xhr.responseText);  
            alert(resp.message);
        }

    });
}



 