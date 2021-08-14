<?php
session_start();
$_SESSION['atAdminPage']="add-product.php";
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
if(isset($_POST['btnAddProduct']))
{
    
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    if(isset($_POST['proDisStatus']))
    {
        if($_POST['proDisStatus'] == "" || $_POST['proDisStatus']==null)
        {
            $productDiscountStatus = "0";
            $productDiscountPercentage = "0";
       
        }
        else
        {
            $productDiscountStatus = "1";
            $productDiscountPercentage = $_POST['proDiscountPercentage'];
        
        }
    }
    else
    {
        $productDiscountStatus = "0";
        $productDiscountPercentage = "0";
        
    }
    
    if(isset($_POST['proAvailStatus']))
    {
       
        if($_POST['proAvailStatus'] == "" || $_POST['proAvailStatus']==null)
        {
             $productAvailability = "0";
        }
        else
        {
             $productAvailability = "1";
        }
    }
    else
    {
        $productAvailability = "0";
    }
    
    $productCatogory = $_POST['productCatogory'];
    $productDescription = $_POST['productDescription'];
    $productTags = $_POST['productTags'];
    $proStock = $_POST['productStock'];
    
    $productImage = $_FILES['productImageUpload']['name'];
    $productImgName = $_FILES['productImageUpload']['tmp_name'];
    
    
    if($productImage==null || $productImage=="")
    {
         echo"
        <script>
        alert('Please upload a product picture');
        </script>
        ";
    } 
    else
    {
        
        move_uploaded_file($productImgName,"../img/item/$productImage");
        
            $getMaxProductID = "SELECT MAX(CAST(SUBSTR(TRIM(pro_id),3) AS UNSIGNED)) AS proId FROM tbl_product WHERE pro_id RLIKE 'P'";
    $result = mysqli_query($con,$getMaxProductID);
    $maxDetails = mysqli_fetch_assoc($result);
    $maxPId = $maxDetails['proId'];
    if($maxPId==null || $maxPId == "")
    {
        $productId = 1;
        
        
    }else
    {
       $productId = $maxPId + 1; 
        
    }
    
    
    $addProduct = "INSERT INTO `tbl_product`(`pro_id`, `pro_name`, `pro_display_price`, `pro_discount_status`, `pro_discount_amount`, `pro_available_status`, `pro_description`, `cat_id`, `pro_image`, `pro_tags`,`pro_available_stock`) VALUES ('P-$productId','$productName','$productPrice','$productDiscountStatus','$productDiscountPercentage','$productAvailability','$productDescription','$productCatogory','$productImage','$productTags','$proStock')";
    
    $res = mysqli_query($con,$addProduct);
    
    if($res == 1)
    {
          echo"  <script>
        alert('Product  Added Succesfully !!');
        </script>
        ";
    }
    else
    {
        echo"
        <script>
        alert('Product didn't Added Succesfully Please Try Again!!');
        </script>
        ";
    }
       
    }
     
    
    

    
    
}




?>
<html lang="en">

    

<head>
        
        <meta charset="utf-8" />
        <title>Warnasiri FoodCity | Admin</title>
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
                   <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"   />
   
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
                                    <h4 class="mb-0 font-size-18">Add Product</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                                            <li class="breadcrumb-item active">Add Product</li>
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
                                       
                                        <h1 class="card-title">Add Product Details</h1><br>
                                          <div id="error_message"></div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="productname">Product Name</label>
                                                        <input id="productname" name="productName" type="text" class="form-control" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="price">Price</label>
                                                        <input id="price" name="productPrice" type="text" class="form-control" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="stock">Stock</label>
                                                        <input id="stock" name="productStock" type="text" class="form-control" >
                                                    </div>
                                                    <div class="form-group">
                                                       <div class="row">
                                                       
                                                       <div class="col-md-5">
                                                       
                                                          <label style="font-size:15px;" for="switchDiscountStatus">Discount Status</label><br>
                                                        <input type="checkbox"  id="switchDiscountStatus" switch="bool" name="proDisStatus"/>
                                                        <label    for="switchDiscountStatus" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                            
                                                         
                                                           </div>
                                                           
                                                           <div class="col-md-5">
                                                       <label style="font-size:15px;" for="switchAvailable">Availibility Status</label><br>
                                                        <input type="checkbox" name="proAvailStatus" id="switchAvailable" switch="bool" checked/>
                                                        <label for="switchAvailable" data-on-label="Yes"
                                                            data-off-label="No"></label>
                                                           </div>
                                                        
                                                            
                                                            
                                                            
                                                        </div>    
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="discountPercentage">Discount Percentage</label>
                                                        <input id="discountPercentage" name="proDiscountPercentage" type="text" class="form-control" >
                                                    </div>
                                                    
                                                    
                                                    
                                                </div>
        
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" class="control-label">Category</label>
                                                        <select name="productCatogory" class="form-control" id="categoryid">
                                                            <option value="">Select</option>
                                                           <?php
                                                                getAllCatogories();
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="productTags">Product Tags</label>
                                                        <input id="productTags" name="productTags" type="text" class="form-control" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label style="font-size:15px;" for="productDescription">Product Description</label>
                                                        <textarea class="form-control" id="productDescription" name="productDescription" rows="7" ></textarea>
                                                    </div>
                                                    
                                                </div>
                                                 
                                             
                                                
                                            </div>
                                            
                                            
                                           
                                                    <label style="font-size:15px;" for="manufacturername">Product Image</label><br>
                                                    <!-- Simple card -->
                                                    <div class="card addImage">
                                                       
                                                        <img id="img" class="card-img-top img-fluid productImageAdd" src="../img/item/Empty.jpg" alt="Card image cap">
                                                        <div class="card-body">
                                                            <label class="btn btn-primary waves-effect waves-light">Select Image
                                                            <input  name="productImageUpload"  type="file" id="file" style="display: none" accept="image/gif,image/jpeg,image/jpg,image/png" multiple="" data-original-title="upload photos"   onchange="preview(event)"  >
                                                            
                                                            </label>
                                                           <!-- <a href="#" class="btn btn-primary waves-effect waves-light">Select Image</a>-->
                                                        </div>
                                                    </div>
                                                    

                                                

                                            
                                            <div class="text-right">
                                                 <button type="submit" class="btn btn-secondary btn-lg waves-effect waves-light">Cancel</button>
                                            <button type="submit" name="btnAddProduct" id="btnadad"  onclick="return validate()" class="btn btn-success btn-lg waves-effect waves-light">Add Product</button>
                                            
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
        
        
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        
        
        
        
        <script type="text/javascript">
                                 
           
         function preview(event)
           {
               
               var input =  event.target.files[0];
              var reader=new FileReader();
               
               reader.onload = function()
               {
                   var result=reader.result;
                   var img=document.getElementById('img');
                   img.src=result;
               }
                reader.readAsDataURL(input);
           }
      
       
       </script>

   
     <script type="text/javascript">
           
            function validate(){
                
            var pname=document.getElementById("productname").value;
               
                   var Price=document.getElementById("price").value;

                
                 var Caid = document.getElementById("categoryid");
                
                var User = Caid.options[Caid.selectedIndex].value;
                
                  var stockCount = document.getElementById("stock").value;
                 var Tags=document.getElementById("productTags").value;
                var disStatus=document.getElementById("switchDiscountStatus").checked;
                var avaiStatus = document.getElementById("switchAvailable").checked;
                var drisrate=document.getElementById("discountPercentage").value;
                   
                var discrip=document.getElementById("productDescription").value;
         
                
                        var error_message = document.getElementById("error_message");
                error_message.style.padding = "10px";  
                
                
         if(pname == ""){
                text = "Please  Enter Your Product Name";
                   error_message.innerHTML = text;
                return false;
                 }
        
         if(pname.length>20){
                text = "Prodcut Name Too Long ..! Please Maintain Between 20";
                   error_message.innerHTML = text;
                return false;
                 }
                     
               
            if(User == 0){
                text = "Please Selecet Category";
                   error_message.innerHTML = text;
                return false;
            } 
                 if( Price == ""){
                text = "Please  Enter Price";
                   error_message.innerHTML = text;
                return false;
                 }
                 if( Price == "0"){
                text = " Price  value cant be Zero";
                   error_message.innerHTML = text;
                return false;
                 }
                 if( Price<=-1){
                text = "Please Check Again Price  Value  ";
                   error_message.innerHTML = text;
                return false;
                 }
                
                     if( Price.length>110){
                text = "Please Check Again Price  Value ";
                   error_message.innerHTML = text;
                return false;
                 }
                
                 if(isNaN( Price)    ){
                text = "   Numbers Only Allow For Price";
                   error_message.innerHTML = text;
                return false;
                 }      
                 
                   if(Tags == ""){
                text = "Please  Enter Your Products Tags";
                   error_message.innerHTML = text;
                return false;
                 }
                 if(Tags.length>=100){
                text = "Proddcut Tags Too Long ..! Please Maintain Between 100";
                   error_message.innerHTML = text;
                return false;
                 }
                
                 
                
                
                 if(discrip == ""){
                text = "Please  Enter Your Product Discription";
                   error_message.innerHTML = text;
                return false;
                 }
                
                if(discrip.length>=600){
                text = "Product Discription Too Long..! Please Maintain Between 600";
                   error_message.innerHTML = text;
                return false;
                 }
                
                if(disStatus==true)
                    {    if(drisrate=="")
                        {
                             text = " Please Enter Discount Percentage";
                   error_message.innerHTML = text;
                return false;
                            
                            
                        }
                        
                        
                        
                        
                        
                         if(  isNaN( drisrate) )
                    {
                               text = " Numbers Only Allow For Discount Percentage";
                   error_message.innerHTML = text;
                return false;
                        
                        
                        
                    }
                     
                     
                     if( drisrate == "0"){
                text = "  Discount Percentage Cant Be Zero";
                   error_message.innerHTML = text;
                return false;
                 }
                 if( drisrate >100){
                text = "  Discount Percentage Cant Be Over 100%";
                   error_message.innerHTML = text;
                return false;
                 } 
                      if( drisrate =="100"){
                text = "  Discount Percentage Cant Be 100%";
                   error_message.innerHTML = text;
                return false;
                 }     
                 if( drisrate<=-1){
                text = "Please Check Again Discount Percentage  ";
                   error_message.innerHTML = text;
                return false;
                 }
                
               
                        
                    }
                
                   if(disStatus==false)
                       {
                           if(drisrate.length>0)
                               {
                                   
                                   text = " Please Check Again Discount Status";
                   error_message.innerHTML = text;
                return false;
                                   
                               }
                           
                           
                           
                           
                           
                       }
                if(avaiStatus==true)
                    {
                        if(stockCount==0)
                            {
                                text = " Please re - check Again availability status and stock amount";
                   error_message.innerHTML = text;
                return false;
                            }
                    }
                if(stockCount == null || stockCount == "")
                    {
                         text = " Please enter the available stock quantity";
                   error_message.innerHTML = text;
                return false;
                    }
                if(isNaN(stockCount))
                    {
                        text = " Please enter only numbers for stock count";
                   error_message.innerHTML = text;
                return false;
                    }
               
              if( stockCount<=-1){
                text = "Please Check Again Product Stock  ";
                   error_message.innerHTML = text;
                return false;
                 }
                   if( stockCount.length>10){
                text = "Please Check Again Product Stock Correctly  ";
                   error_message.innerHTML = text;
                return false;
                 }
                
             
                
                
             
            }
           </script>
   
   
    </body>


</html>
<?php } ?>