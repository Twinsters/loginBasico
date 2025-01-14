<?php
include 'ambiente.php';

try{

    $conn = new PDO($DNS);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de errores
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Modo de fetch

}
catch(PDOException $e){
    die("Error en la conexión: " . $e->getMessage());
}


?>