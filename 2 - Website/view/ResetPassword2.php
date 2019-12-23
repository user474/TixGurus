<?php
if(isset($_GET['success']))
{
	if($_GET['success'] == 'sent')
	{
		echo
		'<div class="alert alert-dismissible fade show alert-success mb-4 border-0">
			<h4 class="text-center"><i class="fas fa-check fa-2x mr-4 align-bottom"></i>Reset Code Sent. Please Check Your Email</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
	if($_GET['success'] == 'changed')
	{
		echo
		'<div class="alert alert-dismissible fade show alert-success mb-4 border-0">
			<h4 class="text-center"><i class="fas fa-check fa-2x mr-4 align-bottom"></i>Password Changed Successfully</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
}

elseif(isset($_GET['error']))
{
	if($_GET['error'] == 'notsent')
	{
		echo '
			<div class="alert alert-dismissible fade show alert-danger mb-4">
				<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Failed To Send Reset Code</h4>
				<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
			</div>';
	}
	if($_GET['error'] == 'passwordchange')
	{
		echo '
		<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Failed to Change Password</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
	if($_GET['error'] == 'wrongresetcode')
	{
		echo '
		<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Wrong Reset Code. Please Enter it Exactly as it Appears.</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
	if($_GET['error'] == 'invalidresetcode')
	{
		echo '
		<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Invalid Reset Code</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
	if($_GET['error'] == 'nomatch')
	{
		echo '
		<div class="alert alert-dismissible fade show alert-danger mb-4">
			<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Passwords Do Not Match. Try again.</h4>
			<button type="button" class="close" data-dismiss="alert">
				<span>&times;</span>
			</button>
		</div>';
	}
}
?>

<div class="container mt-4 height-fix text-center">
	<div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">
		<h1 class="mb-3 text-center text-muted">Password Reset</h1>
		<form action="/view/processform.php" method="post" class="form-group">
			<label for="reset_code">Reset Code</label>
			<input class="form-control mb-4" type="text" name="reset_code" required autofocus maxlength="6">
			<label for="password">New Password</label>
			<input class="form-control mb-4" type="password" name="password" required maxlength="50">
			<label for="confirm_password">Confirm New Password</label>
			<input class="form-control mb-4" type="password" name="confirm_password" required maxlength="50">

			<input class="form-control btn btn-primary" type="submit" value="Change Password" name="reset_change_password">
		</form>
	</div>
</div>