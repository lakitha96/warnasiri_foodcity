
         <div class="cart-sidebar-header">
           <?php if(isset($_SESSION["shopping_cart"]) && !isset($_SESSION["cusEmailaddress"])){
                if(!empty($_SESSION["shopping_cart"])) {
                    $cart_count = count(array_keys($_SESSION["shopping_cart"]));  
             ?>
            <h5>
               My Cart <span class="text-success">(<?= $cart_count ?> Items)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
               </a>
            </h5>
            <?php }else { ?>
            <h5>
               My Cart <span class="text-success">(0 item)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
               </a>
            </h5>
            
            <?php } ?>
            
            <?php }else if(isset($_SESSION["cusEmailaddress"]))  { ?>
            <h5>
               My Cart <span class="text-success">(<?= $cartCount ?> Items)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
               </a>
            </h5>
            
            
            <?php } else if(!isset($_SESSION["cusEmailaddress"])) { ?>
            <h5>
               My Cart <span class="text-success">(0 Items)</span> <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
               </a>
            </h5>
            <?php } ?>
         </div>
         <div class="cart-sidebar-body">
            
             <?php if(isset($_SESSION["shopping_cart"]) && !isset($_SESSION["cusEmailaddress"])){
                    $totalAmount = 0;
                if(!empty($_SESSION["shopping_cart"])) { 
                        foreach ($_SESSION["shopping_cart"] as $product){
                                
                                    
                                    $product_id = $product['pro_id'];
                                    $checkproduct = "select * from tbl_product where pro_id='$product_id'";
                                    $res = mysqli_query($con,$checkproduct);
                                    $row = mysqli_fetch_array($res);
                                    $avil_Status = $row['pro_available_status'];
                                    $discount_Status = $row['pro_discount_status'];
                                    $discount_Amount = $row['pro_discount_amount'];
                                    $pro_Image = $row['pro_image-1'];
                                    $pro_Name = $row['pro_name'];
                                    $pro_Price = $row['pro_display_price'];
             ?>
            <div class="cart-list-product">
             <form method="post">
                <input type='hidden' name='product_id' id="removeProductId" value="<?= $product['pro_id']; ?>" />
                 <button class="float-right remove-cart btnRightcart btnSideCartremove" id="<?= $product['pro_id']; ?>" type="button" name="btnRemove"><i class="mdi mdi-close"></i></button>
                 
             </form>
               
               <img class="img-fluid" src="img/item/<?= $pro_Image ?>" alt="">
               <?php if($discount_Status==1){ ?>
               <span class="badge badge-success"><?= $discount_Amount ?>% OFF</span>
               <?php }else {} ?>
               <h5><a href="#"><?= $pro_Name ?></a></h5>
               <?php if($avil_Status==1){ ?>
                   <h6><strong><span class="mdi mdi-approval"></span> Available Now</strong></h6>
               <?php }else { ?>
                   <h6><strong><span class="mdi mdi-approval"></span> Not Available</strong></h6>
               <?php } ?>
               <?php if($discount_Status==1){
                 $withoutDiscountPrice = $pro_Price * $product['pro_qty'];
                 $withDiscountPrice = $pro_Price - (($pro_Price * $discount_Amount)/100);
                 $dicountedTotalPrice = $withDiscountPrice * $product['pro_qty'];
                
                ?>
                   
                   <p class="offer-price mb-0">LKR <?= $dicountedTotalPrice ?><i class="mdi mdi-tag-outline"></i> <span class="regular-price"><?= $withoutDiscountPrice ?></span></p>
               <?php }else {
                    $withoutDiscountPrice = $pro_Price * $product['pro_qty'];
                ?>
                   <p class="offer-price mb-0">LKR <?= $withoutDiscountPrice ?><i class="mdi mdi-tag-outline"></i> <span class="regular-price"></span></p>
               <?php } ?>
               
            </div>
            
             
             
            <?php 
                   if($discount_Status==1)
                   {
                       $totalAmount =  $totalAmount + $dicountedTotalPrice;
                       
                   }
                    else
                    {
                        $totalAmount =  $totalAmount + $withoutDiscountPrice;
                    }
                            
                            
            }}else { ?>
            
             
             
            <?php }}else if(isset($_SESSION["cusEmailaddress"])) { 
             $totalAmount =  0;
             $getCartProductsQuery = "SELECT * FROM `tbl_cart` WHERE cus_id = '$cusId' and status='0'";
             $cartDetailResults = mysqli_query($db,$getCartProductsQuery);
             while($rowProduct = mysqli_fetch_array($cartDetailResults)){
                 $pro_Id_Cart = $rowProduct['proID'];
                 $proQty_Cart = $rowProduct['proQty'];
                 
                 $getProductOtherDetails = "SELECT * FROM `tbl_product` where pro_id = '$pro_Id_Cart'";
                 $otherProductDetailsResults = mysqli_query($db,$getProductOtherDetails);
                 $otherProductResult = mysqli_fetch_array($otherProductDetailsResults);
                 $discountStatus = $otherProductResult['pro_discount_status'];
                 $discountAmount = $otherProductResult['pro_discount_amount'];
                 $avialabilityStatus = $otherProductResult['pro_available_status'];
                 $pro_Image = $otherProductResult['pro_image-1'];
                 $pro_Name = $otherProductResult['pro_name'];
                 $pro_Price = $otherProductResult['pro_display_price'];
                 
                 echo "
                 
                 <div class='cart-list-product'>
                 <form method='post'>
                <input type='hidden' name='product_id' id='removeProductId' value='$pro_Id_Cart'/>
                 <button class='float-right remove-cart btnRightcart btnSideCartremove' id='$pro_Id_Cart' type='button' name='btnRemove'><i class='mdi mdi-close'></i></button>
                 
             </form>
                 
               <img class='img-fluid' src='img/item/$pro_Image' alt='>              
                 ";
                 if($discountStatus==1)
                 {
                     echo "
                      <span class='badge badge-success'>$discountAmount% OFF</span>
                       <h5><a href='#'>$pro_Name</a></h5>
                        ";
                 }
                 else
                 {
                     echo "
                     <h5><a href='#'>$pro_Name</a></h5>
                     
                     ";
                 }
                 if($avialabilityStatus==1)
                 {
                     echo "
                     <h6><strong><span class='mdi mdi-approval'></span> Available Now</strong></h6>
                     
                     ";
                 }
                 else
                 {
                      echo "
                     <h6><strong><span class='mdi mdi-approval'></span> Not Available</strong></h6>
                       
                     
                     ";
                 }
                 if($discountStatus==1)
                 {
                     
                     
                     
                      $withoutDiscountPrice = $pro_Price * $proQty_Cart;
                 $withDiscountPrice = $pro_Price - (($pro_Price * $discountAmount)/100);
                 $dicountedTotalPrice = $withDiscountPrice * $proQty_Cart;
                     
                     echo "
                     <p class='offer-price mb-0'>LKR $dicountedTotalPrice <i class='mdi mdi-tag-outline'></i> <span class='regular-price'>$withoutDiscountPrice</span></p>
                    </div>
                     ";
                 }
                 else
                 {
                     $withoutDiscountPrice = $pro_Price * $proQty_Cart;
                     echo "
                            <p class='offer-price mb-0'>LKR $withoutDiscountPrice <i class='mdi mdi-tag-outline'></i> <span class='regular-price'></span></p>
                    </div>
                     ";
                 }
                 
                 
                 if($discountStatus==1)
                 {
                     $totalAmount =  $totalAmount + $dicountedTotalPrice;
                 }
                 else
                 {
                    $totalAmount =  $totalAmount + ($pro_Price * $proQty_Cart); 
                 }
                 
                 
             }
             ?>
                
            <?php }else if(!isset($_SESSION["cusEmailaddress"])){ ?>
            
            <?php } ?>
            
            
         </div>
         <div class="cart-sidebar-footer">
        
          <?php if(isset($_SESSION["shopping_cart"]) && !isset($_SESSION["cusEmailaddress"])){ 
             if(!empty($_SESSION["shopping_cart"])) { ?>
             
             <div class="cart-store-details">
               <p>Sub Total <strong class="float-right">LKR <?= $totalAmount ?></strong></p>
            </div>
            <a href="cart.php"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> View Cart </span><span class="float-right"><strong>LKR <?= $totalAmount ?></strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
                     <br>   
             
          
          <?php }else{ ?>
              
              <div class="cart-store-details">
               <p>Sub Total <strong class="float-right">LKR 0</strong></p>
            </div>
            <a href="cart.php"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> View Cart </span><span class="float-right"><strong>LKR 0</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
                     <br>   
          
          <?php }}else if(isset($_SESSION["cusEmailaddress"])) { ?>
           
           <div class="cart-store-details">
               <p>Sub Total <strong class="float-right">LKR <?= $totalAmount ?></strong></p>
            </div>
            <a href="cart.php"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> View Cart </span><span class="float-right"><strong>LKR <?= $totalAmount ?></strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
                   <br>     
           
           
           <?php }else if(!isset($_SESSION["cusEmailaddress"])) { ?>
               <div class="cart-store-details">
               <p>Sub Total <strong class="float-right">LKR 0</strong></p>
            </div>
            <a href="cart.php"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> View Cart </span><span class="float-right"><strong>LKR 0</strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
                        <br>
           <?php } ?>
            
         </div>
      