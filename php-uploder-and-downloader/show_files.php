<style type="text/css"> .right_col{ min-height: 3000px; } </style>
<?php
session_start();
if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("location: index.php"); exit; }

include('header.html');
include('top_nav.php');
include('sidebar.php');

$dirname = "upload/";

$images = glob($dirname."*.{jpg,gif,png}",GLOB_BRACE);
$pdfs   = glob($dirname."*.{pdf,doc,docx}",GLOB_BRACE);
$videos = glob($dirname."*.{mp4,avi,flv,wmv,mov}",GLOB_BRACE);
$audios = glob($dirname."*.{mp3,wav,mpeg4,ogg}",GLOB_BRACE);
$codes  = glob($dirname."*.{js,php,c,txt,html,css,json,xml,xhtml,py}",GLOB_BRACE);
$zips   = glob($dirname."*.{zip,rar,7z,tar,iso,tar.gz}",GLOB_BRACE);


echo '
 <div class="left_col" role="main">
<div class="">
          <div class="page-title">
            <div class="title_left">
              <h3> Media Gallery </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <div class="search-box">
                         <i class="glyphicon glyphicon-search"></i> 
                    <input type="text" autocomplete="off" placeholder=" Search File Name..." />
                    <div class="result" style="background-color: #add8e6;"></div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        
          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                 <small>Hover to Edit or Download</small> 
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
     

<div class="x_content">
		<div class="row">
            <div class="title_right">
                <div class="form-group pull-right">
                    <div class="input-group">
                        <div class="search-box">
                         
                </div>
            </div>
        <div class="clearfix"></div>';

            foreach($images as $image) 
             {
                echo '<div class="col-md-55 x-c text-center">
                        <div class="thumbnail">
                            <div class="image view view-first">   
                                <img style="width: 100%; height:100%; display: block;" src="'.$image.'" alt="image" />
                            <div class="mask">
                                        ';
                            $nameoffile= ltrim($image,"upload/");
                            
                            echo "<p>$nameoffile</p>";
                            echo "<div class='tools tools-bottom'>
                                          <a href='send.php?name=".$nameoffile."''><i class='fa fa-link'></i></a>
                                           <a href='edit_filename.php?name1=".$nameoffile."'><i class='fa fa-pencil'></i></a>
                                        </div>
                            </div></div><br>";

                            // // code to remove extension of file like .jpg but here I dont need it!!!
                            // $temp = explode('.', $image);
                            // $ext  = array_pop($temp);
                            // $nameoffile = implode('.', $temp);
                            
                            echo "<strong>$nameoffile</strong>";
                            //echo "<a href='send.php?name=".$nameoffile."' class='btn btn-primary btn-large'>Get URL</a>";
                        echo '</div>
                    </div>';
                }


            foreach($pdfs as $pdf)
                        {
                        echo '<div class="col-md-55 x-c text-center"><div class="thumbnail">
                        <div class="image view view-first">
                        <img style="width: 100%; height:100%; display: block;" src="https://image.flaticon.com/icons/svg/179/179483.svg" alt="image" />
                        <div class="mask">';
                        $nameofpdf= ltrim($pdf,"upload/");
                
                        echo "<p>$nameofpdf</p>
                        <div class='tools tools-bottom'>
                        <a href='send.php?name=".$nameofpdf."''><i class='fa fa-link'></i></a>
                         <a href='edit_filename.php?name1=".$nameofpdf."'><i class='fa fa-pencil'></i></a>
                        </div>
                        </div></div><br>
                        <strong>$nameofpdf</strong>
                        </div>
                        </div>";
                }


            foreach($videos as $video)
                {
                    echo '<div class="col-md-55 x-c text-center"><div class="thumbnail">
                    <div class="image view view-first">
                    <video width="100%"><source src="'.$video.'" type="video/mp4"></video>
                    <img style="width:40px; height:40px; display: block; position: relative; top: -99px; left: 11px;" src="http://icons.iconarchive.com/icons/marcus-roberto/google-play/512/Google-Play-Movies-icon.png" alt="image" />
                    <div class="mask">';
                    $nameofvideo= ltrim($video,"upload/");
                
                    echo "<p>$nameofvideo</p>
                    <div class='tools tools-bottom'>
                        <a href='send.php?name=".$nameofvideo."''><i class='fa fa-link'></i></a>
                         <a href='edit_filename.php?name1=".$nameofvideo."'><i class='fa fa-pencil'></i></a>
                    </div></div></div><br>
                   <strong>$nameofvideo</strong></div></div>";
                }

                
            foreach($audios as $audio)
                {
                    echo '<div class="col-md-55 x-c text-center"><div class="thumbnail">
                    <div class="image view view-first">
                    
                     <img style="width: 85%; height:100%; display: block; padding-left: 20%;" src="https://cdn2.iconfinder.com/data/icons/ios7-inspired-mac-icon-set/1024/itunes_5122x.png" alt="image" /><div class="mask">';
                   
                    $nameofaudio= ltrim($audio,"upload/");

                    echo "<p>$nameofaudio</p>
                        <div class='tools tools-bottom'>
                            <a href='send.php?name=".$nameofaudio."''><i class='fa fa-link'></i></a>
                             <a href='edit_filename.php?name1=".$nameofaudio."'><i class='fa fa-pencil'></i></a>
                        </div> </div></div><br>
                      <strong>  $nameofaudio </strong></div></div>";
                }

            foreach($codes as $code) 
                {
                    if($code != 'upload/download.php'){
                        echo '<div class="col-md-55 x-c text-center"><div class="thumbnail">
                     <div class="image view view-first">  <img style="width: 85%; height:100%; display: block; padding-left: 20%;" src="Thehoth-Seo-Seo-web-code.ico" alt="image" />';
                    //show_source($code);
                    echo '<div class="mask">';
                    $nameofcode= ltrim($code,"upload/");

                        echo "<p>$nameofcode</p>
                        <div class='tools tools-bottom'>
                            <a href='send.php?name=".$nameofcode."''><i class='fa fa-link'></i></a>
                             <a href='edit_filename.php?name1=".$nameofcode."'><i class='fa fa-pencil'></i></a>
                        </div></div></div><br>";
                        echo "<strong>$nameofcode</strong> </div></div>";
                    }
                } 


                 foreach($zips as $zip)
                 {
                         echo '<div class="col-md-55 x-c text-center">
                        <div class="thumbnail">
                            <div class="image view view-first">   
                                <img style="width: 85%; height:100%; display: block; padding-left: 20%;" src="https://maxcdn.icons8.com/Share/icon/color/Files//zip1600.png" alt="image" />
                            <div class="mask">
                                        ';
                            $nameofzip= ltrim($zip,"upload/");
                            
                            echo "<p>$nameofzip</p>";
                            echo "<div class='tools tools-bottom'>
                                          <a href='send.php?name=".$nameofzip."''><i class='fa fa-link'></i></a>
                                           <a href='edit_filename.php?name1=".$nameofzip."'><i class='fa fa-pencil'></i></a>
                                        </div>
                            </div></div><br>";

                            
                            echo "<strong>$nameofzip</strong>";
                        echo '</div>
                    </div>';
                 } 

echo "<div class='aaa'></div>";  


include('footer.html');
?>


<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val(); 
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.post("backend-search-for-gallary.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
                $('.x-c').fadeOut();
                $(".aa").fadeOut();
            });
        } else{
            resultDropdown.empty();
            $('.x-c').fadeIn();
            $(".aa").fadeOut();
        }
    });

    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        var i = $('.search-box input[type="text"]').val();
         
        $.post("ajaxforgallary.php", {shubh: i}).done(function(data){
            $(".aa").fadeIn();
            $('.aaa').html(data)
        });
        $(this).parent(".result").empty();
    });
});
</script>