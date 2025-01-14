<?php

    include('librerias.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <script src="tabla.js"></script>
<style>
    #tablaAlumnos_wrapper{
        margin-top: 15px; 
        margin-bottom: 15px;
    }
</style>

</head>
<body>
    <div class="row" style='text-align:center;' >
        <div class="col-12">
            <h3 style="margin-top:30px; font-family:'Times New Roman', Times, serif;color:#317300;">Tabla de Alumnos</h3>
        </div>
    </div>

<div class="container border border-primary" style="margin-top:30px;" >
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