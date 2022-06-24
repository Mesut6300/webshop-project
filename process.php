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
                        <button type="button" class="btn btn-warning btn-block btn-lg proceed-to-pay">Proceed to Pay</button>
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

 // -------------------proceed to pay start ---------------
 if(isset($_POST['proceed'])){
     if($user_id === 0){
         echo ' <form method ="post">
         <!-- Email input -->
         <div class="form-outline mb-4">
           <input type="email" id="email" class="form-control form-control-lg" name="email" />
           <label class="form-label" for="form1Example13">Email address</label>
         </div>

         <!-- Password input -->
         <div class="form-outline mb-4">
           <input type="password" id="password" class="form-control form-control-lg" name="password" />
           <label class="form-label" for="password">Password</label>
         </div>

         <div class="d-flex justify-content-around align-items-center mb-4">
           <!-- Checkbox -->
           <div class="form-check">
             <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
             <label class="form-check-label" for="form1Example3"> Mich erinnern </label>
           </div>
           <a href="register.php">Register</a>
         </div>

         <!-- Submit button -->
         <button type="submit" class="btn btn-primary btn-lg btn-block login-form">Einloggen</button>

         

        

       </form>';
    
     }
     else {
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
                

                $price_array = array($pro_total);
                $total_sum =  array_sum($price_array);
                $total_amt = $total_amt + $total_sum;

                // create bootstrap card with each order from basket
                echo '<div class="card rounded-3 mb-4">
                <div class="card-body p-4">
                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-1 col-lg-1 col-xl-2">
                      <img
                        src="'.$product_image.'"
                        class="img-fluid rounded-3" alt="'.$product_name.'">
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-3">
                      <p class="lead fw-normal mb-2">'.$product_name.'</p>
                      <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 d-flex">
                      
                
                    
                        <h6 class="mb-0">'.$quantity.'</h6>
      
                      
                    </div>
                    
                    <div class="col-md-4 col-lg-3 col-xl-3 offset-lg-1 ">
                      <h5 class="mb-0">'.$price.'€ </h5> <h5>';
                  echo     (  $quantity > 1 ?   ' in total = '.$pro_total :'');

                  echo     (  $discount==="0 %" ? '' : ' discount: '.$discount);
                  echo '</h5>
                    </div>
                   
                  </div>
                </div>
              </div>
              
              ';


            }
          
           echo '
               <div class="card">
                    <div class="card-body p-5 d-flex flex-row">
                        
                    <div class="form-outline flex-fill">
                        <label class="form-label" for="form1">Versand Art</label>
                    </div>
                    <div class="form-check mr-5">
                    <input class="form-check-input" type="radio" name="versand" id="dhl" value="DHL" checked>
                    <label class="form-check-label" for="dhl">
                     DHL (€12)
                    </label>
                  </div>
                    <div class="form-check mr-5">
                    <input class="form-check-input" type="radio" name="versand" id="dpd" value="DPD" >
                    <label class="form-check-label" for="dpd">
                   DPD (€24)
                    </label>
                  </div>
                 
                  <div class="form-check mr-5">
                  <input price="33" class="form-check-input" type="radio" name="versand" id="dhl-express" value="DHL-EX">
                  <label class="form-check-label" for="dhl-express">
                   DHL Express (€33 )
                  </label>
                </div>
                  <div class="form-check">
                    <input  class="form-check-input" type="radio" name="versand" id="hermes" value="HERMES" disabled>
                    <label class="form-check-label" for="hermes">
                      hermes
                    </label>
                  </div>
                    </div>
                 </div>

                <div class="card mb-4">
                    <div class="card-body p-4 d-flex flex-row">
                        
                    <div class="form-outline flex-fill">
                        <label class="form-label" for="form1">Total Amount</label>
                    </div>
                        <h5 >€<span id="total">'.$total_amt.'</span></h5>
                    </div>
                    <div class="form-check p-4 m-4">
                      <input class="form-check-input" type="checkbox" value="1" id="datenschutz">
                      <label class="form-check-label" for="flexCheckDefault">
                      Datenschutzerklärung Akzeptieren
                       </label>
                    </div>
                 </div>
                <div class="card">
                
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-block btn-lg pay-confirm">Bestellung Abschließen</button>
                    </div>
                </div>';
        }
       
     }
    

 }
    
 // -------------------proceed to pay end ---------------
 
 // login form start 
 if(isset($_POST['email'] ) && isset($_POST['password'] ) ){
    function input_check($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data); 
       
        return $data;
      }
      function sha512($str,$salt){
        $hashedpass = hash("sha512",$str.$salt);
        return $hashedpass;
      }
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = input_check($_POST['email']);
        $password = sha512($_POST['password'],'abceree334234');
        $query = "select id,vorname from users where email='$email' && password = '$password' ";
       
        $result = mysqli_fetch_array(mysqli_query($con,$query));
        if($result > 0){
          $_SESSION['uid'] = $result["id"];
          $_SESSION['uname'] = $result["vorname"];
         //header("location:index.php");
         echo "welcome ". $_SESSION['uname'];

        }
        else {
         
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error ', true, 500);

        }
      }
 }

 // login form end

// get order overview start 
if(isset($_POST['get_order_overview'] )  ){
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
          

          $price_array = array($pro_total);
          $total_sum =  array_sum($price_array);
          $total_amt = $total_amt + $total_sum;

          // create bootstrap card with each order from basket
          echo '<div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-md-1 col-lg-1 col-xl-2">
                <img
                  src="'.$product_image.'"
                  class="img-fluid rounded-3" alt="'.$product_name.'">
              </div>
              <div class="col-md-4 col-lg-4 col-xl-3">
                <p class="lead fw-normal mb-2">'.$product_name.'</p>
                <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
              </div>
              <div class="col-md-1 col-lg-1 col-xl-1 d-flex">
                
          
              
                  <h6 class="mb-0">'.$quantity.'</h6>

                
              </div>
              
              <div class="col-md-4 col-lg-3 col-xl-3 offset-lg-1 ">
                <h5 class="mb-0">'.$price.'€ </h5> <h5>';
            echo     (  $quantity > 1 ?   ' in total = '.$pro_total :'');

            echo     (  $discount==="0 %" ? '' : ' discount: '.$discount);
            echo '</h5>
              </div>
             
            </div>
          </div>
        </div>
        
        ';


      }
    
     echo '
         <div class="card">
              <div class="card-body p-5 d-flex flex-row">
                  
              <div class="form-outline flex-fill">
                  <label class="form-label" for="form1">Versand Art</label>
              </div>
              <div class="form-check mr-5">
              <input class="form-check-input" type="radio" name="versand" id="dhl" value="DHL" checked>
              <label class="form-check-label" for="dhl">
               DHL (€12)
              </label>
            </div>
              <div class="form-check mr-5">
              <input class="form-check-input" type="radio" name="versand" id="dpd" value="DPD" >
              <label class="form-check-label" for="dpd">
             DPD (€24)
              </label>
            </div>
           
            <div class="form-check mr-5">
            <input class="form-check-input" type="radio" name="versand" id="dhl-express" value="DHL-EX">
            <label class="form-check-label" for="dhl-express">
             DHL Express (€33 )
            </label>
          </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="versand" id="hermes" value="HERMES" disabled>
              <label class="form-check-label" for="hermes">
                hermes
              </label>
            </div>
              </div>
           </div>

          <div class="card mb-4">
              <div class="card-body p-4 d-flex flex-row">
                  
              <div class="form-outline flex-fill">
                  <label class="form-label" for="form1">Total Amount</label>
              </div>
                  <h5 >€<span id="total">'.$total_amt.'</span></h5>
              </div>
           </div>
          <div class="card">
          
          
              <div class="card-body">
                  <button type="button" class="btn btn-warning btn-block btn-lg pay-confirm">Bestellung Abschließen123</button>
              </div>
          </div>';
  }
 
}
// get order overview end 

// ---------------- pay confirm start ---------------------
if(isset($_POST['pay_confirm'] ) &&  isset($_POST['versand'])  && isset($_SESSION['uid']) ){

$order_id = rand(); 
$versand = $_POST['versand'];
$versandKosten = 0;
switch ($versand) {
  case "DHL":
    $versandKosten = 12;
      break;
  case "DPD":
    $versandKosten = 24;
      break;
      case "DHL-EX":
        $versandKosten = 33;
      break;
}

$q = "insert into orders (order_id,product_id,user_id,product_name,product_image, quantity, price,shipping,total_amount)
select $order_id,product_id,$user_id, product_name ,product_image, quantity,price,'$versand',total_amount from warenkorb where user_id= $user_id";
$result = mysqli_query($con,$q);
if($result){
  $q_u = "update orders set total_amount = total_amount + $versandKosten where order_id = '$order_id' and user_id='$user_id' ";
  $result_u = mysqli_query($con,$q_u);
  $q_w = "delete from warenkorb where user_id='$user_id'    ";
  $result_w = mysqli_query($con,$q_w);
  if($result_w &&  $result_u){
    // user registerd 
      $q_user = "select * from users where id='$user_id'";
      $result_user = mysqli_query($con,$q_user);
      $row = mysqli_fetch_array($result_user);
      
   
          
         
        $myObj = array(
          0 => $row['vorname'],
          1 => $row['email'],
          2 => $order_id,
          3 => $versand,
          4 => $versandKosten
        );
          //echo $myObj;
          echo json_encode($myObj);
    
      
  
  }

  

}
else {
  die("error with order");
}

}
// ---------------- pay confirm end ---------------------

//------------------ get_bestellungen_products  start ----------------
if(isset($_POST['get_bestellungen_products'] )   && isset($_SESSION['uid']) ){
    $q="select * from orders where user_id='$user_id' ";
        $result = mysqli_query($con,$q);
        if(mysqli_num_rows( $result) >0){
          
            $total_amt = 0;
            while($row = mysqli_fetch_array($result)){
             
                $order_id = $row['order_id'];
                $product_id = $row['product_id'];
                $user_id = $row['user_id'];
                $product_name = $row['product_name'];
                $product_image = $row['product_image'];
                $quantity = $row['quantity'];
                $price = $row['price'];
                $shipping = $row['shipping'];
                $discount = "0 %";
                $total_amount =   $row['total_amount'];
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
                

                $price_array = array($pro_total);
                $total_sum =  array_sum($price_array);
                $total_amt = $total_amt + $total_sum;

                // create bootstrap card with each order from basket
                echo '<div class="card rounded-3 mb-4">
                <div class="card-body p-4">
                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                    <span   style ="font-size:16px;">BTL: '.$order_id.'</span>
                      <img
                        src="'.$product_image.'"
                        class="img-fluid rounded-3" alt="'.$product_name.'">
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-3">
                      <p class="lead fw-normal mb-2">'.$product_name.'</p>
                      <p><span class="text-muted">Size: </span>M <span class="text-muted">Color: </span>Grey</p>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 d-flex">
                      
                
                    
                        <h6 class="mb-0">'.$quantity.'</h6>
      
                      
                    </div>
                    
                    <div class="col-md-4 col-lg-3 col-xl-3 offset-lg-1 ">
                      <h5 class="mb-0">'.$total_amount.'€ </h5> <h5>';
                  echo     (  $quantity > 1 ?   ' in total = '.$pro_total :'');

                  echo     (  $discount==="0 %" ? '' : ' discount: '.$discount);
                  echo '</h5>
                  <button prid="'.$product_id.'" bid="'.$order_id.'" class="btn btn-warning btn-block btn-sm buy-now "> 1 Click buy again </button>
                    </div>
                   
                  </div>
                </div>
              </div>
              
              ';


            }
          
           echo '
               <div class="card">
                   

                <div class="card mb-4">
                    <div class="card-body p-4 d-flex flex-row">
                        
                    <div class="form-outline flex-fill">
                        <label class="form-label" for="form1">Total Amount</label>
                    
                    </div>
                        <h5 >€<span id="total">'.$total_amt.'</span></h5>
                </div>
                    
                 </div>
                ';
        }
      
    
}

//------------------ get_bestellungen_products  start ----------------

//------------------ buy again  START ---------------
if(isset($_POST['prid'])   && isset($_SESSION['uid']) && isset($_POST['bid']) ){
  $prid = $_POST['prid'];
  $bid = $_POST['bid'];
  $q="select * from orders where user_id='$user_id' and product_id = '$prid' and order_id ='$bid' ";
        $result = mysqli_query($con,$q);
        if(mysqli_num_rows( $result) >0){
          $row = mysqli_fetch_array($result);
         // echo $row['product_name'];
          $order_id = rand();
          $product_name = $row['product_name'];
          $product_id = $row['product_id'];
          $product_quantity = $row['quantity'];
          $product_image = $row['product_image'] ;
          
          $product_price = $row['price'];
          $shipping= $row['shipping'];
          $total_amount= $row['total_amount'];
          

          

 

          $q_i = "insert into orders (order_id,product_id,user_id,product_name,product_image, quantity, price,shipping,total_amount)
          VALUES('$order_id','$product_id','$user_id','$product_name','$product_image','1','$product_price','$shipping','$total_amount')";
          
          $result_i = mysqli_query($con,$q_i);
          if($result_i){
            
            $myObj = array(
              0 =>  $_SESSION['uname'],
              1 =>  $_SESSION['email'],
              2 => $order_id,
              3 => $shipping,
              4 => $product_quantity,
              5 => $product_name,
              6 => $total_amount
            );
              //echo $myObj;
              echo json_encode($myObj);
               
                  //echo "die neue Bestellung ist Abgeshlossen Vielen Dank!!";
          }
          else {
            die("Error mit der Bestellung!!!");
          }



   }
  
}

//------------------ buy again END ---------------

}



?>