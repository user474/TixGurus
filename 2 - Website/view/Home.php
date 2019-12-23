<?php
// Retrieve all events from database
$events = $DBModelObject->viewEvents();
?>


<!-- Hero Image -->
<!-- <div class="hero">
	<div class="pt-md-5">
		<h1 class="tagline display-3 pt-sm-5 p-sm-5">Life is an Event. Make it memorable.</h1>
	</div>
</div> -->

<!-- Background video -->
<div id="bg-video">
	<div class="overlay"></div>
	<video autoplay="autoplay" muted="muted" loop="loop">
		<source src="/video/concert.mp4" type="video/mp4">
	</video>
	<div class="container h-100">
		<div class="d-flex h-50 text-center align-items-center">
		<div class="w-100 text-white">
			<h1 class="display-3" style="font-weight: 600;">Life is an Event. Make it memorable.</h1>
		</div>
		</div>
	</div>
</div>


<a id="events"></a>
<div class="container-fluid pt-5 p-xl-5" id="content">
	<h2 class="text-center display-4 text-muted" id="heading">On Sale Now</h2>
	<hr>
	<!-- Card Deck -->
	<div class="card-deck px-xl-5">
		<!-- Row -->
		<div class="row">
			<?php
					// Display the found events
				foreach($events as $event)
				{
					$eventName = ucwords($event['event_name']);
					// remove all special characters and replace spaces with underscores
					$strippedEventName = preg_replace("/[^a-zA-Z ]/", "", $eventName);
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
								echo str_replace(' ', '_', $strippedEventName);
								echo <<< END
"><span class="h5">More Info...</span></a>
							</div>
							<!-- Card Footer -->
							<div class="card-footer">
								<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Time: </span>{$startHour}:{$startMinutes} {$startSuffix} - {$endHour}:{$endMinutes} {$endSuffix}</p>
								<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Date: </span>{$day}/{$month}/{$year}</p>
								<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Venue: </span><a href="/?page=venuedetails&venueid=
END;
								echo $event['venue_id'];
								echo <<< END
">{$venue}</a></p>
							</div>
						</div>
					</div>

					<!-- Event Info Modal -->
					<div id="
END;
					echo str_replace(' ', '_', $strippedEventName);
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


	<!-- Back to top button -->
	<button onclick="backToTop()" id="backToTopButton" title="Go to top" class="btn btn-outline-success"><i class="fas fa-chevron-up d-block"></i>Top</button>
</div>

<script>

function switchMode()
{
	var modeButton = document.getElementById('modeButton');

	if(modeButton.innerHTML == 'Day Mode')
	{
		// switch to day mode
		dayMode();
	}
	else if(modeButton.innerHTML == 'Night Mode')
	{
		// switch to night mode
		nightMode();
	}
}

function nightMode()
{
	modeButton.innerHTML = "Day Mode";

	// card footer text
	var footerText = document.getElementsByClassName("text-secondary");

	for(var m = 0; m < footerText.length; m++)
	{
		footerText[m].classList.add("text-white-50");
	}

	footerText = null;

	var footerText = document.getElementsByClassName("text-white-50");
	for(var m = 0; m < footerText.length; m++)
	{
		footerText[m].classList.remove("text-secondary");
	}

	// change links from blue to white
	var links = document.querySelectorAll("p a");
	for(m = 0; m < links.length; m++)
	{
		links[m].classList.add("text-white");
	}

	common();
}

function dayMode()
{

	// change mode button text
	modeButton.innerHTML = "Night Mode";

	// card footer text
	var footerText = document.getElementsByClassName("text-white-50");
	for(var m = 0; m < footerText.length; m++)
	{
		footerText[m].classList.add("text-secondary");
	}

	var footerText = document.getElementsByClassName("text-secondary");
	for(var m = 0; m < footerText.length; m++)
	{
		footerText[m].classList.remove("text-white-50");
	}

	// change links from white to blue
	var links = document.querySelectorAll("p a");
	for(m = 0; m < links.length; m++)
	{
		links[m].classList.remove("text-white");
	}

	common();
}

// code that is common for both day and night modes
function common()
{
	// toggle background color
	document.getElementById("content").classList.toggle("bg-dark");
	document.getElementById("space").classList.toggle("bg-dark");

	var headings = document.getElementsByTagName("h2");
	for(var i=0; i < headings.length; i++)
	{
		headings[i].classList.toggle("text-muted");
		headings[i].classList.toggle("text-light");
	}

	// Card text
	var cardText = document.getElementsByClassName('card');
	for(var j=0; j < cardText.length; j++)
	{
		cardText[j].classList.toggle("bg-secondary");
		cardText[j].classList.toggle("text-light");
	}

	// scroll down to events after changing mode
	var events = document.getElementById('events').offsetTop;
	window.scrollTo(0, events/1.3);
}



// Back to top button script
var backToTopButton = document.getElementById("backToTopButton");

// When the user scrolls down 400px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction()
{
	if (document.body.scrollTop > 400 || document.documentElement.scrollTop > 400)
	{
		backToTopButton.style.display = "block";
	}
	else
	{
		backToTopButton.style.display = "none";
	}
}

// When the user clicks on the button, scroll to the top of the document
function backToTop()
{
	document.body.scrollTop = 0; // For Safari
	document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>