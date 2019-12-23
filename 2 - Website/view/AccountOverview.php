<?php
$customer_id = $_SESSION['customer_id'];
$recommendedCategory = $DBModelObject->getRecommendedEventCategory($customer_id);
$ordersPlaced = $DBModelObject->getOrdersPlaced($customer_id)['orders_placed'];
$ticketsBought = $DBModelObject->getTicketsBought($customer_id)['tickets_bought'];
$totalSpent = $DBModelObject->getTotalSpent($customer_id)['total_spent'];
?>
<div class="container height-fix">
	<h2 class="text-center text-muted">Account Overview</h2>
	<div class="row">
		<div class="col-lg-6 mx-auto mt-4">
			<table class="table table-hover text-center table-striped">
				<tbody class="lead">
					<tr>
						<td>Orders Placed</td>
						<td><?php echo $ordersPlaced; ?></td>
					</tr>
					<tr>
						<td>Tickets Bought</td>
						<td><?php echo $ticketsBought; ?></td>
					</tr>
					<tr>
						<td>Favorite Category</td>
						<td><?php if(empty($recommendedCategory)){echo 'NA';}else{echo $recommendedCategory["category_name"];} ?></td>
					</tr>
					<tr>
						<td>Total Spent</td>
						<td><?php echo '$'; if(empty($totalSpent)){echo 0;}else{echo $totalSpent;}; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>