

<!-- bjqs.css contains the *essential* css needed for the slider to work -->
<link rel="stylesheet" href="js/slideshow-index/bjqs.css">
<script src="js/slideshow-index/bjqs-1.3.js"></script>

    <div id="container">



      <!--  Outer wrapper for presentation only, this can be anything you like -->
      <div id="banner-slide">

        <!-- start Basic Jquery Slider -->
        <ul class="bjqs">
          <?php if ($lang == "pt") { ?>
            <li><img src="images/slideshow-index/02.jpg" rel="image_src" title="Nunca foi tão fácil morar próximo a <strong>Disney</strong>!" alt="Cidade Orlando"></li>
            <li><img src="images/slideshow-index/como-comprar-imoveis-no-exterior.jpg" rel="image_src" title="<a href='http://cidadeorlando.com.br/blog/como-comprar-imoveis-no-exterior/' alt='Cidade Orlando'><strong>CIDADE ORLANDO</strong> ensina:<br />Como <strong>comprar imóveis</strong> no Exterior</a>" alt="Cidade Orlando"></li>
            <li><a href="http://cidadeorlando.com.br/blog/green-card-por-investimento-conheca-o-visto-de-investidor-eb-5/"><img src="images/slideshow-index/green-card-por-investimento.jpg" rel="image_src" title="" alt="Green card por investimento – conheça o Visto de Investidor Eb-5 - See more at: http://cidadeorlando.com.br/blog/green-card-por-investimento-conheca-o-visto-de-investidor-eb-5/#sthash.AOii4lLi.dpuf"></a></li>
            <li><img src="images/slideshow-index/orlando-eye.jpg" rel="image_src" title="<a href='http://cidadeorlando.com.br/blog/conheca-a-orlando-eye-a-segunda-maior-roda-gigante-das-americas/' alt='Cidade Orlando'>Conheça a <strong>Orlando Eye</strong>:<br />a segunda maior roda gigante das Américas</a>" alt="Cidade Orlando"></li>
          <?php } ?>
          <li><img src="images/slideshow-index/05.jpg" rel="image_src" title="<?=$texto285?>"></li>
          <li><img src="images/slideshow-index/04.jpg" rel="image_src" title="<?=$texto97?>"></li>
          <li><img src="images/slideshow-index/03.jpg" rel="image_src" title="<a href='dicas-duvidas.php' alt='Cidade Orlando'> <?=$texto98?>"></li>
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
            animspeed : 8000, // the delay between each slide
            automatic : true // automatic
          });

        });
      </script>

    </div>



