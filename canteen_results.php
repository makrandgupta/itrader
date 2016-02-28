<?php 
session_start();
#$_SESSION['shop_sutilities'] = "amazy";
if (isset($_SESSION['shop_sutilities'])){
?>
<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/canteen.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
    
      <title><?php echo ucfirst($_SESSION['shop_sutilities']); ?></title>
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
	  font-size:18px;
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
		  width:"254";
		  height:"89";
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
	  .test{
		  text-align:center;
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="canteen.php"><img src="images/pg_title_canteen.png" alt="Canteen" name="Head" display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <div class="MsoNormal">
		<?php
        //get name of shop from session variable
        $shop=$_SESSION['shop_sutilities'];
		
		//conect to database
		require_once('db_connect.php');
        
        // find out how many rows are in the table
        $query="select COUNT(*) from canteen where shop like '$shop'";
        $result = mysql_query($query, $conn) or die("Error:".mysql_error());
        $r = mysql_fetch_row($result);
        $numrows = $r[0];
        // number of rows to show per page
        $rowsperpage = 12;
        // find out total pages
        $totalpages = ceil($numrows / $rowsperpage);
        
        // get the current page or set a default
        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
            // cast var as int
            $currentpage = (int) $_GET['currentpage'];
            } else {
            // default page num
            $currentpage = 1;
        }
        
        // if current page is greater than total pages...
        if ($currentpage > $totalpages) {
            // set current page to last page
            $currentpage = $totalpages;
        }
        // if current page is less than first page...
        if ($currentpage < 1) {
            // set current page to first page
            $currentpage = 1;
        }
        
        // the offset of the list, based on current page
        $offset = ($currentpage - 1) * $rowsperpage;
        
        // get the info from the db
        $sql="select canteen.price, canteen.url, canteen.item, canteen.shop from canteen where shop like '$shop' LIMIT $offset, $rowsperpage";
        $result = mysql_query($sql, $conn) or die("Error:".mysql_error());
		$img_src = "images/".$shop.".png";
		echo "<img class='fltlft' src='$img_src'>";
        echo "<center><table><tr><td colspan='2' align='center' class='shoptitle'>".ucwords($shop)."</td></tr><tr></tr><tr><th>Name of Dish</th><th>Price</th></tr>";
        while ($row = mysql_fetch_array($result)) {
                $item = $row["item"];
                $price = $row["price"];
                echo "<tr><td>$item</td><td>Rp.$price</td></tr>" ;
        }
        echo "</table></center>";
        $range = 1;
        
        if ($currentpage > 1) {
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1' class='MsoNormal'>&nbsp;First&nbsp;</a> ";
            $prevpage = $currentpage - 1;
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage' class='MsoNormal'>&nbsp;Previous&nbsp;</a> ";
        }   
        for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
            if (($x > 0) && ($x <= $totalpages)) {
                if ($x == $currentpage) {
                    echo " [<b class='MsoNormal'>$x</b>] ";
                }
                else {
                    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x' class='MsoNormal'>&nbsp;$x&nbsp;</a> ";
                }
            }
        }
        
        if ($currentpage != $totalpages) {
            $nextpage = $currentpage + 1;
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage' class='MsoNormal'>&nbsp;Next&nbsp;</a> ";
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages' class='MsoNormal'>&nbsp;Last&nbsp;</a>";
        }
		?> 
        </div>        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html> 
<?php
}
else{
	echo "Error: Invalid call procedure. Please select a shop in order to view its menu!";
}
?>