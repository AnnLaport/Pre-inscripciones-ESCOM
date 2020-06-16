<?php

     include("./../fix/configBD.php");

     $jsonA=[];

     if(isset($_POST['boletaS'])){

         $boletaS=$_POST['boletaS'];
         $nombreS=$_POST['nombreS'];
         $paternoS=$_POST['paternoS'];
         $maternoS=$_POST['maternoS'];
         $correoS=$_POST['correoS'];
         $telefonoS=$_POST['telefonoS'];
         $contrasenaS=$_POST['contrasenaS'];

         $sql1 = "SELECT * FROM alumnos WHERE N_BOLETA = '$boletaS'";
         $res1 = mysqli_query($conexion, $sql1);
       //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
         $inf1= mysqli_num_rows($res1);
         if($inf1==1){
            $jsonA["val"] = 0;
            $jsonA["msj"] = "<h5>La boleta ya existe</h5>"; 
            echo json_encode($jsonA);
             die(0);
         }

         $sqlA="INSERT INTO alumnos(N_BOLETA,NOMBRE,A_PATERNO,A_MATERNO,CORREO,TELEFONO,CONTRASENA)VALUES('$boletaS','$nombreS','$paternoS','$maternoS','$correoS','$telefonoS','$contrasenaS')";
         $resA = mysqli_query($conexion, $sqlA);

         if(!$resA){
            $jsonA["val"] = 0;
            $jsonA["msj"] = "<h5>Hubo un error, inténtelo más tarde</h5>"; 
            echo json_encode($jsonA);
             die(0);
         }
         $jsonA["val"] = 1;
         $jsonA["msj"] = "<h5>Estudiante agregado</h5>"; 
         echo json_encode($jsonA);
     }