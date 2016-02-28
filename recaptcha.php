<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>reCAPTCHA</title>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
         <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><img src="images/pg_title_regiser.png" alt="Register" name="Head" display:block;/><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <center>
<?php 
//connect to mysql database and select db
$connect=mysql_connect("localhost","root","123") or die("Error:".mysql_error());
mysql_select_db("sutilities", $connect) or die("Error:".mysql_error());
				
// get the variables from the form
	if (isset ($_POST['date'])){
		$username = trim($_POST['reg_username']);
		$password = trim($_POST['reg_password']);
		$rpassword = trim($_POST['reg_repeat_password']);
		$email = trim($_POST['email']);
		$sques= trim($_POST['security_question']);
		$sans= trim($_POST['security_answer']);
		$section = trim($_POST['section']);
		$class = trim($_POST['class']);
		$date = trim($_POST['date']);
		$month = trim($_POST['month']);
		$year = trim($_POST['year']);
		$address = trim($_POST['address']);
		$name = trim($_POST['fname']);
		$lname = trim($_POST['lname']);
		$phone = trim($_POST['contact_number']);
		$ip = getenv("REMOTE_ADDR");
		$prevurl = ($_SERVER['HTTP_REFERER']);
		
		//merge grade into one variable
		$grade= $class;
		$grade.= " ";
		$grade.=$section;
		
		//escape sql injection
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$rpassword = mysql_real_escape_string($rpassword);
		$email =mysql_real_escape_string($email);
		$sques= mysql_real_escape_string($sques);
		$sans= mysql_real_escape_string($sans);
		$grade = mysql_real_escape_string($grade);
		$date = mysql_real_escape_string($date);
		$month = mysql_real_escape_string($month);
		$year = mysql_real_escape_string($year);
		$address = mysql_real_escape_string($address);
		$name =mysql_real_escape_string($name);
		$lname = mysql_real_escape_string($lname);
		$phone = mysql_real_escape_string($phone);
		
		// merge the DOB into one variable
		$dob= $date.'&nbsp;'.$month.'&nbsp;'.$year;
		
		//store form variables into session variables to pass on to the register script
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['rpassword']=$rpassword;
		$_SESSION['email']=$email;
		$_SESSION['sques']=$sques;
		$_SESSION['sans']=$sans;
		$_SESSION['grade']=$grade;
		$_SESSION['dob']=$dob;
		$_SESSION['address']=$address;
		$_SESSION['name']=$name;
		$_SESSION['lname']=$lname;
		$_SESSION['phone']=$phone;
	
		//process the visitor number from the counter file
		$file='count_file.txt';
		chmod($file,0600);
		$fil = fopen($file, 'r');
		$visitor_number="u".fread($fil, filesize($file));
		
		// check if any fields are blank
		if ($date == "" | $month == "" | $year == "" | $name == "" | $lname == "" | $address == "" | $email == "" | $grade == "" | $username == "" | $password == "" | $rpassword == "" | $phone == "" | $sans =="" |$sques == "" ){
			echo "<div class='MsoNormal'><br><br>=O Oops! Looks like you have left an important field blank! Please complete all fields =)</div> ";
			echo "<a href='$prevurl' class='MsoNormal'>Go Back</a></div>";
			echo "<br><br><p class='fltrt'><b>Note:</b> All Fields are important</p>";
		}
		else {
			// check if the passwords match
			if ($password == $rpassword){

				// checks if the username is already occupied
				if (!get_magic_quotes_gpc()) {
					$username = addslashes($username);
				}
				$usercheck = $username;
				$check = mysql_query("SELECT username FROM users WHERE username = '$usercheck'") 
				or die("Error:".mysql_error());
				$check2 = mysql_num_rows($check);
				
				//if the name is occupied, it gives an error
				if ($check2 != 0) {
					echo "Sorry, the username '$username' is already in use.";
					echo "&nbsp; Please go back and try again.";
					exit;
				}
				// checks if the email is already occupied
				if (!get_magic_quotes_gpc()) {
					$email = addslashes($email);
				}
				$emailcheck = $email;
				$check = mysql_query("SELECT username FROM users WHERE username = '$emailcheck'") 
				or die("Error:".mysql_error());
				$check2 = mysql_num_rows($check);
				
				//if the email is occupied, it gives an error
				if ($check2 != 0) {
					echo "Sorry, the email '.$email.' is already in use.";
					echo "&nbsp; Please go back and try again.";
					exit;
				}
				?>
                <center>
                <form method="post" action="recaptcha_verify.php">
                  <?php
                    require_once('recaptchalib.php');
                    $publickey = "6LeBhscSAAAAALV16tnWmw4SqALpc1CDODUvXwJ0";
                    echo recaptcha_get_html($publickey);
                  ?>
                  <input type="submit" name="submit" value="Continue"/>
                </form>	
                </center>			
				<?php
				
			}
			else {
				echo "Passwords do not match!! Please try again";
				echo "<a href='$prevurl'>back</a>";
			}
		}
	}
	else{
		echo "Incorrect call procedure. Please complete the registration form first =)";
		echo "&nbsp;<a href='loginregister.php'>Register</a>";
		exit;
	}
	?>   </center>     <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>