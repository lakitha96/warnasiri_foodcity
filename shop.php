<?php
session_start();

include("assets/functions.php");
include("assets/db.php");

if(isset($_SESSION['customerId']))
{
    $cusId = $_SESSION['customerId'];
}

$no=1;
if(@$_GET['searchfield']==true)
{
    $_SESSION['atPage']="shop.php";
    $no=1;
    $search_name=$_GET['searchfield'];
    
    
    if($search_name=="")
    {
       $no=1;
        header("location:shop.php"); 
    }
    else
    {
        $no=2;
        $query = "SELECT * FROM `tbl_product` WHERE pro_tags LIKE '%$search_name%'";
        
        
    }
    
    
    $show="false";
    
}
else if(@$_GET['product_catogory']==true)
{   
    $search_catogory=$_GET['product_catogory'];
    $_SESSION['atPage']="shop.php?product_catogory=$search_catogory";
    
    $getcatId = "SELECT `cat_id` FROM `tbl_category` WHERE cat_name = '$search_catogory'";
    $catIdResults = mysqli_query($con,$getcatId);
    $catRes = mysqli_fetch_assoc($catIdResults);
    $catId = $catRes['cat_id'];
    
    $query = "SELECT * FROM `tbl_product` WHERE cat_id='$catId'";
    $show="false";
}
else if(@$_GET['customview']==true){
    $queryPart = $_GET['customview'];
    $CustomHeader = $_GET['custom_header'];
     $_SESSION['atPage']="shop.php?customview=$queryPart & custom_header=$CustomHeader";
    $query = "SELECT * FROM `tbl_product` WHERE $queryPart";
    $show="false";
}
else if(@$_GET['page_no']==false and @$_GET['catogoryfilter']==false and @$_GET['pricefilter']==false){
    $_SESSION['atPage']="shop.php";
    $query = "SELECT * FROM `tbl_product`";
    $show="true";
}

else if(@$_GET['catogoryfilter']==true || @$_GET['pricefilter']==true )
{
    
    //filterenable
    $expandPrice="";
    $catogory_string="";
    $price_string="";
    $StringVal ="";
    $stringPrice = "";
   
    $catData="";
    $priceData = "";
    if(!empty($_GET['catogoryfilter']))
    { 
        foreach($_GET["catogoryfilter"] as $cat)
        {
            
          $catData = base64_decode($cat);
            if($StringVal=="")
            {
               $StringVal = "'$catData'";
                $catogory_string="$catData";
            }
            else
            {
                $StringVal = "$StringVal, '$catData'";
                $catogory_string="$catogory_string $catData";
            }
           
           
        }
    }
    if(!empty($_GET['pricefilter']))
    {
        foreach($_GET["pricefilter"] as $priceBetween)
        {
           
            $priceData = base64_decode($priceBetween);
            if($stringPrice=="")
            {
               $stringPrice = "$priceData";
                $price_string ="$priceData";
            }
            else
            {
                $stringPrice = "$stringPrice or $priceData";
                $price_string ="$price_string $priceData";
            }
            $expandPrice=1;
        }
    }
    
    if($StringVal=="" && $stringPrice=="")
    {
        $_SESSION['atPage']="shop.php";
         $query = "SELECT * FROM `tbl_product`";
    }
    else if($StringVal!="" && $stringPrice=="")
    {
        
        $_SESSION['atPage']="shop.php";
        $query = "SELECT * FROM `tbl_product` where pro_id LIKE 'P%' and `cat_id` IN ($StringVal)";
    }
    else if($StringVal=="" && $stringPrice!="")
    {
        $_SESSION['atPage']="shop.php";
        $query = "SELECT * FROM `tbl_product` WHERE $stringPrice";
    }
    else if($StringVal!="" && $stringPrice!="")
    {
        $_SESSION['atPage']="shop.php";
        $query = "SELECT * FROM `tbl_product` where pro_id LIKE 'P%' and `cat_id` IN ($StringVal) and $stringPrice";
    }
   
}


if (isset($_GET['page_no']) and $_GET['page_no']!="" )
{
    
     if(@$_GET['view']==true)
     {
        
       $view = urldecode(base64_decode($_GET['view']));
      // $view = $_GET['view'];
      // $viewMethod = $_GET['viewmethod'];
      $viewMethod = urldecode(base64_decode($_GET['viewmethod']));
         
         
     }
    
   $page_no = urldecode(base64_decode($_GET['page_no']));
	//$page_no = $_GET['page_no'];
    //$query = $_GET['page_query'];
    $query = urldecode(base64_decode($_GET['page_query']));
} 
else 
{
    
    $page_no = 1;
}

    


   

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <title>Warnasiri FoodCity</title>
      <!-- Favicon Icon -->
      <link rel="icon" type="image/png" href="img/WarnasiriLogo.png">
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Material Design Icons -->
      <link href="vendor/icons/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
      <!-- Select2 CSS -->
      <link href="vendor/select2/css/select2-bootstrap.css" />
      <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="css/style.css" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="vendor/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="vendor/owl-carousel/owl.theme.css">
      <link href=" https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
   </head>
   <body>
    
     <div class="navbar-top bg-success pt-2 pb-2">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12 text-center">
                  <a href="shop.php" class="mb-0 text-white">
                  Free delivery for orders above <strong><span class="text-light">LKR 5000</span></strong> in Galle area. <br>
                Delivery service operates only in and around <strong><span>Galle area.</span></strong>
                  </a>
               </div>
            </div>
         </div>
      </div>
      <nav class="navbar navbar-light navbar-expand-lg bg-dark bg-faded daya-menu">
         <div class="container-fluid">
            <a class="navbar-brand" href="index.php"> <img src="img/WarnasiriIconLogo.jpeg"> </a>
			<a class="location-top" href="#"><i class="mdi mdi-map-marker-circle" aria-hidden="true"></i> Sri Lanka</a>
            <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse" id="navbarNavDropdown">
               <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                  <div class="top-categories-search">
                     <form class="input-group" method="get" action="shop.php">
                        <span class="input-group-btn categories-dropdown">
                           <select class="form-control-select">
                              <option selected="selected">All Catogories</option>
                              
                           </select>
                        </span>
                        <input class="form-control" name="searchfield" placeholder="Search products.." aria-label="Search products" type="text" value="<?php if($no==1){echo ""; } else if($no==2){ echo "$search_name";} ?>">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit" > Search</button>
                        </span>
                     </form>
                  </div>
               </div>
               <div class="my-2 my-lg-0">
                  <ul class="list-inline main-nav-right">
                    
                    <?php
                      if(isset($_SESSION['cusEmailaddress']))
                      {
                          echo "
                         <li class='list-inline-item log-btn'>
                        <a href='my-profile.php'  class='btn btn-link'><i class='mdi mdi-account-circle' style='font-size: 23px;'></i> My Account</a>
                     </li>
                         
                         ";
                      }
                      else
                      {
                         echo "
                         <li class='list-inline-item log-btn'>
                        <a href='login.php'  class='btn btn-link'><i class='mdi mdi-account-circle' style='font-size: 23px;'></i> Login</a>
                     </li>
                         
                         "; 
                      }
                      ?>
                     
                     <li id="cartArea" class="list-inline-item cart-btn">
                       <?php
                         
                         
                       if(isset($_SESSION['cusEmailaddress']))
                       {
                           
                           $cartCountQuery = "SELECT COUNT(*)AS cartCount FROM `tbl_cart` WHERE cus_id = '$cusId' and status='0'";
                           $countResults = mysqli_query($con,$cartCountQuery);
                           $resultRow = mysqli_fetch_assoc($countResults);
                           $cartCount = $resultRow['cartCount'];
                           
                           echo "
                                 <a href='cart.php' data-toggle='offcanvas' class='btn btn-link border-none'><i class='mdi mdi-cart'></i> My Cart <small class='cart-value'>$cartCount</small></a>
                                 ";
                           
                       }
                        else if(!isset($_SESSION['cusEmailaddress']))
                       {
                             if(!empty($_SESSION["shopping_cart"])) {
                                 $cart_count = count(array_keys($_SESSION["shopping_cart"]));  
                                 echo "
                                 <a href='cart.php' data-toggle='offcanvas' class='btn btn-link border-none'><i class='mdi mdi-cart'></i> My Cart <small class='cart-value'>$cart_count</small></a>
                                 ";
                                 
                             }
                            else
                            {
                                echo "
                                 <a href='cart.php' data-toggle='offcanvas' class='btn btn-link border-none'><i class='mdi mdi-cart'></i> My Cart <small class='cart-value'>0</small></a>
                                 ";
                            }
                       }
                       
                       ?>
                       
                        
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </nav>
      <nav class="navbar navbar-expand-lg navbar-light daya-menu-2 pad-none-mobile">
         <?php include("assets/mainMenu.php"); ?> 
      </nav>
	  <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="index.php"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="shop.php">Shop</a>
                  <?php
                        if(@$_GET['product_catogory']==true)
                        {
                            
                            echo "
                                <span class='mdi mdi-chevron-right'></span> <a href='shop.php'>$search_catogory</a>
                            ";
                        }
                   ?>
               </div>
            </div>
         </div>
      </section>
      <section class="shop-list section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
				   <div class="shop-filters">
					  <div id="accordion">
					  <form action="shop.php" method="get">
						 <div class="card">
							<div class="card-header" id="headingOne">
							   <h5 class="mb-0">
								  <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								  Catogory <span class="mdi mdi-chevron-down float-right"></span>
								  </button>
							   </h5>
							</div>
							<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							   <div class="card-body card-shop-filters">
								  
								  <?php
                                   if(@$_GET['catogoryfilter']==true)
                                   {
                                       if($catogory_string!="")
                                       {
                                           getAllFilterCatogories($catogory_string); 
                                       }
                                       else
                                        {
                                            $catogory_string = "nothing";
                                       getAllFilterCatogories($catogory_string);
                                       }
                                      
                                   }
                                   else
                                   {
                                       $catogory_string = "nothing";
                                       getAllFilterCatogories($catogory_string);
                                   }
                                   
                                   ?>
                                   
                                   
							   </div>
							</div>
						 </div>
						 <div class="card">
							<div class="card-header" id="headingTwo">
							   <h5 class="mb-0">
								  <button type="button"  class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
								  Price <span class="mdi mdi-chevron-down float-right"></span>
								  </button>
							   </h5>
							</div>
							
							<div id="collapseTwo"  class=<?php if(@$_GET['pricefilter']==true){ if($expandPrice==1){ echo "'collapse show'"; }else{ echo "'collapse'"; } } else{ echo "'collapse'";  }?> aria-labelledby="headingTwo" data-parent="#accordion">
							   <div class="card-body card-shop-filters">
							   <?php 
                                    if(@$_GET['pricefilter']==true)
                                    {
                                        
                                        if($price_string!="")
                                       {
                                           
                                       }
                                        else
                                        {
                                            $price_string="nothing";
                                        }
                                    }
                                   else
                                   {
                                       $price_string="nothing";
                                   }
                                   
                                   ?>
							   
							 
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" name="pricefilter[]" value="<?= base64_encode('pro_display_price BETWEEN 10 and 100') ?>" id="1"   <?php if(strpos($price_string, "pro_display_price BETWEEN 10 and 100") !== false){echo "checked";}else{} ?>>
									 <label class="custom-control-label" for="1" >LKR 10 to LKR 100 </label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" name="pricefilter[]" value="<?= base64_encode('pro_display_price BETWEEN 100 and 500') ?>" id="2"   <?php if(strpos($price_string, "pro_display_price BETWEEN 100 and 500") !== false){echo "checked";}else{} ?>>
									 <label class="custom-control-label" for="2">LKR 100 to LKR 500</label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" name="pricefilter[]" value="<?= base64_encode('pro_display_price BETWEEN 500 and 1000') ?>" id="3" <?php if(strpos($price_string, "pro_display_price BETWEEN 500 and 1000") !== false){echo "checked";}else{} ?>>
									 <label class="custom-control-label" for="3">LKR 500 to LKR 1000</label>
								  </div>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" name="pricefilter[]" value="<?= base64_encode('pro_display_price BETWEEN 1000 and 5000') ?>" id="4" <?php if(strpos($price_string, "pro_display_price BETWEEN 1000 and 5000") !== false){echo "checked";}else{} ?>>
									 <label class="custom-control-label" for="4">LKR 1000 to LKR 5000</label>
								  </div>
								  <?php
                                   
                                   $getmaxprice = "SELECT MAX(pro_display_price) AS maxPrice FROM tbl_product";
                                   $res_maxPrice = mysqli_query($db,$getmaxprice);
                                   $result = mysqli_fetch_array($res_maxPrice);
                                   $Price = $result['maxPrice'];
                                   $maxPrice = $Price + 5000;
                                   $filterStringPrice = "pro_display_price BETWEEN 5000 and $maxPrice";
                                   ?>
								  <div class="custom-control custom-checkbox">
									 <input type="checkbox" class="custom-control-input" name="pricefilter[]" value="<?= base64_encode($filterStringPrice) ?>" id="5" <?php if(strpos($price_string, "pro_display_price BETWEEN 5000 and $maxPrice") !== false){echo "checked";}else{} ?>>
									 <label class="custom-control-label" for="5">LKR 5000 or More</label>
								  </div>
							   </div>
							</div>
						 </div>
						 
						 
						 <button style="width:100%; height:50px; margin-top:5px; margin-bottom:10px;" class="btn btn-secondary" type="submit" > Filter</button>
						 </form>
					  </div>
				   </div>
				   
				</div>
              
               <div class="col-md-9">
                  
                  <div class="shop-head">
                     
                     <?php
                      if(@$_GET['product_catogory']==true)
                      {
                            
                      }
                      else if(@$_GET['searchfield']==true)
                      {
                           
                      }
                      else if(@$_GET['customview']==true)
                      {
                          if($CustomHeader=="Price (Low to High)" || $CustomHeader=="Price (High to Low)" || $CustomHeader=="Discount (High to Low)" || $CustomHeader=="Name (A to Z)") 
                          {
                               echo "
                          <div class='btn-group float-right mt-2'>
                            <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </button>
                            <div class='dropdown-menu dropdown-menu-right'>



                                    <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price ASC & custom_header=Price (Low to High)'>Price (Low to High)</a>
                                   <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price DESC & custom_header=Price (High to Low)'>Price (High to Low)</a>
                                   <a class='dropdown-item' href='shop.php?customview=pro_discount_status=1 order by pro_discount_amount DESC & custom_header=Discount (High to Low)'>Discount (High to Low)</a>
                                   <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER BY pro_name ASC & custom_header=Name (A to Z)'>Name (A to Z)</a>



                            </div>
                         </div>
                      
                      
                      "; 
                          }
                          else{
                             
                          }
                            
                           
                      }
                      
                      else if(@$_GET['view']==true)
                      {
                            if($viewMethod == "<h5 class='mb-3'>All Catogories<strong></strong></h5><br>")
                            {
                                {
                               echo "
                      <div class='btn-group float-right mt-2'>
                        <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                        <div class='dropdown-menu dropdown-menu-right'>
                           
                           
                                
                                <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price ASC & custom_header=Price (Low to High)'>Price (Low to High)</a>
                               <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price DESC & custom_header=Price (High to Low)'>Price (High to Low)</a>
                               <a class='dropdown-item' href='shop.php?customview=pro_discount_status=1 order by pro_discount_amount DESC & custom_header=Discount (High to Low)'>Discount (High to Low)</a>
                               <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER BY pro_name ASC & custom_header=Name (A to Z)'>Name (A to Z)</a>
                              
                           
                           
                        </div>
                     </div>
                      
                      
                      "; 
                          }
                          }
                          else
                          {
                              
                          }
                      }
                      
                      else if(@$_GET['catogoryfilter']==true || @$_GET['pricefilter']==true)
                      {
                          if($StringVal == "" && $stringPrice=="")
                          {
                               echo "
                          <div class='btn-group float-right mt-2'>
                            <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </button>
                            <div class='dropdown-menu dropdown-menu-right'>



                                    <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price ASC & custom_header=Price (Low to High)'>Price (Low to High)</a>
                                   <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price DESC & custom_header=Price (High to Low)'>Price (High to Low)</a>
                                   <a class='dropdown-item' href='shop.php?customview=pro_discount_status=1 order by pro_discount_amount DESC & custom_header=Discount (High to Low)'>Discount (High to Low)</a>
                                   <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER BY pro_name ASC & custom_header=Name (A to Z)'>Name (A to Z)</a>



                            </div>
                         </div>
                      
                      
                      "; 
                          }
                          else
                          {
                              
                          }
                          
                          
                      }
                      
                      
                      else
                      {
                          echo "
                      <div class='btn-group float-right mt-2'>
                        <button type='button' class='btn btn-dark dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Sort by Products &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </button>
                        <div class='dropdown-menu dropdown-menu-right'>
                           
                           
                                
                                <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price ASC & custom_header=Price (Low to High)'>Price (Low to High)</a>
                               <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER by pro_display_price DESC & custom_header=Price (High to Low)'>Price (High to Low)</a>
                               <a class='dropdown-item' href='shop.php?customview=pro_discount_status=1 order by pro_discount_amount DESC & custom_header=Discount (High to Low)'>Discount (High to Low)</a>
                               <a class='dropdown-item' href='shop.php?customview=pro_id is NOT null ORDER BY pro_name ASC & custom_header=Name (A to Z)'>Name (A to Z)</a>
                              
                           
                           
                        </div>
                     </div>
                      
                      
                      ";
                          
                      }
                      
                      
                      
                      ?>
                     
                     
                     
                     <?php
                        if(@$_GET['product_catogory']==true)
                        {
                            
                            echo "
                                 <h5 class='mb-3'>$search_catogory</h5><br>
                            ";
                        }
                      else if(@$_GET['searchfield']==true)
                      {
                          
                              
                            echo "
                                 <h5 class='mb-3'>Search results for<strong> $search_name</strong></h5><br>
                            ";
                      }
                      else if(@$_GET['customview']==true)
                      {
                            
                            echo "
                                 <h5 class='mb-3'>$CustomHeader<strong> </strong></h5><br>
                            ";
                      }
                      else if(@$_GET['view']==true)
                      {
                            if($view=="searchfield ")
                            {
                                echo "$viewMethod";
                            }
                          else{
                              echo "$viewMethod";
                          }
                            
                            
                          
                    }
                      
                    else if(@$_GET['catogoryfilter']==true || @$_GET['pricefilter']==true)
                    {
                        if($StringVal=="" && $stringPrice=="")
                        {
                            echo "<h5 class='mb-3'>All Catogories</h5><br>";
                        }
                        else
                        {
                            echo "<h5 class='mb-3'>Filtered Products</h5><br>";
                        }
                        
                    }
                      else
                      {
                          echo "<h5 class='mb-3'>All Catogories</h5><br>";
                      }
                   ?>
                     
                     
                  </div>
                  <div class="text-center" id="response">
          <img src="img/load/loading.gif" id="loader" width="75px" style="display : none;  vertical-align: middle;">
      </div>
                  <div class="row no-gutters">
                     
                     
                     <?php
                      
                       $one = "1";
                       $two = "2";
                       $total_records_per_page = "6";
                       $offset = ((int)$page_no - (int)$one ) * (int)$total_records_per_page;
                       $previous_page = (int)$page_no - (int)$one;
                       $previous_page_prevous = (int)$page_no - (int)$two;
                       $next_page = (int)$page_no + (int)$one;
                       $next_page_next = (int)$page_no + (int)$two;
                       $adjacents = "2"; 

                       
                        
                      
                        showcatogoryproducts($query,$offset,$total_records_per_page);
                        ?>
                    
                     
                  </div>
                  
                  
                  <nav>
                    
                     <?php
                      
                          $result = mysqli_query($db,$query);
                          $no_of_record_rows = mysqli_num_rows($result);

                      
                          $total_no_of_pages = ceil($no_of_record_rows / $total_records_per_page);
                          $second_last = $total_no_of_pages - 1; // total page minus 1
                      
                      
                       if($no_of_record_rows == 0)
                       {
                           
                       }
                      else
                      {
                          
                          if (!isset($_GET['view']))
                          {
                              if(@$_GET['product_catogory']==true)
                            {
                            $view = "product_catogory";
                            $viewMethod = "<h5 class='mb-3'>$search_catogory<strong></strong></h5><br>";
                            }
                            else if(@$_GET['searchfield']==true)
                            {
                                $view = "searchfield";
                              $viewMethod = "<h5 class='mb-3'>Search results for<strong> $search_name</strong></h5><br>";
                            
                            }
                            else if(@$_GET['customview']==true)
                            {
                                $view = "customview";
                                $viewMethod = "<h5 class='mb-3'>$CustomHeader<strong></strong></h5><br>";
                            }
                              else if(@$_GET['customview']==true)
                            {
                                $view = "customview";
                                $viewMethod = "<h5 class='mb-3'>$CustomHeader<strong></strong></h5><br>";
                            }
                              else if(@$_GET['catogoryfilter']==true || @$_GET['pricefilter']==true)
                            {
                                  if($StringVal=="" && $stringPrice=="")
                                  {
                                      $view = "All Catogories";
                                $viewMethod = "<h5 class='mb-3'>All Catogories<strong></strong></h5><br>";
                                  }
                                  else
                                  {
                                      $view = "Filtered Products";
                                        $viewMethod = "<h5 class='mb-3'>Filtered Products<strong></strong></h5><br>";
                                  }
                                
                               
                            }
                          else{
                              $view = "All Catogories";
                                $viewMethod = "<h5 class='mb-3'>All Catogories<strong></strong></h5><br>";
                              
                          }
                          }
                          
                              
                          
                      ?>
                     
                        
                <br><p style="font-size:18px;font-weight:500;">Page <?php echo"$page_no" ?> of <?php echo"$total_no_of_pages" ?></p>
                  <ul class="pagination justify-content-center mt-4">
                       <?php
                          $prevPrev = urlencode(base64_encode($previous_page_prevous));
                          $prev = urlencode(base64_encode($previous_page));
                          $pgQuery = urlencode(base64_encode($query));
                          $pgView = urlencode(base64_encode($view));
                          $pgViewMethod = urlencode(base64_encode($viewMethod));
                          $currentPage = urlencode(base64_encode($page_no));
                          $next = urlencode(base64_encode($next_page));
                          $nextNext = urlencode(base64_encode($next_page_next));
                          
                          ?>
                       
                       
                       
                        <li <?php if($page_no <= 1){ echo "class='page-item disabled'"; } ?>><?php if($page_no <= 1) { } else { ?>
                           <a href="shop.php?page_no=<?php echo "$prev"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php } ?> <span class="page-link">Previous</span></a>
                        </li>
                       

                            <?php
                                  
                                    
                                if($page_no >= 2)
                                { 
                                    if($page_no == $total_no_of_pages && $total_no_of_pages>=3)
                                    { ?>
                                    <li class="page-item"><a class="page-link" href="shop.php?page_no=<?php echo "$prevPrev"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php echo "$previous_page_prevous" ?></a></li>
                                    <?php
                                    } ?>
                                    
                                   <li class="page-item"><a class="page-link" href="shop.php?page_no=<?php echo "$prev"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php echo "$previous_page" ?></a></li>
                                   
                                   <li class="page-item active"><a class="page-link" href="shop.php?page_no=<?php echo "$currentPage"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php echo "$page_no" ?></a></li>
                                   
                                   <?php
                                    if($next_page <= $total_no_of_pages)
                                    { ?>
                                        <li class="page-item"><a class="page-link" href="shop.php?page_no=<?php echo "$next"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php echo "$next_page" ?></a></li>
                                    <?php
                                    }
                                    
                                }
                                else
                                { ?>
                                    <li class="page-item active"><a class="page-link" href="shop.php?page_no=<?php echo "$currentPage"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php echo "$page_no" ?></a></li>
                                    <?php
                                    if($next_page <= $total_no_of_pages)
                                    { ?>
                                        <li class="page-item "><a class="page-link" href="shop.php?page_no=<?php echo "$next"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php echo "$next_page" ?></a></li>
                                    <?php 
                                        if($next_page_next <= $total_no_of_pages)
                                        { ?>
                                           <li class="page-item "><a class="page-link" href="shop.php?page_no=<?php echo "$nextNext"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php echo "$next_page_next" ?></a></li>
                                            <?php 
                                        }
                                    }
                                    
                                }
                                                     
                                                      
                            ?>
                        
                        
                        
                         
                        <li <?php if($page_no == $total_no_of_pages){ echo "class='page-item disabled'"; } ?>><?php if($page_no == $total_no_of_pages) { } else { ?>
                        <a href="shop.php?page_no=<?php echo "$next"; ?> & page_query=<?php echo "$pgQuery"; ?> & view=<?php echo "$pgView"; ?> & viewmethod=<?php echo "$pgViewMethod" ?>"><?php } ?> <span class="page-link">Next</span></a>
                        </li>
                         
                         
                     </ul>
                   
                      <?php }  ?>
                     
                  </nav>
               </div>
            </div>
         </div>
      </section>
      <section class="product-items-slider section-padding bg-white border-top">
         <div class="container">
            <div class="section-header">
               <h5 class="heading-design-h5">Best Offers View <span class="badge badge-primary">20% OFF</span>
                  <a class="float-right text-secondary" href="shop.php?customview=pro_discount_status='1' & custom_header=Best Offers">View All</a>
               </h5>
            </div>
            <div class="owl-carousel owl-carousel-featured">
               
               <?php
                bestOfferWall();
                ?>
               
               
            </div>
         </div>
      </section>
       <section class="section-padding bg-white border-top">
         <div class="container">
            <div class="row">
               <?php
                getAllIdeaBoxes();
             ?>
               
            </div>
         </div>
      </section>
      
      <!-- Footer -->
      <section class="section-padding footer bg-white border-top">
         <?php include("assets/footer.php"); ?>
      </section>
      <!-- End Footer -->
      <!-- Copyright -->
      
      <!-- End Copyright -->
      
      
      <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      
      
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- select2 Js -->
      <script src="vendor/select2/js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="vendor/owl-carousel/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>
      <script>  
     $(document).ready(function(){  
          $(".btnAddCartDirect").click(function () {
               var product_id = $(this).attr("id");
               $.ajax({  
                    url:"productAddToCart.php",  
                    method:"post",  
                    data:{
                        product_id:product_id
                    },  
                    success:function(data){  
                         if(data == "Product added to your cart!")
                        {
                           $("#cartArea").load(" #cartArea");
                           toastr.success(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    
                                    // location.reload();
                                  }
                              }
                            ); 
                        }
                        else
                        {
                            toastr.error(
                              '',
                              data,
                              {
                                timeOut: 800,
                                fadeOut: 800,
                                onHidden: function () {
                                    //location.reload();
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
          $(".btnSideCartremove").click(function () {
              var product_id = $(this).attr("id");
               $.ajax({  
                    url:"sideCartItemRemove.php",  
                    method:"post",  
                    data:{
                        product_id:product_id
                    },  
                    success:function(data){  
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
               });  
          });  
     });  
     </script>
      
      <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ec535a26f7d401ccbb85394/1eamb2tme';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
      
   </body>
</html>