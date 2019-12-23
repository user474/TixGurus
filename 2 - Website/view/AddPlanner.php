<div class="container height-fix">
	<?php
		if(isset($_GET['added']) && $_GET['added'] == 1)
		{
		echo "
		<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Planner Details Added Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
			<div class=\"text-center\">
			<a href=\"/?page=admindash&action=viewplanners\" class=\"h4\">View</a>
			</div>
		</div>";
		}
	?>

	<h2 class="text-center text-muted mb-5">Add Planner</h2>
	<form action="/view/processform.php" method="post">
		<div class="row">
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Planner Details</legend>
					<div class="form-group">
						<label for="company_name">Company Name<sup> *</sup></label>
						<input class="form-control" type="text" name="company_name" id="company_name" maxlength="40" autofocus required>
					</div>
					<div class="form-group">
						<label for="phone">Phone<sup> *</sup></label>
						<input class="form-control" type="tel" name="phone" id="phone" minlength="10" maxlength="10" required>
					</div>
					<div class="form-group">
						<label for="email">Email<sup> *</sup></label>
						<input class="form-control" type="email" name="email" id="email" maxlength="50" required autocomplete="email">
					</div>
					<div class="form-group">
						<label for="website">Website</label>
						<input class="form-control" type="text" name="website" id="website" maxlength="40" >
					</div>
					<!-- <div class="form-group">
						<label for="contact_lastname">Last Name</label>
						<input class="form-control" type="text" name="contact_lastname" id="contact_lastname" maxlength="40" required
							autocomplete="family-name">
					</div> -->
				</fieldset>
			</div>
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Address</legend>
					<div class="form-group">
						<label for="street_no">Street Number<sup> *</sup></label>
						<input class="form-control" required type="text" name="street_no" id="street_no" maxlength="5"
							size="4">
					</div>
					<div class="form-group">
						<label for="street">Street<sup> *</sup></label>
						<input class="form-control" required type="text" name="street" id="street" maxlength="40" autocapitalize="words">
					</div>
					<div class="form-group">
						<label for="suburb">Suburb<sup> *</sup></label>
						<input class="form-control" required type="text" name="suburb" id="suburb" maxlength="40" autocapitalize="words">
					</div>
					<div class="form-group">
						<label for="postcode">Post Code<sup> *</sup></label>
						<input class="form-control" required type="text" name="postcode" id="postcode" minlength="4" maxlength="4">
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
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="PlannerAddButton"><i
						class="fas fa-plus fa-lg fa-1x mx-2"></i>Add Planner</button>
			</div>
		</div>
	</form>
</div>
