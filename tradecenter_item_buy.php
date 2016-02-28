<?php
session_start();
if (isset($_SESSION['id'])){
	$id= $_SESSION['id'];
	
	//conect to database
	require_once('db_connect.php');
	
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
		$_SESSION['item']=$item;
		$picture=$row['picture'];
		$price=$row['price'];
		$seller=$row['seller'];
		$_SESSION['seller']=$seller;
		//print_r( $row);
	}
}
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>Buy <? //echo $item; ?></title>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><img src="images/pg_title_tradecenter.png" alt="Tradecenter" name="Head" display:block;/><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <?php
       if (isset($_SESSION['buy'])){
		   if ($_SESSION['buy']=="verified"){
			   unset($_SESSION['buy']);
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
			   
			   unset($query);
			   unset($result);
			   unset($row);
			   
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
			   unset($query);
			   unset($result);
			   unset($row);

			   //send Email
			   $subject = "$item has been bought at the Student Utilities Tradecenter";
			   $body = "<font  face='Verdana, Geneva, sans-serif'>Hello $name!\r\r<br>
			   '$buyer_name'  wants to buy $item uploaded by you at the Student Utilities Tradecenter<br>
			   The following are the buyer's details: <br>
			   Mobile phone : 0$buyer_contact_number<br>
			   Email: $buyer_email<br><br>
			   Regards<br>
			   Student Utilities</font>";
			   $custom_header= 'From: noreply@student.3utilities.com' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();
			   include('mail.php');
			   
			   unset($subject);
			   unset($body);
			   unset($custom_header);
			   	
			   if ($error == 0){
				   $_SESSION['item_log_type']="buy";
				   header('Location:tradecenter_item_log.php');
			   }
			   
			   if ($error ==1 ) {
				   echo "Mailer Error:" . $mail->ErrorInfo;
			   }
		   }
		   else {
			   if (isset($_GET['buy'])){
				   if ($_GET['buy']=="yes"){
					   $_SESSION['buy']="yes";
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
                       <?
				   }
				   if ($_GET['buy']=="no"){
					   header ('Location: tradecenter.php'); 
				   }
			   }
			   else{
				   echo "<p> Are you sure you would like to buy this item?</p>";
				   echo "<br><a class='MsoNormal' href='{$_SERVER['PHP_SELF']}?buy=yes'>Yes</a>&nbsp;&nbsp;&nbsp;";
				   echo "								";
				   echo "<a class='MsoNormal' style='' href='{$_SERVER['PHP_SELF']}?buy=no'>No</a>";
			   }
		   }
	   }
	   else {
		   if (isset($_GET['buy'])){
			   if ($_GET['buy']=="yes"){
				   $_SESSION['buy']="yes";
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
                   <?
			   }
			   if ($_GET['buy']=="no"){
				   header ('Location: tradecenter.php');
			   }
		   }
		   else{
			   echo "<p> Are you sure you would like to buy this item?</p>";
			   echo "<br><a class='MsoNormal' href='{$_SERVER['PHP_SELF']}?buy=yes'>Yes</a>&nbsp;&nbsp;&nbsp;";
			   echo "								";
			   echo "<a class='MsoNormal' style='' href='{$_SERVER['PHP_SELF']}?buy=no'>No</a>";
		   }
	   }
	   ?>
        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>