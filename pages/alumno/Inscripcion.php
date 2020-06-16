<?php

    include('../fix/configBD.php');

session_start();

     $materiasjson=[];
    
     if(isset($_POST['idalumno'])){
         $idalumno=$_POST['idalumno'];
         $idmateria=$_POST['idmateria'];
         if($_POST['recurse']=='false'){
            $recurse=0;
         }
         else{
             $recurse=1;
         }
         $prove="SELECT * FROM materias_alumno WHERE N_BOLETA='$idalumno' AND ID_MATERIA='$idmateria'";
         $resultadoProve=mysqli_query($conexion,$prove);
         $inf = mysqli_num_rows($resultadoProve);

         $prove1="SELECT NOMBRE_MATERIA FROM materia WHERE ID_MATERIA='$idmateria'";
         $resultadoProve1=mysqli_query($conexion,$prove1);
         $inf1 = mysqli_num_rows($resultadoProve1);

         $prove2="SELECT * FROM materias_alumno WHERE N_BOLETA='$idalumno'";
         $resultadoProve2=mysqli_query($conexion,$prove2);
         $inf2 = mysqli_num_rows($resultadoProve2);

         if($inf1==1){
            
            while($row=mysqli_fetch_array($resultadoProve1)){
            
                     $materianame=$row['NOMBRE_MATERIA'];
                 
            }
         }

         if($inf==1){
             $materiasjson["val"]=0;
            $materiasjson["msj"] = "<h5>Error. materia duplicada</h5>";
         }elseif($inf2==7){
            $materiasjson["val"]=0;
            $materiasjson["msj"]=  "<h5>Ya no puedes inscribir más</h5>";
         }else{

            $query="INSERT INTO materias_alumno(N_BOLETA,ID_MATERIA,NOMBRE_MATERIA,ESTADO)VALUES('$idalumno','$idmateria','$materianame','$recurse')";
            $resultado=mysqli_query($conexion,$query);

            if(!$resultado){
                $materiasjson["val"]=0;
                $materiasjson["msj"] = "<h5>Error. No se guardó tu materia</h5>";
                die(0);
            }else{
                $materiasjson["val"]=0;
                $materiasjson["msj"] = "<h5>Materia Agregada</h5>";
            }

         }

         echo json_encode($materiasjson);
         
     }

?>