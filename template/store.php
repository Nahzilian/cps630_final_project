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
            <article id=<?php echo "drag-flower-". $flower['CAR_ID'] ?> draggable="true" class="fas fa-bars draggable">
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
