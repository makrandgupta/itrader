<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
<title>Login</title>
<!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
	  <style type="text/css">
      /* This fixed width container surrounds all other divs */
      .container {
          width: 100%;
          margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
          height:100%;
      }
      .header {
          width:100%;
          margin: 0 auto;
          height:8%;
      }
	  .MsoNormal {
	  margin-right:0pt;
	  text-indent:0pt;
	  margin-top:0pt; 
	  margin-bottom:6.0pt;
	  line-height:119%;
	  text-align:center;
	  font-family:Calibri;
	  color:#333;
	  }
      .content {
          font-family:Verdana, Geneva, sans-serif;
          width: 100%;
          height:100%;
          margin: 0 auto;;
          text-align:center;
		  color:#333;
      }
	  .image{
		  max-height:"89";
		  max-width:"254";
	  }
      
      /* ~~ This grouped selector gives the lists in the .content area space ~~ */
      .content ul, .content ol { 
          padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
      }
      
           
      /* ~~ Miscellaneous float/clear classes ~~ */
      .fltrt {  /* float an element right. The floated element must precede the element it should be next to on the page. */
          float: right;
          margin-left: 8px;
      }
      .fltlft { /* float an element left. The floated element must precede the element it should be next to on the page. */
          float: left;
          margin-right: 8px;
      }
      .clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the .container) if the .footer is removed or taken out of the .container */
          clear:both;
          height:0;
          font-size: 1px;
          line-height: 0px;
      }
      </style>
  </head>
  <body>
    <div class="container">
      <div class="header">
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="loginregister.php"><img src="images/pg_title_login.png" alt="Login" name="Head" display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
		<?php
		$hour = time() + 3600;
        //Connects to your Database 
		include("db_connect.php");
			//if the login form is submitted 
			if (isset($_POST['submit'])) {
				//get the variables
				$username=trim($_POST['username']);
				$password=trim($_POST['password']);
			
				$username=mysql_real_escape_string($_POST['username']);
				$password=mysql_real_escape_string($_POST['password']);
				// makes sure they filled it in
				if(!$username | !$password) {
					die('Username or password not entered');
				}
				// checks it against the database
				$check = mysql_query("SELECT * FROM users WHERE username = '".$username."'")or die("Error:".mysql_error());
				
				//Gives error if user dosen't exist
				$check2 = mysql_num_rows($check);
				if ($check2 == 0) {
					die('That user does not exist in our database. <a href=loginregister.php class="MsoNormal">Click Here to Register</a>');
				}
				while($info = mysql_fetch_array($check)) {
					$password = stripslashes($password);
					$info['password'] = stripslashes($info['password']);
					$password = md5($password);
					$grade = $info['grade'];
					$status= $info['status'];
					
					//gives error if the password is wrong
					if ($password != $info['password']) {
						die('Incorrect password, please try again.');
						exit;
					}
					
					if ($status=="activated") {
						// if login is ok then we add a cookie 
						$_POST['username'] = stripslashes($_POST['username']); 
						setcookie("username_sutilities", $username, $hour); 
						setcookie("password_sutilities", $password, $hour);	 
						setcookie("grade_sutilities", $grade, $hour);
						setcookie("login_sutilities",1,$hour);
						//then redirect them to the members area
						header("Location: login_redirect.php");
						 exit;
					}
					elseif($status =="verify"){
						echo "This account has not been verified. If you are the account holder, 
						then please check the email you used while creating this account and follow the instructions in the email to verify this account.
						<br>If you are a new user, then please <a href='loginregister.php'>register</a>.";
					}
				}
			}
			else {
				echo "Please complete the login form!";
			}
		?>
	<!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>