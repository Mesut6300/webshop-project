<?php 
session_start();
include_once('includes/db.php');
if(isset($_SESSION['uid'])){
    
    $query = "select * from users where id='". $_SESSION['uid']."'";
  
    $result = mysqli_fetch_array(mysqli_query($con,$query));
    
    
    if($result > 0){
        $q="UPDATE users set status = 0 WHERE id = ". $_SESSION['uid'];
    
        $result_update = mysqli_query($con,$q);
        

        
    }

}


session_unset();
session_destroy();
header("location:index.php");
?> 