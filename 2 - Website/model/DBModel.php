<?php
require_once "Database.php";
// config.php has the MAX_RECORDS constant defined in it
require_once $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";

class DBModel extends Database
{
	private $dbConnection;

	public function __construct()
	{
		try
		{
			// Connect to database
			$this->dbConnection = new Database();
			$this->dbConnection = $this->dbConnection->connect();
		}
		catch(PDOException $ex)
		{
			die("Could not connect to the database. " . $ex->getMessage());
		}
	}

	// -------------------------------------- Customer --------------------------------------
	public function addCustomer($first_name, $last_name, $email, $password, $phone, $unit, $street_no, $street, $suburb, $postcode, $state, $membership)
	{
		$query = "INSERT INTO customers (first_name, last_name, email, password, phone, unit, street_no, street, suburb, postcode, state, membership)
		values (:first_name, :last_name, :email, :password, :phone, :unit, :street_no, :street, :suburb, :postcode, :state, :membership)";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':first_name', $first_name);
			$statement->bindParam(':last_name', $last_name);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':password', $password);
			$statement->bindParam(':phone', $phone);
			$statement->bindParam(':unit', $unit);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);
			$statement->bindParam(':membership', $membership);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function editCustomer($customer_id, $first_name, $last_name, $email, $phone, $unit, $street_no, $street, $suburb, $postcode, $state, $membership)
	{
		$query = "UPDATE customers
		SET first_name = :first_name,
		last_name = :last_name,
		email = :email,
		phone = :phone,
		unit = :unit,
		street_no = :street_no,
		street = :street,
		suburb = :suburb,
		postcode = :postcode,
		`state` = :state,
		membership = :membership
		WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':first_name', $first_name);
			$statement->bindParam(':last_name', $last_name);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':phone', $phone);
			$statement->bindParam(':unit', $unit);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);
			$statement->bindParam(':customer_id', $customer_id);
			$statement->bindParam(':membership', $membership);

			// Execute
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function deleteCustomer($customer_id)
	{
		$query = "DELETE FROM customers WHERE customer_id=:customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			// Return
			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}


	}

	public function viewCustomers()
	{
		$query = "SELECT * FROM customers ORDER BY customer_id LIMIT " . MAX_RECORDS;
		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getCustomerInfo($customer_id)
	{
		// Retrieve one customer record and return it
		$query = "SELECT * FROM customers WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':customer_id', $customer_id);


			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetch();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getAllCustomers()
	{
		$query = "SELECT customer_id, first_name, last_name FROM customers";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function changeCustomerPassword($customer_id, $new_password)
	{
		$query = "UPDATE customers
		SET `password` = :new_password
		WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':new_password', $new_password);
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getNoOfCustomers()
	{
		$query = "SELECT COUNT(*) FROM customers";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getNoOfStandardCustomers()
	{
		$query = "SELECT COUNT(*) FROM customers WHERE membership = 'standard'";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getNoOfVIPCustomers()
	{
		$query = "SELECT COUNT(*) FROM customers WHERE membership='vip'";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getRecommendedEventCategory($customer_id)
	{
		$query = "SELECT category.category_id, category_name
		FROM orders
		JOIN tickets ON orders.order_id = tickets.order_id
		JOIN `events` ON events.event_id = tickets.event_id
		JOIN category ON events.category_id = category.category_id
		WHERE customer_id = :customer_id
		GROUP BY category_name
		ORDER BY COUNT(*) DESC
		LIMIT 1";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	// Customer Account Overview
	public function getOrdersPlaced($customer_id)
	{
		$query = "SELECT COUNT(*) AS 'orders_placed'
		FROM orders
		WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getTicketsBought($customer_id)
	{
		$query = "SELECT COUNT(*) as 'tickets_bought'
		FROM orders
		JOIN tickets ON tickets.order_id = orders.order_id
		WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getTotalSpent($customer_id)
	{
		$query = "SELECT SUM(order_total) AS 'total_spent'
		FROM orders
		WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}




	// -------------------------------------- Venue --------------------------------------
	public function addVenue($venue_name, $no_seats, $capacity, $seat_map, $street_no, $street, $suburb, $postcode, $state, $venue_photo, $venue_info)
	{
		$query = "INSERT INTO venues (venue_name, no_seats, capacity, seat_map, street_no, street, suburb, postcode, state, venue_photo, venue_info)
		values (:venue_name, :no_seats, :capacity, :seat_map, :street_no, :street, :suburb, :postcode, :state, :venue_photo, :venue_info)";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':venue_name', $venue_name);
			$statement->bindParam(':no_seats', $no_seats);
			$statement->bindParam(':capacity', $capacity);
			$statement->bindParam(':seat_map', $seat_map);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);
			$statement->bindParam(':venue_photo', $venue_photo);
			$statement->bindParam(':venue_info', $venue_info);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function editVenue($venue_id, $venue_name, $no_seats, $capacity, $seat_map, $street_no, $street, $suburb, $postcode, $state, $venue_photo, $venue_info)
	{
		$query = "UPDATE venues
		SET
		venue_name = :venue_name,
		no_seats = :no_seats,
		capacity = :capacity,
		seat_map = :seat_map,
		street_no = :street_no,
		street = :street,
		suburb = :suburb,
		postcode = :postcode,
		`state` = :state,
		venue_photo = :venue_photo,
		venue_info = :venue_info
		WHERE
		venue_id = :venue_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':venue_name', $venue_name);
			$statement->bindParam(':no_seats', $no_seats);
			$statement->bindParam(':capacity', $capacity);
			$statement->bindParam(':seat_map', $seat_map);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);
			$statement->bindParam(':venue_photo', $venue_photo);
			$statement->bindParam(':venue_info', $venue_info);
			$statement->bindParam(':venue_id', $venue_id);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function deleteVenue($venue_id)
	{
		$query = "DELETE FROM venues WHERE venue_id=:venue_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':venue_id', $venue_id);

			// Execute
			$statement->execute();

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function viewVenues()
	{
		$query = "SELECT * FROM venues ORDER BY venue_id LIMIT " . MAX_RECORDS;
		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getVenues()
	{
		// Retrieve venue name and id
		$query = "SELECT venue_id, venue_name FROM venues ORDER BY venue_name";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getVenueInfo($venue_id)
	{
		// Retrieve one venue record and return it
		$query = "SELECT * FROM venues WHERE venue_id = :venue_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':venue_id', $venue_id);


			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetch();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getNoOfVenues()
	{
		$query = "SELECT COUNT(*) FROM venues";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}


	// -------------------------------------- Events --------------------------------------
	public function addEvent($planner_id, $venue_id, $event_name, $start_date, $duration_days, $event_info, $start_time, $end_time, $level1price, $level2price, $level3price, $category_id, $event_poster)
	{
		$query = "INSERT INTO events (planner_id, venue_id, event_name, `start_date`, duration_days, event_info, start_time, end_time, level1price, level2price, level3price, category_id, event_poster)
		VALUES (:planner_id, :venue_id, :event_name, :start_date, :duration_days, :event_info, :start_time, :end_time, :level1price, :level2price, :level3price, :category_id, :event_poster)";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':event_poster', $event_poster);
			$statement->bindParam(':planner_id', $planner_id);
			$statement->bindParam(':venue_id', $venue_id);
			$statement->bindParam(':event_name', $event_name);
			$statement->bindParam(':start_date', $start_date);
			$statement->bindParam(':duration_days', $duration_days);
			$statement->bindParam(':event_info', $event_info);
			$statement->bindParam(':start_time', $start_time);
			$statement->bindParam(':end_time', $end_time);
			$statement->bindParam(':level1price', $level1price);
			$statement->bindParam(':level2price', $level2price);
			$statement->bindParam(':level3price', $level3price);
			$statement->bindParam(':category_id', $category_id);

			// Execute
			$statement->execute();

			var_dump($statement);

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function editEvent($event_id, $planner_id, $venue_id, $event_name, $start_date, $duration_days, $event_info, $start_time, $end_time, $level1price, $level2price, $level3price, $category_id, $event_poster)
	{
		$query = "UPDATE events
		SET
		planner_id = :planner_id,
		venue_id = :venue_id,
		event_name = :event_name,
		`start_date` = :start_date,
		duration_days = :duration_days,
		event_info = :event_info,
		start_time = :start_time,
		end_time = :end_time,
		level1price = :level1price,
		level2price = :level2price,
		level3price = :level3price,
		category_id = :category_id,
		event_poster = :event_poster
		WHERE
		event_id = :event_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':planner_id', $planner_id);
			$statement->bindParam(':venue_id', $venue_id);
			$statement->bindParam(':event_name', $event_name);
			$statement->bindParam(':start_date', $start_date);
			$statement->bindParam(':duration_days', $duration_days);
			$statement->bindParam(':event_info', $event_info);
			$statement->bindParam(':start_time', $start_time);
			$statement->bindParam(':end_time', $end_time);
			$statement->bindParam(':level1price', $level1price);
			$statement->bindParam(':level2price', $level2price);
			$statement->bindParam(':level3price', $level3price);
			$statement->bindParam(':category_id', $category_id);
			$statement->bindParam(':event_id', $event_id);
			$statement->bindParam(':event_poster', $event_poster);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function deleteEvent($event_id)
	{
		$query = "DELETE FROM events WHERE event_id=:event_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':event_id', $event_id);

			// Execute
			$statement->execute();

			// Return
			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function viewEvents()
	{
		$query = "SELECT event_id, events.venue_id, event_name, venue_name, category_name, `start_date`, start_time, end_time, duration_days, level1price, level2price, level3price, planners.company_name, event_info, event_poster, venues.suburb
		FROM `events`
		LEFT JOIN category ON category.category_id = events.category_id
		LEFT JOIN venues ON venues.venue_id = events.venue_id
		LEFT JOIN planners ON planners.planner_id = events.planner_id
		LIMIT " . MAX_RECORDS;

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getCategories()
	{
		$query = "SELECT * FROM category ORDER BY category_name";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getEventInfo($event_id)
	{
		// Retrieve one event record and return it
		$query = "SELECT *
		FROM events
		JOIN venues ON events.venue_id = venues.venue_id
		WHERE event_id = :event_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':event_id', $event_id);


			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetch();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getEventByCategory($category_name)
	{
		$query = "SELECT event_name, event_id, start_date, start_time, end_time, event_info, event_poster, venues.suburb, venue_name, level1price, level2price, level3price, events.venue_id
		FROM `events`, category
		right join venues on venue_id
		WHERE category_name = :category_name
		AND events.category_id = category.category_id
		AND events.venue_id = venues.venue_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':category_name', $category_name);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}

	}

	public function getNoOfEvents()
	{
		$query = "SELECT COUNT(*) FROM events";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getTop5WeeklyEvents($startDate, $endDate)
	{
		$query = "SELECT tickets.event_id, count(tickets.event_id) as `tickets_sold`, events.event_name
		FROM tickets, events, orders
		WHERE events.event_id = tickets.event_id
		AND tickets.order_id = orders.order_id
		AND order_date BETWEEN :startDate AND :endDate
		GROUP BY tickets.event_id
		ORDER BY COUNT(tickets.event_id) DESC
		LIMIT 5";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':startDate', $startDate);
			$statement->bindParam(':endDate', $endDate);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetchAll();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getTop5MonthlyEvents($startDate, $endDate)
	{
		$query = "SELECT tickets.event_id, count(tickets.event_id) as `tickets_sold`, events.event_name
		FROM tickets, events, orders
		WHERE events.event_id = tickets.event_id
		AND tickets.order_id = orders.order_id
		AND order_date BETWEEN :startDate AND :endDate
		GROUP BY tickets.event_id
		ORDER BY COUNT(tickets.event_id) DESC
		LIMIT 5";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':startDate', $startDate);
			$statement->bindParam(':endDate', $endDate);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetchAll();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getTop10YearlyEvents($startDate, $endDate)
	{
		$query = "SELECT tickets.event_id, count(tickets.event_id) as `tickets_sold`, events.event_name
		FROM tickets, events, orders
		WHERE events.event_id = tickets.event_id
		AND tickets.order_id = orders.order_id
		AND order_date BETWEEN :startDate AND :endDate
		GROUP BY tickets.event_id
		ORDER BY COUNT(tickets.event_id) DESC
		LIMIT 5";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':startDate', $startDate);
			$statement->bindParam(':endDate', $endDate);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetchAll();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getTicketsSoldPerEvent()
	{
		$query = "SELECT event_name, COUNT(*) as 'tickets_sold'
		FROM tickets
		JOIN events ON tickets.event_id = events.event_id
		GROUP BY event_name
		ORDER BY COUNT(*) DESC";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetchAll();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getPlannersAndHostedEvents()
	{
		$query = "SELECT company_name, count(*) AS 'events_hosted'
		FROM events
		JOIN planners ON events.planner_id = planners.planner_id
		GROUP BY company_name
		ORDER BY COUNT(*) DESC";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetchAll();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}


	// -------------------------------------- Planner --------------------------------------
	public function addPlanner($company_name, $website, $phone, $email, $street_no, $street, $suburb, $postcode, $state)
	{
		$query = "INSERT INTO planners (company_name, website, phone, email, street_no, street, suburb, postcode, `state`)
		values (:company_name, :website, :phone, :email, :street_no, :street, :suburb, :postcode, :state)";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':company_name', $company_name);
			$statement->bindParam(':website', $website);
			$statement->bindParam(':phone', $phone);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function editPlanner($planner_id, $company_name, $website, $phone, $email, $street_no, $street, $suburb, $postcode, $state)
	{
		$query = "UPDATE planners
		SET
		company_name = :company_name,
		website = :website,
		phone = :phone,
		email = :email,
		street_no = :street_no,
		street = :street,
		suburb = :suburb,
		postcode = :postcode,
		`state` = :state
		WHERE
		planner_id = :planner_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':company_name', $company_name);
			$statement->bindParam(':website', $website);
			$statement->bindParam(':phone', $phone);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);
			$statement->bindParam(':planner_id', $planner_id);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function deletePlanner($planner_id)
	{
		$query = "DELETE FROM planners WHERE planner_id=:planner_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':planner_id', $planner_id);

			// Execute
			$statement->execute();

			// Return
			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function viewPlanners()
	{
		$query = "SELECT * FROM planners ORDER BY planner_id LIMIT " . MAX_RECORDS;
		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getPlanners()
	{
		// Retrieve planner name and id
		$query = "SELECT planner_id, company_name FROM planners ORDER BY company_name";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getPlannerInfo($planner_id)
	{
		// Retrieve one planner record and return it
		$query = "SELECT * FROM planners WHERE planner_id = :planner_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':planner_id', $planner_id);


			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetch();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getNoOfPlanners()
	{
		$query = "SELECT COUNT(*) FROM planners";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	// -------------------------------------- Staff --------------------------------------
	public function addStaff($username, $password, $first_name, $last_name, $phone, $email, $unit, $street_no, $street, $suburb, $postcode, $state, $role, $hire_date)
	{
		$query = "INSERT INTO staff (username, password, first_name, last_name, phone, email, unit, street_no, street, suburb, postcode, state, role, hire_date)
		values (:username, :password, :first_name, :last_name, :phone, :email, :unit, :street_no, :street, :suburb, :postcode, :state, :role, :hire_date)";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':username', $username);
			$statement->bindParam(':password', $password);
			$statement->bindParam(':first_name', $first_name);
			$statement->bindParam(':last_name', $last_name);
			$statement->bindParam(':phone', $phone);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':unit', $unit);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);
			$statement->bindParam(':role', $role);
			$statement->bindParam(':hire_date', $hire_date);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function editStaff($username, $staff_id, $first_name, $last_name, $phone, $email, $unit, $street_no, $street, $suburb, $postcode, $state, $role, $hire_date)
	{
		$query = "UPDATE staff
		SET
		username = :username,
		first_name = :first_name,
		last_name = :last_name,
		phone = :phone,
		email = :email,
		unit = :unit,
		street_no = :street_no,
		street = :street,
		suburb = :suburb,
		postcode = :postcode,
		`state` = :state,
		`role` = :role,
		hire_date = :hire_date
		WHERE
		staff_id = :staff_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':first_name', $first_name);
			$statement->bindParam(':username', $username);
			$statement->bindParam(':last_name', $last_name);
			$statement->bindParam(':phone', $phone);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':unit', $unit);
			$statement->bindParam(':street_no', $street_no);
			$statement->bindParam(':street', $street);
			$statement->bindParam(':suburb', $suburb);
			$statement->bindParam(':postcode', $postcode);
			$statement->bindParam(':state', $state);
			$statement->bindParam(':role', $role);
			$statement->bindParam(':hire_date', $hire_date);
			$statement->bindParam(':staff_id', $staff_id);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function deleteStaff($staff_id)
	{
		$query = "DELETE FROM staff WHERE staff_id=:staff_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':staff_id', $staff_id);

			// Execute
			$statement->execute();

			// Return
			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function viewStaff()
	{
		$query = "SELECT * FROM staff ORDER BY staff_id LIMIT " . MAX_RECORDS;
		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getStaffInfo($staff_id)
	{
		$query = "SELECT * FROM staff WHERE staff_id = :staff_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':staff_id', $staff_id);


			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetch();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getAllStaff()
	{
		$query = "SELECT staff_id, first_name, last_name, username FROM staff";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function changeStaffPassword($staff_id, $new_password)
	{
		$query = "UPDATE staff
		SET `password` = :new_password
		WHERE staff_id = :staff_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':new_password', $new_password);
			$statement->bindParam(':staff_id', $staff_id);

			// Execute
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getNoOfStaff()
	{
		$query = "SELECT COUNT(*) FROM staff";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	// -------------------------------------- Category --------------------------------------
	public function addCategory($category_name)
	{
		$query = "INSERT INTO category (category_name)
		values (:category_name)";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':category_name', $category_name);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function editCategory($category_id, $category_name)
	{
		$query = "UPDATE category
		SET
		category_name = :category_name
		WHERE
		category_id = :category_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':category_name', $category_name);
			$statement->bindParam(':category_id', $category_id);

			// Execute
			$statement->execute();

			return true;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function deleteCategory($category_id)
	{
		$query = "DELETE FROM category WHERE category_id=:category_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':category_id', $category_id);

			// Execute
			$statement->execute();

			// Return
			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function viewCategories()
	{
		$query = "SELECT * FROM category ORDER BY category_id LIMIT " . MAX_RECORDS;
		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetchAll();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getCategoryInfo($category_id)
	{
		$query = "SELECT * FROM category WHERE category_id = :category_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind Parameters
			$statement->bindParam(':category_id', $category_id);


			// Execute
			$statement->execute();

			// Fetch results
			$results = $statement->fetch();

			// Return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function getNoOfCategories()
	{
		$query = "SELECT COUNT(*) FROM category";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}


	// -------------------------------------- Tickets -----------------------------------
	public function getNoOfTickets()
	{
		$query = "SELECT COUNT(*) FROM tickets";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function createTicket($order_id, $event_id, $price, $seat_level, $seat_row, $seat_no)
	{
		$query = "INSERT INTO tickets (order_id, event_id, price, seat_level, seat_row, seat_no)
		VALUES (:order_id, :event_id, :price, :seat_level, :seat_row, :seat_no)";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':order_id', $order_id);
			$statement->bindParam(':event_id', $event_id);
			$statement->bindParam(':price', $price);
			$statement->bindParam(':seat_level', $seat_level);
			$statement->bindParam(':seat_row', $seat_row);
			$statement->bindParam(':seat_no', $seat_no);

			// Execute query
			$statement->execute();
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	public function getOrderTickets($order_id)
	{
		$query = "SELECT *
		FROM tickets
		LEFT JOIN `events` ON tickets.event_id = events.event_id
		LEFT JOIN venues ON events.venue_id = venues.venue_id
		WHERE order_id = :order_id";

		try
		{
			// prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':order_id', $order_id);

			// Execute query
			$statement->execute();

			// fetch results
			$results = $statement->fetchAll();

			// return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	// ---------------------------------- Login + Logout --------------------------------------
	public function customerLogin($email)
	{
		// Get customer's record that matches the supplied email address
		$query = "SELECT customer_id, email, first_name, `password`
		FROM customers
		WHERE email = :email";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':email', $email);

			// Execute query
			$statement->execute();

			// Get results - one record
			$results = $statement->fetch(PDO::FETCH_ASSOC);

			// return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function staffLogin($username)
	{
		// Get staff member's record that matches the supplied username
		$query = "SELECT staff_id, username, `password` FROM staff WHERE username = :username";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':username', $username);

			// Execute query
			$statement->execute();

			// Get results - one record
			$results = $statement->fetch(PDO::FETCH_ASSOC);

			// return results
			return $results;

		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function recordCustomerLoginTime($customer_id)
	{
		$query = "UPDATE customers
		SET login = NOW()
		WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function recordCustomerLogoutTime($customer_id)
	{
		$query = "UPDATE customers
		SET logout = NOW()
		WHERE customer_id = :customer_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function recordStaffLoginTime($staff_id)
	{
		$query = "UPDATE staff
		SET login = NOW()
		WHERE staff_id = :staff_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':staff_id', $staff_id);

			// Execute
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function recordStaffLogoutTime($staff_id)
	{
		$query = "UPDATE staff
		SET logout = NOW()
		WHERE staff_id = :staff_id";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':staff_id', $staff_id);

			// Execute
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function emailAddressCheck($email)
	{
		$query = "SELECT *
		FROM customers
		WHERE email = :email";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':email', $email);

			// Execute query
			$statement->execute();

			// Get results - one record
			$results = $statement->fetch();

			// return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function searchForResetCode($reset_code)
	{
		$query = "SELECT *
		FROM passwordreset
		WHERE reset_code = :reset_code
		LIMIT 1";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':reset_code', $reset_code);

			// Execute query
			$statement->execute();

			// Get results - one record
			$results = $statement->fetch();

			// return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function saveResetCode($customer_id, $reset_code)
	{
		$query = "INSERT INTO passwordreset
		VALUES (:customer_id, :reset_code)";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':customer_id', $customer_id);
			$statement->bindParam(':reset_code', $reset_code);

			// Execute query
			$statement->execute();
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function deleteResetCode($customer_id)
	{
		$query = "DELETE FROM passwordreset
		WHERE customer_id = :customer_id";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute query
			$statement->execute();
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}


	// -------------------------------------- Orders -----------------------------------
	public function getLastOrder()
	{
		$query = "SELECT MAX(order_id) FROM orders LIMIT 1";

		try
		{
			// Prepare
			$statement = $this->dbConnection->prepare($query);

			// Execute
			$statement->execute();

			// fetch results
			$result = $statement->fetch();

			// return results
			return $result;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
			return false;
		}
	}

	public function createOrder($customer_id, $order_date, $ticket_quantity, $order_total)
	{
		$query = "INSERT INTO orders (customer_id, order_date, ticket_quantity, order_total)
		VALUES (:customer_id, :order_date, :ticket_quantity, :order_total)";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':customer_id', $customer_id);
			$statement->bindParam(':order_date', $order_date);
			$statement->bindParam(':ticket_quantity', $ticket_quantity);
			$statement->bindParam(':order_total', $order_total);

			// Execute query
			$statement->execute();

			return true;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getOrderInfo($order_id)
	{
		$query = "SELECT * FROM orders WHERE order_id = :order_id";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':order_id', $order_id);

			// Execute query
			$statement->execute();

			// fetch results
			$results = $statement->fetch();

			// return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	public function getCustomerOrders($customer_id)
	{
		$query = "SELECT * FROM orders WHERE customer_id = :customer_id";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':customer_id', $customer_id);

			// Execute query
			$statement->execute();

			// fetch results
			$results = $statement->fetchAll();

			// return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}

	// -------------------------------------- Search -----------------------------------
	public function search($keywords)
	{
		$query = "SELECT event_id
		from events
		WHERE event_name LIKE '%$keywords%' OR event_info LIKE '%$keywords%'";

		try
		{
			$statement = $this->dbConnection->prepare($query);

			// Bind parameters
			$statement->bindParam(':keywords', $keywords);

			// Execute query
			$statement->execute();

			// fetch results
			$results = $statement->fetchAll();

			// return results
			return $results;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
}