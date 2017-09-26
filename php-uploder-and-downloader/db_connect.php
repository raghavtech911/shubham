<?php

// constants for E-mail 
define('smtphost', 'smtp.gmail.com');  						//smtp-host
define('mailusername', 'shubham.kale@techinfini.com');		// uour host username
define('mailpassword', 'TechAdmin128');              		//your host password
define('portnumber', '587');								//your host port number
define('emailfrom', 'shubham.kale@techinfini.com');			// sent form in email header
define('from', 'Techinfini'); 								// sent form in email header

$conn = new mysqli("localhost", "root", "", "php_download");

?>