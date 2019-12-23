<div class="container height-fix">
	<?php
		if(isset($_GET['added']))
		{
			if($_GET['added'] == 1)
			{
				echo "
				<div class=\"alert alert-dismissible fade show alert-success mb-4 border-0\">
					<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Staff Details Added Successfully</h4>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\">&times;</span>
					</button>
					<div class=\"text-center\">
					<a href=\"/?page=admindash&action=viewstaff\" class=\"h4\">View</a>
					</div>
				</div>";
			}
			elseif($_GET['added'] == 0)
			{
				echo "
				<div class=\"alert alert-dismissible fade show  alert-danger mb-4 border-0\">
					<h4 class=\"text-center\"><i class=\"fas fa-exclamation-circle fa-2x mr-4 align-bottom\"></i>Passwords Do Not Match</h4>
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\">&times;</span>
					</button>
				</div>";
			}
		}
	?>

	<h2 class="text-center text-muted mb-5">Add Staff</h2>
	<form action="/view/processform.php" method="post">
		<div class="row">
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Contact Details</legend>

					<div class="form-group">
						<label for="first_name">First Name<sup> *</sup></label>
						<input class="form-control" type="text" name="first_name" id="first_name" maxlength="40" autofocus
							required>
					</div>

					<div class="form-group">
						<label for="last_name">Last Name<sup> *</sup></label>
						<input class="form-control" type="text" name="last_name" id="last_name" maxlength="40" required>
					</div>

					<div class="form-group">
						<label for="email">Email<sup> *</sup></label>
						<input class="form-control" type="email" name="email" id="email" maxlength="50" required>
					</div>

					<div class="form-group">
						<label for="username">Username<sup> *</sup></label>
						<input class="form-control" type="text" name="username" id="username" maxlength="50" required>
					</div>

					<div class="form-group">
						<label for="password">Password<sup> *</sup></label>
						<small class="text-muted form-text">Maximum 20 characters</small>
						<input class="form-control" type="password" name="password" id="password" maxlength="20" required>
					</div>

					<div class="form-group">
						<label for="confirm_password">Confirm Password<sup> *</sup></label>
						<small class="text-muted form-text">Maximum 20 characters</small>
						<input class="form-control" type="password" name="confirm_password" id="confirm_password" maxlength="20" required>
					</div>

					<div class="form-group">
						<label for="phone">Phone<sup> *</sup></label>
						<input class="form-control" type="tel" name="phone" id="phone" minlength="10" maxlength="10"
							required placeholder="04xxxxxxxx">
					</div>
				</fieldset>

				<fieldset class="mt-4">
					<legend class="text-muted text-center">Job Details</legend>
					<div class="form-group">
						<label for="role">Role<sup> *</sup></label>
						<input class="form-control" type="text" name="role" id="role" maxlength="40" required
							placeholder="E.g. Event Manager">
					</div>
					<div class="form-group">
						<label for="hire_date">Hire Date<sup> *</sup></label>
						<input class="form-control" type="date" name="hire_date" id="hire_date" required>
					</div>
				</fieldset>
			</div>
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Address</legend>
					<div class="form-group">
						<label for="unit">Unit</label>
						<input class="form-control" type="text" name="unit" id="unit" maxlength="2">
					</div>

					<div class="form-group">
						<label for="street_no">Street Number<sup> *</sup></label>
						<input class="form-control" required type="text" name="street_no" id="street_no" maxlength="5"
							size="4">
					</div>

					<div class="form-group">
						<label for="street">Street<sup> *</sup></label>
						<input class="form-control" required type="text" name="street" id="street" maxlength="40"
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
						<select name="state" id="state" class="form-control" required>
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
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=adminhome" class="btn btn-success btn-lg mx-2"><i
						class="fas fa-chevron-left mx-2"></i>Go Back</a>
				<button type="reset" class="btn btn-secondary btn-lg"><i class="fas fa-undo mx-2"></i>Clear</button>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="StaffAddButton"><i
						class="fas fa-plus fa-lg fa-1x mx-2"></i>Add Staff</button>
			</div>
		</div>
	</form>
</div>