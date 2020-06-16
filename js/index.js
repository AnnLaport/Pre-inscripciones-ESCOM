$(document).ready(function(){
    $("#formIndex").validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
            e.preventDefault();
            $.ajax({
                url:"./pages/index_AX.php",
                method:"POST",
                data:$("#formIndex").serialize(),
                cache:false,
                success:function(respAX){
                    //Aquí llega la respuesta del servidor en formato JSON y no olvidemos que JSON NO hace nada, debemos convertirlo en algo que JS entienda y a partir de aquí acceder mediante notación punto o la que sea necesaría a toda la información disponible.
                    var AX = JSON.parse(respAX);
                    var titulo = "<h2>Preinscripciones ESCOM</h2>";
                    $.alert({
                        title:titulo,
                        content:AX.msj,
                        icon:"fas fa-cogs fa-2x",
                        theme:"supervan",
                        onDestroy:function(){
                            if(AX.val == 0){
                                //Significa que no se encontraron registros con los datos proporcionados, indicarlo al usuario y presentarle nuevamente el formulario para que lo intente nuevamente.
                                location.replace("./pages/alumno/registro.html");
                            }
                            if(AX.val == 1){
                                //Significa que los datos fueron correctos, entonces indicarlo al usuario y en cuanto cierre el 'confirm' redireccionar automaticamete a la página exclusiva del alumno en cuestión.
                                location.replace("./pages/alumno/login.html");
                            }
                            if(AX.val == 2){
                                //Significa que los datos fueron correctos, entonces indicarlo al usuario y en cuanto cierre el 'confirm' redireccionar automaticamete a la página exclusiva del alumno en cuestión.
                                
                                location.replace("./pages/alumno/autentificacion.php");
                                        
                            }
                            
                        }
                    });
                }
            });
        }
    });

    $('#formRegister').validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
           
            const postData={
                id:$('#boleta').val(),
                nombre:$('#nombre').val(),
                paterno:$('#apaterno').val(),
                materno:$('#apmaterno').val(),
                correo:$('#correo').val(),
                telefono:$('#telefono').val(),
                contrasena:$('#contrasena').val(),
                repcontrasena:$('#rcontrasena').val(),
            };
            
           
            $.post('./registro.php',postData,function(response){

                var AX = JSON.parse(response);
                var titulo = "<h2>Preinscripciones ESCOM</h2>";

                $.alert({
                    title:titulo,
                    content:AX.msj,
                    icon:"fas fa-cogs fa-2x",
                    theme:"supervan",
                    onDestroy:function(){
                        if(AX.val == 0){
                           
                        }
                        if(AX.val == 1){
                            //Significa que los datos fueron correctos, entonces indicarlo al usuario y en cuanto cierre el 'confirm' redireccionar automaticamete a la página exclusiva del alumno en cuestión.
                            location.replace("../../index.html");
                        }

                        
                    }
                });

            });
            e.preventDefault();
        }
    });

    $('#formAutentificacion').validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
           
            const postAutentic={
                idA:$('#boletaA').val(),
                correoA:$('#correo').val(),
                telefonoA:$('#telefono').val(),
                contrasenaA:$('#contrasena').val(),
                repcontrasenaA:$('#rcontrasena').val(),
            };
            
           
            $.post('./autentificacionBDD.php',postAutentic,function(response){

                var AX = JSON.parse(response);
                var titulo = "<h2>Preinscripciones ESCOM</h2>";
                
                $.alert({
                    title:titulo,
                    content:AX.msj,
                    icon:"fas fa-cogs fa-2x",
                    theme:"supervan",
                    onDestroy:function(){
                        if(AX.val == 0){
                           
                        }
                        if(AX.val == 1){
                            //Significa que los datos fueron correctos, entonces indicarlo al usuario y en cuanto cierre el 'confirm' redireccionar automaticamete a la página exclusiva del alumno en cuestión.
                            location.replace("../../index.html");
                        }

                        
                    }
                });
                


            });
            e.preventDefault();
        }
    });

    $('#formSesion').validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
           
            const postSesion={
                idS:$('#boleta').val(),
                contrasenaS:$('#contrasena').val(),
               
            };
            
           
            $.post('./loginA.php',postSesion,function(response){
    
    
                var AX = JSON.parse(response);
                var titulo = "<h2>Preinscripciones ESCOM</h2>";
                
                $.alert({
                    title:titulo,
                    content:AX.msj,
                    icon:"fas fa-cogs fa-2x",
                    theme:"supervan",
                    onDestroy:function(){
                        if(AX.val == 0){
                           
                        }
                        if(AX.val == 1){
                            //Significa que los datos fueron correctos, entonces indicarlo al usuario y en cuanto cierre el 'confirm' redireccionar automaticamete a la página exclusiva del alumno en cuestión.
                            location.replace("./alumno.php");
                        }
    
                        
                    }
                });
                
    
    
            });
            e.preventDefault();
        }
    });

    $('#formRecover').submit(function(e){
        e.preventDefault();
        let search=$('#boleta').val();

        $.ajax({
            url: 'recuperarPassw.php',
            type: 'POST',
            data:{search:search},
            cache:false,
            success: function(response){
                console.log(response);
              /* var AX = JSON.parse(response);
              var titulo = "<h2>Preinscripciones ESCOM</h2>";
  
              $.alert({
                  title:titulo,
                  content:AX.msj,
                  icon:"fas fa-cogs fa-2x",
                  theme:"supervan",
                  onDestroy:function(){
                      if(AX.val == 0){
                         
                      }
                      if(AX.val == 1){
                          location.replace("./PerfilAlumno.php");
                      }                    
                  }
              }); */
              
                
               
            }
        });
    })

});

