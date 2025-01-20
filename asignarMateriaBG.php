<?php
    include('funciones.php');
    include('conexion.php');

    switch($_REQUEST['case']){
        case 'traerMateriasDisponibles':
            try {
                $query = 'EXEC traerMateriasDisponibles :idAlumno';
                $consulta = $conn->prepare($query);
                $consulta ->bindParam(':idAlumno',$idAlumno);
                $idAlumno = $_GET['idAlumno'];
                $consulta -> execute();
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
                        'message' => "Datos vacios"
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
        case 'traerMateriasAlumno':
            try {
                $query = "EXEC traerMateriasAlumno :idAlumno";
                $consulta = $conn -> prepare($query);
                $consulta->bindParam(':idAlumno',$idAlumno);
                $idAlumno = $_GET['idAlumno'];
                $consulta->execute();
                $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
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
                        'message' => "Datos vacios"
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
        case 'asignarMateria':
            try {
                $query = "EXEC asignarMaterias :idAlumno, :idMateria";
                $consulta = $conn->prepare($query);

               if(isset($_POST['listaMaterias'])&& is_array($_POST['listaMaterias'])){
                    foreach($_POST['listaMaterias'] as $materia){
                
                        $consulta ->bindParam(':idAlumno', $_POST['idAlumno']);
                        $consulta ->bindParam(':idMateria', $materia['Codigo']);
                        $consulta ->bindParam(':CodEstado', $materia['CodEstado']);
                    }
               }
                $consulta->execute();
                if($consulta->rowCount()>0){
                    http_response_code(200);
                    echo json_encode([
                        'success' => true,
                        'message' => "Asignacion de materias correcta"
                    ]);
                }
                else{
                    http_response_code(400);
                    echo json_encode([
                        'success' => false,
                        'message' => "Error al asignar materias"
                    ]);                   
                }

            } catch (PDOException $ex) {             
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => "Error en el servidor"
                ]);                   
            }
        break;



    }


?>