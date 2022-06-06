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
    <img style="width:100px" src="https://static2.o9.de/resource/blob/1146388/b5ff0d86472f9fe5ce3cc4dd72cb0c32/article-item-4510-300981-00-imagebig-picture-data.png" class="card-img-top" alt="...">

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
    
    <!-- <div class="card" style="width: 18rem;">
        <img style="width:70%" src="https://static2.o9.de/resource/blob/1146388/b5ff0d86472f9fe5ce3cc4dd72cb0c32/article-item-4510-300981-00-imagebig-picture-data.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img style="width:70%" src="https://static2.o9.de/resource/blob/1146388/b5ff0d86472f9fe5ce3cc4dd72cb0c32/article-item-4510-300981-00-imagebig-picture-data.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div> -->

  <div class="col">
    <div class="card h-100">
    <img style="width:100px" src="https://static2.o9.de/resource/blob/1146388/b5ff0d86472f9fe5ce3cc4dd72cb0c32/article-item-4510-300981-00-imagebig-picture-data.png" class="card-img-top" alt="...">

      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
    <img style="width:100px" src="https://static2.o9.de/resource/blob/1146388/b5ff0d86472f9fe5ce3cc4dd72cb0c32/article-item-4510-300981-00-imagebig-picture-data.png" class="card-img-top" alt="...">

      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img style="width:100px" src="https://static2.o9.de/resource/blob/1146388/b5ff0d86472f9fe5ce3cc4dd72cb0c32/article-item-4510-300981-00-imagebig-picture-data.png" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
</div>
    </div>
    
</body>
</html>