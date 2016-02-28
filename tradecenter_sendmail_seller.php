<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>Untitled Document</title>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><img src="images/pg_title_tradecenter.png" alt="Trade Center" name="Head" display:block;/><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <?
		session_start();
		require_once('db_connect.php');
		
		$id= $_SESSION['id'];
	
		//get info about the selected item
		$query= "select availability, buyer, category, date_uploaded, description, item, item_condition, picture, price, seller from tradecenter where idtradecenter='$id' order by date_uploaded limit 4";
		$result=mysql_query($query,$conn) or die("Error query: ".mysql_error());
		while ($row= mysql_fetch_assoc($result) ){
			$availability=$row['availability'];
			$buyer=$row['buyer'];
			$category=$row['category'];
			$condition=$row['item_condition'];
			$date_uploaded=$row['date_uploaded'];
			$description=$row['description'];
			$item=$row['item'];
			$picture=$row['picture'];
			$price=$row['price'];
			$seller=$row['seller'];
			//print_r( $row);		
		}
		
	   // get info about seller
	   $query= "select * from users where username='$seller'";
	   $result=mysql_query($query,$conn) or die("Error query: ".mysql_error());
	   while ($row= mysql_fetch_assoc($result) ){
		   $address=$row['address'];
		   $contact_number=$row['contact_number'];
		   $email=$row['email'];
		   $name=$row['first_name'];
		   $name.=" ";
		   $name.=$row['last_name'];
	   }

		//get info about buyer
		$buyer=$_COOKIE['username_sutilities'];
		$query= "select * from users where username='$buyer'";
		$result=mysql_query($query,$conn) or die("Error query: ".mysql_error());
		while ($row= mysql_fetch_assoc($result) ){
			$buyer_contact_number=$row['contact_number'];
			$buyer_email = $row['email'];
			$buyer_name=$row['first_name'];
			$buyer_name.=" ";
			$buyer_name.=$row['last_name'];
		}

		$email=$buyer_email;
		$subject = "You have bought $item the Student Utilities Tradecenter";
		$body = "<font  face='Verdana, Geneva, sans-serif'>Hello $buyer_name!\r\r<br>
		You have bought $item added by $name at the Student Utilities Tradecenter<br>
		Following are $name's details:
		Mobile phone : $contact_number
		Email: $email<br><br>
		Regards<br>
		Student Utilities</font>";
		$custom_header= 'From: noreply@student.3utilities.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$error = 0;
		include('mail.php');
		if ($error == 0){
			$id=$_SESSION['id'];
			$buyer=$_COOKIE['username_sutilities'];
			require_once('db_connect.php');
			$query = "SELECT * FROM tradecenter"; 
			$result = mysql_query($query) or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				if ($id == $row["idtradecenter"]){
					$sql="UPDATE tradecenter SET buyer= '$buyer', availability='bought' where idtradecenter = '$id'";
					mysql_query($sql) or die('Error: here!@! ' . mysql_error());
					echo "This item is available with ".$name."<br>
					Mobile phone : 0".$contact_number."<br>
					Email: ".$email."<br>
					An email with this information has been sent to you and $name has been informed about this request through email.";
					unset($_SESSION['buy']);
				}
			}
			$past = time() - 3600;
			foreach ( $_SESSION as $key => $value ){
				unset($_SESSION[$key]);
				echo"<br />";
			}
		}
		if($error==1){
			echo "Mailer Error:" . $mail->ErrorInfo;
		}
		?>
        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>