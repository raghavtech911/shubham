<!DOCTYPE html>
<html>
<head>
	<title>Upload CSV</title>
</head>
<body>
	<form enctype="multipart/form-data" action="" method="POST">
    	<input name="csvupload" type="file" accept=".csv"><br><br>
     	<input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>

<?php
// error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING & ~E_STRICT);
// mysqli_connect('localhost', 'root', '');
// mysqli_select_db("csv_db") or die(mysqli_error());


$con = mysqli_connect("localhost","root","","csv_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if (isset($_FILES['csvupload'])) {
    $errors = array();
    // $allowed_ext = array('.csv');

    $file_name = $_FILES['csvupload']['name'];
    #echo $file_name;
    $aa = explode('.', $file_name);
    $file_ext = strtolower(end($aa));
    #cho $file_ext;
    $file_size = $_FILES['csvupload']['size'];
    #echo $file_size;
    $file_tmp = $_FILES['csvupload']['tmp_name'];
    echo "temp name is: ".$file_tmp;

     // if (in_array($allowed_ext) === false) {
     //     $errors[] = 'Extension not allowed';
     // }
     if ($file_size > 10485760) {
         $errors[] = 'File size must be under 10mb';
     }
     if (empty($errors)) {
 
        $handle = fopen($file_tmp, "r");  #open file to read only

         //while (!feof($handle)) { #test for end of pointer
     		//$value = (fgetcsv($handle, 0, ','));
//     		if ($i > 0) {
//         		if ($value[0] != '') {


			 while(($fileop = fgetcsv($handle,",")) !== false) 
        {
        	$companycode =  mysqli_real_escape_string($fileop[0]);
        	echo $companycode;
             		// $inserts[] = "('" . mysqli_real_escape_string($value[0]) . "','"
               //       . mysqli_real_escape_string($value["1"]) . "','"
               //       . mysqli_real_escape_string($value["2"]) . "','"
               //       . mysqli_real_escape_string($value["3"]) . "','"
               //       . mysqli_real_escape_string($value["4"]) . "','"
               //       . mysqli_real_escape_string($value["5"]) . "','"
               //       . mysqli_real_escape_string($value["6"]) . "','"
               //       . mysqli_real_escape_string($value["7"]) . "','"
               //       . mysqli_real_escape_string($value["8"]) . "',')";
         		}
         		//print_r($inserts);
  //   		} elseif ($i == 0) {
    //     		$fields = $value;
   //  	}
//     $i++;
 }

// $con->mysqli_query("INSERT INTO csv_info (task_id, user_id, user_name, client, project, type, task, day, date, time, status) VALUES " . implode(",", $inserts));
//         fclose($handle);
//         if ($sq1) {
//             echo 'successfully updated.!';
//         }
//     }
}
?>
