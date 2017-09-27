<style type="text/css">.right_col{ min-height: 1500px; }</style>

<?php 
session_start();
if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("location: index.php"); exit; }

require('db_connect.php');
include('header.html');
include('top_nav.php');
include('sidebar.php');

if(isset($_POST['button']))
{	
	// to make sure some file is selected
	if($_FILES['files'] > 0 && !empty($_FILES['files']['name']['0']) )
	{
	
		$errors= array();

		// access the files form array
		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
		{
			$file_name = $_FILES['files']['name'][$key];
			$file_size = $_FILES['files']['size'][$key];
			$file_tmp  = $_FILES['files']['tmp_name'][$key];
			$file_type = $_FILES['files']['type'][$key];

			if($file_size > 10000000)
			{
				$errors[]='File must be less than 10MB';
        echo "<h3><span class='label label-danger'>File must be less than 10MB </span></h3>";
			}

			// To check file name already avilable in DB
			$sql = "SELECT file_name FROM insert_data";
    		$auth = $conn->query($sql);
    		if ($auth->num_rows > 0)
    		{	
    			while ($roww = $auth->fetch_assoc())
    			{
            		if ($roww['file_name'] == $file_name)
            		{
                		$errors[] = "error";
                		echo "<h3><span class='label label-warning'>".$file_name." Already Available</span></h3>";
     			    }
        		}
    		}

			$query="INSERT into insert_data(file_name,file_size,file_type) VALUES ('$file_name','$file_size','$file_type')";  
			$desired_dir="upload";
		
			// Create directory if it does not exist
			if(empty($errors)==true)
			{
				if(is_dir($desired_dir)==false)
				{
				mkdir("$desired_dir", 0777);
				}

				if(is_dir("$desired_dir/".$file_name)==false)
				{
				move_uploaded_file($file_tmp,"upload/".$file_name);
				}else{
				//rename the file if another one exist
					$new_dir="upload/".$file_name.time();
					rename($file_tmp,$new_dir) ;
				}

				$conn->query($query); // run sql query
			}else{
					//print_r($errors);
			}
		}

		if(empty($errors))
		{
			echo "<h3><span class='label label-success'>".$file_name." Uploded !!!</span></h3>";
		}

	}else{
		$errors[]='1';
		echo "<h3><span class='label label-info'>Please Select File to Upload</span></h3>";
	}
}
?>

<div class="container-fluid">
	 <div class="row">
			<div class="col-md-3">
         <form action="" method="post" enctype="multipart/form-data">
                  <h2><span class='label label-info'>Upload Files Form Here:</span></h2><br>
                  </div>
			<div class="col-md-3 text-right">
				<input style="margin-top: 10px;" type="file" name="files[]" multiple="">
			</div>
			<div class="col-md-3 text-left">
				<button style="margin-top: 6px;" name="button" class="btn btn-primary btn-large source"> Upload! </button>
			</form>
			</div>
                  <div class="col-md-3">
		</div>
	</div>
</div>         


<?php
$sql = "SELECT * FROM insert_data";
$result = $conn->query($sql);
     if (!$result)
     {
         printf("Error: %s\n", mysqli_error($conn));
         exit();
     }

?>

<div class='col-md-12 col-sm-12 col-xs-12'>
     <div class='x_panel'>
          <div class='x_title'>
               <h2>List of Files <small>Hover over the rows</small></h2>
               <span class='nav navbar-right'>
                     <div class="search-box">
                     <i class="glyphicon glyphicon-search"></i> 
                    <input type="text" autocomplete="off" placeholder=" Search File Name..." />
                    <div class="result" ></div>
                </div>  
               </span>
               <div class='clearfix'></div>
          </div>
          <div class='x_content table-responsive'>
                  <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name of file</th>
                        <th>Edit</th>
                        <th>Size <small>(bytes)</small></th>
                        <th>Type of File</th>
                        <th>Get File</th>
                      </tr>
                    </thead>
<?php
       while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                    {
                      $nameoffile =$row['file_name'];
                  
                        echo "<tbody>";
                        echo "<tr>";
                        echo "<th scope='row'>".$row['file_id']."</th>";
                        echo "<td>".$row['file_name']." </td>";
                        echo "<th id='edit' scope='row'> <a href='edit_filename.php?name1=".$nameoffile."'>Edit</a></th>";
                        echo "<td>".$row['file_size']."</td>";
                        echo "<td>".$row['file_type']."</td>";
                        echo "<td><a href='send.php?name=".$nameoffile."' class='btn btn-info'>Get URL</a></td>";
                        echo " </tr>";
                        echo "</tbody>";
                }
                 echo "</table></div></div></div>";
?>

<div class="y_content"></div>


<?php
include('footer.html');
?>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <!-- PNotify -->
  <script type="text/javascript" src="js/notify/pnotify.core.js"></script>
  <script type="text/javascript" src="js/notify/pnotify.buttons.js"></script>
  <script type="text/javascript" src="js/notify/pnotify.nonblock.js"></script>

<script type="text/javascript">
$(document).ready(function(){

    $('.search-box input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        var ii = $(".y_content");
        if(inputVal.length){
            $.post("backend-search.php", {term: inputVal}).done(function(data){
                //resultDropdown.html(data);
                $('.x_content').fadeOut();
                    ii.show();
                    ii.html(data);
            });
        } else{
            resultDropdown.empty();
            $('.x_content').fadeIn();
                ii.hide();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>


<script>
    $(function() {
      var cnt = 10; //$("#custom_notifications ul.notifications li").length + 1;
      TabbedNotification = function(options) {
        var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title +
          "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

        if (document.getElementById('custom_notifications') == null) {
          alert('doesnt exists');
        } else {
          $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
          $('#custom_notifications #notif-group').append(message);
          cnt++;
          CustomTabs(options);
        }
      }

      CustomTabs = function(options) {
        $('.tabbed_notifications > div').hide();
        $('.tabbed_notifications > div:first-of-type').show();
        $('#custom_notifications').removeClass('dsp_none');
        $('.notifications a').click(function(e) {
          e.preventDefault();
          var $this = $(this),
            tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
            others = $this.closest('li').siblings().children('a'),
            target = $this.attr('href');
          others.removeClass('active');
          $this.addClass('active');
          $(tabbed_notifications).children('div').hide();
          $(target).show();
        });
      }

      CustomTabs();

      var tabid = idname = '';
      $(document).on('click', '.notification_close', function(e) {
        idname = $(this).parent().parent().attr("id");
        tabid = idname.substr(-2);
        $('#ntf' + tabid).remove();
        $('#ntlink' + tabid).parent().remove();
        $('.notifications a').first().addClass('active');
        $('#notif-group div').first().css('display', 'block');
      });
    })
  </script>

  
