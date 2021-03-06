<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            // https://dashboard.emailjs.com/admin/account
            emailjs.init('POBDAzf4ddSOMpcPm');
        })(); 
      </script>
  </head>
<body>
<?php

include_once("header.php");
//  include_once('includes/db.php');
// function input_check($data){
//   $data = trim($data);
//   $data = stripcslashes($data);
//   $data = htmlspecialchars($data); 
 
//   return $data;
// }
// function sha512($str,$salt){
//   $hashedpass = hash("sha512",$str.$salt);
//   return $hashedpass;
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $email = input_check($_POST['email']);
//   $password = sha512($_POST['password'],'abceree334234');
//   $query = "select id,vorname from users where email='$email' && password = '$password' ";
//   echo $_POST['password'];
//   $result = mysqli_fetch_array(mysqli_query($con,$query));
//   if($result > 0){
//     $_SESSION['uid'] = $result["id"];
//     $_SESSION['uname'] = $result["vorname"];
//     $q="UPDATE users SET lastactivity = now() WHERE id = ".$result['id'];
//     echo $q;
//     $result_update = mysqli_query($con,$q);
    
    
//     //header("location:index.php");
//     echo "<script>window.location.href='dashboard.php'; </script>";
//   }
//   else {
//    // echo $query;
//     echo "<script>alert('invalid data'); </script>";
//   }
// }



?>
     <div class="container">
    <h1>Login</h1>
    <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="./images/store.png"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method ="post" id="ajax-login-form">
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
          <button   class="btn btn-primary btn-lg btn-block">Einloggen</button>

          

         

        </form>
      </div>
    </div>
  </div>
</section>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $( "#ajax-login-form" ).submit(function( event ) {
    
    event.preventDefault();
    const email = $('#email').val();
    const password = $('#password').val(); 
    $.ajax({
      url:'loginprocess.php',
      method:'post',
      data:{email , password, width: screen.width, height:screen.height
     },
      success: function(data){
        //alert(data);
       
      
      // $("#warebkorb-content").html(`<div class="mt-4 alert alert-success" role="alert"> ${data}  </div>`);
        // emailjs.send("service_hnto9q5","template_rv9tu18",{
        // to_name: json_data[0],
        // from_name: "Webshop Team",
        // message: "Hallo ihre password ist: "+json_data[2],
        // reply_to: json_data[1],
        // user_email: json_data[1]
        // })
        // .then(function() {
        //                 console.log('SUCCESS!');
        //             }, function(error) {
        //                 console.log('FAILED...', error);
        //             });
          window.location.href='dashboard.php';
      },
      error : function(err){
        $("#warebkorb-content").append('<div class="mt-4 alert alert-danger" role="alert">  Error with email or pass  </div>');
        console.log(err);
      }
    });
  });
</script> 
</body>
</html>