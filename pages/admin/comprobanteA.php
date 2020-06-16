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

    
        $boleta = $_REQUEST["alumnoPDF"];
        $sqlAlumno = "SELECT * FROM alumnos WHERE N_BOLETA = '$boleta'";
        $resAlumno = mysqli_query($conexion, $sqlAlumno);
        $infAlumno = mysqli_fetch_row($resAlumno);
        $txtIntroduccion = utf8_decode("Comprobante de Datos de Alumno.");

        $queryM="SELECT ID_MATERIA,NOMBRE_MATERIA,ESTADO from materias_alumno WHERE N_BOLETA='$boleta'";
        $result=mysqli_query($conexion,$queryM);

        if(!$result){
             die('Query failed'.mysqli_error($conexion));
        }
    
        $estudiantes=$result->fetch_all();
        


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
        $pdf->Cell(0,7,"Boleta: $infAlumno[0]",0,1);
        $pdf->Cell(0,7,utf8_decode("Nombre: $infAlumno[1] $infAlumno[2] $infAlumno[3]"),0,1);
        $pdf->Cell(0,7,utf8_decode("Correo: $infAlumno[4]"),0,1);
        $pdf->Ln(10);
        $pdf->Cell(0,7,utf8_decode("Lista de materias de tu pre inscripción:"),0,1);
        $pdf->Ln(10);
    
        $pdf->Cell(50,5,'Clave Asignatura',1,0,'C');
        $pdf->Cell(50,5,'Nombre Asignatura',1,0,'C');
        $pdf->Cell(60,5,utf8_decode('Recurse(1)/No Recurse(0)'),1,0,'C'); 
        /* $qrcode = new QRcode("$boleta / TWeb-20202", "H");
        $qrcode->displayFPDF($pdf,10,130,50); */
        $pdf->Ln(5);
        foreach($estudiantes as $estudiante){
            $pdf->Cell(50,5,utf8_decode($estudiante[0]),1,0,'C');
            $pdf->Cell(50,5,utf8_decode($estudiante[1]),1,0,'C');
            $pdf->Cell(60,5,utf8_decode($estudiante[2]),1,0,'C');
            $pdf->Ln(5);
        }
        $pdf->Output();

    

    ?>