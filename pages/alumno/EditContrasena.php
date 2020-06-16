<?php



   include('../fix/configBD.php');

   $jsonedit=[];

   if(isset($_POST['idalumno'])){

    $idalumno=$_POST['idalumno'];
    $ncontrasena=$_POST['ncontrasena'];
    $rncontrasena=$_POST['rncontrasena'];
    $vcontrasena=$_POST['vcontrasena'];

    if($ncontrasena!=$rncontrasena){
        $jsonedit["val"]=0;
        $jsonedit["msj"]="<h3>Las nuevas contraseñas no coinciden </h3>";
        echo json_encode($jsonedit);
        die(0);
    }

    $query="SELECT CONTRASENA FROM alumnos WHERE N_BOLETA='$idalumno'";
    $resultado=mysqli_query($conexion,$query);
 
    if(!$resultado){
        $jsonedit["val"]=0;
        $jsonedit["msj"]="<h3>Hubo un error al editar tus datos</h3>";
        echo json_encode($jsonedit);

        die('Error.');
       
    }

    while($row=mysqli_fetch_array($resultado)){
            
        $reccontrasena=$row['CONTRASENA'];
    
    }
     
    if($reccontrasena!=$vcontrasena){

        $jsonedit["val"]=0;
        $jsonedit["msj"]="<h3>La contraseña actual que ingresaste no es la correcta</h3>";
        echo json_encode($jsonedit);
        die(0);
    }

    $query1="UPDATE alumnos SET CONTRASENA='$ncontrasena' WHERE N_BOLETA='$idalumno'";
    $resultado1=mysqli_query($conexion,$query1);

    if(!$resultado1){
        $jsonedit["val"]=0;
        $jsonedit["msj"]="<h3>Hubo un error al editar tus datos</h3>";
        echo json_encode($jsonedit);
        die('Error.');
       
    }

    $jsonedit["val"]=1;
    $jsonedit["msj"]="<h3>tus datos se editaron satisfactoriamente</h3>";
    echo json_encode($jsonedit);

   }

   ?>