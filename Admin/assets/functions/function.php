<?php

$db = mysqli_connect("localhost","root","","dayaStore");

function getAllProducts(){
    
    global $db;
    
    $getproductQuery = "select * from tbl_product";
    $queryResults = mysqli_query($db,$getproductQuery);
     while($row_product=mysqli_fetch_array($queryResults)){
         
         $proID = $row_product['pro_id'];
         $proName = $row_product['pro_name'];
         $proprice = $row_product['pro_display_price'];
         $proDiscountStatus = $row_product['pro_discount_status'];
         $proDiscountAmount = $row_product['pro_discount_amount'];
         $availableStatus = $row_product['pro_available_status'];
         $proDescription = $row_product['pro_description'];
         $proCatogory = $row_product['cat_id'];
         $proStock = $row_product['pro_available_stock'];
         $proImage = $row_product['pro_image'];
         
         if($proDiscountStatus==1)
         {
             $disStatus ="Yes";
         }
         else
         {
             $disStatus ="No";
             $proDiscountAmount = "";
         }
         if($availableStatus == 1)
         {
             $availability = "Available Now";
         }
         else
         {
             $availability = "Not Available";
         }
         if($proStock == 0)
         {
             $proStock = "N/A";
         }
         $getCatNameQuery = "SELECT cat_name FROM `tbl_category` WHere cat_id = '$proCatogory'";
         
        $getCatDetails = mysqli_fetch_array(mysqli_query($db,$getCatNameQuery));
         $proCatName = $getCatDetails['cat_name'];
        
         echo "
            
                 <tr>
                    <td><img style='max-height: 60px; max-width: 60px; min-height: 60px; min-width: 60px; margin-left: auto;margin-right: auto; display: block;' src='../img/item/$proImage'></td>
                    <td style='vertical-align: middle;'>$proID</td>
                    <td style='vertical-align: middle;'>$proName</td>
                    <td style='vertical-align: middle;'>$proprice</td>
                    <td style='vertical-align: middle;'>$disStatus</td>
                    <td style='vertical-align: middle;'>$proDiscountAmount</td>
                    <td style='vertical-align: middle;'>$availability</td>
                    <td style='vertical-align: middle;'>$proStock</td>
                    <td style='vertical-align: middle;'>$proCatName</td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form method='post' action='edit-product.php'>
                        <input type='text' value='$proID' name='txtProdID' hidden />
                        <button type='submit' name='btnEditProduct' class='btn btn-secondary btn-sm btn-rounded waves-effect waves-light'>Edit Details</button>
                       
                        <button type='button' name='btnViewProduct' class='btn btn-primary btn-sm btn-rounded waves-effect waves-light viewProductDetails' id='$proID'>View Details</button>
                        </form> 
                    </td>
                   
                </tr>
         
         ";
    }
}

function getAllCatogories(){
    
    global $db;
    
    $get_all_catogories = "select * from tbl_category";
     
    $result_catogories = mysqli_query($db,$get_all_catogories);
    
    while($row_products=mysqli_fetch_array($result_catogories)){
        $cat_ID = $row_products['cat_id'];
        $cat_name = $row_products['cat_name'];
        echo "
            <option value='$cat_ID'>$cat_name</option>
            
            ";
    }
    
}

function getSelectedCatogories($catSelected){
    
    global $db;
    
   
    $get_all_catogories = "select * from tbl_category";
     
    $result_catogories = mysqli_query($db,$get_all_catogories);
    
    while($row_products=mysqli_fetch_array($result_catogories)){
        $cat_ID = $row_products['cat_id'];
        $cat_name = $row_products['cat_name'];
        
        if($catSelected == $cat_name)
        {
            echo "
            <option value='$cat_ID' selected>$cat_name</option>
            
            ";
        }
        else
        {
            echo "
            <option value='$cat_ID'>$cat_name</option>
            
            ";
        }
        
        
    }
    
}

function getAllCustomers(){
    
    global $db;
    
    $getCustomerDetailsQuery = "select * from tbl_customer";
    $customerQueryResults = mysqli_query($db,$getCustomerDetailsQuery);
     while($row_customer=mysqli_fetch_array($customerQueryResults)){
         
         $cusID = $row_customer['cus_id'];
         $cusFirstName = $row_customer['cus_fname'];
         $cusLastName = $row_customer['cus_lname'];
         $cusPhone = $row_customer['cus_tele'];
         $cusNICNo = $row_customer['cus_nic'];
         $cusCity = $row_customer['cus_city'];
         $cusEmailAddress = $row_customer['cus_email'];
         $cusImage = $row_customer['cus_image'];
         
         
         if($cusImage == null || $cusImage == "")
         {
             $cusImage ="commonuser.jpg";
         }
         
         if($cusFirstName == null || $cusFirstName == "")
         {
             $cusFirstName = "N/A";
         }
         if($cusLastName == null || $cusLastName == "")
         {
             $cusLastName = "N/A";
         }
         if($cusPhone == null || $cusPhone == "")
         {
             $cusPhone = "N/A";
         }
         if($cusNICNo == null || $cusNICNo == "")
         {
             $cusNICNo = "N/A";
         }
         if($cusCity == null || $cusCity == "")
         {
             $cusCity = "N/A";
         }
         
         
        
         echo "
            
                 <tr>
                    <td><img style='max-height: 60px; max-width: 60px; min-height: 60px; min-width: 60px; margin-left: auto;margin-right: auto; display: block;' src='../img/user/$cusImage'></td>
                    <td style='vertical-align: middle;'>$cusID</td>
                    <td style='vertical-align: middle;'>$cusFirstName</td>
                    <td style='vertical-align: middle;'>$cusLastName</td>
                    <td style='vertical-align: middle;'>$cusPhone</td>
                    <td style='vertical-align: middle;'>$cusNICNo</td>
                    <td style='vertical-align: middle;'>$cusCity</td>
                    <td style='vertical-align: middle;'>$cusEmailAddress</td>
                    <td style='vertical-align: middle;' class = 'text-center'>
                        <button type='button' name='btnViewCustomer' class='btn btn-primary btn-sm btn-rounded waves-effect waves-light viewCustomerDetails' id='$cusID'>View Details</button>
                        
                    </td>
                   
                </tr>
         
         ";
    }
    
}


function getAllCatogoriesDetails(){
    
    global $db;
    
    $getCatogoriesQuery = "select * from tbl_category";
    $queryCatResults = mysqli_query($db,$getCatogoriesQuery);
     while($row_Catogory=mysqli_fetch_array($queryCatResults)){
         
         $catID = $row_Catogory['cat_id'];
         $catName = $row_Catogory['cat_name'];
        $catImage = $row_Catogory['cat_icon'];
         
         $getAllProducts = "SELECT COUNT(*)as proCount FROM `tbl_product` WHERE cat_id='$catID';";
         $getProductCountResult = mysqli_query($db,$getAllProducts);
         $productCountDetails = mysqli_fetch_assoc($getProductCountResult);
         $productCount = $productCountDetails['proCount'];
         if($productCount == 0)
         {
             $countValue = "N/A";
         }
         else
         {
             $countValue = $productCount;
         }
        
         echo "
            
                 <tr>
                    <td><img style='max-height: 60px; max-width: 60px; min-height: 60px; min-width: 60px; margin-left: auto;margin-right: auto; display: block;' src='../img/catogoryLogo/$catImage'></td>
                    <td style='vertical-align: middle;'>$catID</td>
                    <td style='vertical-align: middle;'>$catName</td>
                    <td style='vertical-align: middle;'>$countValue</td>
                    <td style='vertical-align: middle; text-align:center;'>
                    <form method='post' action=''>
                        <input type='text' value='$catID' name='txtCatID' hidden />
                        <button type='submit' name='btnDelCat' class='btn btn-danger btn-sm btn-rounded waves-effect waves-light'>Delete</button>
                       
                        
                    </form> 
                    </td>
                </tr>
         
         ";
    }
}
function getcharts()
{  global $db;
    
       
       $getCatogoriesQuery = "select * from tbl_category";
    $queryCatResults = mysqli_query($db,$getCatogoriesQuery);
     while($row_Catogory=mysqli_fetch_array($queryCatResults)){
         
         $catID = $row_Catogory['cat_id'];
         $catName = $row_Catogory['cat_name'];
        $catImage = $row_Catogory['cat_icon'];
         
         $getAllProducts = "SELECT COUNT(*)as proCount FROM `tbl_product` WHERE cat_id='$catID';";
         $getProductCountResult = mysqli_query($db,$getAllProducts);
         $productCountDetails = mysqli_fetch_assoc($getProductCountResult);
         $productCount = $productCountDetails['proCount'];
    
           $countValue = $productCount;
        
        echo "['".$catName ."',". $countValue."],";
         
         
         
         
         
         
         
         
     
    
    
}



}
function getTotalOrders()
{
    global $db;
    $getAllOrdersQuery = "SELECT COUNT(*) as ordersCount FROM `tbl_sales_order`";
    $allOrdersCount = mysqli_query($db,$getAllOrdersQuery);
    $coutOfOrders = mysqli_fetch_assoc($allOrdersCount);
    $orders_Count = $coutOfOrders['ordersCount'];
    if($orders_Count == null || $orders_Count == "")
    {
        $orders_Count = "0";
    }
    echo "$orders_Count";
}
function getTotalProducts()
{    global $db;
    $getAllProductQuery = "SELECT COUNT(*) as proCount FROM `tbl_product`";
    $allproductCount = mysqli_query($db,$getAllProductQuery);
    $coutOfProducts = mysqli_fetch_assoc($allproductCount);
    $pro_Count = $coutOfProducts['proCount'];
    if($pro_Count == null || $pro_Count == "")
    {
        $pro_Count = "0";
    }
    echo "$pro_Count";
}
function getTotalCustomers()
{
     global $db;
    $getAllCustomerQuery = "SELECT COUNT(*) as cusCount FROM `tbl_customer`";
    $allCusCount = mysqli_query($db,$getAllCustomerQuery);
    $coutOfCustomers = mysqli_fetch_assoc($allCusCount);
    $cus_Count = $coutOfCustomers['cusCount'];
    if($cus_Count == null || $cus_Count == "")
    {
        $cus_Count = "0";
    }
    echo "$cus_Count";
}

function citypiliyandala()
    
{global $db;
    
    $query="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='piliyandala' AND `order_status`=4";
     $queryResults = mysqli_query($db,$query);
     $row_Catogory=mysqli_fetch_array($queryResults);
    
     $re= $row_Catogory['tot'];
    echo"  $re ";
     
     
}

function progressPiliyandala(){
    global $db;
    $queryCountTotSales="SELECT COUNT(`cus_city`)as tot FROM tbl_sales_order WHERE `order_status`=4";
     $queryResultsTotSales = mysqli_query($db,$queryCountTotSales);
     $row_sales=mysqli_fetch_array($queryResultsTotSales);
    
     $totSales= $row_sales['tot'];
    
    $querySaleCities="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='piliyandala' AND `order_status`=4";
     $queryResultsTotalSalesCities = mysqli_query($db,$querySaleCities);
     $row_City=mysqli_fetch_array($queryResultsTotalSalesCities);
    
     $totPiliyandala = $row_City['tot'];
    
    $salesPercent = ($totPiliyandala/$totSales)*100;
    echo "$salesPercent";
    
    
    
    
}

function progressKesbawa(){
    
    global $db;
    $queryCountTotSales="SELECT COUNT(`cus_city`)as tot FROM tbl_sales_order WHERE `order_status`=4";
     $queryResultsTotSales = mysqli_query($db,$queryCountTotSales);
     $row_sales=mysqli_fetch_array($queryResultsTotSales);
    
     $totSales= $row_sales['tot'];
    
    $querySaleCities="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='Kesbewa' AND `order_status`=4";
     $queryResultsTotalSalesCities = mysqli_query($db,$querySaleCities);
     $row_City=mysqli_fetch_array($queryResultsTotalSalesCities);
    
     $totKesbewa = $row_City['tot'];
    $salesPercent = ($totKesbewa/$totSales)*100;
    echo "$salesPercent";
    
}

function progressBorelasgamuwa(){
    
     global $db;
    $queryCountTotSales="SELECT COUNT(`cus_city`)as tot FROM tbl_sales_order WHERE `order_status`=4";
     $queryResultsTotSales = mysqli_query($db,$queryCountTotSales);
     $row_sales=mysqli_fetch_array($queryResultsTotSales);
    
     $totSales= $row_sales['tot'];
    
    $querySaleCities="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='Boralasgamuwa' AND `order_status`=4";
     $queryResultsTotalSalesCities = mysqli_query($db,$querySaleCities);
     $row_City=mysqli_fetch_array($queryResultsTotalSalesCities);
    
     $totBoralasgamuwa = $row_City['tot'];
    
    
    $salesPercent = ($totBoralasgamuwa/$totSales)*100;
    echo "$salesPercent";
    
}

function progressMoratuwa(){
    
    global $db;
    $queryCountTotSales="SELECT COUNT(`cus_city`)as tot FROM tbl_sales_order WHERE `order_status`=4";
     $queryResultsTotSales = mysqli_query($db,$queryCountTotSales);
     $row_sales=mysqli_fetch_array($queryResultsTotSales);
    
     $totSales= $row_sales['tot'];
    
    $querySaleCities="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='Moratuwa' AND `order_status`=4";
     $queryResultsTotalSalesCities = mysqli_query($db,$querySaleCities);
     $row_City=mysqli_fetch_array($queryResultsTotalSalesCities);
    
     $totMoratuwa = $row_City['tot'];
    
    
    $salesPercent = ($totMoratuwa/$totSales)*100;
    echo "$salesPercent";
    
}


function cityKesbewa()
    
{global $db;
    
    $query="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='Kesbewa' AND `order_status`=4";
     $queryResults = mysqli_query($db,$query);
     $row_Catogory=mysqli_fetch_array($queryResults);
    
     $re= $row_Catogory['tot'];
    echo"  $re ";
     
     
}
function cityMoratuwa()
    
{global $db;
    
    $query="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='Moratuwa' AND `order_status`=4";
     $queryResults = mysqli_query($db,$query);
     $row_Catogory=mysqli_fetch_array($queryResults);
    
     $re= $row_Catogory['tot'];
    echo"  $re ";
     
     
}
function cityBoralasgamuwa()
    
{global $db;
    
    $query="SELECT COUNT(`s_orderId`)as tot FROM tbl_sales_order WHERE `cus_city`='Boralasgamuwa' AND `order_status`=4";
     $queryResults = mysqli_query($db,$query);
     $row_Catogory=mysqli_fetch_array($queryResults);
    
     $re= $row_Catogory['tot'];
    echo"  $re ";
     
     
}
function citytot()
    
{global $db;
    
    $query="SELECT COUNT(`cus_city`)as tot FROM tbl_sales_order WHERE `order_status`=4";
     $queryResults = mysqli_query($db,$query);
     $row_Catogory=mysqli_fetch_array($queryResults);
    
     $re= $row_Catogory['tot'];
    echo"  $re ";
     
     
}





function getChartsDetails($year)
{
    $yearRecords = $year;
    $conChart = mysqli_connect("localhost","root","","dayaStore");
    
    $janMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=1 AND `order_status`=4 ORDER by `s_orderId`";
    $getJanTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$janMonthSalesQuery));
    $jan = $getJanTotSales['profit'];
    if($jan == null || $jan == "")
    {
        $jan = 0;
    }
    
    $janMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=1 AND `return_status`=4 ORDER by `s_returnId`";
    $getJanTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$janMonthReturnQuery));
    $janReturn = $getJanTotReturn['returns'];
    if($janReturn == null || $janReturn == "")
    {
        $janReturn = 0;
    }
    
    $febMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=2 AND `order_status`=4 ORDER by `s_orderId`";
    $getFebTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$febMonthSalesQuery));
    $feb = $getFebTotSales['profit'];
    if($feb == null || $feb == "")
    {
        $feb = 0;
    }
    
    $febMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=2 AND `return_status`=4 ORDER by `s_returnId`";
    $getFebTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$febMonthReturnQuery));
    $febReturn = $getFebTotReturn['returns'];
    if($febReturn == null || $febReturn == "")
    {
        $febReturn = 0;
    }
    
    $marMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=3 AND `order_status`=4 ORDER by `s_orderId`";
    $getMarTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$marMonthSalesQuery));
    $mar = $getMarTotSales['profit'];
    if($mar == null || $mar == "")
    {
        $mar = 0;
    }
    
    
    $marMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=3 AND `return_status`=4 ORDER by `s_returnId`";
    $getMarTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$marMonthReturnQuery));
    $marReturn = $getMarTotReturn['returns'];
    if($marReturn == null || $marReturn == "")
    {
        $marReturn = 0;
    }
    
    $aprMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=4 AND `order_status`=4 ORDER by `s_orderId`";
    $getAprTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$aprMonthSalesQuery));
    $apr = $getAprTotSales['profit'];
    if($apr == null || $apr == "")
    {
        $apr = 0;
    }
    
    $aprMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=4 AND `return_status`=4 ORDER by `s_returnId`";
    $getAprTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$aprMonthReturnQuery));
    $aprReturn = $getAprTotReturn['returns'];
    if($aprReturn == null || $aprReturn == "")
    {
        $aprReturn = 0;
    }
    
    $mayMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=5 AND `order_status`=4 ORDER by `s_orderId`";
    $getMayTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$mayMonthSalesQuery));
    $may = $getMayTotSales['profit'];
    if($may == null || $may == "")
    {
        $may = 0;
    }
    
    $mayMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=5 AND `return_status`=4 ORDER by `s_returnId`";
    $getMayTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$mayMonthReturnQuery));
    $mayReturn = $getMayTotReturn['returns'];
    if($mayReturn == null || $mayReturn == "")
    {
        $mayReturn = 0;
    }
    
    $junMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=6 AND `order_status`=4 ORDER by `s_orderId`";
    $getJunTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$junMonthSalesQuery));
    $jun = $getJunTotSales['profit'];
    if($jun == null || $jun == "")
    {
        $jun = 0;
    }
    
    $junMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=6 AND `return_status`=4 ORDER by `s_returnId`";
    $getJunTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$junMonthReturnQuery));
    $junReturn = $getJunTotReturn['returns'];
    if($junReturn == null || $junReturn == "")
    {
        $junReturn = 0;
    }
    
    $julyMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=7 AND `order_status`=4 ORDER by `s_orderId`";
    $getJulTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$julyMonthSalesQuery));
    $july = $getJulTotSales['profit'];
    if($july == null || $july == "")
    {
        $july = 0;
    }
    
    $julyMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=7 AND `return_status`=4 ORDER by `s_returnId`";
    $getJulTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$julyMonthReturnQuery));
    $julyReturn = $getJulTotReturn['returns'];
    if($julyReturn == null || $julyReturn == "")
    {
        $julyReturn = 0;
    }
    
    $augMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=8 AND `order_status`=4 ORDER by `s_orderId`";
    $getAugTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$augMonthSalesQuery));
    $aug = $getAugTotSales['profit'];
    if($aug == null || $aug == "")
    {
        $aug = 0;
    }
    
    $augMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=8 AND `return_status`=4 ORDER by `s_returnId`";
    $getAugTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$augMonthReturnQuery));
    $augReturn = $getAugTotReturn['returns'];
    if($augReturn == null || $augReturn == "")
    {
        $augReturn = 0;
    }
    $sepMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=9 AND `order_status`=4 ORDER by `s_orderId`";
    $getSepTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$sepMonthSalesQuery));
    $sep = $getSepTotSales['profit'];
    if($sep == null || $sep == "")
    {
        $sep = 0;
    }
     
    $sepMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=9 AND `return_status`=4 ORDER by `s_returnId`";
    $getSepTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$sepMonthReturnQuery));
    $sepReturn = $getSepTotReturn['returns'];
    if($sepReturn == null || $sepReturn == "")
    {
        $sepReturn = 0;
    }
    
    $octMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=10 AND `order_status`=4 ORDER by `s_orderId`";
    $getOctTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$octMonthSalesQuery));
    $oct = $getOctTotSales['profit'];
    if($oct == null || $oct == "")
    {
        $oct = 0;
    }
     
    $octMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=10 AND `return_status`=4 ORDER by `s_returnId`";
    $getOctTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$octMonthReturnQuery));
    $octReturn = $getOctTotReturn['returns'];
    if($octReturn == null || $octReturn == "")
    {
        $octReturn = 0;
    }
    
    $novMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=11 AND `order_status`=4 ORDER by `s_orderId`";
    $getNovTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$novMonthSalesQuery));
    $nov = $getNovTotSales['profit'];
    if($nov == null || $nov == "")
    {
        $nov = 0;
    }
     
    $novMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=11 AND `return_status`=4 ORDER by `s_returnId`";
    $getNovTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$novMonthReturnQuery));
    $novReturn = $getNovTotReturn['returns'];
    if($novReturn == null || $novReturn == "")
    {
        $novReturn = 0;
    }
    
    $decMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=12 AND `order_status`=4 ORDER by `s_orderId`";
    $getDecTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$decMonthSalesQuery));
    $dec = $getDecTotSales['profit'];
    if($dec == null || $dec == "")
    {
        $dec = 0;
    }
    
    $decMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=12 AND `return_status`=4 ORDER by `s_returnId`";
    $getDecTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$decMonthReturnQuery));
    $decReturn = $getDecTotReturn['returns'];
    if($decReturn == null || $decReturn == "")
    {
        $decReturn = 0;
    }
    
    if($jan == 0 && $feb == 0 && $mar == 0 && $apr == 0 && $may == 0 && $jun == 0 && $july == 0 && $aug == 0 && $sep == 0 && $oct == 0 &&  $nov == 0 && $dec == 0 &&  $janReturn == 0 && $febReturn == 0 && $marReturn == 0 && $aprReturn == 0 && $mayReturn == 0 && $junReturn == 0 && $julyReturn == 0 && $augReturn == 0 && $sepReturn == 0 && $octReturn == 0 && $novReturn == 0 && $decReturn == 0)
    {
        $chartTitle = "No any Monthly Sales and Return Report available for year $yearRecords";
    }
    else
    {
        $chartTitle = "Monthly Sales and Return Report $yearRecords";
    }
    
    echo "
            <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
                    <script type='text/javascript'>
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawVisualization);

                      function drawVisualization() {
                        // Some raw data (not necessarily accurate)
                        var data = google.visualization.arrayToDataTable([
                        
                          ['Catogories', 'Sales', 'Returns'],
                          ['Jan',  $jan, $janReturn],
                          ['Feb',  $feb, $febReturn],
                          ['Mar',  $mar, $marReturn],
                          ['Apr',  $apr, $aprReturn],
                          ['May',  $may, $mayReturn],
                          ['Jun',  $jun, $junReturn],
                          ['Jul',  $july, $julyReturn],
                          ['Aug',  $aug, $augReturn],
                          ['Sep',  $sep, $sepReturn],
                          ['Oct',  $oct, $octReturn],
                          ['Nov',  $nov, $novReturn],
                          ['Dec',  $dec, $decReturn]
                        ]);

                        var options = {
                          title : '$chartTitle',
                          vAxis: {title: 'Sales / Returns'},
                          hAxis: {title: 'Month'},
                          seriesType: 'bars',
                          series: {5: {type: 'line'}}        };

                        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                        chart.draw(data, options);
                      }
                    </script>
                <div id='chart_div' style='width: 100%; height: 500px;'></div>
            
    
    
    ";
}

function getAllNewOrders()
{
    global $db;
    $getAllNewOrdersQuery = "SELECT * FROM `tbl_sales_order` WHERE order_status = '1' order BY order_date ASC";
    $allNewOrders = mysqli_query($db,$getAllNewOrdersQuery);
    
    while($newOrderRecord = mysqli_fetch_array($allNewOrders))
    {
        $orderId = $newOrderRecord['s_orderId'];
        $cart_Id = $newOrderRecord['c_id'];
        $orderFCusName = $newOrderRecord['cus_fname'];
        $orderLCusName = $newOrderRecord['cus_lname'];
        $orderContactNo = $newOrderRecord['cus_tele'];
        $orderCity = $newOrderRecord['cus_city'];
        $orderDate = $newOrderRecord['order_date'];
        $orderTotal = $newOrderRecord['total'];
        
        $getPayMethod = "SELECT `method` FROM `tbl_payment` WHERE `s_orderId` = '$orderId'";
        $payResults = mysqli_query($db,$getPayMethod);
        $paymentDetails = mysqli_fetch_assoc($payResults);
        $orderPaymentMeth = $paymentDetails['method'];
        if($orderPaymentMeth == "Cash On Delivery")
        {
            $btnColor = "badge-soft-warning";
        }
        else
        {
            $btnColor = "badge-soft-success";
        }
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$orderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    <td style='vertical-align: middle;'><span class='badge badge-pill $btnColor font-size-12'>$orderPaymentMeth</span></td>
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>LKR $orderTotal</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$cart_Id' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewOrderDetails'>View Order</button>
                                        
                                    </td>
                                    <td>
                                    <form method='post' action=''>
                                        <input type='text' value='$orderId' name='txtProdID' hidden />
                                        <button id='$orderId' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light acceptOrder'>Accept Order</button>

                                        <button type='button' name='btnViewProduct' class='btn btn-danger btn-sm btn-rounded waves-effect waves-light viewProductDetails declineOrder' id='$orderId'>Decline Order</button>
                                        </form> 
                                    </td>
        
        </tr>
        
        ";
        
        
        
    }
}


function getAllAcceptedOrders()
{
    global $db;
    $getAllAcceptedOrdersQuery = "SELECT * FROM `tbl_sales_order` WHERE order_status = '2' order BY order_date ASC";
    $allAcceptedOrders = mysqli_query($db,$getAllAcceptedOrdersQuery);
    
    while($acceptedOrderRecord = mysqli_fetch_array($allAcceptedOrders))
    {
        $orderId = $acceptedOrderRecord['s_orderId'];
        $cart_Id = $acceptedOrderRecord['c_id'];
        $orderFCusName = $acceptedOrderRecord['cus_fname'];
        $orderLCusName = $acceptedOrderRecord['cus_lname'];
        $orderContactNo = $acceptedOrderRecord['cus_tele'];
        $orderCity = $acceptedOrderRecord['cus_city'];
        $orderDate = $acceptedOrderRecord['order_date'];
        $orderTotal = $acceptedOrderRecord['total'];
        
        $getPayMethod = "SELECT `method` FROM `tbl_payment` WHERE `s_orderId` = '$orderId'";
        $payResults = mysqli_query($db,$getPayMethod);
        $paymentDetails = mysqli_fetch_assoc($payResults);
        $orderPaymentMeth = $paymentDetails['method'];
        if($orderPaymentMeth == "Cash On Delivery")
        {
            $btnColor = "badge-soft-warning";
        }
        else
        {
            $btnColor = "badge-soft-success";
        }
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$orderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    <td style='vertical-align: middle;'><span class='badge badge-pill $btnColor font-size-12'>$orderPaymentMeth</span></td>
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>LKR $orderTotal</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$cart_Id' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewOrderDetails'>View Order</button>
                                        
                                    </td>
                                    <td>
                                    <form method='post' action=''>
                                        <input type='text' value='$orderId' name='txtProdID' hidden />
                                        <button id='$orderId' type='button' name='btnEditProduct' class='btn btn-warning btn-sm btn-rounded waves-effect waves-light deliverdOrder'>Order Delivered</button>

                                        
                                        </form> 
                                    </td>
        
        </tr>
        
        ";
        
        
        
    }
}


function getAllDeliveredOrders()
{
    global $db;
    $getAllDeliveredOrdersQuery = "SELECT * FROM `tbl_sales_order` WHERE order_status = '3' order BY order_date ASC";
    $allDeliveredOrders = mysqli_query($db,$getAllDeliveredOrdersQuery);
    
    while($deliveredOrderRecord = mysqli_fetch_array($allDeliveredOrders))
    {
        $orderId = $deliveredOrderRecord['s_orderId'];
        $cart_Id = $deliveredOrderRecord['c_id'];
        $orderFCusName = $deliveredOrderRecord['cus_fname'];
        $orderLCusName = $deliveredOrderRecord['cus_lname'];
        $orderContactNo = $deliveredOrderRecord['cus_tele'];
        $orderCity = $deliveredOrderRecord['cus_city'];
        $orderDate = $deliveredOrderRecord['order_date'];
        $orderTotal = $deliveredOrderRecord['total'];
        
        $getPayMethod = "SELECT `method` FROM `tbl_payment` WHERE `s_orderId` = '$orderId'";
        $payResults = mysqli_query($db,$getPayMethod);
        $paymentDetails = mysqli_fetch_assoc($payResults);
        $orderPaymentMeth = $paymentDetails['method'];
        if($orderPaymentMeth == "Cash On Delivery")
        {
            $btnColor = "badge-soft-warning";
        }
        else
        {
            $btnColor = "badge-soft-success";
        }
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$orderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    <td style='vertical-align: middle;'><span class='badge badge-pill $btnColor font-size-12'>$orderPaymentMeth</span></td>
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>LKR $orderTotal</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$cart_Id' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewOrderDetails'>View Order</button>
                                        
                                    </td>
                                    <td>
                                    <form method='post' action=''>
                                        <input type='text' value='$orderId' name='txtProdID' hidden />
                                        <button id='$orderId' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light completedOrder'>Complete Order</button>

                                        <button type='button' name='btnViewProduct' class='btn btn-danger btn-sm btn-rounded waves-effect waves-light viewProductDetails cancelOrder' id='$orderId'>Cancel Order</button>
                                        </form> 
                                    </td>
        
        </tr>
        
        ";
        
        
        
    }
}

function getAllCompletedOrders()
{
    global $db;
    $getAllCompletedOrdersQuery = "SELECT * FROM `tbl_sales_order` WHERE order_status = '4' order BY order_date DESC";
    $allCompletedOrders = mysqli_query($db,$getAllCompletedOrdersQuery);
    
    while($completeOrderRecord = mysqli_fetch_array($allCompletedOrders))
    {
        $orderId = $completeOrderRecord['s_orderId'];
        $cart_Id = $completeOrderRecord['c_id'];
        $orderFCusName = $completeOrderRecord['cus_fname'];
        $orderLCusName = $completeOrderRecord['cus_lname'];
        $orderContactNo = $completeOrderRecord['cus_tele'];
        $orderCity = $completeOrderRecord['cus_city'];
        $orderDate = $completeOrderRecord['order_date'];
        $orderTotal = $completeOrderRecord['total'];
        
        $getPayMethod = "SELECT `method` FROM `tbl_payment` WHERE `s_orderId` = '$orderId'";
        $payResults = mysqli_query($db,$getPayMethod);
        $paymentDetails = mysqli_fetch_assoc($payResults);
        $orderPaymentMeth = $paymentDetails['method'];
        if($orderPaymentMeth == "Cash On Delivery")
        {
            $btnColor = "badge-soft-warning";
        }
        else
        {
            $btnColor = "badge-soft-success";
        }
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$orderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    <td style='vertical-align: middle;'><span class='badge badge-pill $btnColor font-size-12'>$orderPaymentMeth</span></td>
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>LKR $orderTotal</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$cart_Id' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewOrderDetails'>View Order</button>
                                        
                                    </td>
                                    
        
        </tr>
        
        ";
        
        
        
    }
}

function getAllRejectedOrders()
{
    global $db;
    $getAllRejectedOrdersQuery = "SELECT * FROM `tbl_sales_order` WHERE order_status = '5' order BY order_date DESC";
    $allRejectedOrders = mysqli_query($db,$getAllRejectedOrdersQuery);
    
    while($rejectedOrderRecord = mysqli_fetch_array($allRejectedOrders))
    {
        $orderId = $rejectedOrderRecord['s_orderId'];
        $cart_Id = $rejectedOrderRecord['c_id'];
        $orderFCusName = $rejectedOrderRecord['cus_fname'];
        $orderLCusName = $rejectedOrderRecord['cus_lname'];
        $orderContactNo = $rejectedOrderRecord['cus_tele'];
        $orderCity = $rejectedOrderRecord['cus_city'];
        $orderDate = $rejectedOrderRecord['order_date'];
        $orderTotal = $rejectedOrderRecord['total'];
        
        $getPayMethod = "SELECT `method` FROM `tbl_payment` WHERE `s_orderId` = '$orderId'";
        $payResults = mysqli_query($db,$getPayMethod);
        $paymentDetails = mysqli_fetch_assoc($payResults);
        $orderPaymentMeth = $paymentDetails['method'];
        if($orderPaymentMeth == "Cash On Delivery")
        {
            $btnColor = "badge-soft-warning";
        }
        else
        {
            $btnColor = "badge-soft-success";
        }
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$orderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    <td style='vertical-align: middle;'><span class='badge badge-pill $btnColor font-size-12'>$orderPaymentMeth</span></td>
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>LKR $orderTotal</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$cart_Id' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewOrderDetails'>View Order</button>
                                        
                                    </td>
                                    
        
        </tr>
        
        ";
        
        
        
    }
}

function getAllPayments()
{
    global $db;
    $getAllPaymentsQuery = "SELECT `pay_id`, `pay_date`, `method`, `s_orderId`, `pay_status`, `total` FROM `tbl_payment` order BY pay_date DESC";
    $allPaymentOrders = mysqli_query($db,$getAllPaymentsQuery);
    
    while($paymentOrderRecord = mysqli_fetch_array($allPaymentOrders))
    {
        $payId = $paymentOrderRecord['pay_id'];
        $pay_date = $paymentOrderRecord['pay_date'];
        $orderPaymentMeth = $paymentOrderRecord['method'];
        $orderId = $paymentOrderRecord['s_orderId'];
        $payStatus = $paymentOrderRecord['pay_status'];
        $payTotal = $paymentOrderRecord['total'];
        
        
        if($orderPaymentMeth == "Cash On Delivery")
        {
            $btnColor = "badge-soft-warning";
        }
        else
        {
            $btnColor = "badge-soft-info";
        }
        
        $getCutomerDetailsQuery = "SELECT `cus_fname`, `cus_lname`, `cus_tele`  FROM `tbl_sales_order` WHERE `s_orderId` = '$orderId'";
        $customerResults = mysqli_query($db,$getCutomerDetailsQuery);
        $customerFetchedResults = mysqli_fetch_array($customerResults);
        
        $customerFName = $customerFetchedResults['cus_fname'];
        $customerLName = $customerFetchedResults['cus_lname'];
        $cusTele = $customerFetchedResults['cus_tele'];
        
        if($payStatus == "Paid")
        {
            $colorCode = "badge-soft-success";
        }
        else if($payStatus == "Pending..")
        {
            $colorCode = "badge-soft-primary";
        }
        else if($payStatus == "Canceled")
        {
            $colorCode = "badge-soft-danger";
        }
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$payId</td>
                                    <td style='vertical-align: middle;'>$orderId</td>
                                    <td style='vertical-align: middle;'>$customerFName $customerLName</td>
                                    <td style='vertical-align: middle;'>$cusTele</td>
                                    <td style='vertical-align: middle;'>$pay_date</td>
                                    <td style='vertical-align: middle;'><span class='badge badge-pill $btnColor font-size-12'>$orderPaymentMeth</span></td>
                                    <td style='vertical-align: middle;'><span class='badge badge-pill $colorCode font-size-12'>$payStatus</span></td>
                                    
                                    
                                    
                                    <td style='vertical-align: middle;'>LKR $payTotal</td>
                                    
                                    
        
        </tr>
        
        ";
        
        
        
    }
}

function getNewOrdersNotification()
{
    global $db;
    $getAllNewOrdersNotificationQuery = "SELECT COUNT(*) as newOrders FROM `tbl_sales_order` WHERE `order_status` = 1";
    $allNotificationOrdersCount = mysqli_query($db,$getAllNewOrdersNotificationQuery);
    $coutOfNewOrders = mysqli_fetch_assoc($allNotificationOrdersCount);
    $newOrdersCount = $coutOfNewOrders['newOrders'];
    if($newOrdersCount == null || $newOrdersCount == "")
    {
        $newOrdersCount = "0";
    }
    echo "$newOrdersCount";
}


function printBillPdf($cartId)
{
    global $db;
    
    $allCartProducts = "SELECT * FROM `tbl_cart` WHERE `c_id` = '$cartId'";
    $cartResults = mysqli_query($db,$allCartProducts);
    
    $getOrderDetails = "SELECT DATE_FORMAT(order_date,'%d %M %Y') as date,`s_orderId`,`cus_fname`,`cus_lname`,`cus_address`,`cus_city` FROM tbl_sales_order WHERE `c_id` = '$cartId'";
    $getOrderRowDetails = mysqli_fetch_array(mysqli_query($db,$getOrderDetails));
    
    $cusFName = $getOrderRowDetails['cus_fname'];
    $cusLName = $getOrderRowDetails['cus_lname'];
    $orderID = $getOrderRowDetails['s_orderId'];
    $cusAddress = $getOrderRowDetails['cus_address'];
    $cusCity = $getOrderRowDetails['cus_city'];
    $orderDate = $getOrderRowDetails['date'];
     $output = '
            
                    <div class="row">    
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <h4 class="float-right font-size-16">Order # '.$orderID.'</h4>
                                            <div class="mb-4">
                                                <img src="assets/images/Daya.png" alt="logo" height="45"/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="py-2 mt-3" style="width: 210px;">
                                            <h3 class="font-size-15 font-weight-bold">Billed To:</h3>
                                            <h6>'.$cusFName.' '.$cusLName.'</h6>
                                            <h6 style="word-wrap: break-word;">'.$cusAddress.'</h6>
                                            <h6>'.$cusCity.'</h6>
                                            <h6>Sri Lanka</h6>
                                            <h6>Order Date : '.$orderDate.'</h6>
                                        </div>
                                        
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th>Product</th>
                                                        <th class="text-center">Unit Price</th>
                                                        <th class="text-center">Qty.</th>
                                                        <th class="text-right">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
     ';
    $cartTotal = 0;
    $cartItemCount = 1 ;
    while($rowProduct = mysqli_fetch_array($cartResults))
    {
        $proId = $rowProduct["product_id"];
        $getproductDetails = "SELECT pro_name FROM `tbl_product` WHERE pro_id = '$proId'";
        
        $getRowProductName = mysqli_fetch_array(mysqli_query($db,$getproductDetails));
        $proName = $getRowProductName['pro_name'];
        
        $unitPrice = $rowProduct["total"] / $rowProduct["quantity"];
        
         $output .= '
           
           <tr>
                <td>'.$cartItemCount.'</td>
                <td>'.$rowProduct["product_id"].' - '.$proName.'</td>
                <td class="text-center">'.$unitPrice.'</td>
                <td class="text-center">'.$rowProduct["quantity"].'</td>
                <td class="text-right">'.$rowProduct["total"].'</td>
            </tr>
           
           
        ';
        $cartItemCount = $cartItemCount + 1;
        $cartTotal =$cartTotal + $rowProduct['total'];
    }
    
     $output .= '
  <tr>
                                                        <td colspan="4" class="text-right">Sub Total</td>
                                                        <td class="text-right">LKR '.$cartTotal.'</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td colspan="4" class="border-0 text-right">
                                                            <strong>Total</strong></td>
                                                        <td class="border-0 text-right"><h4 class="m-0">LKR '.$cartTotal.'</h4></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                </div>
           
 ';
 return $output;
    
    
    
    
}



function getAllReturnNewOrders()
{
    global $db;
    $getAllNewReturnOrdersQuery = "SELECT `s_orderId`, `return_date` FROM `tbl_sales_return` WHERE `return_status` = '1' GROUP BY `s_orderId` ORDER BY `return_date` ASC";
    $allNewReturnOrders = mysqli_query($db,$getAllNewReturnOrdersQuery);
    
    while($newOrderReturnRecord = mysqli_fetch_array($allNewReturnOrders))
    {
        
        $salesOrderId = $newOrderReturnRecord['s_orderId'];
        $returnDate = $newOrderReturnRecord['return_date'];
        
        $getOrderDetails = "SELECT * FROM `tbl_sales_order` WHERE `s_orderId` = '$salesOrderId'";
        $OrderDetailResults = mysqli_query($db,$getOrderDetails);
        $fetchReturnOrder = mysqli_fetch_array($OrderDetailResults);
        $orderFCusName = $fetchReturnOrder['cus_fname'];
        $orderLCusName = $fetchReturnOrder['cus_lname'];
        $orderContactNo = $fetchReturnOrder['cus_tele'];
        $orderCity = $fetchReturnOrder['cus_city'];
        $orderDate = $fetchReturnOrder['order_date'];
        
        
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$salesOrderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>$returnDate</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$salesOrderId' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewReturnOrderDetails'>View Order</button>
                                        
                                    </td>
                                    <td>
                                    <form method='post' action=''>
                                        <input type='text' value='$salesOrderId' name='txtProdID' hidden />
                                        <button id='$salesOrderId' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light acceptReturnOrder'>Accept Order</button>

                                        <button type='button' name='btnViewProduct' class='btn btn-danger btn-sm btn-rounded waves-effect waves-light viewProductDetails declineReturnOrder' id='$salesOrderId'>Decline Order</button>
                                        </form> 
                                    </td>
        
        </tr>
        
        ";
        
        
        
    }
}


function getAllReturnAcceptOrders()
{
    global $db;
    $getAllNewReturnOrdersQuery = "SELECT `s_orderId`, `return_date` FROM `tbl_sales_return` WHERE `return_status` = '2' GROUP BY `s_orderId` ORDER BY `return_date` ASC";
    $allNewReturnOrders = mysqli_query($db,$getAllNewReturnOrdersQuery);
    
    while($newOrderReturnRecord = mysqli_fetch_array($allNewReturnOrders))
    {
        
        $salesOrderId = $newOrderReturnRecord['s_orderId'];
        $returnDate = $newOrderReturnRecord['return_date'];
        
        $getOrderDetails = "SELECT * FROM `tbl_sales_order` WHERE `s_orderId` = '$salesOrderId'";
        $OrderDetailResults = mysqli_query($db,$getOrderDetails);
        $fetchReturnOrder = mysqli_fetch_array($OrderDetailResults);
        $orderFCusName = $fetchReturnOrder['cus_fname'];
        $orderLCusName = $fetchReturnOrder['cus_lname'];
        $orderContactNo = $fetchReturnOrder['cus_tele'];
        $orderCity = $fetchReturnOrder['cus_city'];
        $orderDate = $fetchReturnOrder['order_date'];
        
        
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$salesOrderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>$returnDate</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$salesOrderId' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewReturnOrderDetails'>View Order</button>
                                        
                                    </td>
                                    <td>
                                    <form method='post' action=''>
                                        
                                        <input type='text' value='$salesOrderId' name='txtProdID' hidden />
                                        <button id='$salesOrderId' type='button' name='btnEditProduct' class='btn btn-warning btn-sm btn-rounded waves-effect waves-light deliverdReturnOrder'>Order Delivered</button>
                                        
                                        </form> 
                                    </td>
        
        </tr>
        
        ";
        
        
        
    }
}


function getAllReturnDeliveredOrders()
{
    global $db;
    $getAllNewReturnOrdersQuery = "SELECT `s_orderId`, `return_date` FROM `tbl_sales_return` WHERE `return_status` = '3' GROUP BY `s_orderId` ORDER BY `return_date` ASC";
    $allNewReturnOrders = mysqli_query($db,$getAllNewReturnOrdersQuery);
    
    while($newOrderReturnRecord = mysqli_fetch_array($allNewReturnOrders))
    {
        
        $salesOrderId = $newOrderReturnRecord['s_orderId'];
        $returnDate = $newOrderReturnRecord['return_date'];
        
        $getOrderDetails = "SELECT * FROM `tbl_sales_order` WHERE `s_orderId` = '$salesOrderId'";
        $OrderDetailResults = mysqli_query($db,$getOrderDetails);
        $fetchReturnOrder = mysqli_fetch_array($OrderDetailResults);
        $orderFCusName = $fetchReturnOrder['cus_fname'];
        $orderLCusName = $fetchReturnOrder['cus_lname'];
        $orderContactNo = $fetchReturnOrder['cus_tele'];
        $orderCity = $fetchReturnOrder['cus_city'];
        $orderDate = $fetchReturnOrder['order_date'];
        
        
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$salesOrderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>$returnDate</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$salesOrderId' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewReturnOrderDetails'>View Order</button>
                                        
                                    </td>
                                    <td>
                                    <form method='post' action=''>
                                        
                                        
                                         <input type='text' value='$salesOrderId' name='txtProdID' hidden />
                                        <button id='$salesOrderId' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light completedReturnOrder'>Complete Order</button>

                                        <button type='button' name='btnViewProduct' class='btn btn-danger btn-sm btn-rounded waves-effect waves-light viewProductDetails cancelReturnOrder' id='$salesOrderId'>Cancel Order</button>
                                        
                                        </form> 
                                    </td>
        
        </tr>
        
        ";
        
        
        
    }
}

function getAllReturnCompletedOrders()
{
    global $db;
    $getAllNewReturnOrdersQuery = "SELECT `s_orderId`, `return_date` FROM `tbl_sales_return` WHERE `return_status` = '4' GROUP BY `s_orderId` ORDER BY `return_date` DESC";
    $allNewReturnOrders = mysqli_query($db,$getAllNewReturnOrdersQuery);
    
    while($newOrderReturnRecord = mysqli_fetch_array($allNewReturnOrders))
    {
        
        $salesOrderId = $newOrderReturnRecord['s_orderId'];
        $returnDate = $newOrderReturnRecord['return_date'];
        
        $getOrderDetails = "SELECT * FROM `tbl_sales_order` WHERE `s_orderId` = '$salesOrderId'";
        $OrderDetailResults = mysqli_query($db,$getOrderDetails);
        $fetchReturnOrder = mysqli_fetch_array($OrderDetailResults);
        $orderFCusName = $fetchReturnOrder['cus_fname'];
        $orderLCusName = $fetchReturnOrder['cus_lname'];
        $orderContactNo = $fetchReturnOrder['cus_tele'];
        $orderCity = $fetchReturnOrder['cus_city'];
        $orderDate = $fetchReturnOrder['order_date'];
        
        
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$salesOrderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>$returnDate</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$salesOrderId' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewReturnOrderDetails'>View Order</button>
                                        
                                    </td>
                                    
        
        </tr>
        
        ";
        
        
        
    }
}


function getAllRejectedCompletedOrders()
{
    global $db;
    $getAllNewReturnOrdersQuery = "SELECT `s_orderId`, `return_date` FROM `tbl_sales_return` WHERE `return_status` = '5' GROUP BY `s_orderId` ORDER BY `return_date` DESC";
    $allNewReturnOrders = mysqli_query($db,$getAllNewReturnOrdersQuery);
    
    while($newOrderReturnRecord = mysqli_fetch_array($allNewReturnOrders))
    {
        
        $salesOrderId = $newOrderReturnRecord['s_orderId'];
        $returnDate = $newOrderReturnRecord['return_date'];
        
        $getOrderDetails = "SELECT * FROM `tbl_sales_order` WHERE `s_orderId` = '$salesOrderId'";
        $OrderDetailResults = mysqli_query($db,$getOrderDetails);
        $fetchReturnOrder = mysqli_fetch_array($OrderDetailResults);
        $orderFCusName = $fetchReturnOrder['cus_fname'];
        $orderLCusName = $fetchReturnOrder['cus_lname'];
        $orderContactNo = $fetchReturnOrder['cus_tele'];
        $orderCity = $fetchReturnOrder['cus_city'];
        $orderDate = $fetchReturnOrder['order_date'];
        
        
        
        
        
        echo "
                        <tr id='checkLocation'>
                            <td style='vertical-align: middle;'>$salesOrderId</td>
                                    <td style='vertical-align: middle;'>$orderFCusName $orderLCusName</td>
                                    <td style='vertical-align: middle;'>$orderContactNo</td>
                                    <td style='vertical-align: middle;'>$orderCity</td>
                                    
                                    <td style='vertical-align: middle;'>$orderDate</td>
                                    <td style='vertical-align: middle;'>$returnDate</td>
                                    <td style='vertical-align: middle;'>
                                        
                                        <button type='button' id='$salesOrderId' name='btnEditProduct' class='btn btn-info btn-sm btn-rounded waves-effect waves-light viewReturnOrderDetails'>View Order</button>
                                        
                                    </td>
                                    
        
        </tr>
        
        ";
        
        
        
    }
}




function getChartsDetailsSave($year)
{
    $yearRecords = $year;
    $conChart = mysqli_connect("localhost","root","","dayaStore");
    
    $janMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=1 AND `order_status`=4 ORDER by `s_orderId`";
    $getJanTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$janMonthSalesQuery));
    $jan = $getJanTotSales['profit'];
    if($jan == null || $jan == "")
    {
        $jan = 0;
    }
    
    $janMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=1 AND `return_status`=4 ORDER by `s_returnId`";
    $getJanTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$janMonthReturnQuery));
    $janReturn = $getJanTotReturn['returns'];
    if($janReturn == null || $janReturn == "")
    {
        $janReturn = 0;
    }
    
    $febMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=2 AND `order_status`=4 ORDER by `s_orderId`";
    $getFebTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$febMonthSalesQuery));
    $feb = $getFebTotSales['profit'];
    if($feb == null || $feb == "")
    {
        $feb = 0;
    }
    
    $febMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=2 AND `return_status`=4 ORDER by `s_returnId`";
    $getFebTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$febMonthReturnQuery));
    $febReturn = $getFebTotReturn['returns'];
    if($febReturn == null || $febReturn == "")
    {
        $febReturn = 0;
    }
    
    $marMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=3 AND `order_status`=4 ORDER by `s_orderId`";
    $getMarTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$marMonthSalesQuery));
    $mar = $getMarTotSales['profit'];
    if($mar == null || $mar == "")
    {
        $mar = 0;
    }
    
    
    $marMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=3 AND `return_status`=4 ORDER by `s_returnId`";
    $getMarTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$marMonthReturnQuery));
    $marReturn = $getMarTotReturn['returns'];
    if($marReturn == null || $marReturn == "")
    {
        $marReturn = 0;
    }
    
    $aprMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=4 AND `order_status`=4 ORDER by `s_orderId`";
    $getAprTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$aprMonthSalesQuery));
    $apr = $getAprTotSales['profit'];
    if($apr == null || $apr == "")
    {
        $apr = 0;
    }
    
    $aprMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=4 AND `return_status`=4 ORDER by `s_returnId`";
    $getAprTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$aprMonthReturnQuery));
    $aprReturn = $getAprTotReturn['returns'];
    if($aprReturn == null || $aprReturn == "")
    {
        $aprReturn = 0;
    }
    
    $mayMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=5 AND `order_status`=4 ORDER by `s_orderId`";
    $getMayTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$mayMonthSalesQuery));
    $may = $getMayTotSales['profit'];
    if($may == null || $may == "")
    {
        $may = 0;
    }
    
    $mayMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=5 AND `return_status`=4 ORDER by `s_returnId`";
    $getMayTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$mayMonthReturnQuery));
    $mayReturn = $getMayTotReturn['returns'];
    if($mayReturn == null || $mayReturn == "")
    {
        $mayReturn = 0;
    }
    
    $junMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=6 AND `order_status`=4 ORDER by `s_orderId`";
    $getJunTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$junMonthSalesQuery));
    $jun = $getJunTotSales['profit'];
    if($jun == null || $jun == "")
    {
        $jun = 0;
    }
    
    $junMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=6 AND `return_status`=4 ORDER by `s_returnId`";
    $getJunTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$junMonthReturnQuery));
    $junReturn = $getJunTotReturn['returns'];
    if($junReturn == null || $junReturn == "")
    {
        $junReturn = 0;
    }
    
    $julyMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=7 AND `order_status`=4 ORDER by `s_orderId`";
    $getJulTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$julyMonthSalesQuery));
    $july = $getJulTotSales['profit'];
    if($july == null || $july == "")
    {
        $july = 0;
    }
    
    $julyMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=7 AND `return_status`=4 ORDER by `s_returnId`";
    $getJulTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$julyMonthReturnQuery));
    $julyReturn = $getJulTotReturn['returns'];
    if($julyReturn == null || $julyReturn == "")
    {
        $julyReturn = 0;
    }
    
    $augMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=8 AND `order_status`=4 ORDER by `s_orderId`";
    $getAugTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$augMonthSalesQuery));
    $aug = $getAugTotSales['profit'];
    if($aug == null || $aug == "")
    {
        $aug = 0;
    }
    
    $augMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=8 AND `return_status`=4 ORDER by `s_returnId`";
    $getAugTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$augMonthReturnQuery));
    $augReturn = $getAugTotReturn['returns'];
    if($augReturn == null || $augReturn == "")
    {
        $augReturn = 0;
    }
    $sepMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=9 AND `order_status`=4 ORDER by `s_orderId`";
    $getSepTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$sepMonthSalesQuery));
    $sep = $getSepTotSales['profit'];
    if($sep == null || $sep == "")
    {
        $sep = 0;
    }
     
    $sepMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=9 AND `return_status`=4 ORDER by `s_returnId`";
    $getSepTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$sepMonthReturnQuery));
    $sepReturn = $getSepTotReturn['returns'];
    if($sepReturn == null || $sepReturn == "")
    {
        $sepReturn = 0;
    }
    
    $octMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=10 AND `order_status`=4 ORDER by `s_orderId`";
    $getOctTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$octMonthSalesQuery));
    $oct = $getOctTotSales['profit'];
    if($oct == null || $oct == "")
    {
        $oct = 0;
    }
     
    $octMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=10 AND `return_status`=4 ORDER by `s_returnId`";
    $getOctTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$octMonthReturnQuery));
    $octReturn = $getOctTotReturn['returns'];
    if($octReturn == null || $octReturn == "")
    {
        $octReturn = 0;
    }
    
    $novMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=11 AND `order_status`=4 ORDER by `s_orderId`";
    $getNovTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$novMonthSalesQuery));
    $nov = $getNovTotSales['profit'];
    if($nov == null || $nov == "")
    {
        $nov = 0;
    }
     
    $novMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=11 AND `return_status`=4 ORDER by `s_returnId`";
    $getNovTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$novMonthReturnQuery));
    $novReturn = $getNovTotReturn['returns'];
    if($novReturn == null || $novReturn == "")
    {
        $novReturn = 0;
    }
    
    $decMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=12 AND `order_status`=4 ORDER by `s_orderId`";
    $getDecTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$decMonthSalesQuery));
    $dec = $getDecTotSales['profit'];
    if($dec == null || $dec == "")
    {
        $dec = 0;
    }
    
    $decMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=12 AND `return_status`=4 ORDER by `s_returnId`";
    $getDecTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$decMonthReturnQuery));
    $decReturn = $getDecTotReturn['returns'];
    if($decReturn == null || $decReturn == "")
    {
        $decReturn = 0;
    }
    
    if($jan == 0 && $feb == 0 && $mar == 0 && $apr == 0 && $may == 0 && $jun == 0 && $july == 0 && $aug == 0 && $sep == 0 && $oct == 0 &&  $nov == 0 && $dec == 0 &&  $janReturn == 0 && $febReturn == 0 && $marReturn == 0 && $aprReturn == 0 && $mayReturn == 0 && $junReturn == 0 && $julyReturn == 0 && $augReturn == 0 && $sepReturn == 0 && $octReturn == 0 && $novReturn == 0 && $decReturn == 0)
    {
        $chartTitle = "No any Monthly Sales and Return Report available for year $yearRecords";
    }
    else
    {
        $chartTitle = "Monthly Sales and Return Report $yearRecords";
    }
    
    echo "
            
                          ['Jan',  $jan, $janReturn],
                          ['Feb',  $feb, $febReturn],
                          ['Mar',  $mar, $marReturn],
                          ['Apr',  $apr, $aprReturn],
                          ['May',  $may, $mayReturn],
                          ['Jun',  $jun, $junReturn],
                          ['Jul',  $july, $julyReturn],
                          ['Aug',  $aug, $augReturn],
                          ['Sep',  $sep, $sepReturn],
                          ['Oct',  $oct, $octReturn],
                          ['Nov',  $nov, $novReturn],
                          ['Dec',  $dec, $decReturn]
    
    ";
    
     
    
   
}


function getChartsTitle($year)
{
    $yearRecords = $year;
    $conChart = mysqli_connect("localhost","root","","dayaStore");
    
    $janMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=1 AND `order_status`=4 ORDER by `s_orderId`";
    $getJanTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$janMonthSalesQuery));
    $jan = $getJanTotSales['profit'];
    if($jan == null || $jan == "")
    {
        $jan = 0;
    }
    
    $janMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=1 AND `return_status`=4 ORDER by `s_returnId`";
    $getJanTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$janMonthReturnQuery));
    $janReturn = $getJanTotReturn['returns'];
    if($janReturn == null || $janReturn == "")
    {
        $janReturn = 0;
    }
    
    $febMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=2 AND `order_status`=4 ORDER by `s_orderId`";
    $getFebTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$febMonthSalesQuery));
    $feb = $getFebTotSales['profit'];
    if($feb == null || $feb == "")
    {
        $feb = 0;
    }
    
    $febMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=2 AND `return_status`=4 ORDER by `s_returnId`";
    $getFebTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$febMonthReturnQuery));
    $febReturn = $getFebTotReturn['returns'];
    if($febReturn == null || $febReturn == "")
    {
        $febReturn = 0;
    }
    
    $marMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=3 AND `order_status`=4 ORDER by `s_orderId`";
    $getMarTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$marMonthSalesQuery));
    $mar = $getMarTotSales['profit'];
    if($mar == null || $mar == "")
    {
        $mar = 0;
    }
    
    
    $marMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=3 AND `return_status`=4 ORDER by `s_returnId`";
    $getMarTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$marMonthReturnQuery));
    $marReturn = $getMarTotReturn['returns'];
    if($marReturn == null || $marReturn == "")
    {
        $marReturn = 0;
    }
    
    $aprMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=4 AND `order_status`=4 ORDER by `s_orderId`";
    $getAprTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$aprMonthSalesQuery));
    $apr = $getAprTotSales['profit'];
    if($apr == null || $apr == "")
    {
        $apr = 0;
    }
    
    $aprMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=4 AND `return_status`=4 ORDER by `s_returnId`";
    $getAprTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$aprMonthReturnQuery));
    $aprReturn = $getAprTotReturn['returns'];
    if($aprReturn == null || $aprReturn == "")
    {
        $aprReturn = 0;
    }
    
    $mayMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=5 AND `order_status`=4 ORDER by `s_orderId`";
    $getMayTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$mayMonthSalesQuery));
    $may = $getMayTotSales['profit'];
    if($may == null || $may == "")
    {
        $may = 0;
    }
    
    $mayMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=5 AND `return_status`=4 ORDER by `s_returnId`";
    $getMayTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$mayMonthReturnQuery));
    $mayReturn = $getMayTotReturn['returns'];
    if($mayReturn == null || $mayReturn == "")
    {
        $mayReturn = 0;
    }
    
    $junMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=6 AND `order_status`=4 ORDER by `s_orderId`";
    $getJunTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$junMonthSalesQuery));
    $jun = $getJunTotSales['profit'];
    if($jun == null || $jun == "")
    {
        $jun = 0;
    }
    
    $junMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=6 AND `return_status`=4 ORDER by `s_returnId`";
    $getJunTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$junMonthReturnQuery));
    $junReturn = $getJunTotReturn['returns'];
    if($junReturn == null || $junReturn == "")
    {
        $junReturn = 0;
    }
    
    $julyMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=7 AND `order_status`=4 ORDER by `s_orderId`";
    $getJulTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$julyMonthSalesQuery));
    $july = $getJulTotSales['profit'];
    if($july == null || $july == "")
    {
        $july = 0;
    }
    
    $julyMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=7 AND `return_status`=4 ORDER by `s_returnId`";
    $getJulTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$julyMonthReturnQuery));
    $julyReturn = $getJulTotReturn['returns'];
    if($julyReturn == null || $julyReturn == "")
    {
        $julyReturn = 0;
    }
    
    $augMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=8 AND `order_status`=4 ORDER by `s_orderId`";
    $getAugTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$augMonthSalesQuery));
    $aug = $getAugTotSales['profit'];
    if($aug == null || $aug == "")
    {
        $aug = 0;
    }
    
    $augMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=8 AND `return_status`=4 ORDER by `s_returnId`";
    $getAugTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$augMonthReturnQuery));
    $augReturn = $getAugTotReturn['returns'];
    if($augReturn == null || $augReturn == "")
    {
        $augReturn = 0;
    }
    $sepMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=9 AND `order_status`=4 ORDER by `s_orderId`";
    $getSepTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$sepMonthSalesQuery));
    $sep = $getSepTotSales['profit'];
    if($sep == null || $sep == "")
    {
        $sep = 0;
    }
     
    $sepMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=9 AND `return_status`=4 ORDER by `s_returnId`";
    $getSepTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$sepMonthReturnQuery));
    $sepReturn = $getSepTotReturn['returns'];
    if($sepReturn == null || $sepReturn == "")
    {
        $sepReturn = 0;
    }
    
    $octMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=10 AND `order_status`=4 ORDER by `s_orderId`";
    $getOctTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$octMonthSalesQuery));
    $oct = $getOctTotSales['profit'];
    if($oct == null || $oct == "")
    {
        $oct = 0;
    }
     
    $octMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=10 AND `return_status`=4 ORDER by `s_returnId`";
    $getOctTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$octMonthReturnQuery));
    $octReturn = $getOctTotReturn['returns'];
    if($octReturn == null || $octReturn == "")
    {
        $octReturn = 0;
    }
    
    $novMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=11 AND `order_status`=4 ORDER by `s_orderId`";
    $getNovTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$novMonthSalesQuery));
    $nov = $getNovTotSales['profit'];
    if($nov == null || $nov == "")
    {
        $nov = 0;
    }
     
    $novMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=11 AND `return_status`=4 ORDER by `s_returnId`";
    $getNovTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$novMonthReturnQuery));
    $novReturn = $getNovTotReturn['returns'];
    if($novReturn == null || $novReturn == "")
    {
        $novReturn = 0;
    }
    
    $decMonthSalesQuery = "SELECT sum(`total`)as profit FROM tbl_sales_order WHERE YEAR(`order_date`)='$yearRecords' AND month(`order_date`)=12 AND `order_status`=4 ORDER by `s_orderId`";
    $getDecTotSales = mysqli_fetch_assoc(mysqli_query($conChart,$decMonthSalesQuery));
    $dec = $getDecTotSales['profit'];
    if($dec == null || $dec == "")
    {
        $dec = 0;
    }
    
    $decMonthReturnQuery = "SELECT sum(`total`)as returns FROM tbl_sales_return WHERE YEAR(`return_date`)='$yearRecords' AND month(`return_date`)=12 AND `return_status`=4 ORDER by `s_returnId`";
    $getDecTotReturn = mysqli_fetch_assoc(mysqli_query($conChart,$decMonthReturnQuery));
    $decReturn = $getDecTotReturn['returns'];
    if($decReturn == null || $decReturn == "")
    {
        $decReturn = 0;
    }
    
    if($jan == 0 && $feb == 0 && $mar == 0 && $apr == 0 && $may == 0 && $jun == 0 && $july == 0 && $aug == 0 && $sep == 0 && $oct == 0 &&  $nov == 0 && $dec == 0 &&  $janReturn == 0 && $febReturn == 0 && $marReturn == 0 && $aprReturn == 0 && $mayReturn == 0 && $junReturn == 0 && $julyReturn == 0 && $augReturn == 0 && $sepReturn == 0 && $octReturn == 0 && $novReturn == 0 && $decReturn == 0)
    {
        $chartTitle = "No any Monthly Sales and Return Report available for year $yearRecords";
    }
    else
    {
        $chartTitle = "Monthly Sales and Return Report $yearRecords";
    }
    
    echo "'$chartTitle'";
    
     
    
   
}

function getAllProductsAddPurchaseOrder(){
    
    global $db;
    
    $getproductQuery = "select * from tbl_product";
    $queryResults = mysqli_query($db,$getproductQuery);
     while($row_product=mysqli_fetch_array($queryResults)){
         
         $proID = $row_product['pro_id'];
         $proName = $row_product['pro_name'];
         $proprice = $row_product['pro_display_price'];
         $proDiscountStatus = $row_product['pro_discount_status'];
         $proDiscountAmount = $row_product['pro_discount_amount'];
         $availableStatus = $row_product['pro_available_status'];
         $proDescription = $row_product['pro_description'];
         $proCatogory = $row_product['cat_id'];
         $proStock = $row_product['pro_available_stock'];
         $proImage = $row_product['pro_image'];
         
         if($proDiscountStatus==1)
         {
             $disStatus ="Yes";
         }
         else
         {
             $disStatus ="No";
             $proDiscountAmount = "";
         }
         if($availableStatus == 1)
         {
             $availability = "Available Now";
         }
         else
         {
             $availability = "Not Available";
         }
         if($proStock == 0)
         {
             $proStock = "N/A";
         }
         $getCatNameQuery = "SELECT cat_name FROM `tbl_category` WHere cat_id = '$proCatogory'";
         
        $getCatDetails = mysqli_fetch_array(mysqli_query($db,$getCatNameQuery));
         $proCatName = $getCatDetails['cat_name'];
        
         echo "
            
                 <tr>
                    <td><img style='max-height: 60px; max-width: 60px; min-height: 60px; min-width: 60px; margin-left: auto;margin-right: auto; display: block;' src='../img/item/$proImage'></td>
                    <td style='vertical-align: middle;'>$proID</td>
                    <td style='vertical-align: middle;'>$proName</td>
                    <td style='vertical-align: middle;'>$proprice</td>
                    <td style='vertical-align: middle;'>$disStatus</td>
                    <td style='vertical-align: middle;'>$proDiscountAmount</td>
                    <td style='vertical-align: middle;'>$availability</td>
                    <td style='vertical-align: middle;'>$proStock</td>
                    <td style='vertical-align: middle;'>$proCatName</td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        <input type='text' value='$proID' name='txtProdID' hidden />
                        <button id='$proID' type='button' name='btnEditProduct' class='btn btn-secondary btn-sm btn-rounded waves-effect waves-light btnMakePurchaseOrder'>Make Purchase Order</button>
                        </form> 
                    </td>
                   
                </tr>
         
         ";
    }
}


function getAllPurchaseOrder(){
    
    global $db;
    
    $getPurchaseQuery = "select * from tbl_purchase_order WHERE `status` = 1 ORDER BY `date` DESC";
    $queryResults = mysqli_query($db,$getPurchaseQuery);
   
     while($row_Purchases=mysqli_fetch_array($queryResults)){
         
         $purchaseId = $row_Purchases['p_orderId'];
         $qty = $row_Purchases['quantity'];
         $date = $row_Purchases['date'];
         $supplierID = $row_Purchases['sup_id'];
         $proId = $row_Purchases['product_id'];
         $status = $row_Purchases['status'];
         
         
         
         $getSupplierDetailsQuery = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$supplierID'";
         
        $getSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getSupplierDetailsQuery));
         $suplierName = $getSupplierDetails['sup_name'];
        $suplierEmail = $getSupplierDetails['sup_email'];
         $supplierTele = $getSupplierDetails['sup_tele'];
         
         if($status == "1")
        {
            $btnColor = "badge-soft-warning";
             $statusNow = "Pending";
        }
        else
        {
            $btnColor = "badge-soft-success";
            $statusNow = "Complete";
        }
       
         
         echo "
                                        
                 <tr>
                    <td style='vertical-align: middle;'>$purchaseId</td>
                    <td style='vertical-align: middle;'>$suplierName</td>
                    <td style='vertical-align: middle;'>$suplierEmail</td>
                    <td style='vertical-align: middle;'>$supplierTele</td>
                    <td style='vertical-align: middle;'>$date</td>
                    <td style='vertical-align: middle;'>$proId</td>
                    <td style='vertical-align: middle;'>$qty</td>
                    <td style='vertical-align: middle;'> <span class='badge badge-pill $btnColor font-size-12'>$statusNow</span></td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        <input type='text' value='$purchaseId' name='txtProdID' hidden />
                        <button id='$purchaseId' type='button' name='btnEditProduct' class='btn btn-secondary btn-sm btn-rounded waves-effect waves-light btnViewPurchaseOrder'>View Purchasae</button>
                        </form> 
                    </td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        
                        <button id='$purchaseId' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light btnCompletePurchaseOrder'>Complete Purchasae</button>
                        </form> 
                    </td>
                   
                </tr>
         
         ";
    }
}


function purchaseOrderDetails($purchaseID)
{
    global $db;
    
    $getDetailsPurchase = "SELECT * FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseID'";
    $purchaseDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsPurchase));
    
    $purOrdId = $purchaseDetails['p_orderId'];
    $date = $purchaseDetails['date'];
    $proID = $purchaseDetails['product_id'];
    $quantity = $purchaseDetails['quantity'];
    $purchaseDescription = $purchaseDetails['order_description'];
    $suppId = $purchaseDetails['sup_id'];
    $itemName = $purchaseDetails['item_name'];
    
    $getSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$suppId'";
    $fetchedSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getSupplierDetails));
    
    $supplierName = $fetchedSupplierDetails['sup_name'];
    $supplierEmail = $fetchedSupplierDetails['sup_email'];
    $supplierContact = $fetchedSupplierDetails['sup_tele'];
    
    echo "
                                <p class='mb-2'>Purchase ID: <span class='text-primary'>$purOrdId</span></p>
                                <p class='mb-2'>Supplier Name: <span class='text-primary'>$supplierName</span></p>
                                <p class='mb-2'>Supplier Email: <span class='text-primary'>$supplierEmail</span></p> 
                                <p class='mb-2'>Supplier Contact No.: <span class='text-primary'>$supplierContact</span></p> 
                               <div class='table-responsive'>
                                    <table class='table table-centered table-nowrap'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>Purchase ID</th>
                                                <th scope='col'>Date</th>
                                                <th scope='col'>Product ID</th>
                                                <th scope='col'>Product Name</th>
                                                <th scope='col'>Quantity</th>
                                                <th scope='col'>Purchase Description</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>$purOrdId</td>
                                                <td>$date</td>
                                                <td>$proID</td>
                                                <td>$itemName</td>
                                                <td>$quantity</td>
                                                <td>$purchaseDescription</td>
                                            </tr>
                                        </tbody>
                                   </table>
                                </div>
    
    
    ";
}



function printPurchaseOrderPdf($purchaseID,$productName)
{
   global $db;
    
    $getDetailsPurchase = "SELECT * FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseID'";
    $purchaseDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsPurchase));
    
    $purOrdId = $purchaseDetails['p_orderId'];
    $date = $purchaseDetails['date'];
    $proID = $purchaseDetails['product_id'];
    $quantity = $purchaseDetails['quantity'];
    $purchaseDescription = $purchaseDetails['order_description'];
    $suppId = $purchaseDetails['sup_id'];
    
    $getSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$suppId'";
    $fetchedSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getSupplierDetails));
    
    $supplierName = $fetchedSupplierDetails['sup_name'];
    $supplierEmail = $fetchedSupplierDetails['sup_email'];
    $supplierContact = $fetchedSupplierDetails['sup_tele'];
    
     $output = "
            <div class='invoice-title'>
                                            <h4 class='float-right font-size-16'>Purchase Order # $purOrdId</h4>
                                            <div class='mb-4'>
                                                <img src='assets/images/Daya.png' alt='logo' height='45'/>
                                            </div>
                                        </div>
                                
                                <p class='mb-2'>Supplier Name: <span class='text-primary'>$supplierName</span></p>
                                <p class='mb-2'>Supplier Email: <span class='text-primary'>$supplierEmail</span></p> 
                                <p class='mb-2'>Supplier Contact No.: <span class='text-primary'>$supplierContact</span></p> 
                               <div class='table-responsive'>
                                    <table style='table-layout: fixed;' class='table'>
                                        <thead>
                                            <tr>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Purchase ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Date</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Product ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Product Name</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Quantity</th>
                                                <th scope='col' style='max-width: 25%;word-wrap: break-word;'>Purchase Description</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td >$purOrdId</td>
                                                <td >$date</td>
                                                <td >$proID</td>
                                                <td >$productName</td>
                                                <td >$quantity</td>
                                                <td >$purchaseDescription</td>
                                            </tr>
                                        </tbody>
                                   </table>
                                </div>
     ";
   
    
     
 return $output;
    
    
    
    
}

function purchaseOrderCompletionGrn($purOrder)
{
    global $db;
    
    $getAllPurchaseOrderData = "SELECT `p_orderId`, `item_name`, `quantity`, `date`, `sup_id`, `product_id`, `status`, `order_description` FROM `tbl_purchase_order` WHERE `p_orderId` = '$purOrder'";
    
   $results =  mysqli_fetch_array(mysqli_query($db,$getAllPurchaseOrderData));
    
    $purchasseOrderNo = $results['p_orderId'];
    $itemName = $results['item_name'];
    $quantity = $results['quantity'];
    $date = $results['date'];
    $supId = $results['sup_id'];
    $productId = $results['product_id'];
    $status = $results['status'];
    $orderDescription = $results['order_description'];
    
    $getDataSupplier = "SELECT `sup_name`,`sup_email` FROM `tbl_supplier` WHERE `sup_id`='$supId'";
    $supplierResults = mysqli_fetch_array(mysqli_query($db,$getDataSupplier));
    
    $suppName = $supplierResults['sup_name'];
    $suppEmail = $supplierResults['sup_email'];
    
    echo "
    
                    <div class='row'>
                            <div class='col-lg-12'>
                                
                                        <div class='invoice-title'>
                                            <h4 class='float-right font-size-14'>Purchase Order Id # $purchasseOrderNo</h4>
                                            <div class='mb-4'>
                                                <img src='assets/images/Daya.png' alt='logo' height='40'/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <address>
                                                    <strong>Purchase From:</strong><br><br>
                                                    <h6>$suppName</h6>
                                                    <h6>$suppEmail</h6>
                                                </address>
                                            </div>
                                            <div class='col-sm-6 text-sm-right'>
                                                <address class='mt-2 mt-sm-0'>
                                                    <strong>Order Date:</strong><br><br>
                                                    <h6>$date</h6>
                                                </address>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-6 mt-3'>
                                                <address>
                                                   <strong>Order Details:</strong><br><br>
                                                     <h6>Item Name : $itemName</h6>
                                                     <h6>Quantity  : $quantity</h6>
                                                      
                                                </address>
                                            </div>
                                           
                                        </div>
                                        <div id='error_message'></div>
                                        <div class='py-2 mt-3'>
                                            <h3 class='font-size-15 font-weight-bold'>Summary</h3>
                                        </div>
                                        <div class='table-responsive'>
                                          
                                                <textarea  id='discrip' style='width: 100%; height: 400px;'></textarea>
                                          
                                        </div>
                                        <div class='d-print-none'>
                                            <div class='float-right'><br>
                                                
                                                <button id='$purchasseOrderNo' class='btn btn-primary w-md waves-effect waves-light btnSendGrn'  onclick='return validate()'> Send</button>
                                            </div>
                                        </div>
                                   
                            </div>
                        </div>
    
    ";
}



function printGrn($purOrder,$summery)
{
    global $db;
    
    $getAllPurchaseOrderData = "SELECT `p_orderId`, `item_name`, `quantity`, `date`, `sup_id`, `product_id`, `status`, `order_description` FROM `tbl_purchase_order` WHERE `p_orderId` = '$purOrder'";
    
   $results =  mysqli_fetch_array(mysqli_query($db,$getAllPurchaseOrderData));
    
    $purchasseOrderNo = $results['p_orderId'];
    $itemName = $results['item_name'];
    $quantity = $results['quantity'];
    $date = $results['date'];
    $supId = $results['sup_id'];
    $productId = $results['product_id'];
    $status = $results['status'];
    $orderDescription = $results['order_description'];
    
    $getDataSupplier = "SELECT `sup_name`,`sup_email` FROM `tbl_supplier` WHERE `sup_id`='$supId'";
    $supplierResults = mysqli_fetch_array(mysqli_query($db,$getDataSupplier));
    
    $suppName = $supplierResults['sup_name'];
    $suppEmail = $supplierResults['sup_email'];
    
    
    
    $output = "
    
                    <div class='row'>
                            <div class='col-lg-12'>
                                
                                        <div class='invoice-title'>
                                            <h4 class='float-right font-size-14'>Purchase Order Id # $purchasseOrderNo</h4>
                                            <div class='mb-4'>
                                                <img src='assets/images/Daya.png' alt='logo' height='40'/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <address>
                                                    <strong>Purchase From:</strong><br><br>
                                                    <h6>$suppName</h6>
                                                    <h6>$suppEmail</h6>
                                                </address>
                                            </div>
                                            <div class='col-sm-6 float-right'>
                                                <address class='float-right'>
                                                    <strong>Order Date:</strong><br><br>
                                                    <h6>$date</h6>
                                                </address>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-6 mt-3'>
                                                <address>
                                                   <strong>Order Details:</strong><br><br>
                                                     <h6>Item Name : $itemName</h6>
                                                     <h6>Quantity  : $quantity</h6>
                                                      
                                                </address>
                                            </div>
                                           
                                        </div>
                                        <div id='error_message'></div>
                                        <div class='py-2 mt-3'>
                                            <h3 class='font-size-15 font-weight-bold'>Summary</h3>
                                        </div>
                                        <div class='table-responsive'>
                                          
                                                <h6>$summery</h6>
                                          
                                        </div>
                                        <div class='d-print-none'>
                                            <div class='float-right'><br>
                                                
                                                
                                            </div>
                                        </div>
                                   
                            </div>
                        </div>
    
    ";
    
    return $output;
}


function getAllCompletedPurchaseOrder(){
    
    global $db;
    
    $getCompletedPurchaseQuery = "select * from tbl_purchase_order WHERE `status` = 2 or `status` = 3 or `status` = 4 ORDER BY `date` DESC";
    $queryCompletedPuchaseResults = mysqli_query($db,$getCompletedPurchaseQuery);
   
     while($row_Completed_Purchases=mysqli_fetch_array($queryCompletedPuchaseResults)){
         
         $purchaseId = $row_Completed_Purchases['p_orderId'];
         $qty = $row_Completed_Purchases['quantity'];
         $date = $row_Completed_Purchases['date'];
         $supplierID = $row_Completed_Purchases['sup_id'];
         $proId = $row_Completed_Purchases['product_id'];
         $status = $row_Completed_Purchases['status'];
         
         
         
         $getCompletedPurchaseSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$supplierID'";
         
        $CompletedOrdersSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getCompletedPurchaseSupplierDetails));
         $suplierName = $CompletedOrdersSupplierDetails['sup_name'];
        $suplierEmail = $CompletedOrdersSupplierDetails['sup_email'];
         $supplierTele = $CompletedOrdersSupplierDetails['sup_tele'];
         
         if($status == "1")
        {
            $btnColor = "badge-soft-warning";
             $statusNow = "Pending";
        }
        else if($status == "2")
        {
            $btnColor = "badge-soft-success";
            $statusNow = "Completed";
        }
        else if($status == "3")
        {
            $btnColor = "badge-soft-success";
            $statusNow = "Completed";
        }
          else if($status == "4")
        {
            $btnColor = "badge-soft-success";
            $statusNow = "Completed";
        }
       
         
         echo "
                                        
                 <tr>
                    <td style='vertical-align: middle;'>$purchaseId</td>
                    <td style='vertical-align: middle;'>$suplierName</td>
                    <td style='vertical-align: middle;'>$suplierEmail</td>
                    <td style='vertical-align: middle;'>$supplierTele</td>
                    <td style='vertical-align: middle;'>$date</td>
                    <td style='vertical-align: middle;'>$proId</td>
                    <td style='vertical-align: middle;'>$qty</td>
                    <td style='vertical-align: middle;'> <span class='badge badge-pill $btnColor font-size-12'>$statusNow</span></td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        <input type='text' value='$purchaseId' name='txtProdID' hidden />
                        <button id='$purchaseId' type='button' name='btnEditProduct' class='btn btn-secondary btn-sm btn-rounded waves-effect waves-light btnViewPurchaseOrder'>View Purchase Order</button>
                        </form> 
                    </td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        
                        <button id='$purchaseId' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light btnViewGRNOrder'>View GRN</button>
                        </form> 
                    </td>
                   
                </tr>
         
         ";
    }
}



function viewPurchaseOrderBill($purchaseID)
{
   global $db;
    
    $getDetailsPurchase = "SELECT * FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseID'";
    $purchaseDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsPurchase));
    
    $purOrdId = $purchaseDetails['p_orderId'];
    $date = $purchaseDetails['date'];
    $proID = $purchaseDetails['product_id'];
    $quantity = $purchaseDetails['quantity'];
    $purchaseDescription = $purchaseDetails['order_description'];
    $suppId = $purchaseDetails['sup_id'];
    $productName = $purchaseDetails['item_name'];
    
    
    $getSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$suppId'";
    $fetchedSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getSupplierDetails));
    
    $supplierName = $fetchedSupplierDetails['sup_name'];
    $supplierEmail = $fetchedSupplierDetails['sup_email'];
    $supplierContact = $fetchedSupplierDetails['sup_tele'];
    
     echo "
            <div class='invoice-title'>
                                            <h4 class='float-right font-size-16'>Purchase Order # $purOrdId</h4>
                                            <div class='mb-4'>
                                                <img src='assets/images/Daya.png' alt='logo' height='45'/>
                                            </div>
                                        </div>
                                
                                <p class='mb-2'>Supplier Name: <span class='text-primary'>$supplierName</span></p>
                                <p class='mb-2'>Supplier Email: <span class='text-primary'>$supplierEmail</span></p> 
                                <p class='mb-2'>Supplier Contact No.: <span class='text-primary'>$supplierContact</span></p> 
                               <div class='table-responsive'>
                                    <table style='table-layout: fixed;' class='table'>
                                        <thead>
                                            <tr>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Purchase ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Date</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Product ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Product Name</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Quantity</th>
                                                <th scope='col' style='max-width: 25%;word-wrap: break-word;'>Purchase Description</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td >$purOrdId</td>
                                                <td >$date</td>
                                                <td>$proID</td>
                                                <td >$productName</td>
                                                <td >$quantity</td>
                                                <td >$purchaseDescription</td>
                                            </tr>
                                        </tbody>
                                   </table>
                                </div>
     ";
   
    
     

    
    
    
    
}

function viewGrnDetail($purOrder)
{
    global $db;
    
    $getAllPurchaseOrderData = "SELECT `p_orderId`, `item_name`, `quantity`, `date`, `sup_id`, `product_id`, `status`, `order_description` FROM `tbl_purchase_order` WHERE `p_orderId` = '$purOrder'";
    
   $results =  mysqli_fetch_array(mysqli_query($db,$getAllPurchaseOrderData));
    
    $purchasseOrderNo = $results['p_orderId'];
    $itemName = $results['item_name'];
    $quantity = $results['quantity'];
    $date = $results['date'];
    $supId = $results['sup_id'];
    $productId = $results['product_id'];
    $status = $results['status'];
    $orderDescription = $results['order_description'];
    
    $getDataSupplier = "SELECT `sup_name`,`sup_email` FROM `tbl_supplier` WHERE `sup_id`='$supId'";
    $supplierResults = mysqli_fetch_array(mysqli_query($db,$getDataSupplier));
    
    $suppName = $supplierResults['sup_name'];
    $suppEmail = $supplierResults['sup_email'];
    
    $getGrnSummery = "SELECT `description` FROM `tbl_grn` WHERE `p_orderId` = '$purOrder'";
    $gotGrmDetails = mysqli_fetch_array(mysqli_query($db,$getGrnSummery));
    $summery = $gotGrmDetails['description'];
    
    echo "
    
                    <div class='row'>
                            <div class='col-lg-12'>
                                
                                        <div class='invoice-title'>
                                            <h4 class='float-right font-size-14'>Purchase Order Id # $purchasseOrderNo</h4>
                                            <div class='mb-4'>
                                                <img src='assets/images/Daya.png' alt='logo' height='40'/>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class='row'>
                                            <div class='col-sm-6'>
                                                <address>
                                                    <strong>Purchase From:</strong><br><br>
                                                    <h6>$suppName</h6>
                                                    <h6>$suppEmail</h6>
                                                </address>
                                            </div>
                                            <div class='col-sm-6 float-right'>
                                                <address class='float-right'>
                                                    <strong>Order Date:</strong><br><br>
                                                    <h6>$date</h6>
                                                </address>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-6 mt-3'>
                                                <address>
                                                   <strong>Order Details:</strong><br><br>
                                                     <h6>Item Name : $itemName</h6>
                                                     <h6>Quantity  : $quantity</h6>
                                                      
                                                </address>
                                            </div>
                                           
                                        </div>
                                        <div id='error_message'></div>
                                        <div class='py-2 mt-3'>
                                            <h3 class='font-size-15 font-weight-bold'>Summary</h3>
                                        </div>
                                        <div class='table-responsive'>
                                          
                                                <h6>$summery</h6>
                                          
                                        </div>
                                        <div class='d-print-none'>
                                            <div class='float-right'><br>
                                                
                                                
                                            </div>
                                        </div>
                                   
                            </div>
                        </div>
    
    ";
    
    
}


function displayCompletedPurchaseOrders(){
    
    global $db;
    
    $getCompletedPurchaseQuery = "select * from tbl_purchase_order WHERE `status` = 2 ORDER BY `date` DESC";
    $queryCompletedPuchaseResults = mysqli_query($db,$getCompletedPurchaseQuery);
   
     while($row_Completed_Purchases=mysqli_fetch_array($queryCompletedPuchaseResults)){
         
         $purchaseId = $row_Completed_Purchases['p_orderId'];
         $qty = $row_Completed_Purchases['quantity'];
         $date = $row_Completed_Purchases['date'];
         $supplierID = $row_Completed_Purchases['sup_id'];
         $proId = $row_Completed_Purchases['product_id'];
         $status = $row_Completed_Purchases['status'];
         
         
         
         $getCompletedPurchaseSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$supplierID'";
         
        $CompletedOrdersSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getCompletedPurchaseSupplierDetails));
         $suplierName = $CompletedOrdersSupplierDetails['sup_name'];
        $suplierEmail = $CompletedOrdersSupplierDetails['sup_email'];
         $supplierTele = $CompletedOrdersSupplierDetails['sup_tele'];
         
         if($status == "1")
        {
            $btnColor = "badge-soft-warning";
             $statusNow = "Pending";
        }
        else 
        {
            $btnColor = "badge-soft-success";
            $statusNow = " Order Completed";
        }
       
         
         echo "
                                        
                 <tr>
                    <td style='vertical-align: middle;'>$purchaseId</td>
                    <td style='vertical-align: middle;'>$suplierName</td>
                    <td style='vertical-align: middle;'>$suplierEmail</td>
                    <td style='vertical-align: middle;'>$supplierTele</td>
                    <td style='vertical-align: middle;'>$date</td>
                    <td style='vertical-align: middle;'>$proId</td>
                    <td style='vertical-align: middle;'>$qty</td>
                    <td style='vertical-align: middle;'> <span class='badge badge-pill $btnColor font-size-12'>$statusNow</span></td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        <input type='text' value='$purchaseId' name='txtProdID' hidden />
                        <button id='$purchaseId' type='button' name='btnEditProduct' class='btn btn-secondary btn-sm btn-rounded waves-effect waves-light btnReturnPurchaseOrder'>Return Order</button>
                        </form> 
                    </td>  
                   
                </tr>
         
         ";
    }
}

function printReturnPurchaseOrderPdf($purchaseID,$returnID)
{
   global $db;
    
    $getDetailsPurchase = "SELECT * FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseID'";
    $purchaseDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsPurchase));
    
    $purOrdId = $purchaseDetails['p_orderId'];
    $suppId = $purchaseDetails['sup_id'];
    $productName = $purchaseDetails['item_name'];
    $productId = $purchaseDetails['product_id'];
    
    $getDetailsOFReturn = "SELECT `p_returnId`, `qty`, `date`, `description` FROM `tbl_purchase_return` WHERE `p_returnId` = '$returnID'";
    $purchaseReturnDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsOFReturn));
    $returnPurchaseID = $purchaseReturnDetails['p_returnId'];
    $returnQty = $purchaseReturnDetails['qty'];
    $returndate = $purchaseReturnDetails['date'];
    $returnDescription = $purchaseReturnDetails['description'];
    
    
    $getSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$suppId'";
    $fetchedSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getSupplierDetails));
    
    $supplierName = $fetchedSupplierDetails['sup_name'];
    $supplierEmail = $fetchedSupplierDetails['sup_email'];
    $supplierContact = $fetchedSupplierDetails['sup_tele'];
    
     $output = "
            <div class='invoice-title'>
                                            <h4 class='float-right font-size-16'>Purchase Return Order # $returnPurchaseID</h4>
                                            <div class='mb-4'>
                                                <img src='assets/images/Daya.png' alt='logo' height='45'/>
                                            </div>
                                        </div>
                                
                                <p class='mb-2'>Supplier Name: <span class='text-primary'>$supplierName</span></p>
                                <p class='mb-2'>Supplier Email: <span class='text-primary'>$supplierEmail</span></p> 
                                <p class='mb-2'>Supplier Contact No.: <span class='text-primary'>$supplierContact</span></p> 
                               <div class='table-responsive'>
                                    <div class='text-center'>
                                    <h3>Return Order for Purchase Order ID : $purOrdId</h3>
                                    </div>
                                    <table style='table-layout: fixed;' class='table'>
                                        <thead>
                                            <tr>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Return ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Purchase ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Date</th>
                                                <th scope='col' style='width: 10%;word-wrap: break-word;'>Product ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Product Name</th>
                                                <th scope='col' style='width: 10%;word-wrap: break-word;'>Qty</th>
                                                <th scope='col' style='max-width: 20%;word-wrap: break-word;'>Return Description</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td >$returnID</td>
                                                <td >$purOrdId</td>
                                                <td >$returndate</td>
                                                <td >$productId</td>
                                                <td >$productName</td>
                                                <td >$returnQty</td>
                                                <td >$returnDescription</td>
                                            </tr>
                                        </tbody>
                                   </table>
                                </div>
     ";
   
    
     
 return $output;
    
    
    
    
}

function getAllReturnedPurchaseOrder(){
    
    global $db;
    
    $getReturnedPurchaseQuery = "select * from tbl_purchase_return WHERE `status` = 1 ORDER BY `date` DESC";
    $queryReturnedPuchaseResults = mysqli_query($db,$getReturnedPurchaseQuery);
   
     while($row_Returned_Purchases=mysqli_fetch_array($queryReturnedPuchaseResults)){
         $returnID = $row_Returned_Purchases['p_returnId'];
         $purchaseId = $row_Returned_Purchases['p_orderId'];
         $qty = $row_Returned_Purchases['qty'];
         $date = $row_Returned_Purchases['date'];
         $supplierID = $row_Returned_Purchases['sup_id'];
        
         $status = $row_Returned_Purchases['status'];
         
         $getProductID = "SELECT `product_id` FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseId'";
         $getProductdetails = mysqli_fetch_array(mysqli_query($db,$getProductID));
        $proId = $getProductdetails['product_id'];
         
         
         $getReturnedPurchaseSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$supplierID'";
         
        $CompletedOrdersSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getReturnedPurchaseSupplierDetails));
         $suplierName = $CompletedOrdersSupplierDetails['sup_name'];
        $suplierEmail = $CompletedOrdersSupplierDetails['sup_email'];
         $supplierTele = $CompletedOrdersSupplierDetails['sup_tele'];
         
         if($status == "1")
        {
            $btnColor = "badge-soft-warning";
             $statusNow = "Pending";
        }
        else if($status == "2")
        {
            $btnColor = "badge-soft-success";
            $statusNow = "Return Completed";
        }
        
       
         
         echo "
                                        
                 <tr>
                 <td style='vertical-align: middle;'>$returnID</td>
                    <td style='vertical-align: middle;'>$purchaseId</td>
                    <td style='vertical-align: middle;'>$suplierName</td>
                    <td style='vertical-align: middle;'>$suplierEmail</td>
                    <td style='vertical-align: middle;'>$supplierTele</td>
                    <td style='vertical-align: middle;'>$date</td>
                    <td style='vertical-align: middle;'>$proId</td>
                    <td style='vertical-align: middle;'>$qty</td>
                    <td style='vertical-align: middle;'> <span class='badge badge-pill $btnColor font-size-12'>$statusNow</span></td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        <input type='text' value='$purchaseId' name='txtProdID' hidden />
                        <button id='$returnID' type='button' name='btnEditProduct' class='btn btn-secondary btn-sm btn-rounded waves-effect waves-light btnViewReturnPurchasedOrder'>View Return Order</button>
                        </form> 
                    </td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        
                        <button id='$returnID' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light btnCompleteReturnPurchaseOrder'>Returned Complete</button>
                        </form> 
                    </td>
                   
                </tr>
         
         ";
    }
}



function returunPurchaseOrderDetails($returnID)
{
    global $db;
    
    $getReturnOrderDetails = "SELECT `p_returnId`, `p_orderId`, `qty`, `date`,`sup_id`, `description` FROM `tbl_purchase_return` WHERE `p_returnId` = '$returnID'";
    $returnDetails  = mysqli_fetch_array(mysqli_query($db,$getReturnOrderDetails));
    $returnPurchaseID = $returnDetails['p_returnId'];
    $purchaseID = $returnDetails['p_orderId'];
    $returnDate = $returnDetails['date'];
    $returnQty = $returnDetails['qty'];
    $suppId = $returnDetails['sup_id'];
    $returnDescription = $returnDetails['description'];
    
    
    
    $getDetailsPurchase = "SELECT * FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseID'";
    $purchaseDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsPurchase));
    
    
    $proID = $purchaseDetails['product_id'];
    $proName = $purchaseDetails['item_name'];
    
    $getSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$suppId'";
    $fetchedSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getSupplierDetails));
    
    $supplierName = $fetchedSupplierDetails['sup_name'];
    $supplierEmail = $fetchedSupplierDetails['sup_email'];
    $supplierContact = $fetchedSupplierDetails['sup_tele'];
    
    echo "
                                <p class='mb-2'>Return ID: <span class='text-primary'>$returnPurchaseID</span></p>
                                <p class='mb-2'>Supplier Name: <span class='text-primary'>$supplierName</span></p>
                                <p class='mb-2'>Supplier Email: <span class='text-primary'>$supplierEmail</span></p> 
                                <p class='mb-2'>Supplier Contact No.: <span class='text-primary'>$supplierContact</span></p> 
                               <div class='table-responsive'>
                                    <table class='table table-centered table-nowrap'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>Return ID</th>
                                                <th scope='col'>Purchase ID</th>
                                                <th scope='col'>Date</th>
                                                <th scope='col'>Product ID</th>
                                                <th scope='col'>Product Name</th>
                                                <th scope='col'>Qty</th>
                                                <th scope='col'>Return Description</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td>$returnPurchaseID</td>
                                                <td>$purchaseID</td>
                                                <td>$returnDate</td>
                                                <td>$proID</td>
                                                <td>$proName</td>
                                                <td>$returnQty</td>
                                                <td>$returnDescription</td>
                                            </tr>
                                        </tbody>
                                   </table>
                                </div>
    
    
    ";
}


function getAllCompletedReturnedPurchaseOrder(){
    
    global $db;
    
    $getCompletedReturnedPurchaseQuery = "select * from tbl_purchase_return WHERE `status` = 2 ORDER BY `date` DESC";
    $queryCompletedReturnedPuchaseResults = mysqli_query($db,$getCompletedReturnedPurchaseQuery);
   
     while($row_Completed_Returned_Purchases=mysqli_fetch_array($queryCompletedReturnedPuchaseResults)){
         $returnID = $row_Completed_Returned_Purchases['p_returnId'];
         $purchaseId = $row_Completed_Returned_Purchases['p_orderId'];
         $qty = $row_Completed_Returned_Purchases['qty'];
         $date = $row_Completed_Returned_Purchases['date'];
         $supplierID = $row_Completed_Returned_Purchases['sup_id'];
        
         $status = $row_Completed_Returned_Purchases['status'];
         
         $getProductID = "SELECT `product_id` FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseId'";
         $getProductdetails = mysqli_fetch_array(mysqli_query($db,$getProductID));
        $proId = $getProductdetails['product_id'];
         
         
         $getReturnedPurchaseSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$supplierID'";
         
        $CompletedOrdersSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getReturnedPurchaseSupplierDetails));
         $suplierName = $CompletedOrdersSupplierDetails['sup_name'];
        $suplierEmail = $CompletedOrdersSupplierDetails['sup_email'];
         $supplierTele = $CompletedOrdersSupplierDetails['sup_tele'];
         
         if($status == "1")
        {
            $btnColor = "badge-soft-warning";
             $statusNow = "Pending";
        }
        else if($status == "2")
        {
            $btnColor = "badge-soft-success";
            $statusNow = "Return Completed";
        }
        
       
         
         echo "
                                        
                 <tr>
                 <td style='vertical-align: middle;'>$returnID</td>
                    <td style='vertical-align: middle;'>$purchaseId</td>
                    <td style='vertical-align: middle;'>$suplierName</td>
                    <td style='vertical-align: middle;'>$suplierEmail</td>
                    <td style='vertical-align: middle;'>$supplierTele</td>
                    <td style='vertical-align: middle;'>$date</td>
                    <td style='vertical-align: middle;'>$proId</td>
                    <td style='vertical-align: middle;'>$qty</td>
                    <td style='vertical-align: middle;'> <span class='badge badge-pill $btnColor font-size-12'>$statusNow</span></td>
                    
                    <td style='vertical-align: middle;' class = 'text-center'>
                    <form>
                        <input type='text' value='$purchaseId' name='txtProdID' hidden />
                        <button id='$returnID' type='button' name='btnEditProduct' class='btn btn-success btn-sm btn-rounded waves-effect waves-light btnViewReturnPurchaseInvoice'>View Return Order</button>
                        </form> 
                    </td>
                    
                   
                   
                </tr>
         
         ";
    }
}

function viewReturnPurchaseOrderPdf($purchaseID,$returnID)
{
   global $db;
    
    $getDetailsPurchase = "SELECT * FROM `tbl_purchase_order` WHERE `p_orderId` = '$purchaseID'";
    $purchaseDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsPurchase));
    
    $purOrdId = $purchaseDetails['p_orderId'];
    $suppId = $purchaseDetails['sup_id'];
    $productName = $purchaseDetails['item_name'];
    $productId = $purchaseDetails['product_id'];
    
    $getDetailsOFReturn = "SELECT `p_returnId`, `qty`, `date`, `description` FROM `tbl_purchase_return` WHERE `p_returnId` = '$returnID'";
    $purchaseReturnDetails = mysqli_fetch_array(mysqli_query($db,$getDetailsOFReturn));
    $returnPurchaseID = $purchaseReturnDetails['p_returnId'];
    $returnQty = $purchaseReturnDetails['qty'];
    $returndate = $purchaseReturnDetails['date'];
    $returnDescription = $purchaseReturnDetails['description'];
    
    
    $getSupplierDetails = "SELECT `sup_name`,`sup_email`,`sup_tele` FROM `tbl_supplier` WHERE `sup_id` = '$suppId'";
    $fetchedSupplierDetails = mysqli_fetch_array(mysqli_query($db,$getSupplierDetails));
    
    $supplierName = $fetchedSupplierDetails['sup_name'];
    $supplierEmail = $fetchedSupplierDetails['sup_email'];
    $supplierContact = $fetchedSupplierDetails['sup_tele'];
    
     echo "
            <div class='invoice-title'>
                                            <h4 class='float-right font-size-16'>Purchase Return Order # $returnPurchaseID</h4>
                                            <div class='mb-4'>
                                                <img src='assets/images/Daya.png' alt='logo' height='45'/>
                                            </div>
                                        </div>
                                
                                <p class='mb-2'>Supplier Name: <span class='text-primary'>$supplierName</span></p>
                                <p class='mb-2'>Supplier Email: <span class='text-primary'>$supplierEmail</span></p> 
                                <p class='mb-2'>Supplier Contact No.: <span class='text-primary'>$supplierContact</span></p> 
                               <div class='table-responsive'>
                                    <div class='text-center'>
                                    <h3>Return Order for Purchase Order ID : $purOrdId</h3>
                                    </div>
                                    <table style='table-layout: fixed;' class='table'>
                                        <thead>
                                            <tr>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Return ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Purchase ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Date</th>
                                                <th scope='col' style='width: 10%;word-wrap: break-word;'>Product ID</th>
                                                <th scope='col' style='width: 15%;word-wrap: break-word;'>Product Name</th>
                                                <th scope='col' style='width: 10%;word-wrap: break-word;'>Qty</th>
                                                <th scope='col' style='max-width: 20%;word-wrap: break-word;'>Return Description</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <td >$returnID</td>
                                                <td >$purOrdId</td>
                                                <td >$returndate</td>
                                                <td >$productId</td>
                                                <td >$productName</td>
                                                <td >$returnQty</td>
                                                <td >$returnDescription</td>
                                            </tr>
                                        </tbody>
                                   </table>
                                </div>
     ";
   
    
     

    
    
    
    
}

function getAllSupplierList(){
    
    global $db;
    
    $getSuppliersQuery = "select * from tbl_supplier";
    $supplierQueryResults = mysqli_query($db,$getSuppliersQuery);
     while($row_Supplier=mysqli_fetch_array($supplierQueryResults)){
         
         $ID = $row_Supplier['sup_id'];
         $Name = $row_Supplier['sup_name'];
         $NIC = $row_Supplier['sup_nic'];
         $Address = $row_Supplier['sup_address'];
         $Telephone = $row_Supplier['sup_tele'];
         $Email = $row_Supplier['sup_email'];
         $ItemTag = $row_Supplier['item_tag'];
         $CompanyName = $row_Supplier['company_name'];
         $CompanyTel = $row_Supplier['company_tele'];
         $CompanyAddress = $row_Supplier['company_address'];
         
         
        
         echo "
            
                 <tr>
                    
                    <td style='vertical-align: middle;'>$ID</td>
                    <td style='vertical-align: middle;'>$Name</td>
                    <td style='vertical-align: middle;'>$NIC</td>
                    <td style='vertical-align: middle;'>$Address</td>
                    <td style='vertical-align: middle;'>$Telephone</td>
                    <td style='vertical-align: middle;'>$Email</td>
                    <td style='vertical-align: middle;'>$ItemTag</td>
                    <td style='vertical-align: middle;'>$CompanyName</td>
                    <td style='vertical-align: middle;'>$CompanyTel</td>
                    <td style='vertical-align: middle;'>$CompanyAddress</td>
                   
                </tr>
         
         ";
    }
}

function getChartImageToPDF($chartImageName)
{
     $output = '
            
                    <div class="row">    
                            <div class="col-lg-12">
                                <img style="max-width:650px;" src="assets/Sales&ReturnReports/ChartImages/'.$chartImageName.'">
                                </div>
                            </div>
     ';
    return $output;
}



?>