<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
<title>Register</title>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="loginregister.php"><img src="images/pg_title_regiser.png" alt="Register" name="Head" display:block;"/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <?php 
		session_start();
		if  (isset($_SESSION['verify'])){
			if ($_SESSION['verify'] == 1) {
				//connect to mysql database and select db
				$connect=mysql_connect("localhost","root","123") or die("Error connect:".mysql_error());
				mysql_select_db("sutilities", $connect) or die("Error db:".mysql_error());
							
				//get the user info from the session variables
				$username=$_SESSION['username'];
				$password=$_SESSION['password'];
				$rpassword=$_SESSION['rpassword'];
				$email=$_SESSION['email'];
				$sques=$_SESSION['sques'];
				$sans=$_SESSION['sans'];
				$grade=$_SESSION['grade'];
				$dob=$_SESSION['dob'];
				$address=$_SESSION['address'];
				$name=$_SESSION['name'];
				$lname=$_SESSION['lname'];
				$phone=$_SESSION['phone'];

				// here we encrypt the password and add slashes if needed
				$password = md5($password);
				if (!get_magic_quotes_gpc()) {
					$password = addslashes($password);
					$username = addslashes($username);
				}
				
				//process the visitor number from the counter file
				$file='count_file.txt';
				chmod($file,0600);
				$fil = fopen($file, 'r');
				$visitor_number="u".fread($fil, filesize($file));
	
				//generate activation code and insert user data into database
				$activationkey =  ((mt_rand() * mt_rand()) + mt_rand())%mt_rand();
				$sql="INSERT INTO users (address, date_of_birth, email, first_name, grade, idusers, last_name, password, security_question, security_answer, username, contact_number, activation, status) VALUES ('$address','$dob','$email','$name','$grade','$visitor_number','$lname','$password','$sques','$sans','$username','$phone','$activationkey', 'verify')";
				if (!mysql_query($sql))  {
					die('Error: ' . mysql_error());
				}
				//send activation Email
				$subject = "Student Utilities Registration";
				$body = "<font  face='Verdana, Geneva, sans-serif'>Thankyou for registering!\r\r<br>
				This email address has been used to register at Student Utilities. <br>
				You can complete registration by clicking the following link:\rhttp://student.3utilities.com/register.php?$activationkey<br>
				If this is an error, ignore this email <br>
				Regards<br>
				Student Utilities </font>";
				$custom_header= 'From: noreply@localhost.com' . "\r\n" .
				'Reply-To: noreply@localhost.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
				$error = 0;
				include('mail.php');		
				if ($error == 0){
					echo "<br><br><br>";
					echo "An email has been sent to $email with an activation key. Please check your mail to complete registration.<br>
					If you do not recieve the mail within five minutes, then please check your Spam / Junk mail.";
				}
				if ($error ==1 ) {
					echo "Mailer Error: 132 " . $mail->ErrorInfo;
				}
				unset($_SESSION['verify']);
			}
			else{
				echo "Error: ".mysql_error();
			}
		}
		else{
			require_once('db_connect.php');
			$queryString = $_SERVER['QUERY_STRING'];
			$query = "SELECT * FROM users"; 
			$result = mysql_query($query) or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				if ($queryString == $row["activation"]){
					$sql="UPDATE users SET activation= '', status='activated' where activation = $queryString";
					if (!mysql_query($sql)) {
						die('Error  149: ' . mysql_error());
					}
					$id=$row['idusers'];
					$name = $row['first_name'];
					$username=$row['username'];
					$lname= $row['last_name'];
					$email = "studentutilities@yahoo.com";
					$subject = "Registered: $name as $username";
					$today = date("F j, Y, g:i a");
					$body = "<font face='Verdana, Geneva, sans-serif'>$today<br> $name $lname has been registered as user $username with userid $id into the Student Utilities User Database.</font>";
					$custom_header= 'From: noreply@localhost.com' . "\r\n" .
					'Reply-To: noreply@localhost.com' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					include('mail.php');		
					$name = $row['first_name'];
					$username=$row['username'];
					$lname= $row['last_name'];
					echo "<br><br><br>";
					echo "Congratulations! " . $row["username"] . " is now activated.";
					echo "<br>Succesfully Registered ".$name ." ".$lname." as ".$username."!";
					echo "<br> Please close this window and login using your default browser.!";
				}
			}
		}
		?>
        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>