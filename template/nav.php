<nav>
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="/service.php?type=driver">Drivers</a></li>
    <li class="divider"></li>
    <li><a href="service.php?type=store">Stores</a></li>
  </ul>
  <?php if (isset($_SESSION['username'])): ?>

  <ul id="dropdown2" class="dropdown-content">
    <li><a href="/?sign=out">Sign out</a></li>
    <li class="divider"></li>
    <li><a href="#">profile</a></li>
  </ul>
<?php endif; ?>
    <div class="nav-wrapper pink accent-3">
      <a href="/" class="brand-logo"> <img src="./res/img/logo.png" alt=""> </a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="/">Home <i class="fas fa-home"></i></a></li>
        <li><a href="#about" id="aboutus">About Us <i class="fas fa-user"></i></a></li>
        <li><a href="#contact" id="contactus">Contact Us <i class="fas fa-phone"></i> </a></li>
        <li><a href="/review.php">Reviews <i class="fas fa-star"></i> </a></li>
        <li><a href="#">Cart <i class="fas fa-shopping-cart"></i>
          <div class="cart-box"></div>
        </a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Servicess <i class="fas fa-arrow-down"></i></a></li>
        <?php if (!isset($_SESSION['username'])): ?>
          <li><a href="/signup.php">Sign Up <i class="fas fa-users"></i> </a></li>
          <?php else: ?>
            <li><a class="dropdown-trigger" data-target="dropdown2" href="/">Welcome, <?php echo $_SESSION['username']; ?> <i class="fas fa-user"></i> </a></li>
          <?php endif; ?>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="/">Home <i class="fas fa-home"></i></a></li>
    <li><a href="#about">About Us <i class="fas fa-user"></i></a></li>
    <li><a href="#contact">Contact US <i class="fas fa-phone"></i> </a></li>
    <li><a href="/signup.php">Sign Up <i class="fas fa-user"></i></a></li>
    <li><a href="/review.php">Reviews <i class="fas fa-star"></i> </a></li>
    <li><a href="#">Cart <i class="fas fa-shopping-cart"></i>

    </a></li>
    <li>Services</li>
    <li class="divider"></li>
    <li><a href="/service.php?type=driver">Drivers</a></li>
    <li><a href="service.php?type=store">Stores</a></li>
  </ul>
