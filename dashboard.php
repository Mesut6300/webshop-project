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
  
    <?php 
   
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
   ?>

    <h1>Dashboard</h1>
     <!-- Background image -->
     <?
     while($row = mysqli_fetch_array($result)){
      $day =  date('l',strtotime($row['lastactivity']));
      $lastlogin =  date("d.m.Y", strtotime($row['lastactivity']));
    
        ?>
        <div
    id="intro-example"
    class="p-5 text-center bg-image"
    style="background-image: url('https://images.pexels.com/photos/3586966/pexels-photo-3586966.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');"
  >
    <div class="mask mt-5 mb-5" style="background-color: rgba(0, 0, 0, 0.4);">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white mt-3">
          <h3 class="mb-3">Hallo <?php echo $row['vorname']." ".$row['nachname'];    ?></h3>
          <h4 class="mb-4">     sie waren zuletzt am <?php echo $day." ".$lastlogin;  ?> angemeldet  </h4> 
          <a
            class="btn btn-outline-light btn-lg m-3"
            href="bestellungen.php"
            role="button"
            rel="nofollow"
            target="_blank"
          >Gekaufte Artikel</a
          >
          <a
            class="btn btn-outline-light btn-lg m-2"
            href="warenkorb.php"
            target="_blank"
            role="button"
          >Warenkorb</a
          >
        </div>
      </div>
    </div>
  </div>
        
        

        <?php
    }

    
 
    ?> 
  
  <!-- Background image -->
    
    </div>
    <?php include_once("footer.php") ?> 
    <script>
       warenkorb_count();
    </script>
  
</body>
</html>