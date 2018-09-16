<html> 
	<head>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyBBz_1400wlBFJodwzJe72q_vy7gStr5vE"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
		<script type="text/javascript">
			var map;
			var watchPtos;

			var geocoder;			
			var marker;
			
			var latAtual = 28.5389612;
			var lngAtual = -81.3856157;
			
			function initialize() {
				var latlng = new google.maps.LatLng(latAtual, lngAtual);
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
				map = new google.maps.Map(document.getElementById("div_mapa"), myOptions);
				
				carregaDados();
			}
			
			function carregaDados() {
				if (marker) {
					google.maps.event.clearListeners(marker, 'click');
					marker.setMap(null);
				}

				if ($('#latitude', top.document).val() && $('#longitude', top.document).val()) {
					var latlng = new google.maps.LatLng($('#latitude', top.document).val(), $('#longitude', top.document).val());
					map.setCenter(latlng);
					
					marker = new google.maps.Marker({
						map: map,
						icon: '../images/pin.png',
						position: latlng,
						draggable: false
					});
				}
			}
		</script>
	</head>
	<body onLoad="initialize();">
		<div id="div_mapa" style="width:100%;height:100%;background-color:#333333;">&nbsp;</div>
	</body>
</html>