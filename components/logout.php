<?php
	$admin = null;
	session_start();
	
	
	foreach($_SESSION as $key => $val)
	{

		if ($key !== 'admin')
		{

			unset($_SESSION[$key]);

		}

	}

	header('location: ../home.php')
?>