<?php  include './template/header.php';?>
<?php include './template/nav.php' ?>
<?php

  include './back-end/back-end/Controller/MainController.php';
  $main = new MainController();
  $allSearch = array();
  if (isset($_SESSION['username'])) {
    // code...
    $user = $main->getUser($_SESSION['username'])->fetch_assoc();
    $searchs  = $main->search($user['CUSTOMER_ID'], $_GET['s']);
    while ($search = $searchs->fetch_assoc()) {
      $allSearch[] = $search;
    }
  }else {echo 'No session';}
 // ?>


<!-- <?php foreach ($allSearch as $s): ?>
  <p><?php echo $s['STORE_CODE'] ?></p>
<?php endforeach; ?> -->
