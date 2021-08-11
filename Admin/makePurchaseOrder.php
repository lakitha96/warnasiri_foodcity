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

 if(isset($_POST["product_id"]))  
 {
    $p_Id = $_POST["product_id"]; 

     echo " <div class='bg-soft-primary'>
                                <div class='row'>
                                    <div class='col-7'>
                                        <div class='text-primary p-4'>
                                            <h5 class='text-primary'> Purchase Order</h5>
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
                                <div class='p-2'>
                                    <div class='alert alert-success text-center mb-4' role='alert'>
                                          <label for='search'>Supplier Name or Supplied Item Name </label>
                                          <input type='search' class='form-control' id='suppsearch' placeholder='Search here'><br>
                                            <div class='col-12 text-right'>
                                            <button class='btn btn-primary w-md waves-effect waves-dark btnSearchSupplier'  onclick = 'return validate()' type='button'>Search</button>
                                            </div>
                                    </div>
                                    
                                    
                                    
                            <form class='form-horizontal' >
                            
                                    <div class='form-group'>
                                            <label for='itemname'>Item Id</label>
                                            <input type='text' class='form-control' id='itemID' value='$p_Id' readonly placeholder='Product ID'>
                                        </div>  
            
                                        <div class='form-group'>
                                            <label for='suppemail'> Supplier Email</label>
                                            <input type='email' class='form-control' id='suppemail' placeholder='Email Address' readonly>
                                            </div>
                                            
                                          <input type='text' hidden class='form-control' id='suppID' placeholder='' value='' readonly>
                                        
                                         <div class='form-group'>
                                            <label for='itemname'>Item Name</label>
                                            <input type='text' class='form-control' id='itname' placeholder='Item Name'>
                                        </div>
                                        
                                         <div class='form-group'>
                                            <label for='userchangepass'>Item Quntity</label>
                                            <input type='text' class='form-control' id='qty' placeholder='Item Quantity'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='confpass'>Order Discription</label>
                                         
                                            <textarea style='min-height:200px;' class='form-control' id='discrip'></textarea>
                                        </div>
                    
                                        <div class='form-group row mb-0'>
                                            <div class='col-12 text-right'>
                                                <button class='btn btn-primary w-md waves-effect waves-light btnAddPurchaseOrder' type='button'>Send Order</button>
                                            </div>
                                        </div>
    
                                    </form>
                                </div>
            
                            </div>";
     
 }
else if(isset($_POST['supplier_seaarch_item']))
{
       $SupIDItemtag = $_POST['supplier_seaarch_item'];
    if($SupIDItemtag == null || $SupIDItemtag == "")
    {
        echo "Please enter supplier item tag to select supplier";
    }
    else
    {
        $checkPSupplierExits = "SELECT * FROM `tbl_supplier` WHERE item_tag ='$SupIDItemtag'";
        $checkResult = mysqli_query($con,$checkPSupplierExits);
        $resultRow = mysqli_fetch_array($checkResult);
        $checkedItemTag = $resultRow['item_tag'];
        if($checkedItemTag == null || $checkedItemTag == "")
        {
            echo "Please enter correct supplier item tag to select supplier";
        }
        else
        {    
            
             $supplierEmail = $resultRow['sup_email']; 
             echo "$supplierEmail";
          
                     
         
        }
        
    }   
}
    
   else if(isset($_POST['sendPurchaseOrder']))
   {
       $supplierEmail = $_POST['email']; 
       $itemName = $_POST['itemname'];
       $proQty = $_POST['qty'];
       $ordDescription = $_POST['discription'];
       $itemID = $_POST['itemID'];
       
       $getSupplier = "SELECT `sup_id` FROM `tbl_supplier` WHERE `sup_email` = '$supplierEmail'";
       $supplierDetails = mysqli_fetch_assoc(mysqli_query($con,$getSupplier));
       $suppID = $supplierDetails['sup_id'];
       
       
       
       $getCurrentMaxOrdId = "SELECT MAX(CAST(SUBSTR(TRIM(p_orderId),6) AS UNSIGNED)) AS purOrdID FROM tbl_purchase_order WHERE p_orderId RLIKE 'PORD'";
       $fetchOrdID = mysqli_fetch_assoc(mysqli_query($con,$getCurrentMaxOrdId));
       $ordIDGot = $fetchOrdID['purOrdID'];
       
       if($ordIDGot == null || $ordIDGot == "")
       {
           $maxPurchaseOrderID = 1;
       }
       else
       {
           $maxPurchaseOrderID = $ordIDGot + 1;
       }
       date_default_timezone_set('Asia/Colombo');
       $datePurchase = date('Y-m-d G:i:s ', time());

       
       
       $insertPurchaseRecord = "INSERT INTO `tbl_purchase_order`(`p_orderId`,`item_name`,`quantity`, `date`, `sup_id`, `product_id`, `status`,`order_description`) VALUES ('PORD-$maxPurchaseOrderID','$itemName','$proQty','$datePurchase','$suppID','$itemID','1','$ordDescription')";
       
       if(mysqli_query($con,$insertPurchaseRecord) == 1)
       {
           $purOrd = "PORD-$maxPurchaseOrderID";
           $file_name = $purOrd . '.pdf';
             $html_code = '<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">';
             $html_code .= printPurchaseOrderPdf($purOrd,$itemName);
             $pdf = new Pdf();
             $pdf->load_html($html_code);
             $pdf->render();
             $file = $pdf->output();
             file_put_contents("assets/purchaseOrders/$file_name",$file);
           
           
           $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = 'warnasirifoodcity@gmail.com';
                $mail->Password = '';
                $mail->setFrom('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
                $mail->addReplyTo('warnasirifoodcity@gmail.com', 'Warnasiri FoodCity');
                $mail->addAddress($supplierEmail);
                $mail->AddAttachment("assets/purchaseOrders/$file_name");
                $mail->Subject = "New Purchase Order from Warnasiri FoodCity";
                 $mail->Body = "Purchase of product - $itemName";  
             
                 if (!$mail->send()) 
                {
                    //echo 'Mailer Error: '. $mail->ErrorInfo;
                    echo "Somthing went wrong please try again";
                } 
                else 
                {
                    echo "purchase done successfully";
                }
           
           
           
       }
       else
       {
           echo "Something went wrong - Please Try Again!";
       }
      
   }
    
}
?>