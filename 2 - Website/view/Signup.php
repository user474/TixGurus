<div class="container mt-4">
<?php
// Success messages
if(isset($_GET['success']))
{
	if($_GET['success'] == "signup")
	{
		echo
		'<div class="alert alert-dismissible fade show alert-success mb-4 border-0">
			<h4 class="text-center"><i class="fas fa-check fa-2x mr-4 align-bottom"></i>Account Created Successfully</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
			<div class="text-center">
				<a href="/?page=login" class="h4">Click here to login</a>
			</div>
		</div>';
	}
}

// Error messages
elseif(isset($_GET['error']))
{
	if($_GET['error'] == "passwordmismatch")
	{
		echo
		'<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Passwords Do Not Match</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
}

?>
	<div class="row">
		<!-- Column -->
		<div class="col">
			<h1 class="text-center text-muted mb-5">Sign Up</h1>
			<!-- Sign up form -->
			<form action="/view/processform.php" method="post">
				<!-- Row 1 -->
				<div class="row">

					<!-- Column 1 -->
					<div class="col-lg-4 px-5">
						<fieldset>
							<legend class="text-muted text-center">Contact Details</legend>
								<div class="form-group">
									<label for="first_name">First Name<sup> *</sup></label>
									<input class="form-control" type="text" name="first_name" id="first_name" maxlength="40" autofocus required>
								</div>
								<div class="form-group">
									<label for="last_name">Last Name<sup> *</sup></label>
									<input class="form-control" type="text" name="last_name" id="last_name" maxlength="40" required autocomplete="family-name">
								</div>
								<div class="form-group">
									<label for="phone">Phone<sup> *</sup></label>
									<input class="form-control" type="tel" name="phone" id="phone" minlength="10" maxlength="10" required placeholder="04xxxxxxxx">
								</div>
						</fieldset>
					</div>

					<!-- Column 2 -->
					<div class="col-lg-4 px-5">
						<fieldset>
							<legend class="text-muted text-center">Address</legend>
							<div class="form-group">
								<label for="unit">Unit</label>
								<input class="form-control" type="text" name="unit" id="unit" maxlength="2">
							</div>

							<div class="form-group">
								<label for="street_no">Street No<sup> *</sup></label>
								<input required class="form-control" type="text" name="street_no" id="street_no" maxlength="5" size="4">
							</div>

							<div class="form-group">
								<label for="street">Street<sup> *</sup></label>
								<input required class="form-control" type="text" name="street" id="street" maxlength="40" autocapitalize="words">
							</div>

							<div class="form-group">
								<label for="suburb">Suburb<sup> *</sup></label>
								<input required class="form-control" type="text" name="suburb" id="suburb" maxlength="40" autocapitalize="words">
							</div>

							<div class="form-group">
								<label for="postcode">Post Code<sup> *</sup></label>
								<input required class="form-control" type="text" name="postcode" id="postcode" minlength="4" size="4" maxlength="4" placeholder="1234">
							</div>


							<div class="form-group">
								<label for="state">State<sup> *</sup></label>
								<select required name="state" id="state" class="form-control">
									<option value="" selected disabled hidden>Select...</option>
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

					<!-- Column 3 -->
					<div class="col-lg-4 px-5">
						<fieldset>
							<legend class="text-muted text-center">Account</legend>

							<!-- email -->
							<div class="form-group">
								<label for="email">Email<sup> *</sup></label>
								<input class="form-control" type="email" name="email" id="email" maxlength="50" required autocomplete="email">
							</div>

							<!-- password -->
							<div class="form-group">
								<label for="password">Password<sup> *</sup></label>
								<small class="text-muted form-text">Maximum 20 characters</small>
								<input class="form-control" type="password" name="password" id="password" maxlength="20" required>
							</div>

							<!-- confirm password -->
							<div class="form-group">
								<label for="confirm_password">Confirm Password<sup> *</sup></label>
								<input class="form-control" type="password" name="confirm_password" id="confirm_password" maxlength="20" required>
							</div>

							<!-- membership type -->
							<div class="form-group">
								<label for="membership">Membership<sup> *</sup></label>
								<select required name="membership" id="membership" class="form-control">
									<option value="standard" selected>Standard (FREE)</option>
									<option value="vip">VIP ($45/year)</option>
								</select>
							</div>
						</fieldset>
					</div>

				</div>	<!-- Row 1 end -->

				<!-- Row 2 - Buttons Row -->
				<div class="row">
					<div class="col text-center mt-5">
						<a href="/?page=login" class="btn btn-success btn-lg mx-2"><i class="fas fa-chevron-left mx-2"></i>Login</a>
						<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="signupButton"><i class="fas fa-user-plus fa-lg fa-1x mx-2"></i>Sign Up</button>
					</div>
				</div>	<!-- Row 2 end -->
			</form>
		</div>	<!-- main column end -->

	</div>	<!-- Row end -->
</div>	<!-- Container end -->