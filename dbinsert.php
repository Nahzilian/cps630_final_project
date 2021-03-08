<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>

<?php include './back-end/back-end/Controller/MainController.php';

$mainControl = new MainController();
$table = $_GET['table'];
$results;

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $car_model = $_POST['car-model'];
  $car_code = $_POST['car-code'];
  $fullname = $_POST['fname'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $username = $_POST['username'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $balance = $_POST['balance'];
  $is_admin = $_POST['isAdmin'];
  $date_done = $_POST['date-done'];
  $total_price = $_POST['total-price'];
  $payment_code = $_POST['payment-code'];
  $customer_id = $_POST['customer_id'];
  $trip_id = $_POST['trip-id'];
  $flower_id = $_POST['flower-id'];
  $car_id = $_POST['car-id'];
  $review_context = $_POST['review-context'];
  $review_score = $_POST['review-score'];
  $store_code = $_POST['store-code'];
  $price = $_POST['price'];
  $source = $_POST['source'];
  $destin = $_POST['destin'];
  $distance = $_POST['distance'];
  $price = $_POST['price'];
  if ($table == 'car') $results = $mainControl->insertCar($car_model, $car_code);
  else if ($table == 'customer' ) $results = $mainControl->insertCustomer($username, $password, $fullname, $addressm, $city, $phone, $email);
  else if ($table == 'customer_order' ) $results = $mainControl->insertCustomerOrder($customer_id,$date_done,$total_price,$payment_code,$trip_id, $flower_id);
  else if ($table == 'driver_review' ) $results = $mainControl->insertDriverReview($driver_id, $review_context, $review_score);
  else if ($table == 'flower' ) $results = $mainControl->insertFlower($store_code, $price);
  else if ($table == 'product_review' ) $results = $mainControl->insertProductReview($flower_id, $review_context, $review_score);
  else if ($table == 'trip' ) $results = $mainControl->insertTrip($destin, $source, $distance, $car_id, $price);
}


?>


<a href="dbmaintain.php">Return to main Dashboard</a>

<form method="post" action=<?php echo "dbinsert.php?table=".$table?>>
    <?php if ($table == 'car'):?>
        <label for="car-model">CAR MODEL</label>
        <input name="car-model" type="text" required/>
        <label for="car-code">CAR CODE</label>
        <input name="car-code" type="text" required/>
    <?php elseif ($table == 'customer' ):?>
      <label for="fullname">Full Name</label>
      <input name="fname" id="fullname" type="text" required>
  
      <label for="address">Address</label>
      <input name="address" id="address" type="text" required>
    
      <label for="city">City Code</label>
      <input name="city" id="city" type="text" required>
  
      <label for="user">Username</label>
      <input name="username" id="user" type="text" required>
  
      <label for="phone">Telephone (xxx xxx xxxx)</label>
      <input name="phone" id="phone" type="text" required>
  
      <label for="email">Email</label>
      <input name="email" id="email" type="email" required>
  
      <label for="pass">Password</label>
      <input name="password" id="pass" type="text" required>

      <label for="pass">Balance</label>
      <input name="balance" id="pass" type="number" required>

      <label for="isAdmin">Admin</label>
      <select name="isAdmin">
        <option value="false">false</option>
        <option value="true">true</option>
      </select>
    
    <?php elseif ($table == 'customer_order' ):?>
        <label for="date-done">DATE DONE</label>
        <input name="date-issued" type="date" required/>
        <label for="total-price">TOTAL PRICE</label>
        <input name="total-price" type="text" required/>
        <label for="payment-code">PAYMENT CODE</label>
        <input name= "payment-code" type="text" required/>
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
        <input name="review-context" type="text" required/>
        <label for="review-score">REVIEW SCORE</label>
        <input name="review-score" type="number" step="0.5" min="0" max="5"required/>
        <label for="car-id">CAR ID</label>
        <select name="car-id">
          <?php foreach ($allCars as $car): ?>
            <option value=<?= "'".$car['CAR_ID']."'"?>><span><?= $car['CAR_ID']?>. <?= $car['CAR_CODE']?> - Available: <?= $car['AVAILABILITY_CODE']?></span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'flower' ):?>
        <label for="store-code">STORE CODE</label>
        <input name="store-code" type="text" required/>
        <label for="price">PRICE</label>
        <input name="price" type="text" required/>
    <?php elseif ($table == 'product_review' ):?>
      <label for="review-context">REVIEW CONTEXT</label>
        <input name="review-context" type="text" required/>
        <label for="review-score">REVIEW SCORE</label>
        <input name="review-score" type="number" step="0.5" min="0" max="5"required/>
        <label name="flower-id">FLOWER ID</label>
        <select name="flower-id">
          <?php foreach ($allFlower as $flower): ?>
            <option value=<?= "'".$flower['FLOWER_ID']."'"?>><span><?= $flower['FLOWER_ID']?>. <?= $flower['STORE_CODE']?> - <?= $flower['PRICE']?>$</span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'trip' ):?>
      <input type="text" id="source" name="source" required>
      <label for="source">Source</label>
      <input type="text" id="destin" name="destin" required>
      <label for="destin">Destination</label><br/>
      <label for = "distance">DISTANCE</label>
      <input name = "distance" type="text" required/>
      <label for="car-id">CAR ID</label>
      <input name="car-id" type="text" required/>
      <label for="price">PRICE</label>
      <input name="price" type="text" required/>
    <?php endif;?>
    <input class="btn grey" type="submit" value="submit">
</form>

<?php include './template/footer.php'?>