<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
	$categories = $DBModelObject->getCategories();
	$planners = $DBModelObject->getPlanners();
	$venues = $DBModelObject->getVenues();
	$eventInfo = $DBModelObject->getEventInfo($_GET['id']);

	if(isset($_GET['added']) && $_GET['added'] == 1)
	{
		echo "
		<div class=\"container\">
			<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
				<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Event Details Added Successfully</h4>
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
				</button>
				<div class=\"text-center\">
				<a href=\"/?page=admindash&action=viewevents\" class=\"h4\">View</a>
				</div>
			</div>
		</div>";

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


<div class="container-fluid">
	<h2 class="text-center text-muted mb-5">Edit Event</h2>
	<form action="/view/processform.php" method="post" enctype="multipart/form-data">
		<!-- Row 1 -->
		<div class="row justify-content-center">
			<!-- Column 1 -->
			<div class="col-lg-3 col-md-6 mx-3">
				<fieldset>
					<legend class="text-muted text-center">Event Details</legend>
					<input type="hidden" name="event_id" value="<?php echo $_GET['id']; ?>">
					<div class="form-group mb-4">
						<label for="event_name">Event Name<sup> *</sup></label>
						<input required value="<?php echo $eventInfo['event_name']; ?>" class="form-control" type="text" name="event_name" id="event_name" maxlength="40" autofocus
							required>
					</div>

					<!-- Current Event Poster -->
					<div class="form-group">
						<label for="current_poster"><strong>Current</strong> Event Poster (/img/uploads/)</label>
						<input class="form-control mb-4" type="text" name="current_poster" value="<?php
							if($eventInfo['event_poster'] != null)
							{
								// print_r($eventInfo['event_poster']);
								$eventPosterArray = explode("/", $eventInfo['event_poster']);
								// print_r($eventPosterArray);
								echo end($eventPosterArray);
							}
							else
							{
								echo "Empty";
							}
						?>" readonly>
					</div>

					<!-- New Event Poster -->
					<div class="form-group mt-2">
						<label for="new_poster"><strong>New</strong> Event Poster</label>
						<small class="text-muted form-text">Selecting a new file will delete the current poster above.</small>
						<div class="custom-file">
							<input class="custom-file-input" type="file" name="new_poster" id="new_poster">
							<label for="new_poster" class="custom-file-label">Select a file</label>
						</div>
						<p class="text-muted form-text mb-3">Only JPG / JPEG / PNG / BMP / GIF files</p>
					</div>

					<!-- Event Planner -->
					<div class="form-group my-3">
						<label for="planner_id">Event Planner</label>
						<select name="planner_id" id="planner_id" class="form-control">
							<option value="" selected hidden>Select...</option>
							<?php
								foreach($planners as $planner)
								{
									echo "<option ";
									if($eventInfo['planner_id'] == $planner['planner_id'])
									{
										echo "selected ";
									}
									echo "value=\"{$planner['planner_id']}\">";
									echo ucwords($planner['company_name']);
									echo "</option>";
								}
							?>
						</select>
					</div>

					<!-- Venue -->
					<div class="form-group mb-4">
						<label for="venue_id">Venue</label>
						<select name="venue_id" id="venue_id" class="form-control">
							<option value="" selected hidden>Select...</option>
							<?php
								foreach($venues as $venue)
								{
									echo "<option ";
									if($eventInfo['venue_id'] == $venue['venue_id'])
									{
										echo "selected ";
									}
									echo "value=\"{$venue['venue_id']}\">";
									echo ucwords($venue['venue_name']);
									echo "</option>";
								}
							?>
						</select>
					</div>

					<!-- Category -->
					<div class="form-group mb-4">
						<label for="category_id">Category</label>
						<select name="category_id" id="category_id" class="form-control">
						<option value="" selected hidden>Select...</option>
							<?php
								foreach($categories as $category)
								{
									echo "<option ";
									 if($eventInfo['category_id'] == $category['category_id'])
									{
										echo "selected ";
									}
									echo "value=\"{$category['category_id']}\">";
									echo ucwords($category['category_name']);
									echo "</option>";
								}
							?>
						</select>
					</div>
				</fieldset>
			</div>

			<!-- Column 2 -->
			<div class="col-lg-3 col-md-6 mx-3">
				<fieldset>
					<legend class="text-muted text-center">Event Timing</legend>
					<div class="mb-4 mb-4">
						<label for="start_date">Start Date<sup> *</sup></label>
						<input required value="<?php echo $eventInfo['start_date']; ?>" class="form-control" type="date" name="start_date" id="start_date" min="2019-01-01">
					</div>

					<div class="form-group mb-4">
						<label for="duration_days">Event Duration<sup> *</sup></label>
						<div class="input-group">
							<input required value="<?php echo $eventInfo['duration_days']; ?>" class="form-control" type="number" name="duration_days" id="duration_days" min="1"
								max="99">
							<div class="input-group-append">
								<span class="input-group-text">Day(s)</span>
							</div>
						</div>
					</div>

					<div class="form-group mb-4">
						<label for="start_time">Start Time<sup> *</sup></label>
						<input required value="<?php echo $eventInfo['start_time']; ?>" class="form-control" type="time" name="start_time" id="start_time">
					</div>

					<div class="form-group mb-4">
						<label for="end_time">Closing Time<sup> *</sup></label>
						<input required value="<?php echo $eventInfo['end_time']; ?>" class="form-control" type="time" name="end_time" id="end_time">
					</div>
				</fieldset>
			</div>

			<!-- Column 3 -->
			<div class="col-lg-3 col-md-6 mx-3">
				<fieldset>
					<legend class="text-muted text-center">Ticket Price</legend>

					<div class="form-group mb-4">
						<label for="level1price">Level 1<sup> *</sup></label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input required value="<?php echo $eventInfo['level1price']; ?>" class="form-control" type="number" name="level1price" id="level1price" min="0"
								max="1000" step="0.50" onchange="updateTicketPrices()">
						</div>
					</div>
					<div class="form-group mb-4">
						<label for="level2price">Level 2</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input value="<?php echo $eventInfo['level2price']; ?>" class="form-control" type="text" id="level2price" name="level2price" readonly>
						</div>
					</div>
					<div class="form-group mb-4">
						<label for="level3price">Level 3</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input value="<?php echo $eventInfo['level3price']; ?>" class="form-control" type="text" id="level3price" name="level3price" readonly>
						</div>				</div>
				</fieldset>
			</div>
		</div>

		<!-- Row 2 -->
		<div class="row">
			<div class="col-12 col-md-8 offset-md-2">
				<div class="form-group">
					<label for="event_info">Event Description</label>
					<p class="text-muted form-text d-inline-block mt-3">(maximum 2500 characters)</p>
					<textarea maxlength="2500" class="form-control" name="event_info" id="event_info" rows="8" placeholder="Write here..."><?php echo $eventInfo['event_info']; ?></textarea>
				</div>
			</div>
		</div>

		<!-- Row 3 -->
		<div class="row">
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=viewevents" class="btn btn-success btn-lg mx-2"><i
						class="fas fa-chevron-left mx-2"></i>Go Back</a>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="EventUpdateButton"><i
						class="fas fa-sync fa-1x mx-2"></i>Update Event</button>
			</div>
		</div>
	</form>
</div>

<script>
	function updateTicketPrices()
	{
		// get the full price
		var level1price = document.getElementById("level1price").value;

		// Update the price for the other disabled fields
		document.getElementById("level2price").value = (level1price * 0.5);
		document.getElementById("level3price").value = (level1price * 0.25);
	}

	// Script for showing the file name in custom bootstrap file input fields
	$(".custom-file-input").on("change", function()
	{
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>