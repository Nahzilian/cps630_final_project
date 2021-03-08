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

<form method="post" action=<?php echo "dbupdate.php?table=".$table?>>
    <?php if ($table == 'car'):?>
        <label for="car-model">CAR MODEL</label>
        <input name="car-model" type="text" required/>
        <label for="car-code">CAR CODE</label>
        <input name="car-code" type="text" required/>
    <?php elseif ($table == 'customer' ):?>
      <label for="fullname">Full Name</label>
      <input name="fname" id="fullname" type="textrequired">
  
      <label for="address">Address</label>
      <input name="address" id="address" type="textrequired">
    
      <label for="city">City Code</label>
      <input name="city" id="city" type="textrequired">
  
      <label for="user">Username</label>
      <input name="username" id="user" type="textrequired">
  
      <label for="phone">Telephone (xxx xxx xxxx)</label>
      <input name="phone" id="phone" type="textrequired">
  
      <label for="email">Email</label>
      <input name="email" id="email" type="emailrequired">
  
      <label for="pass">Password</label>
      <input name="password" id="pass" type="textrequired">

      <label for="pass">Balance</label>
      <input name="balance" id="pass" type="numberrequired">

      <label for="isAdmin">Admin</label>
      <select name="isAdmin">
        <option value="false">false</option>
        <option value="true">true</option>
      </select>
    
    <?php elseif ($table == 'customer_order' ):?>
        <label for="date-done">DATE DONE</label>
        <input name="date-issued" type="datetime-local" required/>
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
      <input type="text" id="source" name="source" value="required">
      <label for="source">Source</label>
      <input type="text" id="destin" name="destin" value="required">
      <label for="destin">Destination</label><br/>
      <label for = "distance">DISTANCE</label>
      <input name = "distance" type="text" required/>
      <label for="car_id">CAR ID</label>
      <input name="car_id" type="text" required/>
      <label for="price">PRICE</label>
      <input name="price" type="text" required/>
    <?php endif;?>
    <input class="btn grey" type="submit" value="submit">
</form>
<table>
        <tr>
            <th></th>
            <?php if ($table == 'car') : ?>
                <th>CAR ID</th>
                <th>CAR MODEL</th>
                <th>CAR CODE</th>
                <th>AVAILABILITY CODE</th>
            <?php elseif ($table == 'customer') : ?>
                <th>CUSTOMER ID</th>
                <th>CUSTOMER NAME</th>
                <th>CUSTOMER TELEPHONE</th>
                <th>CUSTOMER EMAIL</th>
                <th>CUSTOMER ADDRESS</th>
                <th>CUSTOMER CITY CODE</th>
                <th>CUSTOMER USERNAME</th>
                <th>CUSTOMER PASSWORD</th>
                <th>CUSTOMER BALANCE</th>
                <th>CUSTOMER ADMIN</th>
            <?php elseif ($table == 'customer_order') : ?>
                <th>ORDER ID</th>
                <th>DATE ISSUED</th>
                <th>DATE DONE</th>
                <th>TOTAL PRICE</th>
                <th>PAYMENT CODE</th>
                <th>CUSTOMER ID</th>
                <th>TRIP ID</th>
                <th>FLOWER ID</th>
            <?php elseif ($table == 'driver_review') : ?>
                <th>REVIEW ID</th>
                <th>REVIEW CONTEXT</th>
                <th>REVIEW SCORE</th>
                <th>CAR ID</th>
            <?php elseif ($table == 'flower') : ?>
                <th>FLOWER ID</th>
                <th>STORE CODE</th>
                <th>PRICE</th>
            <?php elseif ($table == 'product_review') : ?>
                <th>REVIEW ID</th>
                <th>REVIEW CONTEXT</th>
                <th>REVIEW SCORE</th>
                <th>FLOWER ID</th>
            <?php elseif ($table == 'trip') : ?>
                <th>TRIP ID</th>
                <th>DESTINATION CODE</th>
                <th>SOURCE CODE</th>
                <th>DISTANCE</th>
                <th>CAR ID</th>
                <th>PRICE</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($allResult as $result) : ?>
            <tr>
                <?php if ($table == 'car') : ?>
                    <td><a href=<?php echo "/dbupdate.php?table=".$table."&id=".$result['CAR_ID']?>>Update</a></td>
                    <td><?= $result['CAR_ID'] ?></td>
                    <td><?= $result['CAR_MODEL'] ?></td>
                    <td><?= $result['CAR_CODE'] ?></td>
                    <td><?= $result['AVAILABILITY_CODE'] ?></td>
                <?php elseif ($table == 'customer') : ?>
                    <td><a href=<?php echo "/dbupdate.php?table=".$table."&id=".$result['CUSTOMER_ID']?>>Update</a></td>
                    <td><?= $result['CUSTOMER_ID'] ?></td>
                    <td><?= $result['CUSTOMER_NAME'] ?></td>
                    <td><?= $result['CUSTOMER_TEL'] ?></td>
                    <td><?= $result['CUSTOMER_EMAIL'] ?></td>
                    <td><?= $result['CUSTOMER_ADDRESS'] ?></td>
                    <td><?= $result['CUSTOMER_CITY_CODE'] ?></td>
                    <td><?= $result['CUSTOMER_USERNAME'] ?></td>
                    <td><?= $result['CUSTOMER_PASSWORD'] ?></td>
                    <td><?= $result['CUSTOMER_BALANCE'] ?></td>
                    <td><?= $result['CUSTOMER_ADMIN'] ?></td>
                <?php elseif ($table == 'customer_order') : ?>
                    <td><a href=<?php echo "/dbupdate.php?table=".$table."&id=".$result['ORDER_ID']?>>Update</a></td>
                    <td><?= $result['ORDER_ID'] ?></td>
                    <td><?= $result['DATE_ISSUED'] ?></td>
                    <td><?= $result['DATE_DONE'] ?></td>
                    <td><?= $result['TOTAL_PRICE'] ?></td>
                    <td><?= $result['PAYMENT_CODE'] ?></td>
                    <td><?= $result['CUSTOMER_ID'] ?></td>
                    <td><?= $result['TRIP_ID'] ?></td>
                    <td><?= $result['FLOWER_ID'] ?></td>
                <?php elseif ($table == 'driver_review') : ?>
                    <td><a href=<?php echo "/dbupdate.php?table=".$table."&id=".$result['REVIEW_ID']?>>Update</a></td>
                    <td><?= $result['REVIEW_ID'] ?></td>
                    <td><?= $result['REVIEW_CONTEXT'] ?></td>
                    <td><?= $result['REVIEW_SCORE'] ?></td>
                    <td><?= $result['CAR_ID'] ?></td>
                <?php elseif ($table == 'flower') : ?>
                    <td><a href=<?php echo "/dbupdate.php?table=".$table."&id=".$result['FLOWER_ID']?>>Update</a></td>
                    <td><?= $result['FLOWER_ID'] ?></td>
                    <td><?= $result['STORE_CODE'] ?></td>
                    <td><?= $result['PRICE'] ?></td>
                <?php elseif ($table == 'product_review') : ?>
                    <td><a href=<?php echo "/dbupdate.php?table=".$table."&id=".$result['REVIEW_ID']?>>Update</a></td>
                    <td><?= $result['REVIEW_ID'] ?></td>
                    <td><?= $result['REVIEW_CONTEXT'] ?></td>
                    <td><?= $result['REVIEW_SCORE'] ?></td>
                    <td><?= $result['FLOWER_ID'] ?></td>
                <?php elseif ($table == 'trip') : ?>
                    <td><a href=<?php echo "/dbupdate.php?table=".$table."&id=".$result['TRIP_ID']?>>Update</a></td>
                    <td><?= $result['TRIP_ID'] ?></td>
                    <td><?= $result['DESTINATION_CODE'] ?></td>
                    <td><?= $result['SOURCE_CODE'] ?></td>
                    <td><?= $result['DISTANCE'] ?></td>
                    <td><?= $result['CAR_ID'] ?></td>
                    <td><?= $result['PRICE'] ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>


<?php include './template/footer.php'?>