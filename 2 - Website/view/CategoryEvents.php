<?php
$events = $DBModelObject->getEventByCategory($_GET['category']);
$categoryInfo = $DBModelObject->getCategoryInfo($_GET['id']);
$category_photo = $categoryInfo['category_photo'];

echo '<div style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0)), ' .
'url(../img/categories/' . $category_photo . ');' .
'background-size: cover;
width: 100%;
height: 50vh;
background-position: 50%;">';
echo '<h1 class="text-center text-white pt-5 display-2" style="text-shadow: 0 0 10px grey;">';
echo ucwords($_GET['category']);
echo '</h1>';
echo '	</div>';
echo '<div class="container-fluid p-xl-5" id="content">';
// Check if there is any events
if(!$events)
{
	echo "<h3 class=\"text-center my-5\">Sorry, there is no events in this category yet...</h3>";
}
else
{
	// Card deck and row start
	echo <<< END
	<!-- Card Deck -->
	<div class="card-deck px-xl-5 mb-5">
		<!-- Row -->
		<div class="row">
END;

	// Display the found events
	foreach($events as $event)
	{
		$eventID = $event['event_id'];
		$eventName = ucwords($event['event_name']);
		// remove all special characters and replace spaces with underscores
		$strippedEventName = preg_replace("/[^a-zA-Z ]/", "", $eventName);
		$startDate = $event['start_date'];
		$startTime = $event['start_time'];
		$endTime = $event['end_time'];
		$eventInfoFull = $event['event_info'];
		$eventInfo = ucfirst(substr($event['event_info'], 0, 300));	// limit description to 300 characters
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
			<div class="col-xl-4 col-md-6 col-sm-12 mx-auto">
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
					<div class="card-text">{$eventInfo}</div>
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
					<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Time: </span>{$startHour}:{$startMinutes} {$startSuffix} - {$endHour}:{$endMinutes} {$endSuffix}</span></p>
					<p class="p-0 m-0 h5 my-2"><span class="text-secondary">Date: </span>{$day}/{$month}/{$year}</span></p>
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
}
echo "</div>";
echo "</div>";
echo "</div>";
?>


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

	var h3Heading = document.getElementsByTagName("h3");
	for(var i=0; i < h3Heading.length; i++)
	{
		h3Heading[i].classList.toggle("text-light");
	}

	// Card text
	var cardText = document.getElementsByClassName('card');
	for(var j=0; j < cardText.length; j++)
	{
		cardText[j].classList.toggle("bg-secondary");
		cardText[j].classList.toggle("text-light");
	}
}

</script>