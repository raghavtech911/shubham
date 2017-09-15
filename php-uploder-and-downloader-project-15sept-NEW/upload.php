<?php 
session_start();
include('db_connect.php');
include('header.html');
include('top_nav.php');
include('sidebar.php');

if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("location: index.php"); exit; }
//if (isset($_SESSION['usr'])) { echo "<h2> Hi {$_SESSION['usr']} </h2>"; } else { header('location: index.php'); }

if(isset($_FILES['files'])){ // to make sure some file is selected
	
	$errors= array();

	// access the files form array
		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
			$file_name = $key.$_FILES['files']['name'][$key];
			$file_size = $_FILES['files']['size'][$key];
			$file_tmp  = $_FILES['files']['tmp_name'][$key];
			$file_type = $_FILES['files']['type'][$key];

			if($file_size > 10000000){
				$errors[]='File must be less than 10MB';
				}

$query="INSERT into insert_data(file_name,file_size,file_type) VALUES ('$file_name','$file_size','$file_type')";
	
	$desired_dir="upload";
		
		// Create directory if it does not exist
		if(empty($errors)==true){
			if(is_dir($desired_dir)==false){
				mkdir("$desired_dir", 0777);
				}

			if(is_dir("$desired_dir/".$file_name)==false){
				move_uploaded_file($file_tmp,"upload/".$file_name);
				}else{
				//rename the file if another one exist
					$new_dir="upload/".$file_name.time();
					rename($file_tmp,$new_dir) ;
				}

				$conn->query($query); // run sql query
				}else{
					print_r($errors);
				}
			}

		if(empty($error)){
			echo "Success";
			}
}
?>

<div class="container-fluid">
	 <div class="row">
 		<div class="col-md-12">
			<form action="" method="POST" enctype="multipart/form-data">
			<h2>Upload Files Form Here:</h2><br>
				<input type="file" name="files[]" multiple=""><br>
				<button class="btn btn-primary btn-large"> Upload! </button>
			</form>
		</div>
	</div>
</div>

 





      <!--     <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Dropzone multiple file uploader</h2>
                 
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <p>Drag multiple files to the box below for multi upload or click to select files. This is for demonstration purposes only, the files are not uploaded to any server.</p>
                  <form action="upload.php" class="dropzone" method="POST" enctype="multipart/form-data" style="border: 1px solid #e5e5e5; height: 300px; "></form>

                  <br />
                  <br />
                  <br />
                  <br />
                </div>
              </div>
            </div>
          </div>
        </div> -->


             
<?php
include('footer.html');
?>

