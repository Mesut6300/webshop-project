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
<?php include_once("header.php");

 include_once('includes/db.php');


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
        <form id="register">
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
          <!-- <div class="form-outline mb-4">
            <input type="password" id="password" class="form-control form-control-lg" name="password" />
            <label class="form-label" for="form1Example23">Password</label>
          </div> -->

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
 <script>
     $("document").ready(function(){
      $('#register').submit(function(event){
          event.preventDefault();
          if($('#vorname').val() === "" || $('#nachname').val()=== "" || $('#email').val() === "" ){
            alert("inputs must not empty!!!");
            return false;
          }
         
        
          $.ajax({
            type:"POST",
            url:"emailCheck.php",
            data :{email : $('#email').val(),
                   vorname: $('#vorname').val(),
                   nachname :$('#nachname').val()                  
                    
            },
            success: function(data){
              console.log(data)
              const json_data = JSON.parse(data);
              console.log(json_data);
              emailjs.send("service_hnto9q5","template_rv9tu18",{
              to_name: json_data[0],
              from_name: "Webshop Team",
              message: "Hallo ihre password ist: "+json_data[2],
              reply_to: json_data[1],
              user_email: json_data[1]
              })
              .then(function() {
                              console.log('SUCCESS!');
                          }, function(error) {
                              console.log('FAILED...', error);
                          });
              
            },
            error : function(err){
              alert(err);
            }
          });
  
         
   });
     })
   
  
 
 </script>
    
    
</body>
</html>