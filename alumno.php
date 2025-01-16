<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <?php
        include('librerias.php');
    ?>
    <script src="alumno.js"></script>
   
</head>
<body>
    <?php
        include('nav.php');
    ?>
    <div class="container" style="margin-top:20px;" >
        <button type="button" class="btn btn-primary" onclick="mostrarModalAlumnos();">Nuevo</button>
        <table id="tablaAlumnos" >
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Fecha Nacimiento</th>
                <th>Localidad</th>
                <th>Acciones</th>
            </thead>
            <tbody>      
            </tbody>
        </table>
    </div>    
</body>
</html>


<!-- Modal Alta/Modificacion  -->
<div id= "modalDatosAlumnos" class="modal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header"  style='background-color:#1e8ec6; color:white;'>
        <h5 class="modal-title">Alumno</h5>
        <input type="hidden" id="codigoAlumno">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Nombre</span>
                    <input type="text" class="form-control" id="txtNombre" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Apellido</span>
                    <input type="text" class="form-control" id="txtApellido" placeholder="Apellido" aria-label="Apellido" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">DNI</span>
                    <input type="text" class="form-control" id="txtDNI" placeholder="DNI" aria-label="DNI" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Fecha Nacimiento</span>
                    <input  id="datepicker" class="form-control" aria-describedby="basic-addon1">
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-6">
            <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Localidad</span>
                    <select id="sltLocalidad" class="form-select" aria-label="Select de Localidad">
                    </select>
                </div>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="guardarDatos();" data-bs-dismiss="modal">Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>