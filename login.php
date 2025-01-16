<?php
include('librerias.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="login.js"></script>
    <title>Login</title>

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
                <h3>Login</h3>
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Usuario</span>
            <input type="text" id="txtUsuario" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Contraseña</span>
            <input type="password" id="txtPass" class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon1">
          </div>
 
        <div class="row" style="margin-top:10px; margin-bottom:10px;text-align:center;">
            <div class="col-12">
                <button class="btn btn-primary" onclick="buscar();">Entrar</button>
            </div>
        </div>
        <div class="row" style="margin-top:10px; margin-bottom:10px;text-align:center;">
            <div class="col-12">
                <a href="registrar.php">Registrarse</a>
            </div>
        </div>
    
    
    </div>
</body>
</html>





