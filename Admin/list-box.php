<?php
session_start();
$_SESSION['atAdminPage']="list-box.php";
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


if(isset($_POST['btnEditListBox']))
{
    $listId = $_POST['listId'];
    $boxHeader = $_POST['listTile'];
    $boxDescripton = $_POST['listDescription'];
    $findListIDExitsQuery = "SELECT box_id FROM `tbl_boxes` WHERE box_id = '$listId'";
    $queryResults = mysqli_query($con,$findListIDExitsQuery);
    $details = mysqli_fetch_array($queryResults);
    $boxId = $details['box_id'];
    if($boxId == null || $boxId == "")
    {
        $InsertListBoxQuery = "INSERT INTO `tbl_boxes`(`box_id`, `box_heading`, `box_text`) VALUES ('$listId','$boxHeader','$boxDescripton')";
        $insertResult = mysqli_query($con,$InsertListBoxQuery);
        if($insertResult == 1)
        {
            echo "
            <script>
            alert('list box item Inserted successfully');
            </script>
            
            ";
        }
        else
        {
            echo "
            <script>
            alert('Error Occured while inserting list box item');
            </script>
            
            ";
        }
    }
    else
    {
        $updateListBoxQuery = "UPDATE `tbl_boxes` SET `box_heading`='$boxHeader',`box_text`='$boxDescripton' WHERE `box_id` = '$listId'";
        $updateResult = mysqli_query($con,$updateListBoxQuery);
        if($updateResult == 1)
        {
            echo "
            <script>
            alert('list box item updated successfully');
            </script>
            
            ";
        }
        else
        {
            echo "
            <script>
            alert('Error Occured while updating list box item');
            </script>
            
            ";
        }
        
    }
}

if(isset($_POST['btnRemoveBox']))
{
    $removeIndex = $_POST['removeIndex'];
    $checkRemoveBoxAvailable = "SELECT box_id FROM `tbl_boxes` WHERE box_id ='$removeIndex'";
     $checkReusltRemove = mysqli_query($con,$checkRemoveBoxAvailable);
     $removeDetailsOne = mysqli_fetch_assoc($checkReusltRemove);
     $boxIdOne = $removeDetailsOne['box_id'];
     if($boxIdOne == null || $boxIdOne == "")
     {
         echo "
            <script>
            alert('No Records Found To Delete - Please try again!');
            </script>
            
            ";
     }
    else
    {
        $deleteQuery = "DELETE from tbl_boxes WHERE `box_id` = '$removeIndex'";
        $deleteResults = mysqli_query($con,$deleteQuery);
        if($deleteResults == 1)
        {
            echo "
            <script>
            alert('Records Deleted Successfully');
            </script>
            
            ";
        }
        else
        {
            echo "
            <script>
            alert('Error Occured While Deleting Record - Please try Again!');
            </script>
            
            ";
        }
    }
    
    
}

    $checkEditBoxOneAvailable = "SELECT box_id,box_heading,box_text FROM `tbl_boxes` WHERE box_id ='1'";
     $checkReusltOne = mysqli_query($con,$checkEditBoxOneAvailable);
     $detailsOne = mysqli_fetch_array($checkReusltOne);
     $boxIdOne = $detailsOne['box_id'];
     if($boxIdOne == null || $boxIdOne == "")
     {
         $ListOneheading = "Example Heading";
         $ListOnedescription = "Example Description . . . . . . . . . . .";
     }
     else
     {
        $ListOneheading = $detailsOne['box_heading'];
         $ListOnedescription = $detailsOne['box_text'];
     }

    $checkEditBoxTwoAvailable = "SELECT box_id,box_heading,box_text FROM `tbl_boxes` WHERE box_id ='2'";
     $checkReusltTwo = mysqli_query($con,$checkEditBoxTwoAvailable);
     $detailsTwo = mysqli_fetch_array($checkReusltTwo);
     $boxIdTwo = $detailsTwo['box_id'];
     if($boxIdTwo == null || $boxIdTwo == "")
     {
         $ListTwoheading = "Example Heading";
         $ListTwodescription = "Example Description . . . . . . . . . . .";
     }
     else
     {
        $ListTwoheading = $detailsTwo['box_heading'];
         $ListTwodescription = $detailsTwo['box_text'];
     }


    $checkEditBoxThreeAvailable = "SELECT box_id,box_heading,box_text FROM `tbl_boxes` WHERE box_id ='3'";
     $checkReusltThree = mysqli_query($con,$checkEditBoxThreeAvailable);
     $detailsThree = mysqli_fetch_array($checkReusltThree);
     $boxIdThree = $detailsThree['box_id'];
     if($boxIdThree == null || $boxIdThree == "")
     {
         $ListThreeheading = "Example Heading";
         $ListThreedescription = "Example Description . . . . . . . . . . .";
     }
     else
     {
        $ListThreeheading = $detailsThree['box_heading'];
         $ListThreedescription = $detailsThree['box_text'];
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
                                    <h4 class="mb-0 font-size-18">List Boxes</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">General Settings</a></li>
                                            <li class="breadcrumb-item active">List Boxes</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        
        
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card card-body ">
                                    <h4 class="card-title mt-0"><?= $ListOneheading ?></h4>
                                    <p class="card-text listBoxItem"><?= $ListOnedescription ?></p>
                                    <form method="post">
                                        <input type="text" value="1" name="removeIndex" hidden/>
                                         <button type="submit"  name="btnRemoveBox" class="btn btn-danger waves-effect waves-light removeItemListBox">Delete Box</button>
                                     </form>
                                    <a href="#" class="btn btn-primary waves-effect waves-light listBoxBtn" id="1">Edit Box</a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-body ">
                                    <h4 class="card-title mt-0"><?= $ListTwoheading ?></h4>
                                    <p class="card-text listBoxItem"><?= $ListTwodescription ?></p>
                                      <form method="post">
                                        <input type="text" value="2" name="removeIndex" hidden/>
                                         <button type="submit"  name="btnRemoveBox" class="btn btn-danger waves-effect waves-light removeItemListBox" >Delete Box</button>
                                     </form>
                                       <a href="#" class="btn btn-primary waves-effect waves-light listBoxBtn" id="2">Edit Box</a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-body listBoxItem">
                                    <h4 class="card-title mt-0"><?= $ListThreeheading ?></h4>
                                    <p class="card-text listBoxItem"><?= $ListThreedescription ?></p>
                                     <form method="post">
                                        <input type="text" value="3" name="removeIndex" hidden/>
                                         <button type="submit" name="btnRemoveBox" class="btn btn-danger waves-effect waves-light removeItemListBox" >Delete Box</button>
                                     </form>
                                      
                                       <a href="#" class="btn btn-primary waves-effect waves-light listBoxBtn" id="3">Edit Box</a>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <div class="modal fade exampleModal" id="editDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit List Box</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="Box_details">
                               
                                                   
                                                    
                                                    
                                                    
                                                 
                            </div>
                            
                        </div>
                    </div>
                </div>

                
               
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
        
        <script>  
     $(document).ready(function(){  
          $(document).on("click", ".listBoxBtn", function(){  
               var list_id = $(this).attr("id");  
               $.ajax({  
                    url:"edit-list.php",  
                    method:"post",  
                    data:{list_id:list_id},  
                    success:function(data){  
                         $('#Box_details').html(data);  
                         $('#editDataModal').modal("show");  
                    }  
               });  
          });  
     });  
     </script>

    </body>

</html>
<?php } ?>
