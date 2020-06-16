<?php

     include('../fix/configBD.php');

     $jsonauditoria=[];


     if(isset($_POST['search'])){
        $boleta=$_POST['search'];

        $check1="SELECT * FROM materias_alumno WHERE N_BOLETA='$boleta'";
        $resultado=mysqli_query($conexion,$check1);
        $inf = mysqli_num_rows($resultado);

        if($inf<1){
            $jsonauditoria["val"] = 0;
            $jsonauditoria["msj"] = "<h5>Debes inscribir almenos 1 unidad de aprendizaje</h5>";
            echo json_encode($jsonauditoria);
            die(0);
        }else{
            date_default_timezone_set('America/Mexico_City');
            $fecha=date("Y-m-d H:i:s");
            $insertAu="UPDATE alumnos SET AUDITORIA='$fecha' WHERE N_BOLETA='$boleta'";
            $resultado=mysqli_query($conexion,$insertAu);

            if(!$resultado){
                $jsonauditoria["val"] = 0;
                $jsonauditoria["msj"] = "<h5>Error. Tus materias no se enviaron</h5>";
                echo json_encode($jsonauditoria);
                die(0);
            }else{
                $jsonauditoria["val"] = 1;
                $jsonauditoria["msj"] = "<h5>Tu pre inscripción ha sido finalizada</h5>";
                echo json_encode($jsonauditoria);
            }
        }
     }


?>