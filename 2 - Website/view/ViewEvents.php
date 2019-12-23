<?php
include_once "processForm.php";

$eventRecords = $DBModelObject->viewEvents();
?>

<div class="container-fluid height-fix">
	<?php
	if (isset($_GET['deleted']) && $_GET['deleted'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Event Deleted Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	elseif (isset($_GET['updated']) && $_GET['updated'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Event Details Updated Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	?>

	<h2 class="text-center text-muted mb-5">Events</h2>

	<table class="table table-bordered table-hover ">
		<thead class="thead-light text-center">
			<tr>
				<th class="align-middle">ID</th>
				<th class="align-middle">Event Name</th>
				<th class="align-middle">Venue</th>
				<th class="align-middle">Category</th>
				<th class="align-middle">Date</th>
				<th class="align-middle">Start Time</th>
				<th class="align-middle">End Time</th>
				<th class="align-middle">Duration (days)</th>
				<th class="align-middle">Level 1 Price</th>
				<th class="align-middle">Level 2 Price</th>
				<th class="align-middle">Level 3 Price</th>
				<th class="align-middle">Planner</th>
				<th class="align-middle">Description</th>
				<th class="align-middle">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($eventRecords as $event)
			{
				echo "<tr>";
				echo "<td class=\"text-center\">" . $event['event_id'] . "</td>";
				echo "<td>" . $event['event_name'] . "</td>";
				echo "<td>" . $event['venue_name'] . "</td>";
				echo "<td>" . $event['category_name'] . "</td>";
				echo "<td class=\"text-center text-nowrap\">" . $event['start_date'] . "</td>";
				echo "<td class=\"text-center\">" . $event['start_time'] . "</td>";
				echo "<td class=\"text-center\">" . $event['end_time'] . "</td>";
				echo "<td class=\"text-center\">" . $event['duration_days'] . "</td>";
				echo "<td class=\"text-center\">" . "$" . $event['level1price'] . "</td>";
				echo "<td class=\"text-center\">" . "$" . $event['level2price'] . "</td>";
				echo "<td class=\"text-center\">" . "$" . $event['level3price'] . "</td>";
				echo "<td>" . $event['company_name'] . "</td>";
				echo "<td style=\"max-width:400px;overflow:hidden;\">"; if(!empty($event['event_info'])){echo substr($event['event_info'], 0, 60) . "...";} else {echo "N/A";} echo "</td>";
				echo "<td class=\"text-nowrap text-center\">" .
					"<form action=\"/view/processform.php\" method=\"POST\">
						<input type=\"hidden\" name=\"event_id\" value=\"{$event['event_id']}\">" .
						"<button type=\"submit\" name=\"EventEditButton\" class=\"btn btn-warning btn-sm mr-2\" title=\"Edit\">
							<i class=\"fas fa-edit\"></i>
						</button>" .
						// "<button type=\"submit\" name=\"EventDeleteButton\" class=\"btn btn-danger btn-sm\" title=\"Delete\">
						// <i class=\"fas fa-trash-alt\"></i>
						// </button>" .
						"<a href=\"#\" title=\"Delete\" class=\"btn btn-danger btn-sm\" data-toggle=\"modal\" data-target=\"#c{$event['event_id']}\"><i class=\"fas fa-trash-alt\"></i></a>" .
						"</form>"  .
					"</td>";
				echo "</tr>";

				// Delete modal
				echo <<< END
				<div id="c{$event['event_id']}" class="modal fade">
					<div class="modal-dialog" style="z-index:11;">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete Confirmation</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this event?</p>
								{$event['event_id']} - {$event['event_name']}
							</div>
							<div class="modal-footer">
								<form action="/view/processform.php" method="POST">
									<input type="hidden" name="event_id" value="{$event['event_id']}">
									<button type="submit" class="btn btn-danger" name="EventDeleteButton" title="Delete">Delete</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								</form>
							</div>
						</div>
					</div>
				</div>
END;
			}
			?>
		</tbody>
	</table>
	<!-- <div class="alert alert-danger py-2 my-5 text-center col-md-6 offset-md-3 border-0">
		<h4 class="alert-heading"><i class="fas fa-exclamation-triangle mr-2"></i>Warning:</h4>
		<p class="h5"> The <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button> button deletes records immediately without confirmation!</p>
	</div> -->

</div>