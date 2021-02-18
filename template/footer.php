<!-- FOOTER -->

  <script type="text/javascript">
    $(document).ready(function() {
    $('.collapsible').collapsible();
    })
    $(document).ready(function(){
    $('.sidenav').sidenav();
  });
  $(document).ready(function(){
    $(".dropdown-trigger").dropdown();
  });

  $("#aboutus").on('click', ()=>{
    $(".about").fadeIn();
  });
  $("#contactus").on('click', ()=>{
    $(".contact").fadeIn();
  });
  $(document).ready(function(){
    $('select').formSelect();
  });
  $(document).ready(function(){
   $('.materialboxed').materialbox();
 });

 $("i.fa-shopping-cart").on('click', ()=>{
   console.log('asd');
 })

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
   autocomplete('source');
   autocomplete('destin');

 }

  </script>
  </body>
  <footer class="z-depth-5 pink accent-5">
    <div class="pink accent-2">
      <div class="copyright" align="center">
        <script>
          document.write('&copy;' );
          document.write(' 2021 - ');
          document.write(new Date().getFullYear());
          document.write(' www.devimayair.com - All Rights Reserved.');
          document.write('<br/>Last Updated : ');
          document.write(document.lastModified);
        </script>
      </div>
    </div>
  </footer>
</html>
