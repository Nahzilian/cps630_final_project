<?php
include './back-end/back-end/Model/Car.php';
include './back-end/back-end/Model/Customer.php';
include './back-end/back-end/Model/CustomerOrder.php';
include './back-end/back-end/Controller/dbconnect.php';
include './back-end/back-end/Model/Trip.php';
include './back-end/back-end/Model/Flower.php';
include './back-end/back-end/Model/ProductReview.php';
include './back-end/back-end/Model/DriverReview.php';

Class MainController {
    public $customer;
    public $customerOrder;
    public $car;
    public $trip;
    public $flower;
    public $pReview;
    public $dReview;

    public function __construct()
    {   
        $dbcon = new dbconnect();
        $this->customer = new Customer($dbcon);
        $this->customerOrder = new CustomerOrder($dbcon);
        $this->car = new Car($dbcon);
        $this->trip = new Trip($dbcon);
        $this->flower = new Flower($dbcon);
        $this->pReview = new ProductReview($dbcon);
        $this->dReview = new DriverReview($dbcon);
    }

    function getCarInfo() {
        return $this->car->getAll();
    }

    function getFlowerInfo() {
        return $this->flower->getAll();
    }

    function writeReview($flowerId, $driverId, $message, $score, $selected) {
        if($selected == 'product') {
            $this->pReview->writeReview($flowerId,$message,$score);
        }else {
            $this->dReview->writeReview($driverId,$message,$score);
        }
    }

}
?>