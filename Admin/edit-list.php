<?php
session_start();
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
 if(isset($_POST["list_id"]))  
 {
     $listBoxID = $_POST['list_id'];
     
     $checkEditBoxAvailable = "SELECT box_id,box_heading,box_text FROM `tbl_boxes` WHERE box_id ='$listBoxID'";
     $checkReuslt = mysqli_query($con,$checkEditBoxAvailable);
     $details = mysqli_fetch_array($checkReuslt);
     $boxId = $details['box_id'];
     if($boxId == null || $boxId == "")
     {
         $heading = "";
         $description = "";
     }
     else
     {
         $heading = $details['box_heading'];
         $description = $details['box_text'];
     }
            echo "
            <form method='post'>
                    <input type='text' value='$listBoxID' name='listId' hidden />
                    <div class='form-group'>
                        <label style='font-size:15px;' for='txtListTitle'>List Title</label>
                        <input id='txtListTitle' value='$heading' name='listTile' type='text' class='form-control'  maxlength ='100' required>
                    </div>
                     <div class='form-group'>
                        <label style='font-size:15px;' for='listDescription'>List Description</label>
                        <textarea class='form-control' id='listDescription' name='listDescription' rows='7' maxlength ='1000' required>$description</textarea>
                    </div>

                    <div class='modal-footer'>

                                        </div>

                     <div class='text-right'>
                         <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                    <button type='submit' name='btnEditListBox' class='btn btn-success  waves-effect waves-light'>Update List Box</button>

                    </div>
                    </form>

            ";
 }

}


?>