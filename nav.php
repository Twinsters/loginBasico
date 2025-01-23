
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
  include 'info.php';
  if (!isset($_SESSION['usuario'])) {
   
    header('Location: login.php');
    exit();
}
?>
  </head>
<body>
<nav class="navbar bg-primary navbar-expand-lg " data-bs-theme="dark" >
  <div class="container-fluid" >
    <a class="navbar-brand" href="#">Centro</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Principal.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="asignarMateria.php">Asignar</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ABM
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="materia.php">Materias</a></li>
            <li><a class="dropdown-item" href="alumno.php">Alumnos</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-5 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Opciones
          </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#infoModal" >Info</a></li>
              <li><a class="dropdown-item" href="logout.php">Cerrar Sesion</a></li>
            </ul>
          </li>
        </ul>      
    </div>
  </div>
</nav>

</body>
</html>


