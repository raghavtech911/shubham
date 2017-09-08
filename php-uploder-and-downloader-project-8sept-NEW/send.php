<?php
session_start();
include("db_connect.php");
include("header.html");
include('top_nav.php');
include("sidebar.php");

$sql = "SELECT * FROM insert_data";
$result = $conn->query($sql);

if(!$result)
{
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $filename = $_POST["filename_select"];
    $filepath = "upload/".$filename;
    $sql = "INSERT INTO send_data (user_email,file_name) VALUES ('$email','$filename')";
    if($conn->query($sql)){
        echo "done!!!";
    }

}


?>


<div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Send File </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form id="demo-form2" action="" method="POST" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>


                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="filename_select">Select File
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="filename_select">
                          <?php  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ ?>
                            <option  value="<?php echo $row['file_name']; ?>">  <?php echo $row['file_name']; ?>  </option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">URL
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="url" name="url" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
                        <a href="list.php" class="btn btn-primary">Cancel</a>
                        <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                        <!-- <a href="#" name="submit" class="btn btn-primary">Submit</a> -->
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>	




<?php
include("footer.html");
?>

