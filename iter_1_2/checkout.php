<?php
include './back-end/back-end/Controller/MainController.php';
$mainConn = new MainController();

if ($_SERVER['REQUEST_METHOD'] == "POST"){ 
    $id = $_POST['userid'];
    $trip = $_POST['trip'];
    $flowers = $_POST['flower'];
    $date = date("Y-m-d h:i:s");
    $total = $_POST['total'];
    $pay_code = '1234567890123';
    $type = $_POST['type'];
    if ( !(empty($id) && empty($trip) && empty($flower) && empty($date) && empty($total) && empty($payment_code) && empty($type))) {
        if ($type == 'flower') {
            $allFlower = explode(',', $flower);
            foreach ($allFlower as $key => $value) {
                $mainConn->checkout($id, $date, $total, $payment, $trip_id, $value);
            }
        }
        else {
            $mainConn->checkout($id, $date, $total, $payment, $trip_id, 1);
        }
    }
}

?>