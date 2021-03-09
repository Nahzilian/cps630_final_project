<?php
class Sign
{

  public function __construct($customer)
  {
    $this->customer = $customer;
  }

  public function process(){

    // Check if data submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['send'] === 'sign up') {
      $fields = $this->clean();
      $fields = $this->validate($fields);

      $this->display_err($fields);
    }
  }

  private function clean(){
    $username = $password = $fname = $lname = $address  = $city = $phone = $email = $confirm_password = "";
    $user_err = $pass_err = $confirm_err = "";
    $fname_err = $lname_err = $address_err = $city_err = $phone_err = $email_err = "";

    //TODO: enhance cleaning of sigunup field with its corosponding functionalty
    /*
    This is just a temporary solution to cleaning
    the signup fields, for more security we will
    later enhance clean method
    */
    if (empty(trim($_POST["fname"]))) {
        $fname_err = "Please enter your first name.";
    }else {
      $fname = trim($_POST['fname']);
    }

    if (empty(trim($_POST["lname"]))) {
      $lname_err = "Please enter your last name.";
    }else{

        $lname = trim($_POST['lname']);
    }

    if (empty(trim($_POST["address"]))) {
      $address_err = "Please emter your address";
    }else{
      $address = trim($_POST['address']);
    }

    if (empty(trim($_POST["city"]))) {
      $city_err = "Please enter your city code";
    }else{
        $city = trim($_POST['city']);
    }


    if (empty(trim($_POST["phone"]))) {
      $phone_err = "Please enter your phone number";
    }else{
      $phone = trim($_POST["phone"]);
    }

    if (empty(trim($_POST["email"]))) {
      $email_err = "Please enter your email";
    }else{
      $email = trim($_POST["email"]);
    }


    if (empty(trim($_POST["password"]))) {
      $pass_err = "Please enter your password";
    }else{
      $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST['confirm_password']))) {
      $confirm_err = "Please confirm your password";
    }else{
      $confirm_password = trim($_POST["confirm_password"]);
    }

    if (empty(trim($_POST["username"]))) {
      $username_err = "Please enter a username.";
    }else{
      $username = trim($_POST["username"]);
    }


    return array('form_content'=>array($username, $password, $fname, $lname, $address, $city, $phone, $email, $confirm_password),
     'form_err_main'=>array($user_err, $pass_err, $confirm_err), 'form_err_secondary'=>array($fname_err, $lname_err, $address_err, $city_err, $phone_err, $email_err));
  }

  private function validate($fields){
    list($username, $password, $fname, $lname, $address, $city, $phone, $email, $confirm_password) = $fields['form_content'];
    list($user_err, $pass_err, $confirm_err) = $fields['form_err_main'];
    list($fname_err, $lname_err, $address_err, $city_err, $phone_err, $email_err) = $fields['form_err_secondary'];

    $valid = true;
    foreach ($fields['form_err_secondary'] as $err) {
      if($err === ''){
        $valid=true;
      }
    }
    $valid = $pass_err === '';
    $valid = $confirm_err === '';
    $valid = $user_err === '';

    if($valid){
      // confirm_password
      if ($password == $confirm_password) {
        $this->customer->insert($fields);
        echo "<div class='center-align materialert success'><i class='fas fa-check'></i>  Operation Was A Success  </div>";

      }else{
        $confirm_err = "Your password do not match";
      }
    }
    return array('form_content'=>array($username, $password, $fname, $lname, $address, $city, $phone, $email, $confirm_password),
     'form_err_main'=>array($user_err, $pass_err, $confirm_err), 'form_err_secondary'=>array($fname_err, $lname_err, $address_err, $city_err, $phone_err, $email_err));

  }

  private function display_err($fields){
    foreach ($fields['form_err_main'] as $f) {
      if ($f !== '') {
        echo "<div class='center-align materialert error'><i class='fas fa-exclamation-circle'></i>  ".$f."</div>";
      }
    }
    foreach ($fields['form_err_secondary'] as $f) {
      if ($f !== '') {
        echo "<div class='center-align materialert error'><i class='fas fa-exclamation-circle'></i>  ".$f."</div>";
      }
    }
  }
}

 ?>
