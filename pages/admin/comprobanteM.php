<?php
    session_start();
    include("./../fix/configBD.php");
    include("./../fix/fpdf182/fpdf.php");
   /*  include("./../fix/qrcode/qrcode.class.php"); */

    setlocale(LC_ALL, "es_MX");
    
    class PDF extends FPDF
    {
        // Cabecera de página
        function Header()
        {
            // Logo
            
        }

        // Pie de página
        function Footer()
        {
            // Posición: a 1.5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,utf8_decode("Escuela Superior de Cómputo / Sistema de Prescripciones ESCOM"),0,0,'C');
        }
    }

    
        $reporte = $_REQUEST["materiaPDF"];

        $queryM="SELECT * FROM materia WHERE ID_MATERIA='$reporte'";
        $resm = mysqli_query($conexion, $queryM);
        //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
          $inf1= mysqli_num_rows($resm);
          if($inf1==0){
              die(0);
          }
          $sqlAlumno = "SELECT * FROM materia WHERE ID_MATERIA = '$reporte'";
          $resAlumno = mysqli_query($conexion, $sqlAlumno);
          $infAlumno = mysqli_fetch_row($resAlumno);
         
         $queryM2="SELECT * FROM materias_alumno WHERE ID_MATERIA='$reporte'";
         $resm2 = mysqli_query($conexion, $queryM2);
        //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
          $inf2= mysqli_num_rows($resm2);
          if(!$resm2){
             die('Query failed'.mysqli_error($conexion));
         }
 
          $queryM3="SELECT * FROM materias_alumno WHERE ID_MATERIA='$reporte' AND ESTADO='0'";
          $resm3 = mysqli_query($conexion, $queryM3);
         //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
           $inf3= mysqli_num_rows($resm3);
           if(!$resm3){
             die('Query failed'.mysqli_error($conexion));
         }
 
           $queryM4="SELECT * FROM materias_alumno WHERE ID_MATERIA='$reporte' AND ESTADO='1'";
          $resm4 = mysqli_query($conexion, $queryM4);
         //Nuestro modelo, si está bien hecho, debe contener solo un registro con la combinación boleta-contrasena, en caso contrario habrá que reclamar al profesor de BD
           $inf4= mysqli_num_rows($resm4);
           if(!$resm4){
             die('Query failed'.mysqli_error($conexion));
         }

         $txtIntroduccion = utf8_decode("Comprobante de Datos por Materia.");


         $pdf = new PDF();
         $pdf->AddPage();
         $pdf->SetFont('Arial','',12);
         $pdf->Ln(10);
         $pdf->Cell(0,7,"ESCOM-IPN, ".strftime("%A %d de %B de %Y"),0,1,"R");
         $pdf->Ln(10);
         $pdf->SetFont('Arial','B',14);
         $pdf->MultiCell(0,5,$txtIntroduccion,0,1);
         $pdf->SetFont('Arial','',12);
         $pdf->Ln(10);
         $pdf->Cell(0,7,"Clave de Materia: $infAlumno[0]",0,1);
         $pdf->Cell(0,7,utf8_decode("Nombre: $infAlumno[1]"),0,1);
         $pdf->Ln(10);
         $pdf->Cell(0,7,utf8_decode("Datos relevantes de la materia:"),0,1);
         $pdf->Ln(10);
         $pdf->Cell(0,7,"Total de inscritos: $inf2",0,1);
         $pdf->Cell(0,7,"Cursadores: $inf3",0,1);
         $pdf->Cell(0,7,"Recursadores: $inf4",0,1);
        
         /* $qrcode = new QRcode("$boleta / TWeb-20202", "H");
         $qrcode->displayFPDF($pdf,10,130,50); */
         $pdf->Ln(5);
         $pdf->Output();
 
 