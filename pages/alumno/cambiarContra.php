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
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="alumno.php">Elegir Materias</a></li>
        <li><a href="./CerrarSesionAlumno.php?nombreSesion=alumnoSI">Cerrar Sesión</a></li>
      </ul>
    </div>
  </nav>

    <main class="valign-wrapper">
        <div class="container">
        <div class="row">
                    <hr size="1px" color="white " />
                    <hr size="1px" color="white " />
                    <hr size="1px" color="white " />
                    <hr size="1px" color="white " />
                       <h5>Llene los campos para cambiar su contrase&ntilde;a:</h5>

                    <form id="updatePass">

                            <input type="hidden" id="idalumno" name="idalumno" value="<?php echo $boleta; ?>" data-validetta="required,minLength[8]">
                       
                       <div class="col s12 m5 input-field">
                            <i class="fas fa-lock prefix indigo-text text-darken-4"></i>
                            <label for="contrasena">Escriba la nueva Contrase&ntilde;a :</label>
                            <input type="password" id="contrasena" name="contrasena" data-validetta="required,minLength[8]">
                        </div>
                        <div class="col s12 m5 input-field">
                            <i class="fas fa-lock prefix indigo-text text-darken-4"></i>
                            <label for="rcontrasena">Repita la nueva contrase&ntilde;a:</label>
                            <input type="password" id="rcontrasena" name="rcontrasena"  data-validetta="required,minLength[8]">
                        </div>
                        <div class="col s12 m5 input-field">
                            <i class="fas fa-lock prefix indigo-text text-darken-4"></i>
                            <label for="rcontrasena">Escriba su contrase&ntilde;a actual:</label>
                            <input type="password" id="vcontrasena" name="vcontrasena"  data-validetta="required,minLength[8]">
                        </div>
                        <div class="col s12 m5 input-field">
                             <input type="submit" class="btn orange" value="Cambiar Contrase&ntilde;a" style="width: 100%;">
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
    
</body>
</html>

<?php
    }else{
        //NO se detectó la sesion que hubo de generarse después de pasar por el login, entonces es un intento de acceso no autorizado, lo redireccionamos a la pantalla correspondiente
        header("location:./../../index.html");
    }
?>