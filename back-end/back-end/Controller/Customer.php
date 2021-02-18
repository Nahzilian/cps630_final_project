<?php
include '../Model/Customer.php';
include '../Model/Customer_Order.php';
include '../Controller/dbconnect.php';
$dbcon = new dbconnect();
$customer = new Customer($dbcon);
$customerOrder = new CustomerOrder($dbcon);

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
?>