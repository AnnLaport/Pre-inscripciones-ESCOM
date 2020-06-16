<?php

    include('../fix/configBD.php');

    $repAlumno=[];

    if(isset($_POST['reporte'])){

       $reporte=$_POST['reporte'];
       
       $querycheck="SELECT * FROM alumnos WHERE N_BOLETA='$reporte'";
       $rescheck = mysqli_query($conexion, $querycheck);
       //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
         $inf1= mysqli_num_rows($rescheck);
         if($inf1==0){
            $repAlumno=array();
             $repAlumno[]=array(
                'nombre'=>'Boleta inexistente',
                'paterno'=>'Boleta inexistente',
                'materno'=>'Boleta inexistente',
                'correo'=>'Boleta inexistente',
                'telefono'=>'Boleta inexistente'
             );
             $jsonstring=json_encode($repAlumno);
             echo $jsonstring;
        

             die(0);
         }

         $repAlumno=array();
        while($row=mysqli_fetch_array($rescheck)){
         $repAlumno[]=array(
            'nombre'=>$row['NOMBRE'],
            'paterno'=>$row['A_PATERNO'],
            'materno'=>$row['A_MATERNO'],
            'correo'=>$row['CORREO'],
            'telefono'=>$row['TELEFONO']
         );
    }

    $jsonstring=json_encode($repAlumno);
    echo $jsonstring;

    }