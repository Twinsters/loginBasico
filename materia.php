<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materias</title>
<?php 
    include("librerias.php");
?>
<script src = "materia.js"></script>
</head>
<body>
    <?php 
        include("nav.php");
    ?>
    <div class="container" style= "margin-top:20px;">
      <button type="button"  class="btn btn-primary"  onclick="modalMateria();">Nueva</button>
      <table id="idTableMaterias">
          <thead>
              <th>Codigo</th>
              <th>Materia</th>
              <th>Opciones</th>
          </thead>
          <tbody></tbody>
      </table>
    </div> 
</body>
</html>

<!-- Modal Materia -->
<div class="modal" id="modalMateria" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style='background-color:#1e8ec6; color:white;'>
        <h5 class="modal-title">Materia</h5>
        <input type="hidden" id="txtCodigo">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nombre</span>
            <input type="text" class="form-control" id="txtNombre" placeholder="nombre" aria-label="nombre" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="guardarMateria();">Guardar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar Materia -->
<div class="modal" id="modalEliminarMateria" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style='background-color:#1e8ec6; color:white;'>
        <h5 class="modal-title">Eliminar Materia</h5>
        <input type="hidden" id="txtCodigo">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Desea eliminar la materia?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnEliminarMateria">Eliminar</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
