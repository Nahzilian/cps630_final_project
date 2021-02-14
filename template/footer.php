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
  </script>
  </body>
</html>
