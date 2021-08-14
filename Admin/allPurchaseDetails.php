<?php
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
     echo "
                    <script>
                        function goBack(){
                            alert('Please Login!');
                          window.location.replace('auth-login.php');
                        }
                        
                        goBack();
                    </script>
    ";
}
else
{

 if(isset($_POST["purchase_id"]))  
 {
     $purchaseID = $_POST["purchase_id"];
     purchaseOrderDetails($purchaseID);
 }
else if(isset($_POST["purchaseOrder_id"]))
{
    $purchaseOrderID = $_POST["purchaseOrder_id"];
    
    purchaseOrderCompletionGrn($purchaseOrderID);
    
    
}
    else if(isset($_POST["completeOrder"]))
    {
        $purOrderID = $_POST['purOrderID'];
        $summary = $_POST['summary'];
        
         date_default_timezone_set('Asia/Colombo');
        $dateGRN = date('Y-m-d G:i:s ', time());
        
        $updateQuery = "UPDATE `tbl_purchase_order` SET `status`='2' WHERE `p_orderId` = '$purOrderID'";
        if(mysqli_query($con,$updateQuery) == 1)
        {
            $getCurrMaxGrnId = "SELECT MAX(CAST(SUBSTR(TRIM(grn_no),5) AS UNSIGNED)) AS grnID FROM tbl_grn WHERE `grn_no` RLIKE 'GRN'";
            $fetchedGrnId = mysqli_fetch_array(mysqli_query($con,$getCurrMaxGrnId));
            $grnCurrentMax = $fetchedGrnId['grnID'];
            if($grnCurrentMax == null || $grnCurrentMax == "")
            {
               $maxGRN =  1;
            }
            else
            {
                $maxGRN =  $grnCurrentMax + 1;
            }
            
            $insertGrn = "INSERT INTO `tbl_grn`(`grn_no`, `date`, `p_orderId`, `description`) VALUES ('GRN-$maxGRN','$dateGRN','$purOrderID','$summary')";
            
            $insertResults = mysqli_query($con,$insertGrn);
            if($insertResults == 1)
            {
                $customFileName = "GRN-$maxGRN$purOrderID";
                $file_name = $customFileName . '.pdf';
             $html_code = '<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">';
             $html_code .= printGrn($purOrderID,$summary);
             $pdf = new Pdf();
             $pdf->load_html($html_code);
             $pdf->render();
             $file = $pdf->output();
             file_put_contents("assets/GrnDetails/$file_name",$file);
           
                $adminData = "SELECT  `admin_email` FROM `tbl_admin` WHERE `admin_id` = 1";
                $adminEmailData = mysqli_fetch_array(mysqli_query($con,$adminData));
                $adminEmailAddress = $adminEmailData['admin_email'];
                
                $getSupplierIDQuery = "SELECT `sup_id` FROM `tbl_purchase_order` WHERE `p_orderId` = '$purOrderID'";
                $supplierIdDetails = mysqli_fetch_array(mysqli_query($con,$getSupplierIDQuery));
                $supplierID = $supplierIdDetails['sup_id'];
                
                $getSupplierEmailAddress = "SELECT `sup_email` FROM `tbl_supplier` WHERE `sup_id` = '$supplierID'";
                $emailDetailSupplier = mysqli_fetch_array(mysqli_query($con,$getSupplierEmailAddress));
                $supplierEmailAddress = $emailDetailSupplier['sup_email'];
                
                
                
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = 'warnasirifoodcity@gmail.com';
                $mail->Password = 'xuuqbepniuwgtxvg';
                $mail->setFrom('warnasirifoodcity@gmail.com', 'xuuqbepniuwgtxvg');
                $mail->addReplyTo('warnasirifoodcity@gmail.com', 'Warnasiri ');
                $mail->addAddress($supplierEmailAddress);
                $mail->addAddress($adminEmailAddress);
                $mail->AddAttachment("assets/GrnDetails/$file_name");
                $mail->Subject = "GRN Details for Purchase Order ID - $purOrderID";
                 $mail->Body = "Infiorm us if there any issue in GRN - Thankyou!";  
             
                 if (!$mail->send()) 
                {
                    //echo 'Mailer Error: '. $mail->ErrorInfo;
                    echo "Mail Couldn't be sent thankyou!";
                } 
                else 
                {
                    echo "Purchase Completed";
                }
           
                
            }
            else
            {
                $reUpdateQueryPurchaseOrder = "UPDATE `tbl_purchase_order` SET `status`='2' WHERE `p_orderId` = '$purOrderID'";
                if(mysqli_query($con,$reUpdateQueryPurchaseOrder) == 1)
                {
                    echo "Something went wrong - Please Try Again!";
                     
                }
                else
                {
                    echo "Something went wrong - Please Try Again!";
                }
            }
            
            
            
        }
        else
        {
            echo "Something went wrong - Please Try Again!";
        }
        
    }
        
    
}
?>
