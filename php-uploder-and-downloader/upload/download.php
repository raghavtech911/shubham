<?php
session_start();
require ('../db_connect.php');

$maxdownloads = "1"; // download for one time only
$maxtime = "86400"; // 6 hours = 86400 sec
$nameoffile = $_SESSION['varname'];

	if(get_magic_quotes_gpc()) {  //  get_magic_quotes_gpc()--->  for protection from sql injection
        $id = stripslashes($_GET['id']);
	}else{
		$id = $_GET['id'];
	}

	// Get the key, timestamp, and number of downloads from the database
	$query = sprintf("SELECT * FROM download WHERE uniqueid= '%s'", mysqli_real_escape_string($conn, $id));
	$result = $conn->query($query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	if (!$row) { 
		echo "The download key you are using is invalid.";
	}else{
		$timecheck = date('U') - $row['timestamp'];
		
		if ($timecheck >= $maxtime) {
			echo "This key has expired (Time Allowed is 6 Hours).<br>";
		}else{
			$downloads = $row['downloads'];
			$downloads += 1;
			if ($downloads > $maxdownloads) {
				echo "This key has expired (Only One Download Allowed).<br><br>
					<a href='../upload.php'>Go Back</a>";
			}else{
				$sql = sprintf("UPDATE download SET downloads = '".$downloads."' WHERE uniqueid= '%s'",mysqli_real_escape_string($conn, $id));
				$incrementdownloads = $conn->query($sql);
	
	//force browser to download file
   ob_start();
   $mm_type="application/octet-stream";
   
   $file = $nameoffile;
   $filename = "new-"."$nameoffile";
 
   header("Cache-Control: public, must-revalidate");
   header("Pragma: no-cache");
   header("Content-Type: " . $mm_type);
   header("Content-Length: " .(string)(filesize($file)) );
   header('Content-Disposition: attachment; filename="'.$filename.'"');
   header("Content-Transfer-Encoding: binary\n");
 
   ob_end_clean();
   readfile($file);

			}
		}
	}
?>