<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/pdf/MySQL_Report_Class.php';

// find first day and last day of the current week
$monday = strtotime("last monday");
$monday = date('w', $monday) == date('w') ? $monday+7*86400 : $monday;
$sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
$this_week_sd = date("Y-m-d", $monday);
$this_week_ed = date("Y-m-d" ,$sunday);

// find the first day and last day of the month
$firstDayOfMonth = date('Y-m-01');
$lastDayOfMonth = date('Y-m-30');

// find the first day and last day of the year
$firstDayOfYear = date('Y-01-01');
$lastDayOfYear = date('Y-12-30');

// Portrait mode, A4 page size
$pdf = new MySQL_Report_Class('P','pt','A4');
$pdf->SetFont('Arial','',14);

// Database settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tixgurus';

// connect to database
$pdf->connect($host, $username, $password, $database);

// attributes for the page title
$attr = array('titleFontSize'=>18, 'titleText'=>'TixGurus Sales Report');



// Top 5 weekly events
$attr = array('titleFontSize'=>18, 'titleText'=>'Top 5 Weekly Events');
$sql_statement = "SELECT events.event_name as `Event`, count(tickets.event_id) as `Tickets Sold` FROM tickets, events, orders WHERE events.event_id = tickets.event_id AND tickets.order_id = orders.order_id AND order_date BETWEEN '$this_week_sd' AND '$this_week_ed' GROUP BY tickets.event_id ORDER BY COUNT(tickets.event_id) DESC LIMIT 5";
$pdf->mysql_report($sql_statement, false, $attr);

// Top 5 monthly events
$attr = array('titleFontSize'=>18, 'titleText'=>'Top 5 Monthly Events');
$sql_statement = "SELECT events.event_name as `Event`, count(tickets.event_id) as `Tickets Sold` FROM tickets, events, orders WHERE events.event_id = tickets.event_id AND tickets.order_id = orders.order_id AND order_date BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth' GROUP BY tickets.event_id ORDER BY COUNT(tickets.event_id) DESC LIMIT 5";
$pdf->mysql_report($sql_statement, false, $attr);


// Top 10 yearly events
$attr = array('titleFontSize'=>18, 'titleText'=>'Top 10 Yearly Events');
$sql_statement = "SELECT events.event_name as `Event`, count(tickets.event_id) as `Tickets Sold` FROM tickets, events, orders WHERE events.event_id = tickets.event_id AND tickets.order_id = orders.order_id AND order_date BETWEEN '$firstDayOfYear' AND '$lastDayOfYear' GROUP BY tickets.event_id ORDER BY COUNT(tickets.event_id) DESC LIMIT 5";
$pdf->mysql_report($sql_statement, false, $attr);


// Event Statistics
$attr = array('titleFontSize'=>18, 'titleText'=>'Event Statistics');
$sql_statement = "SELECT event_name as `Event`, COUNT(*) as 'Tickets Sold'
FROM tickets
JOIN events ON tickets.event_id = events.event_id
GROUP BY event_name
ORDER BY COUNT(*) DESC";
$pdf->mysql_report($sql_statement, false, $attr);


// Event Planners
$attr = array('titleFontSize'=>18, 'titleText'=>'Event Planners');
$sql_statement = "SELECT company_name as `Planner`, count(*) AS 'Events Hosted'
FROM events
JOIN planners ON events.planner_id = planners.planner_id
GROUP BY company_name
ORDER BY COUNT(*) DESC";
$pdf->mysql_report($sql_statement, false, $attr);


$pdf->Output();
