<div class="container mt-4 height-fix">
	<?php
		if(isset($_GET['error']))
		{
			if($_GET['error'] == "wrongpassword")
			{
				echo '
				<div class="alert alert-dismissible fade show alert-danger mb-4">
					<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Wrong Password</h4>
					<button type="button" class="close" data-dismiss="alert">
						<span>&times;</span>
					</button>
				</div>';
			}
			elseif($_GET['error'] == "emailnotfound")
			{
				echo
				'<div class="alert alert-dismissible fade show alert-danger mb-4">
					<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Email Address Not Found</h4>
					<button type="button" class="close" data-dismiss="alert">
						<span>&times;</span>
					</button>
				</div>';
			}
			elseif($_GET['error'] == "usernamenotfound")
			{
				echo
				'<div class="alert alert-dismissible fade show alert-danger mb-4">
					<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Username Not Found</h4>
					<button type="button" class="close" data-dismiss="alert">
						<span>&times;</span>
					</button>
				</div>';
			}
		}
	?>

	<div class="row">
		<?php
			// if no user is logged in, display the login form
			if(!isset($_SESSION['customer_id']) && !isset($_SESSION['staff_id']))
			{
				echo '
				<!-- Login forms -->
				<div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4" id="loginForms">
					<div class="mb-5">
						<button class="btn btn-lg btn-primary my-2 btn-block d-inline-block" id="customersButton" type="button" onclick="showCustomerLogin()">Customer Login</button>
						<button class="btn btn-lg btn-secondary my-2 btn-block d-inline-block" id="staffButton" type="button" onclick="showStaffLogin()">Staff Login</button>
					</div>
					<!-- Customer Login form -->
					<div id="customerLoginForm">
						<h1 class="mb-3 text-center text-muted">Customer Login</h1>
						<form action="../view/processForm.php" class="mb-3" method="post">
							<div class="form-group">
								<label for="email">Email:</label>
								<input type="email" class="form-control shadow-sm" placeholder="example@email.com" id="email" name="email"
									required value="';
									if(isset($_GET['email']))
									{echo $_GET['email'];}
									echo '">
							</div>

							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control shadow-sm" id="password" required name="password">
							</div>';
							if(isset($_GET['eventid']) && isset($_GET['redirect']))
							{
								echo
								"<input type=\"hidden\" name=\"event_id\" value=\"{$_GET['eventid']}\">
								<input type=\"hidden\" name=\"redirect\" value=\"{$_GET['redirect']}\">";

							}
							echo
							"<input type=\"submit\" class=\"btn btn-primary btn-block shadow-sm\" name=\"customer_login\" value=\"Login\">
						</form>";
						echo '
						<div class="text-center mb-5">
							<p>Or</p>
							<a href="/?page=signup" class="btn btn-success mb-3 btn-block">Create an account</a>
							<br>
							<p><a href="/?page=resetpassword" class="btn btn-block btn-warning text-dark">Reset password</a></p>
						</div>
					</div> <!-- Customer form div end -->

					<!-- Staff Login form -->
					<div id="staffLoginForm" style="display:none;">
						<h1 class="mb-3 text-center text-muted">Staff Login</h1>
						<form action="../view/processForm.php" class="mb-3" method="post">
							<div class="form-group">
								<label for="username">Username:</label>
								<input type="username" class="form-control shadow-sm" id="username" required name="username" value="';
								if(isset($_GET['username']))
								{echo $_GET['username'];}
								echo '">
							</div>

							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control shadow-sm" id="password" required name="password">
							</div>
							<input type="submit" class="btn btn-primary btn-block shadow-sm" name="staff_login" value="Login">
						</form>
					</div>	<!-- Staff form div end -->
				</div>	<!-- Column end -->';
			}
			// You are already logged in
			elseif(isset($_SESSION['customer_id']) && (isset($_GET['redirect'])) && ($_GET['redirect'] != 'customerorder'))
			{
				echo '
				<div class="col">
					<div class="alert alert-dismissible fade show alert-success mb-4 border-0">
						<h4 class="text-center"><i class="fas fa-info fa-2x mr-4 align-bottom"></i>You Are Already Logged In</h4>
						<div class="text-center">
							<a href="/?page=customerprofile&action=accountoverview" class="h4">Continue</a>
						</div>
					</div>
				</div>';
			}
			elseif(isset($_SESSION['customer_id']))
			{
				echo '
				<div class="col">
					<div class="alert alert-dismissible fade show alert-success mb-4 border-0">
						<h4 class="text-center"><i class="fas fa-info fa-2x mr-4 align-bottom"></i>You Are Already Logged In</h4>
						<div class="text-center">
							<a href="/?page=customerprofile&action=accountoverview" class="h4">Continue</a>
						</div>
					</div>
				</div>';
			}
			elseif(isset($_SESSION['staff_id']) && (!isset($_GET['redirect'])))
			{
				echo '
				<div class="col">
					<div class="alert alert-dismissible fade show alert-success mb-4 border-0">
						<h4 class="text-center"><i class="fas fa-info fa-2x mr-4 align-bottom"></i>You Are Already Logged In</h4>
						<div class="text-center">
							<a href="/?page=admindash&action=adminhome" class="h4">Continue</a>
						</div>
					</div>
				</div>';
			}
			// staff trying to order a ticket - not allowed, must login as a customer
			elseif(isset($_SESSION['staff_id']) && (isset($_GET['redirect'])) && ($_GET['redirect'] == 'customerorder'))
			{
				echo '
				<div class="col">
				<div class="alert alert-dismissible fade show alert-warning mb-4 border-0">
					<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>You Must Login as a Customer to Purchase Event Tickets.</h4>
					<h4 class="text-center">You Are Currently Logged in as a Staff Member.</h4>
					<div class="text-center">
						<a href="/" class="h4">Home</a>
					</div>
				</div>
				</div>';
			}
		?>

	</div>	<!-- Row end -->
</div>	<!-- Container end -->


<script>
	// when a button is selected make it green
	// show the selected form and hide the other

	$customersLoginForm = document.getElementById('customerLoginForm');
	$staffLoginForm = document.getElementById('staffLoginForm');

	function showCustomerLogin()
	{
		if($customersLoginForm.style.display == "none")
		{
			// make customer button selected, staff button deselected
			document.getElementById('customersButton').classList.remove('btn-secondary');
			document.getElementById('customersButton').classList.add('btn-primary');

			document.getElementById('staffButton').classList.remove('btn-primary');
			document.getElementById('staffButton').classList.add('btn-secondary');

			// Show customers login form
			$customersLoginForm.style.display = "block";
			// Hide staff login form
			$staffLoginForm.style.display = "none";
		}
	}

	function showStaffLogin()
	{
		if($staffLoginForm.style.display == "none")
		{
			// make staff button selected, customer button deselected
			document.getElementById('staffButton').classList.remove('btn-secondary');
			document.getElementById('staffButton').classList.add('btn-primary');

			document.getElementById('customersButton').classList.remove('btn-primary');
			document.getElementById('customersButton').classList.add('btn-secondary');

			// Show staff login form
			$customersLoginForm.style.display = "none";
			// Hide customers login form
			$staffLoginForm.style.display = "block";
		}
	}
</script>