
<?php
session_start();
$_SESSION['atAdminPage']="slider-details.php";
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

if(isset($_POST['btnEnterSlideOne']))
{
    $SlideOne = $_FILES['SliderImageUploadOne']['name'];
    $slideImgOne = $_FILES['SliderImageUploadOne']['tmp_name'];
    if($SlideOne == null || $SlideOne == "")
    {
        echo "
        <script>
        alert('Please Select an Image for Slide One');
        </script>
        ";
    }
    else
    {
        $checkSliderOneAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '1'";
        $alvailableResults = mysqli_query($con,$checkSliderOneAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            move_uploaded_file($slideImgOne,"../img/slider/$SlideOne");
            $InsertSliderOneQuery = "INSERT INTO `tbl_slides`(`slide_id`, `slide_name`, `slide_image`) VALUES ('1','slide one','$SlideOne')";
            $sliderOneResult = mysqli_query($con,$InsertSliderOneQuery);
            if($sliderOneResult == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider One');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide One - Please try again!');
                    </script>
                    ";
            }
        }
        else
        {
            move_uploaded_file($slideImgOne,"../img/slider/$SlideOne");
            $updateSliderOneQuery = "UPDATE `tbl_slides` SET `slide_name`='slide one',`slide_image`='$SlideOne' WHERE slide_id = '1'";
            $UpdateSlideOneResults = mysqli_query($con,$updateSliderOneQuery);
            if($UpdateSlideOneResults == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider One');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide One - Please try again!');
                    </script>
                    ";
            }
            

        }  
    }
    
    
}
if(isset($_POST['btnEnterSlideTwo']))
{
    
    $SlideTwo = $_FILES['SliderImageUploadTwo']['name'];
    $slideImgTwo = $_FILES['SliderImageUploadTwo']['tmp_name'];
    if($SlideTwo == null || $SlideTwo == "")
    {
        echo "
        <script>
        alert('Please Select an Image for Slide Two');
        </script>
        ";
    }
    else
    {
        $checkSliderTwoAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '2'";
        $alvailableResults = mysqli_query($con,$checkSliderTwoAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            move_uploaded_file($slideImgTwo,"../img/slider/$SlideTwo");
            $InsertSliderTwoQuery = "INSERT INTO `tbl_slides`(`slide_id`, `slide_name`, `slide_image`) VALUES ('2','slide two','$SlideTwo')";
            $sliderTwoResult = mysqli_query($con,$InsertSliderTwoQuery);
            if($sliderTwoResult == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider Two');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide Two - Please try again!');
                    </script>
                    ";
            }
        }
        else
        {
            move_uploaded_file($slideImgTwo,"../img/slider/$SlideTwo");
            $updateSliderTwoQuery = "UPDATE `tbl_slides` SET `slide_name`='slide two',`slide_image`='$SlideTwo' WHERE slide_id = '2'";
            $UpdateSlideTwoResults = mysqli_query($con,$updateSliderTwoQuery);
            if($UpdateSlideTwoResults == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider Two');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide Two - Please try again!');
                    </script>
                    ";
            }
            

        }  
    }
    
}
if(isset($_POST['btnEnterSlideThree']))
{
    
    
    $SlideThree = $_FILES['SliderImageUploadThree']['name'];
    $slideImgThree = $_FILES['SliderImageUploadThree']['tmp_name'];
    if($SlideThree == null || $SlideThree == "")
    {
        echo "
        <script>
        alert('Please Select an Image for Slide Three');
        </script>
        ";
    }
    else
    {
        $checkSliderThreeAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '3'";
        $alvailableResults = mysqli_query($con,$checkSliderThreeAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            move_uploaded_file($slideImgThree,"../img/slider/$SlideThree");
            $InsertSliderThreeQuery = "INSERT INTO `tbl_slides`(`slide_id`, `slide_name`, `slide_image`) VALUES ('3','slide three','$SlideThree')";
            $sliderThreeResult = mysqli_query($con,$InsertSliderThreeQuery);
            if($sliderThreeResult == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider Three');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide Three - Please try again!');
                    </script>
                    ";
            }
        }
        else
        {
            move_uploaded_file($slideImgThree,"../img/slider/$SlideThree");
            $updateSliderThreeQuery = "UPDATE `tbl_slides` SET `slide_name`='slide three',`slide_image`='$SlideThree' WHERE slide_id = '3'";
            $UpdateSlideThreeResults = mysqli_query($con,$updateSliderThreeQuery);
            if($UpdateSlideThreeResults == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider Three');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide Three - Please try again!');
                    </script>
                    ";
            }
            

        }  
    }
    
}
if(isset($_POST['btnEnterSlideFour']))
{
   
    
    
    $SlideFour = $_FILES['SliderImageUploadFour']['name'];
    $slideImgFour = $_FILES['SliderImageUploadFour']['tmp_name'];
    if($SlideFour == null || $SlideFour == "")
    {
        echo "
        <script>
        alert('Please Select an Image for Slide Four');
        </script>
        ";
    }
    else
    {
        $checkSliderFourAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '4'";
        $alvailableResults = mysqli_query($con,$checkSliderFourAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            move_uploaded_file($slideImgFour,"../img/slider/$SlideFour");
            $InsertSliderFourQuery = "INSERT INTO `tbl_slides`(`slide_id`, `slide_name`, `slide_image`) VALUES ('4','slide four','$SlideFour')";
            $sliderFourResult = mysqli_query($con,$InsertSliderFourQuery);
            if($sliderFourResult == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider Four');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide Four - Please try again!');
                    </script>
                    ";
            }
        }
        else
        {
            move_uploaded_file($slideImgFour,"../img/slider/$SlideFour");
            $updateSliderFourQuery = "UPDATE `tbl_slides` SET `slide_name`='slide four',`slide_image`='$SlideFour' WHERE slide_id = '4'";
            $UpdateSlideFourResults = mysqli_query($con,$updateSliderFourQuery);
            if($UpdateSlideFourResults == 1)
            {
                echo "
                    <script>
                    alert('Successfully Changed Slider Four');
                    </script>
                    ";
            }
            else
            {
                echo "
                    <script>
                    alert('Error Occured while changing Slide Four - Please try again!');
                    </script>
                    ";
            }
            

        }  
    }
    
    
}

if(isset($_POST['btnRemoveSlideOne']))
{
        $checkSliderAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '1'";
        $alvailableResults = mysqli_query($con,$checkSliderAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            echo "
                            <script>
                            alert('No Results Found For Slide One');
                            </script>
                            ";
        }
        else
        {
            $deleteSlideOneQuery = "DELETE from tbl_slides WHERE slide_id = '1'";
            $deleteResult = mysqli_query($con,$deleteSlideOneQuery);
            if($deleteResult == 1)
            {
                echo "
                            <script>
                            alert('Deleted Slide One');
                            </script>
                            ";
            }
            else
            {
                echo "
                            <script>
                            alert('Error Occured While Deleting Slide One - PLease Try Again');
                            </script>
                            ";
            }
        }
}

if(isset($_POST['btnRemoveSlideTwo']))
{
        $checkSliderAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '2'";
        $alvailableResults = mysqli_query($con,$checkSliderAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            echo "
                            <script>
                            alert('No Results Found For Slide Two');
                            </script>
                            ";
        }
        else
        {
            $deleteSlideTwoQuery = "DELETE from tbl_slides WHERE slide_id = '2'";
            $deleteResult = mysqli_query($con,$deleteSlideTwoQuery);
            if($deleteResult == 1)
            {
                echo "
                            <script>
                            alert('Deleted Slide Two');
                            </script>
                            ";
            }
            else
            {
                echo "
                            <script>
                            alert('Error Occured While Deleting Slide Two - PLease Try Again');
                            </script>
                            ";
            }
        }
}

if(isset($_POST['btnRemoveSlideThree']))
{
        $checkSliderAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '3'";
        $alvailableResults = mysqli_query($con,$checkSliderAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            echo "
                            <script>
                            alert('No Results Found For Slide Three');
                            </script>
                            ";
        }
        else
        {
            $deleteSlideThreeQuery = "DELETE from tbl_slides WHERE slide_id = '3'";
            $deleteResult = mysqli_query($con,$deleteSlideThreeQuery);
            if($deleteResult == 1)
            {
                echo "
                            <script>
                            alert('Deleted Slide Three');
                            </script>
                            ";
            }
            else
            {
                echo "
                            <script>
                            alert('Error Occured While Deleting Slide Three - PLease Try Again');
                            </script>
                            ";
            }
        }
}


if(isset($_POST['btnRemoveSlideFour']))
{
        $checkSliderAvailable = "SELECT slide_id FROM `tbl_slides` WHERE slide_id = '4'";
        $alvailableResults = mysqli_query($con,$checkSliderAvailable);
        $fetchResult = mysqli_fetch_assoc($alvailableResults);
        $result = $fetchResult['slide_id'];
        if($result == null || $result == "")
        {
            echo "
                            <script>
                            alert('No Results Found For Slide Four');
                            </script>
                            ";
        }
        else
        {
            $deleteSlideFourQuery = "DELETE from tbl_slides WHERE slide_id = '4'";
            $deleteResult = mysqli_query($con,$deleteSlideFourQuery);
            if($deleteResult == 1)
            {
                echo "
                            <script>
                            alert('Deleted Slide Four');
                            </script>
                            ";
            }
            else
            {
                echo "
                            <script>
                            alert('Error Occured While Deleting Slide Four - PLease Try Again');
                            </script>
                            ";
            }
        }
}

        $getSliderOneAvailable = "SELECT slide_image FROM `tbl_slides` WHERE slide_id = '1'";
        $slideOneResults = mysqli_query($con,$getSliderOneAvailable);
        $fetchSlideOneResult = mysqli_fetch_assoc($slideOneResults);
        $SlideOne = $fetchSlideOneResult['slide_image'];
        if($SlideOne == null || $SlideOne == "" )
        {
            $SlideOneImage = "Empty.jpg";
        }
        else
        {
            $SlideOneImage = $SlideOne;
        }
    
        $getSliderTwoAvailable = "SELECT slide_image FROM `tbl_slides` WHERE slide_id = '2'";
        $slideTwoResults = mysqli_query($con,$getSliderTwoAvailable);
        $fetchSlideTwoResult = mysqli_fetch_assoc($slideTwoResults);
        $SlideTwo = $fetchSlideTwoResult['slide_image'];
        if($SlideTwo == null || $SlideTwo == "" )
        {
            $SlideTwoImage = "Empty.jpg";
        }
        else
        {
            $SlideTwoImage = $SlideTwo;
        }

        $getSliderThreeAvailable = "SELECT slide_image FROM `tbl_slides` WHERE slide_id = '3'";
        $slideThreeResults = mysqli_query($con,$getSliderThreeAvailable);
        $fetchSlideThreeResult = mysqli_fetch_assoc($slideThreeResults);
        $SlideThree = $fetchSlideThreeResult['slide_image'];
        if($SlideThree == null || $SlideThree == "" )
        {
            $SlideThreeImage = "Empty.jpg";
        }
        else
        {
            $SlideThreeImage = $SlideThree;
        }

        $getSliderFourAvailable = "SELECT slide_image FROM `tbl_slides` WHERE slide_id = '4'";
        $slideFourResults = mysqli_query($con,$getSliderFourAvailable);
        $fetchSlideFourResult = mysqli_fetch_assoc($slideFourResults);
        $SlideFour = $fetchSlideFourResult['slide_image'];
        if($SlideFour == null || $SlideFour == "" )
        {
            $SlideFourImage = "Empty.jpg";
        }
        else
        {
            $SlideFourImage = $SlideFour;
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
                                    <h4 class="mb-0 font-size-18">Slider Settings</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
                                            <li class="breadcrumb-item active">Slider Settings</li>
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
                                    <img id="sliderOne" class="card-img-top img-fluid sliderImages" src="../img/slider/<?= $SlideOneImage ?>" alt="Card image cap">
                                    <button type="submit" name="btnRemoveSlideOne"  class="btn btn-danger waves-effect waves-light slideBtnCenter">Remove Slider</button>
                                    </form>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">Slider 01</h4>
                                        <form method="post"  enctype="multipart/form-data">
                                        <label class="btn btn-primary waves-effect waves-light slideBtnLeft">Select Image
                                        <input  name="SliderImageUploadOne"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="previewSlideOne(event)"  >
                                        </label>
                                        
                                         <button type="submit" name="btnEnterSlideOne"  class="btn btn-success waves-effect waves-light slideBtnRight">Update Slider</button>
                                        </form>
                                    </div>
                                </div>
        
                            </div><!-- end col -->
                            
                            <div class="col-md-6 col-xl-3">
        
                                <!-- Simple card -->
                                <div class="card">
                                    <form method="post">
                                    <img id="sliderTwo" class="card-img-top img-fluid sliderImages" src="../img/slider/<?= $SlideTwoImage ?>" alt="Card image cap">
                                    <button type="submit" name="btnRemoveSlideTwo"  class="btn btn-danger waves-effect waves-light slideBtnCenter">Remove Slider</button>
                                    </form>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">Slider 02</h4>
                                        <form method="post" enctype="multipart/form-data">
                                        <label class="btn btn-primary waves-effect waves-light slideBtnLeft">Select Image
                                        <input  name="SliderImageUploadTwo"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="previewSlideTwo(event)"  >
                                        </label>
                                        
                                         <button  type="submit" name="btnEnterSlideTwo" class="btn btn-success waves-effect waves-light slideBtnRight">Update Slider</button>
                                        </form>
                                    </div>
                                </div>
        
                            </div><!-- end col -->
                            
                            <div class="col-md-6 col-xl-3">
        
                                <!-- Simple card -->
                                <div class="card">
                                    <form method="post">
                                    <img id="sliderThree" class="card-img-top img-fluid sliderImages" src="../img/slider/<?= $SlideThreeImage ?>" alt="Card image cap">
                                    <button type="submit" name="btnRemoveSlideThree" class="btn btn-danger waves-effect waves-light slideBtnCenter">Remove Slider</button>
                                    </form>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">Slider 03</h4>
                                        <form method="post" enctype="multipart/form-data">
                                        <label class="btn btn-primary waves-effect waves-light slideBtnLeft">Select Image
                                        <input  name="SliderImageUploadThree"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="previewSlideThree(event)"  >
                                        </label>
                                        
                                         <button type="submit" name="btnEnterSlideThree"  class="btn btn-success waves-effect waves-light slideBtnRight">Update Slider</button>
                                        </form>
                                    </div>
                                </div>
        
                            </div><!-- end col -->
                            
                            <div class="col-md-6 col-xl-3">
        
                                <!-- Simple card -->
                                <div class="card">
                                   <form method="post">
                                    <img id="sliderFour" class="card-img-top img-fluid sliderImages" src="../img/slider/<?= $SlideFourImage ?>" alt="Card image cap">
                                   
                                    <button type="submit" name="btnRemoveSlideFour"  class="btn btn-danger waves-effect waves-light slideBtnCenter">Remove Slider</button>
                                    </form>
                                    <div class="card-body">
                                        <h4 class="card-title mt-0">Slider 04</h4>
                                        <form method="post" enctype="multipart/form-data">
                                        <label class="btn btn-primary waves-effect waves-light slideBtnLeft">Select Image
                                        <input  name="SliderImageUploadFour"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="previewSlideFour(event)"  >
                                        </label>
                                        
                                         <button type="submit" name="btnEnterSlideFour"  class="btn btn-success waves-effect waves-light slideBtnRight">Update Slider</button>
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

           
         function previewSlideOne(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('sliderOne');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
        
        function previewSlideTwo(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('sliderTwo');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
        
        function previewSlideThree(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('sliderThree');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
        
        function previewSlideFour(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('sliderFour');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
      
       
       </script>
       
       

    </body>


</html>
<?php } ?>
