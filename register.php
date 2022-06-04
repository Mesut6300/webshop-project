<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include_once("header.php");
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
 include_once('includes/db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    
    $vorname =input_check($_POST['vorname']);
    $nachname = input_check($_POST['nachname']);
    $email = input_check($_POST['email']);
   // $password = md5($_POST['password']);
   $password = sha512($_POST['password'],'abceree334234');
     
    echo '<script>alert("after send  post data")</script>';
   $query = "insert into users (vorname,nachname,email,password) values('$vorname','$nachname','$email','$password')";
  // echo $query;
   $result = mysqli_multi_query($con,$query);
    if($result){
        echo '<script>alert("you are registered!")</script>';
    }

}

?>

  
    <div class="container">
    <h1>Register</h1>
    <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="./images/store.png"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method ="post">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" id="vorname" class="form-control form-control-lg" name="vorname" />
            <label class="form-label" for="form1Example13">Vorname</label>
          </div>

          <div class="form-outline mb-4">
            <input type="text" id="nachname" class="form-control form-control-lg" name="nachname" />
            <label class="form-label" for="form1Example13">Nachname</label>
          </div>
          <div class="form-outline mb-4">
            <input type="email" id="email" class="form-control form-control-lg" name="email" />
            <label class="form-label" for="form1Example13">Email Address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" id="password" class="form-control form-control-lg" name="password" />
            <label class="form-label" for="form1Example23">Password</label>
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
            <a href="login.php">Login</a>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block">Sign up</button>

          

         

        </form>
      </div>
    </div>
  </div>
</section>

</div>
<?php include_once("footer.php") ?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>