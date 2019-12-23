<?php
include_once "processForm.php";

$customerRecords = $DBModelObject->viewCustomers();
?>

<div class="container-fluid height-fix">
	<?php
	if (isset($_GET['deleted']) && $_GET['deleted'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Customer Deleted Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	elseif (isset($_GET['updated']) && $_GET['updated'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Customer Details Updated Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	?>

	<h2 class="text-center text-muted mb-5">Customers</h2>

	<table class="table table-bordered table-hover ">
		<thead class="thead-light text-center">
			<tr>
				<th class="align-middle">ID</th>
				<th class="align-middle">First Name</th>
				<th class="align-middle">Last Name</th>
				<th class="align-middle">Email</th>
				<th class="align-middle">Phone</th>
				<th class="align-middle">Unit</th>
				<th class="align-middle">Street No</th>
				<th class="align-middle">Street Name</th>
				<th class="align-middle">Suburb</th>
				<th class="align-middle">Post Code</th>
				<th class="align-middle">State</th>
				<th class="align-middle">Membership</th>
				<th class="align-middle">Last Login</th>
				<th class="align-middle">Last Logout</th>
				<th class="align-middle">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($customerRecords as $customer)
			{
				echo "<tr>";
				echo "<td class=\"text-center\">" . $customer['customer_id'] . "</td>";
				echo "<td>" . ucwords($customer['first_name']) . "</td>";
				echo "<td>" . ucwords($customer['last_name']) . "</td>";
				echo "<td>" . $customer['email'] . "</td>";
				echo "<td>" . $customer['phone'] . "</td>";
				echo "<td class=\"text-center\">" . $customer['unit'] . "</td>";
				echo "<td class=\"text-center\">" . $customer['street_no'] . "</td>";
				echo "<td>" . ucwords($customer['street']) . "</td>";
				echo "<td>" . ucwords($customer['suburb']) . "</td>";
				echo "<td class=\"text-center\">" . $customer['postcode'] . "</td>";
				echo "<td class=\"text-center\">" . strtoupper($customer['state']) . "</td>";
				echo "<td class=\"text-center\">"; if($customer['membership'] == 'vip'){echo strtoupper($customer['membership']);} else {echo ucfirst($customer['membership']);} echo "</td>";
				echo "<td>" . $customer['login'] . "</td>";
				echo "<td>" . $customer['logout'] . "</td>";
				echo "<td class=\"text-nowrap text-center\">" .
					"<form action=\"/view/processform.php\" method=\"POST\">
						<input type=\"hidden\" name=\"customer_id\" value=\"{$customer['customer_id']}\">" .
						"<button type=\"submit\" name=\"CustomerEditButton\" class=\"btn btn-warning btn-sm mr-2\" title=\"Edit\">
							<i class=\"fas fa-edit\"></i>
						</button>" .
						// "<button type=\"submit\" name=\"CustomerDeleteButton\" class=\"btn btn-danger btn-sm\" title=\"Delete\">
						"<a href=\"#\" class=\"btn btn-danger btn-sm\" title=\"Delete\" data-toggle=\"modal\" data-target=\"#c{$customer['customer_id']}\"><i class=\"fas fa-trash-alt\"></i></a>" .
							// <i class=\"fas fa-trash-alt\"></i>
						// </button>" .
						"</form>"  .
					"</td>";
				echo "</tr>";

				// Delete modal
				echo <<< END
				<div id="c{$customer['customer_id']}" class="modal fade">
					<div class="modal-dialog" style="z-index:11;">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete Confirmation</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this customer?</p>
								{$customer['customer_id']} - {$customer['first_name']} {$customer['last_name']}
							</div>
							<div class="modal-footer">
								<form action="/view/processform.php" method="POST">
									<input type="hidden" name="customer_id" value="{$customer['customer_id']}">
									<button type="submit" class="btn btn-danger" name="CustomerDeleteButton" title="Delete">Delete</button>
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
</div>