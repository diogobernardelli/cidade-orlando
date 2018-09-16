<html> 
	<head>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry&key=AIzaSyBBz_1400wlBFJodwzJe72q_vy7gStr5vE"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
		<script type="text/javascript">
			var map_contato;
			
			function buscarPosicao(endereco) {
				$('.loading', top.document).show();
				var geocoder = new google.maps.Geocoder();
				var posicao = '';
				
				if (geocoder) {
					geocoder.geocode( { 'address': endereco }, function(results, status) {
						$('.loading', top.document).hide();
						if (status == google.maps.GeocoderStatus.OK) {
							posicao = results[0].geometry.location;

							posicao = new google.maps.LatLng(posicao.lat(), posicao.lng());
							var marker = new google.maps.Marker({
								map: map_contato,
								icon: '../images/pin.png',
								position: posicao,
								draggable: false,
								title: endereco
							});
							map_contato.setCenter(posicao);
						}
					});
				} else
					$('.loading', top.document).hide();
			}
			
			function initialize() {
				var latlng = new google.maps.LatLng(28.5389612, -81.3856157);
				var myOptions = {
					zoom: 13,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					navigationControl: false,
					mapTypeControl: true,
					scaleControl: false,
					streetViewControl: true,
					streetViewControlOptions: {
				        position: google.maps.ControlPosition.TOP_RIGHT
				    }
				};
				map_contato = new google.maps.Map(document.getElementById("div_mapa_contato"), myOptions);
								
				buscarPosicao($('#endereco', top.document).html());
			}
		</script>
	</head>
	<body onLoad="initialize();">
		<div id="div_mapa_contato" style="width:100%;height:100%;background-color:#333333;">&nbsp;</div>
	</body>
</html>