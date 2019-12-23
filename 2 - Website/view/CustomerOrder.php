<?php
$event_id = $_SESSION['event_id'];
$event = $DBModelObject->getEventInfo($event_id);
$level1price = $event['level1price'];
$level2price = $event['level2price'];
$level3price = $event['level3price'];
$order_date = date("Y-m-d");

if(isset($_SESSION['customer_id']))
{
	$customer_id = $_SESSION['customer_id'];
	$customer = $DBModelObject->getCustomerInfo($_SESSION['customer_id']);
	$membership = $customer['membership'];
}
?>

<div class="container p-5 border" style="min-height:80vh;">
	<!-- Customer Info -->
	<div class="mx-auto" style="width:80%;">
	<div class="row">
		<div class="col p-3">
			<strong>Invoice to:</strong><br>
			<span class="lead pl-3"><?php echo $customer['first_name'] . " " . $customer['last_name']; ?></span><br>
			<span class="lead pl-3">Ph: <?php echo $customer['phone']; ?></span><br>
			<span class="lead pl-3">E: <?php echo $customer['email']; ?></span>
		</div>
		<div class="col p-3">
			<strong>Billing Address:</strong><br>
			<span class="lead pl-3"><?php if(!empty($customer['unit'])){echo $customer['unit'] . "/";}  echo $customer['street_no']; ?></span><br>
			<span class="lead pl-3"><?php echo $customer['street']; ?></span><br>
			<span class="lead pl-3"><?php echo $customer['suburb'] . ", " . strtoupper($customer['state']) . " " . $customer['postcode']; ?></span><br>
			<span class="lead pl-3">Australia</span>
		</div>
	</div>
	</div>
	<form action="/view/processform.php" method="post">
		<table class="table mx-auto mt-3" style="width:80%;">
			<thead class="thead-light">
				<tr class="text-center">
					<th>Event</th>
					<th>Ticket Class</th>
					<th>Quantity</th>
					<th>Price</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<tr>
					<td style="width:35%"><?php echo $event['event_name']; ?></td>
					<td>
						<div class="form-group">
							<select name="ticketLevel" id="ticketLevel" onchange="updateTotal()" class="form-control">
								<option value="<?php echo $level1price; ?>">Level 1 &nbsp; $<?php echo $level1price; ?></option>
								<option value="<?php echo $level2price; ?>">Level 2 &nbsp; $<?php echo $level2price; ?></option>
								<option value="<?php echo $level3price; ?>">Level 3 &nbsp; $<?php echo $level3price; ?></option>
							</select>
						</div>
					</td>
					<td><input type="number" name="ticket_quantity" id="ticket_quantity" value="1" onchange="updateTotal()" min="1" max="50" class="form-control" required></td>
					<td id="price"></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2" class="text-right">VIP Membership Discount (10%)</td>
					<td><span id="discount"></span></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2" class="text-right"><strong>Total</strong></td>
					<td><strong><span id="totalPrice"></span></strong></td>
					<input type="hidden" name="order_total" id="order_total" value="">
				</tr>
				<tr>
					<td></td>
					<td colspan="2" class="text-left pt-4"><strong>2. Click PayPal button to pay</strong></td>
					<td class="pt-4">
						<span id="paypal-button-container"></span>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2" class="text-left pt-4"><strong>3. Click Finish to place order</strong></td>
					<td class="pt-4">
						<input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
						<input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
						<input type="hidden" name="order_date" value="<?php echo $order_date; ?>">
						<input type="submit" value="Finish" name="placeOrder" class="btn btn-success btn-lg px-5">
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<span hidden id="membership"><?php echo $membership; ?></span>


<script
	src="https://www.paypal.com/sdk/js?client-id=AWDdGICKZWp8s6k15jmnHzHfnZNTvwcyXXufUHK33Ix5hTF_2YW3mBOVnUK4F-EqNmdxpjmZ6CSLt3kX&currency=AUD">
</script>


<script>
	function updateTotal()
	{
		var quantity = document.getElementById('ticket_quantity').value;
		var ticketList = document.getElementById('ticketLevel');
		var ticketPrice = ticketList.options[ticketList.selectedIndex].value;
		var price = quantity * ticketPrice;
		var discount = 0.1 * price;
		// round to 2 decimal places
		discount = Math.round((discount + 0.00001) * 100) / 100;
		var membership = document.getElementById('membership').innerText;
		if(membership == 'standard')
		{
			discount = 0;
		}
		var totalPrice = price - discount;
		// round the total price to 2 decimal places
		totalPrice = Math.round((totalPrice + 0.00001) * 100) / 100;

		// output values
		document.getElementById('price').innerHTML = '$' + price;
		if(membership == 'vip')
		{
			document.getElementById('discount').innerHTML = '- $' + discount;
		}
		else if(membership == 'standard')
		{
			document.getElementById('discount').innerHTML = 'NA';
		}
		document.getElementById('totalPrice').innerHTML = '<strong>' + '$' + totalPrice + '</strong>';
		document.getElementById('order_total').value = totalPrice;	// this value it passed to PHP
		return totalPrice; // this value is passed to the paypal function
	}
	window.onload = updateTotal();


	paypal.Buttons(
	{
		createOrder: function (data, actions) {
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: updateTotal()
					}
				}]
			});
		},
		onApprove: function (data, actions) {
			return actions.order.capture().then(function (details) {
				alert('Transaction completed by ' + details.payer.name.given_name);
				// Call your server to save the transaction
				return fetch('/paypal-transaction-complete', {
					method: 'post',
					headers: {
						'content-type': 'application/json'
					},
					body: JSON.stringify({
						orderID: data.orderID
					})
				});
			});
		}
	}).render('#paypal-button-container');
</script>