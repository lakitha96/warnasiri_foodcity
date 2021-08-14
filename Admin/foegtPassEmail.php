<?php
session_start();
include("assets/functions/function.php");
include("assets/functions/db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';
if(isset($_SESSION['adminUsername']))
{
    
}
else
{
    
    if(isset($_POST['emailAdd']))
    {
        
        $emailAdd = $_POST['emailAdd'];
        $updateEmailAddress = "SELECT `admin_email` FROM `tbl_admin` WHERE `admin_email` = '$emailAdd'";
        $searchResults = mysqli_query($db,$updateEmailAddress);
        $noOfRows = mysqli_num_rows($searchResults);
        if($noOfRows == 0)
        {
            echo "Please make sure the entered email address is correct";
        }
        else
        {
             $random_no = mt_rand(100000,999999); 

            //Create a new PHPMailer instance
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'warnasirifoodcity@gmail.com';
            $mail->Password = 'xuuqbepniuwgtxvg';
            $mail->setFrom('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
            $mail->addReplyTo('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
            $mail->addAddress($emailAdd);
            $mail->Subject = 'Fogot Password - Warnasiri FoodCity Admin';

            $mail->msgHTML("<body>
                    <div style='background-color: #55aa1b; height: 52px;'>
                        <h2 style='padding-top:10px;'>Warnasiri FoodCity Stores</h2>
                    </div>
                    
                    <h3 style='color: orange'>
            Confirm your E-mail address - Warnasiri FoodCity</h3>
                   <p>Dear Sir/Madam,<br><br></p>
                    <P>Add another layer of security to your Warnasiri FoodCity account by confirming your email address.
            By confirming your email address receive promotional emails and recover your account details</P>
                  <p>Your Account confirmation code</p>
                   <div style='background-color: aquamarine; height: 40px; width: 150px; margin: auto; border-color: black; border-style: solid;'>
                       <p style='text-align: center; margin-top: 6px; font-size: 20px; font-weight: bold;'>$random_no</p>
                   </div>
                   <p>Sincerely,<br>
            warnasirifoodcity.com</p>

                </body>");
            //$mail->addAttachment('images/phpmailer_mini.png');

            //send the message, check for errors
            if (!$mail->send()) 
            {
                echo "Something went wrong please try again!";
                //echo 'Mailer Error: '. $mail->ErrorInfo;
                
            } 
            else 
            {
                
                echo "$random_no";
                //echo "
                //<script>
                //alert('We have sent you the verification code - Thankyou!');
                //</script>

                //";

            }
        }
        
    
    }
}
?>