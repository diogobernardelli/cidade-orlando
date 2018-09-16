<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>

<!-- SELECT AUTOSEARCH -->
<script src="js/select/chosen.jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="js/select/chosen.css">
<script type="text/javascript">
var config = {
  '.chosen-select'           : {}
}
</script>
<script type="text/javascript">	
	$(document).ready(function() { 
		$(".select").chosen();
		$(".select-off").chosen({disable_search: true});
	});
</script>


<!-- ICHECK -->
<link href="js/icheck/skins/flat/blue.css" rel="stylesheet">
<script src="js/icheck/icheck.js?v=1.0.2"></script>
<script type="text/javascript">	
	$(document).ready(function() { 
		//ICHECK
		$('input').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue',
			inheritID: true
		});
	});
</script>

<script type="text/javascript">	
	function setLanguage(lang) {
		$.post("ajax/setLang.php", { lang:lang }, function(data){
			location.href = '/';
		},'json');
	}
</script>



<!-- FACEBOOK RODAPE -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.3&appId=311673308982461";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- MENU MOBILE -->
<script type="text/javascript">
	$(function() {
		$('#show-menu').click(function() {
			$('.topo .menu').show();
			$('#show-menu').hide();
			$('#hide-menu').show();
		});
		$('#hide-menu').click(function() {
			$('.topo .menu').hide();
			$('#show-menu').show();
			$('#hide-menu').hide();
		});
	});
</script>


<!-- VALOR IMÓVEL -->
<script type="text/javascript">
	/*$(function() {
		$('.saber-valor').click(function() {
			$('.first-field').focus();
            $('.mensagem-contato').fadeIn(300);
		});
        $('.first-field').focusout(function() {
            $('.mensagem-contato').fadeOut(300);
		});
        $('.first-field').keypress(function() {
            $('.mensagem-contato').fadeOut(300);
		});
	});*/
	function imDn(i) {
		window.open("ajax/imDn.php?i="+i);
	}
</script>


<!-- TOOLTIP -->
<script type="text/javascript" src="js/tooltip/jquery.tipTip.js"></script> 
<link rel="stylesheet" type="text/css" href="js/tooltip/tipTip.css"/>	
<script type="text/javascript"> 
$(function(){
	$(".classTitle").tipTip({maxWidth: "auto", edgeOffset: 10});
});
</script> 


<!-- MASK MONEY -->
<script type="text/javascript" src="js/jquery.maskMoney.min.js"></script> 
<script type="text/javascript"> 
$(function(){
	$("#valor_de").maskMoney({thousands:' ', precision:0, suffix:' U$'});
	$("#valor_ate").maskMoney({thousands:' ', precision:0, suffix:' U$'});
});
</script> 

<!-- SHARETHIS -->
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "dea1dc43-c227-4e48-af28-cc84fb10c88e", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>



<!-- TOGGLE DICAS E DÚVIDAS -->
<script type="text/javascript">
	$(function() {
        $(".toggle-item p").hide();
        $(".toggle-item table").hide();

        $(".toggle-item").click(function(){
            $(".toggle-item p").hide();
            $(".toggle-item table").hide();
            $(".toggle-item").removeClass("active");
            $(this).children('p').slideToggle(300);
            $(this).children('table').slideToggle(300);
            $(this).addClass("active");
        });
    });
</script>

<!-- TOPO -->
<script>
$(document).ready(function(){
	
	// hide elementos
	$("#topo-fixo").hide();
	
  $("#zipcode").keyup(function() {
    $("#zipcode").val(this.value.match(/[0-9]*/));
  });
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 40) {
				$('#topo-fixo').fadeIn(200);
			} else {
				$('#topo-fixo').fadeOut(200);
			};
		});
	});

});
</script>



<!-- FACEBOOK APPS -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1516964138602841',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>