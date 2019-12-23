<div class="container height-fix">
	<?php
		$customer = $DBModelObject->getCustomerInfo($_GET['id']);

		if(isset($_GET['updated']) && $_GET['updated'] == 1)
		{
			echo "
			<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
				<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Customer Details Updated Successfully</h4>
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
					<span aria-hidden=\"true\">&times;</span>
				</button>
			</div>";
		}
	?>
	<h2 class="text-center text-muted mb-5">Update Customer Details</h2>

	<form action="/view/processform.php" method="post">
		<div class="row">
			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted">Contact Details</legend>
					<input type="hidden" name="customer_id" value="<?php echo $_GET['id']; ?>">
						<div class="form-group">
							<label for="first_name">First Name<sup> *</sup></label>
							<input value="<?php echo $customer['first_name']; ?>" class="form-control" type="text" name="first_name" id="first_name" maxlength="40" autofocus required>
						</div>
						<div class="form-group">
							<label for="last_name">Last Name<sup> *</sup></label>
							<input value="<?php echo $customer['last_name']; ?>" class="form-control" type="text" name="last_name" id="last_name" maxlength="40" required autocomplete="family-name">
						</div>
						<div class="form-group">
							<label for="email">Email<sup> *</sup></label>
							<input value="<?php echo $customer['email']; ?>" class="form-control" type="email" name="email" id="email" maxlength="50" required autocomplete="email">
						</div>
						<div class="form-group">
							<label for="phone">Phone<sup> *</sup></label>
							<input value="<?php echo $customer['phone']; ?>" class="form-control" type="tel" name="phone" id="phone" minlength="10" maxlength="10" required placeholder="04xxxxxxxx">
						</div>
						<!-- membership type -->
						<div class="form-group">
							<label for="membership">Membership<sup> *</sup></label>
							<select required name="membership" id="membership" class="form-control">
								<option <?php if($customer['membership'] == 'standard'){echo "selected ";} ?> value="standard">Standard (FREE)</option>
								<option <?php if($customer['membership'] == 'vip'){echo "selected ";} ?> value="vip">VIP ($45/year)</option>
							</select>
						</div>
				</fieldset>
			</div>


			<div class="col-md-5 col-sm-10 offset-sm-1 col-lg-4">
				<fieldset>
					<legend class="text-muted">Address</legend>
					<div class="form-group">
						<label for="unit">Unit</label>
						<input value="<?php echo $customer['unit']; ?>" class="form-control" type="text" name="unit" id="unit" maxlength="2">
					</div>

					<div class="form-group">
						<label for="street_no">Street No<sup> *</sup></label>
						<input value="<?php echo $customer['street_no']; ?>" required class="form-control" type="text" name="street_no" id="street_no" maxlength="5" size="4">
					</div>

					<div class="form-group">
						<label for="street">Street<sup> *</sup></label>
						<input value="<?php echo $customer['street']; ?>" required class="form-control" type="text" name="street" id="street" maxlength="40" autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="suburb">Suburb<sup> *</sup></label>
						<input value="<?php echo $customer['suburb']; ?>" required class="form-control" type="text" name="suburb" id="suburb" maxlength="40" autocapitalize="words">
					</div>

					<div class="form-group">
						<label for="postcode">Post Code<sup> *</sup></label>
						<input value="<?php echo $customer['postcode']; ?>" required class="form-control" type="text" name="postcode" id="postcode" minlength="4" maxlength="4">
					</div>

					<div class="form-group">
						<label for="state">State<sup> *</sup></label>
						<select required name="state" id="state" class="form-control">
							<option  value="" selected disabled hidden>Select...</option>
							<option <?php if($customer['state'] == 'act'){echo "selected ";} ?>value="act">ACT</option>
							<option <?php if($customer['state'] == 'nsw'){echo "selected ";} ?>value="nsw">NSW</option>
							<option <?php if($customer['state'] == 'nt'){echo "selected ";} ?> value="nt">NT</option>
							<option <?php if($customer['state'] == 'qld'){echo "selected ";} ?>value="qld">QLD</option>
							<option <?php if($customer['state'] == 'sa'){echo "selected ";} ?> value="sa">SA</option>
							<option <?php if($customer['state'] == 'tas'){echo "selected ";} ?>value="tas">TAS</option>
							<option <?php if($customer['state'] == 'vic'){echo "selected ";} ?>value="vic">VIC</option>
							<option <?php if($customer['state'] == 'wa'){echo "selected ";} ?> value="wa">WA</option>
						</select>
					</div>
				</fieldset>
			</div>
		</div>
		<div class="row">
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=viewcustomers" class="btn btn-success btn-lg mx-2">
					<i class="fas fa-chevron-left mx-2"></i>
					Go Back
				</a>
				<button type="reset" class="btn btn-secondary btn-lg">
					<i class="fas fa-undo mx-2"></i>
					Undo Changes
				</button>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-5" name="CustomerUpdateButton">
					<i class="fas fa-sync fa-1x mx-2"></i>
					Update
				</button>
			</div>
		</div>
	</form>
</div>