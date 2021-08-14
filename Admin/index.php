<?php
include("assets/functions/function.php");
include("assets/functions/db.php");
session_start();
$_SESSION['atAdminPage']="index.php";
if(!isset($_SESSION['adminUsername']))
{
     echo "
                    <script>
                        function goBack(){
                            
                          window.location.replace('auth-login.php');
                        }
                        
                        goBack();
                    </script>
    ";
}
else
{
    if(isset($_POST['btnGetRecordYear']))
    {
        $recordYear = $_POST['txtChartYear'];
        if($recordYear == null || $recordYear == "")
        {
            $conChart = mysqli_connect("helpme-mysql-service.mysql.database.azure.com", "adminuser", "lakitha@21", "dayastore", 3306, MYSQLI_CLIENT_SSL);
            $maxYearRecord = mysqli_fetch_assoc(mysqli_query($conChart,"SELECT MAX(YEAR(`order_date`)) as maxYear FROM tbl_sales_order"));
            $maxYear = $maxYearRecord['maxYear'];
            $recordYear = $maxYear;
            
        }
    }
    else
    {
        $conChart = mysqli_connect("helpme-mysql-service.mysql.database.azure.com", "adminuser", "lakitha@21", "dayastore", 3306, MYSQLI_CLIENT_SSL);
        $maxYearRecord = mysqli_fetch_assoc(mysqli_query($conChart,"SELECT MAX(YEAR(`order_date`)) as maxYear FROM tbl_sales_order"));
        $maxYear = $maxYearRecord['maxYear'];
        $recordYear = $maxYear;
        if($recordYear == null)
        {
            $recordYear = date("Y");
        }
    }

?>
<!DOCTYPE html>

<html lang="en">

    
<head>
        
        <meta charset="utf-8" />
        <title>Warnasiri FoodCity | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css" /> 
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        
         <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
            <script type="text/javascript" src="html2canvas-master/dist/html2canvas.js"></script>
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
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-4">
                                              
                                <div id="piechart"></div>
                                <br>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Top Product Selling Cities</h4>

                                        <div class="text-center">
                                            <div class="mb-4">
                                                <i class="bx bx-map-pin text-primary display-4"></i>
                                            </div>
                                            <h3><?php citytot()?></h3>
                                            <p>Total Selling Cities</p>
                                        </div>

                                        <div class="table-responsive mt-4">
                                            <table class="table table-centered table-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 30%">
                                                            <p class="mb-0">Galle</p>
                                                        </td>
                                                        <td style="width: 25%">
                                                            <h5 class="mb-0"><?php
                                                         cityGalle();
                                                            ?></h5></td>
                                                        <td>
                                                            <div class="progress bg-transparent progress-sm">
                                                                <div class="progress-bar bg-primary rounded" role="progressbar" style="width: <?php progressPiliyandala(); ?>%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p class="mb-0">Ambalangoda</p>
                                                        </td>
                                                        <td>
                                                            <h5 class="mb-0"><?php cityAmbalangoda() ?></h5>
                                                        </td>
                                                        <td>
                                                            <div class="progress bg-transparent progress-sm">
                                                                <div class="progress-bar bg-success rounded" role="progressbar" style="width: <?php progressKesbawa(); ?>%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p class="mb-0">Elpitiya</p>
                                                        </td>
                                                        <td>
                                                            <h5 class="mb-0"><?php cityElpitiya() ?></h5>
                                                        </td>
                                                        <td>
                                                            <div class="progress bg-transparent progress-sm">
                                                                <div class="progress-bar bg-warning rounded" role="progressbar" style="width: <?php progressMoratuwa(); ?>%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <p class="mb-0">Karandeniya</p>
                                                        </td>
                                                        <td>
                                                            <h5 class="mb-0"><?php  cityKarandeniya()?> </h5>
                                                        </td>
                                                        <td>
                                                            <div class="progress bg-transparent progress-sm">
                                                                <div class="progress-bar bg-secondary rounded" role="progressbar" style="width: <?php progressBorelasgamuwa(); ?>%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            
                                
                            <br>
                               
                            </div>
                            
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <p class="text-muted font-weight-medium">Total Orders</p>
                                                        <h4 class="mb-0">
                                                        <?php
                                                        getTotalOrders();
    
                                                        ?>
                                                        </h4>
                                                    </div>

                                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                        <span class="avatar-title">
                                                            <i class="bx bx-copy-alt font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <p class="text-muted font-weight-medium">Total Products</p>
                                                        <h4 class="mb-0">
                                                            <?php
                                                                    getTotalProducts();
                                                            ?>
                                                            
                                                        </h4>
                                                    </div>

                                                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bx-archive-in font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mini-stats-wid">
                                            <div class="card-body">
                                                <div class="media">
                                                    <div class="media-body">
                                                        <p class="text-muted font-weight-medium">Total Customers</p>
                                                        <h4 class="mb-0">
                                                        <?php
                                                            getTotalCustomers();
    
                                                        ?>
                                                        </h4>
                                                    </div>

                                                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="fas fa-users font-size-24"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                 
                                        

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Catogories', 'Amount'],
       <?php
       
      getcharts();
      
     ?>
]);

  // Optional; add a title and set the width and height of the chart
var options = {'title':'Percentage Of Catogories' ,'width':'100%',  'height':500,chartArea: {width: "90%", height: "80%"}};
  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>              
                        <div class="card" >
                                    <div class="card-body">
                        <!-- start page title -->
                        <div class="row">
                        <form action="" method="post">
                         <input type="text" id="searchid" value="<?= $recordYear ?>" name="txtChartYear" style="height:35px; border-radius:5px; border-style:solid; border-color:grey;"/>
                         <input type="submit" class="btn-primary btn" value="Search" onclick="return validate()" name="btnGetRecordYear">
                            <div id="error_message"></div>
                         </form>
                         
                         </div>
                         
                     <div class='row'>   
                       <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
                                <script type="text/javascript">
                           google.charts.load('current', {'packages':['corechart']});

                           google.charts.setOnLoadCallback(drawChart);

                           function drawChart()
                           {
                            var data = google.visualization.arrayToDataTable([
                             ['Catogories', 'Sales', 'Returns'],
                             <?php
                               
                             getChartsDetailsSave($recordYear);
                             ?>
                            ]);

                            var options = {
                                                  title : <?php getChartsTitle($recordYear); ?>,
                                                  vAxis: {title: 'Sales / Returns'},
                                                  hAxis: {title: 'Month'},
                                                  seriesType: 'bars',
                                                  series: {5: {type: 'line'}}        };

                            var chart_area = document.getElementById('chartImage');

                             var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                             var chartImage = new google.visualization.ComboChart(document.getElementById('chartImage'));
                            google.visualization.events.addListener(chart, 'ready', function(){
                             chart_area.innerHTML = '<img src="' + chart.getImageURI() + '" class="img-responsive">';
                            });
                            chart.draw(data, options);
                           }

                                </script>
                                <div id='chart_div' style='width: 100%; height: 500px;'></div>
                        </div>
                               
                               
                               
                               
                                <div class="text-right">
                         <form method="post" id="make_pdf" target="_blank">
                            <input type="hidden" name="hidden_html" id="hidden_html" />
                            <input type="hidden" name="yearName" id="yearPDF" value="<?= $recordYear ?>"/>
                            <button type="button" name="create_pdf" id="create_pdf" class="btn btn-danger btn-xs">Get PDF</button>
                           </form>
                           </div>
                                 
                    </div>
                        </div> 
                        
                             </div>
                        </div>   
                              
    
                              
                               
                          
                        <!-- end row -->

                        
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">New Orders</h4>
                                        <div class="table-responsive">
                                            <table id="newOrderTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Contact No.</th>
                                        <th>City</th>
                                        <th>Payment Method</th>
                                        <th>Order Date</th>
                                        <th>Order Total</th>
                                        <th>View Order</th>
                                        <th>Order Action</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                   <?php
                                    getAllNewOrders();
    
                                    ?>
                                   
                                </tbody>
                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
               
                <!-- Modal -->
                <div class="modal fade exampleModal" id="viewOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="viewOrderBody">
                            
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                <!-- end modal -->

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
         
        <div class="modal fade bd-example-modal-xl" id="viewChartDetailsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sales and Returns</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="chartHiddenImageDivBody">
                            <div class="container"  id="chartHiddenImageDiv" >  
                               <div class="row">
                                   <div class="panel panel-default">

                                    <div class="panel-body" align="center">
                                     <div id="chartImage" style="width: 100%; max-width:900px; height: 500px; " ></div>
                                       </div>
                                   </div>
                                   </div>
                                   
                                   
                                </div>
                            <div class="text-right">
                                       <input type="button" class="btn btn-danger btn-xs" id="btnSaveImage" value="Save PDF"/>
                                   </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

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

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- apexcharts init -->
        <script src="assets/js/pages/apexcharts.init.js"></script>
        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
          <script type="text/javascript">
                function validate(){
                            var search=document.getElementById("searchid").value;
                           var error_message = document.getElementById("error_message");
           
                      error_message.style.padding = "10px";
           
                   if(isNaN(search)){
                text = "Please Check Again Year";
                   error_message.innerHTML = text;
                return false;
                 }
          else{
               return true;
           }
            
                 
                      }
        
        
        
        </script>
        
        <script>
            $(document).ready(function() {
            $('#newOrderTable').DataTable( {
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
                        title: 'Warnasiri FoodCity New Orders',
                        pageSize: 'A4',
                        exportOptions: {
                        columns: [0,1,2,3,4,5,6]

                        }
                    },
                    {
                        extend: 'excelHtml5',
                       orientation: 'portrait',
                        title: 'Warnasiri FoodCity New Orders',
                        pageSize: 'A4',
                        exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                        }
                    }
                ]
            } );
        } );
     </script>
        
        
        <script>  
     $(document).ready(function(){  
          $("#newOrderTable").on("click", ".acceptOrder", function(){  
               var order_id = $(this).attr("id");
              document.getElementById("loader").style.display = "block";
               $.ajax({  
                    url:"changeOrderStatus.php",  
                    method:"post",  
                    data:{order_id:order_id,ordStatus:'2'},  
                    success:function(data){
                        if(data == "Order has been accepted"){
                        toastr.success(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    document.getElementById("loader").style.display = "none";
                                    location.reload();
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
                                    document.getElementById("loader").style.display = "none";
                                    location.reload();
                                  }
                              }
                            ); 
                            
                            
                        }
                         
                    }  
               });  
          });  
     });  
     </script>
        
        
        <script>  
     $(document).ready(function(){  
          $("#newOrderTable").on("click", ".declineOrder", function(){  
               var order_id = $(this).attr("id");  
               $.ajax({  
                    url:"changeOrderStatus.php",  
                    method:"post",  
                    data:{order_id:order_id,ordStatus:'5'},  
                    success:function(data){
                        if(data == "Order has been declined"){
                        toastr.success(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    
                                    location.reload();
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
                                    
                                    location.reload();
                                  }
                              }
                            ); 
                            
                            
                        }
                         
                    }  
               });  
          });  
     });  
     </script>
     
   
   <script>  
     $(document).ready(function(){  
          $("#newOrderTable").on("click", ".viewOrderDetails", function(){  
               var cart_Id = $(this).attr("id");  
               $.ajax({  
                    url:"viewOrder.php",  
                    method:"post",  
                    data:{cart_Id:cart_Id},  
                    success:function(data){  
                         $('#viewOrderBody').html(data);  
                         $('#viewOrder').modal("show");  
                    }  
               });  
          });  
     });  
     </script>
       
        <script>
        $(document).ready(function(){
         $('#create_pdf').click(function(){
            
             $('#viewChartDetailsModel').modal("show");
             
             
         });
        });
        </script> 
        
        
        <script>
        $(document).ready(function(){
         $('#btnSaveImage').click(function(){
            
             html2canvas(document.getElementById("chartHiddenImageDiv")).then(function (canvas) {
               
                    var YearChart = document.getElementById("yearPDF").value;
                    //document.body.appendChild(canvas);
                    
                    // Get base64URL
                    var base64URL = canvas.toDataURL('image/jpeg').replace('image/jpeg', 'image/octet-stream');
                   
                    // AJAX request
                    $.ajax({
                        url: 'saveChartAndSend.php',
                        type: 'post',
                        data: {image: base64URL,year: YearChart},
                        success: function(data){
                            alert('PDF Succesfully Mailed');
                        }
                    });
                });
             
             
         });
        });
        </script>
        
    </body>


</html>
<?php } ?>