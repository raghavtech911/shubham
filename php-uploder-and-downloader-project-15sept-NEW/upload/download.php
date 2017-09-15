<?php
session_start();
// Set the maximum number of downloads (actually, the number of page loads)
$maxdownloads = "2";
// Set the key's viable duration in seconds (86400 seconds = 24 hours)
$maxtime = "86400";

require ('db_connect.php');

$nameoffile = $_SESSION['varname'];

//$nameoffile=$_GET["name"];

	if(get_magic_quotes_gpc()) {
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
			echo "This key has expired (exceeded time allotted).<br />";
		}else{
			$downloads = $row['downloads'];
			$downloads += 1;
			if ($downloads > $maxdownloads) {
				echo "This key has expired (exceeded allowed downloads).<br />";
			}else{
				$sql = sprintf("UPDATE download SET downloads = '".$downloads."' WHERE uniqueid= '%s'",
	mysqli_real_escape_string($conn, $id));
				$incrementdownloads = $conn->query($sql);
				
// Debug		echo "Key validated.";

// Force the browser to start the download automatically

/*
	Variables: 
		$file = real name of actual download file on the server
		$filename = new name of local download file - this is what the visitor's file will actually be called when he/she saves it
*/

   ob_start();
   $mm_type="application/octet-stream";
   //$file = "shubh.jpg";
   $file = $nameoffile;
   $filename = $nameoffile;
 
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