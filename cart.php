<?php include './template/header.php' ?>
<?php include './template/nav.php'?>

<div>
    <h2>
        Your cart:
    </h2>
    <div>
        Order summary:
    </div>
    <?php
    // Remember to set session var for the order, destination + source
        if (isset($_GET['orders']) && !empty($_GET['orders'])){
            echo $_GET['orders'];
        }else {
            echo 'Your cart is empty';
        }
    ?>
</div>

<?php include './template/footer.php' ?>