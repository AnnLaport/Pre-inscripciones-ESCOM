<?php

     include('../fix/configBD.php');

     $jsonedit=[];

     if(isset($_POST['boletaED'])){
         
        $boletaED=$_POST['boletaED'];
        $nombreED=$_POST['nombreED'];
        $paternoED=$_POST['paternoED'];
        $maternoED=$_POST['maternoED'];
        $correoED=$_POST['correoED'];
        $telefonoED=$_POST['telefonoED'];
        $contrasenaED=$_POST['contrasenaED'];

        $query="SELECT * FROM alumnos WHERE N_BOLETA='$boletaED'";
        $res1 = mysqli_query($conexion, $query);
       //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
         $inf1= mysqli_num_rows($res1);
         if($inf1==0){
            $jsonedit["val"] = 0;
            $jsonedit["msj"] = "<h5>La boleta no existe</h5>"; 
            echo json_encode($jsonedit);
             die(0);
         }
        
        $queryED="UPDATE alumnos SET NOMBRE='$nombreED',A_PATERNO='$paternoED',A_MATERNO='$maternoED',CORREO='$correoED',TELEFONO='$telefonoED' WHERE N_BOLETA='$boletaED'";
        $resultadoED=mysqli_query($conexion,$queryED);
 
        if(!$resultadoED){
            $jsonedit["val"]=0;
            $jsonedit["msj"]="<h3>Hubo un error al editar los datos</h3>";
            echo json_encode($jsonedit);
            die('Error.');
           
        }
            $jsonedit["val"]=1;
            $jsonedit["msj"]="<h3>Datos editados correctamente</h3>";
            echo json_encode($jsonedit);

     }

?>