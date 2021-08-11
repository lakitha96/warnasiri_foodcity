<?php

$db = mysqli_connect("helpme-mysql-service.mysql.database.azure.com", "adminuser", "lakitha@21", "dayastore", 3306, MYSQLI_CLIENT_SSL);

function getAllCatogories(){
    
    global $db;
    
    $get_all_catogories = "select * from tbl_category";
     
    $result_catogories = mysqli_query($db,$get_all_catogories);
    
    while($row_products=mysqli_fetch_array($result_catogories)){
        
        $cat_name = $row_products['cat_name'];
        echo "
            <a class='dropdown-item' href='shop.php?product_catogory=$cat_name'><i class='mdi mdi-chevron-right' aria-hidden='true'></i> $cat_name</a>
            
            ";
    }
    
}


function getAllSlides(){
    
    global $db;
    
    $get_all_slides = "select * from tbl_slides";
     
    $result_slides = mysqli_query($db,$get_all_slides);
    
    while($row_slides=mysqli_fetch_array($result_slides)){
        
        $slide_name = $row_slides['slide_name'];
        $slide_image = $row_slides['slide_image'];
        echo "
            <div class='item'>
               <a href='#'><img class='img-fluid' src='img/slider/$slide_image' alt='$slide_name'></a>
            </div>
            
            ";
    }
    
}
function getAllCatogoriesIcons(){
    
    global $db;
    
    $get_all_catogories = "select * from tbl_category";
     
    $result_catogories = mysqli_query($db,$get_all_catogories);
    
    while($row_products=mysqli_fetch_array($result_catogories)){
        $catId = $row_products['cat_id'];
        $cat_name = $row_products['cat_name'];
        $cat_icon = $row_products['cat_icon'];
       
        
        
        $get_all_catogories_count = "SELECT * FROM tbl_product where cat_id = '$catId'";
        $result_count = mysqli_query($db,$get_all_catogories_count);
        $rowCount = mysqli_num_rows($result_count);
        
        echo "
            <div class='item'>
                  <div class='category-item'>
                     <a href='shop.php?product_catogory=$cat_name'>
                        <img class='img-fluid' src='img/catogoryLogo/$cat_icon' alt=''>
                        <h6>$cat_name</h6>
                        <p>$rowCount Items</p>
                     </a>
                  </div>
               </div>
            
            ";
    }
    
}

function getAllBeverages(){
    
    global $db;
    
    $get_all_Beverages = "select * from tbl_product where cat_id='CAT-2' order by 1 ASC LIMIT 0,6";
     
    $result_beverages = mysqli_query($db,$get_all_Beverages);
    
    while($row_Beverages=mysqli_fetch_array($result_beverages)){
        $pro_id = $row_Beverages['pro_id'];
        $pro_dis_status = $row_Beverages['pro_discount_status'];
        $pro_discount_amount = $row_Beverages['pro_discount_amount'];
        
        $pro_available_status = $row_Beverages['pro_available_status'];
        $avai_Stock = $row_Beverages['pro_available_stock'];
        $pro_name = $row_Beverages['pro_name'];
        $pro_price = $row_Beverages['pro_display_price'];
        $pro_image = $row_Beverages['pro_image'];
        
        echo "
            <form method='post'>
             <div class='item' >
                  <div class='product'>
                     <a href='single.php?pro_id=$pro_id'>
                        <div class='product-header'>
                           
            <input name='product_id' type='text' hidden value='$pro_id'>
            ";
        
        if($pro_dis_status==1)
        {
            echo "
            <span class='badge badge-success'>$pro_discount_amount% OFF</span>
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            
            ";
                            
        }
        else
        {
            echo "
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            ";
            
                                
        }
        
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <span class='veg text-success mdi mdi-circle'></span>
            ";
                        
        }
        else
        {
            echo "
            <span class='non-veg text-danger mdi mdi-circle'></span>
            ";
        }
        echo "
        
            </div>
                        <div class='product-body'>
                           <h5>$pro_name</h5>
                           
        
        ";
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Available Now</strong></h6>
            ";           
        }
        else
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Currently Not Available</strong></h6>
            ";
        }
        if($pro_dis_status==1)
        {
             $discountTotal = $pro_price - (( $pro_price * $pro_discount_amount )/100);
            echo "
            </div>
                </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $discountTotal <i class='mdi mdi-tag-outline'></i><br><span class='regular-price'>LKR $pro_price</span></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
               </form>
        
        ";
        }
        else
        {
           
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $pro_price <i class='mdi mdi-tag-outline'></i><br><br></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
               </form>
        
        "; 
        }
        
    }
    
}


function getAllGrocery(){
    
    global $db;
    
    $get_all_Grocery = "select * from tbl_product where cat_id='CAT-5' order by 1 ASC LIMIT 0,6";
     
    $result_Grocery = mysqli_query($db,$get_all_Grocery);
    
    while($row_Grocery=mysqli_fetch_array($result_Grocery)){
        $pro_id = $row_Grocery['pro_id'];
        $pro_dis_status = $row_Grocery['pro_discount_status'];
        $pro_discount_amount = $row_Grocery['pro_discount_amount'];
        
        $pro_available_status = $row_Grocery['pro_available_status'];
         $avai_Stock = $row_Grocery['pro_available_stock'];
        $pro_name = $row_Grocery['pro_name'];
        $pro_price = $row_Grocery['pro_display_price'];
        $pro_image = $row_Grocery['pro_image'];
        
        
        
        echo "
        <form method='post'>
             <div class='item'>
                  <div class='product'>
                     <a href='single.php?pro_id=$pro_id'>
                        <div class='product-header'>
                    <input name='product_id' type='text' hidden value='$pro_id'>       
            
            ";
        
        if($pro_dis_status==1)
        {
            echo "
            <span class='badge badge-success'>$pro_discount_amount% OFF</span>
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            
            ";
                            
        }
        else
        {
            echo "
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            ";
            
                                
        }
        
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <span class='veg text-success mdi mdi-circle'></span>
            ";
                        
        }
        else
        {
            echo "
            <span class='non-veg text-danger mdi mdi-circle'></span>
            ";
        }
        echo "
        
            </div>
                        <div class='product-body'>
                           <h5>$pro_name</h5>
                           
        
        ";
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Available Now</strong></h6>
            ";           
        }
        else
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Currently Not Available</strong></h6>
            ";
        }
        if($pro_dis_status==1)
        {
             $discountTotal = $pro_price - (( $pro_price * $pro_discount_amount )/100);
            echo "
            </div>
                </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $discountTotal <i class='mdi mdi-tag-outline'></i><br><span class='regular-price'>LKR $pro_price</span></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
               </form>
        
        ";
        }
        else
        {
           
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $pro_price <i class='mdi mdi-tag-outline'></i><br><br></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                    
                  </div>
               </div>
               </form>
        
        "; 
        }
        
    }
    
}

function getAllHousehold(){
    
    global $db;
    
    $get_all_Household = "select * from tbl_product where cat_id='CAT-6' order by 1 ASC LIMIT 0,6";
     
    $result_household = mysqli_query($db,$get_all_Household);
    
    while($row_Household=mysqli_fetch_array($result_household)){
        $pro_id = $row_Household['pro_id'];
        $pro_dis_status = $row_Household['pro_discount_status'];
        $pro_discount_amount = $row_Household['pro_discount_amount'];
        
        $pro_available_status = $row_Household['pro_available_status'];
         $avai_Stock = $row_Household['pro_available_stock'];
        $pro_name = $row_Household['pro_name'];
        $pro_price = $row_Household['pro_display_price'];
        $pro_image = $row_Household['pro_image'];
        
        echo "
        <form method='post'>
             <div class='item'>
                  <div class='product'>
                     <a href='single.php?pro_id=$pro_id'>
                        <div class='product-header'>
                       <input name='product_id' type='text' hidden value='$pro_id'>    
            
            ";
        
        if($pro_dis_status==1)
        {
            echo "
            <span class='badge badge-success'>$pro_discount_amount% OFF</span>
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            
            ";
                            
        }
        else
        {
            echo "
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            ";
            
                                
        }
        
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <span class='veg text-success mdi mdi-circle'></span>
            ";
                        
        }
        else
        {
            echo "
            <span class='non-veg text-danger mdi mdi-circle'></span>
            ";
        }
        echo "
        
            </div>
                        <div class='product-body'>
                           <h5>$pro_name</h5>
                           
        
        ";
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Available Now</strong></h6>
            ";           
        }
        else
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Currently Not Available</strong></h6>
            ";
        }
        if($pro_dis_status==1)
        {
             $discountTotal = $pro_price - (( $pro_price * $pro_discount_amount )/100);
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $discountTotal <i class='mdi mdi-tag-outline'></i><br><span class='regular-price'>LKR $pro_price</span></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
               </form>
        
        ";
        }
        else
        {
           
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $pro_price <i class='mdi mdi-tag-outline'></i><br><br></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
               </form>
        
        "; 
        }
        
    }
    
}



function getAllHomeware(){
    
    global $db;
    
    $get_all_Homeware = "select * from tbl_product where cat_id='CAT-7' order by 1 ASC LIMIT 0,6";
     
    $result_homeware = mysqli_query($db,$get_all_Homeware);
    
    while($row_Homeware=mysqli_fetch_array($result_homeware)){
        $pro_id = $row_Homeware['pro_id'];
        $pro_dis_status = $row_Homeware['pro_discount_status'];
        $pro_discount_amount = $row_Homeware['pro_discount_amount'];
        
        $pro_available_status = $row_Homeware['pro_available_status'];
         $avai_Stock = $row_Homeware['pro_available_stock'];
        $pro_name = $row_Homeware['pro_name'];
        $pro_price = $row_Homeware['pro_display_price'];
        $pro_image = $row_Homeware['pro_image'];
        
        echo "
        <form method='post'>
             <div class='item'>
                  <div class='product'>
                     <a href='single.php?pro_id=$pro_id'>
                        <div class='product-header'>
                        <input name='product_id' type='text' hidden value='$pro_id'>   
            
            ";
        
        if($pro_dis_status==1)
        {
            echo "
            <span class='badge badge-success'>$pro_discount_amount% OFF</span>
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            
            ";
                            
        }
        else
        {
            echo "
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            ";
            
                                
        }
        
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <span class='veg text-success mdi mdi-circle'></span>
            ";
                        
        }
        else
        {
            echo "
            <span class='non-veg text-danger mdi mdi-circle'></span>
            ";
        }
        echo "
        
            </div>
                        <div class='product-body'>
                           <h5>$pro_name</h5>
                           
        
        ";
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Available Now</strong></h6>
            ";           
        }
        else
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Currently Not Available</strong></h6>
            ";
        }
        if($pro_dis_status==1)
        {
             $discountTotal = $pro_price - (( $pro_price * $pro_discount_amount )/100);
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $discountTotal <i class='mdi mdi-tag-outline'></i><br><span class='regular-price'>LKR $pro_price</span></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
               </form>
        
        ";
        }
        else
        {
           
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $pro_price <i class='mdi mdi-tag-outline'></i><br><br></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
               </form>
        
        "; 
        }
        
    }
    
}

function getAllIdeaBoxes(){
    
     global $db;
    
    $get_all_Boxes = "select * from tbl_boxes";
     
    $result_boxes = mysqli_query($db,$get_all_Boxes);
    
    while($row_Boxes=mysqli_fetch_array($result_boxes)){
     
        $box_heading = $row_Boxes['box_heading'];
        $box_text = $row_Boxes['box_text'];
        echo "
        
        <div class='col-lg-4 col-sm-6'>
                  <div class='feature-box'>
                     <i class='mdi mdi-star'></i>
                     <h6>$box_heading</h6>
                     <p>$box_text</p>
                  </div>
               </div>
        
        ";
    }
}
function getAllHomeAdds(){
    
     global $db;
    
    $get_add_1 = "select ad_image from tbl_advertise where ad_id='1'";
     
    $result_add_1 = mysqli_query($db,$get_add_1);
    
    
    while($row_Adds1_home=mysqli_fetch_array($result_add_1)){
        $imageAdd1 = $row_Adds1_home['ad_image'];
        echo "
                <div class='col-md-6'>
                  <a href='#'><img class='img-fluid' src='img/ad/$imageAdd1' alt=''></a>
               </div>
        ";
    }
        

    $get_add_2 = "select ad_image from tbl_advertise where ad_id='2'";
     
    $result_add_2 = mysqli_query($db,$get_add_2);
    
    while($row_Adds2_home=mysqli_fetch_array($result_add_2)){
        
         $imageAdd2 = $row_Adds2_home['ad_image'];
        
        echo "
        <div class='col-md-6'>
              <a href='#'><img class='img-fluid' src='img/ad/$imageAdd2' alt=''></a>
       </div>
    
    ";
    }
      
}

function getbreadcrumb($pro_id)
{
    global $db;
    
    $get_details = "select pro_name,cat_id from tbl_product where pro_id='$pro_id'";
     
    $result_details = mysqli_query($db,$get_details);
    
    $details = mysqli_fetch_array($result_details);
    
    $pro_name = $details['pro_name'];
    $pro_catogory_id = $details['cat_id'];
    
    $getcatName = "SELECT `cat_name` FROM `tbl_category` WHERE cat_id= '$pro_catogory_id'";
    $catNameResults = mysqli_query($db,$getcatName);
    $catRes = mysqli_fetch_assoc($catNameResults);
    $pro_catogory = $catRes['cat_name'];
    
    echo "
    <a href='index.php'><strong><span class='mdi mdi-home'></span> Home</strong></a> <span class='mdi mdi-chevron-right'></span> <a href='shop.php'>Shop</a> <span class='mdi mdi-chevron-right'></span> <a href='shop.php?product_catogory=$pro_catogory'>$pro_catogory</a> <span class='mdi mdi-chevron-right'></span> <a href='#'>$pro_name</a>
    ";
    
}

function getProductDetails($pro_id)
{
    global $db;
    
    $get_details = "select * from tbl_product where pro_id='$pro_id'";
     
    $result_details = mysqli_query($db,$get_details);
    
    $all_details = mysqli_fetch_array($result_details);
    
    $pro_name = $all_details['pro_name'];
    $price = $all_details['pro_display_price'];
    $discountStatus = $all_details['pro_discount_status'];
    $discountAmount = $all_details['pro_discount_amount'];
    $pro_avilable_status = $all_details['pro_available_status'];
    $pro_description = $all_details['pro_description'];
    $pro_catogory = $all_details['cat_id'];
    $pro_image_1 = $all_details['pro_image'];
    $avai_Stock = $all_details['pro_available_stock'];
    
     
    echo "
    
        <div class='col-md-6'>
                  <div class='shop-detail-left'>
                     <div class='shop-detail-slider'>
                        <div class='favourite-icon'>
                           <a class='fav-btn' title='' data-placement='bottom' data-toggle='tooltip' href='#' data-original-title=''><i class='mdi mdi-tag-outline'></i></a>
                        </div>
                        <div id='sync1' class='owl-carousel'>
                           <div class='item'><img class='img-fluid img-center lrg_pro_image' alt='' src='img/item/$pro_image_1' ></div>
                           
                           
                          
                        </div>
                        <div id='sync2' class='owl-carousel'>
                           <div class='item'><img alt='' src='img/item/$pro_image_1' class='img-fluid img-center smallIcons'></div>
                           
                           
                        </div>
                     </div>
                  </div>
               </div>
    
    
    ";
    
    if($discountStatus==1)
    {
        echo "
            <div class='col-md-6'>
            
                  <div class='shop-detail-right'>
                  
                     <span class='badge badge-success'>$discountAmount% OFF</span>
                     <h2>$pro_name</h2>
                     
    
    ";
    }
    else
    {
        echo "
                    <div class='col-md-6'>
                    <div class='shop-detail-right'>
                     
                     <h2>$pro_name</h2>
                    
        
        ";
    }
    if($pro_avilable_status==1 && $avai_Stock !=0)
    {
        echo "
                    <h6><strong><span class='mdi mdi-approval'></span> Now Available </strong><span style='color:orange; font-size:18px;'>$avai_Stock Item(s)</span></h6>
                     
        ";
    }
    else
    {
        echo "
                    <h6><strong><span class='mdi mdi-approval'></span>Currently Not Available at</strong> Warnasiri FoodCity</h6>
                    
        ";
    }
    if($discountStatus==1)
    {
        $discountValue = $price - (($price * $discountAmount)/100);
        echo "
                    <form method='post' id='frmAddTocart'>
                    <input type='text' value='$pro_id' name='product_id' hidden>
                    <p class='offer-price mb-0'>Quantity : <input name='txtProQty' class='qtyText' id='txtqty' type='number' value='1' min='1' max='10' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'></p><br>
                    <p class='regular-price-custom' style='color:red;'> LKR : $price</p>
                    
                     <p class='offer-price mb-0'>Price : <span class='text-success'>LKR $discountValue</span></p>
                     <a href='#'><button type='button' name='btnAddToCart' class='btn btn-secondary btn-lg btnAddToCartProduct' id='$pro_id'><i class='mdi mdi-cart-outline'></i> Add To Cart</button> </a>
                     </form>
        
        ";
    }
    else
    {
        echo "
                    <form method='post' id='frmAddTocart'>
                    <br>
                    <input type='text' value='$pro_id' name='product_id' hidden>
                    
                    <p class='offer-price mb-0'>Quantity : <input name='txtProQty' class='qtyText' type='number' id='txtqty' value='1' min='1' max='10' onkeypress='return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57'></p><br>
                    
                    
                     <p class='offer-price mb-0'>Price : <span class='text-success'>LKR $price</span></p>
                     <a href='#'><button type='button' name='btnAddToCart' class='btn btn-secondary btn-lg btnAddToCartProduct' id='$pro_id'><i class='mdi mdi-cart-outline'></i> Add To Cart</button> </a>
                     </form>
        
        ";
    }
    
    if($pro_avilable_status==1 && $avai_Stock !=0)
    {
        echo "
        
                <div class='short-description'>
                        <h5>
                           Overview  
                           <p class='float-right'>Availability: <span class='badge badge-success'>In Stock</span></p>
                        </h5>
                        
                        <p class='mb-0'>$pro_description</p>
                     </div>
                     <h6 class='mb-3 mt-4'>Why shop from Warnasiri FoodCity?</h6>
                     <div class='row'>
                        <div class='col-md-6'>
                           <div class='feature-box'>
                              <i class='mdi mdi-truck-fast'></i>
                              <h6 class='text-info'>Free Delivery Over LKR 5000</h6>
                              <p>We will deliver your parcel to your door step freely for orders above LKR 5000.</p>
                           </div>
                        </div>
                        <div class='col-md-6'>
                           <div class='feature-box'>
                              <i class='mdi mdi-basket'></i>
                              <h6 class='text-info'>100% Secure Payments</h6>
                              <p>Customers can able to pay on cash on delivery.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
        ";
    }
    else
    {
        echo "
                <div class='short-description'>
                        <h5>
                           Quick Overview  
                           <p class='float-right'>Availability: <span class='badge-out'>Out of Stock</span></p>
                        </h5>
                        
                        <p class='mb-0'>$pro_description</p>
                     </div>
                     <h6 class='mb-3 mt-4'>Why shop from Warnasiri FoodCity?</h6>
                     <div class='row'>
                        <div class='col-md-6'>
                           <div class='feature-box'>
                              <i class='mdi mdi-truck-fast'></i>
                              <h6 class='text-info'>Free Delivery Over LKR 5000</h6>
                              <p>We will deliver your parcel to your door step freely for orders above LKR 5000.</p>
                           </div>
                        </div>
                        <div class='col-md-6'>
                           <div class='feature-box'>
                              <i class='mdi mdi-basket'></i>
                              <h6 class='text-info'>100% Secure Payments</h6>
                              <p>Customers can able to pay on cash on delivery.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
        
        ";
    }
    
}


function getCatogoryProducts($pro_id){
    
    global $db;
    
    $get_details = "select cat_id from tbl_product where pro_id='$pro_id'";
     
    $result_details = mysqli_query($db,$get_details);
    
    $all_details = mysqli_fetch_array($result_details);
    
    
    $catogory = $all_details['cat_id'];
    
    
    
    $get_all_Products = "SELECT * FROM `tbl_product` WHERE cat_id='$catogory' and pro_id!='$pro_id' order by 1 ASC LIMIT 0,6";
     
    $result_Products = mysqli_query($db,$get_all_Products);
    
    while($row_Product=mysqli_fetch_array($result_Products)){
        $pro_id = $row_Product['pro_id'];
        $pro_dis_status = $row_Product['pro_discount_status'];
        $pro_discount_amount = $row_Product['pro_discount_amount'];
        
        $pro_available_status = $row_Product['pro_available_status'];
         $avai_Stock = $row_Product['pro_available_stock'];
        $pro_name = $row_Product['pro_name'];
        $pro_price = $row_Product['pro_display_price'];
        $pro_image = $row_Product['pro_image'];
        
        echo "
             <div class='item'>
                  <div class='product'>
                     <a href='single.php?pro_id=$pro_id'>
                        <div class='product-header'>
                           
            
            ";
        
        if($pro_dis_status==1)
        {
            echo "
            <span class='badge badge-success'>$pro_discount_amount% OFF</span>
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            
            ";
                            
        }
        else
        {
            echo "
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            ";
            
                                
        }
        
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <span class='veg text-success mdi mdi-circle'></span>
            ";
                        
        }
        else
        {
            echo "
            <span class='non-veg text-danger mdi mdi-circle'></span>
            ";
        }
        echo "
        
            </div>
                        <div class='product-body'>
                           <h5>$pro_name</h5>
                           
        
        ";
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Available Now</strong></h6>
            ";           
        }
        else
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Currently Not Available</strong></h6>
            ";
        }
        if($pro_dis_status==1)
        {
            $discountTotal = $pro_price - (( $pro_price * $pro_discount_amount )/100);
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $discountTotal <i class='mdi mdi-tag-outline'></i><br><span class='regular-price'>LKR $pro_price</span></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
        
        ";
        }
        else
        {
           
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $pro_price <i class='mdi mdi-tag-outline'></i><br><br></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
        
        "; 
        }
        
    }
    
}

function viewallInSingle($pro_id)
{
    global $db;
    
    $get_Catogory = "select cat_id from tbl_product where pro_id='$pro_id'";
     
    $result_catogory = mysqli_query($db,$get_Catogory);
    
    $catogoryDetails = mysqli_fetch_array($result_catogory);
    $pro_catogory = $catogoryDetails['cat_id'];
    
    $getcatName = "SELECT `cat_name` FROM `tbl_category` WHERE cat_id = '$pro_catogory'";
    $catNameResults = mysqli_query($db,$getcatName);
    $catRes = mysqli_fetch_assoc($catNameResults);
    $catName = $catRes['cat_name'];
    
    
    
    echo "
            <h5 class='heading-design-h5'>Best Offers View <span class='badge badge-primary'>20% OFF</span>
                  <a class='float-right text-secondary' href='shop.php?product_catogory=$catName'>View All</a>
               </h5>
    
    ";
}



function showcatogoryproducts($pro_query,$offset,$total_results_per_page){
    
    global $db;
    
    $full_Query ="$pro_query LIMIT $offset, $total_results_per_page";
   
     
    $result_Products = mysqli_query($db,$full_Query);
    
    $rows = mysqli_num_rows($result_Products);
    if($rows==0)
    {
        echo"
        <h5 class='mb-3'>No Any Search Results<strong> </strong></h5><br>
        ";
       
        
    }
    else
    {
        
    
    while($row_Product=mysqli_fetch_array($result_Products)){
        $pro_id = $row_Product['pro_id'];
        $pro_dis_status = $row_Product['pro_discount_status'];
        $pro_discount_amount = $row_Product['pro_discount_amount'];
        
        $pro_available_status = $row_Product['pro_available_status'];
         $avai_Stock = $row_Product['pro_available_stock'];
        $pro_name = $row_Product['pro_name'];
        $pro_price = $row_Product['pro_display_price'];
        $pro_image = $row_Product['pro_image'];
        
        echo "
                
                    <div class='col-md-4'>
                    <form method='post' action=''>
                        <div class='product'>
                           <a href='single.php?pro_id=$pro_id''>
                              <div class='product-header'>
                              <input name='product_id' type='text' hidden value='$pro_id'> 
        ";
        
        if($pro_dis_status==1)
        {
            echo "
                <span class='badge badge-success'>$pro_discount_amount% OFF</span>
                <img class='img-fluid' src='img/item/$pro_image' alt=''>
            
            ";
            
        }
        else{
            echo "
                <img class='img-fluid' src='img/item/$pro_image' alt=''>
            ";
        }
        if($pro_available_status==1 && $avai_Stock !=0)
        {
            echo "
                <span class='veg text-success mdi mdi-circle'></span>
                </div>
                              <div class='product-body'>
                                 <h5>$pro_name</h5>
                                 <h6><strong><span class='mdi mdi-approval'></span> Now Available</strong></h6>
                              </div>
                              </a>
                              <div class='product-footer'>
            
            ";
        }
        else{
            
            echo "
                <span class='non-veg text-danger mdi mdi-circle'></span>
                
                </div>
                              <div class='product-body'>
                                 <h5>$pro_name</h5>
                                 <h6><strong><span class='mdi mdi-approval'></span> Currently Not Available</strong></h6>
                              </div>
                              </a>
                              <div class='product-footer'>
            ";
        }
        
        if($pro_dis_status==1)
        {
            $discountTotal = $pro_price - (( $pro_price * $pro_discount_amount )/100);
            
            echo "
                    <p class='offer-price mb-0'>LKR $discountTotal<i class='mdi mdi-tag-outline'></i><br><span class='regular-price'>LKR $pro_price</span></p><br>
                                  <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                              </div>
                           
                        </div>
                         </form>
                     </div>
                     
            ";
        }
        else
        {
            echo "
            <p class='offer-price mb-0'>LKR $pro_price<i class='mdi mdi-tag-outline'></i><br><br></p><br>
                                  <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                              </div>
                           
                        </div>
                        </form>
                     </div>
                     
            
            ";
        }
        
        
    
    }
    }
}

function bestOfferWall()
{
    
    global $db;
    
    $get_all_bestOfferWall = "select * from tbl_product where pro_discount_status='1' order by 1 ASC LIMIT 0,6";
     
    $result_bestOfferWall = mysqli_query($db,$get_all_bestOfferWall);
    
    while($row_bestOfferWall=mysqli_fetch_array($result_bestOfferWall)){
        $pro_id = $row_bestOfferWall['pro_id'];
        $pro_dis_status = $row_bestOfferWall['pro_discount_status'];
        $pro_discount_amount = $row_bestOfferWall['pro_discount_amount'];
        
        $pro_available_status = $row_bestOfferWall['pro_available_status'];
        $avai_Stock = $row_bestOfferWall['pro_available_stock'];
        $pro_name = $row_bestOfferWall['pro_name'];
        $pro_price = $row_bestOfferWall['pro_display_price'];
        $pro_image = $row_bestOfferWall['pro_image'];
        
        echo "
             <div class='item'>
                  <div class='product'>
                     <a href='single.php?pro_id=$pro_id'>
                        <div class='product-header'>
                           
            
            ";
        
        if($pro_dis_status==1)
        {
            echo "
            <span class='badge badge-success'>$pro_discount_amount% OFF</span>
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            
            ";
                            
        }
        else
        {
            echo "
            <img class='img-fluid' src='img/item/$pro_image' alt=''>
            ";
            
                                
        }
        
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <span class='veg text-success mdi mdi-circle'></span>
            ";
                        
        }
        else
        {
            echo "
            <span class='non-veg text-danger mdi mdi-circle'></span>
            ";
        }
        echo "
        
            </div>
                        <div class='product-body'>
                           <h5>$pro_name</h5>
                           
        
        ";
        if($pro_available_status == 1 && $avai_Stock !=0)
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Available Now</strong></h6>
            ";           
        }
        else
        {
            echo "
            <h6><strong><span class='mdi mdi-approval'></span>Currently Not Available</strong></h6>
            ";
        }
        if($pro_dis_status==1)
        {
            $discountTotal = $pro_price - (( $pro_price * $pro_discount_amount )/100);
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $discountTotal <i class='mdi mdi-tag-outline'></i><br><span class='regular-price'>LKR $pro_price</span></p><br>
                          <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
        
        ";
        }
        else
        {
           
            echo "
            </div>
                    </a>
                        <div class='product-footer'>
                           
                           <p class='offer-price mb-0'>LKR $pro_price <i class='mdi mdi-tag-outline'></i><br><br></p><br>
                           <button type='button' id='$pro_id' name='btnAddToCart' class='btn btn-secondary btn-sm float-left btnAddCartDirect'><i class='mdi mdi-cart-outline'></i> Add To Cart</button><br>
                        </div>
                     
                  </div>
               </div>
        
        "; 
        }
        
    }
    
}

function getAllFilterCatogories($wordString){
    
    global $db;
    
    $get_all_catogories = "select * from tbl_category";
     
    $result_catogories = mysqli_query($db,$get_all_catogories);
    $no=1;
    while($row_products=mysqli_fetch_array($result_catogories)){
        
        
        
        $cat_name = $row_products['cat_name'];
        $cat_Id = $row_products['cat_id'];
        $encodeVal=base64_encode($cat_Id);  
        if(strpos($wordString, $cat_Id) !== false)
        {
            echo "
            <div class='custom-control custom-checkbox'>
                 <input type='checkbox' name='catogoryfilter[]' class='custom-control-input product_check' value='$encodeVal' id='cb$no' checked>
                 <label class='custom-control-label' for='cb$no'>$cat_name</label>
            </div>

            
            ";
        }
        else
        {
            echo "
            <div class='custom-control custom-checkbox'>
                 <input type='checkbox' name='catogoryfilter[]' class='custom-control-input product_check' value='$encodeVal' id='cb$no' >
                 <label class='custom-control-label' for='cb$no'>$cat_name</label>
            </div>

            
            ";
        }
        
        $no = $no + 1;
    }
    
}

function getAllOrders($cusID)
{
    global $db;
    $getAllOrderDetails = "SELECT DISTINCT tbl_sales_order.s_orderId, tbl_sales_order.order_date, tbl_sales_order.total,tbl_sales_order.order_status,tbl_sales_order.c_id FROM tbl_sales_order INNER JOIN tbl_cart ON tbl_sales_order.c_id=tbl_cart.c_id WHERE tbl_cart.cus_id = '$cusID' order BY order_date DESC";
    $orderDetails = mysqli_query($db,$getAllOrderDetails);
    while($rowOrders = mysqli_fetch_array($orderDetails))
    {
        $orderId = $rowOrders['s_orderId'];
        $orderDate = $rowOrders['order_date'];
        $orderTotal = $rowOrders['total'];
        $orderStatus  = $rowOrders['order_status'];
        $cartId = $rowOrders['c_id'];
        if($orderStatus == 1)
        {
            $status = "<span style='width:70px;' class='badge badge-secondary'>In Progress</span>";
        }
        else if($orderStatus == 2)
        {
            $status = "<span style='width:70px;' class='badge badge-info'>Accepted</span>";
        }
        else if($orderStatus == 3)
        {
            $status = "<span style='width:70px;' class='badge badge-warning'>Delivered</span>";
        }
        else if($orderStatus == 4)
        {
            $status = "<span style='width:70px;' class='badge badge-success'>Completed</span>";
        }
        else if($orderStatus == 5)
        {
            $status = "<span style='width:70px;' class='badge badge-danger'>Canceled</span>";
        }
        
        $checkForReturns = "SELECT DISTINCT `return_status` FROM `tbl_sales_return` WHERE `s_orderId` = '$orderId'";
        $checkForReturnResults = mysqli_fetch_assoc(mysqli_query($db,$checkForReturns));
        $returnOrderStatus = $checkForReturnResults['return_status'];
        
        echo"
                <tr>
                  <td>$orderId</td>
                  <td>$orderDate</td>

                  <td>LKR $orderTotal</td>
                  <td>$status</td>
                  <td><button id='$cartId' data-toggle='modal3' data-target='.bd-example-modal-lg' data-placement='top' title='' href='#' data-original-title='View Order' class='btn btn-info btn-sm btnViewOrder'><i class='mdi mdi-eye'></i></button>
                  
                  
        
        
        ";
        if($orderStatus == 4 && $returnOrderStatus == null)
        {
            echo "
            <button type='button' id='$cartId' data-toggle='tooltip' data-placement='top' title='' href='#' data-original-title='Return Order' class='btn btn-info btn-sm btnReturn'><i class='mdi mdi-keyboard-return'></i></button>

                  </td>
               </tr>
            ";
        }
        else if($returnOrderStatus == 5)
        {
            echo "
            <button disabled id='$orderId' data-toggle='tooltip' data-placement='top' title='' href='#' data-original-title='Cancel Return Order' class='btn btn-danger btn-sm btnCancelReturn'><i class='mdi mdi-close-circle'></i></button>

                  </td>
               </tr>
            
            ";
        }
        else if($returnOrderStatus == 1)
        {
            echo "
            <button id='$orderId' data-toggle='tooltip' data-placement='top' title='' href='#' data-original-title='Cancel Return Order' class='btn btn-danger btn-sm btnCancelReturn'><i class='mdi mdi-close-circle'></i></button>

                  </td>
               </tr>
            
            ";
        }
        else if($returnOrderStatus != 1 && $returnOrderStatus != 5 && $returnOrderStatus != null)
        {
             echo "
            <button disabled id='$orderId' data-toggle='tooltip' data-placement='top' title='' href='#' data-original-title='Cancel Return Order' class='btn btn-danger btn-sm btnCancelReturn'><i class='mdi mdi-close-circle'></i></button>

                  </td>
               </tr>
            
            ";
        }
        else 
        {
            echo "
            <button disabled data-toggle='tooltip' data-placement='top' title='' href='#' data-original-title='Return Order' class='btn btn-info btn-sm'><i class='mdi mdi-keyboard-return'></i></button>

                  </td>
               </tr>
            
            ";
            
        }
    }
}

function getOrderDetails($cartID)
{
     global $db;
    $totAmount = 0;
    $getAllProductsInCart = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cartID'";
    $allProductResults = mysqli_query($db,$getAllProductsInCart);
    
    $getOrdDetails = "SELECT `s_orderId`,`cus_fname`,`cus_lname` FROM `tbl_sales_order` WHERE `c_id` = '$cartID'";
    $resultOFOrder = mysqli_query($db,$getOrdDetails);
    $detailsOrder = mysqli_fetch_assoc($resultOFOrder);
    $orderID = $detailsOrder['s_orderId'];
    $orderCusFName = $detailsOrder['cus_fname'];
    $orderCusLName = $detailsOrder['cus_lname'];
    echo "
        <p class='mb-2'>Order ID: <span class='text-primary'>$orderID</span></p>
        <p class='mb-2'>Customer Name: <span class='text-primary'>$orderCusFName $orderCusLName</span></p>                        

        <div class='table-responsive'>
            <table class='table table-centered table-nowrap'>
                <thead>
                    <tr>
                        <th scope='col'>Product</th>
                        <th scope='col'>Product Name</th>

                        <th scope='col' style='text-align:center;'>Total</th>
                    </tr>
                </thead>
                <tbody >
    
    
    ";
    
    
    while($ProductRow = mysqli_fetch_array($allProductResults))
    {
        $cartProId = $ProductRow['product_id'];
        $cartProQty = $ProductRow['quantity'];
        $cartProTotal =  $ProductRow['total'];
        $getOtherProductDetails = "SELECT * FROM `tbl_product` WHERE `pro_id` = '$cartProId'";
        $otherDetailsResults = mysqli_query($db,$getOtherProductDetails);
        $fetchOtherDetails = mysqli_fetch_array($otherDetailsResults);
        $productImage = $fetchOtherDetails['pro_image'];
        $productName = $fetchOtherDetails['pro_name'];
        $unitPrice = $cartProTotal / $cartProQty;
        
        
        
        echo "
                 
        
        
                <tr>
                    <th scope='row'>
                        <div>
                            <img src='img/item/$productImage' alt='' class='avatar-sm'>
                        </div>
                    </th>
                    <td>
                        <div>
                            <h5 class='text-truncate'>$productName</h5>
                            <p class='text-muted mb-0'>LKR $unitPrice x $cartProQty</p>
                        </div>
                    </td>
                    <td style='text-align:right;'><h5 class='text-truncate'>LKR $cartProTotal</h5></td>
                </tr>
        
        ";
        $totAmount = $totAmount + $cartProTotal;
    }
    echo "
            <tr>
                <td colspan='2'>
                    <h6 class='m-0 text-right subTot'>Sub Total:</h6>
                </td>
                <td style='text-align:right;'>
                <h6 class='m-0 subTot'>LKR $totAmount</h6>
                    
                </td>
            </tr>
            
            <tr>
                <td colspan='2'>
                    <h6 class='m-0 text-right subTot'>Total:</h6>
                </td>
                <td style='text-align:right;'>
                <h6 class='m-0 subTot'>LKR $totAmount</h6>
                    
                </td>
            </tr>
            </tbody>
       </table>
    
    ";
      
}

function getFaq()
{
    global $db;
    $getAllfaq = "SELECT * FROM `tbl_faq`";
    $resultOffaq = mysqli_query($db,$getAllfaq);
    while($rowFaq = mysqli_fetch_array($resultOffaq))
    {
        
        $faqQuestion = $rowFaq['faq_question'];
        $faqAnswer = $rowFaq['faq_answer'];
        $faqId = $rowFaq['faq_id'];
        
        
        
        echo "
            <div class='card mb-0'>
                 <div class='card-header' id='heading$faqId'>
                    <h6 class='mb-0'>
                       <a href='#' data-toggle='collapse' data-target='#collapse$faqId' aria-expanded='true' aria-controls='collapse$faqId'>
                       <i class='icofont icofont-question-square'></i>   $faqQuestion 
                       </a>
                    </h6>
                 </div>
                 <div id='collapse$faqId' class='collapse' aria-labelledby='heading$faqId' data-parent='#accordionExample'>
                    <div class='card-body'>
                       $faqAnswer
                    </div>
                 </div>
              </div>
        
        ";
        
        
        
    }
}

function getOrderReturnDetails($cartID)
{
     global $db;
    $totAmount = 0;
    $getAllProductsInCart = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cartID'";
    $allProductResults = mysqli_query($db,$getAllProductsInCart);
    
    $getOrdDetails = "SELECT `s_orderId`,`cus_fname`,`cus_lname` FROM `tbl_sales_order` WHERE `c_id` = '$cartID'";
    $resultOFOrder = mysqli_query($db,$getOrdDetails);
    $detailsOrder = mysqli_fetch_assoc($resultOFOrder);
    $orderID = $detailsOrder['s_orderId'];
    
    echo "
            <div class='order-list-tabel-main table-responsive'>
                 <table id='orderReturnTable' class='datatabel table table-striped table-bordered order-list-tabel' width='100%' cellspacing='0'>
                    <thead>
                    <div class='text-center'>
                        <p style='color:red;'>Please make sure to select all product to be return while returning order<br>(An order can be return only once)</p>
                        </div>
                       <tr>
                          <th>Product</th>
                          <th>Name</th>
                          <th class='text-center'>Return</th>
                          
                       </tr>
                    </thead>
                    <tbody>
    
    
    ";
    
    
    while($ProductRow = mysqli_fetch_array($allProductResults))
    {
        $cartProId = $ProductRow['product_id'];
        
        $getOtherProductDetails = "SELECT * FROM `tbl_product` WHERE `pro_id` = '$cartProId'";
        $otherDetailsResults = mysqli_query($db,$getOtherProductDetails);
        $fetchOtherDetails = mysqli_fetch_array($otherDetailsResults);
        $productImage = $fetchOtherDetails['pro_image'];
        $productName = $fetchOtherDetails['pro_name'];
        
        
        
        
        echo "
                 <tr>
                  <td style='vertical-align: middle;'><img src='img/item/$productImage' alt='' class='avatar-sm'></td>
                  <td style='vertical-align: middle;'>$productName</td>

                  <td style='vertical-align: middle;' class='text-center'>
                  
                  <div class='custom-control custom-checkbox'>
                  <input type='checkbox' class='custom-control-input productID' id='$cartProId' name='productId[]' value='$cartProId'>
                  <label class='custom-control-label' for='$cartProId'>Return Product</label>
                </div>
                  
                  </td>

                </tr>
        
        ";
       
    }
    echo "
           </tbody>
           
        </table>
        <div class='text-right'>
        <button type='button' id='$orderID' class='btn btn-info btnReturnOrderNow'>Return Products</button>
        </div>
    </div>
    
    ";
      
}


function getAllReturns($cusID)
{
    global $db;
    $getAllReturnDetails = "SELECT `s_orderId`,`return_date`,`return_status` FROM `tbl_sales_return` WHERE cus_id = '$cusID' GROUP BY s_orderId ORDER BY return_date DESC";
    $returnDetails = mysqli_query($db,$getAllReturnDetails);
    while($rowReturns = mysqli_fetch_array($returnDetails))
    {
        $salesOrderId = $rowReturns['s_orderId'];
        $returnDate = $rowReturns['return_date'];
        $returnStatus = $rowReturns['return_status'];
        
        if($returnStatus == 1)
        {
            $status = "<span style='width:70px;' class='badge badge-secondary'>In Progress</span>";
        }
        else if($returnStatus == 2)
        {
            $status = "<span style='width:70px;' class='badge badge-info'>Accepted</span>";
        }
        else if($returnStatus == 3)
        {
            $status = "<span style='width:70px;' class='badge badge-warning'>Delivered</span>";
        }
        else if($returnStatus == 4)
        {
            $status = "<span style='width:70px;' class='badge badge-success'>Completed</span>";
        }
        else if($returnStatus == 5)
        {
            $status = "<span style='width:70px;' class='badge badge-danger'>Canceled</span>";
        }
        
        
        
        echo"
                <tr>
                  <td>$salesOrderId</td>
                  <td>$returnDate</td>

                  <td>$status</td>
                  <td><button id='$salesOrderId' data-toggle='modal3' data-target='.bd-example-modal-lg' data-placement='top' title='' href='#' data-original-title='View Return Order' class='btn btn-info btn-sm btnViewReturnOrder'><i class='mdi mdi-eye'></i></button>
                  
                  
        
        
        ";
        if($returnStatus == 1)
        {
            echo "
            <button id='$salesOrderId' data-toggle='tooltip' data-placement='top' title='' href='#' data-original-title='Cancel Return Order' class='btn btn-danger btn-sm btnCancelReturn'><i class='mdi mdi-close-circle'></i></button>

                  </td>
               </tr>
            
            ";
        }
        else
        {
            echo "
            <button disabled id='$salesOrderId' data-toggle='tooltip' data-placement='top' title='' href='#' data-original-title='Cancel Return Order' class='btn btn-danger btn-sm btnCancelReturn'><i class='mdi mdi-close-circle'></i></button>

                  </td>
               </tr>
            
            ";
        }
       
        
    }
}





function getReturnDetails($returnOrderID)
{
    global $db;
    $getCartID = "SELECT `c_id` FROM `tbl_sales_order` WHERE `s_orderId` = '$returnOrderID'";
    $cartIdResults = mysqli_query($db,$getCartID);
    $cartFetchResults = mysqli_fetch_assoc($cartIdResults);
    $cartID = $cartFetchResults['c_id'];
    
    $getReturnOrderItems = "SELECT `s_returnId`, `product_id` FROM `tbl_sales_return` WHERE `s_orderId` = '$returnOrderID'";
    $allReturnItemInOrder = mysqli_query($db,$getReturnOrderItems);
    
    
    echo " 
        <div class='table-responsive'>
            <table class='table table-centered table-nowrap'>
                <thead>
                    <tr>
                        <th scope='col'>Return ID</th>
                        <th scope='col'>Product</th>
                        <th scope='col'>Product Name</th>

                        <th scope='col' style='text-align:center;'>Qty.</th>
                    </tr>
                </thead>
                <tbody >
    
    
    ";
    
    
    while($returnOrderRow = mysqli_fetch_array($allReturnItemInOrder))
    {
        $returnID = $returnOrderRow['s_returnId'];
        $returnProId = $returnOrderRow['product_id'];
        
        $getCartQuantity = "SELECT `quantity` FROM `tbl_cart` WHERE `c_id` = '$cartID' and `product_id` = '$returnProId'";
        $cartQtyData = mysqli_query($db,$getCartQuantity);
        $quatityDetails = mysqli_fetch_assoc($cartQtyData);
        $proQty = $quatityDetails['quantity'];
        
        $getProductData = "SELECT `pro_name`,`pro_image` FROM `tbl_product` WHERE `pro_id`='$returnProId'";
        $productDataResults = mysqli_query($db,$getProductData);
        $fetchedProductDetails = mysqli_fetch_array($productDataResults);
        $productImage = $fetchedProductDetails['pro_image'];
        $productName = $fetchedProductDetails['pro_name'];
        echo "
                 
        
        
                <tr>
                    <td style='vertical-align: middle;'>
                        <div>
                            <h5 class='text-truncate'>$returnID</h5>
                            
                        </div>
                    </td>
                    <th scope='row'>
                        <div>
                            <img src='img/item/$productImage' alt='' class='avatar-sm'>
                        </div>
                    </th>
                    <td style='vertical-align: middle;'>
                        <div>
                            <h5 class='text-truncate'>$productName</h5>
                            
                        </div>
                    </td>
                    <td style='vertical-align: middle; text-align:center;'>
                        <div>
                            <h5 class='text-truncate'>$proQty</h5>
                            
                        </div>
                    </td>
                    
                </tr>
        
        ";
        
    }
    echo "
            
            </tbody>
       </table>
    
    ";
      
}


?>