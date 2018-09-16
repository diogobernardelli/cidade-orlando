<html> 
	<head>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
		<script type="text/javascript">
			var map;
			var watchPtos;

			var geocoder;			
			var marker;
			
			var latAtual = 28.5389612;
			var lngAtual = -81.3856157;
			
			function buscarEndereco(latitude, longitude) {
				$('.loading', top.document).show();
				var point_det = new google.maps.LatLng(latitude, longitude);
				var geocoder = new google.maps.Geocoder();
				var endereco = '';

				if (geocoder) {
					geocoder.geocode({ 'latLng': point_det }, function (results, status) {
						$('.loading', top.document).hide();
						if (status == google.maps.GeocoderStatus.OK) {
							if (results[0]) {
								endereco = results[0].formatted_address;
								$('#endereco', top.document).val(endereco);
							}
						} 
					});
				} else
					$('.loading', top.document).hide();		
			}
			
			function buscarPosicao(endereco) {
				if (endereco) {
					$('.loading', top.document).show();
					var geocoder = new google.maps.Geocoder();
					var posicao = '';
					
					if (geocoder) {
						geocoder.geocode( { 'address': endereco }, function(results, status) {
							$('.loading', top.document).hide();
							if (status == google.maps.GeocoderStatus.OK) {
								posicao = results[0].geometry.location;
	
								$('#latitude', top.document).val(posicao.lat());
								$('#longitude', top.document).val(posicao.lng());
								
								carregaDados();
							}
						});
					} else
						$('.loading', top.document).hide();
				}
			}
			
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
				
				//////////////////////////
				//		LISTENERS		//
				//////////////////////////
				watchPtos = google.maps.event.addListener(map, 'click', function(event) {
					if (marker) {
						google.maps.event.clearListeners(marker, 'click');
						marker.setMap(null);
						
						//$('#endereco', top.document).val('');
						$('#latitude', top.document).val('');
						$('#longitude', top.document).val('');
					}
					
					marker = new google.maps.Marker({
						map: map,
						position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
						icon: '../../images/pin-menor.png',
						draggable: true,
						title: 'Arrastar!'
					});
					
					$('#latitude', top.document).val(event.latLng.lat());
					$('#longitude', top.document).val(event.latLng.lng());
					//buscarEndereco(event.latLng.lat(), event.latLng.lng());

					google.maps.event.addListener(marker, 'dragend', function(event) {
						marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));
						
						$('#latitude', top.document).val(event.latLng.lat());
						$('#longitude', top.document).val(event.latLng.lng());
						//buscarEndereco(event.latLng.lat(), event.latLng.lng());
					});					
				});
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
						position: latlng,
						icon: '../../images/pin-menor.png',
						draggable: true,
						title: 'Arrastar!'
					});
					google.maps.event.addListener(marker, 'drag', function(event) {
						marker.setPosition(new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()));
						
						$('#latitude', top.document).val(event.latLng.lat());
						$('#longitude', top.document).val(event.latLng.lng());
						//buscarEndereco(event.latLng.lat(), event.latLng.lng());
					});
				}
			}
		</script>
	</head>
	<body onLoad="initialize();">
		<div id="div_mapa" style="width:100%;height:100%;background-color:#333333;">&nbsp;</div>
	</body>
</html>