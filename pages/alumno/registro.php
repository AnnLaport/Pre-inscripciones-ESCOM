<?php

    include('../fix/configBD.php');

    $respregistro=[];

    if(isset($_POST['id'])){
       $id=$_POST['id'];
       $nombre=$_POST['nombre'];
       $paterno=$_POST['paterno'];
       $materno=$_POST['materno'];
       $correo=$_POST['correo'];
       $telefono=$_POST['telefono'];
       $contrasena=$_POST['contrasena'];
       $repcontrasena=$_POST['repcontrasena'];
       
       $sql1 = "SELECT * FROM alumnos WHERE N_BOLETA = '$id'";
       $res1 = mysqli_query($conexion, $sql1);
       //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
       $inf1= mysqli_num_rows($res1);

       if($inf1==1){
        $respregistro["val"]=0;
        $respregistro["msj"]="<h3>Ese número de boleta ya está registrado</h3>";
        echo json_encode($respregistro);

       }else{
        if($contrasena==$repcontrasena){
            $query="INSERT into alumnos (N_BOLETA,NOMBRE,A_PATERNO,A_MATERNO,CORREO,TELEFONO,CONTRASENA)values('$id','$nombre','$paterno','$materno','$correo','$telefono','$contrasena')";
            $resultado=mysqli_query($conexion,$query);
     
            if(!$resultado){
                
                die('Error.');
               
            }
            $respregistro["val"]=1;
            $respregistro["msj"]="<h3>data added succesfully</h3>";
    
           }else{
            $respregistro["val"]=0;
            $respregistro["msj"]="<h3>Las contrasenas no coinciden</h3>";
           }
           echo json_encode($respregistro);
       }
       
       
      
    }