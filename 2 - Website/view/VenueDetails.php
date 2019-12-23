<?php
$venue_id = $_GET['venueid'];
$venueInfo = $DBModelObject->getVenueInfo($venue_id);

?>
<div class="container-fluid mt-3 mb-5 col-lg-10 mx-auto">
	<!-- row 1 - venue name -->
	<div class="row">
		<div class="col">
			<h2 class="text-muted text-center my-5"><?php echo $venueInfo['venue_name'] ?></h2>
		</div>
	</div>

	<!-- row 2 - venue information -->
	<div class="row">
		<!-- Venue photo -->
		<div class="col-8">
			<img src="<?php echo $venueInfo['venue_photo']; ?>" class="img-fluid shadow" alt="venue photo">
			<!-- <img src="/Assets/Venue Photos/Alwarez Art Museum.jpg" class="img-fluid" alt="venue photo"> -->
		</div>

		<!-- Venue details -->
		<div class="col">
			<strong>Name :</strong><?php echo "&nbsp&nbsp&nbsp" . $venueInfo['venue_name'] ?><br>
			<strong>Built :</strong><?php echo "&nbsp&nbsp&nbsp" . rand(1990, 2019); ?><br>
			<strong>Capacity :</strong><?php echo "&nbsp&nbsp&nbsp" . $venueInfo['capacity']; ?><br>
			<strong>About :</strong><br>
			<p><?php echo $venueInfo['venue_info'] ?></p>
		</div>
	</div>

	<div class="row my-4">
		<!-- Seat map -->
		<div class="col text-center">
			<h2 class="text-muted text-center my-5">Venue Map</h2>
			<img src="<?php echo $venueInfo['seat_map']; ?>" class="img-fluid shadow" alt="seat map">
			<!-- <img src="/Assets/Seat Maps/Alwarez Art Museum.png" class="img-fluid" alt="seat map"> -->
		</div>
	</div>
<!-- container end -->
</div>