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
    if(isset($_POST['purchase_id']))
    {
       $purchase_id = $_POST['purchase_id'];
        
        $getAllpurchaseOrderDetails = "SELECT `item_name`, `quantity`, `sup_id` FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchase_id'";
        $purchaseDetails = mysqli_fetch_array(mysqli_query($con,$getAllpurchaseOrderDetails));
        
        $itemName = $purchaseDetails['item_name']; 
        $itemQty = $purchaseDetails['quantity'];
        $supId = $purchaseDetails['sup_id'];
        
        $getDetailsOfSupplier = "SELECT `sup_email` FROM `tbl_supplier` WHERE `sup_id`= '$supId'";
        $supplierDetails = mysqli_fetch_array(mysqli_query($con,$getDetailsOfSupplier));
        $suppEmail = $supplierDetails['sup_email'];
        echo "
               
                            <div class='bg-soft-primary'>
                                <div class='row'>
                                    <div class='col-7'>
                                        <div class='text-primary p-4'>
                                            <h5 class='text-primary'> Purchase Return</h5>
                                            <p>with Warnasiri FoodCity.</p>
                                        </div>
                                    </div>
                                    <div class='col-5 align-self-end'>
                                        <img src='assets/images/profile-img.png' alt='' class='img-fluid'>
                                    </div>
                                </div>
                            </div>
                            <div class='card-body pt-0'> 
                                <div>
                                         
                                        <div class='avatar-md profile-user-wid mb-4'>
                                            <span class='avatar-title rounded-circle bg-light'>
                                                <img src='assets/images/logo.svg' alt='' class='rounded-circle' height='34'>
                                            </span>
                                        </div>
                                   
                                </div>
                                   <div id='error_message'></div>
                                     <form class='form-horizontal' method='post'>
                                <div class='p-2'>
                                    
                                      
                                  
            
                                        <div class='form-group'>
                                            <label for='suppemail'> Supplier Email</label>
                                            <input type='email' value='$suppEmail' readonly class='form-control' id='suppemail' placeholder='Email Address'>
                                            </div>
                                            
                                        
                                         <div class='form-group'>
                                            <label for='itemname'>Item Name</label>
                                            <input type='text' class='form-control' id='itname' readonly value='$itemName' name='itemname'placeholder='Item Name'>
                                        </div>
                                        
                                         <div class='form-group'>
                                            <label for='itemqty'>Item Quntity</label>
                                            <input type='text' class='form-control' id='qty' value='$itemQty' name='itqty'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='returndis'>Purchase Order Return Discription</label>
                                         
                                            <textarea class='form-control'  name='itdiscrip' id='discrip'></textarea>
                                        </div>
                    
                                        <div class='form-group row mb-0'>
                                            <div class='col-12 text-right'>
                                                <button class='btn btn-primary w-md waves-effect waves-light btnSendReturn' name='btnsend'  id='$purchase_id' type='button'>Send Order</button>
                                            </div>
                                        </div>
    
                                
                                </div>
                             </form>
                            </div>
                        
        
        ";
        
        
        
    }
    else if(isset($_POST['purchaseOrder_id']))
    {
        $p_ordID = $_POST['purchaseOrder_id'];
        
        $suppEmail = $_POST['email'];
        $Qty = $_POST['qty'];
        $itemName = $_POST['itemname'];
        $returnDescription = $_POST['discription'];
        
        $getSupplier = "SELECT `sup_id` FROM `tbl_supplier` WHERE `sup_email` = '$suppEmail'";
       $supplierDetails = mysqli_fetch_assoc(mysqli_query($con,$getSupplier));
       $suppID = $supplierDetails['sup_id'];
        
        $getCurrentReturnMaxOrdId = "SELECT MAX(CAST(SUBSTR(TRIM(p_returnId),7) AS UNSIGNED)) AS purReturnOrdID FROM tbl_purchase_return WHERE p_returnId RLIKE 'RPORD'";
       $fetchOrdReturnID = mysqli_fetch_assoc(mysqli_query($con,$getCurrentReturnMaxOrdId));
       $returnOrdIDGot = $fetchOrdReturnID['purReturnOrdID'];
       
       if($returnOrdIDGot == null || $returnOrdIDGot == "")
       {
           $maxReturnPurchaseOrderID = 1;
       }
       else
       {
           $maxReturnPurchaseOrderID = $returnOrdIDGot + 1;
       }
       
        date_default_timezone_set('Asia/Colombo');
       $dateReturnPurchase = date('Y-m-d G:i:s ', time());
        
        $checkQtyAgain = "SELECT `quantity` FROM `tbl_purchase_order` WHERE `p_orderId` = '$p_ordID'";
        $qtyResults = mysqli_fetch_array(mysqli_query($con,$checkQtyAgain));
        $qtyAtPurchaseOrder = $qtyResults['quantity'];
        if($Qty > $qtyAtPurchaseOrder)
        {
            echo "Please double check the entered quantity";
        }
        else
        {
            $insertReturn = "INSERT INTO `tbl_purchase_return`(`p_returnId`, `p_orderId`, `qty`, `date`, `status`, `sup_id`, `description`) VALUES ('RPORD-$maxReturnPurchaseOrderID','$p_ordID','$Qty','$dateReturnPurchase','1','$suppID','$returnDescription')";
            $insertResults = mysqli_query($con,$insertReturn);
            if($insertResults == 1)
            {
                
                $updateQuery = "UPDATE `tbl_purchase_order` SET `status`='3' WHERE `p_orderId` = '$p_ordID'";
                if(mysqli_query($con,$updateQuery) == 1)
                {
                
                $returnPurOrd = "RPORD-$maxReturnPurchaseOrderID";
               $file_name = $returnPurOrd . '.pdf';
                 $html_code = '<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">';
                 $html_code .= printReturnPurchaseOrderPdf($p_ordID,$returnPurOrd);
                 $pdf = new Pdf();
                 $pdf->load_html($html_code);
                 $pdf->render();
                 $file = $pdf->output();
                 file_put_contents("assets/ReturnPurchaseOrders/$file_name",$file);
                
                
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = 'warnasirifoodcity@gmail.com';
                $mail->Password = 'lookatme123Hey';
                $mail->setFrom('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
                $mail->addReplyTo('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
                $mail->addAddress($suppEmail);
                $mail->AddAttachment("assets/ReturnPurchaseOrders/$file_name");
                $mail->Subject = "New Return Purchase Order from Warnasiri FoodCity";
                 $mail->Body = "Purchase Return of product - $itemName"; 
                
                if (!$mail->send()) 
                {
                    //echo 'Mailer Error: '. $mail->ErrorInfo;
                    echo "Something went wrong Please Try Again";
                } 
                else 
                {
                   echo "Return Purchase order has been placed";
                }
                }
                else
                {
                    echo "Something went wrong Please Try Again";
                }
                
                
            }
            else
            {
                echo "Something went wrong Please Try Again";
            }
            
        }
        
        
    }
    
}
?>