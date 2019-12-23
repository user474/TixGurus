<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
$venue = $DBModelObject->getVenueInfo($_GET['id']);
?>

<div class="container">
	<?php
	// File upload error handling
	if(isset($_GET['error']))
	{
		if($_GET['error'] == "filetoolarge")
		{
			echo <<< END
			<div class="alert alert-dismissible fade show alert-danger mb-4">
				<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Image File is Too Large.</h4>
END;
			echo "<h5 class=\"text-center ml-5\">Maximum File Size is " . MAX_FILE_SIZE/1000000 . "MB.</h5>";
			echo <<< END
				<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
			</div>
END;
		}
		if($_GET['error'] == "uploadfailed")
		{
			echo '
			<div class="alert alert-dismissible fade show alert-danger mb-4">
				<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Failed to Upload Files to Server</h4>
				<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
			</div>';
		}
		if($_GET['error'] == "error")
		{
			echo '
			<div class="alert alert-dismissible fade show alert-danger mb-4">
				<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>File Error</h4>
				<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
			</div>';
		}
		if($_GET['error'] == "wrongfiletype")
		{
			echo '
			<div class="alert alert-dismissible fade show alert-danger mb-4">
				<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Wrong File Type</h4>
				<h5 class="text-center">Only JPG / JPEG / PNG / BMP / GIF files allowed</h5>
				<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
			</div>';
		}
	}

	?>


	<h2 class="text-center text-muted mb-5">Edit Venue</h2>
	<form action="/view/processform.php" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-5 offset-md-1 col-sm-10 offset-sm-1 col-lg-4 offset-lg-1">
				<fieldset>
					<legend class="text-muted text-center">Venue Details</legend>
					<input type="hidden" name="venue_id" value="<?php echo $_GET['id']; ?>">
					<div class="form-group">
						<label for="venue_name">Venue Name<sup> *</sup></label>
						<input value="<?php echo $venue['venue_name']; ?>" class="form-control" required type="text" name="venue_name" id="venue_name" autofocus maxlength="40">
					</div>
					<div class="form-group">
						<label for="no_seats">Number of Seats<sup> *</sup></label>
						<input value="<?php echo $venue['no_seats']; ?>" class="form-control" required type="number" name="no_seats" id="no_seats"
							placeholder="Enter (0) if no seats" min="0">
					</div>
					<div class="form-group">
						<label for="capacity">Venue Capacity<sup> *</sup></label>
						<input value="<?php echo $venue['capacity']; ?>" class="form-control" required type="number" name="capacity" id="capacity" max="300000" maxlength="6" placeholder="Max number of people the venue holds">
					</div>

					<p class="text-center"><strong>Venue Photo</strong></p>

					<!-- Venue Photo div -->
					<div class="mb-3">
						<!-- Current Venue Photo -->
						<div class="form-group">
							<label for="current_venue_photo"><strong>Current</strong> Venue Photo (/img/uploads/)</label>
							<input class="form-control" type="text" name="current_venue_photo" value="<?php
								if($venue['venue_photo'] != null)
								{
									$filePathArray = explode("/", $venue['venue_photo']);
									echo end($filePathArray);
								}
							?>" readonly>
						</div>

						<!-- New Venue Photo -->
						<div class="form-group mt-4">
							<label><strong>New</strong> Venue Photo</label>
							<small class="text-muted form-text">Selecting a new file will delete the current venue photo</small>
							<div class="custom-file">
								<input class="custom-file-input" type="file" name="new_venue_photo" id="new_venue_photo">
								<label for="new_venue_photo" class="custom-file-label">Select a file</label>
							</div>
							<p class="text-muted form-text">Only JPG / JPEG / PNG / BMP / GIF files</p>
						</div>
					</div>

					<p class="text-center"><strong>Seat Map</strong></p>

					<!-- Seat Map div -->
					<div class="my-4">
						<!-- Current Seat Map -->
						<div class="form-group">
							<label for="current_seat_map"><strong>Current</strong> Seat Map (/img/uploads/)</label>
							<input class="form-control" type="text" name="current_seat_map" value="<?php
								if($venue['seat_map'] != null)
								{
									$filePathArray = explode("/", $venue['seat_map']);
									echo end($filePathArray);
								}
							?>" readonly>
						</div>

						<!-- New Seat Map -->
						<div class="form-group mt-4">
							<label><strong>New</strong> Seat Map</label>
							<small class="text-muted form-text">Selecting a new file will delete the current seat map</small>
							<div class="custom-file">
								<input class="custom-file-input" type="file" name="new_seat_map" id="new_seat_map">
								<label for="new_seat_map" class="custom-file-label">Select a file</label>
								<p class="text-muted form-text">Only JPG / JPEG / PNG / BMP / GIF files</p>
							</div>
						</div>
					</div>
				</fieldset>
			</div>

			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Venue Address</legend>

					<div class="form-group">
						<label for="street_no">Street Number</label>
						<input value="<?php echo $venue['street_no']; ?>" class="form-control" type="text" name="street_no" id="street_no" maxlength="5"
							size="4">
					</div>

					<div class="form-group">
						<label for="street">Street</label>
						<input value="<?php echo $venue['street']; ?>" class="form-control" type="text" name="street" id="street" maxlength="40"
							autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="suburb">Suburb<sup> *</sup></label>
						<input value="<?php echo $venue['suburb']; ?>" class="form-control" required type="text" name="suburb" id="suburb" maxlength="40"
							autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="postcode">Post Code<sup> *</sup></label>
						<input value="<?php echo $venue['postcode']; ?>" class="form-control" required type="text" name="postcode" id="postcode" minlength="4"
							maxlength="4">
					</div>

					<div class="form-group">
						<label for="state">State<sup> *</sup></label>
						<select name="state" id="state" required class="form-control ">
							<option value="" selected hidden>Select...</option>
							<option <?php if($venue['state'] == "act"){echo "selected ";} ?>value="act">ACT</option>
							<option <?php if($venue['state'] == "nsw"){echo "selected ";} ?>value="nsw">NSW</option>
							<option <?php if($venue['state'] == "nt"){echo "selected ";} ?>value="nt">NT</option>
							<option <?php if($venue['state'] == "qld"){echo "selected ";} ?>value="qld">QLD</option>
							<option <?php if($venue['state'] == "sa"){echo "selected ";} ?>value="sa">SA</option>
							<option <?php if($venue['state'] == "tas"){echo "selected ";} ?>value="tas">TAS</option>
							<option <?php if($venue['state'] == "vic"){echo "selected ";} ?>value="vic">VIC</option>
							<option <?php if($venue['state'] == "wa"){echo "selected ";} ?>value="wa">WA</option>
						</select>
					</div>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-md-9 offset-md-1 offset-lg-1">
				<div class="form-group">
					<label for="venue_info">Venue Description</label>
					<p class="text-muted form-text d-inline-block mt-3">(maximum 2500 characters)</p>
					<textarea maxlength="2500" class="form-control" name="venue_info" id="venue_info" rows="8" placeholder="Write here..."><?php echo $venue['venue_info']; ?></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=viewvenues" class="btn btn-success btn-lg mx-2"><i
						class="fas fa-chevron-left mx-2"></i>Go Back</a>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="VenueUpdateButton"><i
						class="fas fa-sync fa-1x mx-2"></i>Update Venue</button>
			</div>
		</div>
	</form>
</div>

<script>
	// Script for showing the file name in custom bootstrap file input fields
	$(".custom-file-input").on("change", function()
	{
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>