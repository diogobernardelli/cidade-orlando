<!--<h1><?=$texto15?></h1>-->
<?php 
    $id_imovel = $_GET['id'];
?>
<style type="text/css">
.g-recaptcha {
    transform:scale(0.82);
    transform-origin:0 0;
}
</style>
<div class="busca">
	<h1><?=$texto15?></h1>
	<div class="line">
    	<p><?=$texto16?></p>
    </div>
    <div class="line">
        <label><?=$texto17?></label><br />
        <div class="mensagem-contato">
            <?=$texto67?>
        </div>
        <input id="nome" name="nome" type="text" class="first-field">
    </div>
    <div class="line">
        <label><?=$texto12?></label><br />
        <input id="email" name="email" type="text">
    </div>
    <div class="line">
        <label><?=$texto11?></label><br />
        <input id="telefone" name="telefone" type="text">
    </div>
    <div class="line">
        <label><?=$texto18?></label><br />
        <textarea id="mensagem" name="mensagem"><?=$texto68?> <?=$imovel->getLocalizacao();?> <?=$texto69?></textarea>
    </div>
    <div class="line">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <div class="g-recaptcha" data-sitekey="6LeRUCATAAAAAG1MUqbr7zqUwzB4LRdW2m2JEg-O"></div>
    </div>
    <input type="hidden" value="<?=$id_imovel?>" id="imovel" name="imovel">
    <input type="hidden" value="<?=$imovel->getValor();?>" id="valor" name="valor">
    <div class="line">
        <input type="button" onclick="enviaContatoAnuncio();" value="<?=$texto19?>" />
    </div>
    
    <div class="info-contato-busca">
        <div class="line">
            <img src="images/icon-telefone-footer.png">
            <?=$geral->getTelefone1();?>
        </div>
        <div class="line">
            <img src="images/icon-email-footer.png">
            <?=$geral->getEmail1();?>
        </div>
       <div class="line">
            <img src="images/icon-facebook-footer.png">
            <?=$texto63?>
        </div>
        <div class="line">
            <img src="images/icon-skype-footer.png">
            <?=$geral->getSkype();?>
        </div>
    </div>
</div>

<!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
Cidade Orlando - Retângulo Médio 
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-3977217054646922"
     data-ad-slot="2314558693"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>-->

<!--
<div class="fb-lateral">
	<div class="fb-page" data-href="https://www.facebook.com/cidade.orlando" data-width="390" data-height="360" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cidade.orlando"><a href="https://www.facebook.com/cidade.orlando">Cidade Orlando</a></blockquote></div></div>
</div>
-->



<div class="clear"></div>