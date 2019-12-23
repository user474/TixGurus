<?php
include_once "processForm.php";

$staffRecords = $DBModelObject->viewStaff();
?>

<div class="container-fluid height-fix">
	<?php
	if (isset($_GET['deleted']) && $_GET['deleted'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Staff Deleted Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	elseif (isset($_GET['updated']) && $_GET['updated'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Staff Details Updated Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	?>

	<h2 class="text-center text-muted mb-5">Staff</h2>

	<table class="table table-bordered table-hover ">
		<thead class="thead-light text-center">
			<tr>
				<th class="align-middle">ID</th>
				<th class="align-middle">Username</th>
				<th class="align-middle">First Name</th>
				<th class="align-middle">Last Name</th>
				<th class="align-middle">Phone</th>
				<th class="align-middle">Email</th>
				<th class="align-middle">Unit</th>
				<th class="align-middle">Street No</th>
				<th class="align-middle">Street</th>
				<th class="align-middle">Suburb</th>
				<th class="align-middle">Post code</th>
				<th class="align-middle">State</th>
				<th class="align-middle">Role</th>
				<th class="align-middle">Hire Date</th>
				<th class="align-middle">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($staffRecords as $staff)
			{
				echo "<tr>";
				echo "<td class=\"text-center\">" . $staff['staff_id'] . "</td>";
				echo "<td>" . $staff['username'] . "</td>";
				echo "<td>" . ucwords($staff['first_name']) . "</td>";
				echo "<td>" . ucwords($staff['last_name']) . "</td>";
				echo "<td>" . $staff['phone'] . "</td>";
				echo "<td>" . $staff['email'] . "</td>";
				echo "<td class=\"text-center\">" . $staff['unit'] . "</td>";
				echo "<td class=\"text-center\">" . $staff['street_no'] . "</td>";
				echo "<td>" . ucwords($staff['street']) . "</td>";
				echo "<td>" . ucfirst($staff['suburb']) . "</td>";
				echo "<td class=\"text-center\">" . $staff['postcode'] . "</td>";
				echo "<td class=\"text-center\">" . strtoupper($staff['state']) . "</td>";
				echo "<td>" . ucwords($staff['role']) . "</td>";
				echo "<td class=\"text-center\">" . $staff['hire_date'] . "</td>";
				echo "<td class=\"text-nowrap text-center\">" .
					"<form action=\"/view/processform.php\" method=\"POST\">
						<input type=\"hidden\" name=\"staff_id\" value=\"{$staff['staff_id']}\">" .
						"<button type=\"submit\" name=\"StaffEditButton\" class=\"btn btn-warning btn-sm mr-2\" title=\"Edit\">
							<i class=\"fas fa-edit\"></i>
						</button>" .
						// "<button type=\"submit\" name=\"StaffDeleteButton\" class=\"btn btn-danger btn-sm\" title=\"Delete\">
						// 	<i class=\"fas fa-trash-alt\"></i>
						// </button>" .
						"<a href=\"#\" class=\"btn btn-danger btn-sm\" data-toggle=\"modal\" data-target=\"#c{$staff['staff_id']}\" title=\"Delete\"><i class=\"fas fa-trash-alt\"></i></a>" .
						"</form>"  .
					"</td>";
				echo "</tr>";

				// Delete modal
				echo <<< END
				<div id="c{$staff['staff_id']}" class="modal fade">
					<div class="modal-dialog" style="z-index:11;">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete Confirmation</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this staff member?</p>
								{$staff['staff_id']} - {$staff['first_name']} {$staff['last_name']}
							</div>
							<div class="modal-footer">
								<form action="/view/processform.php" method="POST">
									<input type="hidden" name="staff_id" value="{$staff['staff_id']}">
									<button type="submit" class="btn btn-danger" name="StaffDeleteButton" title="Delete">Delete</button>
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