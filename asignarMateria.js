$(document).ready(function(){
    crearDataTable('idTablaAlumnosMaterias');
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
function modalAsignarMateria(idAlumno){
    $("#modalAsignarMateria").modal('show');
    $.ajax({
        url:'asignarMateriaBG.php',
        method:'GET',
        /*data:{
            'case':
        }
*/
    })
}