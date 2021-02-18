<?php
include '../Model/Car.php';
include '../Model/Customer.php';
include '../Model/CustomerOrder.php';
include '../Controller/dbconnect.php';
include '../Model/Trip.php';
include '../Model/Flower.php';

Class MainController {
    public $customer;
    public $customerOrder;
    public $car;
    public $trip;
    public $flower;

    public function __construct($dbcon)
    {   
        $this->customer = new Customer($dbcon);
        $this->customerOrder = new CustomerOrder($dbcon);
        $this->car = new Car($dbcon);
        $this->trip = new Trip($dbcon);
        $this->flower = new Flower($dbcon);
    }

}
?>