

<!-- bjqs.css contains the *essential* css needed for the slider to work -->
<link rel="stylesheet" href="js/slideshow-index/bjqs.css">
<script src="js/slideshow-index/bjqs-1.3.js"></script>
  
    <div id="container">
  
      

      <!--  Outer wrapper for presentation only, this can be anything you like -->
      <div id="banner-slide">

        <!-- start Basic Jquery Slider -->
        <ul class="bjqs">
            <li><img src="images/slideshow-index/04.jpg" title="<?=$texto84?>"></li>
            <li><img src="images/slideshow-index/02.jpg" title="<?=$texto85?>"></li>
            <li><img src="images/slideshow-index/03.jpg" title="<?=$texto86?>"></li>
        </ul>
        <!-- end Basic jQuery Slider -->

      </div>
      <!-- End outer wrapper -->
      
      <!-- attach the plug-in to the slider parent element and adjust the settings as required -->
      <script class="secret-source">
        jQuery(document).ready(function($) {
          
          $('#banner-slide').bjqs({
            animtype      : 'slide',
            height        : "auto",
            width         : 1920,
            responsive    : false,
            randomstart   : false,
            showcontrols : false,
            animduration : 800, // how fast the animation are
            animspeed : 4000, // the delay between each slide
            automatic : true // automatic
          });
          
        });
      </script>

    </div>

    

