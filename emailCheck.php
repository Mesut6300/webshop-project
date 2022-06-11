<?php 
include_once('includes/db.php');
function sha512($str,$salt){
  $hashedpass = hash("sha512",$str.$salt);
  return $hashedpass;
}
function input_check($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    

  $emailInput  = input_check($_POST['email']);
  //$emailInput = "max.bob@gmail.com";
$query= "select email from users where email = '".$emailInput."'";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result)> 0){

  die("Error: email exist please use another one!!!");
}
else{ // email ist nicht existeirt 
  $vorname =input_check($_POST['vorname']);
  $nachname = input_check($_POST['nachname']);
  $emailInput  = input_check($_POST['email']);
 // $password = md5($_POST['password']);
 $password = sha512(mt_rand(10000000,99999999),'abceree334234');
   

 $query = "insert into users (vorname,nachname,email,password) values('$vorname','$nachname','$emailInput','$password')";
// echo $query;
 $result = mysqli_multi_query($con,$query);
  if($result){
    $link = "http:localhost/webshop/changePassword.php?pass=".$password;
     //echo "user registerd successfully";
     echo $link;
    

  }

}





}


 
?> 