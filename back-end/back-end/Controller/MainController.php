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
    //SELECT
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

    // DELETE
    function deleteCustomerOrder ($id) {
        echo $id;
        $this->customerOrder->deleteCustomerOrder($id);
    }

    function deleteCar ($id) {
        $this->deleteTrip($id);
        $this->car->deleteCar($id);
    }
    
    function deleteTrip ($id) {
        $this->customerOrder->deleteCustomerOrderByTripID($id);
        $this->trip->deleteTrip($id);
    }
    
    function deleteFlower ($id) {
        $this->customerOrder->deleteCustomerOrderByFlowerID($id);
        $this->pReview->deleteDReviewByFlowerID($id);
        $this->flower->deleteFlower($id);
    }

    function deleteCustomer ($id) {
        $this->customerOrder->deleteCustomerOrderByCustomerID($id);
        $this->customer->deleteCustomer($id);
    }

    function deleteProductComment ($id) {
        $this->pReview->deleteReview($id);
    }

    function deleteDriverComment ($id) {
        $this->pReview->deleteReview($id);
    }

    function writeReview($flowerId, $driverId, $message, $score, $selected) {
        if($selected == 'product') {
            $this->pReview->writeReview($flowerId,$message,$score);
        }else {
            $this->dReview->writeReview($driverId,$message,$score);
        }
    }
    // INSERT

    function insertCar ($model, $code) {
        $this->car->insertCar($model, $code);
    }

    function insertFlower($code, $price){
        $this->flower->insertFlower($code, $price);
    }

    function insertCustomer($username, $password, $fname, $address, $city, $phone, $email) {
        $fields = array('form_content'=>array($username, $password, $fname,'', $address, $city, $phone, $email, $password));
        $this->customer->insert($fields);
    }

    function insertCustomerOrder($customer_id, $date, $total, $payment, $trip_id, $flower_id) {
        $this->customerOrder->addNewOrder($customer_id, $date, $total, $payment, $trip_id, $flower_id);
    }

    function insertDriverReview($driver_id, $context, $score) {
        $this->dReview->writeReview($driver_id, $context, $score);
    }

    function insertProductReview($flower_id, $context, $score) {
        $this->pReview->writeReview($flower_id, $context, $score);
    }

    function insertTrip($destin, $source, $distamce, $car_id,$price) {
        $this->trip->insertTrip($destin, $source, $distamce, $car_id,$price);
    }

    // GET BY ID

    function getCarById($id) {
       return $this->car->getSpecificCar($id);
    }

    function getCustomerById($id) {
       return $this->customer->getSpecificCustomer($id);
    }

    function getCustomerOrderById($id) {
       return $this->customerOrder->getCustomerOrderById($id);
    }

    function getDriverReviewById($id) {
       return $this->dReview->getReviewById($id);
    }

    function getFlowerById($id) {
       return $this->flower->getSpecificFlower($id);
    }

    function getProductReviewById($id) {
       return $this->pReview->getReviewById($id);
    }

    function getTripById($id) {
       return $this->trip->getTripById($id);
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
