$(document).ready(function(){
    $("#tablaAlumnos").DataTable();
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
        }
    });
}
 function iconoAccionesAlumnos(codigo){
    var retorno="";
    retorno = retorno + '<button type="button" class="btn btn-primary">Click</button>'
    return retorno;
 }

