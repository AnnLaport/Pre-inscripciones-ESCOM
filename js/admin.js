$(document).ready(function () {
    
    $('#formSesionAd').validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
           
            const postSesionAd={
                idS:$('#idadmin').val(),
                contrasenaS:$('#contrasena').val(),
               
            };
            
           
            $.post('./loginB.php',postSesionAd,function(response){
    
                var AX = JSON.parse(response);
                var titulo = "<h2>Preinscripciones ESCOM</h2>";
                
                $.alert({
                    title:titulo,
                    content:AX.msj,
                    icon:"fas fa-cogs fa-2x",
                    theme:"supervan",
                    onDestroy:function(){
                        if(AX.val == 0){
                            location.replace("./loginAd.html");
                        }
                        if(AX.val == 1){
                            //Significa que los datos fueron correctos, entonces indicarlo al usuario y en cuanto cierre el 'confirm' redireccionar automaticamete a la página exclusiva del alumno en cuestión.
                            location.replace("./inicioAdmin.php");
                        }
    
                        
                    }
                });
                
            });
            e.preventDefault();
        }
    });

    $('#buscarA').keyup(function (e) { 
        let buscar=$('#buscarA').val();
        $.ajax({
            type: "POST",
            url: "buscarAlumnos.php",
            data: {buscar:buscar},
            success: function (response) {
               let alumnos=JSON.parse(response);

               let template='';
               alumnos.forEach(element => {
                   template += `
                   <tr>
                       <td>${element.boleta}</td>
                       <td>${element.nombre}</td>
                       <td>${element.paterno}</td>
                       <td>${element.materno}</td>
                       <td>${element.correo}</td>
                   </tr>
                   `
               });
               $('#allstudents').html(template);
                
            }
        });
        
    });

    $('#eliminar').click(function (e) { 
        e.preventDefault(); 
        let erase = $('#seleccion').val();
         
    
        $.ajax({
            url: 'eliminarA.php',
            type: 'POST',
            data:{erase:erase},
            cache:false,
            success: function(response){
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
                            location.replace("./inicioAdmin.php");
                        }
    
                        
                    }
                });
                
                
            }
        });
        
    });

    $('#editar').click(function (e) { 
        e.preventDefault();

        const postEditar={
            boletaED:$('#seleccion').val(),
            nombreED:$('#nombre').val(),
            paternoED:$('#paterno').val(),
            maternoED:$('#materno').val(),
            correoED:$('#correo').val(),
            telefonoED:$('#telefono').val(),
            contrasenaED:$('#contrasena').val(),
           
        };
        
       
        $.post('./EditarS.php',postEditar,function(response){

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
                        location.replace("./inicioAdmin.php");
                    }

                    
                }
            });
            
        });

        
    });


    $('#editstudent').validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid:function(e){
            e.preventDefault();
            const postAgregar={
                boletaS:$('#seleccion').val(),
                nombreS:$('#nombre').val(),
                paternoS:$('#paterno').val(),
                maternoS:$('#materno').val(),
                correoS:$('#correo').val(),
                telefonoS:$('#telefono').val(),
                contrasenaS:$('#contrasena').val(),
               
            };
            
           
            $.post('./AgregarS.php',postAgregar,function(response){

                var AX = JSON.parse(response);
                var titulo = "<h2>Preinscripciones ESCOM</h2>";
                
                $.alert({
                    title:titulo,
                    content:AX.msj,
                    icon:"fas fa-cogs fa-2x",
                    theme:"supervan",
                    onDestroy:function(){
                        if(AX.val == 0){
                            location.replace("./inicioAdmin.php");
                        }
                        if(AX.val == 1){
                            //Significa que los datos fueron correctos, entonces indicarlo al usuario y en cuanto cierre el 'confirm' redireccionar automaticamete a la página exclusiva del alumno en cuestión.
                            location.replace("./inicioAdmin.php");
                        }
    
                        
                    }
                });
                
            });
           
        }
    });

    $('#reportabtn').click(function (e) { 
        e.preventDefault();
        let reporte=$('#reportA').val();
        $.ajax({
            type: "POST",
            url: "repAlumnos.php",
            data: {reporte:reporte},
            success: function (response) {
               
               let alumnosR=JSON.parse(response);

               let template='';
               alumnosR.forEach(element => {
                   template += `
                   <div class="col s12 m12 input-field">
                   <i class="fas fa-user prefix indigo-text text-darken-4"></i>
                   <input type="text" value="${element.nombre}" id="nombrerep" name="nombrerep" disabled>
               </div>
               <div class="col s12 m4 input-field">
                   <i class="fas fa-user prefix indigo-text text-darken-4"></i>
                   <input type="text" value="${element.paterno}" id="paternorep" name="paternorep" disabled>
               </div>
               <div class="col s12 m4 input-field">
                   <i class="fas fa-user prefix indigo-text text-darken-4"></i>
                   <input type="text" value="${element.materno}" id="maternorep" name="maternorep" disabled>
               </div>
               <div class="col s12 m4 input-field">
                   <i class="fas fa-envelope-square prefix indigo-text text-darken-4"></i>
                   <input type="text" value="${element.correo}" id="correorep" name="correorep" disabled>
               </div>
               <div class="col s12 m4 input-field">
                   <i class="fas fa-phone prefix indigo-text text-darken-4"></i>
                   <input type="text" value="${element.telefono}" id="telefonorep" name="telefonorep" disabled>
               </div>
                   `
               });
               $('#greporteA').html(template);
                
            }
        });

        
    });

    $('#reportabtn').click(function (e) { 
        let search = $('#reportA').val();
          e.preventDefault(); 
    
        $.ajax({
            url: 'materiasxalumno.php',
            type: 'POST',
            data:{search:search},
            cache:false,
            success: function(response){
               
            let issue= JSON.parse(response);
                
                let template='';
                issue.forEach(element => {
                    template += `
                    <tr>
                        <td>${element.idmateria}</td>
                        <td>${element.nombremat}</td>
                        <td>${element.estado}</td>
                    </tr>
                    `
                });
                $('#issuesAlumno').html(template);
            }
        });
        
    });

    $('#reportabtn').click(function (e) { 
        let estads = $('#reportA').val();
          e.preventDefault(); 
    
        $.ajax({
            url: 'estadisticaxalumno.php',
            type: 'POST',
            data:{estads:estads},
            cache:false,
            success: function(response){
               
            let issued= JSON.parse(response);
               
                let template='';
                issued.forEach(element => {
                    template += `
                    <div class="col s12 m12">
                    <h6>Este chico/chica va a cursar ${element.total} materias en total</h6>
                    </div>
                    <div class="col s12 m12">
                    <h6>${element.curses} curses</h6>
                    </div>
                    <div class="col s12 m12">
                    <h6>${element.recurses} recurses</h6>
                    </div>
                    <div class="col s12 m12"></div>
                    <a href="./comprobanteA.php?alumnoPDF=${element.pdfa}" class="btn red lighten-2">Generar reporte del alumno en PDF</a>
                     </div>
                    `
                });
                $('#estadisticaxA').html(template);
            }
        });
        
    });   

});