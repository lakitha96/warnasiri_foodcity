<?php
session_start();
$_SESSION['atAdminPage']="all-Products.php";
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
include("assets/functions/function.php");


?>
<!doctype html>
<html lang="en">

    

<head>
        
        <meta charset="utf-8" />
        <title>Warnasiri FoodCity | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css" />
        
         <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <?php include("assets/includes/topheader.php"); ?>
            </header> <!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <?php include("assets/includes/slidebar.php"); ?>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div id="loader" class="loader">
                 </div>
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                       <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Add Purchase Order</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Purchase Order</a></li>
                                            <li class="breadcrumb-item active">Add Purchase Order</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        
                            <table id="productTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead>
                                    <tr>
                                         <th>Image</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Discount Status</th>
                                        <th>Discount Amount</th>
                                        <th>Available Status</th>
                                        <th>Stock Amount</th>
                                        <th>Catogory</th>
                                        <th class="text-center">Make Purchase</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                            
                                    <?php

                                        getAllProductsAddPurchaseOrder();

                                    ?>

                                </tbody>
                            </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                
                <div class="modal fade exampleModal" id="purchaseOrderDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Purchase Order</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="purchaseOrderBodyModal">
                               
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Page-content -->
                
                <!--edit pro-->
                
                
                
                
                <!--edit Finish-->
                
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        
        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>    

        <script src="assets/js/app.js"></script>
        <script>
            $(document).ready(function() {
            $('#productTable').DataTable({
                "ordering": false,
                 "bStateSave": true,
                    "fnStateSave": function (oSettings, oData) {
                        localStorage.setItem('offersDataTables', JSON.stringify(oData));
                    },
                    "fnStateLoad": function (oSettings) {
                        return JSON.parse(localStorage.getItem('offersDataTables'));
                    }
                
            });
        } );
     </script>
     
     
     
     
     
     <script>  
     $(document).ready(function(){  
          $("#productTable").on("click", ".btnMakePurchaseOrder", function(){  
               var product_id = $(this).attr("id");  
              $.ajax({  
                    url:"makePurchaseOrder.php",  
                    method:"post",  
                    data:{product_id:product_id},  
                    success:function(data){  
                         $('#purchaseOrderBodyModal').html(data);  
                         $('#purchaseOrderDataModal').modal("show");   
                    }  
               }); 
               
          });  
     });  
     </script>
     
     <script>  
     $(document).ready(function(){  
          $("#purchaseOrderBodyModal").on("click", ".btnSearchSupplier", function(){  
               var supplier_seaarch_item = document.getElementById("suppsearch").value;
              $.ajax({  
                    url:"makePurchaseOrder.php",  
                    method:"post",  
                    data:{supplier_seaarch_item:supplier_seaarch_item},  
                    success:function(data){  
                        
                        if(data == "Please enter supplier item tag to select supplier" || data == "Please enter correct supplier item tag to select supplier")
                            {
                                toastr.error(
                                  '',
                                  data,
                                  {
                                    timeOut: 800,
                                    fadeOut: 800,
                                    onHidden: function () {

                                        
                                      }
                                  }
                                );
                                document.getElementById("suppemail").value="";
                            }
                        else{
                            
                            document.getElementById("suppemail").value=data;
                        }
                           
                         //$('#purchaseOrderBodyModal').html(data);  
                         //$('#purchaseOrderDataModal').modal("show");   
                    }  
               }); 
               
          });  
     });  
     </script>
     
        <script>  
     $(document).ready(function(){  
          $("#purchaseOrderBodyModal").on("click", ".btnAddPurchaseOrder", function(){
                var email= document.getElementById("suppemail").value;
                var itemname = document.getElementById("itname").value;
                var qty = document.getElementById("qty").value;
                var discription = document.getElementById("discrip").value;
                var itemID = document.getElementById("itemID").value;
              
              if(email.indexOf("@") == -1 || email.length < 6){
                   
                  toastr.error(
                          '',
                          'Please select a supplier',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                  
                 }
              
              else if(email.indexOf("@") == -1 || email.length < 6){
                   
                  toastr.error(
                          '',
                          'Please Enter valid Email',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                  
                 }
                
             
              else if((email.charAt(email.length-4)!='.')&& (email.charAt(email.length-3)!='.'))
              {
                  
                  toastr.error(
                          '',
                          '. Invalid Position',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
             
              }
             else if(email.length>50)
              {
                  
                  toastr.error(
                          '',
                          'Please Re-check  email address',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
             
              }
         
           
            else if(itemname ==""){
                
                  toastr.error(
                          '',
                          'Please Enter an Item Name',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                
                 }
              else if(itemname.length >= 41){
                
                  toastr.error(
                          '',
                          'Please insert maximum 40 charactors for item name',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                
                 }
            
             else if( qty == ""){
                
                   toastr.error(
                          '',
                          'Please  Enter Your Quntity',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                 }
         
         else if(isNaN(qty) ){
                
                   toastr.error(
                          '',
                          'Please Check Quntity Again',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                 }
               else if( qty.length>10){
                
                   toastr.error(
                          '',
                          'Please Check Quntity Again',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                 }
         
         else if(discription ==""){
              
                   toastr.error(
                          '',
                          'Please  Enter Discription',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                 }
              else if(discription.length>600){
              
                   toastr.error(
                          '',
                          'Please Enter Discription Between 1-600',
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {


                              }
                          }
                        );
                 }
              
              
              else{
                  $(".btnAddPurchaseOrder").attr( "disabled", "disabled" );
                document.getElementById("loader").style.display = "block";
                  $.ajax({  
                    url:"makePurchaseOrder.php",  
                    method:"post",  
                    data:{sendPurchaseOrder:'true',
                         email:email,
                        itemname:itemname,
                        qty:qty,
                        discription:discription,
                          itemID:itemID
                         },  
                    success:function(data){
                            
                        if(data == "purchase done successfully")
                            {
                                $(".btnAddPurchaseOrder").attr( "disabled", "disabled" );
                                  toastr.success(
                          '',
                          data,
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {
                                document.getElementById("loader").style.display = "none";

                              }
                          }
                        );
                                
                           
                            }
                        else{
                              toastr.error(
                          '',
                          data,
                          {
                            timeOut: 800,
                            fadeOut: 800,
                            onHidden: function () {
                                        $(".btnAddPurchaseOrder").removeAttr( "disabled", "disabled" );
                                        document.getElementById("loader").style.display = "none";
                              }
                          }
                        );
                        }
                    }  
               }); 
                  
                  
                  
              }
              
              
              
              
              
               
          });  
     });  
     </script>
   
   
    </body>


</html>

<?php } ?>