<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>

<?php include './back-end/back-end/Controller/MainController.php';

$mainControl = new MainController();
$table = $_GET['table'];
$results;
if (!empty($table)){
    if ($table == 'car') $results = $mainControl->getCarInfo();
    else if ($table == 'customer' ) $results = $mainControl->getCustomerInfo();
    else if ($table == 'customer_order' ) $results = $mainControl->getCustomerOrderInfo();
    else if ($table == 'driver_review' ) $results = $mainControl->getDriverReviewInfo();
    else if ($table == 'flower' ) $results = $mainControl->getFlowerInfo();
    else if ($table == 'product_review' ) $results = $mainControl->getProductReviewInfo();
    else if ($table == 'trip' ) $results = $mainControl->getTripInfo();
    $allResult = array();
    while($result = $results->fetch_assoc()){
        $allResult[] = $result;
    }
}
?>

<table>
    <tr>
        <?php if ($table == 'car'):?>
            <th>CAR ID</th>
            <th>CAR MODEL</th>
            <th>CAR CODE</th>
            <th>AVAILABILITY CODE</th>
        <?php elseif ($table == 'customer' ):?>
            <th>CUSTOMER ID</th>
            <th>CUSTOMER NAME</th>
            <th>CUSTOMER TELEPHONE</th>
            <th>CUSTOMER EMAIL</th>
            <th>CUSTOMER ADDRESS</th>
            <th>CUSTOMER CITY CODE</th>
            <th>CUSTOMER USERNAME</th>
            <th>CUSTOMER PASSWORD</th>
            <th>CUSTOMER BALANCE</th>
            <th>CUSTOMER ADMIN</th>
        <?php elseif ($table == 'customer_order' ):?>
            <th>ORDER ID</th>
            <th>DATE ISSUED</th>
            <th>DATE DONE</th>
            <th>TOTAL PRICE</th>
            <th>PAYMENT CODE</th>
            <th>CUSTOMER ID</th>
            <th>TRIP ID</th>
            <th>FLOWER ID</th>
        <?php elseif ($table == 'driver_review' ):?>
            <th>REVIEW ID</th>
            <th>REVIEW CONTEXT</th>
            <th>REVIEW SCORE</th>
            <th>CAR ID</th>
        <?php elseif ($table == 'flower' ):?>
            <th>FLOWER ID</th>
            <th>STORE CODE</th>
            <th>PRICE</th>
        <?php elseif ($table == 'product_review' ):?>
            <th>REVIEW ID</th>
            <th>REVIEW CONTEXT</th>
            <th>REVIEW SCORE</th>
            <th>FLOWER ID</th>
        <?php elseif ($table == 'trip' ):?>
            <th>TRIP ID</th>
            <th>DESTINATION CODE</th>
            <th>SOURCE CODE</th>
            <th>DISTANCE</th>
            <th>CAR ID</th>
            <th>PRICE</th>
        <?php endif;?>
    </tr>
    <?php foreach($allResult as $result):?>
        <tr>
        <?php if ($table == 'car'):?>
            <td><?= $result['CAR_ID']?></td>
            <td><?= $result['CAR_MODEL']?></td>
            <td><?= $result['CAR_CODE']?></td>
            <td><?= $result['AVAILABILITY_CODE']?></td>
        <?php elseif ($table == 'customer' ):?>
            <td><?= $result['CUSTOMER_ID']?></td>
            <td><?= $result['CUSTOMER_NAME']?></td>
            <td><?= $result['CUSTOMER_TEL']?></td>
            <td><?= $result['CUSTOMER_EMAIL']?></td>
            <td><?= $result['CUSTOMER_ADDRESS']?></td>
            <td><?= $result['CUSTOMER_CITY_CODE']?></td>
            <td><?= $result['CUSTOMER_USERNAME']?></td>
            <td><?= $result['CUSTOMER_PASSWORD']?></td>
            <td><?= $result['CUSTOMER_BALANCE']?></td>
            <td><?= $result['CUSTOMER_ADMIN']?></td>
        <?php elseif ($table == 'customer_order' ):?>
            <td><?= $result['ORDER_ID']?></td>
            <td><?= $result['DATE_ISSUED']?></td>
            <td><?= $result['DATE_DONE']?></td>
            <td><?= $result['TOTAL_PRICE']?></td>
            <td><?= $result['PAYMENT_CODE']?></td>
            <td><?= $result['CUSTOMER_ID']?></td>
            <td><?= $result['TRIP_ID']?></td>
            <td><?= $result['FLOWER_ID']?></td>
        <?php elseif ($table == 'driver_review' ):?>
            <td><?= $result['REVIEW_ID']?></td>
            <td><?= $result['REVIEW_CONTEXT']?></td>
            <td><?= $result['REVIEW_SCORE']?></td>
            <td><?= $result['CAR_ID']?></td>
        <?php elseif ($table == 'flower' ):?>
            <td><?= $result['FLOWER_ID']?></td>
            <td><?= $result['STORE_CODE']?></td>
            <td><?= $result['PRICE']?></td>
        <?php elseif ($table == 'product_review' ):?>
            <td><?= $result['REVIEW_ID']?></td>
            <td><?= $result['REVIEW_CONTEXT']?></td>
            <td><?= $result['REVIEW_SCORE']?></td>
            <td><?= $result['FLOWER_ID']?></td>
        <?php elseif ($table == 'trip'):?>
            <td><?= $result['TRIP_ID']?></td>
            <td><?= $result['DESTINATION_CODE']?></td>
            <td><?= $result['SOURCE_CODE']?></td>
            <td><?= $result['DISTANCE']?></td>
            <td><?= $result['CAR_ID']?></td>
            <td><?= $result['PRICE']?></td>
        <?php endif;?>
        </tr>
    <?php endforeach; ?>
</table>

<?php include './template/footer.php'?>