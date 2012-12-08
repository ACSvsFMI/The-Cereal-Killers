<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Hackatron Serial Killerz</title>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css" data-inprogress="">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- jQuery -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!-- Google Maps API -->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
	<!-- Gmap3 Plugin -->
	<script type="text/javascript" src="js/gmap3.js"></script>
	<!-- PrefixFree Plugin -->
	<script type="text/javascript" src="js/prefixfree.min.js"></script>
	
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<div id="stageOne">
		<div class="wrapper center shadow round">
			<div class="row">
				<h3>Va rugam introduceti datele in format JSON:</h3>
			</div>
			<div class="separatorTop"></div>
			<div class="row">
				<textarea id="DATE"></textarea>
			</div>
			<div class="row">
				<input id="Trimite" type="button" value="Trimite">
			</div>
			<div class="separatorBottom"></div>
		</div>
	</div>
	<div id="stageTwo" class="scale1">
		<div id="reintroducetiDate">
			Reintroduceti Datele
		</div>
		<div class="wrapper center shadow round">

			<div class="row">
				<div id="map"></div>
				<div id="rezultate">
					<h3>Rezultate:</h3>
					<div class="row">
						<div class="nrFamilii"> 100
						</div>
						<label>Total familii</label>
					</div>
					<div class="row">
						<div class="nrFamilii"> 0
						</div>
						<label>Familii nemultumite</label>
					</div>
					<div id="rezultateContent" >

					</div>
					<input type="button" id="Refresh" value="Executa din nou pentru noile date">
				</div>
			</div>
			<div class="row">
			</div>
		</div>
	</div>
</body>
</html>