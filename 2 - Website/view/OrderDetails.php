<?php
// get order id from url if set
if(isset($_GET['orderid']) && isset($_SESSION['customer_id']))
{
	$order_id = $_GET['orderid'];
	$orderTickets = $DBModelObject->getOrderTickets($order_id);
}
else
{
	// go back to home
	header("Location:/?page=home");
	exit();
}
?>
<div class="container height-fix">
	<h2 class="text-center text-muted">Order Details</h2>
	<h4 class="text-center text-muted">Order #<?php echo $order_id; ?></h4>

	<!-- Row 1 - table -->
	<div class="row">
		<div class="col mx-auto mt-4">
			<table class="table table-hover text-center table-responsive">
				<thead class="thead-light">
					<tr>
						<th>Ticket #</th>
						<th>Event</th>
						<th>Venue</th>
						<th>Date</th>
						<th>Time</th>
						<th>Price</th>
						<th>Seat Level</th>
						<th>Seat Row</th>
						<th>Seat #</th>
						<th>Ticket</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($orderTickets as $ticket)
					{
						echo '<tr>';
						echo '<td>' . $ticket['ticket_id'] . '</td>';
						echo '<td>' . $ticket['event_name']  . '</td>';
						echo '<td>' . $ticket['venue_name']  . '</td>';
						echo '<td>' . $ticket['start_date']  . '</td>';
						echo '<td>';
						$start_time = $ticket['start_time'];
						$start_hour = explode(":", $start_time)[0];
						$start_minutes = explode(":", $start_time)[1];
						$suffix = null;
						if($start_hour > 12)
						{
							$start_hour -= 12;
							$suffix = 'pm';
						}
						else
						{
							$suffix = 'am';
						}
						echo $start_hour . ":" . $start_minutes . " " . $suffix;
						echo '</td>';
						echo '<td>$' . $ticket['price']  . '</td>';
						echo '<td>' . $ticket['seat_level']  . '</td>';
						echo '<td>' . $ticket['seat_row']  . '</td>';
						echo '<td><strong>' . $ticket['seat_no']  . '</strong></td>';
						echo '<td style="font-size:1.2em;"><a href="/files/Ticket.pdf"><i class="fas fa-file-download fa-lg"></i></a></td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>


	<!-- Row 2 - back button -->
	<div class="row">
		<div class="col text-center">
			<a href="/?page=customerprofile&action=orderhistory" class="btn btn-lg btn-primary mt-4"><i class="fas fa-chevron-left mx-2"></i>Orders</a>
		</div>
	</div>
</div>