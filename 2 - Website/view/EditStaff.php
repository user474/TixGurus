<div class="container">
	<?php
		$staff = $DBModelObject->getStaffInfo($_GET['id']);

		if(isset($_GET['updated']) && $_GET['updated'] == 1)
		{
		echo "
		<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Planner Details Updated Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
			<div class=\"text-center\">
			<a href=\"/?page=admindash&action=viewplanners\" class=\"h4\">View</a>
			</div>
		</div>";
		}
	?>

	<h2 class="text-center text-muted mb-5">Update Staff Details</h2>
	<form action="/view/processform.php" method="post">
		<div class="row">
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Contact Details</legend>
					<input type="hidden" name="staff_id" value="<?php echo $_GET['id']; ?>">
					<div class="form-group">
						<label for="first_name">First Name<sup> *</sup></label>
						<input value="<?php echo $staff['first_name']; ?>" class="form-control" type="text" name="first_name" id="first_name" maxlength="40" autofocus
							required>
					</div>

					<div class="form-group">
						<label for="last_name">Last Name<sup> *</sup></label>
						<input value="<?php echo $staff['last_name']; ?>" class="form-control" type="text" name="last_name" id="last_name" maxlength="40" required>
					</div>

					<div class="form-group">
						<label for="email">Email<sup> *</sup></label>
						<input value="<?php echo $staff['email']; ?>" class="form-control" type="email" name="email" id="email" maxlength="50" required>
					</div>

					<div class="form-group">
						<label for="username">Username<sup> *</sup></label>
						<input value="<?php echo $staff['username']; ?>" class="form-control" type="text" name="username" id="username" maxlength="50" required>
					</div>

					<div class="form-group">
						<label for="phone">Phone<sup> *</sup></label>
						<input value="<?php echo $staff['phone']; ?>" class="form-control" type="tel" name="phone" id="phone" minlength="10" maxlength="10"
							required placeholder="04xxxxxxxx">
					</div>
				</fieldset>

				<fieldset class="mt-4">
					<legend class="text-muted text-center">Job Details</legend>
					<div class="form-group">
						<label for="role">Role<sup> *</sup></label>
						<input value="<?php echo $staff['role']; ?>" class="form-control" type="text" name="role" id="role" maxlength="40" required
							placeholder="E.g. Event Manager">
					</div>
					<div class="form-group">
						<label for="hire_date">Hire Date<sup> *</sup></label>
						<input value="<?php echo $staff['hire_date']; ?>" class="form-control" type="date" name="hire_date" id="hire_date" required>
					</div>
				</fieldset>
			</div>
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Address</legend>
					<div class="form-group">
						<label for="unit">Unit</label>
						<input value="<?php echo $staff['unit']; ?>" class="form-control" type="text" name="unit" id="unit" maxlength="2">
					</div>

					<div class="form-group">
						<label for="street_no">Street Number<sup> *</sup></label>
						<input value="<?php echo $staff['street_no']; ?>" class="form-control" required type="text" name="street_no" id="street_no" maxlength="5"
							size="4">
					</div>

					<div class="form-group">
						<label for="street">Street<sup> *</sup></label>
						<input value="<?php echo $staff['street']; ?>" class="form-control" required type="text" name="street" id="street" maxlength="40"
							autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="suburb">Suburb<sup> *</sup></label>
						<input value="<?php echo $staff['suburb']; ?>" class="form-control" required type="text" name="suburb" id="suburb" maxlength="40"
							autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="postcode">Post Code<sup> *</sup></label>
						<input value="<?php echo $staff['postcode']; ?>" class="form-control" required type="text" name="postcode" id="postcode" minlength="4"
							maxlength="4">
					</div>

					<div class="form-group">
						<label for="state">State<sup> *</sup></label>
						<select name="state" id="state" class="form-control">
							<option value="" selected hidden>Select...</option>
							<option <?php if($staff['state'] == 'act'){echo "selected ";} ?>value="act">ACT</option>
							<option <?php if($staff['state'] == 'nsw'){echo "selected ";} ?>value="nsw">NSW</option>
							<option <?php if($staff['state'] == 'nt'){echo "selected ";} ?>value="nt">NT</option>
							<option <?php if($staff['state'] == 'qld'){echo "selected ";} ?>value="qld">QLD</option>
							<option <?php if($staff['state'] == 'sa'){echo "selected ";} ?>value="sa">SA</option>
							<option <?php if($staff['state'] == 'tas'){echo "selected ";} ?>value="tas">TAS</option>
							<option <?php if($staff['state'] == 'vic'){echo "selected ";} ?>value="vic">VIC</option>
							<option <?php if($staff['state'] == 'wa'){echo "selected ";} ?>value="wa">WA</option>
						</select>
					</div>
				</fieldset>
			</div>
		</div>

		<div class="row">
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=viewstaff" class="btn btn-success btn-lg mx-2"><i
						class="fas fa-chevron-left mx-2"></i>Go Back</a>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="StaffUpdateButton"><i
						class="fas fa-sync fa-1x mx-2"></i>Update Staff</button>
			</div>
		</div>
	</form>
</div>