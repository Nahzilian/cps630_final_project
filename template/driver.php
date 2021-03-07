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
      <?php $cars=0; ?>
      <?php foreach ($allCar as $car) : ?>
        <?php $cars++; ?>
        <tr>
          <td class="first">
            <article id=<?php echo "drag-car-". $car['CAR_ID'] ?> draggable="true" class="fas fa-bars draggable">
            </article> <img class="materialboxed" width="100" height="100" src=<?php echo "./res/img/car/car" . strval(intval($car['CAR_ID']) % 6 + 1) . ".jpeg" ?> alt="car-image"><?php echo $car['CAR_MODEL'] ?>
          </td>
          <td>
            <div class="input-field col s12  m8 l8">
              <input type="text" id=<?php echo "source-". $car['CAR_ID'] ?> name="source" value="">
              <label for="source">Source</label>
            </div>
            <div class="input-field col s12  m8 l8">
              <input type="text" id=<?php echo "destin-". $car['CAR_ID'] ?> name="destin" value="">
              <label for="destin">Destination</label>
            </div>
            <button onclick=<?php echo "showMap(".$car['CAR_ID'].");" ?> class="btn-large col s12 m6 l6" type="button" name="show">Show Map</button>
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
