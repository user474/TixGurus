<?php
// get customer info
$customer_id = $_SESSION['customer_id'];
$customerInfo = $DBModelObject->getCustomerInfo($customer_id);
$membership = $customerInfo['membership'];
$recommendedCategory = $DBModelObject->getRecommendedEventCategory($customer_id);
$ordersPlaced = $DBModelObject->getOrdersPlaced($customer_id)['orders_placed'];
$ticketsBought = $DBModelObject->getTicketsBought($customer_id)['tickets_bought'];
$totalSpent = $DBModelObject->getTotalSpent($customer_id)['total_spent'];


if($membership == 'vip')
{
	$membership = strtoupper($membership);
}
else
{
	$membership = ucfirst($membership);
}
?>
<div class="container-fluid mt-3">

<?php
// check if customer is logged in
if(isset($_SESSION['customer_id']))
{
	// row 1
	echo '
	<div class="row my-4">
		<!-- Buttons -->
		<div class="col text-center">

			<!-- Home -->
			<a href="?page=customerprofile&action=accountoverview" class="btn btn-primary btn-lg m-2"><i class="fas fa-home mr-2"></i>Account Overview</a>

			<!-- Order History -->
			<a href="?page=customerprofile&action=orderhistory" class="btn btn-lg btn-primary m-2 h5">
				<i class="fas fa-list mr-2"></i>
				Order History
			</a>

			<!-- Manage Account -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="fas fa-user-cog mr-2"></i>Manage Account</a>
				<div class="dropdown-menu">
					<a href="?page=customerprofile&action=customerupdatedetails" class="dropdown-item my-2 h5"><i
							class="fas fa-sync mr-3 fa-lg"></i>Update My Details</a>
					<a href="?page=customerprofile&action=customerchangepassword" class="dropdown-item my-2 h5"><i
							class="fas fa-key mr-3"></i>Change Password</a>
				</div>
			</div>

			<!-- Recommended Events -->
			<a href="
			?page=categoryevents&category=' . strtolower($recommendedCategory["category_name"]) .
			'&id=' . $recommendedCategory["category_id"] . '" class="btn btn-lg btn-success m-2 h5 ';if(empty($recommendedCategory)){echo 'disabled';} echo '">
				<i class="fas fa-check mr-2"></i>
				Recommended Events
			</a>
		</div>
	</div>';

	// row 2
	echo <<< END
	<!-- Customer Info -->
	<div class="row my-4">
		<div class="col text-center border-bottom">
			<ul class="list-unstyled">
				<li class="d-inline-block mx-3"><span class="text-muted">Customer ID: </span>{$customerInfo['customer_id']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Name: </span>{$customerInfo['first_name']} {$customerInfo['last_name']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Email: </span>{$customerInfo['email']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Membership: </span>{$membership}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Last Logout: </span>{$customerInfo['logout']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Last Login: </span>{$customerInfo['login']}</li>
			</ul>
		</div>
	</div>
END;
}

// check if a staff member is logged in
elseif(isset($_SESSION['staff_id']))
{
	// Go to admin dashboard page
	header("Location:/?page=admindash");
	exit();
}
// no one is logged in
else
{
	// Go to login page
	header("Location:/?page=login");
	exit();
}
?>
</div>