<?php
    include('funciones.php');
    include('conexion.php');

    switch($_REQUEST['case']){

        case 'asignarMateria':
            try {
                    
                $query = "EXEC asignarMaterias :idAlumno, :idMateria";

                $consulta = $conn->prepare($query);
                $consulta ->bindParam(':idAlumno', $idAlumno);
                $consulta ->bindParam(':idMateria',$idMateria);
                $idAlumno = $_GET['idAlumno'];
                $idMateria = $_GET['idMateria'];
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