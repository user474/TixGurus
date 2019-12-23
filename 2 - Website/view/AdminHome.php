<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/pdf/fpdf.php';

$tickets = $DBModelObject->getNoOfTickets()['COUNT(*)'];
$totalCustomers = $DBModelObject->getNoOfCustomers()['COUNT(*)'];
$events = $DBModelObject->getNoOfEvents()['COUNT(*)'];
$categories = $DBModelObject->getNoOfCategories()['COUNT(*)'];
$planners = $DBModelObject->getNoOfPlanners()['COUNT(*)'];
$venues = $DBModelObject->getNoOfVenues()['COUNT(*)'];
$staff = $DBModelObject->getNoOfStaff()['COUNT(*)'];
$vipCustomers = $DBModelObject->getNoOfVIPCustomers()['COUNT(*)'];
$standardCustomers = $DBModelObject->getNoOfStandardCustomers()['COUNT(*)'];

?>

<div class="container height-fix">

	<div class="d-flex justify-content-center text-primary">
		<a href="/view/SalesReport.php" target="_blank"><h3>Sales Report</h3></a>
	</div>

	<!-- Site Overview -->
	<div class="d-flex justify-content-center mt-3">
		<h2 class="text-muted">Site Overview</h2>
	</div>

	<div class="d-flex justify-content-center">
		<table class="table table-hover col-lg-6">
			<thead class="thead-light">
				<tr>
					<th class="text-center">Category</th>
					<th class="text-center">Number</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="pl-5 pr-0">Tickets Sold</td>
					<td class="text-center"><?php echo $tickets; ?></td>
				</tr>
				<tr>
					<td class="pl-5 pr-0">Events Hosted</td>
					<td class="text-center"><?php echo $events; ?></td>
				</tr>
					<td class="pl-5 pr-0">Event Categories</td>
					<td class="text-center"><?php echo $categories; ?></td>
				</tr>
				<tr>
					<td class="pl-5 pr-0">Event Planners</td>
					<td class="text-center"><?php echo $planners; ?></td>
				</tr>
				<tr>
					<td class="pl-5 pr-0">Venues</td>
					<td class="text-center"><?php echo $venues; ?></td>
				</tr>
				<tr>
					<td class="pl-5 pr-0">Staff Members</td>
					<td class="text-center"><?php echo $staff; ?></td>
				</tr>
				<tr>
					<td class="pl-5 pr-0">+ Total Customers</td>
					<td class="text-center"><?php echo $totalCustomers; ?></td>
				</tr>
				<tr>
					<td class="pl-5 pr-0">- VIP</td>
					<td class="text-center"><?php echo $vipCustomers; ?></td>
				</tr>
				<tr>
					<td class="pl-5 pr-0">- Standard</td>
					<td class="text-center"><?php echo $standardCustomers; ?></td>
				</tr>
			</tbody>
		</table>
	</div>


	<!-- Top 5 weekly -->
	<?php
	// code to find the start and end of the current week
	// Source: https://www.quora.com/How-do-I-display-the-start-and-end-date-of-the-current-week-in-PHP
	$monday = strtotime("last monday");
	$monday = date('w', $monday) == date('w') ? $monday+7*86400 : $monday;
	$sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
	$this_week_sd = date("Y-m-d", $monday);
	$this_week_ed = date("Y-m-d" ,$sunday);

	$Top5WeeklyEvents = $DBModelObject->getTop5WeeklyEvents($this_week_sd, $this_week_ed);
	?>
	<div class="d-flex justify-content-center mt-5 mb-2">
		<h2 class="text-muted">Top 5 Events This Week</h2>
	</div>

	<div class="d-flex justify-content-center">
		<table class="table table-hover col-lg-6">
			<thead class="thead-light">
				<tr>
					<th class="text-center">Event</th>
					<th class="text-center">Tickets Sold</th>
				</tr>
			</thead>

			<tbody>
				<?php
				foreach($Top5WeeklyEvents as $event)
				{
					echo <<< END
					<tr>
						<td class="pl-5 pr-0">{$event['event_name']}</td>
						<td class="text-center">{$event['tickets_sold']}</td>
					</tr>
END;
				}
				?>

			</tbody>
		</table>
	</div>


	<!-- Top 5 monthly -->
	<?php
	$firstDayOfMonth = date('Y-m-01');
	$lastDayOfMonth = date('Y-m-30');

	$Top5MonthlyEvents = $DBModelObject->getTop5MonthlyEvents($firstDayOfMonth, $lastDayOfMonth);
	?>
	<div class="d-flex justify-content-center mt-5 mb-2">
		<h2 class="text-muted">Top 5 Events This Month</h2>
	</div>

	<div class="d-flex justify-content-center">
		<table class="table table-hover col-lg-6">
			<thead class="thead-light">
				<tr>
					<th class="text-center">Event</th>
					<th class="text-center">Tickets Sold</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($Top5MonthlyEvents as $event)
				{
					echo <<< END
					<tr>
						<td class="pl-5 pr-0">{$event['event_name']}</td>
						<td class="text-center">{$event['tickets_sold']}</td>
					</tr>
END;
				}
				?>

			</tbody>
		</table>
	</div>



	<!-- Top 10 yearly -->
	<?php
	$firstDayOfYear = date('Y-01-01');
	$lastDayOfYear = date('Y-12-30');

	$Top10YearlyEvents = $DBModelObject->getTop10YearlyEvents($firstDayOfYear, $lastDayOfYear);
	?>
	<div class="d-flex justify-content-center mt-5 mb-2">
		<h2 class="text-muted">Top 10 Events This Year</h2>
	</div>

	<div class="d-flex justify-content-center">
		<table class="table table-hover col-lg-6">
			<thead class="thead-light">
				<tr>
					<th class="text-center">Event</th>
					<th class="text-center">Tickets Sold</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($Top10YearlyEvents as $event)
				{
					echo <<< END
					<tr>
						<td class="pl-5 pr-0">{$event['event_name']}</td>
						<td class="text-center">{$event['tickets_sold']}</td>
					</tr>
END;
				}
				?>

			</tbody>
		</table>
	</div>



	<!-- Total number of tickets sold by event -->
	<?php
	$TicketsSoldPerEvent = $DBModelObject->getTicketsSoldPerEvent();
	?>
	<div class="d-flex justify-content-center mt-5 mb-2">
		<h2 class="text-muted">Event Statistics</h2>
	</div>

	<div class="d-flex justify-content-center">
		<table class="table table-hover col-lg-6">
			<thead class="thead-light">
				<tr>
					<th class="text-center">Event</th>
					<th class="text-center">Tickets Sold</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($TicketsSoldPerEvent as $event)
				{
					echo <<< END
					<tr>
						<td class="pl-5 pr-0">{$event['event_name']}</td>
						<td class="text-center">{$event['tickets_sold']}</td>
					</tr>
END;
				}
				?>

			</tbody>
		</table>
	</div>


	<!-- Event planner and how many events they planned -->
	<?php
	$PlannersAndHostedEvents = $DBModelObject->getPlannersAndHostedEvents();
	?>
	<div class="d-flex justify-content-center mt-5 mb-2">
		<h2 class="text-muted">Event Planners</h2>
	</div>

	<div class="d-flex justify-content-center">
		<table class="table table-hover col-lg-6">
			<thead class="thead-light">
				<tr>
					<th class="text-center">Planner</th>
					<th class="text-center">Events Hosted</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($PlannersAndHostedEvents as $row)
				{
					echo <<< END
					<tr>
						<td class="pl-5 pr-0">{$row['company_name']}</td>
						<td class="text-center">{$row['events_hosted']}</td>
					</tr>
END;
				}
				?>
			</tbody>
		</table>
	</div>



</div>
