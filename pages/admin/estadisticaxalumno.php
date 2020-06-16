<?php

    include('../fix/configBD.php');

    

    if(isset($_POST['estads'])){

       $reporteestads=$_POST['estads'];
      
       $query="SELECT * FROM materias_alumno WHERE N_BOLETA='$reporteestads'";
       $result=mysqli_query($conexion,$query);
       $inf= mysqli_num_rows($result);

    if(!$result){
        die('Query failed'.mysqli_error($conexion));
    }

    $query1="SELECT * FROM materias_alumno WHERE N_BOLETA='$reporteestads' AND ESTADO='1'";
    $result1=mysqli_query($conexion,$query1);
    $inf1= mysqli_num_rows($result1);

     if(!$result1){
     die('Query failed'.mysqli_error($conexion));
      }

      $query2="SELECT * FROM materias_alumno WHERE N_BOLETA='$reporteestads' AND ESTADO='0'";
      $result2=mysqli_query($conexion,$query2);
      $inf2= mysqli_num_rows($result2);

     if(!$result2){
       die('Query failed'.mysqli_error($conexion));
     }
     $repAlumnoT=array();
     $repAlumnoT[]=array(
        'total'=>$inf,
        'recurses'=>$inf1,
        'curses'=>$inf2,
        'pdfa'=>$reporteestads
     );
     $jsonstring=json_encode($repAlumnoT);
     echo $jsonstring;

    }