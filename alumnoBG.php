<?php 
include 'conexion.php';
include 'funciones.php';
$input = file_get_contents('php://input');
parse_str($input, $data);
switch($data['case'] ?? $_REQUEST['case']){

    case 'buscarAlumno':
        try {         
            if(empty($_POST["idAlumno"])){
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'messege' => 'Error en el id del alumno'
                ]);
                exit;
            }
            $query= "SELECT a.Codigo,a.Nombre,a.Apellido,a.DNI,a.FechaNac,a.CodLocalidad  FROM Alumno a WHERE a.Codigo = :codigo";
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
                'messege' => "Error en el server". $ex->getMessage()
            ]);
        }
    break;
    case 'guardarAlumno':
    
        try {
            if(empty($_POST["nombre"]) || empty($_POST["apellido"] || is_numeric($_POST["dni"]) || fechaValida($_POST["fechaNac"]) || is_numeric($_POST["codLocalidad"]))){
                echo json_encode([
                    'success' => false,
                    'messege' => 'Error en los parametros'
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
                http_response_code(200);
                echo json_encode([
                    'success'=>true,
                    'messege' => "Alumno guardado correctamente"
                ]);
            }else{
                http_response_code(401);
                echo json_encode([
                    'success'=>false,
                    'messege' => "Alumno no guardado correctamente"
                ]);
            }          
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'messege' => 'Error en el server'. $ex->getMessage()
            ]);
        }    
        break;
    case 'modificarAlumno':
        try {
            if( empty($data['idAlumno']) ||empty($data['nombre']) || empty($data['apellido'] || empty($data['dni']) || fechaValida($data['fechaNac']) || empty($data['codLocalidad']))){
                echo json_encode([
                    'success' => false,
                    'messege' => 'Error en los parametros'
                ]);
                exit;
            }
            $query = "UPDATE Alumno  SET Nombre = :nombre, Apellido = :apellido, DNI = :dni, FechaNac = :fechaNac, CodLocalidad = :codLocalidad WHERE Codigo = :idAlumno";
            $consulta = $conn->prepare($query);

            $idAlumno = $data['idAlumno'];
            $nombre = $data['nombre'];
            $apellido = $data['apellido'];
            $dni = $data['dni'];
            $fechaNac = $data['fechaNac'];
            $codLocalidad = $data['codLocalidad'];
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
                    'messege' => "Alumno guardado correctamente"
                ]);
            }else{
                http_response_code(401);
                echo json_encode([
                    'success'=>false,
                    'messege' => "Alumno no guardado correctamente"
                ]);
            }          
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'messege' => 'Error en el server'. $ex->getMessage()
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
                    'messege'=> "Datos de localidad no encontrados"
                ]);
            }
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'messege'=> "Error del servidor" . $ex->getMessage()
            ]);
        }      
        break;
}
?>