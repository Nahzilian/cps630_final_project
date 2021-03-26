<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>

<?php
include './back-end/back-end/Controller/MainController.php';

$operation = $table = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["operation"]) && !empty($_POST['table'])) {
        $operation = $_POST['operation'];
        $table = $_POST['table'];
        header("Location: /db".$operation.".php?table=".$table);
    }else {
        echo "Please check your input";
    }
}
?>

<form method = "post" action="dbmaintain.php">
    <div>
        <labbel>Operations</labbel>
        <select name="operation">
            <option value="select">SELECT</option>
            <option value="insert">INSERT</option>
            <option value="delete">DELETE</option>
            <option value="update">UPDATE</option>
        </select>
    </div>
    <div>
        <labbel>Tables</labbel>
        <select name="table">
            <option value="car">Car</option>
            <option value="customer">Customer</option>
            <option value="customer_order">Customer order</option>
            <option value="driver_review">Driver review</option>
            <option value="flower">Flower</option>
            <option value="product_review">Product review</option>
            <option value="trip">Trip</option>
        </select>
    </div>
    <input type="submit" name="submit" value="Submit">  
</form>

<?php include './template/footer.php' ?>