<?php
if(isset($_GET['error']))
{
	if($_GET['error'] == 'emailnotfound')
	{
		echo '
			<div class="alert alert-dismissible fade show alert-danger mb-4">
				<h4 class="text-center"><i class="fas fa-exclamation-circle fa-2x mr-4 align-bottom"></i>Could not find a customer with this email address</h4>
				<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
			</div>';
	}
}
?>
<div class="container mt-4 height-fix text-center">
	<div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">
		<h1 class="mb-3 text-center text-muted">Reset Password</h1>
		<form action="/view/processform.php" method="post" class="form-group">
			<br>
			<label for="email" class="mb-3">Email Address</label>
			<br>
			<input class="form-control" type="email" name="email" id="email" placeholder="example@gmail.com" required autofocus maxlength="50" autocomplete="email">
			<br>
			<input class="form-control btn btn-primary" type="submit" value="Send Me A Reset Code" name="send_reset_code">
		</form>
	</div>
</div>