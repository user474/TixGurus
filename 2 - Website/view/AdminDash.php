<div class="container-fluid pt-3">
<?php

// check if staff member is logged in
if(isset($_SESSION['staff_id']))
{
	// get staff info
	$staffInfo = $DBModelObject->getStaffInfo($_SESSION['staff_id']);

	// row 1 - admin dash buttons
	echo '
	<div class="row my-4">
		<div class="col text-center">

			<!-- Home -->
			<a href="/?page=admindash&action=adminhome" class="btn btn-primary btn-lg m-2"><i class="fas fa-home mr-2"></i>Site Overview</a>

			<!-- Categories -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="far fa-id-card mr-2"></i>Categories</a>
				<div class="dropdown-menu">
					<a href="?page=admindash&action=addcategory" class="dropdown-item my-2 h5"><i
							class="fas fa-plus mr-3 fa-lg"></i>Add</a>
					<div class="dropdown-divider"></div>
					<a href="?page=admindash&action=viewcategories" class="dropdown-item my-2 h5"><i
							class="fas fa-list mr-3"></i>View</a>
				</div>
			</div>

			<!-- Customers -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="fas fa-user-alt mr-2"></i>Customers</a>
				<div class="dropdown-menu">
					<a href="?page=admindash&action=addcustomer" class="dropdown-item my-2 h5"><i
							class="fas fa-plus mr-3 fa-lg"></i>Add</a>
					<div class="dropdown-divider"></div>
					<a href="?page=admindash&action=viewcustomers" class="dropdown-item my-2 h5"><i
							class="fas fa-list mr-3"></i>View</a>
				</div>
			</div>

			<!-- Events -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="far fa-calendar-alt mr-2"></i>Events</a>
				<div class="dropdown-menu">
					<a href="?page=admindash&action=addevent" class="dropdown-item my-2 h5"><i
							class="fas fa-plus mr-3 fa-lg"></i>Add</a>
					<div class="dropdown-divider"></div>
					<a href="?page=admindash&action=viewevents" class="dropdown-item my-2 h5"><i
							class="fas fa-list mr-3"></i>View</a>
				</div>
			</div>


			<!-- Planners -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="fas fa-user-cog mr-2"></i>Planners</a>
				<div class="dropdown-menu">
					<a href="?page=admindash&action=addplanner" class="dropdown-item my-2 h5"><i
							class="fas fa-plus mr-3 fa-lg"></i>Add</a>
					<div class="dropdown-divider"></div>
					<a href="?page=admindash&action=viewplanners" class="dropdown-item my-2 h5"><i
							class="fas fa-list mr-3"></i>View</a>
				</div>
			</div>

			<!-- Staff -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="far fa-id-card mr-2"></i>Staff</a>
				<div class="dropdown-menu">
					<a href="?page=admindash&action=addstaff" class="dropdown-item my-2 h5"><i
							class="fas fa-plus mr-3 fa-lg"></i>Add</a>
					<div class="dropdown-divider"></div>
					<a href="?page=admindash&action=viewstaff" class="dropdown-item my-2 h5"><i
							class="fas fa-list mr-3"></i>View</a>
				</div>
			</div>


			<!-- Venues -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="far fa-map mr-2"></i>Venues</a>
				<div class="dropdown-menu">
					<a href="?page=admindash&action=addvenue" class="dropdown-item my-2 h5"><i
							class="fas fa-plus mr-3 fa-lg"></i>Add</a>
					<div class="dropdown-divider"></div>
					<a href="?page=admindash&action=viewvenues" class="dropdown-item my-2 h5"><i
							class="fas fa-list mr-3"></i>View</a>
				</div>
			</div>


			<!-- Manage -->
			<div class="dropdown d-inline-block m-2">
				<a href="#" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown">
					<i class="fas fa-cogs mr-2"></i>Manage</a>
				<div class="dropdown-menu">
					<a href="?page=admindash&action=adminresetpassword" class="dropdown-item h5 my-2">
						<i class="fas fa-key mr-2"></i>Reset Passwords</a>
					<!-- <div class="dropdown-divider"></div>
					<a href="?page=admindash&action=viewcategories" class="dropdown-item my-2 h5"><i
							class="fas fa-list mr-3"></i>View</a> -->
				</div>
			</div>
		</div>
	</div>
	';

	// row 2 - staff info
	echo <<< END
	<!-- Staff Info -->
	<div class="row my-4">
		<div class="col text-center">
			<ul class="list-unstyled">
				<li class="d-inline-block mx-3"><span class="text-muted">Staff ID: </span>{$staffInfo['staff_id']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Username: </span>{$staffInfo['username']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Name: </span>{$staffInfo['first_name']} {$staffInfo['last_name']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Email: </span>{$staffInfo['email']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Last Logout: </span>{$staffInfo['logout']}</li>
				<li class="d-inline-block mx-3"><span class="text-muted">Last Login: </span>{$staffInfo['login']}</li>
			</ul>
		</div>
	</div>
END;
}
elseif(isset($_SESSION['customer_id']))
{
	// Go to customer profile page
	header("Location:/?page=customerprofile&action=accountoverview");
	exit();
}
else
{
	// Go to login page
	header("Location:/?page=login");
	exit();
}
?>
</div>