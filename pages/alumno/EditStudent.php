<?php

     include('../fix/configBD.php');

     $jsonedit=[];

     if(isset($_POST['idstudent'])){
         $student=$_POST['idstudent'];
         $name=$_POST['name'];
         $fname=$_POST['fname'];
         $sname=$_POST['sname'];
         $email=$_POST['email'];
         $phone=$_POST['phone'];

        $query="UPDATE alumnos SET NOMBRE='$name',A_PATERNO='$fname',A_MATERNO='$sname',CORREO='$email',TELEFONO='$phone' WHERE N_BOLETA='$student'";
        $resultado=mysqli_query($conexion,$query);
 
        if(!$resultado){
            $jsonedit["msj"]="<h3>Hubo un error al editar tus datos, contacte al administrador si el problema persiste</h3>";
            echo json_encode($jsonedit);
            die('Error.');
           
        }

        
        $jsonedit["msj"]="<h3>tus datos se editaron satisfactoriamente</h3>";
        echo json_encode($jsonedit);

        
     }

?>