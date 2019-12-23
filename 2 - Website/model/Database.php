<?php

class Database
{
    private $file;
    private $dbSettings;
    private $connection;

    public function __construct()
    {
		// Database connection settings are stored in this file:
        $this->file = $_SERVER['DOCUMENT_ROOT'] . '/config/dbSettings.ini';

        // Read settings from file and store in $dbSettings array
        $this->dbSettings = parse_ini_file($this->file, false);

	}

	public function connect()
	{
		try
        {
			// Connect to database
			$this->connection = new PDO(
				"{$this->dbSettings['driver']}:
				host={$this->dbSettings['host']};
				dbname={$this->dbSettings['database']}",
				$this->dbSettings['username'],
				$this->dbSettings['password'],
				[
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_EMULATE_PREPARES => false,
				]);

				return $this->connection;
        }

        catch (PDOException $ex)
        {
			// Display error message if connection failed
			echo 'Connection Failed: ' . $ex->getMessage();
        }
	}


    // Close database connection
    public function closeConnection()
    {
        try
        {
            $this->connection = null;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
	}

	public function __destruct()
	{
		$this->closeConnection();
	}
}

