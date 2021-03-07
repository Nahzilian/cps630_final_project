<?php include './template/header.php' ?>
<?php include './template/nav.php'?>
<?php
include './back-end/back-end/Controller/MainController.php';
$mainConn = new MainController();
$allOrders = $mainConn->getOrders();
$orders;
?>

<div class="cart-summary" style="margin:10em">
    <h2>
        Your Cart
    </h2>
    <?php
    // Remember to set session var for the order, destination + source
        $id_list;
        if (isset($_GET['orders']) && !empty($_GET['orders'])){
            $id_list = rtrim($_GET['orders'], ",");
            if( isset($_GET['type']) && !empty($_GET['type'])) {
                if ($_GET['type'] == 'driver') {
                    $orders = $mainConn->getCarInfoUsingIds($id_list);
                }else {
                    $orders = $mainConn->getFlowerInfoUsingIds($id_list);
                }
            }
            $allOrder = array();
            while ($order = $orders->fetch_assoc()) {
                $allOrder[] = $orders;
            }
        }else {
            echo 'Your cart is empty';
        }
    ?>
    <table>
      <caption>
        Order Summary
      </caption>
      <thead>
        <tr>
          <?php if ($_GET['type'] == 'flower'):?>
            <th>Store Code</th>
            <th>Price</th>
          <?php else:?>
            <th>Car Model</th>
            <th>Car Code</th>
            <th>Price Per K/m</th>
          <?php endif;?>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
          <?php if ($_GET['type'] == 'flower'):?>
            <td><?= $order['STORE_CODE']?></td>
            <td><?= $order['PRICE']?></td>
          <?php else:?>
            <td><?= $order['CAR_MODEL']?></td>
            <td><?= $order['CAR_CODE']?></td>
            <td>12$/km</td>
          <?php endif;?>
        </tr>
        <?php endforeach; ?>

      </tbody>
    </table>
    <div class="center" style="margin: 5em">
      <button class="btn btn-large gray accent-3" onclick="proceed()">Proceed To Checkout</button>
    </div>
</div>

<script type="text/javascript">
  function proceed(){

  }
</script>

<?php include './template/footer.php' ?>
