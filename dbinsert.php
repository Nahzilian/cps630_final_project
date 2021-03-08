<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>

<?php include './back-end/back-end/Controller/MainController.php';

$mainControl = new MainController();
$table = $_GET['table'];
$results;
if (!empty($table)){
    if ($table == 'car') $results = $mainControl->getCarInfo();
    else if ($table == 'customer' ) $results = $mainControl->getCustomerInfo();
    else if ($table == 'customer_order' ) $results = $mainControl->getCustomerOrderInfo();
    else if ($table == 'driver_review' ) $results = $mainControl->getDriverReviewInfo();
    else if ($table == 'flower' ) $results = $mainControl->getFlowerInfo();
    else if ($table == 'product_review' ) $results = $mainControl->getProductReviewInfo();
    else if ($table == 'trip' ) $results = $mainControl->getTripInfo();
    $allResult = array();
    while($result = $results->fetch_assoc()){
        $allResult[] = $result;
    }
}
$cars = $mainControl->getCarInfo();
$customers = $mainControl->getCustomerInfo();
$trips = $mainControl->getTripInfo();
$flowers = $mainControl->getFlowerInfo();

$allCars = $allCustomers = $allTrips = $allFlowers = array();

while ($car = $cars->fetch_assoc()) {
  $allCars[] = $car;
}
while ($flower = $flowers->fetch_assoc()) {
  $allFlower[] = $flower;
}
while ($trip = $trips->fetch_assoc()) {
  $allTrips[] = $trip;
}
while ($customer = $customers->fetch_assoc()) {
  $allCustomers[] = $customer;
}

?>


<a href="/dbmaintain.php">Return to main Dashboard</a>
<form method="post" action="dashboard">
    <?php if ($table == 'car'):?>
        <label for="car-model">CAR MODEL</label>
        <input name="car-model" type="text" />
        <label for="car-code">CAR CODE</label>
        <input name="car-code" type="text" />
    <?php elseif ($table == 'customer' ):?>
      <label for="fullname">Full Name</label>
      <input name="fname" id="fullname" type="text">
  
      <label for="address">Address</label>
      <input name="address" id="address" type="text">
    
      <label for="city">City Code</label>
      <input name="city" id="city" type="text">
  
      <label for="user">Username</label>
      <input name="username" id="user" type="text">
  
      <label for="phone">Telephone (xxx xxx xxxx)</label>
      <input name="phone" id="phone" type="text">
  
      <label for="email">Email</label>
      <input name="email" id="email" type="email">
  
      <label for="pass">Password</label>
      <input name="password" id="pass" type="text">

      <label for="pass">Balance</label>
      <input name="balance" id="pass" type="number">

      <label for="isAdmin">Admin</label>
      <select name="isAdmin">
        <option value="false">false</option>
        <option value="true">true</option>
      </select>
    
    <?php elseif ($table == 'customer_order' ):?>
        <label for="date-issued">DATE ISSUED</label>
        <input name="date-issued" type="datetime-local" />
        <label for="date-done">DATE DONE</label>
        <input name="date-issued" type="datetime-local" />
        <label for="total-price">TOTAL PRICE</label>
        <input name="total-price" type="text" />
        <label for="payment-code">PAYMENT CODE</label>
        <input name= "payment-code" type="text" />
        <label for="customer-id">CUSTOMER ID</label>
        <select name="customer-id">
          <?php foreach ($allCustomers as $customer): ?>
            <option value=<?= "'".$customer['CUSTOMER_ID']."'"?>><span><?= $customer['CUSTOMER_ID']?>. <?= $customer['CUSTOMER_NAME']?></span></option>
          <?php endforeach; ?>
        </select><br/>
        <label for="trip-id">TRIP ID</label>
        <select name="trip-id">
          <?php foreach ($allTrips as $trip): ?>
            <option value=<?= "'".$trip['TRIP_ID']."'"?>><span><?= $trip['TRIP_ID']?>. <?= $trip['DESTINATION_CODE']?> - <?= $trip['SOURCE_CODE']?></span></option>
          <?php endforeach; ?>
        </select><br/>
        <label name="flower-id">FLOWER ID</label>
        <select name="flower-id">
          <?php foreach ($allFlower as $flower): ?>
            <option value=<?= "'".$flower['FLOWER_ID']."'"?>><span><?= $flower['FLOWER_ID']?>. <?= $flower['STORE_CODE']?> - <?= $flower['PRICE']?>$</span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'driver_review' ):?>
        <label for="review-context">REVIEW CONTEXT</label>
        <input name="review-context" type="text" />
        <label for="review-score">REVIEW SCORE</label>
        <input name="review-score" type="number" step="0.5" min="0" max="5"/>
        <label for="car-id">CAR ID</label>
        <select name="car-id">
          <?php foreach ($allCars as $car): ?>
            <option value=<?= "'".$car['CAR_ID']."'"?>><span><?= $car['CAR_ID']?>. <?= $car['CAR_CODE']?> - Available: <?= $car['AVAILABILITY_CODE']?></span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'flower' ):?>
        <label for="store-code">STORE CODE</label>
        <input name="store-code" type="text" />
        <label for="price">PRICE</label>
        <input name="price" type="text" />
    <?php elseif ($table == 'product_review' ):?>
      <label for="review-context">REVIEW CONTEXT</label>
        <input name="review-context" type="text" />
        <label for="review-score">REVIEW SCORE</label>
        <input name="review-score" type="number" step="0.5" min="0" max="5"/>
        <label name="flower-id">FLOWER ID</label>
        <select name="flower-id">
          <?php foreach ($allFlower as $flower): ?>
            <option value=<?= "'".$flower['FLOWER_ID']."'"?>><span><?= $flower['FLOWER_ID']?>. <?= $flower['STORE_CODE']?> - <?= $flower['PRICE']?>$</span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'trip' ):?>
      <input type="text" id="source" name="source" value="">
      <label for="source">Source</label>
      <input type="text" id="destin" name="destin" value="">
      <label for="destin">Destination</label><br/>
      <label>DISTANCE</label>
      <input type="text" />
      <label>CAR ID</label>
      <input type="text" />
      <label>PRICE</label>
      <input type="text" />
    <?php endif;?>
    <input class="btn grey accent-3" type="submit" value="submit">
</form>

<?php include './template/footer.php'?>