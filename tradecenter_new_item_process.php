<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>New Item</title>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="tradecenter.php"><img src="images/pg_title_tradecenter.png" alt="***EDIT***" name="Head" display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
<?php
if(isset($_POST['Submit'])){

//get variables from the form
$name=$_POST['item'];
$category=$_POST['category'];
$image=$_FILES['image']['name'];
$price=$_POST['price'];
$condition=$_POST['condition'];
$description=$_POST['description'];
$size=$_FILES['image']['size'];
$max_size=5;

if ($name =="" or $category=="" or $image==""  or $condition == "" or $price == "" or  $description==""){
	echo "Please Note: All fields are important!<br>";
	echo "You have left a field blank!<br>";
	echo "Please go back and try again!";
	exit;
}

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
function getExtension($str) {
	   $i = strrpos($str,".");
	   if (!$i) { return ""; }
	   $l = strlen($str) - $i;
	   $ext = substr($str,$i+1,$l);
	   return $ext;
}

//define the error flag
$errors=0;

//checks if the form has been submitted
if(isset($_POST['Submit'])){

  //if it is not empty
   if ($image) {
	   //get the original name of the file from the clients machine
	   $filename = stripslashes($_FILES['image']['name']);
	   //get the extension of the file in a lower case format
	   $extension = getExtension($filename);
	   $extension = strtolower($extension);
		// print error if extension is invalid
	   if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
		   //print error message
		   echo "Unknown extension!<br>
			Valid Extensoins: '.jpg', '.jpeg', '.png', '.gif' &amp; '.bmp'";
		   $errors=1;
	   }
	   else{
		   //compare the size with the maxim size we defined and print error if bigger
		   if ($size >$max_size*1024*1024){
			   echo "You have exceeded the size limit!<br>
				Max file size: ".$max_size." MB";
			   $errors=1;
		   }
		   //we will give an unique name, for example the time in unix time format
		   $image_name=time().'.'.$extension;
		   //the new name will be containing the full path where will be stored (images folder)
		   $newname="images/tradecenter/".$image_name;
		   //we verify if the image has been uploaded, and print error instead
		   $copied = copy($_FILES['image']['tmp_name'], $newname);
		   if (!$copied) {
			   echo 'Copy unsuccessfull!';
			   $errors=0;
		   }
	   }
   }
}
if(!$errors){
	//if no errors
	//connect to database 
	require_once("db_connect.php");
	//get biggest idtradecenter
	$result=mysql_query("select idtradecenter from tradecenter order by idtradecenter desc limit 1",$conn) or die("error result: ".mysql_error());
	$numrows=mysql_num_rows($result);
	$row=mysql_fetch_array($result);
	$id=$row['idtradecenter'];
	//if exists, then add 1
	if ($id){
		$exp=explode("tc",$id);
		$exp['1']=$exp['1']+1;
		$id="tc";
		$id.=$exp['1'];
	}
	// if dosent exist, then use tc1 as initial value
	else{
		$id="tc1";
	}
	
	$today = date("Y-m-d H:i:s");
	$seller=$_COOKIE['username_sutilities'];
	$image_name = "images/tradecenter/".$image_name;
	
	//send log email
	$email="studentutilities@yahoo.com";
	$subject = "$name - New Item added to the tradecenter";
	$body = "<font  face='Verdana, Geneva, sans-serif'>
	$name was added to the tradecenter on $today by $seller
	Regards<br>
	Student Utilities</font>";
	$custom_header= 'From: noreply@localhost.com' . "\r\n" .
	'Reply-To: noreply@localhost.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();
	$error = 0;
	include('mail.php');	

	if ($error == 0){
		//insert the item into database
		$insert_sequence="INSERT INTO tradecenter (availability, category,  date_uploaded, description, item, item_condition, picture, price, seller, idtradecenter) values ('available','$category', '$today','$description','$name','$condition','$image_name','$price','$seller','$id')";
		mysql_query($insert_sequence,$conn) or die("Error: 144: ".mysql_error());
		echo "Item added Successfully!";
	}
	if ($error ==1 ) {
		echo "Mailer Error:" . $mail->ErrorInfo;
	}
}
}
else{
	header("Location:user_home.php");
}

 ?>


        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>