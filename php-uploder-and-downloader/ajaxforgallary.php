<style type="text/css">.right_col{ min-height: 3000px; }</style>
<div class="aa">
<?php
    //error_reporting(0);
    error_reporting(E_ALL & ~E_NOTICE); /// show all errors except notices

    $name = $_REQUEST['shubh'];
    echo '
    		<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
          	<div class="col-md-3 col-sm-3 col-xs-12"></div>
          	<div class="col-md-6 col-sm-6 col-xs-12">  ';
  
  $pics  = array('gif', 'png', 'jpg'); 
  $pdfs  = array('pdf','doc','docx');
  $vids  = array('mp4','avi','flv','wmv','mov');
  $auds  = array('mp3','wav','mpeg4','ogg');
  $codes = array('js','php','cpp','c','txt','html','css','zip','json','xml','xhtml','py','rar','7z','tar.gz','iso','tar');


if(in_array(end(explode('.',$name)), $pics))
    {
        echo "<a href='send.php?name=".$name."' class='btn btn-primary btn-large'>Get URL</a>";
        echo '<img src="upload/'.$name.'" border=0 height="250" width="360">';
        echo "<br><br>";
    	echo " </div> </div> </div>";	
    }else {
        if(in_array(end(explode('.',$name)), $pdfs))
            {
                echo "<a href='send.php?name=".$name."' class='btn btn-primary btn-large'>Get URL</a>";
                echo '<iframe style="width:100%; height:100%; display: block;" src="upload/'.$name.'"></iframe>';
                echo "<br><br>";
                echo " </div> </div> </div>";
            }else {
                if(in_array(end(explode('.',$name)), $vids))
                    {
                        echo "<a href='send.php?name=".$name."' class='btn btn-primary btn-large'>Get URL</a>";
                        echo '<video controls width="100%"><source src="upload/'.$name.'" type="video/mp4"></video>';
                        echo "<br><br>";
                        echo " </div> </div> </div>";   
                    }else {
                        if(in_array(end(explode('.',$name)), $auds))
                            {
                                echo "<a href='send.php?name=".$name."' class='btn btn-primary btn-large'>Get URL</a>";
                                echo '<audio controls width="100%" height="100%">
                                    <source src="upload/'.$name.'" type="audio/mpeg">
                                    </audio>';
                                echo "<br><br>";
                                echo " </div> </div> </div>";   
                            }else {
                                    if(in_array(end(explode('.',$name)), $codes))
                                        {
                                            echo "<a href='send.php?name=".$name."' class='btn btn-primary btn-large'>Get URL</a>";
                                            show_source('upload/'.$name);
                                            echo "<br><br>";
                                            echo " </div> </div> </div>";
                                        } 
                                    
                                  }    
                         }
                 }
         }

?>
</div>