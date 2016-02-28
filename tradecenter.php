<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
<title>Trade Center</title>
<!-- InstanceEndEditable -->
    <!-- InstanceBeginEditable name="head" -->
        <style type="text/css">
	.test{
		max-height:120pt;
		max-width:100pt;
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="tradecenter.php"><img src="images/pg_title_tradecenter.png" alt="Trade Center" name="Head"display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <? 
		if (isset($_COOKIE['login_sutilities'])){
			if ($_COOKIE['login_sutilities']==1){
				// display links to select various categories in the tradecenter
				require_once('db_connect.php');
				$username = $_COOKIE['username_sutilities'];
				$select_user="select * from users where username='$username'";
				$result=mysql_query($select_user,$conn);
				while ($row = mysql_fetch_array($result)) {
					$name=$row["first_name"];
					$last_name = $row["last_name"];
				}
				echo "<p class='fltrt'>Welcome! <b>".$name."&nbsp;".$last_name."</b>";
			}
			else{
				echo "<p class='fltrt'>Welcome! <b>Guest</b>";
			}
		}
		else{
			echo "<p class='fltrt'>Welcome! <b>Guest</b>";
		}
		?>
       <div class="fltlft">
        <table width="100%" border="0">
          <tr>
            <td scope="row"><?php echo "<a href='{$_SERVER['PHP_SELF']}?page=books' class='MsoNormal'><img src='images/tradecenter_navi_books.png' alt='Books'></a>"; ?></td>
          </tr>
          <tr>
            <td scope="row"><?php echo "<a href='{$_SERVER['PHP_SELF']}?page=clothes' class='MsoNormal'><img src='images/tradecenter_navi_clothes.png' alt='Clothes'></a>"; ?></td>
          </tr>
          <tr>
            <td scope="row"><?php echo "<a href='{$_SERVER['PHP_SELF']}?page=electronics' class='MsoNormal'><img src='images/tradecenter_navi_electronics.png' alt='Electronics'></a>"; ?></td>
          </tr>
          <tr>
            <td scope="row"><?php echo "<a href='{$_SERVER['PHP_SELF']}?page=others' class='MsoNormal'><img src='images/tradecenter_navi_others.png' alt='Others'></a>"; ?></td>
          </tr>
        </table>
      </div>
      <table>
       <tr>
      <?php
      session_start();
      //check if a page is selected
      if (isset ($_GET['page'])) {
          $page=$_GET['page'];    
      }
      
      //display links to change content according to user requirement
      echo "<div class='content'><a href='{$_SERVER['PHP_SELF']}?page=new' class='MsoNormal'><img src='images/tradecenter_navi_new.png' alt='Books'></a>";
      echo "<a href='{$_SERVER['PHP_SELF']}?page=user' class='MsoNormal'><img src='images/tradecenter_navi_user.png' alt='Books'></a></div>"; 
	  
      //conect to database
      require_once('db_connect.php');
      
	  //build query according to the 'page' variable
	  // if the user has not selected anything
	  if (isset($page)){
		  
		  //if the user has requested the new items
		  if ($page == "new"){
			  $query= "select idtradecenter, picture, date_uploaded, availability, item from tradecenter where availability = 'available' order by date_uploaded ";
		  }
		  
		  // if the user has requested the items uploaded by him
		    if ($page == "user"){
				if (isset ($_COOKIE['login_sutilities'])){
					if ($_COOKIE['login_sutilities'] == 1) {
							
					  $username = $_COOKIE['username_sutilities'];
					  $query= "select idtradecenter, picture, date_uploaded, availability, item from tradecenter where  seller='$username'order by date_uploaded ";
				  }
			  }
			  else {
				  echo "<br>You are not logged in! To view the items uploaded by you, please <a href='loginregister.php'>Login</a>";
				  exit;
			  }
			}

		  
		  //if the user has selected a particular category
		   if ($page == "books"| $page == "clothes"| $page == "electronics"|$page == "others"){
			  $query= "select idtradecenter, picture, date_uploaded, availability, item from tradecenter where category ='$page' order by date_uploaded ";
		  }
	  }
	  else{
		  $page="new";
		  $query= "select idtradecenter, picture, date_uploaded, availability, item from tradecenter order by date_uploaded limit 4";
	  }

	  $result=mysql_query($query,$conn) or die ("Error result: ".mysql_error());
	  
	  //get the number of rows and echo message if 0
	  $numrows =  mysql_num_rows($result);
	  if ($numrows == 0){
		  
		  if ($page == "books"| $page == "clothes"| $page == "electronics"|$page == "others"){
			  $message = "<br>Sorry there currently are no items in the ".ucfirst($page)." Category. Become the first one to <a href='tradecenter_new_item_form.php'>submit an item</a> to this category or please check again later.";
		  }
		  if ( $page == "user" ){
			  $message = "<br> You have not yet submitted any items! <br> <a href='tradecenter_new_item_form.php'>Submit</a> one now!";
		  }
		  if ( $page == "new") {
			  $message = "<br> Sorry, currently there are no items in the tradecenter! <br>Become the first one to <a href='tradecenter_new_item_form.php'>submit an item</a> or please check again later.";
		  }
		  echo $message;
	  }
	  
      //display the items at the start page
	  while ($row = mysql_fetch_array($result)){
          $picture = $row['picture'];
          $date_uploaded = $row['date_uploaded'];
          $item = $row['item'];
          $id = $row['idtradecenter'];
		  ?>
          <div class="image">
          <? 
		  echo"<td><a href='tradecenter_item.php?id=$id'><img class='test' src='$picture'></a></td>";
		  ?>
          </div>
		  <?

      }
	  if (isset($_COOKIE['login_sutilities'])){
		  if ($_COOKIE['login_sutilities'] == 1){
			  echo "<br><a class='fltrt' href='tradecenter_new_item_form.php'><img src='images/tradecenter_additem.png' alt='Add Item'></a>";
		  }
	  }
      ?> 
      </tr>
      </table>
        <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>