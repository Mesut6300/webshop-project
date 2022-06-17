<?php  session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Webshop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="produkte.php">Produkte</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo (isset($_SESSION['uname']) ? ' <i class="fas fa-user"  ></i> '.$_SESSION['uname'] : 'Pages'); ?> 
           
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php">Homepage</a></li>
            <li><a class="dropdown-item" href="produkte.php">Produkte</a></li>
           
            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
            <?php
            if( isset($_SESSION['uid']) ):?>

         
            <li><a class="dropdown-item" href="warenkorb.php">Warenkorb</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            <?php  else: ?> 
              <li><a class="dropdown-item" href="login.php">Login</a></li>
            <li><a class="dropdown-item" href="register.php">Register</a></li>
            <?php endif; ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
       
      </ul>
      <form class="d-flex pl-3">
        <input class="form-control me-2" type="search" placeholder="Begriff eingeben" aria-label="Suche">
        <button class="btn btn-outline-success" type="submit">Suche</button>
      </form>
      <form class="d-flex">
        
                     
                        <a href="warenkorb.php" class="btn btn-outline-light" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            
                            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                            
                       </a>
                        
                        
      </form>
      
    </div>
  </div>
</nav>

