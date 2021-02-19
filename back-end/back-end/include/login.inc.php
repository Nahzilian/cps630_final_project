<?php

class Login
{

  public function __construct($customer)
  {
    $this->customer = $customer;
  }

  public function process(){
    $username = $password = $confirm_pass = "";
    $user_err = $pass_err = $confirm_pass_err = "";
    // query all customers
    // $customers = $this->customer->getAll();

    // Check if data submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
      }else{
        // while ($customer = $customers->fetch_assoc()) {
          // echo $customer['CUSTOMER_NAME'];
        // }
        $username = trim($_POST['username']);
      }

      if (empty(trim($_POST["password"]))) {
        $pass_err = "Please enter your password.";
      }else{
        $password = trim($_POST["password"]);
      }

      // Validate
      if (empty($username_err) && empty($pass_err)) {
        $user = $this->customer->check_user($username);
        $confirm_user = $user->fetch_assoc();
        if (empty($confirm_user['CUSTOMER_USERNAME'])) {
          $user_err = "Username does not exist";
        }else{
          if ($password === $confirm_user['CUSTOMER_PASSWORD']) {
            header("location:index.php?login=success");
            $_SESSION['username'] = $username;
          }else{
            $pass_err = "Wrong password";
          }
        }
      }
    }
  }

}


 ?>
