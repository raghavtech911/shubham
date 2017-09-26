<style type="text/css">.right_col{ min-height: 500px; }</style>
<?php
session_start();
error_reporting(1);
if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("location: index.php"); exit; }

require('db_connect.php');
include('header.html');
include('top_nav.php');
include('sidebar.php');

$filename=$_GET["name1"];

if(isset($_POST['save']))
{
	$newfilename = $_POST["newname"];
	$flag = 0;

	$sql = "SELECT file_name FROM insert_data";
	$auth = $conn->query($sql);
	if ($auth->num_rows > 0)
     		{	
     			while ($row = $auth->fetch_assoc())
     			{
     				if ($row['file_name'] == $newfilename){
     					$errors[] = "error";
                 		echo "<h3><span class='label label-warning'>".$newfilename." is Alredy Available, Select Another Name</span></h3>";
     				}else{
     					$flag = 1;
     					
     				}
     			}
     		}
     		if($flag==1){
     			$sql1 = sprintf("UPDATE insert_data SET file_name='%s' WHERE file_name = '%s' ", $newfilename, $filename);
     			$conn->query($sql1);
     			rename('upload/'.$filename,'upload/'.$newfilename) ;
     			echo "<h3><span class='label label-success'>".$newfilename." is Saved As New Name</span></h3>";
     			//echo '<script>  document.getElementById("newname").value = "hieee";  </script>';
     		}	
          
}

if(isset($_POST['delete']))
{
	$sql2 = sprintf("DELETE FROM insert_data WHERE file_name='%s'", $filename);
    $conn->query($sql2);
    	if(unlink("upload/".$filename)){	
	echo "<h3><span class='label label-success'>".$filename." is Deleted !!!</span></h3>";
	echo '<script> window.location.href = "upload.php"; </script>';
	}else{
		echo "<h3><span class='label label-warning'>No such File in Directory</span></h3>";
	}

}
?>

<div class="col-md-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Edit File Name <small>or Delete it !</small></h2>
            <div class="clearfix"></div>
            </div>

			<div class="x_content">
				<br />
				<form class="form-horizontal form-label-left" action="" method="post">
					<div class="form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12">File name</label>
			                <div class="col-md-9 col-sm-9 col-xs-12">
			                    <input type="text" id="newname" name="newname" class="form-control" value="<?php echo $filename; ?>">
			                </div>
			        </div>

			        <div class="form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
			                <div class="col-md-9 col-sm-9 col-xs-12">
			                    <button type="submit" name="save" class="btn btn-success"> Save Name</button>
			                    <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i> Delete File</button>
			                    <button formaction="upload.php" class="btn btn-info">Show Files</button>
			                 </div>
			        </div>

				</form>
 			</div>  
 		</div>
 	</div>
</div>

<?php
include('footer.html');
?>