<?php

use PHPMailer\PHPMailer\PHPMailer;

include("./../fix/configBD.php");
    include("./../fix/PHPMailerm/src/PHPMailer.php");
    include("./../fix/PHPMailerm/src/SMTP.php");


    setlocale(LC_ALL, "es_MX");
    $boleta = $_POST['search'];
    $sqlAlumno = "SELECT * FROM alumnos WHERE N_BOLETA = '$boleta'";
    $resAlumno = mysqli_query($conexion, $sqlAlumno);
    $infAlumno = mysqli_fetch_row($resAlumno);
    $txtIntroduccion = "Has solicitado recuperar tu password, la cu&aacute;l se te brindar&aacute; a continuaci&oacute;n, recuerda que puedes cambiarla iniciando sesi&oacute;n en nuestra p&aacute;gina en Pre inscripciones ESCOM";
    
    /* echo json_encode($infAlumno); */
    $email_user = "annlaport23@gmail.com"; 
    $email_password = "Anne23julio"; 
    $the_subject = "Pre inscripciones ESCOM: Re establecer tu password";
    $address_to = $infAlumno[4]; 
    $from_name = "ESCOM-IPN";     //Nombre de persona o aplicación que envía el correo
    $phpmailer = new PHPMailer();

    // ---------- datos de la cuenta de Gmail -------------------------------
    $phpmailer->Username = $email_user;
    $phpmailer->Password = $email_password; 
    //-----------------------------------------------------------------------
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Host = "smtp.gmail.com"; // GMail
    $phpmailer->Port = 465;
    $phpmailer->IsSMTP(); // use SMTP
    $phpmailer->SMTPAuth = true;

    $phpmailer->setFrom($phpmailer->Username,$from_name);
    $phpmailer->AddAddress($address_to);

    $phpmailer->Subject = $the_subject;	
    $phpmailer->Body .="<h1 style='color:#3498db;'>Hola $infAlumno[1]</h1>";
    $phpmailer->Body .= "<p>$txtIntroduccion</p>";
    $phpmailer->Body .= "<p>
    Boleta: $infAlumno[0] <br>
    Tel&eacute;fono: $infAlumno[5] <br>
    Password: $infAlumno[6] <br>
    </p>";
    $phpmailer->IsHTML(true);

    $phpmailer->Send();

    echo 'funciono';
?>