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
$availableCars = $mainConn->getAvailableCars();
$allAvailCar = array();
while ($car = $availableCars->fetch_assoc()) {
  $allAvailCar [] = $car;
}
?>

<div class = "mycart" id = "mycart" onclick="toShoppingCart()">
  <i class="fas fa-shopping-cart"></i>
</div>

<?php if (isset($_GET['type']) && $_GET['type'] == 'driver') : ?>
  <h1>Driver</h1>
  <div class="row service">
  <div class="input-field col s12  m8 l8">
    <input type="text" id="source" name="source" value="">
    <label for="source">Source</label>
  </div>
  <div class="input-field col s12  m8 l8">
    <input type="text" id="destin" name="destin" value="">
    <label for="destin">Destination</label>
  </div>
  <button class="btn-large col s12 m6 l6" type="button" name="show" onclick="showMap()">Show Map</button>
  <div class="" id="map"></div>
    <table class="striped">
      <thead>
        <tr>
          <th>Car Models</th>
          <th>Price</th>
          <th>Availability</th>
        </tr>
      </thead>
      <div id="div1"></div>
      <tbody>
        <!-- FOR LOOP HERE -->
        <?php foreach ($allCar as $car) : ?>
          <tr>
            <td class="first">
              <article id=<?php echo "drag-car-". $car['CAR_ID'] ?> draggable="true" class="fas fa-bars draggable">
              </article> <img class="materialboxed" width="100" height="100" src=<?php echo "./res/img/car/car" . strval(intval($car['CAR_ID']) % 6 + 1) . ".jpeg" ?> alt="car-image"><?php echo $car['CAR_MODEL'] ?>
            </td>
            <td>12$</td>
            <td><?php echo $car['AVAILABILITY_CODE'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'store') : ?>
  <h1>Store</h1>
  <div class="row service">
  <div class="input-field col s12  m8 l8">
    <input type="text" id="source" name="source" value="">
    <label for="source">Source</label>
  </div>
  <div class="input-field col s12  m8 l8">
    <input type="text" id="destin" name="destin" value="">
    <label for="destin">Destination</label>
  </div>
  <button class="btn-large col s12 m6 l6" type="button" name="show" onclick="showMap()">Show Map</button>
  <div id="map"></div>
  <div>
    <label for="cars">Choose a driver:</label>
    <select name="cars" id="avail-cars">
      <option value="">Choose a car</option>
      <?php foreach ($allAvailCar as $car): ?>
        <option value=<?php echo $car['CAR_CODE']?>><?php echo $car['CAR_MODEL']?></option>
      <?php endforeach; ?>
    </select> 
  </div>
    <table class="striped">
      <thead>
        <tr>
          <th>Flower code</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <!-- FOR LOOP HERE -->
        <?php foreach ($allFlower as $flower) : ?>
          <tr>
            <td class="first">
              <article id=<?php echo "drag-flower-". $flower['FLOWER_ID'] ?> draggable="true" class="fas fa-bars draggable">
              </article> <img class="materialboxed" width="100" height="100" src=<?php echo "./res/store/flower" . strval(intval($flower['FLOWER_ID']) % 15 + 1) . ".jpeg" ?> alt="flower-image"><?php echo $flower['STORE_CODE'] ?>
            </td>
            <td><?php echo $flower['PRICE'] ?>$</td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
  </div>
<?php endif; ?>



<?php include './template/contact_about.php' ?>
<script type="text/javascript">
  var countItem = 0;
  var listOfOrder = [];
  $(document).ready(function() {
    $('.draggable').on('dragstart', function(e){
      var source_id = $(this).attr('id');
      e.originalEvent.dataTransfer.setData("source_id", source_id);
    });

    $("#mycart").on('dragenter', function (e){
      e.preventDefault();
      $(this).css('background', '#BBD5B8');
    });

    $("#mycart").on('dragover', function (e){
      e.preventDefault();
    });

    $("#mycart").on('drop', function (e){
      e.preventDefault();
      var product_code = e.originalEvent.dataTransfer.getData('source_id');
      listOfOrder.push(product_code);
      countItem++;
      $("#mycart").html(`<div class = "mycart" id = "mycart"><i class="fas fa-shopping-cart"></i> ${countItem}</div>` );
    });


  });

  function toShoppingCart () {
    var orderList = '';
    var type = ''

    listOfOrder.forEach((order) => {
      var temp;
      if(order.includes('drag-car-')) {
        if (type === '') type = 'driver';
        temp = order.replace('drag-car-', '');
      }
      else if (order.includes('drag-flower-')){
        if (type === '') type = 'flower';
        temp = order.replace('drag-flower-','')
      }
      orderList+=temp + ',';
    })
    const destVal = document.getElementById('destin').value;
    const sourceVal = document.getElementById('source').value;
    if(!destVal) {
      alert('Please select a destination');
      return;
    }
    if(!sourceVal) {
      alert('Please select a destination');
      return;
    }
    if(orderList=="" || orderList ==",") {
      alert('Please select your items');
      return;
    }
    if (type==='flower'){
      var carCode = document.getElementById('avail-cars');
      if(carCode)
        window.location.replace(`http://localhost:3000/cart.php?orders=${orderList}&dest=${destVal}&src=${sourceVal}&type=${type}&car=${carCode}`);
      else {alert('Please select a driver!'); return;}
    }
    window.location.replace(`http://localhost:3000/cart.php?orders=${orderList}&dest=${destVal}&src=${sourceVal}&type=${type}`);
  }

  function showMap () {
    const destVal = document.getElementById('destin').value;
    const sourceVal = document.getElementById('source').value;
    const mapOpt = {
      zoom: 10
    }

    var mapObj = new google.maps.Map(document.getElementById("map"), mapOpt);
    var direction = new google.maps.DirectionsService();
    var directionRequest = {
      origin: sourceVal,
      destination: destVal,
      travelMode: google.maps.DirectionsTravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC
    }
    direction.route(
      directionRequest,
      (res, status) => {
        if(status === google.maps.DirectionsStatus.OK)
        {
          new google.maps.DirectionsRenderer({
            map: mapObj,
            directions: res
          })
        }
        else alert('Error: unable to retrieve your route')
      }
    )
  }

var rad = function(x) {
return x * Math.PI / 180;
};

var getDistance = function(p1, p2) {
  var R = 6378137; // Earth’s mean radius in meter
  var dLat = rad(p2.lat() - p1.lat());
  var dLong = rad(p2.lng() - p1.lng());
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat())) *
    Math.sin(dLong / 2) * Math.sin(dLong / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d; // returns the distance in meter
};
</script>
<?php include './template/footer.php' ?>
