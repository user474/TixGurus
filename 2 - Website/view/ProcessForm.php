<?php
if(session_status() == PHP_SESSION_NONE)
{
    session_start();
}
include_once $_SERVER['DOCUMENT_ROOT'] . "/model/DBModel.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/utilities/Email.php";

$DBModelObject = new DBModel();


// *************************** Login Page ********************************
// ---------- Customer login -----------
if(isset($_POST['customer_login']))
{
	$email = trim($_POST['email']);
	$password = $_POST['password'];

	// check if email address exists in the database
	$customerRecord = $DBModelObject->customerLogin($email);
	if($customerRecord)
	{
		// verify that the password match what is in the database
		$isPasswordValid = password_verify($password, $customerRecord['password']);

		// if matches, go to customer profile page
		if($isPasswordValid)
		{
			// record login time
			$DBModelObject->recordCustomerLoginTime($customerRecord['customer_id']);

			// destroy any active session
			if(isset($_SESSION['staff_id']) || isset($_SESSION['customer_id']))
			{
				session_start();
				session_unset();
				session_destroy();
			}

			// start a session
			session_start();

			// store user details in the session array
			$_SESSION['customer_id'] = $customerRecord['customer_id'];
			$_SESSION['email'] = $customerRecord['email'];
			$_SESSION['first_name'] = $customerRecord['first_name'];
			$_SESSION['event_id'] = $_POST['event_id'];
			$_SESSION['redirect'] = $_POST['redirect'];
			$_SESSION['event_id'] = $_POST['event_id'];

			if(isset($_POST['redirect']))
			{
				header("Location:/?page=" . $_POST['redirect'] . "&eventid=" . $_SESSION['event_id']);
				echo "<br>" . $_SESSION['redirect'];
				exit();
			}
			else
			{
				header("Location:/?page=customerprofile&action=accountoverview");
				exit();
			}
		}
		//else, go back to login page, with a login error
		elseif($isPasswordValid == false)
		{
			header("Location:/?page=login&error=wrongpassword&email=" . $email);
			exit();
		}

	}
	// email address doesn't exist in the database
	else
	{
		header("Location:/?page=login&error=emailnotfound");
		exit();
	}
}

// -------- Staff Login ------------
if(isset($_POST['staff_login']))
{
	$username = trim($_POST['username']);
	$password = $_POST['password'];

	// check if username exists in the database
	$staffRecord = $DBModelObject->staffLogin($username);

	if($staffRecord)
	{
		// verify that the password match what is in the database
		$isPasswordValid = password_verify($password, $staffRecord['password']);

		// if matches, go to admin profile page
		if($isPasswordValid == true)
		{
			// record login time
			$DBModelObject->recordStaffLoginTime($staffRecord['staff_id']);

			// destroy any active session
			if(isset($_SESSION['staff_id']) || isset($_SESSION['customer_id']))
			{
				session_start();
				session_unset();
				session_destroy();
			}

			// start a new session
			session_start();

			// store user details in the session array
			$_SESSION['staff_id'] = $staffRecord['staff_id'];
			$_SESSION['username'] = $staffRecord['username'];

			header("Location:/?page=admindash&action=adminhome");
			exit();
		}
		//else, go back to login page, with a login error
		elseif($isPasswordValid == false)
		{
			header("Location:/?page=login&error=wrongpassword&username=" . $username);
			exit();
		}

	}
	// username doesn't exist in the database
	else
	{
		header("Location:/?page=login&error=usernamenotfound");
		exit();
	}
}

// ---------- Logout -------------
if(isset($_POST['logout']))
{
	if(isset($_SESSION['customer_id']))
	{
		// record customer logout time
		$DBModelObject->recordCustomerLogoutTime($_SESSION['customer_id']);
	}
	elseif(isset($_SESSION['staff_id']))
	{
		// record staff logout time
		$DBModelObject->recordStaffLogoutTime($_SESSION['staff_id']);
	}

	// destroy the current session
	session_start();
	session_unset();
	session_destroy();

	// redirect back to homepage
	header("Location: ../index.php");
	exit();
}


// ---------- Password Reset -------------
if(isset($_POST['send_reset_code']))
{
	$emailAddress = $_POST['email'];

	// check if email address is in the database
	$customerRecord = $DBModelObject->emailAddressCheck($emailAddress);

	if($customerRecord)
	{
		// get customer id
		$customer_id = $customerRecord['customer_id'];

		// generate a reset code
		$reset_code = generateResetCode();

		// save reset code to database
		$DBModelObject->saveResetCode($customer_id, $reset_code);

		// send reset code to user's email address
		$email->addAddress($customerRecord['email']);
		$email->Body = 'Please copy and paste the following Reset Code: ' . $reset_code;
		$sent = $email->send();

		if($sent)
		{
			header("Location:/?page=resetpassword2&success=sent");
			exit();
		}
		else
		{
			header("Location:/?page=resetpassword2&error=notsent");
			exit();
		}
	}
	else
	{
		// email address does not exist
		header("Location:/?page=resetpassword&error=emailnotfound");
		exit();
	}
}

if(isset($_POST['reset_change_password']))
{
	$reset_code = trim($_POST['reset_code']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	// check passwords for match
	if($password == $confirm_password)
	{
		$return_code = checkResetCode($reset_code, $password);

		switch($return_code)
		{
			case 0:
				header("Location:/?page=resetpassword2&success=changed");
				exit();
			break;
			case 1:
				header("Location:/?page=resetpassword2&error=passwordchange");
				exit();
			break;
			case 2:
				header("Location:/?page=resetpassword2&error=wrongresetcode");
				exit();
			break;
			case 3:
				header("Location:/?page=resetpassword2&error=invalidresetcode");
				exit();
			break;
		}
	}
	else
	{
		header("Location:/?page=resetpassword2&error=nomatch");
		exit();
	}
}


// *************************** Admin Dash Page ********************************

// ----------- Customer Actions ----------
// Add Customer Form
if(isset($_POST['CustomerAddButton']))
{
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = trim($_POST['email']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$phone = trim($_POST['phone']);
	$unit = trim($_POST['unit']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];
	$membership = $_POST['membership'];

	if($password == $confirm_password)
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$added = $DBModelObject->addCustomer($first_name, $last_name, $email, $hashedPassword, $phone, $unit, $street_no, $street, $suburb, $postcode, $state, $membership);

		if($added)
		{
			header("Location:/?page=admindash&action=addcustomer&added=1");
			exit();
		}
	}
	else
	{
		header("Location:/?page=admindash&action=addcustomer&added=0");
		exit();
	}

}

// Update Customer Info Form
if(isset($_POST['CustomerUpdateButton']))
{

	$customer_id = $_POST['customer_id'];
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$unit = trim($_POST['unit']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];
	$membership = $_POST['membership'];


	$updated = $DBModelObject->editCustomer($customer_id, $first_name, $last_name, $email, $phone, $unit, $street_no, $street, $suburb, $postcode, $state, $membership);

	if($updated)
	{
		if(isset($_SESSION['staff_id']))
		{
			header("Location:/?page=admindash&action=viewcustomers&updated=1");
			exit();
		}
		elseif(isset($_SESSION['customer_id']))
		{
			// update session variables
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['first_name'] = $_POST['first_name'];

			header("Location:/?page=customerprofile&action=customerupdatedetails&updated=1");
			exit();
		}
	}
}

// Edit Customer button
if(isset($_POST['CustomerEditButton']))
{
	$customer_id = $_POST['customer_id'];

	// Go to the edit form and pass the customer ID with the URL
	header("Location:/?page=admindash&action=editcustomer&id={$customer_id}");
	exit();
}


// Delete Customer button
if(isset($_POST['CustomerDeleteButton']))
{
	$customer_id = $_POST['customer_id'];

	$DBModelObject->deleteCustomer($customer_id);
	header('Location:/?page=admindash&action=viewcustomers&deleted=1');
	exit();
}

// -------------- Event Actions -------------
// Add Event Form
if(isset($_POST['EventAddButton']))
{
	$planner_id = $_POST['planner_id'];
	$event_poster = $_FILES['event_poster'];
	$venue_id = $_POST['venue_id'];
	$event_name = trim($_POST['event_name']);
	$start_date = trim($_POST['start_date']);
	$duration_days = trim($_POST['duration_days']);
	$event_info = trim($_POST['event_info']);
	$start_time = trim($_POST['start_time']);
	$end_time = trim($_POST['end_time']);
	$level1price = trim($_POST['level1price']);
	$level2price = trim($_POST['level2price']);
	$level3price = trim($_POST['level3price']);
	$category_id = $_POST['category_id'];


	if($event_poster['size'] != 0)
	{
		// Call the file upload function
		$event_poster = fileUpload($event_poster, ("event_" . $event_name));
	}


	// Only add the record to the database if the file upload is successful
	if(!is_int($event_poster))
	{
		$added = $DBModelObject->addEvent($planner_id, $venue_id, $event_name, $start_date, $duration_days, $event_info, $start_time, $end_time, $level1price, $level2price, $level3price, $category_id, $event_poster);

		if($added)
		{
			header("Location:/?page=admindash&action=addevent&added=1");
			exit();
		}
	}
	// Files did NOT upload, show a detailed error message
	else
	{
		// redirect for each error code

		// upload failed
		if($event_poster == 1)
		{
			header("Location:/?page=admindash&action=addevent&error=uploadfailed");
			exit();
		}

		// file too large
		if($event_poster == 2)
		{
			header("Location:/?page=admindash&action=addevent&error=filetoolarge");
			exit();
		}

		// upload error
		if($event_poster == 3)
		{
			header("Location:/?page=admindash&action=addevent&error=error");
			exit();
		}

		// wrong file type
		if($event_poster == 4)
		{
			header("Location:/?page=admindash&action=addevent&error=wrongfiletype");
			exit();
		}
	}
}


// Update Event Details
if(isset($_POST['EventUpdateButton']))
{

	$event_id = $_POST['event_id'];
	$planner_id = $_POST['planner_id'];
	$venue_id = $_POST['venue_id'];
	$event_name = trim($_POST['event_name']);
	$start_date = trim($_POST['start_date']);
	$duration_days = trim($_POST['duration_days']);
	$event_info = trim($_POST['event_info']);
	$start_time = trim($_POST['start_time']);
	$end_time = trim($_POST['end_time']);
	$level1price = trim($_POST['level1price']);
	$level2price = trim($_POST['level2price']);
	$level3price = trim($_POST['level3price']);
	$category_id = $_POST['category_id'];
	$current_poster = $_POST['current_poster'];
	$new_poster = $_FILES['new_poster'];

	// if a new poster is selected, upload it
	if($new_poster['size'] != 0)
	{
		if(!empty($current_poster))
		{
			// if a poster exists, delete it and then upload the new one
			unlink($_SERVER['DOCUMENT_ROOT'] . $current_poster);
			$event_poster = fileUpload($new_poster, ("event_" . $event_name));
		}
	}
	// if no new poster is selected, keep the old one
	elseif($new_poster['size'] == 0 && $current_poster != null)
	{
		$event_poster = "/img/uploads/" . $_POST['current_poster'];
	}
	// if no new poster is selected, and old one is null, keep it null
	elseif($new_poster['size'] == 0 && $current_poster == null)
	{
		$event_poster = null;
	}

	// Only add the record to the database if the file upload is successful
	if(!is_int($new_poster))
	{
		$updated = $DBModelObject->editEvent($event_id, $planner_id, $venue_id, $event_name, $start_date, $duration_days, $event_info, $start_time, $end_time, $level1price, $level2price, $level3price, $category_id, $event_poster);

		if($updated)
		{
			header("Location:/?page=admindash&action=viewevents&updated=1");
			exit();
		}
	}
	// Files did NOT upload, show a detailed error message
	elseif(is_int($new_poster))
	{
		// redirect for each error code

		// upload failed
		if($new_poster == 1)
		{
			header("Location:/?page=admindash&action=viewevents&error=uploadfailed");
			exit();
		}

		// file too large
		if($new_poster == 2)
		{
			header("Location:/?page=admindash&action=viewevents&error=filetoolarge");
			exit();
		}

		// upload error
		if($new_poster == 3)
		{
			header("Location:/?page=admindash&action=viewevents&error=error");
			exit();
		}

		// wrong file type
		if($new_poster == 4)
		{
			header("Location:/?page=admindash&action=viewevents&error=wrongfiletype");
			exit();
		}

	}
}

// Edit Event button
if(isset($_POST['EventEditButton']))
{
	$event_id = $_POST['event_id'];

	// Go to the edit form and pass the event ID with the URL
	header("Location:/?page=admindash&action=editevent&id={$event_id}");
	exit();
}

// Delete Event button
if(isset($_POST['EventDeleteButton']))
{
	$event_id = $_POST['event_id'];

	$eventPoster = $DBModelObject->getEventInfo($event_id)['event_poster'];
	$DBModelObject->deleteEvent($event_id);
	if(!empty($eventPoster))
	{
		unlink($_SERVER['DOCUMENT_ROOT'] . $eventPoster);
	}
	header('Location:/?page=admindash&action=viewevents&deleted=1');
	exit();
}

// -------------- Venues Actions -------------
// Add Venue Form
if(isset($_POST['VenueAddButton']))
{

	$venue_name = trim($_POST['venue_name']);
	$no_seats = trim($_POST['no_seats']);
	$capacity = trim($_POST['capacity']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];
	$venue_info = trim($_POST['venue_info']);
	$seat_map = $_FILES['seat_map'];
	$venue_photo = $_FILES['venue_photo'];

	if($seat_map['size'] != 0)
	{
		// Call the file upload function
		$seat_map_path = fileUpload($seat_map, "seat_map_");
	}
	else
	{
		$seat_map_path = null;
	}
	if($venue_photo['size'] != 0)
	{
		// Call the file upload function
		$venue_photo_path = fileUpload($venue_photo, "venue_");
	}
	else
	{
		$venue_photo_path = null;
	}

	// Only add the record to the database if the file upload is successful or no files were selected for upload
	if(!is_int($seat_map_path) && !is_int($venue_photo_path))
	{
		$added = $DBModelObject->addVenue($venue_name, $no_seats, $capacity, $seat_map_path, $street_no, $street, $suburb, $postcode, $state, $venue_photo_path, $venue_info);

		if($added)
		{
			header("Location:/?page=admindash&action=addvenue&added=1");
			exit();
		}
	}
	// Files did NOT upload, show a detailed error message
	elseif(is_int($seat_map_path) || is_int($venue_photo_path))
	{
		// redirect for each error code

		// upload failed
		if($seat_map_path == 1  || $venue_photo_path == 1)
		{
			header("Location:/?page=admindash&action=addvenue&error=uploadfailed");
			exit();
		}

		// file too large
		if($seat_map_path == 2 || $venue_photo_path == 2)
		{
			header("Location:/?page=admindash&action=addvenue&error=filetoolarge");
			exit();
		}

		// upload error
		if($seat_map_path == 3 || $venue_photo_path == 3)
		{
			header("Location:/?page=admindash&action=addvenue&error=error");
			exit();
		}

		// wrong file type
		if($seat_map_path == 4 || $venue_photo_path == 4)
		{
			header("Location:/?page=admindash&action=addvenue&error=wrongfiletype");
			exit();
		}

	}

}

// Update Venue Details
if(isset($_POST['VenueUpdateButton']))
{
	$venue_id = $_POST['venue_id'];
	$venue_name = trim($_POST['venue_name']);
	$no_seats = trim($_POST['no_seats']);
	$capacity = trim($_POST['capacity']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];
	$venue_info = trim($_POST['venue_info']);

	if(!empty($_POST['current_seat_map']))
	{
		$current_seat_map = $_POST['current_seat_map'];
	}
	else
	{
		$current_seat_map = null;
	}

	if(!empty($_POST['current_venue_photo']))
	{
		$current_venue_photo = $_POST['current_venue_photo'];
	}
	else
	{
		$current_venue_photo = null;
	}
	$new_seat_map = $_FILES['new_seat_map'];
	$new_venue_photo = $_FILES['new_venue_photo'];

	// if a new seat map is selected, upload it
	if($new_seat_map['size'] != 0)
	{
		// if a seat map exists, delete it and then upload the new one
		if(!empty($current_seat_map))
		{
			unlink($_SERVER['DOCUMENT_ROOT'] . $current_seat_map);
		}
		$seat_map = fileUpload($new_seat_map, ("map_" . $venue_name));
	}
	// if no new seat map is selected, keep the old one
	elseif($new_seat_map['size'] == 0 && $current_seat_map != null)
	{
		$seat_map = "/img/uploads/" . $_POST['current_seat_map'];
	}
	// if no new seat map is selected, and old one is null, keep it null
	elseif($new_seat_map['size'] == 0 && $current_seat_map == null)
	{
		$seat_map = null;
	}

	// if a new venue photo is selected, upload it
	if($new_venue_photo['size'] != 0)
	{
		// if a seat map exists, delete it and then upload the new one
		if(!empty($current_venue_photo))
		{
			unlink($_SERVER['DOCUMENT_ROOT'] . $current_venue_photo);

		}
		$venue_photo = fileUpload($new_venue_photo, ("venue_" . $venue_name));
	}
	// if no new venue photo is selected, keep the old one
	elseif($new_venue_photo['size'] == 0 && $current_venue_photo != null)
	{
		$venue_photo = "/img/uploads/" . $_POST['current_venue_photo'];
	}
	// if no new venue photo is selected, and old one is null, keep it null
	elseif($new_venue_photo['size'] == 0 && $current_venue_photo == null)
	{
		$venue_photo = null;
	}


	// Only add the record to the database if the file upload is successful
	if(!is_int($seat_map) && !is_int($venue_photo))
	{
		$updated = $DBModelObject->editVenue($venue_id, $venue_name, $no_seats, $capacity, $seat_map, $street_no, $street, $suburb, $postcode, $state, $venue_photo, $venue_info);

		if($updated)
		{
			header("Location:/?page=admindash&action=viewvenues&updated=1");
			exit();
		}
	}
	// Files did NOT upload, show a detailed error message
	elseif(is_int($seat_map) || is_int($venue_photo))
	{
		// redirect for each error code

		// upload failed
		if($new_seat_map == 1  || $new_venue_photo == 1)
		{
			header("Location:/?page=admindash&action=editvenue&error=uploadfailed");
			exit();
		}

		// file too large
		if($new_seat_map == 2 || $new_venue_photo == 2)
		{
			header("Location:/?page=admindash&action=editvenue&error=filetoolarge");
			exit();
		}

		// upload error
		if($new_seat_map == 3 || $new_venue_photo == 3)
		{
			header("Location:/?page=admindash&action=editvenue&error=error");
			exit();
		}

		// wrong file type
		if($new_seat_map == 4 || $new_venue_photo == 4)
		{
			header("Location:/?page=admindash&action=editvenue&error=wrongfiletype");
			exit();
		}
	}
}


// Edit Venue button
if(isset($_POST['VenueEditButton']))
{
	$venue_id = $_POST['venue_id'];

	// Go to the edit form and pass the event ID with the URL
	header("Location:/?page=admindash&action=editvenue&id={$venue_id}");
	exit();
}

// Delete Venue button
if(isset($_POST['VenueDeleteButton']))
{
	$venue_id = $_POST['venue_id'];

	$venuePhoto = $DBModelObject->getVenueInfo($venue_id)['venue_photo'];
	$venueSeatMap = $DBModelObject->getEventInfo($venue_id)['seat_map'];

	if(!empty($venuePhoto))
	{
		unlink($_SERVER['DOCUMENT_ROOT'] . $venuePhoto);
	}
	elseif(!empty($venueSeatMap))
	{
		unlink($_SERVER['DOCUMENT_ROOT'] . $venueSeatMap);
	}

	$DBModelObject->deleteVenue($venue_id);
	header('Location:/?page=admindash&action=viewvenues&deleted=1');
	exit();
}


// -------------- Planners Actions -------------
// Add Planner Form
if(isset($_POST['PlannerAddButton']))
{

	$company_name = trim($_POST['company_name']);
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);
	$website = trim($_POST['website']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];

	$added = $DBModelObject->addPlanner($company_name, $website, $phone, $email, $street_no, $street, $suburb, $postcode, $state);

	if($added)
	{
		header("Location:/?page=admindash&action=addplanner&added=1");
		exit();
	}
}

// Update Planner Details
if(isset($_POST['PlannerUpdateButton']))
{

	$planner_id = $_POST['planner_id'];
	$company_name = trim($_POST['company_name']);
	$website = trim($_POST['website']);
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];

	$updated = $DBModelObject->editPlanner($planner_id, $company_name, $website, $phone, $email, $street_no, $street, $suburb, $postcode, $state);

	if($updated)
	{
		header("Location:/?page=admindash&action=viewplanners&updated=1");
		exit();
	}
}

// Edit Planner button
if(isset($_POST['PlannerEditButton']))
{
	$planner_id = $_POST['planner_id'];

	// Go to the edit form and pass the event ID with the URL
	header("Location:/?page=admindash&action=editplanner&id={$planner_id}");
	exit();
}

// Delete Planner button
if(isset($_POST['PlannerDeleteButton']))
{
	$planner_id = $_POST['planner_id'];

	$DBModelObject->deletePlanner($planner_id);
	header('Location:/?page=admindash&action=viewplanners&deleted=1');
	exit();
}



// -------------- Staff Actions -------------
// Add Staff Form
if(isset($_POST['StaffAddButton']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);
	$unit = trim($_POST['unit']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];
	$role = trim($_POST['role']);
	$hire_date = $_POST['hire_date'];

	if($password == $confirm_password)
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$added = $DBModelObject->addStaff($username, $hashedPassword, $first_name, $last_name, $phone, $email, $unit, $street_no, $street, $suburb, $postcode, $state, $role, $hire_date);

		if($added)
		{
			header("Location:/?page=admindash&action=addstaff&added=1");
			exit();
		}
	}
	else
	{
		header("Location:/?page=admindash&action=addstaff&added=0");
		exit();
	}
}

// Update Staff Details
if(isset($_POST['StaffUpdateButton']))
{

	$staff_id = $_POST['staff_id'];
	$username = trim($_POST['username']);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$phone = trim($_POST['phone']);
	$email = trim($_POST['email']);
	$unit = trim($_POST['unit']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];
	$role = trim($_POST['role']);
	$hire_date = $_POST['hire_date'];

	$updated = $DBModelObject->editStaff($username, $staff_id, $first_name, $last_name, $phone, $email, $unit, $street_no, $street, $suburb, $postcode, $state, $role, $hire_date);

	if($updated)
	{
		// update session variables
		$_SESSION['username'] = $_POST['username'];

		header("Location:/?page=admindash&action=viewstaff&updated=1");
		exit();
	}
}

// Edit Staff button
if(isset($_POST['StaffEditButton']))
{
	$staff_id = $_POST['staff_id'];

	// Go to the edit form and pass the event ID with the URL
	header("Location:/?page=admindash&action=editstaff&id={$staff_id}");
	exit();
}

// Delete Staff button
if(isset($_POST['StaffDeleteButton']))
{
	$staff_id = $_POST['staff_id'];

	$DBModelObject->deleteStaff($staff_id);
	header('Location:/?page=admindash&action=viewstaff&deleted=1');
	exit();
}



// -------------- Categories Actions -------------
// Add Category Form
if(isset($_POST['CategoryAddButton']))
{
	$category_name = trim($_POST['category_name']);

	$added = $DBModelObject->addCategory($category_name);

	if($added)
	{
		header("Location:/?page=admindash&action=addcategory&added=1");
		exit();
	}
}

// Update Category Details
if(isset($_POST['CategoryUpdateButton']))
{
	$category_id = $_POST['category_id'];
	$category_name = trim($_POST['category_name']);

	$updated = $DBModelObject->editCategory($category_id, $category_name);

	if($updated)
	{
		header("Location:/?page=admindash&action=viewcategories&updated=1");
		exit();
	}
}

// Edit Category button
if(isset($_POST['CategoryEditButton']))
{
	$category_id = $_POST['category_id'];

	// Go to the edit form and pass the event ID with the URL
	header("Location:/?page=admindash&action=editcategory&id={$category_id}");
	exit();
}

// Delete Category button
if(isset($_POST['CategoryDeleteButton']))
{
	$category_id = $_POST['category_id'];

	$DBModelObject->deleteCategory($category_id);
	header('Location:/?page=admindash&action=viewcategories&deleted=1');
	exit();
}

// -------------- Reset Password -------------
if(isset($_POST['ChangePasswordButton']))
{
	// Check whether staff or customer has a valid id submitted

	$customer_id = $_POST['customer_id'];
	$staff_id = $_POST['staff_id'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];

	if($new_password == $confirm_password)
	{
		$hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

		if($customer_id)
		{
			$changed = $DBModelObject->changeCustomerPassword($customer_id, $hashedPassword);

			if($changed)
			{
				header('Location:/?page=admindash&action=adminresetpassword&changed=1');
				exit();
			}
		}

		elseif($staff_id)
		{
			$changed = $DBModelObject->changeStaffPassword($staff_id, $hashedPassword);

			if($changed)
			{
				header('Location:/?page=admindash&action=adminresetpassword&changed=1');
				exit();
			}
		}
	}
	else
	{
		// nm = no match
		header('Location:/?page=admindash&action=adminresetpassword&nm=1');
		exit();
	}

}


// -------------- File Upload Function -------------
function fileUpload($inputFile, $prefix)
{
	// Save file details into separate variables
	$fileName = $inputFile['name'];
	$fileTmpName = $inputFile['tmp_name'];
	$fileError = $inputFile['error'];
	$fileSize = $inputFile['size'];

	// Get file extension
	$fileNameArray = explode(".", $fileName);
	$fileExtension = end($fileNameArray);

	// Make file extension lower case
	$fileExtension = strtolower($fileExtension);

	// File extensions that are allow to be uploaded
	$allowed = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];

	// Check if the file has an allowed file extension
	if(in_array($fileExtension, $allowed))
	{
		// check if there is any errors
		if($fileError === 0)
		{
			// check file size and set a limit on max size (5MB)
			if($fileSize < MAX_FILE_SIZE)
			{
				// give the file a unique name so that it doesn't overwrite existing files or get overwritten by another file in the future
				$newFileName = uniqid(($prefix . "_")) . "." . $fileExtension;

				// replace any spaces in the file name with underscores
				$newFileName = str_replace(" ", "_", $newFileName);

				// Specify where to upload the file to
				$fileDestination = $_SERVER['DOCUMENT_ROOT'] . "/img/uploads/" . $newFileName;

				// Upload the file
				if(move_uploaded_file($fileTmpName, $fileDestination))
				{
					// Return the file name and path so it can be stored in the database
					return "/img/uploads/" . $newFileName;
				}
				else
				{
					// Could not copy the file to its destination folder
					return 1;
				}
			}
			else
			{
				// File size is too large. Maximum size is defined in config.php
				return 2;
			}
		}
		else
		{
			// There was an error uploading the file
			return 3;
		}
	}
	else
	{
		// wrong file type - only jpeg, jpg, png, gif, and bmp files allowed
		return 4;
	}
}

// --------------- Sign up ---------------------
if(isset($_POST['signupButton']))
{
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = trim($_POST['email']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$phone = trim($_POST['phone']);
	$unit = trim($_POST['unit']);
	$street_no = trim($_POST['street_no']);
	$street = trim($_POST['street']);
	$suburb = trim($_POST['suburb']);
	$postcode = trim($_POST['postcode']);
	$state = $_POST['state'];
	$membership = $_POST['membership'];

	// if passwords match
	if($password == $confirm_password)
	{
		$added = $DBModelObject->addCustomer($first_name, $last_name, $email, $password, $phone, $unit, $street_no, $street, $suburb, $postcode, $state, $membership);

		if($added)
		{
			header("Location:/?page=login&success=signup");
			exit();
		}
	}
	// else, passwords don't match, go back to the signup form with error message
	else
	{
		header("Location:/?page=signup&error=passwordmismatch");
		exit();
	}

}



// -------------- Customer Profile Page -------------------
// change password
if(isset($_POST['CustomerChangePasswordButton']))
{
	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];
	$customer_id = $_POST['customer_id'];

	$customerRecord = $DBModelObject->getCustomerInfo($customer_id);

	// check if current password is correct
	if(password_verify($current_password, $customerRecord['password']))
	{
		// check new passwords if they match
		if($new_password == $confirm_password)
		{
			// hash new password
			$newPasswordHash = password_hash($new_password, PASSWORD_DEFAULT);

			// Save to database
			$changed = $DBModelObject->changeCustomerPassword($customer_id, $newPasswordHash);

			if($changed)
			{
				// Password changed successfully.
				header("Location:/?page=customerprofile&action=customerchangepassword&success=passwordchanged");
				exit();
			}
			else
			{
				// Couldn't write new password to database
				header("Location:/?page=customerprofile&action=customerchangepassword&error=dberror");
				exit();
			}
		}
		else
		{
			// New Passwords do not match
			header("Location:/?page=customerprofile&action=customerchangepassword&error=nomatch");
			exit();
		}
	}
	else
	{
		// Current password is wrong
		header("Location:/?page=customerprofile&action=customerchangepassword&error=currentwrong");
		exit();
	}
}


// ---------------- Orders ----------------------

// Buy Tickets
if(isset($_POST['buy_tickets']))
{
	$event_id = $_POST['event_id'];

	// if customer is logged in, go to step 2 - only customers can buy tickets, not staff
	if(isset($_SESSION['customer_id']))
	{
		$_SESSION['event_id'] = $event_id;
		header("Location:/?page=customerorder");
		exit();
	}
	// if not logged in as a customer or staff member, go to login page
	elseif(!isset($_SESSION['customer_id']))
	{
		header("Location:/?page=login&redirect=customerorder&eventid=" . $event_id);
		exit();
	}

}


if(isset($_POST['placeOrder']))
{
	// create an order
	$ticket_quantity = $_POST['ticket_quantity'];
	$order_total = $_POST['order_total'];
	$customer_id = $_POST['customer_id'];
	$order_date = $_POST['order_date'];

	$created = $DBModelObject->createOrder($customer_id, $order_date, $ticket_quantity, $order_total);

	if($created)
	{
		// Get the order id of the last order made, which is the above order
		$order_id = $DBModelObject->getLastOrder()['MAX(order_id)'];
		$event_id = $_POST['event_id'];
		$price = $_POST['ticketLevel'];
		$seat_level = rand(1,5);
		$seat_row = rand(1,60);
		$seat_no = rand(1,800);

		// create tickets
		for($i = 1; $i <= $ticket_quantity; $i++)
		{
			// create a ticket
			$DBModelObject->createTicket($order_id, $event_id, $price, $seat_level, $seat_row, $seat_no);
			$seat_no += 1;
		}

		// Redirect to thank you page + display order details
		header("Location:/?page=thankyou&orderid=" . $order_id);
		exit();
	}

}

// --------------- Search -----------------------
if(isset($_POST['searchButton']))
{
	$keywords = $_POST['search'];

	// generate search query URL
	$data = ['search' => $keywords];
	header("Location:/?page=searchresults&" . http_build_query($data));
	exit();
}

// ------------ Reset Code -------------------
function generateResetCode()
{
	$hash = password_hash("passwordreset", PASSWORD_BCRYPT);

	// Generate 6 random numbers between 8 and 40
	for ($counter = 1; $counter < 7; $counter++) {
		$randomDigitArray[] = random_int(8, 40);
	}

	// Pick out characters from the hash matching the position of each of the random numbers above
	$reset_code = null;
	foreach ($randomDigitArray as $value) {
		$reset_code .= substr($hash, ($value - 1), 1);
	}

	// Search for and replace the following illegal characters from the key: O 0 . /
	$excludedCharacters = ['o', '0', '.', '/', 'O'];
	$replacementCharacters = ['p', 'l', 'x', 'g', 'e'];
	$reset_code = str_replace($excludedCharacters, $replacementCharacters, $reset_code);

	// Make all key characters capital
	$reset_code = strtoupper($reset_code);

	return $reset_code;
}

function checkResetCode($code, $new_password)
{
	$DBModelObject = new DBModel();

	$record = $DBModelObject->searchForResetCode($code);

	if(!empty($record))
	{
		$customer_id = $record['customer_id'];
		$storedResetCode = $record['reset_code'];

		// verify reset code
		if($code == $storedResetCode)
		{
			// hash the password
			$new_password = password_hash($new_password, PASSWORD_BCRYPT);

			// update the customer's password to a new password
			$changed = $DBModelObject->changeCustomerPassword($customer_id, $new_password);

			// delete reset code from database
			$DBModelObject->deleteResetCode($customer_id);

			if($changed)
			{
				// success
				return 0;
			}
			else
			{
				// Failed to change the password
				return 1;
			}
		}
		else
		{
			// Reset code is wrong
			return 2;
		}
	}
	else
	{
		// Reset code not found in database
		return 3;
	}

}