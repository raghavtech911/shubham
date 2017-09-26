<?php
session_start();
//if(isset($_SESSION['usr'])!="") { } else{ session_unset();  session_destroy();  header("location: index.php"); exit; }
require ('db_connect.php');
include ("header.html");
include ('top_nav.php');
include ("sidebar.php");
require 'PHPMailer/PHPMailerAutoload.php';

//get file name form upload.php
$filename=$_GET["name"];

//send it to download.php
$_SESSION['varname'] = $filename;

// //old code
//  $sql = "SELECT * FROM insert_data";
//  $result = $conn->query($sql);

//  if(!$result)
//  {
//      printf("Error: %s\n", mysqli_error($conn));
//      exit();
//  }


    if(empty($_SERVER['REQUEST_URI'])) {
        $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
    }
    // $_SERVER['REQUEST_URI']  ---->  /shubham/php-uploder-and-downloader-project-7sept-NEW/send.php?name=0cc_795.jpg


    $url = preg_replace('/\?.*$/', '', $_SERVER['REQUEST_URI']);
    //  $url ----> /shubham/php-uploder-and-downloader-project-7sept-NEW/send.php


    $folderpath = 'http://'.$_SERVER['HTTP_HOST'].'/'.ltrim(dirname($url), '/').'/upload'.'/';
    // dirname($url) ----> /shubham/php-uploder-and-downloader-project-7sept-NEW
    // $folderpath  ----> http://localhost/shubham/php-uploder-and-downloader-project-7sept-NEW/upload/

    $key = uniqid(md5(rand()));
    
    $time = date('U');
    
     $registerid = "INSERT INTO download (uniqueid,timestamp,filename) VALUES(\"$key\",\"$time\",\"$filename\")";
   // $registerid = "INSERT INTO download (uniqueid,timestamp,filename) VALUES('$key','$time','$filename')";
    $result = $conn->query($registerid);


    if(isset($_POST["submit"])){
	    $filelink= $folderpath.'download.php?id='.$key;
        $email = $_POST["email"];
        $sql = sprintf("UPDATE download SET user_email='%s' WHERE uniqueid='%s' ",$email,$key);
     
     if($conn->query($sql)){

            //$linkto = '<button formaction="'.$folderpath.'download.php?id='.$key">Download</button>';
            $linkto = $folderpath .'download.php?id='. $key;

            $mail = new PHPMailer;            
            $mail->isSMTP();                                   // Set mailer to use SMTP
            $mail->Host = smtphost;                    // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                            // Enable SMTP authentication
            $mail->Username = mailusername;          // SMTP username
            $mail->Password = mailpassword; // SMTP password
            $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
            $mail->Port = portnumber;                                 // TCP port to connect to

            $mail->setFrom(emailfrom, from);
            $mail->addReplyTo(emailfrom, from);
            $mail->addAddress($email);   // Add a recipient
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            $mail->isHTML(true);  // Set email format to HTML

            $bodyContent = '<h1>This is the Generated link.</h1>';
            $bodyContent .= '<a href="'.$linkto.'">download</a>';
            $bodyContent .= '<p>This is the Email sent from localhost using PHP script by <b>Techinfini</b></p>';

            $mail->Subject = 'Email from Shubham with file link';
            $mail->Body    = $bodyContent;

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo '<h3><span class="label label-success">Message has been sent</span></h3>';
            }
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Download File
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- <input type="text" id="url" name="url" class="form-control col-md-7 col-xs-12"> -->
                     <!-- <p><span >'. $folderpath . 'download.php?id='. $key . '</span></p> -->
                      
                      <!-- <a href="<?php //echo $folderpath .'download.php?id='. $key ?>">Click to open</a> -->
                      <button formaction="<?php echo $folderpath .'download.php?id='. $key ?>">Download</button>

                    </div>
                    </div>

                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email, <small>to get file link</small>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="email" name="email" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <!-- <a href="#" name="submit" class="btn btn-primary">Submit</a> -->
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                          <a href="upload.php" class="btn btn-primary">Cancel</a>
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

