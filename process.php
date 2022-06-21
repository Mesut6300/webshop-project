<?php
session_start();
// check the loggedin user of no login user id is 0 
if(isset($_SESSION['uid'])){
 $user_id = $_SESSION['uid'];
}
else{
 $user_id=0;
}
include_once('includes/db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['product_id'])){
        $product_id = $_POST["product_id"];

    
    
    //echo  "the user is ".$user_id." and product is ". $product_id;
    // check if the product was added to the basket
   // $query_check for check the product before add it to the Basket
    $query_check="select * from warenkorb where product_id ='$product_id' and user_id='$user_id' ";
    $result_check =  mysqli_query($con,$query_check);
    if(mysqli_num_rows( $result_check) > 0){
        // we added the product before
        // we update warenkorb table
        $row_check = mysqli_fetch_array($result_check);
        $new_quantity = $row_check['quantity']+1;
        $new_total = $new_quantity * $row_check['price'];

        $query_update = "update warenkorb set quantity ='$new_quantity' , total_amount = '$new_total' where user_id='$user_id' and product_id ='$product_id' ";
        
        $result_update = mysqli_query($con,$query_update);
      
        if($result_update > 0){
            echo "you added one more to basket";
        }


    }

    else{
     //  we are adding this to warenkorb for first time
    
    
    $query = "select * from products where id='$product_id' ";
    
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows( $result) > 0){
        $row = mysqli_fetch_array($result);
        $product_image = $row['image'];
        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_quantity = $_POST['quantity'];
        $total =  $product_price * $product_quantity;

        $query_w = "insert into warenkorb (product_id,user_id,product_name,product_image,quantity,price,total_amount) VALUES('$product_id','$user_id','$product_name','$product_image','$product_quantity','$product_price','$total')";
        $result_w = mysqli_query($con,$query_w);
        if($result_w){
            echo "you added to basket successfully!";
        }
    }
   }

}
    //-------- get the basket number from database for the current user  start -----
    if(isset($_POST['count'])){
       $q="select * from warenkorb where user_id='$user_id' ";
       $result_amount = mysqli_query($con,$q);
       if(mysqli_num_rows( $result_amount) >0){
           $total_products = 0;
           while( $row_amount= mysqli_fetch_array( $result_amount)){
            $total_products = $total_products +  $row_amount['quantity'];
           }
           echo $total_products;
           
       }
       
    }

    //------------ get all products and show them to warenkorb.php start
    if(isset($_POST['get_warenkorb_products'])){
        $q="select * from warenkorb where user_id='$user_id' ";
        $result = mysqli_query($con,$q);
        if(mysqli_num_rows( $result) >0){
            $total_amt = 0;
            while($row = mysqli_fetch_array($result)){
                $order_id = $row['id'];
                $product_id = $row['product_id'];
                $user_id = $row['user_id'];
                $product_name = $row['product_name'];
                $product_image = $row['product_image'];
                $quantity = $row['quantity'];
                $price = $row['price'];
                $discount = "0 %";
                if( $quantity >= 8 && $quantity < 16 ){
                    
                    $pro_total = $row['total_amount'] - ($row['total_amount'] * (8 / 100))  ;
                    $discount = "8 %";
                }
                else if($quantity >= 16){
                    $pro_total = $row['total_amount'] - ($row['total_amount'] * (16 / 100))  ;
                    $discount = "16 %";

                }
                else {
                    $pro_total = $row['total_amount'];

                }
                // switch(true){
                //     case  $quantity <= 8: 
                //         $pro_total = $row['total_amount'];
                //         break;
                //     case $quantity < 16:  
                //         $pro_total = $row['total_amount'] - ($row['total_amount'] * (8 / 100))  ; 
                //         break;
                //     case $quantity >= 16: 
                //         $pro_total = $row['total_amount'] - ($row['total_amount'] * (16 / 100))  ; 
                //         break;    

                // }
                

                $price_array = array($pro_total);
                $total_sum =  array_sum($price_array);
                $total_amt = $total_amt + $total_sum;

                // create bootstrap card with each order from basket
                echo '<div class="card rounded-3 mb-4">
                <div class="card-body p-4">
                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="'.$product_image.'"
                        class="img-fluid rounded-3" alt="'.$product_name.'">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <p class="lead fw-normal mb-2">'.$product_name.'</p>
                      <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button  oid="'.$order_id.'" class="btn btn-link px-2 remove-from-warenkorb" 
                        >
                        <i class="fas fa-minus"></i>
                      </button>
                
                      <input id="form1" min="0" name="quantity" value="'.$quantity.'" type="number"
                        class="form-control form-control-sm" />
      
                      <button oid="'.$order_id.'" class="btn btn-link px-2 add-to-warenkorb"
                       >
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1 ">
                      <h5 class="mb-0">'.$price.'€   in total = '.$pro_total.' discount: '.$discount.'</h5>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <a href="#!" class="text-info remove-product-from-warenkorb" oid_remove="'.$order_id.'">
                      <i class="fa-solid fa-trash-can"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              
              ';


            }
          
           echo '<div class="card mb-4">
                    <div class="card-body p-4 d-flex flex-row">
                        
                    <div class="form-outline flex-fill">
                        <label class="form-label" for="form1">Total Amount</label>
                    </div>
                        <h5 >€<span id="total">'.$total_amt.'</span></h5>
                    </div>
                 </div>
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                    </div>
                </div>';
        }



    }
    ////------------ get all products and show them to warenkorb.php end 
    
    // increase product quantity in basket (click on the + button) start


    // increase / decrease product quantity in basket (click on the + button) start 
    
    if(isset($_POST['oid'])){
     $order_id = $_POST['oid'];
     $qty = $_POST['qty'];
     $q="select * from warenkorb where user_id='$user_id' and id = '$order_id' ";
     
     $result =  mysqli_query($con,$q);

     if(mysqli_num_rows( $result) > 0){
          
         // we will update the record in database with the new quantity 
         $row = mysqli_fetch_array($result);

         $new_quantity = $row['quantity']+ $qty; // calculation

         // we dont want minus quantity
         if($new_quantity < 1 ){ // quantity should be at least 1 
           die("you cant do that");
         }

         $new_total = $new_quantity * $row['price'];
 
         $q_update = "update warenkorb set quantity ='$new_quantity' , total_amount = '$new_total' where user_id='$user_id' and id ='$order_id' ";
         
         $result_update = mysqli_query($con,$q_update);
       
         if($result_update > 0){
             echo "you updated your basket basket";
         }
 
 
     }


    }

  // ------  increase / decrease product quantity in basket (click on the + button) end 

  // remove item from   basket (click on the trash button) start 
    
  if(isset($_POST['oid_remove'])){
    $order_id = $_POST['oid_remove'];
     
    //$q="select * from warenkorb where user_id='$user_id' and id = '$order_id' ";
    $q="delete from warenkorb where user_id='$user_id' and id = '$order_id'   ";
   
    
    $result =  mysqli_query($con,$q);
    echo $result;
    if($result ){
        echo "one product deleted form basket";
    }
    

  


   }

 // ------  remove item from   basket (click on the trash button) end 



}



?>