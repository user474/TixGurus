<div class="container height-fix">
<!-- Error handling -->
<?php
if(isset($_GET['error']))
{
	if($_GET['error'] == "dberror")
	{
		echo '
		<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Database Error</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
	elseif($_GET['error'] == "nomatch")
	{
		echo '
		<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>New Passwords Do Not Match</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
	elseif($_GET['error'] == "currentwrong")
	{
		echo '
		<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Current Password is Wrong</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
}
elseif(isset($_GET['success']))
{
	if($_GET['success'] == "passwordchanged")
	{
		echo
		'<div class="alert alert-dismissible fade show alert-success mb-4">
			<h4 class="text-center"><i class="fas fa-check fa-2x mr-4 align-bottom"></i>Password Changed Successfully</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
}


?>






	<form action="/view/processform.php" method="post">
		<div class="row">
			<div class="col-12 col-lg-4 offset-lg-4 mt-3">
				<input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id']; ?>">
				<fieldset>
					<legend class="text-muted text-center my-4">Change Password</legend>

					<div class="form-group">
					<label for="current_password">Current Password</label>
						<input class="form-control" type="password" name="current_password" id="current_password">
					</div>

					<div class="form-group">
					<label for="new_password">New Password</label>
						<input class="form-control" type="password" name="new_password" id="new_password">
					</div>

					<div class="form-group">
						<label for="confirm_password">Confirm New Password</label>
						<input class="form-control" type="password" name="confirm_password" id="confirm_password">
					</div>
				</fieldset>
			</div>
		</div>
		<!-- Row 2 -->
		<div class="row">
			<div class="col-12 col-lg-4 offset-lg-4 text-center">
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3 mt-3" name="CustomerChangePasswordButton">
					<i class="fas fa-user-edit fa-lg fa-1x mx-2"></i>Change Password
				</button>
				<a href="/?page=customerprofile&action=accountoverview" class="btn btn-secondary mx-2 btn-lg px-3 mt-4">Cancel</a>
			</div>
		</div>
	</form>
</div>


