<div class="container">
	<?php
		$planner = $DBModelObject->getPlannerInfo($_GET['id']);

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

	<h2 class="text-center text-muted mb-5">Edit Planner</h2>
	<form action="/view/processform.php" method="post">
		<div class="row">
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Planner Details</legend>
					<input type="hidden" name="planner_id" value="<?php echo $_GET['id']; ?>">
					<div class="form-group">
						<label for="company_name">Company Name<sup> *</sup></label>
						<input value="<?php echo $planner['company_name']; ?>" class="form-control" type="text" name="company_name" id="company_name" maxlength="40" autofocus required>
					</div>
					<div class="form-group">
						<label for="phone">Phone<sup> *</sup></label>
						<input value="<?php echo $planner['phone']; ?>" class="form-control" type="tel" name="phone" id="phone" minlength="10" maxlength="10" required>
					</div>
					<div class="form-group">
						<label for="email">Email<sup> *</sup></label>
						<input value="<?php echo $planner['email']; ?>" class="form-control" type="email" name="email" id="email" maxlength="50" required autocomplete="email">
					</div>
					<div class="form-group">
						<label for="website">Website</label>
						<input value="<?php echo $planner['website']; ?>" class="form-control" type="text" name="website" id="website" maxlength="40">
					</div>
				</fieldset>
			</div>
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted text-center">Address</legend>
					<div class="form-group">
						<label for="street_no">Street Number<sup> *</sup></label>
						<input value="<?php echo $planner['street_no']; ?>" class="form-control" required type="text" name="street_no" id="street_no" maxlength="5"
							size="4">
					</div>
					<div class="form-group">
						<label for="street">Street<sup> *</sup></label>
						<input value="<?php echo $planner['street']; ?>" class="form-control" required type="text" name="street" id="street" maxlength="40"
							autocapitalize="words">
					</div>
					<div class="form-group">
						<label for="suburb">Suburb<sup> *</sup></label>
						<input value="<?php echo $planner['suburb']; ?>" class="form-control" required type="text" name="suburb" id="suburb" maxlength="40"
							autocapitalize="words">
					</div>
					<div class="form-group">
						<label for="postcode">Post Code<sup> *</sup></label>
						<input value="<?php echo $planner['postcode']; ?>" class="form-control" required type="text" name="postcode" id="postcode" minlength="4"
							maxlength="4">
					</div>
					<div class="form-group">
						<label for="state">State<sup> *</sup></label>
						<select name="state" id="state" class="form-control" required>
							<option value="" selected hidden>Select...</option>
							<option <?php if($planner['state'] = "act"){echo "selected";} ?> value="act">ACT</option>
							<option <?php if($planner['state'] = "nsw"){echo "selected";} ?> value="nsw">NSW</option>
							<option <?php if($planner['state'] = "nt"){echo "selected";} ?> value="nt">NT</option>
							<option <?php if($planner['state'] = "qld"){echo "selected";} ?> value="qld">QLD</option>
							<option <?php if($planner['state'] = "sa"){echo "selected";} ?> value="sa">SA</option>
							<option <?php if($planner['state'] = "tas"){echo "selected";} ?> value="tas">TAS</option>
							<option <?php if($planner['state'] = "vic"){echo "selected";} ?> value="vic">VIC</option>
							<option <?php if($planner['state'] = "wa"){echo "selected";} ?> value="wa">WA</option>
						</select>
					</div>
				</fieldset>
			</div>
		</div>


		<div class="row">
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=viewplanners" class="btn btn-success btn-lg mx-2"><i
						class="fas fa-chevron-left mx-2"></i>Go Back</a>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="PlannerUpdateButton"><i
						class="fas fa-sync fa-1x mx-2"></i>Update Planner</button>
			</div>
		</div>
	</form>
</div>
