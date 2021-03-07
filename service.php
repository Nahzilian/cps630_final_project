<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>
<?php
include './back-end/back-end/Controller/MainController.php';
$mainConn = new MainController();
$cars = $mainConn->getCarInfo();
$allCar = array();
while ($car = $cars->fetch_assoc()) {
  $allCar[] = $car;
}
$flowers = $mainConn->getFlowerInfo();
$allFlower = array();
while ($flower = $flowers->fetch_assoc()) {
  $allFlower[] = $flower;
}
?>

<div class = "mycart" id = "mycart"><i class="fas fa-shopping-cart"></i></div>

<?php if (isset($_GET['type']) && $_GET['type'] == 'driver') : ?>
  <?php include './template/driver.php' ?>
<?php elseif (isset($_GET['type']) && $_GET['type'] == 'store') : ?>
    <?php include './template/store.php' ?>
<?php endif; ?>

<!-- <div class="" id="map"> -->

<!-- </div> -->


<?php include './template/contact_about.php' ?>


<script type="text/javascript">
  var countItem = 0;
  var listOfOrder = [];
  $(document).ready(function() {
	$('.draggable').on('dragstart', function(e){
     var source_id = $(this).attr('id');
     console.log(source_id);
	   e.originalEvent.dataTransfer.setData("source_id", source_id);
	});

	$("#mycart").on('dragenter', function (e){
		e.preventDefault();
		$(this).css('background', '#BBD5B8');
	});

	$("#mycart").on('dragover', function (e){
		e.preventDefault();
	});

	$("#mycart").on('drop', function (e){
		e.preventDefault();
    var product_code = e.originalEvent.dataTransfer.getData('source_id');
    console.log(product_code);
    console.log('dropped')
    countItem++;
    $("#mycart").html(`<div class = "mycart" id = "mycart"><i class="fas fa-shopping-cart"></i> ${countItem}</div>` );
  });

});

</script>

<script type="text/javascript">
  let id = 0;
  let cars = <?php echo $cars ?>;
  function initMap(){
    // map = new google.maps.Map(document.getElementById('map'), {
      // center: {lat: -34.397, lng: 150.644},
      // zoom: 8
    // });

    function autocomplete(input){
      auto  = new google.maps.places.Autocomplete((document.getElementById(input)), {
        types: ['geocode'],
      });

      google.maps.event.addListener(auto, 'place_changed', ()=>{
        var place = auto.getPlace() != undefined? auto.getPlace():'not_found';
        if (!place.geometry || !place.geometry.location) {
          // User entered the name of a Place that was not suggested and
          // pressed the Enter key, or the Place Details request failed.
          console.log("No details available for input: '" + place.name + "'");
          return;
        }

      })


    }
    for (var i = 0; i < cars; i++) {
      autocomplete(`source-${i}`);
      autocomplete(`destin-${i}`);

    }

  }
</script>

<script type="text/javascript">

  function showMap(id){
    source = $(`#source-${id}`).val();
    destin = $(`#destin-${id}`).val();
    window.location = '/map.php?id='+id+'&source='+source+'&destin='+destin;
  }
</script>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqZTUi_ipGJ2YdWfEJi3cLUcpa3OfbCkI&callback=initMap&libraries=places&v=weekly"
async
></script>


<?php include './template/footer.php' ?>
