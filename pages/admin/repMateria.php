<?php

    include('../fix/configBD.php');


    if(isset($_POST['reporte'])){

       $reporte=$_POST['reporte'];
      
       $queryM="SELECT * FROM materia WHERE ID_MATERIA='$reporte'";
       $resm = mysqli_query($conexion, $queryM);
       //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
         $inf1= mysqli_num_rows($resm);
         if($inf1==0){
            $repmateria=array();
            $repmateria[]=array(
               'total'=>'-',
               'recurses'=>'-',
               'curses'=>'-',
               'pdfa'=>$reporte
            );
            $jsonstring=json_encode($repmateria);
            echo $jsonstring;
             die(0);
         }
        
        $queryM2="SELECT * FROM materias_alumno WHERE ID_MATERIA='$reporte'";
        $resm2 = mysqli_query($conexion, $queryM2);
       //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
         $inf2= mysqli_num_rows($resm2);
         if(!$resm2){
            die('Query failed'.mysqli_error($conexion));
        }

         $queryM3="SELECT * FROM materias_alumno WHERE ID_MATERIA='$reporte' AND ESTADO='0'";
         $resm3 = mysqli_query($conexion, $queryM3);
        //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
          $inf3= mysqli_num_rows($resm3);
          if(!$resm3){
            die('Query failed'.mysqli_error($conexion));
        }

          $queryM4="SELECT * FROM materias_alumno WHERE ID_MATERIA='$reporte' AND ESTADO='1'";
         $resm4 = mysqli_query($conexion, $queryM4);
        //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
          $inf4= mysqli_num_rows($resm4);
          if(!$resm4){
            die('Query failed'.mysqli_error($conexion));
        }

        $repmateria=array();
     $repmateria[]=array(
        'total'=>$inf2,
        'recurses'=>$inf4,
        'curses'=>$inf3,
        'pdfa'=>$reporte
     );
     $jsonstring=json_encode($repmateria);
     echo $jsonstring;

    }