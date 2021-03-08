<?php
include './back-end/back-end/Model/Car.php';
include './back-end/back-end/Model/Customer.php';
include './back-end/back-end/Model/CustomerOrder.php';
include './back-end/back-end/Controller/dbconnect.php';
include './back-end/back-end/Model/Trip.php';
include './back-end/back-end/Model/Flower.php';
include './back-end/back-end/Model/ProductReview.php';
include './back-end/back-end/Model/DriverReview.php';
include './back-end/back-end/include/login.inc.php';
include './back-end/back-end/include/sign.inc.php';
include './back-end/back-end/include/order.inc.php';

Class MainController {
    public $customer;
    public $customerOrder;
    public $car;
    public $trip;
    public $flower;
    public $pReview;
    public $dReview;


    private $login;
    private $sign;
    private $order;
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

        $this->login = new Login($this->customer);
        $this->sign = new Sign($this->customer);
        $this->order = new Order($dbcon);
    }

    function getCarInfo() {
        return $this->car->getAll();
    }

    function getFlowerInfo() {
        return $this->flower->getAll();
    }

    function getCustomerInfo() {
        return $this->customer->getAll();
    }

    function getCustomerOrderInfo() {
        return $this->customerOrder->getAll();
    }

    function getTripInfo() {
        return $this->trip->getAll();
    }

    function getDriverReviewInfo() {
        return $this->dReview->getAll();
    }

    function getProductReviewInfo() {
        return $this->pReview->getAll();
    }

    function getAvailableCars() {
        return $this->car->getAvailableCar();
    }


    function getCarInfoUsingIds($arrOfIds) {
        return $this->car->getSpecificCar($arrOfIds);
    }

    function getFlowerInfoUsingIds($arrOfIds) {
        return $this->flower->getSpecificFlower($arrOfIds);
    }

    function deleteCustomerOrder ($id) {
        $this->customerOrder->deleteCustomerOrder($id);
    }

    function updateGeneral($fields, $value, $table, $id) {
        //$sql="UPDATE SET "
    }

    function deleteCar ($id) {
        // Fix to delete cascade
        $this->car->deleteCar($id);
    }

    // function deleteFlower ($id) {

    // }

    // function deleteCustomer ($id) {

    // }


    // function deleteTrip ($id) {

    // }

    // function deleteProductComment ($id) {

    // }

    // function deleteDriverComment ($id) {

    // }

    function writeReview($flowerId, $driverId, $message, $score, $selected) {
        if($selected == 'product') {
            $this->pReview->writeReview($flowerId,$message,$score);
        }else {
            $this->dReview->writeReview($driverId,$message,$score);
        }
    }

    public function login(){
      $this->login->process();
      $this->sign->process();
    }

    public function search($id, $s){
      return $this->order->search($s, $id);
    }

    public function getUser($user){
      return $this->customer->getUser($user);
    }

    public function checkout($id, $date, $total, $payment, $trip_id, $flower_id) {
        $this->customerOrder->addNewOrder($id, $date, $total, $payment, $trip_id, $flower_id);
    }
}
?>
