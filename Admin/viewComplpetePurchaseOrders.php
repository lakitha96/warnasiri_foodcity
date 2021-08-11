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
    if(isset($_POST['purchaseOrder']))
    {
        $purchaseOrdID = $_POST['purchase_id'];
        viewPurchaseOrderBill($purchaseOrdID);
    }
    else if(isset($_POST['viewGRN']))
    {
        $purOrderID = $_POST['purchaseOrder_id'];
        viewGrnDetail($purOrderID);
    }
    
}
?>