<?php

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
         <a href="#" class="brand-logo">Preinscripciones ESCOM</a>
         <a href="#" data-target="menu-responsive" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="alumno.php">Elegir Materias</a></li>
        <li><a href="./CerrarSesionAlumno.php?nombreSesion=alumnoSI">Cerrar Sesión</a></li>
      </ul>
    </div>
  </nav>
  <ul class="sidenav" id="menu-responsive">
        <li><a href="alumno.php">Elegir Materias</a></li>
        <li><a href="./CerrarSesionAlumno.php?nombreSesion=alumnoSI">Cerrar Sesión</a></li>
     </ul>

    <main class="valign-wrapper">
        <div class="container">
        <div class="row">
                    <hr size="1px" color="white " />
                    <hr size="1px" color="white " />
                    <hr size="1px" color="white " />
                    <hr size="1px" color="white " />
                       <h5>Si algún dato es incorrecto, corrígelo y presiona el botón para editarlo!</h5>
                       <p>Para que tu pre inscripción sea tomada en cuenta, tus datos deben ser correctos (!)</p>
                    <form id="formEditAlumno" autocomplete="off">
                        <input type="text" id="IDAlumnoEd" name="IDAlumnoEd" value="<?php echo $infInfBoleta[0]; ?>" maxlength="10" data-validetta="minLength[8],maxLength[12]" disabled>
                
                        <div class="col s12 m4 input-field">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $infInfBoleta[1]; ?>" data-validetta="required">
                        </div>
                        <div class="col s12 m4 input-field">
                            <label for="primerApe">Primer apellido</label>
                            <input type="text" id="primerApe" name="primerApe" value="<?php echo $infInfBoleta[2]; ?>" data-validetta="required">
                        </div>
                        <div class="col s12 m4 input-field">
                            <label for="segundoApe">Segundo apellido</label>
                            <input type="text" id="segundoApe" name="segundoApe" value="<?php echo $infInfBoleta[3]; ?>" data-validetta="required">
                        </div>
                        <div class="col s12 m4 input-field">
                            <label for="correo">Correo</label>
                            <input type="text" id="correo" name="correo" value="<?php echo $infInfBoleta[4]; ?>" data-validetta="required,email">
                        </div>
                        <div class="col s12 m4 input-field">
                            <label for="fechaNac">Teléfono</label>
                            <input type="text" id="telefonoA" name="telefonoA"  value="<?php echo $infInfBoleta[5]; ?>" data-validetta="required,number,minLength[8],maxLength[12]">
                        </div>
                        <div class="col s12 m4 input-field">
                            <button type="submit" id="EditarBtn" class="btn deep-orange accent-2" style="width:100%">Editar</button>
                        </div>
                    </form>

                    <div class="col s12 m12">
                        <a href="cambiarContra.php">Quieres cambiar tu Password? Da clic a éste enlace..</a>
                    </div>
                    
                    <form>
                          <div class="col s12 m12">
                                    <input type="hidden" id="IDAlumnoS" name="IDAlumnoS" value="<?php echo $infInfBoleta[0]; ?>" maxlength="10" data-validetta="minLength[8],maxLength[12]" disabled>

                          </div>
                          <div class="col s12 m12">
                          </div>
                          <div class="col s12 m12">
                          </div>
                          
                           <div class="col s12 m6 center-align offset-m2">
                           <button type="submit" class="btn red lighten-1" id="tusMaterias">Mostrar lista de materias</button>
                           </div>

                    </form>
                    
                    <div>
                         <h5 class="col s12 m12">Tu lista de materias:</h5>
                    </div>
                   
                    <br>
                       <table class="striped">
                             <thead>
                                     <tr>
                                         <th>Clave de Asignatura</th>
                                         <th>Nombre de asignatura</th>
                                         <th>Recurse(1)/No Recurse(0)</th>
                                     </tr>

                            </thead>
                            <tbody id="issuesIchose">

                            </tbody>
                
                       </table>
                       <hr size="1px" color="#B0C4DE " />
                       <div class="col s12 m6 input-field">
                         <a href="./getComprobante.php" class="btn red lighten-1 ">Obtener Comprobante</a>
                       </div>
                   
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