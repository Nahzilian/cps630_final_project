<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>

<div class="row review">
  <div class="col s12 m6 l6">
    <h3>Review Driver</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
      do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
      enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
      ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
      in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
      sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
      mollit anim id est laborum.</p>
      <form class="" action="review.php" method="post">

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <select class="" name="">
            <option value="sample Driver" data-icon="./res/img/car/car1.jpeg">Sample Car</option>
            <option value="sample Driver" data-icon="./res/img/car/car1.jpeg">Sample Car</option>
            <option value="sample Driver" data-icon="./res/img/car/car1.jpeg">Sample Car</option>
          </select>
        </div>
        <div class="col s12 m6 l6 stars center-align">
          <input type="radio"  name="star-4">
          <label for="star-4" class="fas fa-star star-off" id="star-cr-4"></label>
          <input type="radio" name="star-3">
          <label for="star-3" class="fas fa-star star-off" id="star-cr-3"></label>
          <input type="radio" name="star-2">
          <label for="star-2" class="fas fa-star star-off" id="star-cr-2"></label>
          <input type="radio" name="star-1">
          <label for="star-1" class="fas fa-star star-off" id="star-cr-1"></label>
          <input type="radio" name="star-0">
          <label for="star-0" class="fas fa-star star-off" id="star-cr-0"></label>
        </div>
      </div>
      <div class="row">
          <div class="input-field col col s12 m8 l8">
            <textarea id="message" name="message" class="materialize-textarea"></textarea>
            <label for="message">Comment</label>
          </div>
      </div>
      <input class="btn grey accent-3" type="submit" name="" value="Commment">
    </form>
  </div>
  <div class="col s12 m6 l6">
    <h3>Review Product</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
      do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
      enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
      ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
      in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
      sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
      mollit anim id est laborum.</p>
      <form class="" action="review.php" method="post">

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <select class="" name="">
            <option value="sample Product" data-icon="./res/img/car/car1.jpeg">Sample Product</option>
            <option value="sample Product" data-icon="./res/img/car/car1.jpeg">Sample Product</option>
            <option value="sample Product" data-icon="./res/img/car/car1.jpeg">Sample Product</option>
          </select>
        </div>
          <div class="col s12 m6 l6 stars center-align">
            <input type="radio"  name="star-4">
            <label for="star-4" class="fas fa-star star-off" id="star-pr-4"></label>
            <input type="radio" name="star-3">
            <label for="star-3" class="fas fa-star star-off" id="star-pr-3"></label>
            <input type="radio" name="star-2">
            <label for="star-2" class="fas fa-star star-off" id="star-pr-2"></label>
            <input type="radio" name="star-1">
            <label for="star-1" class="fas fa-star star-off" id="star-pr-1"></label>
            <input type="radio" name="star-0">
            <label for="star-0" class="fas fa-star star-off" id="star-pr-0"></label>
          </div>
      </div>
      <div class="row">
          <div class="input-field col col s12 m8 l8">
            <textarea id="message" name="message" class="materialize-textarea"></textarea>
            <label for="message">Comment</label>
          </div>
      </div>
      <input class="btn grey accent-3" type="submit" name="" value="Commment">
    </form>
  </div>
</div>
<div class="review-logo center-align">
  <img class="z-depth-5"src="./res/img/logo.png" alt="logo">

</div>


<script type="text/javascript">

$(document).on('click', (event)=>{
  function turn(star){
    let ev = $(event.target).attr('id');
    if(ev != undefined){
      if(ev.slice(0, 4) === 'star'){
        if($(event.target).hasClass('star-off')){
          for (var i = 0; i < parseInt(ev.slice(8, 9)) + 1; i++) {
            $(star.concat(i)).removeClass('star-off');
            $(star.concat(i)).addClass('star-on');
          }
        }
        else if($(event.target).hasClass('star-on')){
          for (var i = parseInt(ev.slice(8, 9)) + 1; i < 5; i++) {
            $(star.concat(i)).removeClass('star-on');
            $(star.concat(i)).addClass('star-off');
          }
        }
      }
    }
  }
  turn("#".concat($(event.target).attr('id').slice(0, 8)));
})
</script>

<?php include './template/contact_about.php' ?>
<?php include './template/footer.php' ?>
