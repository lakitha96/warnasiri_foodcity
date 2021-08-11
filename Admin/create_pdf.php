<?php

//create_pdf.php
session_start();
include('pdf.php');
require_once('assets/Notify/notify-php-master/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
include("assets/functions/function.php");
include("assets/functions/db.php");
if(!isset($_SESSION['adminUsername']))
{
    
}
else
{
if(isset($_POST["hidden_html"]) && $_POST["hidden_html"] != '')
{
    $adminEmailGet = $_SESSION['adminUsername'];
    $getCurrentEmail = "SELECT `admin_email` FROM `tbl_admin` WHERE `admin_email` = '$adminEmailGet'";
     $currentEmailDetails = mysqli_fetch_assoc(mysqli_query($db,$getCurrentEmail));
     $adminEmail = $currentEmailDetails['admin_email'];
    if($adminEmail == null)
    {
        echo "
            <script>
            window.location.replace('index.php');
            </script>
            
            ";
    }
    else
    {
    
    $year = $_POST['yearName'];
 $file_name = "sales&returnreport$year.pdf";
 $html = '<link rel="stylesheet" href="bootstrap.min.css">';
 $html .= $_POST["hidden_html"];

 $pdf = new Pdf();
 $pdf->load_html($html);
 $pdf->render();
 
    
    
    $file = $pdf->output();
     file_put_contents("assets/Sales&ReturnReports/$file_name",$file);

     $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'warnasirifoodcity@gmail.com';
        $mail->Password = 'warnasiri@2021';
        $mail->setFrom('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
        $mail->addReplyTo('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
        $mail->addAddress("$adminEmail");
        $mail->AddAttachment("assets/Sales&ReturnReports/$file_name");
        $mail->Subject = "Sales and Return Report - $year";
         $mail->Body = "Yearly sales and Return report of - Warnasiri FoodCity";

         if (!$mail->send()) 
        {
            //echo 'Mailer Error: '. $mail->ErrorInfo;
            echo "
            <script>
            window.location.replace('index.php');
            </script>
            
            ";
        } 
        else 
        {
            $pdf->stream($file_name, array("Attachment" => false));
        }
    
    }
    
}
}
?>