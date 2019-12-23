
	<?php
	$customers = $DBModelObject->getAllCustomers();
	$staff = $DBModelObject->getAllStaff();

	if(isset($_GET['changed']) && $_GET['changed'] == 1)
	{
		echo "
		<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Password Changed Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	// nm = no match
	if(isset($_GET['nm']) && $_GET['nm'] == 1)
	{
		echo "
		<div class=\"alert alert-dismissible fade show alert-danger mb-4\">
			<h4 class=\"text-center\"><i class=\"fas fa-exclamation-circle fa-2x align-bottom mr-4\"></i>Passwords Do Not Match. Try Again.</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	?>


<div class="container col-lg-4 offset-lg-4 text-center height-fix">
	<h2 class="text-muted mb-5">Reset Passwords</h2>
	<h4 class="text-muted">Select A User Type:</h4>
	<div class="mb-3">
		<button class="btn btn-lg btn-primary m-3" id="customerButton" type="button" onclick="showCustomers()">Customer</button>
		<button class="btn btn-lg btn-primary m-3" id="staffButton" type="button" onclick="showStaff()">Staff</button>
	</div>


	<form action="/view/processform.php" method="post">
		<div id="customersDiv" style="display:none;" class="form-group">
			<select name="customer_id" id="customers" class="form-control" onchange="checkSelection()">
				<option value="" hidden>Select customer...</option>
				<?php
					foreach($customers as $customer)
					{
						echo "<option value=\"" . $customer['customer_id'] . "\">" . $customer['customer_id'] . " - " . $customer['first_name'] . " " . $customer['last_name'] . "</option>";
					}
				?>
			</select>
		</div>

		<div id="staffDiv" style="display:none;" class="form-group">
			<select name="staff_id" class="form-control" id="staff" onchange="checkSelection()">
				<option value="" hidden>Select staff...</option>
				<?php
					foreach($staff as $staffMember)
					{
						echo "<option value=\"" . $staffMember['staff_id'] . "\">" . $staffMember['staff_id'] . " - " . $staffMember['first_name'] . " " . $staffMember['last_name'] . " (" . $staffMember['username'] . ")" . "</option>";
					}
				?>
			</select>
		</div>

		<div id="password-fields" style="display:none;">

			<div class="form-group">
				<label for="new_password">New Password</label>
				<input class="form-control" type="password" name="new_password" id="new_password">
			</div>

			<div class="form-group">
				<label for="confirm_password">Confirm New Password</label>
				<input class="form-control" type="password" name="confirm_password" id="confirm_password">
			</div>

			<button type="submit" class="btn btn-primary mx-2 btn-lg px-3 mt-3" name="ChangePasswordButton">
				<i class="fas fa-user-edit fa-lg fa-1x mx-2"></i>Change Password
			</button>

		</div>
	</form>

</div>


<script>
	var customers = document.getElementById('customersDiv');
	var staff = document.getElementById('staffDiv');

	var customerList = document.getElementById('customers');
	var password_fields = document.getElementById('password-fields');

	function showCustomers() {
		// hide password fields and reset index
		password_fields.style.display = "none";
		customerList.selectedIndex = "0";

		// Make the button green color - selected
		document.getElementById('customerButton').style.display = "none";
		document.getElementById('customerButton').classList.add("btn-success");
		document.getElementById('customerButton').classList.remove("btn-primary");
		document.getElementById('customerButton').style.display = "inline-block";

		// Change the other button blue - not selected
		document.getElementById('staff').selectedIndex = "0";
		document.getElementById('staffButton').style.display = "none";
		document.getElementById('staffButton').classList.add("btn-primary");
		document.getElementById('staffButton').classList.remove("btn-success");
		document.getElementById('staffButton').style.display = "inline-block";

		if (customers.style.display == "none") {
			staff.style.display = "none";
			customers.style.display = "block";
		} else if (customers.style.display == "block") {
			// hide password fields and reset index
			password_fields.style.display = "none";
			customerList.selectedIndex = "0";
		}
	}

	function showStaff() {
		// hide password fields and reset index
		password_fields.style.display = "none";
		customerList.selectedIndex = "0";

		// Make the button green color - selected
		document.getElementById('staffButton').style.display = "none";
		document.getElementById('staffButton').classList.add("btn-success");
		document.getElementById('staffButton').classList.remove("btn-primary");
		document.getElementById('staffButton').style.display = "inline-block";

		// Change the other button blue - not selected
		document.getElementById('customers').selectedIndex = "0";
		document.getElementById('customerButton').style.display = "none";
		document.getElementById('customerButton').classList.add("btn-primary");
		document.getElementById('customerButton').classList.remove("btn-success");
		document.getElementById('customerButton').style.display = "inline-block";


		if (staff.style.display == "none") {
			customers.style.display = "none";
			staff.style.display = "block";
		}
		else if(staff.style.display == "block")
		{
			// hide password fields and reset index
			password_fields.style.display = "none";
			customerList.selectedIndex = "0";
		}
	}

	function checkSelection() {
		var selectedCustomerItem = document.getElementById('customers').selectedIndex;
		var selectedStaffItem = document.getElementById('staff').selectedIndex;

		if ((selectedCustomerItem > 0 || selectedStaffItem > 0) && password_fields.style.display == "none") {
			// Show the password fields
			password_fields.style.display = "block";
		}
	}
</script>