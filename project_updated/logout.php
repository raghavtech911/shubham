<?php
session_start();
		
if (!isset($_SESSION['usr'])) {
	header("Location: index.php");	
} else if(isset($_SESSION['user'])!="") {
	header("Location: register-page.php");
}
					if (isset($_GET['logout'])) {		
				unset($_SESSION['usr']);		
				session_unset();	
					session_destroy();		
					header("Location: index.php");
							exit;	
						}
						?>