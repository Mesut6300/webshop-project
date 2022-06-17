<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
  
  <?php include_once("header.php");

  function input_check($data){
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
      return $data;
  } 
   include_once('includes/db.php'); // datenbank verbindung
  if ($_SERVER["REQUEST_METHOD"] == "POST") { // form werte
           
      $productName =input_check($_POST['productName']);
      $description = input_check($_POST['description']);
      $price = input_check($_POST['price']);     
      $quantity = input_check($_POST['quantity']);
      $image =  input_check($_POST['image']);
      
      $query = "insert into products (name,description,price,quantity,image) values('$productName','$description','$price','$quantity','$image')";
      echo $query;
      $result = mysqli_multi_query($con,$query);
      if($result){
          echo '<script>alert("new product added!!")</script>';
      }

}
      

  ?>
    
<div class="container">
    <h1>Add Product</h1>
    <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method ="post">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" id="productName" class="form-control form-control-lg" name="productName" />
            <label class="form-label" for="form1Example13">Product Name</label>
          </div>

          <div class="form-outline mb-4">
            <textarea type="text" id="nachname" class="form-control form-control-lg" name="description" > </textarea>
            <label class="form-label" for="form1Example13">description</label>
          </div>
          <div class="form-outline mb-4">
            <input type="number" id="price" class="form-control form-control-lg" name="price" />
            <label class="form-label" for="form1Example13">Price</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="number" id="quantity" class="form-control form-control-lg" name="quantity" />
            <label class="form-label" for="form1Example23">Quantity</label>
          </div>
          <div class="form-outline mb-4">
            <input type="text" id="image" class="form-control form-control-lg" name="image" />
            <label class="form-label" for="image">Image</label>
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            
            
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>

          

         

        </form>
      </div>
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="./images/store.png"
          class="img-fluid" alt="Phone image">
      </div>
    </div>
  </div>
</section>

</div>
<?php include_once("footer.php") ?> 
</body>
</html>