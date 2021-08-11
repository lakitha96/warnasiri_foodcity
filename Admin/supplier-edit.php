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
  if(isset($_POST['btnAddSupplier']))
{
    $editSupID = $_POST['productName'];
    if($editSupID == null || $editSupID == "")
    {
        echo "
        <script>
        alert('Please enter a product Name to edit');
        </script>
        ";
    }
    else
    {
        $checkProExits = "SELECT * FROM `tbl_supplier` WHERE item_tag ='$editSupID'";
        $checkResult = mysqli_query($con,$checkProExits);
        $resultRow = mysqli_fetch_array($checkResult);
        $checkedProId = $resultRow['item_tag'];
        if($checkedProId == null || $checkedProId == "")
        {
            echo "
        <script>
        alert('Please enter correct product Name to edit');
        </script>
        ";
        }
        else
        {    $supplierId= $resultRow['sup_id'];
             $supplierName = $resultRow['sup_name'];
             $supplierNic= $resultRow['sup_nic'];
             $supplierAddress = $resultRow['sup_address']; 
             $supplierNumber = $resultRow['sup_tele'];
             $supplierEmail = $resultRow['sup_email']; 
             $supplierItem = $resultRow['item_tag'];
             $companyName = $resultRow['company_name'];
             $companyTele = $resultRow['company_tele'];
             $companyAddress = $resultRow['company_address'];
          
                     
         
        }
        
    }
    
   
}

if(isset($_POST['btnUpdateProduct']))
{
    $supplierItem = $_POST['txtSupplierItem'];
             $supplierName = $_POST['supplierName'];
             $supplierNic= $_POST['supplierNic'];
             $supplierAddress = $_POST['supplierAddress']; 
             $supplierNumber = $_POST['supplierNumber'];
             $supplierEmail = $_POST['supplierEmail'];
             $companyName = $_POST['companyName'];
             $companyTele = $_POST['companyTele'];
             $companyAddress = $_POST['companyAddress'];
    
    
  
 $updateQuerySupplier = "UPDATE `tbl_supplier` SET `sup_nic`= '$supplierNic',`sup_name`='$supplierName',`sup_address`=' $supplierAddress',`sup_tele`=' $supplierNumber ',`sup_email`='$supplierEmail',`company_name`='$companyName',`company_tele`=' $companyTele',`company_address`=' $companyAddress' WHERE`item_tag`='$supplierItem'";
    
    $updateResult = mysqli_query($con,$updateQuerySupplier);
    
    if($updateResult == 1)
    {
        echo "
        <script>
        alert('Product Updated Successfully');
        </script>
        ";
    }
    else
    {
        echo "
        <script>
        alert('Error Occured While Updating - Please Try Again!');
        </script>
        ";
    }

}
  

 


?>
<!DOCTYPE html>
   

   
   
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
                       <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <h1 class="card-title">Select Product to Edit Supplier Details</h1><br>
        
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="productname">Enter Suplier product</label>
                                                        <input id="productname" name="productName" value="<?php if(isset($supplierId)){ echo "$editSupID"; }else{} ?>" type="text" class="form-control" required>
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="text-right">
                                                 
                                            <button type="submit" name="btnAddSupplier" class="btn btn-success btn-lg waves-effect waves-light">Select Product</button>
                                            
                                            </div>
                                        </form>
                                        
                                      </div>
                                    
                                </div>

                                
                                <!-- end card-->
                             </div>
                        </div>

                      
                        <div class="p-2">
                                      <div id="error_message"></div>
                                    <form class="form-horizontal" method="post" >
                                        
                                        <div class="form-group">
                                            <label for="userfname">Full name</label>
                                            <input type="text" class="form-control" name="supplierName" id="Fullname" placeholder="Enter Full Name" value="<?php if(isset($supplierId)){ echo "$supplierName"; }else{} ?>">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label for="usernic">NIC</label>
                                            <input type="text" class="form-control" name="supplierNic" id="nic" placeholder="Enter NIC"  value="<?php if(isset($supplierId)){echo "$supplierNic";}else{} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="userPaddres">Supplier Personal Address</label>
                                            <input type="text" class="form-control" name="supplierAddress" id="Suppaddres" placeholder="Enter Personal Address"  value="<?php if(isset($supplierId)){ echo "$supplierAddress"; }else{} ?>">
                                        </div>
                                         <div class="form-group">
                                            <label for="usermobile">Phone Number</label>
                                            <input type="text" class="form-control" name="supplierNumber" id="Mobilenum" placeholder="Enter Phone Number"  value="<?php if(isset($supplierId)){ echo "$supplierNumber"; }else{} ?>">
                                        </div>
                                         <div class="form-group">
                                            <label for="useremail">Email</label>
                                            <input type="email" class="form-control" name="supplierEmail" id="useremail" placeholder="Enter email"  value="<?php if(isset($supplierId)){ echo "$supplierEmail"; }else{} ?>">        
                                        </div>
                                          <div class="form-group">
                                            <label for="supplyitem">Supply Item</label>
                                            <input type="text" class="form-control" name="supplierItem" id="supplyitem" placeholder="Enter Item"  value="<?php if(isset($supplierId)){ echo "$supplierItem"; }else{} ?>">        
                                        </div>
                
                                       
                                        
                                        
                                         <div class="diff" >
                                           <span> AND</span>
                                          </div>
                                         
                                         <div class="form-group">
                                            <label for="usercompany">Company Name</label>
                                            <input type="text" class="form-control" name="companyName" id="companyname" placeholder="Enter Company Name"  value="<?php if(isset($supplierId)){ echo "$companyName"; }else{} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="usercompanynumber">Company Contact Number</label>
                                            <input type="text" class="form-control" name="companyTele" id="companynum" placeholder="Enter Company Contact Number"  value="<?php if(isset($supplierId)){ echo "$companyTele"; }else{} ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="usercompanyaddres">Company Address</label>
                                            <input type="text" class="form-control" name="companyAddress" id="companyaddres" placeholder="Enter Company Address"  value="<?php if(isset($supplierId)){ echo "$companyAddress"; }else{} ?>">
                                        </div>
                                        
                                       
                    
                                        <div class="mt-4">
                                            <?php
                                                if(isset($supplierId)){
                                                
                                                ?>
                                                  <input type="text" value="<?= $supplierItem ?>" name="txtSupplierItem" hidden>
                                                 <button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light">Cancel</button>
                                                <button type="submit" name="btnUpdateProduct" onclick="return validate() "  class="btn btn-success btn-lg waves-effect waves-light">Update Supplier</button>
                                                <?php }else { ?>
                                                    <button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light" disabled>Cancel</button>
                                                    <button type="submit" name="btnUpdateProduct "  class="btn btn-success btn-lg waves-effect waves-light" disabled>Update Supplier</button>
                                                <?php } ?>
                                        </div>
                
                                       
                                    </form>
                                </div>
                        
                        
                        
                        
                   
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
              
            </div>
          

        </div>
        

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>
           <script type="text/javascript">
           
            function validate(){ 
                
                  var fullname = document.getElementById("Fullname").value;
                  var Nic = document.getElementById("nic").value;
                var phone = document.getElementById("Mobilenum").value;
               var Address = document.getElementById("Suppaddres").value;
             
                
                var email = document.getElementById("useremail").value;
                 var item = document.getElementById("supplyitem").value;
            
                 var Companame= document.getElementById("companyname").value;
                   var Companum= document.getElementById("companynum").value;
                  var Compaaddress= document.getElementById("companyaddres").value;
         
               
                var error_message = document.getElementById("error_message");
           
                  error_message.style.padding = "10px";
                    
   
                  if( fullname ==""){
                text = "Enter Your Full Name ";
                   error_message.innerHTML = text;
                return false;
                 }
                   if( fullname.length>50){
                text = "Please  Check Full Name Again..! ";
                   error_message.innerHTML = text;
                return false;
                 } 
                 
                 if(!isNaN( fullname) ){
                text = "  Please  Check Full Name Again..!";
                   error_message.innerHTML = text;
                return false;
                 }
                  if( Nic ==""){
                text = "Enter Supplier NIC Number";
                   error_message.innerHTML = text;
                return false;
                }
                     if(( Nic.length != 10)&&(Nic.length !=12)){
                text = "Please Check Supplier NIC Number Correctly ";
                   error_message.innerHTML = text;
                return false;
            }
                
                if(Address == ""){
                text = "Please Enter Supplier Address";
                   error_message.innerHTML = text;
                return false;
            }
                if(Address.length>100){
                text = "Please Check Supplier Address Again";
                   error_message.innerHTML = text;
                return false;
            }
                
                 if( phone ==""){
                text = "Enter Your Phone Number ";
                   error_message.innerHTML = text;
                return false;
                 }
                   
                if(isNaN(phone)    ){
                text = "   Numbers Only Allow For Phone Number";
                   error_message.innerHTML = text;
                return false;
                 }
                if( phone.length !=11){
                text = " Please Cheak Again Phone Number Correctly";
                   error_message.innerHTML = text;
                return false;
                 }
              
            
               if(email.indexOf("@") == -1 ||email.length < 6){
                   text = "Please Enter valid Email";
                  error_message.innerHTML = text;
                      
                 return false;
                 }
                
               
              if((email.charAt(email.length-4)!='.')&& (email.charAt(email.length-3)!='.'))
              {
                  text = ". Invalid Position";
                  error_message.innerHTML = text;
                  return false;
             
              } 
                if(email.length>50){
                   text = "Please Check Again Email";
                  error_message.innerHTML = text;
                      
                 return false;
                 }
                
                  if( item ==""){
                text = "Enter Supply Item Name ";
                   error_message.innerHTML = text;
                return false;
                 }
                if( item.length>50){
                text = "Please Enter Supply Item Name Between 1-50 ";
                   error_message.innerHTML = text;
                return false;
                 }
                 
                if(  Companame==""){
                text = "Enter Supplier Company Name";
                   error_message.innerHTML = text;
                return false;
                 }
                   
                 if(  Companame.length>20){
                text = "Please Enter Supply Company Name Between 1-20";
                   error_message.innerHTML = text;
                return false;
                 }
                 
                 if(!isNaN( Companame) ){
                text = "   Numbers Are Not Allowed For Company Name";
                   error_message.innerHTML = text;
                return false;
                 }
                if(Companum ==""){
                text = "Enter Company Phone Number ";
                   error_message.innerHTML = text;
                return false;
                 }
                   
                if(isNaN(Companum)    ){
                text = "   Numbers Only Allow For Company PhoneNumber";
                   error_message.innerHTML = text;
                return false;
                 }
                if( Companum.length !=11){
                text = " Please Cheak Again Phone Number Correctly";
                   error_message.innerHTML = text;
                return false;
                 }
              
            
                
                
                if(  Compaaddress==""){
                text = "Enter Supplier Company Address";
                   error_message.innerHTML = text;
                return false;
                 }
                
                 if(  Compaaddress.length>100){
                text = "Enter Supplier Company Address Between 1-100";
                   error_message.innerHTML = text;
                return false;
                 }
               else{ 
                  return true;
                    
                    
                }
                
               
                 
            }
            
            
      
       </script>
         
        
         
        

    </body>


</html>
<?php } ?>