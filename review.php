<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>
<?php
include './back-end/back-end/Controller/MainController.php';

$mainConn = new MainController();
$cars = $mainConn->getCarInfo();
$allCar = array();
while ($car = $cars->fetch_assoc()) {
  $allCar[] = $car;
}
$flowers = $mainConn->getFlowerInfo();
$allFlower = array();
while ($flower = $flowers->fetch_assoc()) {
  $allFlower[] = $flower;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $flower = $_POST['flower'];
  $driver = $_POST['driver'];
  $message = $_POST['message'];
  $selectedType = $_POST['radio-selection'];
  $score = 0;
  if ($_POST['star-4'] == "1") $score =5;
  else if ($_POST['star-3'] == "1") $score =4;
  else if ($_POST['star-2'] == "1") $score =3;
  else if ($_POST['star-1'] == "1") $score =2;
  else if ($_POST['star-0'] == "1") $score =1; 
  else $score = 0;

  if (empty($selectedType)) {
    echo "Try selecting a different type";
  }else{
    if (empty($flower) || empty($driver) ) {
      echo "You have not selected review type";
    } else {
      $mainConn->writeReview($flower, $driver, $message, $score, $selectedType);  
    }  
  }
}
?>

<div class="container">
  <div class="row review">
    <div class="col s12">
      <h3>Let us know your experience!</h3>
      <form class="" action="review.php" method="post">
        <div class="row">
          <p class="col">
            <label>
              <input name="radio-selection" type="radio" value="product" onchange="radioOnCheck(this)" checked />
              <span>Product review</span>
            </label>
          </p>
          <p class="col">
            <label>
              <input name="radio-selection" type="radio" value="driver" onchange="radioOnCheck(this)" />
              <span>Driver review</span>
            </label>
          </p>
        </div>

        <div class="row">
          <div class="input-field col s12 m6 l6" id="product-list">
            <select class="" name="flower">
            <?php foreach($allFlower as $flower): ?>
              <option value=<?php echo "'" . $flower['FLOWER_ID'] ."'" ?> data-icon=<?php echo "./res/store/flower". strval(intval($flower['FLOWER_ID']) % 15+ 1). ".jpeg" ?>><?php echo $flower['STORE_CODE']?></option>
            <?php endforeach; ?>
            </select>
          </div>

          <div class="input-field col s12 m6 l6" id="driver-list">
            <select class="" name="driver">
            <?php foreach($allCar as $car): ?>
              <option value=<?php echo "'" . $car['CAR_ID'] ."'" ?> data-icon=<?php echo "./res/img/car/car". strval(intval($car['CAR_ID']) % 6 + 1). ".jpeg" ?>><?php echo $car['CAR_MODEL'] . '-' . $car['CAR_CODE']?></option>
            <?php endforeach; ?>
            </select>
          </div>
          <div class="col s12 m6 l6 stars center-align">
            <input type="radio" name="star-4" value = "0" id="s4" checked>
            <label for="star-4" class="fas fa-star star-off" id="star-cr-4" onclick="onselectStar(this)"></label>
            <input type="radio" name="star-3" value = "0" id="s3" checked>
            <label for="star-3" class="fas fa-star star-off" id="star-cr-3" onclick="onselectStar(this)"></label>
            <input type="radio" name="star-2" value = "0" id="s2" checked>
            <label for="star-2" class="fas fa-star star-off" id="star-cr-2" onclick="onselectStar(this)"></label>
            <input type="radio" name="star-1" value = "0" id="s1" checked>
            <label for="star-1" class="fas fa-star star-off" id="star-cr-1" onclick="onselectStar(this)"></label>
            <input type="radio" name="star-0" value = "0" id="s0" checked>
            <label for="star-0" class="fas fa-star star-off" id="star-cr-0" onclick="onselectStar(this)"></label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col col s12">
            <textarea id="message" name="message" class="materialize-textarea"></textarea>
            <label for="message">Comment</label>
          </div>
        </div>

        <div class="input-field col s12 submit-btn">
          <input class="btn grey accent-3 btn-large" type="submit" name="" value="Commment">
        </div>

      </form>
    </div>
  </div>
</div>


<div class="review-logo center-align">
  <img class="z-depth-5" src="./res/img/logo.png" alt="logo">
</div>


<script type="text/javascript">
  function radioOnCheck(rad) {
    var prod = document.getElementById('product-list');
    var driv = document.getElementById('driver-list');
    if (rad.value.toString() === 'product') {
      prod.style.display = 'block';
      driv.style.display = 'none';
    }
    if (rad.value.toString() === 'driver') {
      driv.style.display = 'block';
      prod.style.display = 'none';
    }
  }

  function onselectStar(star) {
    document.getElementById("s4").value="0";
    document.getElementById("s3").value="0";
    document.getElementById("s2").value="0";
    document.getElementById("s1").value="0";
    document.getElementById("s0").value="0";
    var index = star.id.toString().slice(-1);;
    document.getElementById(`s${index}`).value = "1";
  }

  $(document).on('click', (event) => {
    function turn(star) {
      let ev = $(event.target).attr('id');
      if (ev != undefined) {
        if (ev.slice(0, 4) === 'star') {
          if ($(event.target).hasClass('star-off')) {
            for (var i = 0; i < parseInt(ev.slice(8, 9)) + 1; i++) {
              $(star.concat(i)).removeClass('star-off');
              $(star.concat(i)).addClass('star-on');
            }
          } else if ($(event.target).hasClass('star-on')) {
            for (var i = parseInt(ev.slice(8, 9)) + 1; i < 5; i++) {
              $(star.concat(i)).removeClass('star-on');
              $(star.concat(i)).addClass('star-off');
            }
          }
        }
      }
    }
    turn("#".concat($(event.target).attr('id').slice(0, 8)));
  })
</script>

<?php include './template/contact_about.php' ?>
<?php include './template/footer.php' ?>