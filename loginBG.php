<?php
include 'conexion.php';

switch ($_REQUEST['case']) {
    case 'buscarUsuario':
        try {
            $query = "SELECT * FROM Login WHERE usuario = :usuario";
            $consulta  = $conn->prepare($query);
            if (empty($_POST['usuario']) || empty($_POST['pass'])) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Usuario y contraseña son requeridos.'
                ]);
                exit; 
            }
            $usuario = $_POST['usuario'];
            $password = $_POST['pass'];
            $consulta ->execute([':usuario' => $usuario]);       
            $datos = $consulta ->fetchAll(PDO::FETCH_ASSOC);       
            if ($datos) {
                if(password_verify($password,$datos[0]['pass'])){
                    http_response_code(200); 
                    echo json_encode([
                        'success' => true,
                        'datos' =>  $datos
                    ]);
                }
                else {
                    http_response_code(401);
                    echo json_encode([
                        'success' => false,
                        'message' =>  'Credenciales falsas'
                    ]) ;
                }          
            } else {
                http_response_code(401);
                echo json_encode([
                    'success' => false,
                    'message' =>  'Credenciales falsas'
                ]) ;
            }          
        } catch (PDOException $e) {
                http_response_code(500); 
                echo json_encode([     
                'success' => false,
                'message' => 'Error en la consulta: ' . $e->getMessage()
            ]);
        }
        break;
    case 'registrarUsuario':
        try {
            $query="INSERT INTO Login (usuario,pass) Values(:usuario,:pass)";
            $consulta = $conn->prepare($query);
            
            if(empty($_POST['usuario']) || empty($_POST['pass'])){
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'messege' => 'Usuario y contraseña son requeridos.'
                ]);
                exit;
            }
            $usuario = $_POST['usuario'];
            $passwordHash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $consulta -> execute([
                ':usuario'=> $usuario,
                ':pass' =>  $passwordHash
            ]);
        
            if($consulta->rowCount() > 0){
                http_response_code(200);
                echo json_encode([
                    'success' => true,
                    'messege' => 'Datos guardados correctamente'
                ]);
            }else{
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'messege' => 'Error al guardar datos'
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
    case 'buscarAlumnos':
        
        try {
            $query = "SELECT a.Codigo,a.Nombre,a.Apellido,a.DNI,a.FechaNac,l.Nombre as Localidad FROM Alumno a, Localidad l WHERE a.CodLocalidad = l.Codigo";
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
                    'messege' => 'No se encontraron registros'
                ]);
            }
        } catch (PDOException $ex) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'messege' => 'Error en el server' . $ex->getMessage()
            ]);
        }
        break;
    case 'buscarAlumno':
        try {         
            $query= "SELECT a.Codigo,a.Nombre,a.Apellido,a.DNI,a.FechaNac,l.Nombre as Localidad FROM Alumno a, Localidad l WHERE a.CodLocalidad = l.Codigo AND a.Codigo = :codigo";
            $consulta = $conn ->prepare($query);
            $codigo = $_PUT['idAlumno'];
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
    default:
        # code...
        break;
}


?>