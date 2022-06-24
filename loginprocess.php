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
    $_SESSION['email'] = $result["email"];
    $_SESSION['screen_width'] = $_POST['width'];
    $_SESSION['screen_height'] = $_POST['height'];
    $q="UPDATE users SET lastactivity = now() ,status =1 WHERE id = ".$result['id'];
    
    $result_update = mysqli_query($con,$q);
    $q_d="delete from warenkorb where user_id=0    ";
   
    
    $result_d =  mysqli_query($con,$q_d);

    $client = $_SERVER['HTTP_USER_AGENT'][1];
    
    $resolution = $_SESSION['screen_width']." x ".$_SESSION['screen_height']." px"; 
    $query_log = "insert into users_logs (user_id,screen_resolution,os) VALUES('".$result["id"]."','$resolution','windows 10')";
    $result_log = mysqli_query($con,$query_log);
    if($result_log){
        echo "added to users logs!";
        $q_online = "select * from users where status=1 ";
  
        $count_online = mysqli_num_rows( mysqli_query($con,$query));
        $_SESSION['online'] = $count_online;
       
    }

   
  
    echo "<script>window.location.href='dashboard.php'; </script>";
  }
  else {
   // echo $query;
    echo "<script>alert('invalid data'); </script>";
   // exit();
  }
}

?>