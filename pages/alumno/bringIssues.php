<?php

    include('../fix/configBD.php');
    
     $query="SELECT * from materia";
    $result=mysqli_query($conexion,$query);

    if(!$result){
        die('Query failed'.mysqli_error($conexion));
    }
    
    $jsonissues=array();
    while($row=mysqli_fetch_array($result)){
         $jsonissues[]=array(
             'idmateria'=>$row['ID_MATERIA'],
             'nombremat'=>$row['NOMBRE_MATERIA'],
         );
    }
   $jasonstring=json_encode($jsonissues);
   echo $jasonstring; 

?>