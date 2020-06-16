$(document).ready(function () {

   issuedeplay();
  
    
    
   function issuedeplay(){
    $.ajax({
        url: 'bringIssues.php',
        type: 'GET',
        success: function(response){
            let issue= JSON.parse(response);
            
            let template='';
            issue.forEach(element => {
                template += `
                <tr>
                    <td>${element.idmateria}</td>
                    <td>${element.nombremat}</td>
                </tr>
                `
            });
            $('#issues').html(template);
        }
    });
   }

   $('#formInscribir').validetta({
    bubblePosition: "bottom",
    bubbleGapTop: 10,
    bubbleGapLeft: -5,
    onValid:function(e){

       
        const postInscription={

            idalumno:$('#IDAlumno').val(),
            idmateria:$('#IDMateria').val(),
            recurse:$('#recurse').prop('checked'),
            
        };

        $.post('./Inscripcion.php',postInscription,function(response){


            var AX = JSON.parse(response);
            var titulo = "<h2>Preinscripciones ESCOM</h2>";
            $('#formInscribir').trigger('reset');

            $.alert({
                title:titulo,
                content:AX.msj,
                icon:"fas fa-cogs fa-2x",
                theme:"supervan",
                onDestroy:function(){
                    if(AX.val == 0){
                       
                    }
                    if(AX.val == 1){
                       
                    }

                    
                }
            });
            

        });

        e.preventDefault();
    }
});

    $('#SendIssues').hover(function (e) { 
        let search = $('#IDAlumno').val();
       /*  e.preventDefault(); */
    
        $.ajax({
            url: 'bringMyIssues.php',
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
                $('#issueschose').html(template);
            }
        });
        
    });


$('#formErase').validetta({
    bubblePosition: "bottom",
    bubbleGapTop: 10,
    bubbleGapLeft: -5,
    onValid:function(e){

       
        const postErase={

            idalumno:$('#IDAlumnoE').val(),
            idmateria:$('#IDMateriaE').val(),
            
        };

        $.post('./EraseIssue.php',postErase,function(response){

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
                }
            });
            

        });
       
        e.preventDefault();
    }

    
});

$('#SendIssuesErase').hover(function (e) { 
    let search = $('#IDAlumnoE').val();
   /*  e.preventDefault(); */

    $.ajax({
        url: 'bringMyIssues.php',
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
            $('#issueschose').html(template);
        }
    });
    
});

$('#formEditAlumno').validetta({
    bubblePosition: "bottom",
    bubbleGapTop: 10,
    bubbleGapLeft: -5,
    onValid:function(e){

       
        const postEdit={

            idstudent:$('#IDAlumnoEd').val(),
            name:$('#nombre').val(),
            fname:$('#primerApe').val(),
            sname:$('#segundoApe').val(),
            email:$('#correo').val(),
            phone:$('#telefonoA').val(),
            
        };

        $.post('./EditStudent.php',postEdit,function(response){

            var AX = JSON.parse(response);
            var titulo = "<h2>Preinscripciones ESCOM</h2>";

            $.alert({
                title:titulo,
                content:AX.msj,
                icon:"fas fa-cogs fa-2x",
                theme:"supervan",
                onDestroy:function(){
                                
                }
            });
            

        });
       
        e.preventDefault();
    }

    
});

$('#tusMaterias').click(function (e) { 
    let search = $('#IDAlumnoS').val();
      e.preventDefault(); 

    $.ajax({
        url: 'bringMyIssues.php',
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
            $('#issuesIchose').html(template);
        }
    });
    
});

$('#SendIssuesFinal').click(function (e) { 

    if(confirm("Estas seguro? Una vez que envíes tus materias ya no podrás modificar tu selección")){
        let search = $('#IDAlumnoEnd').val();
       
  
        $.ajax({
          url: 'Auditoria.php',
          type: 'POST',
          data:{search:search},
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
                        location.replace("./PerfilAlumno.php");
                    }                    
                }
            });
            
              
             
          }
      });
    }
    e.preventDefault(); 
    
});


$('#updatePass').validetta({
    bubblePosition: "bottom",
    bubbleGapTop: 10,
    bubbleGapLeft: -5,
    onValid:function(e){
        e.preventDefault();
       
        const postEditPass={

            idalumno:$('#idalumno').val(),
            ncontrasena:$('#contrasena').val(),
            rncontrasena:$('#rcontrasena').val(),
            vcontrasena:$('#vcontrasena').val(),
            
        };

        $.post('./EditContrasena.php',postEditPass,function(response){

            var AX = JSON.parse(response);
            var titulo = "<h2>Preinscripciones ESCOM</h2>";

            $.alert({
                title:titulo,
                content:AX.msj,
                icon:"fas fa-cogs fa-2x",
                theme:"supervan",
                onDestroy:function(){
                    if(AX.val == 0){
                        location.replace("./cambiarContra.php");
                    }
                    if(AX.val == 1){
                        location.replace("./PerfilAlumno.php");
                    }           
                }
            });
            

        });
       
      
    }

    
});






});