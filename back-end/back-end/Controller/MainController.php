<?php
include '../Model/Car.php';
include '../Model/Customer.php';
include '../Model/CustomerOrder.php';
include '../Controller/dbconnect.php';
include '../Model/Trip.php';
include '../Model/Flower.php';

$dbcon = new dbconnect();
$customer = new Customer($dbcon);
$customerOrder = new CustomerOrder($dbcon);
$car = new Car($dbcon);
$trip = new Trip($dbcon);
$flower = new Flower($dbcon);

if(isset($_GET['customer'])){
    $allCustomer = $customer->getAll() or die('error from here');
    if ($allCustomer->num_rows > 0) {
        echo "<table>";
        while ($row = $allCustomer->fetch_assoc()) {
            echo "<tr><td>" . $row["CUSTOMER_ID"] . "</td><td>" . $row["CUSTOMER_NAME"] . "</td><td>" . $row["CUSTOMER_TEL"] . "</td><td>" . $row["CUSTOMER_EMAIL"] . "</td>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

if(isset($_GET['customer_order'])){
    $allCustomerOrder = $customerOrder->getUserOrderHistory(1) or die('error from here');
    if ($allCustomerOrder->num_rows > 0) {
        echo "<table>";
        while ($row = $allCustomerOrder->fetch_assoc()) {
            echo "<tr><td>" . $row["ORDER_ID"] . "</td><td>" . $row["DATE_ISSUED"] . "</td><td>" . $row["DATE_DONE"] . "</td><td>" . $row["TOTAL_PRICE"] . "</td>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

if(isset($_GET['car'])){
    $allCar = $car->getAll() or die('error from here');
    if ($allCar->num_rows > 0) {
        echo "<table>";
        while ($row = $allCar->fetch_assoc()) {
            echo "<tr><td>" . $row["CAR_ID"] . "</td><td>" . $row["CAR_MODEL"] . "</td><td>" . $row["CAR_CODE"] . "</td><td>" . $row["AVAILABILITY_CODE"] . "</td>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

if(isset($_GET['trip'])){
    $allTrip = $trip->getAll() or die('error from here');
    if ($allTrip->num_rows > 0) {
        echo "<table>";
        while ($row = $allTrip->fetch_assoc()) {
            echo "<tr><td>" . $row["TRIP_ID"] . "</td><td>" . $row["DESTINATION_CODE"] . "</td><td>" . $row["SOURCE_CODE"] . "</td><td>" . $row["DISTANCE"] . "</td>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

if(isset($_GET['flower'])){
    $allFlower = $flower->getAll() or die('error from here');
    if ($allFlower->num_rows > 0) {
        echo "<table>";
        while ($row = $allFlower->fetch_assoc()) {
            echo "<tr><td>" . $row["FLOWER_ID"] . "</td><td>" . $row["STORE_CODE"] . "</td><td>" . $row["PRICE"] . "</td>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}
?>