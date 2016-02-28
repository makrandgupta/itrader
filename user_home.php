<?php
if (isset($_COOKIE['login_sutilities'])){
if ($_COOKIE['login_sutilities']==1){
	?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>Home</title>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="user_home.php"><img src="images/pg_title_home.png" alt="Home" name="Head" /></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
		<?
		//Connects to your Database 
		$connect= mysql_connect("localhost", "root", "123") or die(mysql_error());
		mysql_select_db("sutilities",$connect) or die("Error:".mysql_error());
		$username = $_COOKIE['username_sutilities'];
		$select_user="select * from users where username='$username'";
		$result=mysql_query($select_user,$connect);
		while ($row = mysql_fetch_array($result)) {
			$name=$row["first_name"];
			$address = $row["address"];
			$dob = $row["date_of_birth"];
			$email = $row["email"];
			$grade = $row["grade"];
			$last_name = $row["last_name"];
			$username = $row["username"];
		}
		//echo $grade;
		$exp=explode(" ",$grade);
		//print_r($exp);
		if ($exp[0]==12){
			$grade=12;
			//echo $grade;
		}
		elseif ($exp[0]==11){
			$grade=11;
			//echo $grade;
		}
		//exit;
		$select_timetable = "select * from timetables where grade ='$grade'";
		$result_tt= mysql_query($select_timetable,$connect) or die ("Error: tt query:".mysql_error());
		while ($tt = mysql_fetch_assoc($result_tt)) {
			$url=$tt["url"];
		}
        echo "<p class='fltrt'>Welcome! <b>".$name."&nbsp;".$last_name."</b>";
		echo "<br><a href='logout.php'><font color='#333'>Logout</font></a></p>";
		echo "<br><center><p><font size='+4'>What would you like to do?</font></p></center>";
		echo "<br><a href='canteen.php'><img src='images/user_home_canteen.png' alt='Canteen'></a>";
		echo "<a href=".$url."><img src='images/user_home_timetables.png' alt='Time Tables'></a>";
		echo "<a href='tradecenter.php'><img src='images/user_home_tradecenter.png' alt='Trade Center'></a>";
		?>
        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>
<?php
}
else{
	header('Location:guest_home.php');
}
}
else{
	header('Location:guest_home.php');
}
?>