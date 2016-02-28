<?php
$file="count_file.txt";
chmod("count_file.txt",0600);
if (file_exists($file)) 
	{
		$fil = fopen($file, 'r');
		$dat = fread($fil, filesize($file)) or trigger_error($errstr); 
		//echo $dat+1;
		fclose($fil);
		$fil = fopen($file, 'w');
		fwrite($fil, $dat+1);
	}
else
	{
		$fil = fopen($file, 'w');
		fwrite($fil, 1);
		//echo '1';
		fclose($fil);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/home.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<link rel="icon" type="image/png" href="images/favicon.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Student Utilities</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color:black;
	text-decoration: none; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

/* ~~ this container surrounds all other divs giving them their percentage-based width ~~ */
.container {
	width: 80%;
	/*max-width: 1260px;/* a max-width may be desirable to keep this layout from getting too wide on a large monitor. This keeps line length more readable. IE6 does not respect this declaration. */
	min-width: 780px;/* a min-width may be desirable to keep this layout from getting too narrow. This keeps line length more readable in the side columns. IE6 does not respect this declaration. */
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout. It is not needed if you set the .container's width to 100%. */
	height:100%;
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	margin: 0 auto;
	width:60%;
	font-size: 100%;
	
}
.header1 {
	font-size: 100%;
	width:20%;
}
.header2 {
	font-size: 100%;
	width:80%;
}
.heading{
	font-size:36px;
	text-align:center;
	font-weight:bold;
}

.content {
	padding: 10px;
	width: 80%;
	height:100%;
	float: left;
}
.iframe {
	width:100%;
	height:500px;
}
.nav {
	width:100%;
	height:20%;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
	list-style: none; /* this removes the list marker */
	border-bottom: 1px solid #666; /* this creates the top border for the links - all others are placed using a bottom border on the LI */
	margin-bottom: 15px; /* this creates the space between the navigation on the content below */
}
ul.nav li {
	border-bottom: 1px solid #666; /* this creates the button separation */
}
ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
	padding: 5px 5px 5px 15px;
	display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
	text-decoration: none;
	background: white;
	color:black;
	font-size:20px;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
	background: grey;
	color: #FFF;
	font-size: 150%;
}

/* ~~ The footer ~~ */


/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 10px;
	line-height: 0px;
}
-->
</style>
<script src="/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="/SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
<div class="header" align="center"><img src="images/header.png" width="100%" height="14%" /></div>
  
 <div class="nav">
  <ul id="Navigation" class="MenuBarHorizontal">
  <li><a href="user_home.php" target="content">Home</a></li>
      <li><a href="gmis_website.html" target="content">GMIS Website</a></li>
      <li><a class="MenuBarItemSubmenu" href="tradecenter.php" target="content">Trade Center</a>
        <ul>
          <li><a href="tradecenter.php?page=books" target="content">Books</a></li>
          <li><a href="tradecenter.php?page=clothes" target="content">Clothes</a></li>
          <li><a href="tradecenter.php?page=electronics" target="content">Electronics</a></li>
          <li><a href="tradecenter.php?page=others" target="content">Others</a></li>
        </ul>
      </li>
      <li><a href="timetables.php" target="content">Time Tables</a>
      <ul>
          <li><a class="MenuBarItemSubmenu" href="timetable_grade9.php" target="content">Grade 9</a>
            <ul>
              <li><a href="files/tt9a.pdf" target="content">9 A</a></li>
              <li><a href="files/tt9b.pdf" target="content">9 B</a></li>
              <li><a href="files/tt9c.pdf" target="content">9 C</a></li>
              <li><a href="files/tt9d.pdf" target="content">9 D</a></li>
              <li><a href="files/tt9e.pdf" target="content">9 E</a></li>
              <li><a href="files/tt9f.pdf" target="content">9 F</a></li>
              <li><a href="files/tt9g.pdf" target="content">9 G</a></li>
            </ul>
          </li>
          <li><a href="timetable_grade10.php" target="content">Grade 10</a>  <ul>
              <li><a href="files/tt10a.pdf" target="content">10 A</a></li>
              <li><a href="files/tt10b.pdf" target="content">10 B</a></li>
              <li><a href="files/tt10c.pdf" target="content">10 C</a></li>
              <li><a href="files/tt10d.pdf" target="content">10 D</a></li>
              <li><a href="files/tt10e.pdf" target="content">10 E</a></li>
              <li><a href="files/tt10f.pdf"target="content">10 F</a></li>
              <li><a href="files/tt10g.pdf" target="content">10 G</a></li>
            </ul></li>
          <li><a href="files/tt12.pdf" target="content">Grade 11</a></li>
          <li><a href="files/tt12.pdf" target="content">Grade 12</a> </li>
        </ul>
      </li>
      <li><a class="MenuBarItemSubmenu" href="canteen.php" target="content">Canteen</a>
        <ul>
          <li><a href="canteen_kosi-kosi.php" target="content">Kosi-Kosi</a></li>
          <li><a href="canteen_komalas.php" target="content">Komalas</a></li>
          <li><a href="canteen_ganesha.php" target="content">Ganesha</a></li>
          <li><a href="canteen_blueshop.php" target="content">Blue Shop</a></li>
          <li><a href="canteen_gelatomania.php" target="content">Gelato Mania</a></li>
          <li><a href="canteen_citras.php" target="content">Citras (Mie Shop)</a></li>
          <li><a href="canteen_queenstandoor.php" target="content">Queen's Tandoor</a></li>
          <li><a href="canteen_superbento.php" target="content">Super Bento</a></li>
          <li><a href="canteen_famecorner.php"target="content">Fame Corner</a></li>
          <li><a href="canteen_amazy.php" target="content">Amazy</a></li>
        </ul>
      </li>
       <li><a href="sitemap.php" target="content">Sitemap</a></li>
       <li><a href="loginregister.php" target="content">Login/Register</a></li>
       <li><a href="search.php" target="content">Search</a></li>
  </ul>
  </div>
<div class="iframe">
  <iframe src="user_home.php" name="content" frameborder="0" width="100%" height="100%"></iframe>
  </div>
</div>
<!-- end .container --></div>
<script type="text/javascript">
var MenuBar2 = new Spry.Widget.MenuBar("Navigation", {imgDown:"../SpryAssets/SpryMenuBarDownHover.gif", imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
<!-- InstanceEnd --></html>
