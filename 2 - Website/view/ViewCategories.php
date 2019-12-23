<?php
include_once "processForm.php";

$categoryRecords = $DBModelObject->viewCategories();
?>

<div class="container-fluid height-fix">
	<?php
	if (isset($_GET['deleted']) && $_GET['deleted'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Category Deleted Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	elseif (isset($_GET['updated']) && $_GET['updated'] == 1)
	{
		echo "<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Category Details Updated Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
		</div>";
	}
	?>

	<h2 class="text-center text-muted mb-5"> Categories</h2>

	<table class="table table-sm table-bordered table-hover col-md-8 offset-md-2 col-lg-6 offset-lg-3">
		<thead class="thead-light text-center">
			<tr>
				<th class="align-middle">ID</th>
				<th class="align-middle">Category</th>
				<th class="align-middle">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($categoryRecords as $category)
			{
				echo "<tr>";
				echo "<td class=\"text-center\">" . $category['category_id'] . "</td>";
				echo "<td class=\"text-center\">" . ucwords($category['category_name']) . "</td>";

				echo "<td class=\"text-nowrap text-center\">" .
					"<form action=\"/view/processform.php\" method=\"POST\">
						<input type=\"hidden\" name=\"category_id\" value=\"{$category['category_id']}\">" .
						"<button type=\"submit\" name=\"CategoryEditButton\" class=\"btn btn-warning btn-sm mr-2\" title=\"Edit\">
							<i class=\"fas fa-edit\"></i>
						</button>" .
						// "<button type=\"submit\" name=\"CategoryDeleteButton\" class=\"btn btn-danger btn-sm\" title=\"Delete\">
						// 	<i class=\"fas fa-trash-alt\"></i>
						// </button>" .
						"<a href=\"#\" class=\"btn btn-danger btn-sm\" data-toggle=\"modal\" data-target=\"#c{$category['category_id']}\" title=\"Delete\"><i class=\"fas fa-trash-alt\"></i></a>" .

						"</form>"  .
					"</td>";
				echo "</tr>";

				// Delete modal
				echo <<< END
				<div id="c{$category['category_id']}" class="modal fade">
					<div class="modal-dialog" style="z-index:11;">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete Confirmation</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this category?</p>
								{$category['category_id']} - {$category['category_name']}
							</div>
							<div class="modal-footer">
								<form action="/view/processform.php" method="POST">
									<input type="hidden" name="category_id" value="{$category['category_id']}">
									<button type="submit" class="btn btn-danger" name="CategoryDeleteButton" title="Delete">Delete</button>
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