<?php
    /*
        Esta página es exclusiva de un alumno que se haya autentificado por medio del login. Un acceso directo a ésta deberá de ser rechazado. Aquí aparecen las sesiones en escena para cuidar este 'detalle'.
    */

    session_start();
    if(isset($_SESSION["adminSI"])){

        include("./../fix/configBD.php");

        $sql1 = "SELECT * FROM alumnos WHERE AUDITORIA";
        $res1 = mysqli_query($conexion, $sql1);
        //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
        $inf1 = mysqli_num_rows($res1);
    
        $sql2 = "SELECT * FROM materias_alumno";
        $res2 = mysqli_query($conexion, $sql2);
        //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
        $inf2 = mysqli_num_rows($res2);
    
        $sql3="SELECT NOMBRE_MATERIA, COUNT( NOMBRE_MATERIA ) AS total
        FROM  `materias_alumno`
        GROUP BY NOMBRE_MATERIA
        ORDER BY total DESC ";
    
        $res3 = mysqli_query($conexion, $sql3);
        $inf3 = mysqli_fetch_row($res3);


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Pre inscripciones Admin</title>
<meta name='viewport' content='width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no'/>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
<link href="../../js/plugins/validetta/validetta.min.css" rel="stylesheet">
<link href="../../js/plugins/confirm/jquery-confirm.min.css" rel="stylesheet">
<link href="./../../css/general.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../../js/plugins/validetta/validetta.min.js"></script>
<script src="../../js/plugins/validetta/validettaLang-es-ES.js"></script>
<script src="../../js/plugins/confirm/jquery-confirm.min.js"></script>
<script src="../../js/admin.js"></script>
<script src="../../js/rmateria.js"></script>
</head>
<body>

   <nav class="blue">
       <div class="nav-wrapper container">
         <a href="#" class="brand-logo">Preinscripciones ESCOM</a>
         <a href="#" data-target="menu-responsive" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="InicioAdmin.php">Inicio</a></li>
        <li><a href="ReporteAlumno.php">Reporte por Alumno</a></li>
        <li><a href="./CerrarSesionAdmin.php?nombreSesion=adminSI">Cerrar Sesión</a></li>
      </ul>
    </div>
  </nav>
  <ul class="sidenav" id="menu-responsive">
        <li><a href="InicioAdmin.php">Inicio</a></li>
        <li><a href="ReporteAlumno.php">Reporte por Alumno</a></li>
        <li><a href="./CerrarSesionAdmin.php?nombreSesion=adminSI">Cerrar Sesión</a></li>
     </ul>

    <main class="valign-wrapper">
        <div class="container">
            <div class="row">
               <div class="col s12 m12">
                   <h5>Información general sobre las preinscripcione hasta ahora:</h5>
                  </div>
                  <div class="col s12 m12">
                      <p>Se tienen <?php echo $inf1; ?> alumnos pre inscritos</p>
                  </div>
                  <div class="col s12 m12">
                      <p>Se han inscrito <?php echo $inf2; ?> materias</p>
                  </div>
                  <div class="col s12 m12">
                      <p>La materia más solicitada por el momento es: <?php echo $inf3[0]; ?> </p>
                  </div>
           
            </div>
            <div class="col s12 m12">
                  <h4>Obten información individual de las materias!</h4>

            </div>
            

            <h5>Lista de materias:</h5>
            <br>
            <table class="responsive-table striped">
                <thead>
                   <tr>
                       <th>Clave de Asignatura</th>
                       <th>Nombre de asignatura</th>
                   </tr>

                </thead>
                <tbody id="materiasreport">

                </tbody>
                
            </table>

        <div class="row">

              <div class="col s12 m12">
                    <h6>Para generar un reporte por materia, escribe su clave:</h6>
              </div>
              <div class="col s12 m6 input-field">
                    <i class="fas fa-user prefix indigo-text text-darken-4"></i>
                    <label for="boleta">Clave de Materia</label>
                    <input type="text" id="reportM" name="reportM" maxlength="8" data-validetta="required,minLength[3],maxLength[8]">
                </div>
                <div class="col s12 m6">
                     <input type="text" id="reportabtnm" name="reportm" class="btn red lighten-2" value="Generar Reporte">
                </div>

                <form id="greporteM">

                </form>

        </div>


        </div>   
    </main>
    <footer class="page-footer blue">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Acerca de las asignaturas:</h5>
                <p class="grey-text text-lighten-4">Quieres saber más del plan de estudios de ESCOM y sus materias?</p>
                <p class="grey-text text-lighten-4">Te dejamos los siguientes enlaces, pueden ser de ayuda ;)</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Mapa Curricular</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Optativas</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">ESCOM</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2020 Copyright 
            <p>"Con optimismo se resuelve la mitad de cada problema"</p>
            </div>
          </div>
        </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });
    </script>
    
</body>
</html>

<?php

    }else{
        header("location:./../../index.html");
    }
   ?> 