
<?php
session_start();
$_SESSION['atAdminPage']="advertise-details.php";
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
include("assets/functions/db.php");

if(isset($_POST['btnEnterAddOne']))
{
    $AddOne = $_FILES['AddImageUploadOne']['name'];
    $AddImgOne = $_FILES['AddImageUploadOne']['tmp_name'];
    if($AddOne == null || $AddOne == "")
    {
        echo "
        <script>
        alert('Please Select an Image for Advertise One');
        </script>
        ";
    }
    else
    {
        $checkAddOneAvailable = "SELECT ad_id FROM `tbl_advertise` WHERE ad_id = '1'";
        $alvailableResults = mysqli_query($con,$checkAddOneAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['ad_id'];
        if($result == null || $result == "")
        {
            move_uploaded_file($AddImgOne,"../img/ad/$AddOne");
            $InsertAddOneQuery = "INSERT INTO `tbl_advertise`(`ad_id`, `ad_name`, `ad_image`) VALUES ('1','Add one','$AddOne')";
            $AddOneResult = mysqli_query($con,$InsertAddOneQuery);
            if($AddOneResult == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Addvertise One');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Addvertise One - Please try again!');
                    </script>
                    ";
            }
        }
        else
        {
            move_uploaded_file($AddImgOne,"../img/slider/$AddOne");
            $updateAddOneQuery = "UPDATE `tbl_advertise` SET `ad_name`='Add one',`ad_image`='$AddOne' WHERE ad_id = '1'";
            $UpdateAddOneResults = mysqli_query($con,$updateAddOneQuery);
            if($UpdateAddOneResults == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Addvertise One');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Addvertise One - Please try again!');
                    </script>
                    ";
            }
            

        }  
    }
    
    
}
if(isset($_POST['btnEnterAddTwo']))
{
    
    $AddTwo = $_FILES['AddImageUploadTwo']['name'];
    $AddImgTwo = $_FILES['AddImageUploadTwo']['tmp_name'];
    if($AddTwo == null || $AddTwo == "")
    {
        echo "
        <script>
        alert('Please Select an Image for Advertise Two');
        </script>
        ";
    }
    else
    {
        $checkAddTwoAvailable = "SELECT ad_id FROM `tbl_advertise` WHERE ad_id = '2'";
        $alvailableResults = mysqli_query($con,$checkAddTwoAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['ad_id'];
        if($result == null || $result == "")
        {
            move_uploaded_file($AddImgTwo,"../img/ad/$AddTwo");
            $InsertAddTwoQuery = "INSERT INTO `tbl_advertise`(`ad_id`, `ad_name`, `ad_image`) VALUES ('2','Add two','$AddTwo')";
            $AddTwoResult = mysqli_query($con,$InsertAddTwoQuery);
            if($AddTwoResult == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Addvertise Two');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Addvertise Two - Please try again!');
                    </script>
                    ";
            }
        }
        else
        {
            move_uploaded_file($AddImgTwo,"../img/slider/$AddTwo");
            $updateAddTwoQuery = "UPDATE `tbl_advertise` SET `ad_name`='Add two',`ad_image`='$AddTwo' WHERE ad_id = '2'";
            $UpdateAddTwoResults = mysqli_query($con,$updateAddTwoQuery);
            if($UpdateAddTwoResults == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Addvertise Two');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Addvertise Two - Please try again!');
                    </script>
                    ";
            }
            

        }  
    }
   
    
    
}



if(isset($_POST['btnRemoveAddOne']))
{
   
        $checkAddAvailable = "SELECT ad_id FROM `tbl_advertise` WHERE ad_id = '1'";
        $alvailableResults = mysqli_query($con,$checkAddAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['ad_id'];
        if($result == null || $result == "")
        {
            echo "
                            <script>
                            alert('No Results Found For Add One');
                            </script>
                            ";
        }
        else
        {
            $deleteAddOneQuery = "DELETE from tbl_advertise WHERE ad_id = '1'";
            $deleteResult = mysqli_query($con,$deleteAddOneQuery);
            if($deleteResult == 1)
            {
                echo "
                            <script>
                            alert('Deleted Advertistment One');
                            </script>
                            ";
            }
            else
            {
                echo "
                            <script>
                            alert('Error Occured While Deleting Advertistment One - PLease Try Again');
                            </script>
                            ";
            }
        }
}

if(isset($_POST['btnRemoveAddTwo']))
{
        $checkAddAvailable = "SELECT ad_id FROM `tbl_advertise` WHERE ad_id = '2'";
        $alvailableResults = mysqli_query($con,$checkAddAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['ad_id'];
        if($result == null || $result == "")
        {
            echo "
                            <script>
                            alert('No Results Found For Add Two');
                            </script>
                            ";
        }
        else
        {
            $deleteAddOneQuery = "DELETE from tbl_advertise WHERE ad_id = '2'";
            $deleteResult = mysqli_query($con,$deleteAddOneQuery);
            if($deleteResult == 1)
            {
                echo "
                            <script>
                            alert('Deleted Advertistment Two');
                            </script>
                            ";
            }
            else
            {
                echo "
                            <script>
                            alert('Error Occured While Deleting Advertistment Two - PLease Try Again');
                            </script>
                            ";
            }
        }
}





        $getAddOneAvailable = "SELECT ad_image FROM `tbl_advertise` WHERE ad_id = '1'";
        $AddOneResults = mysqli_query($con,$getAddOneAvailable);
        $fetchAddOneResult = mysqli_fetch_assoc($AddOneResults);
        $AddOne = $fetchAddOneResult['ad_image'];
        if($AddOne == null || $AddOne == "" )
        {
            $AddOneImage = "Empty.jpg";
        }
        else
        {
            $AddOneImage = $AddOne;
        }


        $getAddTwoAvailable = "SELECT ad_image FROM `tbl_advertise` WHERE ad_id = '2'";
        $AddTwoResults = mysqli_query($con,$getAddTwoAvailable);
        $fetchAddTwoResult = mysqli_fetch_assoc($AddTwoResults);
        $AddTwo = $fetchAddTwoResult['ad_image'];
        if($AddTwo == null || $AddTwo == "" )
        {
            $AddTwoImage = "Empty.jpg";
        }
        else
        {
            $AddTwoImage = $AddTwo;
        }
    
        


?>


<html lang="en">

    

<head>
        
        <meta charset="utf-8" />
        <title>Warnasiri FoodCity | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="assets/css/styles.css" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <?php include("assets/includes/topheader.php"); ?>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
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

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Advertistments</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
                                            <li class="breadcrumb-item active">Advertistments</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                         <div class="row">
                            <div class="col-md-6 col-xl-3">
        
                                <!-- Simple card -->
                                <div class="card">
                                   <form method="post">
                                    <img id="AddOne" class="card-img-top img-fluid sliderImages" src="../img/ad/<?= $AddOneImage ?>" alt="Card image cap">
                                    <button type="submit" name="btnRemoveAddOne"  class="btn btn-danger waves-effect waves-light slideBtnCenter">Remove Advertise</button>
                                    </form>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">Home Advertistment 01</h4>
                                        <form method="post"  enctype="multipart/form-data">
                                        <label class="btn btn-primary waves-effect waves-light  slideBtnLeft">Select Advertise
                                        <input  name="AddImageUploadOne"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="previewAddOne(event)"  >
                                        </label>
                                        
                                         <button type="submit" name="btnEnterAddOne"  class="btn btn-success waves-effect waves-light slideBtnRight">Update Addvertise</button>
                                        </form>
                                    </div>
                                </div>
        
                            </div><!-- end col -->
                            
                            <div class="col-md-6 col-xl-3">
        
                                <!-- Simple card -->
                                <div class="card">
                                    <form method="post">
                                    <img id="AddTwo" class="card-img-top img-fluid sliderImages" src="../img/ad/<?= $AddTwoImage ?>" alt="Card image cap">
                                    <button type="submit" name="btnRemoveAddTwo"  class="btn btn-danger waves-effect waves-light slideBtnCenter">Remove Advertise</button>
                                    </form>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">Home Advertistment 02</h4>
                                        <form method="post" enctype="multipart/form-data">
                                        <label class="btn btn-primary waves-effect waves-light  slideBtnLeft">Select Advertise
                                        <input  name="AddImageUploadTwo"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="previewAddTwo(event)"  >
                                        </label>
                                        
                                         <button  type="submit" name="btnEnterAddTwo" class="btn btn-success waves-effect waves-light slideBtnRight">Update Addvertise</button>
                                        </form>
                                    </div>
                                </div>
        
                            </div><!-- end col -->
                            
                            
                            
                             
                             
                            
                            
                        </div>
                        
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                    
                    
                
               
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

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

        <script src="assets/js/app.js"></script>
        
        
    <script type="text/javascript">

           
         function previewAddOne(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('AddOne');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
        
        function previewAddTwo(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('AddTwo');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
        
        
      
       
       </script>
       
       

    </body>


</html>
<?php } ?>
