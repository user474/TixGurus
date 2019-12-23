<?php
session_start();

$DBModelObject = new DBModel;
$categories = $DBModelObject->getCategories();
$venues = $DBModelObject->getVenues();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- CSS -->
	<link rel="stylesheet" href="<?php "$_SERVER[DOCUMENT_ROOT]"; ?>/css/bootstrap-4.3.1.min.css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php "$_SERVER[DOCUMENT_ROOT]"; ?>/css/style.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php "$_SERVER[DOCUMENT_ROOT]"; ?>/css/fontawesome-5.11.2.css">

	<!-- Scripts -->
	<script src="<?php "$_SERVER[DOCUMENT_ROOT]"; ?>/js/jquery-3.4.1.min.js"></script>
	<script src="<?php "$_SERVER[DOCUMENT_ROOT]"; ?>/js/popper.min.js"></script>
	<script src="<?php "$_SERVER[DOCUMENT_ROOT]"; ?>/js/bootstrap.min.js"></script>


	<title>TixGurus</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index:10">
	<!-- Logo -->
	<a href="?page=home" class="navbar-brand">TixGurus</a>

	<!-- Hamburger Button -->
	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- Collapsable Content -->
	<div class="collapse navbar-collapse" id="navbarContent">
		<!-- Navbar Links -->
		<div class="navbar-nav ml-auto">

			<a href="?page=home#events" class="nav-item nav-link text-white mx-2">Events</a>

			<!-- Venues Dropdown -->
			<div class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown">Venues</a>
				<!-- Dropdown Items -->
				<div class="dropdown-menu">
					<?php
					foreach($venues as $venue)
					{
						echo '<a href="?page=venuedetails&venueid=' . $venue["venue_id"] . '"';
						echo ' class="dropdown-item">';
						echo $venue['venue_name'];
						echo "</a>";
					}
					?>
				</div>
			</div>

			<!-- Categories Dropdown -->
			<div class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown">Categories</a>
				<!-- Dropdown Items -->
				<div class="dropdown-menu">
				<?php
				foreach($categories as $category)
				{
					echo '<a href="?page=categoryevents&category=' . strtolower($category["category_name"]) . '&id=' . $category["category_id"] . '"';
					echo ' class="dropdown-item">';
					echo $category['category_name'];
					echo "</a>";
				}
				?>
				</div>
			</div>

			<a href="?page=help" class="nav-item nav-link text-white mx-2 mb-0">Help</a>

			<!-- Search bar & button -->
			<div class="ml-lg-4">
			<form action="/view/processform.php" class="form-inline" method="POST">
				<input class="form-control mr-sm-2 mr-0" type="search" name="search" id="search" placeholder="Search" style="max-width:360px">
				<button class="btn btn-success mr-2" type="submit" name="searchButton"><i class="fas fa-search mr-1"></i>Search</button>
			</form>
			</div>

			<!-- Day/Night Mode Button -->
			<?php
				if((isset($_GET['page']) && $_GET['page'] == 'home') || empty($_GET['page']) || $_GET['page'] == 'categoryevents')
				{
					echo '<button class="nav-item mr-2 mb-0 btn btn-outline-warning" onclick="switchMode()" id="modeButton">Night Mode</button>';
				}
			?>

			<!-- Logout Button -->
			<?php
				if(isset($_SESSION['customer_id']) || isset($_SESSION['staff_id']))
				{
					if(isset($_SESSION['customer_id']))
					{
						echo '
						<a href="?page=customerprofile&action=accountoverview" class="nav-item btn btn-outline-light mr-3">
							<i class="fas fa-user-cog"></i>
							My Account
						</a>';
					}
					elseif(isset($_SESSION['staff_id']))
					{
						echo '
						<a href="?page=admindash&action=adminhome" class="nav-item btn btn-outline-light mr-3">
							<i class="fas fa-user-cog"></i>
							Staff Account
						</a>';
					}

					// Show logout button
					echo '
					<form action="/view/processform.php" method="post">
						<button type="submit" name="logout" class="nav-item btn btn-outline-danger text-white">
							<i class="fas fa-power-off"></i>
							Logout
						</button>
					</form>';
				}
				else
				{
					// show the login button
					echo '<a href="?page=login" class="nav-item btn btn-outline-light">Login/Join</a>';
				}
			?>
		</div>
	</div>
</nav>