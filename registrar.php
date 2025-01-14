<?php
include('librerias.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="login.js"></script>
    <title>Registro</title>
    <style>
        body, html {
            height: 100%; 
            margin: 0;
            display: grid; 
            place-items: center;
        }

    </style>
</head>
<body>
    <div class="container border border-primary">

    <div class="row" style="text-align:center;margin:10px;font-family:Roboto, sans-serif; ">
        <div class="col-12">
            <h3>Registro</h3>
        </div>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Usuario</span>
        <input type="text" id="txtUsuarioRegistro" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Contraseña</span>
        <input type="password" id="txtPassRegistro" class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon1">
    </div>

    <div class="row" style="margin-top:10px; margin-bottom:10px;text-align:center;">
        <div class="col-12">
            <button class="btn btn-primary" onclick="registrarUsuario();">Registrar</button>
        </div>
    </div>
</div>
</body>
</html>