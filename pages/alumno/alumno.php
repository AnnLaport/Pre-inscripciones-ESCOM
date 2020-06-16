<?php
    /*
        Esta página es exclusiva de un alumno que se haya autentificado por medio del login. Un acceso directo a ésta deberá de ser rechazado. Aquí aparecen las sesiones en escena para cuidar este 'detalle'.
    */

    session_start();
    if(isset($_SESSION["alumnoSI"])){
        //La sesion está disponible, significa que es un alumno válido, entonces hay que permitir el acceso y personalizar la infomación que se despliegue.
        //Regularmente separo las funcionalidades en archivos y aquellos que vean con el sufijo '_BD' significa que realiza operaciones de solo consulta a la BD y cuyos resultados se utilizarán en el archivo actual; también observen que tiene el nombre del archivo base (alumno.php), esto con la intención de identificar rapidamente aquel conjunto de archivos que están relacionados; así pues sera común que, de ser necesario, encuentren archivos que se llamen 'alumno.js', 'alumno.css', 'alumno_AX.php', por ejemplo, el último contienen todo el código que el servidor realizará ante una llamada AJAX hecha por 'alumno.php' por medio del archivo 'alumno.js' concretamente en la función '$.ajax({})'

    include("./../fix/configBD.php");
    
    $boleta = $_SESSION["alumnoSI"];
    $sqlInfBoleta = "SELECT * FROM alumnos WHERE N_BOLETA = '$boleta'";
    $resInfBoleta = mysqli_query($conexion, $sqlInfBoleta);
    $infInfBoleta = mysqli_fetch_row($resInfBoleta);

    $infBoleta = "<h3 class='center-align'>Bienvenido $infInfBoleta[1] $infInfBoleta[2] $infInfBoleta[3] ($infInfBoleta[0])</h3>";

    $info = "<p>&nbsp;</p><h5>
        <i class='fas fa-venus-mars deep-orange-text accent-2'></i> G&eacute;nero: <strong>$infInfBoleta[4]</strong><br>
        <i class='fas fa-envelope deep-orange-text accent-2'></i> Correo: <strong>$infInfBoleta[5]</strong><br>
        <i class='fas fa-birthday-cake deep-orange-text accent-2'></i> Cumplea&ntilde;os: <strong>$infInfBoleta[6]</strong>
    </h5>"; 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Pre inscripciones Alumno</title>
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
<script src="../../js/alumnoSesion.js"></script>
</head>
<body>

   <nav class="blue">
       <div class="nav-wrapper container">
         <a href="alumno.php" class="brand-logo">Preinscripciones ESCOM</a>

         <a href="#" data-target="menu-responsive" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>

      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="PerfilAlumno.php">Ver Perfil</a></li>
        <li><a href="./CerrarSesionAlumno.php?nombreSesion=alumnoSI">Cerrar Sesión</a></li>
      </ul>
    </div>
  </nav>
  <ul class="sidenav" id="menu-responsive">
        <li><a href="PerfilAlumno.php">Ver Perfil</a></li>
        <li><a href="./CerrarSesionAlumno.php?nombreSesion=alumnoSI">Cerrar Sesión</a></li>
     </ul>

    <main class="valign-wrapper">
        <div class="container">
        <div id="info" class="col s12">
                    <?php echo $infBoleta; ?>
        </div>

        <br>

        <?php
          if(!$infInfBoleta[7]){

          
        ?>
            <h5>Lista de materias que se impartirán el siguiente semestre:</h5>
            <br>
            <table class="responsive-table striped">
                <thead>
                   <tr>
                       <th>Clave de Asignatura</th>
                       <th>Nombre de asignatura</th>
                   </tr>

                </thead>
                <tbody id="issues">

                </tbody>
                
            </table>

            <hr size="1px" color="#B0C4DE " />
            <br>

            <h6>Para agregar una materia a tu lista, escribe su ID y marca la casilla si es recurse</h6>
            <div class="row">
            <form id="formInscribir" autocomplete="on">
                

                    <div class="col s12 m12">
                    </div>
                    <div class="col s12 m3  input-field">
                        <i class="fas fa-chalkboard-teacher prefix indigo-text text-darken-4"></i>
                        <label for="materia"></label>
                        <input type="text" id="IDAlumno" name="IDAlumno" value="<?php echo $infInfBoleta[0]; ?>" maxlength="10" data-validetta="minLength[3],maxLength[5]" disabled>
                    </div>
                    <div class="col s12 m3  input-field">
                        <i class="fas fa-chalkboard-teacher prefix indigo-text text-darken-4"></i>
                        <label for="materia">ID Materia</label>
                        <input type="text" id="IDMateria" name="ID Materia" maxlength="10" data-validetta="required,minLength[3],maxLength[6]">
                    </div>

                    <div class="col s12 m6 input-field">
                      <button type="submit" id="SendIssues" class="btn orange">Agregar Materia</button>
                    </div>
                    <div class="col s12 m12  ">
                         <label>
                              <input type="checkbox" id="recurse"/>
                              <span>Es recurse</span>
                               <br>
                        </label>
                    </div>


                
                </form>
                <h6>Si quieres eliminar una materia de tu lista , escribe su ID en el espacio de abajo:</h6>
                <form id="formErase">
                <div class="col s12 m3  input-field">
                        <i class="fas fa-chalkboard-teacher prefix indigo-text text-darken-4"></i>
                        <label for="materia"></label>
                        <input type="text" id="IDAlumnoE" name="IDAlumnoE" value="<?php echo $infInfBoleta[0]; ?>" maxlength="10" data-validetta="minLength[3],maxLength[5]" disabled>
                </div>
                <div class="col s12 m3  input-field">
                        <i class="fas fa-chalkboard-teacher prefix indigo-text text-darken-4"></i>
                        <label for="materia">Materia</label>
                        <input type="text" id="IDMateriaE" name="ID Materia" maxlength="10" data-validetta="required,minLength[3],maxLength[6]">
                    </div>

                    <div class="col s12 m6 input-field">
                      <button type="submit" id="SendIssuesErase" class="btn red lighten-1">Eliminar de tu lista</button>
                    </div>
                </form>
                
                <br>
            <div class="col s12 m12">
                 <h5>Tu lista de materias (Puedes escoger hasta 7):</h5>
            </div>
           
            <br>
                </div>
            <table class="striped">
                <thead>
                   <tr>
                       <th>Clave de Asignatura</th>
                       <th>Nombre de asignatura</th>
                       <th>Recurse(1)/No Recurse(0)</th>
                   </tr>

                </thead>
                <tbody id="issueschose">

                </tbody>
                
            </table>
            <div class="row">
            <hr size="1px" color="#B0C4DE " />
            <form id="terminarInscripcion">
                        <input type="hidden" id="IDAlumnoEnd" name="IDAlumnoEnd" value="<?php echo $infInfBoleta[0]; ?>" maxlength="10" data-validetta="minLength[3],maxLength[5]" disabled>
                        <div class="col s12 m6 input-field">
                             <button type="submit" id="SendIssuesFinal" class="btn red lighten-1">Terminar Preinscripción</button>
                        </div>
            </form>
           
            
        </div>
        </div>
        </div>

        <?php
          } else{
            $noinfo="<h5 class='center-align'>Ya hiciste tu preinscripción, visita tu perfil si quieres un comprobante o revisar tu información</h5>";
            echo $noinfo;
          }
        ?>
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
        //NO se detectó la sesion que hubo de generarse después de pasar por el login, entonces es un intento de acceso no autorizado, lo redireccionamos a la pantalla correspondiente
        header("location:./../../index.html");
    }
?>