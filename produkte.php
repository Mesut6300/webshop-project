<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  <?php
    include_once("header.php");

     include_once('includes/db.php'); // datenbank verbindung
   $query = "select * from products " ;
   
   $result = mysqli_query($con,$query);
   ?>
   <h1>Produkte</h1>
    <div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
         while($row = mysqli_fetch_array($result)){
       ?>
        <div class="card h-100">
            <img style="width:100px" src="<?php echo $row['image'] ?>" alt="<?php echo $row['name'];    ?>" />
              <div class="card-body">
                <h5 class="card-title"> <?php echo $row['name'];    ?></h5>
                <p class="card-text"> <?php echo $row['description'];    ?>.</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated 3 mins ago</small>
              </div>
        </div>
       
      

       <?php
   }
  ?> 
   
</div>
    </div>
    
</body>
</html>