<?php 
include 'conexion.php';
include 'funciones.php';
$input = file_get_contents('php://input');
parse_str($input, $datos);
switch($datos['case'] ?? $_REQUEST['case']){

    case 'buscarAlumno':
        try {         
            if(empty($_POST["idAlumno"])){
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Error en el id del alumno'
                ]);
                exit;
            }
            $query= "SELECT a.Codigo,a.Nombre,a.Apellido,a.DNI,a.FechaNac,a.CodLocalidad  FROM Alumno a WHERE a.Codigo = :codigo AND a.Cod_estado = 'A'";
            $consulta = $conn ->prepare($query);         
            $codigo = $_POST['idAlumno'];
            $consulta->execute([':codigo' => $codigo]);
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'datos' => $datos
            ]);
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => "Error en el server". $ex->getMessage()
            ]);
        }
    break;    
    case 'buscarAlumnos':      
        try {
            $query = "SELECT a.Codigo,a.Nombre,a.Apellido,a.DNI,a.FechaNac,l.Nombre as Localidad FROM Alumno a, Localidad l WHERE a.CodLocalidad = l.Codigo AND a.Cod_estado = 'A'";
            $consulta  = $conn ->prepare($query);
            $consulta ->execute();
            $datos = $consulta ->fetchAll(PDO::FETCH_ASSOC);
            if($datos){
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'datos' => $datos
                ]);
            }
            else{
                http_response_code(401);
                echo json_encode([
                    'success' => false,
                    'message' => 'No se encontraron registros'
                ]);
            }
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error en el server' . $ex->getMessage()
            ]);
        }
        break;
    case 'guardarAlumno':
        try {
            if(empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["dni"]) || !fechaValida($_POST["fechaNac"]) || empty($_POST["codLocalidad"])){
                echo json_encode([
                    'success' => false,
                    'message' => 'Error en los parametros'
                ]);
                exit;
            }

            $query ="INSERT INTO Alumno( Nombre, Apellido, DNI, FechaNac, CodLocalidad)VALUES(:nombre, :apellido, :dni, :fechaNac,:codLocalidad)";
            $consulta = $conn->prepare($query);

            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $dni = $_POST["dni"];
            $fechaNac = $_POST["fechaNac"];
            $codLocalidad = $_POST["codLocalidad"];

            $consulta->execute([
               ':nombre' => $nombre,
               ':apellido' => $apellido,
               ':dni' => $dni,
               ':fechaNac' => $fechaNac,
               ':codLocalidad' => $codLocalidad
            ]);
            if($consulta->rowCount() > 0){
                http_response_code(201);
                echo json_encode([
                    'success'=>true,
                    'message' => "Alumno guardado correctamente"
                ]);
            }else{
                http_response_code(400);
                echo json_encode([
                    'success'=>false,
                    'message' => "Alumno no guardado correctamente"
                ]);
            }          
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error en el server'. $ex->getMessage()
            ]);
        }    
        break;
    case 'eliminarAlumno':
        try {
           
            if(!isset($datos['idAlumno'])){
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Datos vacios"
                ]);
                exit;
            }
            $query = "UPDATE ALUMNO SET Cod_estado = 'E' WHERE Codigo = :idAlumno";
            $consulta = $conn ->prepare($query);
            $idAlumno = $datos['idAlumno'];
            $consulta ->execute([
                ':idAlumno' => $idAlumno
            ]);
            if($consulta->rowCount() > 0){
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'message' => "Alumno eliminado correctamente"
                ]);        

            }
            else{
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => "Error al eliminar el Alumno"
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
    case 'modificarAlumno':
        try {
        
            if( empty($datos['idAlumno']) || empty($datos['nombre']) || empty($datos['apellido']) || empty($datos['dni']) || !fechaValida($datos['fechaNac']) || empty($datos['codLocalidad'])){
                echo json_encode([
                    'success' => false,
                    'message' => 'Error en los parametros'
                ]);
                exit;
            }
            $query = "UPDATE Alumno  SET Nombre = :nombre, Apellido = :apellido, DNI = :dni, FechaNac = :fechaNac, CodLocalidad = :codLocalidad WHERE Codigo = :idAlumno";
            $consulta = $conn->prepare($query);

            $idAlumno = $datos['idAlumno'];
            $nombre = $datos['nombre'];
            $apellido = $datos['apellido'];
            $dni = $datos['dni'];
            $fechaNac = $datos['fechaNac'];
            $codLocalidad = $datos['codLocalidad'];
            $consulta->execute([
               ':idAlumno' => $idAlumno,
               ':nombre' => $nombre,
               ':apellido' => $apellido,
               ':dni' => $dni,
               ':fechaNac' => $fechaNac,
               ':codLocalidad' => $codLocalidad
            ]);
            if($consulta->rowCount() > 0){
                http_response_code(200);
                echo json_encode([
                    'success'=>true,
                    'message' => "Alumno guardado correctamente"
                ]);
            }else{
                http_response_code(400);
                echo json_encode([
                    'success'=>false,
                    'message' => "Alumno no guardado correctamente"
                ]);
            }          
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error en el server'. $ex->getMessage()
            ]);
        }    
        break;
    case 'buscarLocalidades':
        try {
            $query = "SELECT l.Codigo, l.Nombre FROM Localidad l";
            $consulta = $conn ->prepare($query);
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
                    'message'=> "Datos de localidad no encontrados"
                ]);
            }
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message'=> "Error del servidor" . $ex->getMessage()
            ]);
        }      
        break;
}
?>