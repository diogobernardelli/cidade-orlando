<html> 
	<head>
    	<? include_once "../languages/en.php"; ?> 
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry&key=AIzaSyBBz_1400wlBFJodwzJe72q_vy7gStr5vE"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
		<script type="text/javascript">
			var map;
			var bounds;
		
			var marker = new Array();
			var info = new Array();
			var marker_latlng = new Array();

			var dados = '';

			function mostraPonto(pos) {
				if (dados[pos]) {
					var imovel = dados[pos];
					var latlng = new google.maps.LatLng(imovel.latitude, imovel.longitude);
					//map.setCenter(latlng);
										
					marker[pos] = new google.maps.Marker({
						map: map,
						icon: '../images/pin.png',
						position: latlng,
						draggable: false
					});

					marker_latlng.push(latlng);
					
					var html = '<style type="text/css">';
							html += '@font-face {';
								html += 'font-family:"HelveticaNeueLTPro-Md";';
								html += 'src: url("../fonts/Helvetica/HelveticaNeueLTPro-Md.otf");'; 
							html += '}';
							html += '@font-face {';
								html += 'font-family:"HelveticaNeueLTPro-Lt";';
								html += 'src: url("../fonts/Helvetica/HelveticaNeueLTPro-Lt.otf");'; 
							html += '}';
							html += '</style>';
							html += '<div style="width:340px; height:150px;">';
								html += '<div style="width:140px; height:150px; float:left; display:inline;">';
							        html += '<div style="width:125px; height:90px; overflow:hidden;">';
							            html += '<img src="../uploads/'+imovel.imagem+'" style="width:100%;">';
							        html += '</div>';
							        html += '<p style="margin:25px 0 0 0; font-size:18px; font-family:\'HelveticaNeueLTPro-Lt\', Verdana, Geneva, sans-serif;">U$ '+imovel.valor+'</p>';
							    html += '</div>';
							    html += '<div style="float:right; width:200px; height:150px; position:relative;">';
							    	html += '<p style="color:#0da9ea; font-size:20px; font-family:\'HelveticaNeueLTPro-Md\', Verdana, Geneva, sans-serif; margin:0; line-height:1.4;">'+imovel.localizacao+'</p>';
							        html += '<span style=" margin:0; line-height:1.4; font-family:\'HelveticaNeueLTPro-Lt\', Verdana, Geneva, sans-serif;"><strong><?=$texto48?>:</strong> '+imovel.area+'m²</span>';
							        html += '<a href="../imovel.php?id='+imovel.id+'" target="_parent" style="color:#fff; width:90px;; position:absolute; text-decoration:none; bottom:0; right:0; background:#06a7ea; padding:12px 24px; font-size:16px; cursor:pointer; font-family:\'HelveticaNeueLTPro-Md\', Verdana, Geneva, sans-serif;"><?=$texto38?> <img src="../images/arrow-right-white.png" style="margin:0 0 0 5px; position:relative; top:2px;"  /></a>'; 
							    html += '</div>';
							html += '</div>';
					
					info[pos] = new google.maps.InfoWindow({ content: html, size: new google.maps.Size(350,240)});
					google.maps.event.addListener(marker[pos], "click", function() {
						info[pos].open(map, marker[pos]);
						fechaInfoWindows(pos);
					});
					
					var x = pos + 1;
					mostraPonto(x);
				} else {
					if (dados != '') {
						for (var i = 0; i < marker_latlng.length; i++) {
							bounds.extend(marker_latlng[i]);
						}
						map.fitBounds(bounds);
					}
				}
			}

			function fechaInfoWindows(pos) {
				for (x = 0; x < info.length; x++) {
					if (x != pos) {
						info[x].close();
					}
				}
			}

			function getImoveis() {
				$.get("getImoveis.php", 
					function(data){
						dados = data;
						mostraPonto(0);
				},'json');
			}
			
			function initialize() {
				var latlng = new google.maps.LatLng(28.5389612, -81.3856157);
				bounds = new google.maps.LatLngBounds();
				
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
				
				getImoveis();
			}
		</script>
	</head>
	<body onLoad="initialize();">
		<div id="div_mapa" style="width:100%;height:100%;background-color:#333333;">&nbsp;</div>
	</body>
</html>