<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>


<div class="container">
  <br /><br />
  <div class="row">
    <div class="col s12 m12 l6 content-blk">
      <h2>Welcome To Devil May Air</h2>
      <blockquote>
        Over the past few years, the living conditions of everyone have been affected heavily by the carbon emissions caused by industrial waste or transportation. Several solutions have been developed in order to tackle this problem, and they all show promising results.
        <br /><br />
        The project applies the “Plan for Smart Services” (P2S) Web application methodology as a mean of creating potential services help reduce air pollution. The web application is developed under the LAMP stack (Linux, Apache, MySQL, PHP) with MVC architecture. Additionally, the web app includes open libraries such as google map, SASS, JQuery to assist the system.
      </blockquote>
      <div class="submit-btn">
        <button class="pink accent-3 waves-effect waves-light btn btn-large" type="button" name="sign Up">Sign Up</button>
      </div>
    </div>
    <div class="col s12 m12 l6 driver content-blk"></div>
  </div>

  <br /><br />

  <div class="destination_source">
      <div class="row">
        <div class="input-field col s12 submit-btn">
          <h4>Pick your ride now!</h4>
        </div>
        <div class="input-field col s12">
          <input type="text" id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input"><i class="fas fa-map-marker-alt"></i> Source</label>
        </div>
        <div class="input-field col s12">
          <input type="text" id="autocomplete-input" class="autocomplete">
          <label for="autocomplete-input"><i class="fas fa-map-marker-alt"></i> Destination</label>
        </div>
        <div class="col s12">
          <label>
            <input type="checkbox" id ="check-ride-deliver" class="filled-in" onchange="onCheckInput(this)"/>
            <span>Ride and deliver</span>
          </label>
        </div>
        <div class="input-field col s12">
          <input type="text" id="item-input" class="autocomplete" disabled>
          <label for="item-input"><i class="fas fa-keyboard"></i> Item</label>
        </div>
        <div class="input-field col s12 submit-btn">
          <a class="grey accent-3 waves-effect waves-light btn btn-large">Ride & Deliver</a>
        </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
  function onCheckInput(checkbox) {
    console.log("It worked")
    document.getElementById('item-input').disabled = true;
    if(checkbox.checked === true) {
      document.getElementById('item-input').disabled = false;
    }
  }
</script>

<?php include './template/contact_about.php' ?>


<?php include './template/footer.php' ?>
