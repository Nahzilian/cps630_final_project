<?php
include './back-end/back-end/Model/Car.php';
include './back-end/back-end/Model/Customer.php';
include './back-end/back-end/Model/CustomerOrder.php';
include './back-end/back-end/Controller/dbconnect.php';
include './back-end/back-end/Model/Trip.php';
include './back-end/back-end/Model/Flower.php';


Class MainController {
    public $customer;
    public $customerOrder;
    public $car;
    public $trip;
    public $flower;

    public function __construct()
    {   
        $dbcon = new dbconnect();
        $this->customer = new Customer($dbcon);
        $this->customerOrder = new CustomerOrder($dbcon);
        $this->car = new Car($dbcon);
        $this->trip = new Trip($dbcon);
        $this->flower = new Flower($dbcon);
    }

    function getCarInfo() {
        return $this->car->getAll();
    }

    function getFlowerInfo() {
        return $this->flower->getAll();
    }

}
?>