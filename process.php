<?php
session_start();
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
    if(isset($_POST['qty'])){
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
}



?>