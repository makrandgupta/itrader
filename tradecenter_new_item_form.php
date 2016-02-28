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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="tradecenter.php"><img src="images/pg_title_tradecenter.png" alt="Trade Center" name="Head" display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <?
		if (isset ($_COOKIE['login_sutilities'])){
			if ($_COOKIE['login_sutilities'] == 1){
		?>
        <p><center><font size="+6" color="#999999">Add New Item</font></center></p>
<form name="new_item" method="post" enctype="multipart/form-data"  action="tradecenter_new_item_process.php">
            <table width="100%" border="0">
              <tr>
                <td width="45%"><div align="right">Name of Item : </div></td>
                <td width="55%">
                    <div align="left">
                      <input type="text" name="item"  tabindex="1">
                </div></td>
               <tr>
                <td><div align="right">Category : </div></td>
                <td><label for="select"></label>
                 <div align="left">
                  <select name="category" tabindex="2">
                   <option></option>
                   <option> Books </option>
                   <option> Clothes </option>
                   <option> Electronics </option>
                   <option> Others </option>
                  </select>
                 </div>
                </td>
               </tr>
              </tr>
                <tr>
                  <td><div align="right">Picture :</div></td>
                  <td><div align="left">
                    <input type="file" name="image" tabindex="3">
                  </div></td>
              </tr>
                <tr>
                  <td><div align="right">Price (Rp.):</div></td>
                  <td><div align="left">
                      <input type="text" name="price" tabindex="4">
                  </div></td>
              </tr>
                <tr>
                  <td><div align="right">Condition :</div></td>
                  <td><div align="left">
                      <select name="condition" tabindex="5">
                        <option> New </option>
                        <option> Used </option>
                      </select>
                  </div></td>
              </tr>
                <tr>
                  <td><div align="right">Description :</div></td>
                  <td><div align="left">
                      <textarea name="description" cols="35" rows="3" tabindex="6"></textarea>
                  </div></td>
              </tr>
                <tr>
                  <td><div align="right">
                    <input name="Submit" type="submit" value="Add Item" tabindex="7">
                  </div></td>
                  <td><div align="left">
                    <input type="reset" name="reset" value="Reset">
                  </div></td>
              </tr>
            </table>
          </form>
                  <p class="fltrt" style="font-size:smaller"> Please Note: All fields are important!</p>

          <?
			}		
			else {
				echo "You are not logged in! To submit an item, please <a href='loginregister.php'>Login</a>";
			}
		}
		else {
			echo "You are not logged in! To submit an item, please <a href='loginregister.php'>Login</a>";
		}
		  ?>
       <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>