<?php

  include './back-end/back-end/Controller/MainController.php';
  $main = new MainController();
  $allSearch = array();
  if (isset($_SESSION['username'])) {
    // code...
    $user = $main->getUser($_SESSION['username'])->fetch_assoc();
    $searchs  = $main->search($user['CUSTOMER_ID'], $_GET['search']);
    while ($search = $searchs->fetch_assoc()) {
      $allSearch[] = $search;
    }
  }
 ?>


<?php foreach ($allSearch as $s): ?>
  <p><?php echo $s['STORE_CODE'] ?></p>
<?php endforeach; ?>
