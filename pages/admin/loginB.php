<?php

   /*  if($_POST['idS']){

        echo 'si llega';
    } */

    session_start();

    include('../fix/configBD.php');

    $jasonlog=[];

    if(isset($_POST['idS'])){

        $boleta=$_POST['idS'];
        $contrasena=$_POST['contrasenaS'];

        $log = "SELECT * FROM administrador WHERE ID_ADMIN = '$boleta' AND CONTRASENA_A = '$contrasena'";
        $res1 = mysqli_query($conexion, $log);
        $inf = mysqli_num_rows($res1);
    if($inf == 1){
         
        $_SESSION["adminSI"]=$boleta;
        $jasonlog["val"] = 1;
        $jasonlog["msj"] = "<h5>Bienvenido Admin!!! :)</h5>"; 
    }else{

        //Cualquier otro caso no nos interesa, no son datos válidos
        $jasonlog["val"] = 0;
        $jasonlog["msj"] = "<h5>Datos incorrectos. Favor de intentarlo nuevamente.</h5>";
    }
    
    echo json_encode($jasonlog);

    
    }