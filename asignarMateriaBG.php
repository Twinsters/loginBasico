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
            if (isset($_POST['idAlumno'], $_POST['listaMaterias']) && is_array($_POST['listaMaterias'])) {
                foreach ($_POST['listaMaterias'] as $materia) {
                    if (!isset($materia['Cod_estado'])) {
                        http_response_code(400);
                        echo json_encode([
                            'success' => false,
                            'message' => "Datos de materia incompletos"
                        ]);
                        exit;
                    }
                }
            }
            try {
                $conn->beginTransaction();
                $successCount = 0;
                $query = "EXEC asignarMaterias :codigoAM, :idAlumno, :idMateria, :CodEstado";
                $consulta = $conn->prepare($query);
                
               foreach ($_POST['listaMaterias'] as $materia) {
                    $codigoAm = $materia['CodigoAM'] == null ? 0: intval($materia['CodigoAM']);
                    $consulta->bindValue(':codigoAM',  $codigoAm);
                    $consulta->bindValue(':idAlumno', $_POST['idAlumno']);
                    $consulta->bindValue(':idMateria', intval($materia['Codigo']));
                    $consulta->bindValue(':CodEstado', trim($materia['Cod_estado']));
                    echo $codigoAm,$_POST['idAlumno'],$materia['Codigo'],trim($materia['Cod_estado']);
                    if ($consulta->execute()) {
                       
                        $successCount++;
                    }
                }
                $conn->commit();
                if($successCount >0){
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
                $conn->rollBack();      
                http_response_code(500);
                echo json_encode([
                    'success' => false,
                    'message' => "Error en el servidor". $ex->getMessage()
                ]);                   
            }
        break;
    }
?>