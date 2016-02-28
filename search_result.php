<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
      <title>Search Results</title>
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
<?  
session_start();
//conect to database
require_once('db_connect.php');

//get the search parameters from cookies
$table= $_SESSION['table'];
$trimmed= $_SESSION['query'];
unset($_SESSION['query']);
unset($_SESSION['table']);

// find out how many rows are in the table
if (isset($table) && isset($trimmed)){
	if ($table == "canteen"){
		$query="select COUNT(*) from canteen where canteen.item like '%$trimmed%'".
		"or canteen.shop like '%$trimmed%'";
	}
	if ($table == "timetables"){
		$query="select COUNT(*) from timetables where timetables.grade like '%$trimmed%'".
		"or timetables.idtimetables like '%$trimmed%'";
	}
	if ($table == "tradecenter"){
		$availability="available";
		$query="select COUNT(*) from tradecenter where category like '%$trimmed%'".
		"or description like '%$trimmed%'".
		"or item like '%$trimmed%'".
		"or item_condition like '%$trimmed%'".
		"or price like '%$trimmed%'".
		"or seller like '%$trimmed%'".
		"and availability='$availability'";
	}
	
	$result = mysql_query($query, $conn) or die("Error:".mysql_error());
	$r = mysql_fetch_row($result);
	$numrows = $r[0];
}
if ($numrows == 0){
	echo "<div class='MsoNormal'>Sorry! Your search for &quot;".$trimmed."&quot; did not match any entries in &quot;".ucfirst($table)."&quot;<br> Please <a href='search.php' class='MsoNormal'>Try again</a></div>";
	exit;
}
// number of rows to show per page
$rowsperpage = 10;
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
if ($table == "canteen"){
	$sql="select canteen.price, canteen.url, canteen.item, canteen.shop from canteen where canteen.item like '%$trimmed%'".
	"or canteen.shop like '%$trimmed%' LIMIT $offset, $rowsperpage";
}
if ($table == "timetables"){
	$sql="select timetables.grade, timetables. url, timetables.idtimetables from timetables where timetables.grade like '%$trimmed%'".
	"or timetables.idtimetables like '%$trimmed%' LIMIT $offset, $rowsperpage";
}
if ($table == "tradecenter"){
	$sql="select item, price, idtradecenter from tradecenter where  category like '%$trimmed%'".
		"or description like '%$trimmed%'".
		"or item like '%$trimmed%'".
		"or item_condition like '%$trimmed%'".
		"or price like '%$trimmed%'".
		"or seller like '%$trimmed%'".
		"and availability='$availability' LIMIT $offset, $rowsperpage";
}

$result = mysql_query($sql, $conn) or die("Error:".mysql_error());

	echo "<div class='MsoNormal'>Your search for &quot;".$trimmed."&quot; in &quot;".$table."&quot; returned the following results:<br></div>";
if ($table == "canteen"){
	echo "<center><table><tr><th>Name of Dish</th><th>Price</th><th>Available at</th></tr>";
}
if ($table == "timetables"){
	echo "<center><table><tr><th>Grade</th><th>&nbsp;</th></tr>";
}
if ($table == "tradecenter"){
	echo "<center><table><tr><th>Item</th><th>Price</th></tr>";
}
while ($row = mysql_fetch_array($result)) {
	if ($table == "canteen") {
		$item = $row["item"];
		$price = $row["price"];
		$shop = $row["shop"];
		$url = $row["url"];
		echo "<tr><td>$item</td><td>Rp.$price</td><td align='center'><a class='MsoNormal' href='$url'>$shop</a></td></tr>" ;
	}
	if ($table == "timetables"){
		$grade = $row["grade"];
		$url = $row["url"];
		echo "<tr><td align='center'><a class='MsoNormal' href='$url'>$grade</a></td></tr>" ;
	}
	if ($table == "tradecenter"){
		$item = $row["item"];
		$price = $row['price'];
		$id = $row['idtradecenter'];
		$url = "tradecenter_item.php?id=$id";
		echo "<tr><td><a class='MsoNormal' href='$url'>$item</a></td><td>Rp.$price</td></tr>" ;
	}

}
echo "</table></center>";
$range = 1;
echo "<br>";
if ($currentpage > 1) {
	echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=1' class='MsoNormal'>&nbsp;First&nbsp;</a> ";
	$prevpage = $currentpage - 1;
	echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage' class='MsoNormal'>&nbsp;Previous&nbsp;</a> ";
}

for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
	if (($x > 0) && ($x <= $totalpages)) {
		if ($x == $currentpage) {
			echo " [<b>$x</b>] ";
		}
		else {
			echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x' class='MsoNormal'>&nbsp;$x&nbsp;</a> ";
		}
	}
}

if ($currentpage != $totalpages) {
	$nextpage = $currentpage + 1;
	echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage' class='MsoNormal'>&nbsp;Next&nbsp;</a> ";
	echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages' class='MsoNormal'>&nbsp;Last&nbsp;</a> ";
}
echo "<br><a href='search.php' class='MsoNormal'>Change Search terms</a>";
?>
		 <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>