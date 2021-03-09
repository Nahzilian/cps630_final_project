<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>

<?php
  if (isset($_GET['sign']) && $_GET['sign'] === 'out') {
    session_destroy();
    header("Location: /");
  }
 ?>

<div class="container">
  <br /><br />
  <div class="row">
    <div class="col s12 m12 l6 content-blk">
      <h2>Welcome To Devil May Air</h2>
      <blockquote>
        Over the past few years, the living conditions of everyone have been affected heavily by the carbon emissions caused by industrial waste or transportation. Several solutions have been developed in order to tackle this problem, and they all show promising results.
        <br /><br />
        The project applies the “Plan for Smart Services” (P2S) Web application methodology as a mean of creating potential services help reduce air pollution. The web application is developed under the LAMP stack (Linux, Apache, MySQL, PHP) with MVC architecture. Additionally, the web app includes open libraries such as google map, SASS, JQuery to assist the system.
      </blockquote>
      <div class="submit-btn">
        <?php if($_SESSION['username']):?>
          <a href="./index.php"><button class="pink accent-3 waves-effect waves-light btn btn-large" type="button" name="sign Up">Sign Up</button></a>
        <?php else: ?>
          <a href="./signup.php"><button class="pink accent-3 waves-effect waves-light btn btn-large" type="button" name="sign Up">Sign Up</button></a>
        <?php endif;?>
      </div>
    </div>
    <div class="col s12 m12 l6 driver content-blk">
    </div>
  </div>

  <br /><br />

  <div class="destination_source">
      <div class="row">
        <div class="input-field col s12 submit-btn">
          <h4>Pick your ride now!</h4>
        </div>
        <div class="input-field col s12">
          <input type="text" id="source" class="autocomplete">
          <label for="source"><i class="fas fa-map-marker-alt"></i> Source</label>
        </div>
        <div class="input-field col s12">
          <input type="text" id="destin" class="autocomplete">
          <label for="destin"><i class="fas fa-map-marker-alt"></i> Destination</label>
        </div>
        <div class="col s12">
          <label>
            <input type="checkbox" id ="check-ride-deliver" class="filled-in" onchange="onCheckInput(this)"/>
            <span>Ride and deliver</span>
          </label>
        </div>
        <div class="input-field col s12">
          <input type="text" id="item-input" class="autocomplete" disabled>
          <label for="item-input"><i class="fas fa-keyboard"></i> Item</label>
        </div>
        <div class="input-field col s12 submit-btn">
          <a class="grey accent-3 waves-effect waves-light btn btn-large">Ride & Deliver</a>
        </div>
      </div>
    </div>
  </div>

</div>


<?php

  include './back-end/back-end/Controller/MainController.php';
  $main = new MainController();
  $allSearch = array();
  if (isset($_SESSION['username'])) {
    // code...
    // $user = $main->getUser($_SESSION['username'])->fetch_assoc();
    if (isset($_GET['u'])) {
      // code...
      $searchs  = $main->search($_GET['u'], $_GET['o']);
      while ($search = $searchs->fetch_assoc()) {
        $allSearch[] = $search;
    }
    }
  }else {echo 'No session';}
 // ?>


<!-- <?php foreach ($allSearch as $s): ?>
  <p><?php echo $s['STORE_CODE'] ?></p>
<?php endforeach; ?> -->


<script type="text/javascript">
  function onCheckInput(checkbox) {
    console.log("It worked")
    document.getElementById('item-input').disabled = true;
    if(checkbox.checked === true) {
      document.getElementById('item-input').disabled = false;
    }
  }
</script>




<?php include './template/contact_about.php' ?>


<?php if (isset($_GET['u'])): ?>
  <div class="right" id="search">
      <?php if (count($allSearch) >= 1): ?>
        <h4>
          Order Through!
      </h4>
      <?php else: ?>
        <h4>
          Order Does Not Exist!
      </h4>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php include './template/footer.php' ?>
