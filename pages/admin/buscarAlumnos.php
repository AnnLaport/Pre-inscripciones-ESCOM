<?php

     include("./../fix/configBD.php");

     if(isset($_POST['buscar'])){
         $search=$_POST['buscar'];
         

         if(!empty($search)){
             $querybring="SELECT * FROM alumnos WHERE N_BOLETA LIKE '$search%'";
             $resultbring=mysqli_query($conexion, $querybring);

             if(!$resultbring){
                 die('Query error'.mysqli_error($conexion));
             }

             $json=array();

             
             while($row = mysqli_fetch_array($resultbring)){
                 $json[]=array(
                     'boleta'=>$row['N_BOLETA'],
                     'nombre'=>$row['NOMBRE'],
                     'paterno'=>$row['A_PATERNO'],
                     'materno'=>$row['A_MATERNO'],
                     'correo'=>$row['CORREO'],
                     'telefono'=>$row['TELEFONO']
                 );
             }

             
         }else{

            $querybring="SELECT * FROM alumnos WHERE N_BOLETA='-'";
            $resultbring=mysqli_query($conexion, $querybring);

            if(!$resultbring){
                die('Query error'.mysqli_error($conexion));
            }

            $json=array();

            
            while($row = mysqli_fetch_array($resultbring)){
                $json[]=array(
                    'boleta'=>$row['N_BOLETA'],
                    'nombre'=>$row['NOMBRE'],
                    'paterno'=>$row['A_PATERNO'],
                    'materno'=>$row['A_MATERNO'],
                    'correo'=>$row['CORREO']
                );
            }
         }

         $jsonstring=json_encode($json);
         echo $jsonstring;
     }

?>