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
    if(isset($_POST['returnView']))
    {
        $return_id = $_POST['return_id'];
        returunPurchaseOrderDetails($return_id);
    }
    else if(isset($_POST['completeReturn']))
    {
        $completeReturn_id = $_POST['returnPurchaseOrder_id'];
        
        $updateReturnedPurchaseOrder = "UPDATE `tbl_purchase_return` SET `status`='2' WHERE `p_returnId` = '$completeReturn_id'";
        if(mysqli_query($con,$updateReturnedPurchaseOrder) == 1)
        {
            $getReturnOrderPurchaseID = "SELECT `p_orderId` FROM `tbl_purchase_return` WHERE `p_returnId` = '$completeReturn_id'";
            $purOrderDetails = mysqli_fetch_array(mysqli_query($con,$getReturnOrderPurchaseID));
            $purchaseOrderId = $purOrderDetails['p_orderId'];
            
            $updatePurchaseOrderTable = "UPDATE `tbl_purchase_order` SET `status`='4' WHERE `p_orderId` = '$purchaseOrderId'";
            if(mysqli_query($con,$updatePurchaseOrderTable) == 1)
            {
                echo "Purchase Return Completed";
                    
            }
            else
            {
                $reUpdateReturnedPurchaseOrder = "UPDATE `tbl_purchase_return` SET `status`='1' WHERE `p_returnId` = '$completeReturn_id'";
                $updateResults = mysqli_query($con,$reUpdateReturnedPurchaseOrder);
                if($updateResults == 1)
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
    else if(isset($_POST['returnInvoice']))
    {
        $purchaseReturnOrderID = $_POST['returnPurOrdId'];
        
        $getReturnOrderPurchaseID = "SELECT `p_orderId` FROM `tbl_purchase_return` WHERE `p_returnId` = '$purchaseReturnOrderID'";
        $purOrderDetails = mysqli_fetch_array(mysqli_query($con,$getReturnOrderPurchaseID));
        $purchaseOrderId = $purOrderDetails['p_orderId'];
        
        viewReturnPurchaseOrderPdf($purchaseOrderId,$purchaseReturnOrderID);
        
    }
    
}
?>