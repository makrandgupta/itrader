<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>Search</title>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="search.php"><img src="images/pg_title_search.png" alt="Search" name="Head" display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
<form name="form" action="search.php" method="post">
  <input type="search" name="query" >
  <input type="hidden" name="submit" value="1">
  <select name="table">
	<option value=""></option>
    <option value="canteen">Canteen</option>
    <option value="timetables">Time Tables</option>
    <option value="tradecenter">Trade Center</option>
  
  </select>
  <input type="submit" name="search" value="Search" >
</form>
<?php
session_start();
// set the cookies
if(isset($_POST['search'])){
	$var=$_POST['query'];
	$table=$_POST['table'];
	if ($var == ""){
			echo "<br>=O Oops! You've left a field blank!";
			exit;
	}
	else{
		if ($table == ""){
			echo "<br>=O Oops! You've left a field blank!";
			exit;
		}
		else{
			$trim=trim($var);
			unset($_SESSION['query']);
			unset($_SESSION['table']);
			$_SESSION['query']=$trim;
			$_SESSION['table']=$table;
			#setcookie('sutilities_search_query',$trim,time()-20) or die("cookie not deleted");
			#setcookie('sutilities_search_table',$table,time()-20)or die("cookie not deleted");
			#setcookie('sutilities_search_query',$trim) or die("cookie not set");
			#setcookie('sutilities_search_table',$table)or die("cookie not set");
			if (isset($_SESSION['query']) | isset($_SESSION['table'])){
				header('Location:search_result.php');
			}
		}
	}
}
?>
		 <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>