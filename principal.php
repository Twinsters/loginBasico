<?php
  include('librerias.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <script src="principal.js"></script>
<style>
    #tablaAlumnos_wrapper{
        margin-top: 15px; 
        margin-bottom: 15px;
    }
</style>
</head>
<body> 
<?php 
  include("nav.php");
?>
<div  class="container ">
  <div class="row row-cols-1 row-cols-md-2 g-4" id="cardsContainer"></div>
</div>
</body>
</html>

<div id= "modalMaterias" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style='background-color:#1e8ec6;'>
        <h5 class="modal-title">Materias</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBodyMaterias"> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>