<?php 
include_once('includes/db.php');

// random password generator 
function getRandom($n) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
      $index = rand(0, strlen($characters) - 1);
      $randomString .= $characters[$index];
  }
  
  return $randomString;
}
// function for password hash
function sha512($str,$salt){
  $hashedpass = hash("sha512",$str.$salt);
  return $hashedpass;
}
// function to cloean inputs
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
 // standars password ist : pass-web
 $randomPassword = getRandom(8);
 $password = sha512($randomPassword,'abceree334234');
   

 $query = "insert into users (vorname,nachname,email,password,initialPass,status) values('$vorname','$nachname','$emailInput','$password','$randomPassword','0')";
// echo $query;
 $result = mysqli_multi_query($con,$query);
  if($result){ // user registerd 
    $myObj = array(
      0 => $_POST['vorname'],
      1 => $_POST['email'],
      2 => $randomPassword
    );
 

    echo json_encode($myObj);
    
     //echo "user registerd successfully";

     // email send 
     // after login show form to change password
    
    

  }

}





}


 
?> 