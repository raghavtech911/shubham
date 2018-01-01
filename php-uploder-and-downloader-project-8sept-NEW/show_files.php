<?php
session_start();
include('header.html');
include('top_nav.php');
include('sidebar.php');

$dirname = "upload/";

// // To show images
// $images = glob($dirname."*.{jpg,gif,png}",GLOB_BRACE);
// foreach($images as $image) {
//     echo '<img src="'.$image.'">';
// }

$images = glob($dirname."*.{jpg,gif,png}",GLOB_BRACE);
echo '<div class="x_content">
		<div class="row">
			<p>Media gallery design emelents</p>';
   
   foreach($images as $image) 
    {
  echo '<div class="col-md-55">
            <div class="thumbnail">
                <div class="image view view-first">   
                    <img style="width: 100%; display: block;" src="'.$image.'" alt="image" />
                </div>
            </div>
        </div>';
    }
    
    echo '</div>
          </div>';


// // To show videos
// $videos = glob($dirname."*.mp4");
// foreach($videos as $video) {
// echo '<video width="400" controls>';
// echo '<source src="'.$video.'" type="video/mp4">';
// echo '</video>';
// }

// // To show Audio
// $audios = glob($dirname."*.mp3");
// foreach($audios as $audio)
// {
// echo '<audio controls>';
// echo '<source src="'.$audio.'" type="audio/mpeg">';
// echo '</audio>';
// }


include('footer.html');
?>

