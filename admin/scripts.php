<!--<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/jquery.maskMoney.min.js"></script>


<script type="text/javascript">
	function login(email, senha) {
		$.post("ajax/login.php", { email:email, senha:senha }, function(data){
			if (data.location) {
				location.href = data.location;
			} else {
				alert(data.erro);
			}
		},'json');
	}
</script>

<!-- CLEAR IT -->
<script type="text/javascript"> 
function clearIt(what)
{
if(what.value == what.defaultValue) what.value = '';
}
function setIt(what)
{
if(what.value == '') what.value = what.defaultValue;
}
</script>



<!-- MOSTRA DIV-->
<script type="text/javascript">
function mostraDivMenu(nome_div) {
	$(".loading").show();		
	$.get("ajax/mostraDiv.php", { div:nome_div }, 
		function(data) {
			$("#conteudo").html(data);
			$(".loading").hide();	
			initJqtable();		
			$(".classTitle").tipTip({maxWidth: "600", edgeOffset: 10});
		});		
}
</script>



<!-- TABLE JQUERY -->
<style type="text/css" title="currentStyle">
	@import "js/datatables/demo_table.css";
	@import "css/datatables.css";
</style>
<script type="text/javascript" language="javascript" src="js/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
	function initJqtable() {
		//$('#tableJquery').dataTable();
		$('.tableJquery').dataTable( {
			"sPaginationType": "full_numbers",
			"bRetrieve": true,
			"oLanguage": {
				"sLengthMenu": "Exibir _MENU_ resultados",
				"sZeroRecords": "Nenhum resultado encontrado",
				"sInfo": "Exibindo <strong>_START_</strong> até <strong>_END_</strong> de <strong>_TOTAL_</strong> resultados",
				"sInfoEmpty": "Exibindo <strong>0</strong> até <strong>0</strong> de <strong>0</strong> resultados",
				"sInfoFiltered": "(filtrado de um total de <strong>_MAX_</strong> resultados)"
			}
		} );
	}
	$(document).ready(function() {
		initJqtable();
	} );
</script>


<!-- SHADOWBOX -->
<link rel="stylesheet" type="text/css" href="js/shadowbox/shadowbox.css">
<script type="text/javascript" src="js/shadowbox/shadowbox.js"></script>



<!-- MENU LATERAL => ACCORDION -->
<link rel="stylesheet" href="js/accordion_menu/style.css">
<script type="text/javascript">
	$(function() {
	
	    var menu_ul = $('.menu > li > ul'),
	           menu_a  = $('.menu > li > a');
	    
	    menu_ul.hide();
	
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>



<!-- TOOLTIP -->
<script type="text/javascript" src="js/tooltip/jquery.tipTip.js"></script> 
<link rel="stylesheet" type="text/css" href="js/tooltip/tipTip.css"/>	
<script type="text/javascript"> 
$(function(){
	$(".classTitle").tipTip({maxWidth: "auto", edgeOffset: 10});
});
</script> 
