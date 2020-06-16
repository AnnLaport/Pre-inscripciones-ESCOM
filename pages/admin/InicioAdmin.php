<?php
    /*
        Esta página es exclusiva de un alumno que se haya autentificado por medio del login. Un acceso directo a ésta deberá de ser rechazado. Aquí aparecen las sesiones en escena para cuidar este 'detalle'.
    */

    session_start();
    if(isset($_SESSION["adminSI"])){
        //La sesion está disponible, significa que es un alumno válido, entonces hay que permitir el acceso y personalizar la infomación que se despliegue.
        //Regularmente separo las funcionalidades en archivos y aquellos que vean con el sufijo '_BD' significa que realiza operaciones de solo consulta a la BD y cuyos resultados se utilizarán en el archivo actual; también observen que tiene el nombre del archivo base (alumno.php), esto con la intención de identificar rapidamente aquel conjunto de archivos que están relacionados; así pues sera común que, de ser necesario, encuentren archivos que se llamen 'alumno.js', 'alumno.css', 'alumno_AX.php', por ejemplo, el último contienen todo el código que el servidor realizará ante una llamada AJAX hecha por 'alumno.php' por medio del archivo 'alumno.js' concretamente en la función '$.ajax({})'

    include("./../fix/configBD.php");
    
    $idA = $_SESSION["adminSI"];
    $sqlInfBoleta = "SELECT * FROM administrador WHERE ID_ADMIN = '$idA'";
    $resInfBoleta = mysqli_query($conexion, $sqlInfBoleta);
    $infInfBoleta = mysqli_fetch_row($resInfBoleta);

    $infBoleta = "<h3 class='center-align'>Bienvenido administrador $infInfBoleta[1] ($infInfBoleta[0])</h3>";

    
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
</head>
<body>

   <nav class="blue">
       <div class="nav-wrapper container">
         <a href="#" class="brand-logo">Preinscripciones ESCOM</a>
         <a href="#" data-target="menu-responsive" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="ReporteAlumno.php">Reporte por Alumno</a></li>
        <li><a href="ReporteMateria.php">Reporte por Materia</a></li>
        <li><a href="./CerrarSesionAdmin.php?nombreSesion=adminSI">Cerrar Sesión</a></li>
      </ul>
    </div>
  </nav>
  <ul class="sidenav" id="menu-responsive">
        <li><a href="ReporteAlumno.php">Reporte por Alumno</a></li>
        <li><a href="ReporteMateria.php">Reporte por Materia</a></li>
        <li><a href="./CerrarSesionAdmin.php?nombreSesion=adminSI">Cerrar Sesión</a></li>
     </ul>

    <main class="valign-wrapper">
        <div class="container">
            <div class="row">
                  <div class="col s12 m12">
                      <h5> <?php echo $infBoleta; ?></h5>
                  </div>
                  <div class="col s12 m12"></div>
                
                  <div class="col s12 m6 input-field">
                    <i class="fas fa-search prefix indigo-text text-darken-4"></i>
                    <label for="boleta">Busca un alumno por Boleta</label>
                    <input type="search" id="buscarA" name="buscarA" maxlength="25" data-validetta="required,minLength[1],maxLength[25]">
                </div>
             </div>
               
                <table class="responsive-table striped">
                <thead>
                   <tr>
                       <th>Boleta</th>
                       <th>Nombre(s)</th>
                       <th>A.Paterno</th>
                       <th>A.Materno</th>
                       <th>Correo</th>
                   </tr>

                </thead>
                <tbody id="allstudents">

                </tbody>
                
                </table>

           
            <div class="row">
              <div class="col s12 m12">
                    <h6>Zona para editar, eliminar o agregar a un estudiante:</h6>
              </div>
            <form id="editstudent" autocomplete="on">
                <div class="col s12 m12 input-field">
                    <i class="fas fa-search prefix indigo-text text-darken-4"></i>
                    <label for="boleta">Para seleccionar un alumno escribe su boleta:</label>
                    <input type="text" id="seleccion" name="seleccion" maxlength="12" data-validetta="required,minLength[8],maxLength[12]">
                </div>
                <!-- <div class="col s12 m6 input-field">
                    <input class="btn orange" id="btnseleccion" name="btnseleccion" value="Seleccionar">
                </div> -->
                <div class="col s12 m4 input-field">
                    <i class="fas fa-user prefix indigo-text text-darken-4"></i>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" maxlength="20" data-validetta="required,minLength[3],maxLength[20]">
                </div>
                <div class="col s12 m4 input-field">
                    <i class="fas fa-user prefix indigo-text text-darken-4"></i>
                    <label for="paterno">Apellido Paterno:</label>
                    <input type="text" id="paterno" name="paterno" maxlength="20" data-validetta="required,minLength[3],maxLength[20]">
                </div>
                <div class="col s12 m4 input-field">
                    <i class="fas fa-user prefix indigo-text text-darken-4"></i>
                    <label for="materno">Apellido Materno:</label>
                    <input type="text" id="materno" name="materno" maxlength="20" data-validetta="required,minLength[3],maxLength[20]">
                </div><div class="col s12 m4 input-field">
                    <i class="fas fa-envelope-square prefix indigo-text text-darken-4"></i>
                    <label for="correo">Correo:</label>
                    <input type="text" id="correo" name="correo" maxlength="30" data-validetta="required,email,minLength[3],maxLength[30]">
                </div>
                <div class="col s12 m4 input-field">
                    <i class="fas fa-phone prefix indigo-text text-darken-4"></i>
                    <label for="nombre">Tel&eacute;fono:</label>
                    <input type="text" id="telefono" name="telefono" maxlength="20" data-validetta="required,number,minLength[3],maxLength[20]">
                </div>
                <div class="col s12 m4 input-field">
                    <i class="fas fa-key prefix indigo-text text-darken-4"></i>
                    <label for="contrasena">Contrase&ntilde;a:</label>
                    <input type="text" id="contrasena" name="contrasena" maxlength="20" data-validetta="required,minLength[3],maxLength[20]">
                </div>
                <div class="col s12 m4 input-field">
                      <button type="submit" id="editar" class="btn deep-purple lighten-2">Editar</button>
                </div>
                <div class="col s12 m4 input-field">
                      <button type="submit" id="agregar" class="btn deep-purple lighten-2">Agregar</button>
                </div>
                <div class="col s12 m4 input-field">
                      <button type="submit" id="eliminar" class="btn red lighten-2">Eliminar</button>
                </div>
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
        //NO se detectó la sesion que hubo de generarse después de pasar por el login, entonces es un intento de acceso no autorizado, lo redireccionamos a la pantalla correspondiente
        header("location:./../../index.html");
    }
?>