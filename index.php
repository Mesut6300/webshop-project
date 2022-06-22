<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        #myCarousel{
            height:500px;
            background:#ccc;
        }
    </style>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include_once("header.php") ?> 
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
      
       <img style="width:100%;height:500px" src="https://www.test.de/file/image/35/35/c9c7568b-f4b4-4e1f-a642-3473e5132595-web/5752472_Smartphones-072021_neu.jpg" alt="">
        
        <div class="container">
          <div class="carousel-caption text-start">
          
          <!-- <img style="float: right;"  src="./Images/sm.jpg" /> -->
          <h1>Nur kurzristig günstige Smartphones!</h1>
            <p><a class="btn btn-lg btn-primary" href="#">Zu den Angeboten</a></p>
            
          </div>
        </div>
      </div>
      <div class="carousel-item">
       <img style="height:500px;width:100%" src="https://blog.notebooksbilliger.de/wp-content/uploads/2020/03/Kaufberater-g%C3%BCnstige-Office-Notebooks-Twitter.jpg" alt="">

        <div class="container">
          <div class="carousel-caption">
            <h1>Riesen Auswahl an Notebooks</h1>
            
            <p><a class="btn btn-lg btn-primary" href="#">Zu den Angeboten</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
      <img style="height:500px;width:100%" src="https://marketing-media.flip4new.de/seobilder/Gebrauchte-Konsole-verkaufen-online.png" alt="">

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Konsolen fast ausverkauft</h1>
            <p>Nur heute, keine Versandkosten</p>
            <p><a class="btn btn-lg btn-primary" href="#">Hier klicken</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
    <h1>Willkommen auf unserem Webshop!</h1>
    <img src="./Images/store.png" class="d-block w-50" alt="...">
    <?php include_once("footer.php") ?> 
    
   
    
   
</body>
</html>