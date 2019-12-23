<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
?>
<div class="container height-fix">
	<?php
	if(isset($_GET['added']))
	{
		if($_GET['added'] == 1)
		{
			echo
			'<div class="alert alert-dismissible fade show  alert-success mb-4 border-0">
				<h4 class="text-center"><i class="fas fa-check fa-2x mr-4 align-bottom"></i>Venue Details Added Successfully</h4>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="text-center">
				<a href="/?page=admindash&action=viewvenues" class="h4">View</a>
				</div>
			</div>';
		}
		elseif($_GET['added'] == 0)
		{
			echo
			'<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Failed to Add Venue Details</h4>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>' . "</div>";
		}

	}
	// File upload error handling
	elseif(isset($_GET['error']))
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


	<h2 class="text-center text-muted mb-5">Add Venue</h2>
	<form action="/view/processform.php" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-5 offset-md-1 col-sm-10 offset-sm-1 col-lg-4 offset-lg-1">
				<fieldset>
					<legend class="text-muted text-center">Venue Details</legend>

					<div class="form-group">
						<label for="venue_name">Venue Name<sup> *</sup></label>
						<input class="form-control" required type="text" name="venue_name" id="venue_name" autofocus maxlength="40">
					</div>

					<div class="form-group">
						<label for="no_seats">Number of Seats<sup> *</sup></label>
						<input class="form-control" required type="number" name="no_seats" id="no_seats"
							placeholder="Enter (0) if not seated" min="0">
					</div>



					<div class="form-group">
						<label for="capacity">Venue Capacity<sup> *</sup></label>
						<input class="form-control" required type="number" name="capacity" id="capacity" max="300000" maxlength="6" placeholder="Max number of people the venue holds">
					</div>

					<label for="venue_photo">Venue Photo</label>
					<div class="custom-file">
						<input class="custom-file-input" type="file" name="venue_photo" id="venue_photo">
						<label for="venue_photo" class="custom-file-label">Select a file</label>
					</div>
					<p class="text-muted form-text">Only JPG / JPEG / PNG / BMP / GIF files</p>

					<label for="seat_map">Seat Map</label>
					<div class="custom-file">
						<input class="custom-file-input" type="file" name="seat_map" id="seat_map">
						<label for="seat_map" class="custom-file-label">Select a file</label>
					</div>
					<p class="text-muted form-text">Only JPG / JPEG / PNG / BMP / GIF files</p>
					
				</fieldset>
			</div>

			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Venue Address</legend>

					<div class="form-group">
						<label for="street_no">Street Number</label>
						<input class="form-control" type="text" name="street_no" id="street_no" maxlength="5"
							size="4">
					</div>

					<div class="form-group">
						<label for="street">Street</label>
						<input class="form-control" type="text" name="street" id="street" maxlength="40"
							autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="suburb">Suburb<sup> *</sup></label>
						<input class="form-control" required type="text" name="suburb" id="suburb" maxlength="40"
							autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="postcode">Post Code<sup> *</sup></label>
						<input class="form-control" required type="text" name="postcode" id="postcode" minlength="4"
							maxlength="4">
					</div>

					<div class="form-group">
						<label for="state">State<sup> *</sup></label>
						<select name="state" id="state" required class="form-control ">
							<option value="" selected hidden>Select...</option>
							<option value="act">ACT</option>
							<option value="nsw">NSW</option>
							<option value="nt">NT</option>
							<option value="qld">QLD</option>
							<option value="sa">SA</option>
							<option value="tas">TAS</option>
							<option value="vic">VIC</option>
							<option value="wa">WA</option>
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
					<textarea maxlength="2500" class="form-control" name="venue_info" id="venue_info" rows="8"></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=adminhome" class="btn btn-success btn-lg mx-2"><i
						class="fas fa-chevron-left mx-2"></i>Go Back</a>
				<button type="reset" class="btn btn-secondary btn-lg"><i class="fas fa-undo mx-2"></i>Clear</button>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="VenueAddButton"><i
						class="fas fa-plus fa-lg fa-1x mx-2"></i>Add Venue</button>
			</div>
		</div>
	</form>
</div>


<script>
// Script for showing the file name in custom bootstrap file input fields
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>