<?php
	// this only returns the event ID
	$searchResults = $DBModelObject->search($_GET['search']);



?>

<div class="container-fluid pt-5 p-xl-5" id="content">
	<h1 class="text-center text-muted" id="heading">Search Results for <?php echo '"' . $_GET['search'] . '"'; ?></h1>
	<hr>
	<?php
	// check if there is no results
	if(empty($searchResults))
	{
		echo '<h3 class="text-center mt-3">Sorry, there is no events matching your search</h3>';
	}
	else
	{
		// get event information

	}
	?>
	<!-- Card Deck -->
	<div class="card-deck px-xl-5">
		<!-- Row -->
		<div class="row">
			<?php
				// Display the found events
				foreach($searchResults as $result)
				{
					$event = $DBModelObject->getEventInfo($result['event_id']);
					$eventName = ucwords($event['event_name']);
					$eventID = $event['event_id'];
					$startDate = $event['start_date'];
					$startTime = $event['start_time'];
					$endTime = $event['end_time'];
					$eventInfoFull = $event['event_info'];
					$eventInfo = ucfirst(substr($event['event_info'], 0, 300));	// limit description to 500 characters
					$suburb = ucwords($event['suburb']);
					$venue = $event['venue_name'];
					$level1price = $event['level1price'];
					$level2price = $event['level2price'];
					$level3price = $event['level3price'];
					$startHour = explode(":", $startTime)[0];
					$startMinutes = explode(":", $startTime)[1];
					$endHour = explode(":", $endTime)[0];
					$endMinutes = explode(":", $endTime)[1];
					if($startHour > 12)
					{
						$startHour -= 12;
						$startSuffix = "pm";
					}
					else
					{
						$startSuffix = "am";
					}
					if($endHour > 12)
					{
						$endHour -= 12;
						$endSuffix = "pm";
					}
					else
					{
						$endSuffix = "am";
					}

					$year = explode("-", $startDate)[0];
					$month = explode("-", $startDate)[1];
					$day = explode("-", $startDate)[2];

					$eventPoster = $event['event_poster'];

					if(empty($eventPoster))
					{
						$eventPoster = "http://placehold.it/300x200";
					}

					echo <<< END
						<!-- Column -->
						<div class="col-xl-4 col-md-6 col-sm-12">
							<!-- Card -->
							<div class="card my-5 card-cascade shadow">
END;
								echo "<!-- Card Image -->";
								echo "<img src=\"$eventPoster\" alt=\"event image\" class=\"card-img-top\">";

							echo <<< END
							<!-- Card Body -->
							<div class="card-body text-center">
								<div class="card-title h2">{$eventName}</div>
								<div class="card-subtitle h5 mb-3">{$suburb}</div>
								<div class="card-text mb-2">{$eventInfo}</div>
								<br>
								<!-- Buttons -->
								<form action="/view/processform.php" method="post" style="display: inline-block;">
									<input type="hidden" name="event_id" value="$eventID">
									<button type="submit" class="btn btn-success mr-4 mb-lg-2 mr-lg-3" name="buy_tickets"><span class="h5">Buy Tickets</span></button>
								</form>
								<a href="#" class="btn btn-warning mb-lg-2 mr-lg-3" data-toggle="modal" data-target="#
END;
								echo str_replace(' ', '_', $eventName);
								echo <<< END
								"><span class="h5">More Info...</span></a>
							</div>
							<!-- Card Footer -->
							<div class="card-footer">
								<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Time: </span>{$startHour}:{$startMinutes} {$startSuffix} - {$endHour}:{$endMinutes} {$endSuffix}</p>
								<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Date: </span>{$day}/{$month}/{$year}</p>
								<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Venue: </span>{$venue}</p>
							</div>
						</div>
					</div>

					<!-- Event Info Modal -->
					<div id="
END;
					echo str_replace(' ', '_', $eventName);
					echo <<< END
" class="modal fade">
						<div class="modal-dialog" style="z-index:11;">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">$eventName</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">

END;
									echo "<p>$eventInfoFull</p>";
									echo "
									<div class=\"text-center mt-5\">
									<strong>Tickets</strong>
									</div>
									<div class=\"lead text-center mt-3 table-sm\">
										<table class=\"table table-striped\">
											<tr>
												<td>Level 1</td>
												<td>$$level1price</td>
											</tr>
											<tr>
												<td>Level 2</td>
												<td>$$level2price</td>
											</tr>
											<tr>
												<td>Level 3</td>
												<td>$$level3price</td>
											</tr>
										</table>
									</div>";
								echo '
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>';

				}
			?>
		</div>
	</div>
</div>
