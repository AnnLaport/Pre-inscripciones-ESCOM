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
                $('#materiasreport').html(template);
            }
        });
       }


       $('#reportabtnm').click(function (e) { 
        e.preventDefault();
        let reporte=$('#reportM').val();
        $.ajax({
            type: "POST",
            url: "repMateria.php",
            data: {reporte:reporte},
            success: function (response) {
               
               let materiaR=JSON.parse(response);

               let template='';
               materiaR.forEach(element => {
                   template += `
                      <div class="col s12 m12 input-field">
                           <p>${element.total} alumnos han inscrito ésta materia</p>
                      </div>
                      <div class="col s12 m12 input-field">
                           <p>${element.curses} alumnos van a cursarla</p>
                      </div>
                      <div class="col s12 m12 input-field">
                           <p>${element.recurses} alumnos van a recursarla</p>
                      </div>
                      <div class="col s12 m12"></div>
                      <a href="./comprobanteM.php?materiaPDF=${element.pdfa}" class="btn red lighten-2">Generar reporte de la materia en PDF</a>
                     </div>
                  
                   `
               });
               $('#greporteM').html(template);
                
            }
        });

        
    });


});