<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>
<div class="row">
  <div class="col s12 m8 l6">
    <h1>Devil May Air</h1>
    <blockquote>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </blockquote>
    <button class="pink accent-3 waves-effect waves-light btn btn-large" type="button" name="sign Up">Sign Up</button>
  </div>
  <div class="col s12 m4 l6 driver">
    <img src="./res/img/florist_wedding.jpg" alt="">
  </div>
</div>


  <div class="row destination_source">
    <div class="col s12 m6 l6">
      <div class="row">
        <h4>Ride to </h4>
        <div class="input-field col s12">
          <input type="text"
          id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input"><i class="fas fa-map-marker-alt"></i> Source</label>
        </div>
        <div class="input-field col s12">
          <input type="text"
          id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input"><i class="fas fa-map-marker-alt"></i> Destination</label>
        </div>
        <a class="grey accent-3 waves-effect waves-light btn btn-large">Ride</a>
      </div>
    </div>
    <div class="col s12 m6 l6">
      <div class="row">
        <h4>Ride & Deliver </h4>
        <div class="input-field col s12">
          <input type="text"
          id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input"><i class="fas fa-map-marker-alt"></i> Source</label>
        </div>
        <div class="input-field col s12">
          <input type="text"
          id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input"><i class="fas fa-map-marker-alt"></i> Destination</label>
        </div>
        <div class="input-field col s12">
          <input type="text"
          id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input"><i class="fas fa-keyboard"></i> Item</label>
        </div>
        <a class="grey accent-3 waves-effect waves-light btn btn-large">Ride & Deliver</a>
      </div>
    </div>
  </div>


<?php include './template/contact_about.php' ?>


<?php include './template/footer.php' ?>
