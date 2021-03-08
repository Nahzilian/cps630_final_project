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

$cars;
$customers;
$trips;
$flowers;
?>

<form>
    <?php if ($table == 'car'):?>
        <label>CAR MODEL</label>
        <input type="text" />
        <label>CAR CODE</label>
        <input type="text" />
    <?php elseif ($table == 'customer' ):?>
        <div class="row">
          <div class="input-field col s6">
            <input name="fname" id="first_name" type="text" class="validate" required>
            <label for="first_name">First Name</label>
          </div>
          <div class="input-field col s6">
            <input name="lname" id="last_name" type="text" class="validate" required>
            <label for="last_name">Last Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s10">
            <input name="address" id="address" type="text" class="validate" required>
            <label for="address">Address</label>
          </div>
          <div class="input-field col s2">
            <input name="city" id="city" type="text" class="validate" required>
            <label for="city">City Code</label>
          </div>
        </div>
        <div class="row">
          <div class="col input-field s5">
            <input name="username" id="user" type="text" class="validate" required>
            <label for="user">Username</label>
          </div>
        </div>
        <div class="row">
          <div class="col input-field s5">
            <input name="phone" id="phone"
            pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{4}"
            placeholder="(xxx)-xxx-xxxx"
            type="tel" class="validate" required>
            <label for="phone">Telephone</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input name="email" id="email" type="email" class="validate" required>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s5">
            <input name="password" id="pass" type="password" class="validate" required>
            <label for="pass">Password</label>
          </div>
          <div class="input-field col s5">
            <input name="confirm_password" id="confirm-pass" type="password" class="validate" required>
            <label for="confirm-pass">Confirm Password</label>
          </div>
        </div>
        <input class="btn grey accent-3" type="submit" name="send" value="sign up">
    <?php elseif ($table == 'customer_order' ):?>
        <label>DATE ISSUED</label>
        <input type="date" />
        <label>DATE DONE</label>
        <input type="date" />
        <label>TOTAL PRICE</label>
        <input type="text" />
        <label>PAYMENT CODE</label>
        <input type="text" />
        <label>CUSTOMER ID</label>
        <input type="text" />
        <label>TRIP ID</label>
        <input type="text" />
        <label>FLOWER ID</label>
        <input type="text" />
    <?php elseif ($table == 'driver_review' ):?>
        <label>REVIEW CONTEXT</label>
        <input type="text" />
        <label>REVIEW SCORE</label>
        <input type="number" step="0.5" min="0" max="5"/>
        <label>CAR ID</label>
        <input type="text" />
    <?php elseif ($table == 'flower' ):?>
        <label>STORE CODE</label>
        <input type="text" />
        <label>PRICE</label>
        <input type="text" />
    <?php elseif ($table == 'product_review' ):?>
        <label>REVIEW CONTEXT</label>
        <input type="text" />
        <label>REVIEW SCORE</label>
        <input type="number" step="0.5" min="0" max="5"/>
        <label>FLOWER ID</label>
        <input type="text" />
    <?php elseif ($table == 'trip' ):?>
        <label>DESTINATION CODE</label>
        <input type="text" />
        <label>SOURCE CODE</label>
        <input type="text" />
        <label>DISTANCE</label>
        <input type="text" />
        <label>CAR ID</label>
        <input type="text" />
        <label>PRICE</label>
        <input type="text" />
    <?php endif;?>
</form>

<?php include './template/footer.php'?>