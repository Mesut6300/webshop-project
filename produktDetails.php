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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
  <?php
    include_once("header.php");
    $produktId = $_GET['id'];
     include_once('includes/db.php'); // datenbank verbindung
   $query = "select * from products where id=".$produktId ;
   
   $result = mysqli_query($con,$query);
   //$r =  mysqli_fetch_array($result);
  // print_r($r);
   if(mysqli_num_rows($result) > 0)
   {
    $row = mysqli_fetch_array($result);
 

   
 
   ?>
<!-- Product section-->
<section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $row['image'] ?>" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder"><?php echo $row['name'] ?></h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through"> <?php echo $row['price']+50 ?>€</span>
                            <span> <?php echo $row['price'] ?>€</span>
                        </div>
                        <p class="lead"><?php echo  $row['description'] ?></p>
                        <div class="d-flex">
                            <!-- <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" /> -->
                            <button pid="<?php echo $row['id']; ?>" class="btn btn-outline-dark flex-shrink-0 add-btn" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Hinzuzufügen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
   }
   else {
    
    ?>
   <div class="alert alert-danger" role="alert">
  keine Daten fur die produkt
</div>
<?php }
  ?> 
  
   
        
  <?php include_once("footer.php") ?> 
</body>
</html>