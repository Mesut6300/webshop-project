<?php 
include_once('includes/db.php');
$emailInput = $_POST['email'];
//$emailInput = "max.bob@gmail.com";
$query= "select email from users where email = '".$emailInput."'";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result)> 0){

   // echo "email exisit";
   return ;
}
else{
  echo "email available";
}
 
?> 