<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include("librerias.php");
    ?>
    <script src="asignarMateria.js"></script>
    <title>Asingar</title>
</head>
<body>
    <?php
        include("nav.php");
    ?>
    <div class="container" style= "margin-top:20px;">
        <table id="idTablaAlumnosMaterias">
            <thead>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Opciones</th>
            </thead>
            <tbody></tbody>
        </table>
    </div>  
</body>
</html>
<!-- Modal Materia -->
<div class="modal" id="modalAsignarMateria" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style='background-color:#1e8ec6; color:white;'>
        <h5 class="modal-title">Materia</h5>
        <input type="hidden" id="txtCodigo">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Materias</span>
            <select class="form-select" aria-label="Select de Materias" id="sltMaterias"></select>
        </div>
        <tabla id="idTablaMateriasAsignadas">
            <thead>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Estado</th>
            </thead>
            <tbody></tbody>
        </tabla>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="guardarMateria();">Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
