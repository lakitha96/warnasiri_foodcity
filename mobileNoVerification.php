<?php

session_start();
require_once('Notify/notify-php-master/autoload.php');
include("assets/db.php");
include("assets/functions.php");
if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}
if(isset($_POST["mobileNo"]))  
{
    
    $no = $_POST['mobileNo'];
    $random_no = mt_rand(100000,999999); 
    $api_instance = new NotifyLk\Api\SmsApi();
    $user_id = "11897"; // string | API User ID - Can be found in your settings page.
$api_key = "xTbtIOAWowbMobSXYPwd"; // string | API Key - Can be found in your settings page.
    $message = "verification Code : $random_no"; // string | Text of the message. 320 chars max.
$to = "$no"; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
    $sender_id = "Warnasiri FoodCity";
    $contact_fname = ""; // string | Contact First Name - This will be used while saving the phone number in your Notify contacts.
$contact_lname = ""; // string | Contact Last Name - This will be used while saving the phone number in your Notify contacts.
$contact_email = ""; // string | Contact Email Address - This will be used while saving the phone number in your Notify contacts.
$contact_address = ""; // string | Contact Physical Address - This will be used while saving the phone number in your Notify contacts.
$contact_group = 0; // int | A group ID to associate the saving contact with

 
    
try {
    $api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group);
    echo "$random_no";
} catch (Exception $e){
    echo "123";
   // echo 'Exception when calling SmsApi->sendSMS: ', $e->getMessage(), PHP_EOL;
}

    
}

?>