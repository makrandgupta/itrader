<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>Tradecenter</title>
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
	   if (isset($_SESSION['item_log_type'])){
		   if ($_SESSION['item_log_type']=="buy"){
			   $item=$_SESSION['item'];
			   //send Email
			   $name="Student Utilities";
			   $email="studentutilities@yahoo.com";
			   $buyer=$_COOKIE['username_sutilities'];
			   $today = date("F j, Y, g:i a");
			   $seller=$_SESSION['seller'];
			   $subject = "$item has been bought by $buyer at $today";
			   $body = "<font  face='Verdana, Geneva, sans-serif'><br>
			   '$buyer' has bought $item submitted by $seller";
			   $custom_header= 'From: noreply@student.3utilities.com' . "\r\n" .
			   'X-Mailer: PHP/' . phpversion();
			   include('mail.php');
			   
			   unset($subject);
			   unset($body);
			   unset($custom_header);
			   	
			   if ($error == 0){
				   header('Location:tradecenter_sendmail_seller.php');
			   }
			   
			   if ($error ==1 ) {
				   echo "Mailer Error:" . $mail->ErrorInfo;
			   }
		   }
		   elseif ($_SESSION['item_log_type']=="sell"){
		   }
	   }
	   ?>
       
        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>