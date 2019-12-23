<?php
include_once "processForm.php";

$plannerRecords = $DBModelObject->viewPlanners();
?>

<div class="container-fluid height-fix">
	<?php
	if (isset($_GET['deleted']) && $_GET['deleted'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Planner Deleted Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	elseif (isset($_GET['updated']) && $_GET['updated'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Planner Details Updated Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	?>

	<h2 class="text-center text-muted mb-5">Planners</h2>

	<table class="table table-bordered table-hover ">
		<thead class="thead-light text-center">
			<tr>
				<th class="align-middle">ID</th>
				<th class="align-middle">Company Name</th>
				<th class="align-middle">Website</th>
				<th class="align-middle">Phone</th>
				<th class="align-middle">Email</th>
				<th class="align-middle">Street No</th>
				<th class="align-middle">Street</th>
				<th class="align-middle">Suburb</th>
				<th class="align-middle">Post code</th>
				<th class="align-middle">State</th>
				<th class="align-middle">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($plannerRecords as $planner)
			{
				echo "<tr>";
				echo "<td class=\"text-center\">" . $planner['planner_id'] . "</td>";
				echo "<td>" . ucfirst($planner['company_name']) . "</td>";
				echo "<td>" . $planner['website'] . "</td>";
				echo "<td>" . $planner['phone'] . "</td>";
				echo "<td>" . $planner['email'] . "</td>";
				echo "<td class=\"text-center\">" . $planner['street_no'] . "</td>";
				echo "<td>" . ucwords($planner['street']) . "</td>";
				echo "<td>" . ucwords($planner['suburb']) . "</td>";
				echo "<td class=\"text-center\">" . $planner['postcode'] . "</td>";
				echo "<td class=\"text-center\">" . strtoupper($planner['state']) . "</td>";
				echo "<td class=\"text-nowrap text-center\">" .
					"<form action=\"/view/processform.php\" method=\"POST\">
						<input type=\"hidden\" name=\"planner_id\" value=\"{$planner['planner_id']}\">" .
						"<button type=\"submit\" name=\"PlannerEditButton\" class=\"btn btn-warning btn-sm mr-2\" title=\"Edit\">
							<i class=\"fas fa-edit\"></i>
						</button>" .
						// "<button type=\"submit\" name=\"PlannerDeleteButton\" class=\"btn btn-danger btn-sm\" title=\"Delete\">
						// 	<i class=\"fas fa-trash-alt\"></i>
						// </button>" .
						"<a href=\"#\" title=\"Delete\" class=\"btn btn-danger btn-sm\" data-toggle=\"modal\" data-target=\"#c{$planner['planner_id']}\"><i class=\"fas fa-trash-alt\"></i></a>" .
						"</form>"  .
					"</td>";
				echo "</tr>";

				// Delete modal
				echo <<< END
				<div id="c{$planner['planner_id']}" class="modal fade">
					<div class="modal-dialog" style="z-index:11;">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete Confirmation</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this planner?</p>
								{$planner['planner_id']} - {$planner['company_name']}
							</div>
							<div class="modal-footer">
								<form action="/view/processform.php" method="POST">
									<input type="hidden" name="planner_id" value="{$planner['planner_id']}">
									<button type="submit" class="btn btn-danger" name="PlannerDeleteButton" title="Delete">Delete</button>
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