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
   if(isset($_POST['btnregis']))
    {   
            $getMaxProductID = "SELECT MAX(CAST(SUBSTR(TRIM(sup_id),5) AS UNSIGNED)) AS supId FROM tbl_supplier WHERE sup_id RLIKE 'SUP'";
    $result = mysqli_query($con,$getMaxProductID);
    $maxDetails = mysqli_fetch_assoc($result);
    $maxsId = $maxDetails['supId'];
    if($maxsId==null || $maxsId == "")
    {
        $supplierId = 1;
        
        
    }else
    {
       $supplierId = $maxsId + 1; 
        
    }
    
        
        
        
        
        $supplierName = $_POST['fullname'];
       $supplierNic = $_POST['suppnic'];
      $supplierAddress = $_POST['suppaddress'];
     $supplierNum = $_POST['mobilnum'];
     $supplierEmail = $_POST['suppemail'];
     $supplierItem = $_POST['itemtag'];
     $companyName = $_POST['compname'];
     $companyNum = $_POST['compnum'];
    
     $companyAddress = $_POST['compadd'];
    
    
    $addsuplier="INSERT INTO `tbl_supplier`(`sup_id`, `sup_nic`, `sup_name`, `sup_address`, `sup_tele`, `sup_email`, `item_tag`, `company_name`, `company_tele`, `company_address`)VALUES ('SUP-$supplierId','$supplierNic','$supplierName','$supplierAddress','$supplierNum','$supplierEmail','$supplierItem','$companyName','$companyNum','$companyAddress')";
     $res = mysqli_query($con, $addsuplier);
    
    if($res == 1)
    {
          echo"  <script>
        alert('Supplier  Added Succesfully !!');
        </script>
        ";
    }
    else
    {
       echo"
        <script>
        alert('Supplier didnt Added Succesfully Please Try Again!!');
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

                      
                        <div class="p-2">
                                      <div id="error_message"></div>
                                    <form class="form-horizontal" method="post">
                                        
                                         <div class="form-group">
                                            <label for="userfname">Full name</label>
                                            <input type="text" class="form-control" id="Fullname" name="fullname" placeholder="Enter Full Name">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label for="usernic">NIC</label>
                                            <input type="text" class="form-control" id="nic" name="suppnic" placeholder="Enter NIC">
                                        </div>
                                        <div class="form-group">
                                            <label for="userPaddres">Supplier Personal Address</label>
                                            <input type="text" class="form-control" id="Suppaddres"  name="suppaddress"placeholder="Enter Personal Address">
                                        </div>
                                         <div class="form-group">
                                            <label for="usermobile">Phone Number</label>
                                            <input type="text" class="form-control" id="Mobilenum"  name="mobilnum"placeholder="Enter Phone Number">
                                        </div>
                                         <div class="form-group">
                                            <label for="useremail">Email</label>
                                            <input type="email" class="form-control" id="useremail" name="suppemail"  placeholder="Enter email">        
                                        </div>
                                          <div class="form-group">
                                            <label for="supplyitem">Supply Item</label>
                                            <input type="text" class="form-control" id="supplyitem" name="itemtag"   placeholder="Enter Item">        
                                        </div>
                
                                       
                                        
                                        
                                         <div class="diff" >
                                           <span> AND</span>
                                          </div>
                                         
                                         <div class="form-group">
                                            <label for="usercompany">Company Name</label>
                                            <input type="text" class="form-control" id="companyname" name="compname" placeholder="Enter Company Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="usercompanynumber">Company Contact Number</label>
                                            <input type="text" class="form-control" id="companynum"  name="compnum"placeholder="Enter Company Contact Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="usercompanyaddres">Company Address</label>
                                            <input type="text" class="form-control" id="companyaddres"  name="compadd"placeholder="Enter Company Address">
                                        </div>
                                        
                                       
                    
                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" id="btn" onclick = "return validate()"   type="submit" name="btnregis">Register</button>
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