<?php
include("conexion.php");

$input = file_get_contents('php://input');
parse_str($input,$datos);
switch( $datos['case'] ?? $_REQUEST['case']){
    case 'buscarMaterias':
        try {    
            $query = "SELECT Codigo, Nombre FROM Materia WHERE Cod_estado = 'A'";
            $consulta = $conn->prepare($query);
            $consulta->execute();
            $datos = $consulta ->fetchAll(PDO::FETCH_ASSOC);
            if($datos){
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'datos' => $datos
                ]);
            }
            else{
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Datos no encontrados"
                ]);
            }
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' =>"Error con el servidor". $ex->getMessage(),
            ]);
        }
    break;
    case 'buscarMateria':
        try {
            if(empty($_GET['idMateria'])){
                echo json_encode([
                    'success' => false,
                    'message' => 'Error Numero ID de la materia vacio'
                ]);
                exit;
            }
            $query = "SELECT Codigo, Nombre FROM Materia WHERE Cod_estado = 'A' AND Codigo = :idMateria";
            $consulta = $conn ->prepare($query);
            $idMateria = $_GET['idMateria'];
            $consulta ->execute([
                ':idMateria' => $idMateria
            ]);
            $datos = $consulta ->fetchAll(PDO::FETCH_ASSOC);
            if($datos){
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'datos' => $datos
                ]);
            }
            else{
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Datos de las materias, no encontrados'
                ]);
            }
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error en el servidor'.$ex->getMessage()
            ]);
        }
    break;
    case 'modificarMateria':
        try {
            if(!isset($datos['nombre']) || !isset($datos['idMateria'])){
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Datos vacios"
                ]);
                exit;
            }
            $query = "UPDATE Materia SET Nombre = :nombre WHERE Cod_estado = 'A' AND Codigo = :idMateria";
            $consulta = $conn ->prepare($query);
            $idMateria = $datos['idMateria'];
            $nombre = $datos['nombre'];
            $consulta->execute([
                ':nombre' => $nombre,
                ':idMateria' => $idMateria
            ]);
            if($consulta->rowCount() > 0){
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'message' => "Datos actualizados correctamente"
                ]);
            }
            else{
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Error al actualizar datos"
                ]);
            }
        } catch (PDOException $ex) {
            http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => 'Error en el servidor'.$ex->getMessage()
                ]);
        } 
    break;
    case 'guardarMateria':
        try {
            if(empty($_POST['nombre'])){
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Datos vacios"
                ]);
                exit;
            }
            $query = "INSERT INTO Materia(Nombre)VALUES(:nombre)";
            $consulta = $conn ->prepare($query);
            $consulta->execute([
                ':nombre' => $_POST['nombre']
            ]);
            if($consulta->rowCount() > 0){
                http_response_code(201);
                echo json_encode([
                    'success' => true,
                    'message' => "Datos creados correctamente"
                ]);
            }
            else{
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Error al guardar materia"
                ]);
            }   
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => "Error en el servidor". $ex->getMessage()
            ]);
        }
    break;
    case 'eliminarMateria':
        try {
            if(!isset($datos['idMateria'])){
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Datos vacios"
                ]);
                exit;
            }
            $query = "UPDATE MATERIA SET Cod_estado = 'E' WHERE Codigo = :idMateria";
            $consulta = $conn ->prepare($query);
            $idMateria = $datos['idMateria'];
            $consulta ->execute([
                ':idMateria' => $idMateria
            ]);
            if($consulta->rowCount() > 0){
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'message' => "Materia eliminada correctamente"
                ]);        

            }
            else{
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Error al eliminar la materia"
                ]);        
            }
        }catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => "Error en el servidor". $ex->getMessage()
            ]);
        }
        
    break;
}



?>