<div class="container height-fix">
<?php
$orders = $DBModelObject->getCustomerOrders($_SESSION['customer_id']);
?>
	<h2 class="text-center text-muted">Order History</h2>
	<div class="row">
		<div class="col-lg-8 mx-auto mt-4">
			<table class="table table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th>Order #</th>
						<th>Date</th>
						<th>Tickets</th>
						<th>Order Total</th>
						<th>View Order</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($orders as $order)
					{
						echo '<tr>';
						echo '<td>' . $order['order_id'] . '</td>';
						echo '<td>' . $order['order_date']  . '</td>';
						echo '<td>' . $order['ticket_quantity']  . '</td>';
						echo '<td>$' . $order['order_total']  . '</td>';
						echo '<td><a class="" href="/?page=customerprofile&action=orderdetails&orderid=' . $order['order_id'] . '"><i class="fas fa-search fa-lg"></i></a></td>';
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
