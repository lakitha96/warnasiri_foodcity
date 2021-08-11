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
        <title>දයා Stores | Admin</title>
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
                                    <h4 class="mb-0 font-size-18">All Purchase Orders</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Purchase Order</a></li>
                                            <li class="breadcrumb-item active">All Purchase Orders</li>
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
        
                                        
                            <table id="allPurchaseTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead>
                                    <tr>
                                         <th>Purchase ID</th>
                                        <th>Supplier</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>
                                        <th>Date</th>
                                        <th>Product ID</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>View Details</th>
                                        <th class="text-center">Action</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                            
                                    <?php

                                        getAllPurchaseOrder();

                                    ?>

                                </tbody>
                            </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                
                <div class="modal fade bd-example-modal-xl" id="purchaseOrderDetailsDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Purchase Order Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="purchaseOrderDetailsBodyModal">
                              
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="modal fade exampleModal" id="purchaseOrderGRNDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Goods Receipt Note</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="purchaseOrderGRNBodyModal">
                              
                                
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
            $('#allPurchaseTable').DataTable({
                "ordering": false,
                dom: 'Bfrtip',
                 "bStateSave": true,
                    "fnStateSave": function (oSettings, oData) {
                        localStorage.setItem('offersDataTables', JSON.stringify(oData));
                    },
                    "fnStateLoad": function (oSettings) {
                        return JSON.parse(localStorage.getItem('offersDataTables'));
                    },
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'portrait',
                        title: 'Warnasiri FoodCity All Purchase Orders',
                        pageSize: 'A4',
                        exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]

                        }
                    },
                    {
                        extend: 'excelHtml5',
                       orientation: 'portrait',
                        title: 'Warnasiri FoodCity All Purchase Orders',
                        pageSize: 'A4',
                        exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                        }
                    }
                ]
                
            });
        } );
     </script>
     
     
     
     
     
     <script>  
     $(document).ready(function(){  
          $("#allPurchaseTable").on("click", ".btnViewPurchaseOrder", function(){  
               var purchase_id = $(this).attr("id");
             $.ajax({  
                    url:"allPurchaseDetails.php",  
                    method:"post",  
                    data:{purchase_id:purchase_id},  
                    success:function(data){  
                         $('#purchaseOrderDetailsBodyModal').html(data);  
                        $('#purchaseOrderDetailsDataModal').modal("show");   
                    }  
               }); 
               
          });  
     });  
     </script>
     
     <script>  
     $(document).ready(function(){
         var purchaseOrder_id = "";
          $("#allPurchaseTable").on("click", ".btnCompletePurchaseOrder", function(){  
               purchaseOrder_id = $(this).attr("id");
              
              
             $.ajax({  
                    url:"allPurchaseDetails.php",  
                    method:"post",  
                    data:{purchaseOrder_id:purchaseOrder_id},  
                    success:function(data){  
                         $('#purchaseOrderGRNBodyModal').html(data);  
                        $('#purchaseOrderGRNDataModal').modal("show");   
                    }  
               }); 
             
          });  
     });  
     </script>
     
     <script> 
         
     $(document).ready(function(){  
          $("#purchaseOrderGRNDataModal").on("click", ".btnSendGrn", function(){  
               var purOrderID = $(this).attr("id");
              var summary = document.getElementById("discrip").value;
                  
                
                if(summary==""){
                   toastr.error(
                              '',
                              'Please enter Summary',
                              {
                                timeOut: 1500,
                                fadeOut: 1500,
                                onHidden: function () {
                                    
                                  }
                              }
                            );
                 }
                
                  
                else if(summary.length>=600){
               
                   toastr.error(
                              '',
                              'Summary Too Long ..! Please Maintain Between 600',
                              {
                                timeOut: 1500,
                                fadeOut: 1500,
                                onHidden: function () {
                                    
                                  }
                              }
                            );
                 }
              else{
                  $(".btnSendGrn").attr( "disabled", "disabled" );
                  document.getElementById("loader").style.display = "block";
                  $.ajax({  
                    url:"allPurchaseDetails.php",  
                    method:"post",  
                    data:{completeOrder:'true',purOrderID:purOrderID,summary:summary},  
                    success:function(data){  
                        
                        if(data == "Purchase Completed")
                            {
                                $(".btnSendGrn").attr( "disabled", "disabled" );
                                
                                toastr.success(
                                  '',
                                  data,
                                  {
                                    timeOut: 800,
                                    fadeOut: 800,
                                    onHidden: function () {
                                        location.reload();
                                         document.getElementById("loader").style.display = "none";
                                        
                                      }
                                  }
                                );
                                
                            }
                        else{
                            $(".btnSendGrn").removeAttr( "disabled", "disabled" );
                            toastr.error(
                                  '',
                                  data,
                                  {
                                    timeOut: 800,
                                    fadeOut: 800,
                                    onHidden: function () {
                                            location.reload();
                                         document.getElementById("loader").style.display = "none";
                                        
                                      }
                                  }
                                );
                            
                        }
                           
                         //$('#purchaseOrderBodyModal').html(data);  
                         //$('#purchaseOrderDataModal').modal("show");   
                    }  
               });
              }
              
              
               
               
          });  
     });  
     </script>
     
        
   
   
    </body>


</html>

<?php } ?>