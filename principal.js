$(document).ready(function(){
    $("#tablaAlumnos").DataTable();
 
    buscarAlumnosCard();
});

function buscarAlumnosCard(){
    $.ajax({
        url:'loginBG.php',
        method:'GET',
        data:{
            'case':'buscarAlumnos'
        },
        dataType:'json',
        success:function(response){
            var containerCards = $("#cardsContainer");
            containerCards.empty();
            $.each(response.datos,function(i,alumno){               
                var card = $(`  
                    <div class="col">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="Img/usuario.jpg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${alumno.Codigo +" "+ alumno.Apellido + " " + alumno.Nombre}</h5>
                                        <p class="card-text">DNI: ${alumno.DNI}</p>
                                        <p class="card-text">Fecha Nacimiento: ${alumno.FechaNac}</p>
                                        <p class="card-text">Localidad: ${alumno.Localidad}</p>
                                        <button type="button" onclick="mostrarMaterias(${alumno.Codigo});" class="btn btn-primary">Materias</button>

                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    `);
                containerCards.append(card); 
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
function mostrarMaterias(codigo){
    $("#modalMaterias").modal('show');
    var bodyMaterias =$("#modalBodyMaterias");
    bodyMaterias.empty();
    $.ajax({
        url:'loginBG.php',
        method:'GET',
        data:{
            'case':'buscarMaterias',
            'idAlumno': codigo
        },
        dataType:'json',
        success:function(response){              
            if(response.datos.length > 0){
                $.each(response.datos,function(i,materia){       
                    var materias = $(`<div>    
                            <p>${materia.Nombre}</p>
                        </div>`);
                        bodyMaterias.append(materias);
                });
            }
        },
        error:function(xhr,status,error){
            console.error('Error en la solicitud:', error);
            console.error('Estado:', status);
            console.error('Respuesta del servidor:', xhr.responseText);
            let resp = JSON.parse(xhr.responseText);  
            alert(resp.messege);       
        }
    });     
}



