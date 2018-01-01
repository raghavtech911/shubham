<?php 

?>

<!--____________________________ html form for login ___________________________________-->
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>login form</title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div>
 <div class="container">
      <div id="login">
        <form method="post" action="">
          <fieldset class="clearfix">
            <p><span class="fontawesome-user"></span><input style="color: white;" type="text" placeholder="Username" required></p> 
            <p><span class="fontawesome-lock"></span><input style="color: white;" type="password" placeholder="Password" required></p>
            <p><input type="submit" value="Log In"></p>
          </fieldset>
        </form>
      </div> <!-- end login -->
    </div>
  
</body>
</html>
