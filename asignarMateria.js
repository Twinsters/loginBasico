var listaMaterias=[];
$(document).ready(function(){
    crearDataTable('idTablaAlumnosMaterias');
    crearDataTable('idTablaMateriasAsignadas',false);
    
    buscarAlumnos();
   

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
            $("#idTablaAlumnosMaterias").DataTable().clear().draw();
            $.each(response.datos,function(i,alumno){
                $("#idTablaAlumnosMaterias").DataTable().row.add({
                    "0":alumno.Codigo,
                    "1":alumno.Nombre,
                    "2":alumno.Apellido,
                    "3":alumno.DNI,
                    "4":iconoAlumnosMaterias(alumno.Codigo)
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
    })
}

function iconoAlumnosMaterias(idAlumno){
    var retorno = "";
    retorno = retorno + "<buttom type='buttom' class='btn btn-success' onclick='modalAsignarMateria("+idAlumno+")'>Asignar</buttom>"
    return retorno;
}
function traerMateriasDisponibles(idAlumno){
    $.ajax({
        url:'asignarMateriaBG.php',
        method:'GET',
        data:{
            'case': 'traerMateriasDisponibles',
            'idAlumno': idAlumno
        },
        dataType:'json',
        success:function(response){
            var select = $('#sltMaterias');
            select.empty();
            if(response.datos.length > 0){
                $.each(response.datos,function(i, materia){
                    select.append("<option value ="+materia.Codigo+">"+materia.Nombre+"</option>");
                });
            }
            else {
                select.append('<option value="">No hay materias disponibles</option>');
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

function modalAsignarMateria(idAlumno){
    $("#modalAsignarMateria").modal('show');
    traerMateriasDisponibles(idAlumno);
    $("#idTablaMateriasAsignadas").DataTable().clear().draw();
    $.ajax({
        url:'asignarMateriaBG.php',
        method:'GET',
        data:{
            'case': 'traerMateriasAlumno',
            'idAlumno': idAlumno
        },
        dataType:'json',
        success:function(response){
           
            $.each(response.datos,function(i, materia){
                $("#idTablaMateriasAsignadas").DataTable().row.add({
                    "0":materia.CodigoAM,
                    "1":materia.Codigo,
                    "2":materia.Nombre,
                    "3":estadosMateria(materia.Cod_estado.trim())
                    
                }).draw();
                listaMaterias.add(materia);
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
function estadosMateria(estadoActual){
 return  `
        <select id = "selectEstadoMateria" class="form-select">
            <option value="A" ${estadoActual == 'A' ? 'selected' : ''}>Activo</option>
            <option value="E" ${estadoActual == 'E' ? 'selected' : ''}>Eliminado</option>
            <option value="C" ${estadoActual == 'C' ? 'selected' : ''}>Cursando</option>
        </select>
    `;

}