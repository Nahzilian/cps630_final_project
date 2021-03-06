<!-- FOOTER -->

  <script type="text/javascript">
  $("#aboutus").on('click', ()=>{
    $(".about").fadeIn();
  });
  $("#contactus").on('click', ()=>{
    $(".contact").fadeIn();
  });
  $(document).ready(function(){
   $('.materialboxed').materialbox();
   $('select').formSelect();
   $(".dropdown-trigger").dropdown();
   $('.sidenav').sidenav();
   $('.collapsible').collapsible();

   $('.materialert').fadeOut(3000);
 });

 $("i.fa-shopping-cart").on('click', ()=>{
   console.log('asd');
 })

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
