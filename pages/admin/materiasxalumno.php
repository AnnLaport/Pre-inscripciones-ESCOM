<?php

    include('../fix/configBD.php');

    $idsearch=$_POST['search'];
    
     $query="SELECT * FROM materias_alumno WHERE N_BOLETA=$idsearch";
    $result=mysqli_query($conexion,$query);

    if(!$result){
        die('Query failed'.mysqli_error($conexion));
    }
    
    $jsonissues=array();
    while($row=mysqli_fetch_array($result)){
         $jsonissues[]=array(
             'idmateria'=>$row['ID_MATERIA'],
             'nombremat'=>$row['NOMBRE_MATERIA'],
             'estado'=>$row['ESTADO'],
         );
    }
   $jasonstring=json_encode($jsonissues);
   echo $jasonstring; 

?>