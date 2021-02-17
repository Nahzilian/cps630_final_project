<?php
include '../Model/Customer.php';

$customer = new Customer();

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
?>