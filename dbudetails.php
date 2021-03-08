<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>

<?php include './back-end/back-end/Controller/MainController.php';

$mainControl = new MainController();
$table = $_GET['table'];
$selectedID = $_GET['id'];

$results;
if (!empty($table)){
    if ($table == 'car') $results = $mainControl->getCarById($selectedID);
    else if ($table == 'customer' ) $results = $mainControl->getCustomerById($selectedID);
    else if ($table == 'customer_order' ) $results = $mainControl->getCustomerOrderById($selectedID);
    else if ($table == 'driver_review' ) $results = $mainControl->getDriverReviewById($selectedID);
    else if ($table == 'flower' ) $results = $mainControl->getFlowerById($selectedID);
    else if ($table == 'product_review' ) $results = $mainControl->getProductReviewById($selectedID);
    else if ($table == 'trip' ) $results = $mainControl->getTripById($selectedID);
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
//   if ($table == 'car') $results = $mainControl->insertCar($car_model, $car_code);
//   else if ($table == 'customer' ) $results = $mainControl->insertCustomer($username, $password, $fullname, $addressm, $city, $phone, $email);
//   else if ($table == 'customer_order' ) $results = $mainControl->insertCustomerOrder($customer_id,$date_done,$total_price,$payment_code,$trip_id, $flower_id);
//   else if ($table == 'driver_review' ) $results = $mainControl->insertDriverReview($driver_id, $review_context, $review_score);
//   else if ($table == 'flower' ) $results = $mainControl->insertFlower($store_code, $price);
//   else if ($table == 'product_review' ) $results = $mainControl->insertProductReview($flower_id, $review_context, $review_score);
//   else if ($table == 'trip' ) $results = $mainControl->insertTrip($destin, $source, $distance, $car_id, $price);
}


?>


<a href="dbmaintain.php">Return to main Dashboard</a>
<a href=<?php echo "dbupdate.php?table=".$table?>>Return to update table</a>
<form method="post" action=<?php echo "dbudetails.php?table=".$table."&id=".$id?>>
<?php foreach ($allResult as $result): ?>
    <?php if ($table == 'car'):?>
        <label for="car-model">CAR MODEL</label>
        <input name="car-model" type="text" value=<?= "'".$result['CAR_MODEL']."'"?> required/>
        <label for="car-code">CAR CODE</label>
        <input name="car-code" type="text" value=<?= "'".$result['CAR_CODE']."'"?> required/>
    <?php elseif ($table == 'customer' ):?>
      <label for="fullname">Full Name</label>
      <input name="fname" id="fullname" value=<?= "'".$result['CUSTOMER_NAME']."'"?> type="text" required>
  
      <label for="address">Address</label>
      <input name="address" id="address" value=<?= "'".$result['CUSTOMER_ADDRESS']."'"?> type="text" required>
    
      <label for="city">City Code</label>
      <input name="city" id="city" value=<?= "'".$result['CUSTOMER_CITY_CODE']."'"?> type="text" required>
  
      <label for="user">Username</label>
      <input name="username" id="user" value=<?= "'".$result['CUSTOMER_USERNAME']."'"?> type="text" required>
  
      <label for="phone">Telephone (xxx xxx xxxx)</label>
      <input name="phone" id="phone" value=<?= "'".$result['CUSTOMER_TEL']."'"?> type="text" required>
  
      <label for="email">Email</label>
      <input name="email" id="email" value=<?= "'".$result['CUSTOMER_EMAIL']."'"?> type="email" required>
  
      <label for="pass">Password</label>
      <input name="password" id="pass" value=<?= "'".$result['CUSTOMER_PASSWORD']."'"?> type="password" disabled>

      <label for="pass">Balance</label>
      <input name="balance" id="pass" value=<?= "'".$result['CUSTOMER_BALANCE']."'"?> type="number" required>

      <label for="isAdmin">Admin</label>
      <select name="isAdmin">
      <?php if($result['CUSTOMER_ADMIN']==0):?>
            <option selected value="false">false</option>
            <option value="true">true</option>
        <?php else: ?>
            <option selected value="true">true</option>
            <option value="false">false</option>
        <?php endif;?>
      </select>
    
    <?php elseif ($table == 'customer_order' ):?>
        <label for="date-done">DATE DONE</label>
        <input name="date-issued" type="date" value=<?= "'".$result['DATE_DONE']."'"?> required/>
        <label for="total-price">TOTAL PRICE</label>
        <input name="total-price" value=<?= "'".$result['TOTAL_PRICE']."'"?> type="text" required/>
        <label for="payment-code">PAYMENT CODE</label>
        <input name= "payment-code" value=<?= "'".$result['PAYMENT_CODE']."'"?> type="text" required/>
        <label for="customer-id">CUSTOMER ID</label>
        <select name="customer-id">
          <?php foreach ($allCustomers as $customer): ?>
            <option selected = <?php if($result['CUSTOMER_ID']==$customer['CUSTOMER_ID']) {echo "selected";} else {echo "";}?> value=<?= "'".$customer['CUSTOMER_ID']."'"?>><span><?= $customer['CUSTOMER_ID']?>. <?= $customer['CUSTOMER_NAME']?></span></option>
          <?php endforeach; ?>
        </select><br/>
        <label for="trip-id">TRIP ID</label>
        <select name="trip-id">
          <?php foreach ($allTrips as $trip): ?>
            <option selected = <?php if($result['TRIP_ID']==$trip['TRIP_ID']) {echo "selected";} else {echo "";}?> value=<?= "'".$trip['TRIP_ID']."'"?>><span><?= $trip['TRIP_ID']?>. <?= $trip['DESTINATION_CODE']?> - <?= $trip['SOURCE_CODE']?></span></option>
          <?php endforeach; ?>
        </select><br/>
        <label name="flower-id">FLOWER ID</label>
        <select name="flower-id">
          <?php foreach ($allFlower as $flower): ?>
            <option selected = <?php if($result['FLOWER_ID']==$customer['FLOWER_ID']) {echo "selected";} else {echo "";}?> value=<?= "'".$flower['FLOWER_ID']."'"?>><span><?= $flower['FLOWER_ID']?>. <?= $flower['STORE_CODE']?> - <?= $flower['PRICE']?>$</span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'driver_review' ):?>
        <label for="review-context">REVIEW CONTEXT</label>
        <input name="review-context" value=<?= "'".$result['REVIEW_CONTEXT']."'"?> type="text" required/>
        <label for="review-score">REVIEW SCORE</label>
        <input name="review-score" value=<?= "'".$result['REVIEW_SCORE']."'"?> type="number" step="0.5" min="0" max="5"required/>
        <label for="car-id">CAR ID</label>
        <select name="car-id">
          <?php foreach ($allCars as $car): ?>
            <option selected = <?php if($result['CAR_ID']==$customer['CAR_ID']) {echo "selected";} else {echo "";}?>  value=<?= "'".$car['CAR_ID']."'"?>><span><?= $car['CAR_ID']?>. <?= $car['CAR_CODE']?> - Available: <?= $car['AVAILABILITY_CODE']?></span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'flower' ):?>
        <label for="store-code">STORE CODE</label>
        <input name="store-code" value=<?= "'".$result['STORE-CODE']."'"?> type="text" required/>
        <label for="price">PRICE</label>
        <input name="price" value=<?= "'".$result['PRICE']."'"?> type="text" required/>
    <?php elseif ($table == 'product_review' ):?>
        <label for="review-context">REVIEW CONTEXT</label>
        <input name="review-context" value=<?= "'".$result['REVIEW_CONTEXT']."'"?> type="text" required/>
        <label for="review-score">REVIEW SCORE</label>
        <input name="review-score" value=<?= "'".$result['REVIEW_SCORE']."'"?> type="number" step="0.5" min="0" max="5"required/>
        <label name="flower-id">FLOWER ID</label>
        <select name="flower-id">
          <?php foreach ($allFlower as $flower): ?>
            <option selected = <?php if($result['FLOWER_ID']==$customer['FLOWER_ID']) {echo "selected";} else {echo "";}?>  value=<?= "'".$flower['FLOWER_ID']."'"?>><span><?= $flower['FLOWER_ID']?>. <?= $flower['STORE_CODE']?> - <?= $flower['PRICE']?>$</span></option>
          <?php endforeach; ?>
        </select><br/>
    <?php elseif ($table == 'trip' ):?>
      <input value=<?= "'".$result['SOURCE_CODE']."'"?> type="text" id="source" name="source" required>
      <label for="source">Source</label>
      <input value=<?= "'".$result['DESTINATION_CODE']."'"?> type="text" id="destin" name="destin" required>
      <label for="destin">Destination</label><br/>
      <label for = "distance">DISTANCE</label>
      <input name = "distance" value=<?= "'".$result['DISTANCE']."'"?> type="text" required/>
      <label for="car-id">CAR ID</label>
      <input name="car-id" value=<?= "'".$result['CAR_ID']."'"?> type="text" required/>
      <label for="price">PRICE</label>
      <input name="price" value=<?= "'".$result['PRICE']."'"?> type="text" required/>
    <?php endif;?>
<?php endforeach; ?>
    <input class="btn grey" type="submit" value="Update">
</form>

<?php include './template/footer.php'?>