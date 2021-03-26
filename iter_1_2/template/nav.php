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
        <?php if ($_SESSION['username'] == 'root'):?> <!--Change this to admin-->
        <li><a href="/dbmaintain.php">Db maintain <i class="fas fa-table"></i></a></li>
        <?php endif;?>
        <li><a href="#about" id="aboutus">About Us <i class="fas fa-user"></i></a></li>
        <li><a href="#contact" id="contactus">Contact Us <i class="fas fa-phone"></i> </a></li>
        <li><a href="/review.php">Reviews <i class="fas fa-star"></i> </a></li>
        <li><a href="#">Cart <i class="fas fa-shopping-cart"></i>
          <div class="cart-box"></div>
        </a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Services <i class="fas fa-arrow-down"></i></a></li>
        <?php if (!isset($_SESSION['username'])): ?>
          <li><a href="/signup.php">Sign Up <i class="fas fa-users"></i> </a></li>
          <?php else: ?>
            <li><a class="dropdown-trigger" data-target="dropdown2" href="/">Welcome, <?php echo $_SESSION['username']; ?> <i class="fas fa-user"></i> </a></li>
          <?php endif; ?>
          <li><a href="#" onclick="$('.search').fadeIn();"><i class="fas fa-search"></i>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="/">Home <i class="fas fa-home"></i></a></li>
    <li><a href="/dbmaintain.php">Db maintain </a></li>
    <li><a href="#about">About Us <i class="fas fa-user"></i></a></li>
    <li><a href="#contact">Contact US <i class="fas fa-phone"></i> </a></li>
    <li><a href="/signup.php">Sign Up <i class="fas fa-user"></i></a></li>
    <li><a href="/review.php">Reviews <i class="fas fa-star"></i> </a></li>
    <li><a href="#">Cart <i class="fas fa-shopping-cart"></i>

    </a></li>
    <li>Services</li>
    <li class="divider"></li>
    <li><a href="/service.php?type=driver">Drivers</a></li>
    <li><a href="/service.php?type=store">Stores</a></li>
  </ul>


<?php if ($_SESSION['username']): ?>
<!-- <nav> -->
  <!-- <div class="nav-wrapper pink accent-3"> -->
  <div class="search" style="display:none">

    <form class="right" method="get">
      <div class="white row">
        <div class="input-field col col-s2">
          <input id="search-1" name="user_id" type="number" required>
          <label for="search-1"> UserID</label>
        </div>
        <div class="input-field col col-s2">
          <input id="search-2" name="order_id" type="number" required>
          <label for="search-2">OrderID</label>
        </div>
        <div class="input-field col col-s2">
          <input class="btn-small"id="search-2" name="search" value="search" type="submit" required>
        </div>
      </div>
    </form>
  </div>

  <!-- </div> -->
<!-- </nav> -->
<?php endif; ?>

<?php
  if (isset($_GET['search'])){
    header("location: http://localhost:3000?u=".$_GET['user_id']."&o=".$_GET['order_id']."#search");
  }
?>
