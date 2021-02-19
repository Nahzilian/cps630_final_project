<?php

class Login
{

  public function __construct($customer)
  {
    $this->customer = $customer;
  }

  public function process(){
    $username = $password = "";
    $user_err = $pass_err = "";

    // Check if data submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      list($username, $password, $user_err, $pass_err)  = $this->clean();

      // Validate
      if (empty($username_err) && empty($pass_err)) {
        list($user_err, $pass_err) = $this->validate($username, $user_err, $password, $pass_err);
      }
    }
    $this->displayErrors($user_err, $pass_err);
  }

  private function clean(){
    $username = $user_err = $pass_err = $password = "";
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

    return array($username, $password, $user_err, $pass_err);
  }

  private function validate($username, $user_err, $password, $pass_err){
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

    return array($user_err, $pass_err);
  }

  private function displayErrors($user, $pass){
    if ($user !== '') {
      echo "<div class='center-align materialert error'><i class='fas fa-exclamation-circle'></i>  ".$user."</div>";
    }elseif($pass !== '')
      echo "<div class='center-align materialert error'><i class='fas fa-exclamation-circle'></i>  ".$pass."</div>";
  }

}


 ?>
