<?php
session_start();
$_SESSION['atAdminPage']="add-catogory.php";
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

$txtCatName= "";

if(isset($_POST['btnAddCatogory']))
{
    $catName = $_POST['catogoryName'];
    $cattImage = $_FILES['catogoryImageUpload']['name'];
    $catImgName = $_FILES['catogoryImageUpload']['tmp_name'];
    
    if($cattImage == null || $cattImage == "")
    {
        echo"
        <script>
        alert('PLease upload a Catogory Image');
        </script>
        ";
    }
    else
    {
        $checkCatNameExisting = "SELECT cat_id FROM `tbl_category` WHERE cat_name = '$catName'";
        $resultsChecked = mysqli_query($con,$checkCatNameExisting);
        $getData = mysqli_fetch_assoc($resultsChecked);
        $catIdChecked = $getData['cat_id'];
        if($catIdChecked == null || $catIdChecked == "")
        {
            $getMaxId = "SELECT MAX(CAST(SUBSTR(TRIM(cat_id),5) AS UNSIGNED)) AS catID FROM tbl_category WHERE cat_id RLIKE 'CAT'";
            $maxIdResults = mysqli_query($con,$getMaxId);
            $idFetchResults = mysqli_fetch_assoc($maxIdResults);
            $catMaxId = $idFetchResults['catID'];
            
            if($catMaxId == null || $catMaxId == "")
            {
                $catID = 1;
            }
            else
            {
               $catID = $catMaxId + 1; 
            }
            move_uploaded_file($catImgName,"../img/catogoryLogo/$cattImage");
            
            $insertCatogoryQuery = "INSERT INTO `tbl_category`(`cat_id`, `cat_name`, `cat_icon`) VALUES ('CAT-$catID','$catName','$cattImage')";
            $insertResults = mysqli_query($con,$insertCatogoryQuery);
            if($insertResults == 1)
            {
                echo"
                <script>
                alert('Catogory Added Successfully');
                </script>
                ";
            }
            else
            {
                echo"
                <script>
                alert('Error occured while inserting catogory - Please try Again!');
                </script>
                ";
            }
        }
        else
        {
            echo"
            <script>
            alert('Catogory name already existing - PLease try with new catogory name');
            </script>
            ";
        }
    }
}

?>
<html lang="en">

    

<head>
        
        <meta charset="utf-8" />
        <title>දයා Stores | Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
           <link href="assets/css/styles.css" rel="stylesheet" type="text/css" /> 
        <!-- select2 css -->
        <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

        <!-- dropzone css -->
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/dropzone/min/dropify.min.css" rel="stylesheet" type="text/css" />


        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

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

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Add Catogory</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Catogories</a></li>
                                            <li class="breadcrumb-item active">Add Catogory</li>
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
                                       
                                        <h1 class="card-title">Add Catogory Details</h1><br>
                                         <div id="error_message"></div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="catogoryname">Catogory Name</label>
                                                        <input id="catogoryname" name="catogoryName" type="text" class="form-control txtCatogoryName" >
                                                    </div> 
                                                    
                                                    
                                                </div> 
                                                   
                                            </div>
                                            <label style="font-size:15px;" for="manufacturername">Catogory Image</label><br>
                                                    <!-- Simple card -->
                                                    <div class="card addImage">
                                                       
                                                        <img id="imgCatogory" class="card-img-top img-fluid productImageAdd" src="../img/catogoryLogo/Empty.jpg" alt="Card image cap">
                                                        <div class="card-body">
                                                            <label class="btn btn-primary waves-effect waves-light">Select Image
                                                            <input  name="catogoryImageUpload"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="preview(event)"  >
                                                            
                                                            </label>
                                                           <!-- <a href="#" class="btn btn-primary waves-effect waves-light">Select Image</a>-->
                                                        </div>
                                                    </div>
                                            
                                           
                                                    
                                                    

                                                

                                            
                                            <div class="text-right">
                                                 <button type="button" class="btn btn-secondary btn-lg waves-effect waves-light">Cancel</button>
                                            <button type="submit" name="btnAddCatogory"  onclick="return validate()" class="btn btn-success btn-lg waves-effect waves-light">Add Catogory</button>
                                            
                                            </div>
                                        </form>
                                        
                                            
                                            
                                            
                                            
                                    </div>
                                    
                                </div>

                                
                                <!-- end card-->
        
                                
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <!-- select 2 plugin -->
        <script src="assets/libs/select2/js/select2.min.js"></script>

        <!-- dropzone plugin -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>
        
         <script src="assets/libs/dropzone/min/dropify.min.js"></script>

    <!-- Init js-->
    <script src="assets/libs/dropzone/min/fileuploads-demo.js"></script>

        <!-- init js -->
        <script src="assets/js/pages/ecommerce-select2.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
        <script type="text/javascript">
                                 
           
         function preview(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('imgCatogory');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
      
       
       </script>
       
       
          <script type="text/javascript">
           
            function validate(){
                
            var cname=document.getElementById("catogoryname").value;
                      var error_message = document.getElementById("error_message");
                error_message.style.padding = "10px";  
                
                 if(cname == ""){
                text = "Please  Enter Your Catogory Name";
                   error_message.innerHTML = text;
                return false;
                 }
        
         if(cname.length>=30){
                text = "Please  Enter Your Catogory Name Between 1-30"";
                   error_message.innerHTML = text;
                return false;
                 }
                
                 if(!isNaN (cname)){
                text = "Numbers Only Not Allow For Catogory Name ";
                   error_message.innerHTML = text;
                return false;
                 }
                
            }
                 </script>
       

    </body>


</html>
<?php } ?>