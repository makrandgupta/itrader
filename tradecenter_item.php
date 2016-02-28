<?php 
session_start();
if (isset($_COOKIE['login_sutilities'])){
	$id= $_GET['id']; 
	if (isset ($id)){
		$exp=explode(":",$id);
		if ($exp['0'] == "buy"){
			$_SESSION['id']=$exp[1];
			if ($_SESSION['id']){
				header("Location: tradecenter_item_buy.php");
			}
		}
		else{
			//conect to database
			require_once('db_connect.php');
			
			//get info about the selected item
			$query= "select idtradecenter, availability, buyer, category, date_uploaded, description, item, item_condition, picture, price, seller from tradecenter where idtradecenter='$id' order by date_uploaded limit 4";
			$result=mysql_query($query,$conn) or die("Error query: ".mysql_error());
			while ($row= mysql_fetch_assoc($result) ){
				$id=$row['idtradecenter'];
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
			}	
			?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title><? /* echo $item; */?></title>
    <!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
    <style type="text/css">
	.test{
		max-height:250pt;
		max-width:300pt;
	}
	</style>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="tradecenter.php"><img src="images/pg_title_tradecenter.png" alt="Trade Center" name="Head" display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->



        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>
<div style="font-family:Verdana, Geneva, sans-serif; margin-right:0pt; text-indent:0pt; margin-top:0pt; margin-bottom:6pt; line-height:119%; color:#333; margin:0 auto; width:60%;" >
			<?php 
			if ($availability ==  "available"){
				echo "<br><b><center><font size='+2'>$item</font></center></b><br>"; 
				?>
                <div class="fltrt">
                <img class="test" src="<?php echo $picture; ?>">
                </div>
                <font style=" text-align:left; vertical-align:center;">
                <?
				echo "<br>Category: $category<br>Condition: $condition<br>Available since: $date_uploaded<br>$description<br>Price: Rp. $price <br>";
				echo "This item is available to be bought.";
				echo "<br><center><a href='{$_SERVER['PHP_SELF']}?id=buy:$id' class='MsoNormal'><img src='images/tradecenter_buy.png' alt='Buy'></a></center>";
			}
			elseif($availability=="bought") {
				echo "<br><b><center><font size='+2'>$item</font></center></b><br>"; 
				?>
                <div class="fltrt">
                <img class="test" src="<?php echo $picture; ?>">
                </div>
                <font style=" text-align:left; vertical-align:center;">
                <?
				echo "<br>Category: $category<br>Condition: $condition<br>Available since: $date_uploaded<br>$description<br>Price: Rp. $price <br>";
				echo "Sorry, this item has already been bought.";
			}
		}
	}
}
else{
	?>
    <div class="clearfloat">
    <?
	echo "<p class='content'>Please login to view this item. <a href='loginregister.php' class='MsoNormal'>Login</a></p>";
}
?> 
</div>
</font>
</div>