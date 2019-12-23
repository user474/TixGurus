<?php
include_once "model/DBModel.php";


class MainController
{
	public function invoke()
	{
		// check if URL has any parameters, if not redirect to home page, otherwise send to correct page
		if(isset($_GET['page']))
		{
			$pageName = $_GET['page'];
			$this->loadPage($pageName);
		}
		elseif(!isset($_GET['page']))
		{
			$this->loadPage('home');
		}
	}


	public function loadPage($pageName)
	{
		// Look for a file name that matches the $pageName, if found, include that page. if not found, redirect to the home page.

		$filePath = "view/" . $pageName . ".php";

		if(file_exists($filePath))
		{
			// Page header
			include "view/include/header.php";

			// Content
			include $filePath;

			// Get the URL value for 'action'
			if(isset($_GET['action']))
			{
				$actionFile = $_SERVER['DOCUMENT_ROOT'] . "/view/" . $_GET['action'] . ".php";

				if(file_exists($actionFile))
				{
					include $actionFile;
				}
				else
				{
					echo "The File <strong>" . $actionFile . "</strong> does not exist.<br>";
				}
			}

			// Do not load the footer for the admin dashboard, load blank footer
			if((isset($_GET['page']) && $_GET['page'] != 'admindash') || !isset($_GET['page']))
			{
				// Footer
				include "view/include/footer.php";
			}
			else
			{
				// blank footer
				include "view/include/blankfooter.php";
			}
		}
		else // Load an error page
		{
			// Page header
			include "view/include/header.php";

			// Content
			include "view/notfound.php";

			// Footer
			include "view/include/footer.php";
		}
	}
}