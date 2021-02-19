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


<?php if (isset($_GET['type']) && $_GET['type'] == 'driver') : ?>
  
  <div class = "mycart" ondrop="drop(event)" ondragover="allowDrop(event)"><i class="fas fa-shopping-cart"></i></div>

  <h1>Driver</h1>
  <div class="row service">
    <table class="striped">
      <thead>
        <tr>
          <th>Car Models</th>
          <th>Source/Destination</th>
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
              <article id=<?php echo "drag". $car['CAR_ID'] ?> draggable="true" ondragstart="drag(event)" class="fas fa-bars">
              </article> <img class="materialboxed" width="100" height="100" src=<?php echo "./res/img/car/car" . strval(intval($car['CAR_ID']) % 6 + 1) . ".jpeg" ?> alt="car-image"><?php echo $car['CAR_MODEL'] ?>
            </td>
            <td>
              <div class="input-field col s12  m8 l8">
                <input type="text" id="source" name="source" value="">
                <label for="source">Source</label>
              </div>
              <div class="input-field col s12  m8 l8">
                <input type="text" id="destin" name="destin" value="">
                <label for="destin">Destination</label>
              </div>
              <button class="btn-large col s12 m6 l6" type="button" name="show">Show Map</button>
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
    <table class="striped">
      <thead>
        <tr>
          <th>Flower code</th>
          <th>Source/Destination</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <!-- FOR LOOP HERE -->
        <?php foreach ($allFlower as $flower) : ?>
          <tr>
            <td class="first">
              <article ondrag="onDrag(event)" draggable="true" class="fas fa-bars">
              </article> <img class="materialboxed" width="100" height="100" src=<?php echo "./res/store/flower" . strval(intval($flower['FLOWER_ID']) % 15 + 1) . ".jpeg" ?> alt="flower-image"><?php echo $flower['STORE_CODE'] ?>
            </td>
            <td>
              <div class="input-field col s12  m8 l8">
                <input type="text" id="source" name="source" value="">
                <label for="source">Source</label>
              </div>
              <div class="input-field col s12  m8 l8">
                <input type="text" id="destin" name="destin" value="">
                <label for="destin">Destination</label>
              </div>
              <button class="btn-large col s12 m6 l6" type="button" name="show">Show Map</button>
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


<!-- <div class="" id="map"> -->

<!-- </div> -->


<?php include './template/contact_about.php' ?>
<?php include './template/footer.php' ?>
<script type="text/javascript">
  // function onDrag(event) {
  //   // console.log(event.dat);

  // }

  // function drop(event) {
  //   event.preventDefault();
  //   var data = event.dataTransfer.getData("Text");
  //   event.target.appendChild(document.getElementById(data))
  // }
  function allowDrop(ev) {
    ev.preventDefault();
  }

  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }

  function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
  }
  
</script>