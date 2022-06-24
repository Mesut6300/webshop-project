<?php
include_once('includes/db.php');
session_start();
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
  $query = "select id,vorname,email from users where email='$email' && password = '$password' ";
  //echo $_POST['password'];
  $result = mysqli_fetch_array(mysqli_query($con,$query));
  if($result > 0){
    $_SESSION['uid'] = $result["id"];
    $_SESSION['uname'] = $result["vorname"];
    $q="UPDATE users SET lastactivity = now() WHERE id = ".$result['id'];
    //echo $q;
    $result_update = mysqli_query($con,$q);
    $q_d="delete from warenkorb where user_id=0    ";
   
    
    $result_d =  mysqli_query($con,$q_d);

   


   
    // $myObj = array(
    //   0 => $result["vorname"],
    //   1 => $result["email"],
    //   2 => $_POST['password']
    // );
 

    // echo json_encode($myObj);
   // echo  $_POST['password'];
    
    //header("location:index.php");
    echo "<script>window.location.href='dashboard.php'; </script>";
  }
  else {
   // echo $query;
    echo "<script>alert('invalid data'); </script>";
   // exit();
  }
}

?>