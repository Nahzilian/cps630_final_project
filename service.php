<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>



<?php if (isset($_GET['type']) && $_GET['type'] == 'driver'): ?>
<h1>Driver</h1>
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'store'): ?>
<h1>Store</h1>
<?php endif; ?>

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
    <tbody>
      <!-- FOR LOOP HERE -->
      <col width="150">
      <tr>
        <td class="first"><img class="materialboxed" width="25" height="25" src="./res/img/car/car1.jpeg" alt="car-1">Sample</td>
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
        <td>true</td>
      </tr>
    </tbody>
    <tfoot>

    </tfoot>
  </table>
</div>
<div class="" id="map">

</div>


<?php include './template/contact_about.php' ?>
<?php include './template/footer.php' ?>
<script type="text/javascript">

function initMap(){
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });

}

</script>
