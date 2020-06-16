<?php

     include("./../fix/configBD.php");

     $jsonE=[];

     if(isset($_POST['erase'])){

         $erase=$_POST['erase'];

         $queryS="SELECT * FROM alumnos WHERE N_BOLETA='$erase'";
         $resultS=mysqli_query($conexion,$queryS);
         $infS = mysqli_num_rows($resultS);

         if($infS!=1){
            $jsonE["val"] = 0;
            $jsonE["msj"] = "<h5>Esa boleta no está en el sistema</h5>"; 
            echo json_encode($jsonE);
            die(0);
         }
         
         $queryE="DELETE FROM alumnos WHERE N_BOLETA='$erase'";
         $resultE=mysqli_query($conexion,$queryE);

         if(!$resultE){
            $jsonE["val"] = 0;
            $jsonE["msj"] = "<h5>Hubo un error</h5>"; 
            echo json_encode($jsonE);
            die(0);
         }
         
         $jsonE["val"] = 1;
         $jsonE["msj"] = "<h5>Se elimin&oacute; el registro exitosamente</h5>"; 
         echo json_encode($jsonE);

     }