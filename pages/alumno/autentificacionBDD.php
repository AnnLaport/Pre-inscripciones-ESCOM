

<?php



   include('../fix/configBD.php');

    $respAutentic=[];

 if(isset($_POST['idA'])){

    $idA=$_POST['idA'];
    $correoA=$_POST['correoA'];
    $telefonoA=$_POST['telefonoA'];
    $contrasenaA=$_POST['contrasenaA'];
    $repcontrasenaA=$_POST['repcontrasenaA'];

    if($contrasenaA==$repcontrasenaA){
        $query="UPDATE alumnos SET CORREO='$correoA',TELEFONO='$telefonoA',CONTRASENA='$contrasenaA' WHERE N_BOLETA='$idA'";
        $resultado=mysqli_query($conexion,$query);
 
        if(!$resultado){
            
            die('Error.');
           
        }

        
        $respAutentic["val"]=1;
        $respAutentic["msj"]="<h3>data added succesfully</h3>";
        


       }else{
        $respAutentic["val"]=0;
        $respAutentic["msj"]="<h3>Las contrasenas no coinciden</h3>";
       }
       echo json_encode($respAutentic);
 }