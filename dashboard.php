<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  
    <?php 
    session_start();
    include_once('includes/db.php');
    include_once("header.php");
    ?>
      <div class="container">
    <?php
    if(strlen($_SESSION["uid"] ) == 0){
        echo "<script>window.location.href='logout.php'; </script>";
    }
    $userId = $_SESSION["uid"];
     
    $query = "select * from users where id=$userId";
 
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result)){
        ?>
        
        <h3> Hallo <?php echo $row['vorname']." ".$row['nachname'];    ?> wilkommen </h3>

        <?php
    }

    
 
    ?> 
    <h1>Dashboard</h1>
    
    </div>
    <?php include_once("footer.php") ?> 
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>