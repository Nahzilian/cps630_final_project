<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>
<?php include './back-end/back-end/Controller/MainController.php';
  $mainConn = new MainController();
  $mainConn->login();
?>

<div class="row signup">
    <form class="col s12 m6 l6 login" method="post">
      <h2>Login</h2>
      <div class="row">
        <div class="col input-field s5">
          <input name="username" id="username" type="text" class="validate" required>
          <label for="username">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="col input-field s7">
          <input name="password" id="password" type="password" class="validate" required>
          <label for="password">Password</label>
        </div>
      </div>
      <input class="btn grey accent-3" type="submit" name="send" value="login">
    </form>
    <div class="col s12 m6 l6 sign">
      <h2>Sign Up</h2>
      <form class="col s12">
        <div class="row">
          <div class="input-field col s6">
            <input id="first_name" type="text" class="validate" required>
            <label for="first_name">First Name</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="text" class="validate" required>
            <label for="last_name">Last Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s10">
            <input id="address" type="text" class="validate" required>
            <label for="address">Address</label>
          </div>
          <div class="input-field col s2">
            <input id="city" type="text" class="validate" required>
            <label for="city">City Code</label>
          </div>
        </div>
        <div class="row">
          <div class="col input-field s5">
            <input id="user" type="text" class="validate" required>
            <label for="user">Username</label>
          </div>
        </div>
        <div class="row">
          <div class="col input-field s5">
            <input id="phone"
            pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{4}"
            placeholder="(xxx)-xxx-xxxx"
            type="tel" class="validate" required>
            <label for="phone">Telephone</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="email" class="validate" required>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s5">
            <input id="pass" type="password" class="validate" required>
            <label for="pass">Password</label>
          </div>
          <div class="input-field col s5">
            <input id="confirm-pass" type="password" class="validate" required>
            <label for="confirm-pass">Confirm Password</label>
          </div>
        </div>
        <input class="btn grey accent-3" type="submit" name="send" value="sign up">
      </form>
    </div>
    <img src="./res/img/balloon.jpg" alt="">
</div>

<?php include './template/footer.php' ?>
