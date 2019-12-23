<div class="container height-fix">
	<?php
	if(isset($_GET['added']) && $_GET['added'] == 1)
	{
		echo "
		<div class=\"alert alert-dismissible fade show  alert-success mb-4 border-0\">
			<h4 class=\"text-center\"><i class=\"fas fa-check fa-2x mr-4 align-bottom\"></i>Category Details Added Successfully</h4>
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
			</button>
			<div class=\"text-center\">
			<a href=\"/?page=admindash&action=viewcategories\" class=\"h4\">View</a>
			</div>
		</div>";
	}
	?>
	<h2 class="text-center text-muted mb-5">Add Category</h2>

	<form action="/view/processform.php" method="post">
		<div class="row">
			<div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
				<fieldset>
						<div class="form-group text-center">
							<label for="category_name">Category Name<sup> *</sup></label>
							<input class="form-control" type="text" name="category_name" id="category_name" maxlength="40" autofocus required>
						</div>
				</fieldset>
			</div>


		</div>
		<div class="row">
			<div class="col text-center mt-5">
				<a href="/?page=admindash&action=adminhome" class="btn btn-success btn-lg mx-2"><i
						class="fas fa-chevron-left mx-2"></i>Go Back</a>
				<button type="reset" class="btn btn-secondary btn-lg"><i class="fas fa-undo mx-2"></i>Clear</button>
				<button type="submit" class="btn btn-primary mx-2 btn-lg px-3" name="CategoryAddButton"><i class="fas fa-plus fa-lg fa-1x mx-2"></i>Add Category</button>
			</div>
		</div>
	</form>
</div>