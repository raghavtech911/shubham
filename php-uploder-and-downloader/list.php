<style type="text/css">.right_col{ min-height: 1500px; }</style>
<?php 
session_start();
if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("location: index.php"); exit; }

require('db_connect.php');
include('header.html');
include('top_nav.php');
include('sidebar.php');


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
                    <input type="text" autocomplete="off" placeholder="Search File Name..." />
                    <div class="result" ></div>
                </div>  
               </span>
               <div class='clearfix'></div>
          </div>
          <div class='x_content'>
                  <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name of file</th>
                        <th>Size of File</th>
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
                        echo "<td>".$row['file_size']."</td>";
                        echo "<td>".$row['file_type']."</td>";
                        echo "<td><a href='send.php?name=".$nameoffile."' class='btn btn-primary btn-large'>Get URL</a></td>";
                        echo " </tr>";
                        echo "</tbody>";
                }
                 echo "</table></div></div></div>";
?>

<div class="y_content"></div>

<?php
include('footer.html');
?>

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