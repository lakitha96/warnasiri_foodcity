<?php
session_start();
include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
   
    $cusId = $_SESSION['customerId'];
    
}


if(isset($_POST["orderEmail"]) && isset($_POST["orderID"]))  
{
    $orderEmail = $_POST['orderEmail'];
    $orderId = $_POST['orderID'];
    
    $getOrderDetails = "SELECT `order_status` FROM `tbl_sales_order` WHERE `s_orderId`='$orderId' AND `cus_email` = '$orderEmail'";
    $orderDetails = mysqli_fetch_array(mysqli_query($con,$getOrderDetails));
    $orderStatus = $orderDetails['order_status'];
    
    if($orderStatus == "1")
    {
        echo "
                        <div class='row justify-content-between'>
                
								<div class='order-tracking order-tracking-current completed '>
                                    <img class='deliImg' style='min-width:100px; max-width:100px;' src='img/delivery.gif'>
									<span class='is-complete'></span>
                                  <p>Order Placed<br><span>Mon, June 24</span></p>
								</div>
                                <div class='order-tracking notHaveImage'>
                                      
									<span class='is-complete'></span>
									<p>Order Accepted</p>
								</div>
								<div class='order-tracking notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Delivered</p>
								</div>
                
								<div class='order-tracking notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Completed</p>
								</div>
                
							</div>
                            
                            <div class='text-center'>
							<p style='color:green;'>Your Order has been placed at our store. Once confirmed we will let you know.</p>
							</div>
    
    
    ";
    }
    else if($orderStatus == "2")
    {
        echo "
                        <div class='row justify-content-between'>
                
								<div class='order-tracking order-tracking-current completed notHaveImage'>
                                    
									<span class='is-complete'></span>
                                  <p>Order Placed<br><span>Mon, June 24</span></p>
								</div>
                                <div class='order-tracking-current completed '>
                                      <img class='deliImg' style='min-width:100px; max-width:100px;' src='img/delivery.gif'>
									<span class='is-complete'></span>
									<p>Order Accepted</p>
								</div>
								<div class='order-tracking notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Delivered</p>
								</div>
                
								<div class='order-tracking notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Completed</p>
								</div>
                
							</div>
                            
                            <div class='text-center'>
							<p style='color:green;'>Your Order has been accepted from our store.</p>
							</div>
    
    
    ";
    }
    else if($orderStatus == "3")
    {
        echo "
                        <div class='row justify-content-between'>
                
								<div class='order-tracking-current completed notHaveImage'>
                                    
									<span class='is-complete'></span>
                                  <p>Order Placed<br><span>Mon, June 24</span></p>
								</div>
                                <div class='order-tracking completed notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Accepted</p>
								</div>
								<div class='order-tracking-current completed'>
                                <img class='deliImg' style='min-width:100px; max-width:100px;' src='img/delivery.gif'>
									<span class='is-complete'></span>
									<p>Order Delivered</p>
								</div>
                
								<div class='order-tracking notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Completed</p>
								</div>
                        
							</div>
                            
                            <div class='text-center'>
							<p style='color:green;'>Your Order has been delivered from our store. It will be in your door step as soon as possible.</p>
							</div>
    
    
    ";
    }
    else if($orderStatus == "4")
    {
        echo "
                        <div class='row justify-content-between'>
                
								<div class='order-tracking-current completed notHaveImage'>
                                    
									<span class='is-complete'></span>
                                  <p>Order Placed<br><span>Mon, June 24</span></p>
								</div>
                                <div class='order-tracking completed notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Accepted</p>
								</div>
								<div class='order-tracking completed notHaveImage'>
									<span class='is-complete'></span>
									<p>Order Delivered</p>
								</div>
                
								<div class='order-tracking-current completed'>
                                <img class='deliImg' style='min-width:100px; max-width:100px;' src='img/delivery.gif'>
									<span class='is-complete'></span>
									<p>Order Completed</p>
								</div>
                
							</div>
                    
                            <div class='text-center'>
							<p style='color:green;'>Your Order has been completed - Thankyou!</p>
							</div>
    
    ";
    }
    else
    {
        echo "No Data";
    }
    
    
}


?>