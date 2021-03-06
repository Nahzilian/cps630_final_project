<?php include './template/header.php' ?>
<?php include './template/nav.php' ?>


<div id="map" style="width:100%;height:100%;">

</div>

<script type="text/javascript">
let source = "<?php echo $_GET['source'] ?>";
let destin = "<?php echo $_GET['destin'] ?>";

function initMap(){
    let dirService = new google.maps.DirectionsService;
    let dirDisp = new google.maps.DirectionsRenderer;

    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -34.397, lng: 150.644},
      zoom: 8
    });
    console.log(source);
    console.log(destin);
    dirDisp.setMap(map);
    dirService.route({
      origin:source,
      destination: destin,
      travelMode: 'DRIVING'

    },(res, status)=>{
      if(status === 'OK')
        dirDisp.setDirections(res);
      else
        alert('failed direction: ' + status);
    });


  }
</script>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqZTUi_ipGJ2YdWfEJi3cLUcpa3OfbCkI&callback=initMap&libraries=places&v=weekly"
async
></script>

<?php include './template/footer.php' ?>
