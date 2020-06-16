

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="../../js/plugins/validetta/validetta.min.css" rel="stylesheet">
    <link href="../../js/plugins/confirm/jquery-confirm.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../../js/plugins/validetta/validetta.min.js"></script>
    <script src="../../js/plugins/validetta/validettaLang-es-ES.js"></script>
    <script src="../../js/plugins/confirm/jquery-confirm.min.js"></script>
    <script src="../../js/index.js"></script>
</head>
<body>

    <nav class="blue">
        <div class="nav-wrapper">
          <a href="#" class="brand-logo center">Preinscripciones ESCOM</a>
        </div>
      </nav>
            
        
        <main class="valign-wrapper">
            <div class="container">
                <form id="formAutentificacion" autocomplete="on">
                <div class="row">

                    <div class="col s12 m12">
                    </div>

                    <div class="col s12 m8 offset-m2 input-field">
                        <i class="fas fa-id-card prefix indigo-text text-darken-4"></i>
                        <label for="boleta">Boleta</label>
                        <input type="text" id="boletaA" maxlength="10" data-validetta="required,number,minLength[8],maxLength[10]">
                    </div>
        
                    <div class="col s12 m8 offset-m2 input-field">
                        <i class="fas fa-at prefix indigo-text text-darken-4"></i>
                        <label for="Correo">Correo</label>
                        <input type="text" id="correo" name="correo" maxlength="50" data-validetta="required,email,minLength[10],maxLength[50]">
                    </div>
                    <div class="col s12 m8 offset-m2 input-field">
                        <i class="fas fa-phone-square-alt prefix indigo-text text-darken-4"></i>
                        <label for="Telefono">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" maxlength="12" data-validetta="required,number,minLength[8],maxLength[12]">
                    </div>
                    <div class="col s12 m8 offset-m2 input-field">
                        <i class="fas fa-key prefix indigo-text text-darken-4"></i>
                        <label for="contrasena">Contraseña</label>
                        <input type="password" id="contrasena" name="contrasena" maxlength="25" data-validetta="required,minLength[10],maxLength[25]">
                    </div>
                    <div class="col s12 m8 offset-m2 input-field">
                        <i class="fas fa-key prefix indigo-text text-darken-4"></i>
                        <label for="rcontrasena">Repetir Contraseña</label>
                        <input type="password" id="rcontrasena" name="rcontrasena" maxlength="25" data-validetta="required,minLength[10],maxLength[25]">
                    </div>
                   
                    <div class="col s12 m6 offset-m3 input-field">
                        <input type="submit" class="btn blue" value="Enviar" style="width: 100%;">
                    </div>
                </div>
                </form>
            </div>
        </main>
    
</body>
</html>



