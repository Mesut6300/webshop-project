<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
      img{
        max-height:300px;
        max-width:450px;
      }
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
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
   <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                   
                <?php
         while($row = mysqli_fetch_array($result)){
       ?>
       
       <div class="col mb-5">
       <div class="card h-100">
          <!-- Sale badge-->
       <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
         <!-- Product image-->
         <a href="produktDetails.php?id=<?php echo $row['id'] ?>">
         <img class="card-img-top" src="<?php echo $row['image'] ?>" alt="<?php echo $row['name']; ?>" />
         </a>
         <!-- Product details-->
          <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    
                                    <h5 class="fw-bolder">
                                    <a href="produktDetails.php?id=<?php echo $row['id'] ?>">  
                                    <?php echo $row['name'];    ?>
                                    </a></h5>
                                   
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through"><?php echo $row['price']+50 ?>€</span>
                                    <?php echo $row['price'] ?> €
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a pid="<?php echo $row['id']; ?>"  href="#" class="btn btn-outline-dark mt-auto add-btn" >Hinzuzufügen</a></div>
                            </div>
              
              </div>
               
        </div>
       
      

       <?php
   }
  ?> 
           
                </div>
            </div>
        </section>
  
        <?php include_once("footer.php") ?> 
        
       
        <script>
             warenkorb_count();
        </script>
</body>
</html>