<?php include './template/header.php' ?>
<?php include './template/nav.php'?>
<?php
include './back-end/back-end/Controller/MainController.php';
$mainConn = new MainController();
$orders;
?>

<div>
    <h2>
        Your cart:
    </h2>
    <div>
        Order summary:
    </div>
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

    <?php foreach ($orders as $order): ?>
        <?php if ($_GET['type'] == 'flower'):?>
            <div><?= $order['FLOWER_ID']?></div>
            <div><?= $order['STORE_CODE']?></div>
            <div><?= $order['PRICE']?></div>
        <?php else:?>
            <div><?= $order['CAR_ID']?></div>
            <div><?= $order['CAR_MODEL']?></div>
            <div><?= $order['CAR_CODE']?></div>
            <div>12$/km</div>
        <?php endif;?>
    <?php endforeach; ?>
</div>

<?php include './template/footer.php' ?>