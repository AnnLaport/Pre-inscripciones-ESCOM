<?php

     include('../fix/configBD.php');

     $jsone= []; 

     if(isset($_POST['idalumno'])){
         $boletaE=$_POST['idalumno'];
         $materiaE=$_POST['idmateria'];

         $equery="DELETE FROM materias_alumno WHERE N_BOLETA='$boletaE' AND ID_MATERIA='$materiaE'";
         $result=mysqli_query($conexion,$equery);

          if(!$result){
            $jsone["val"]=0;
            $jsone["msj"] = "<h5>Error. No se eliminó la materia</h5>";
            die('Query failed'.mysqli_error($conexion));
          }else{
            $jsone["val"]=0;
            $jsone["msj"] = "<h5>Se ha eliminado correctamente de tu lista</h5>";
          }
          $jasonstringe=json_encode($jsone);
          echo $jasonstringe; 

     }