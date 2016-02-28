<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/content.dwt.php" codeOutsideHTMLIsLocked="false" -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- InstanceBeginEditable name="doctitle" -->
<title>Login/Register</title>
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
        <div class="content"><div class="image"><!-- InstanceBeginEditable name="image" --><a href="loginregister.php"><img src="images/pg_title_loginregister.png" alt="Register" name="Head" display:block;/></a><!-- InstanceEndEditable --></div></div>
      </div>
      <div class="content">
        <!-- InstanceBeginEditable name="Content" -->
        <center>
        <?php
		session_start();
		//Connects to your Database 
		$connect= mysql_connect("localhost", "root", "123") or die("Error: ".mysql_error());
		mysql_select_db("sutilities",$connect) or die("Error: ".mysql_error());
		//Checks if there is a login cookie
		if (isset($_COOKIE['username_sutilities'])){
			if (isset($_COOKIE['login_sutilities'])){
				if($_COOKIE['login_sutilities'] == 1){
					//if there is, it logs you in and directes you to the members page
					$username = $_COOKIE['username_sutilities']; 
					$pass = $_COOKIE['password_sutilities'];
					$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
					while($info = mysql_fetch_array( $check )) {
						if ($pass != $info['password']) {
						}
						else{
							header("Location: login_redirect.php");
						}
					}
				}
			}
		}
		else{
			?>
            <table>
              <tr>
                <td>
                  <table height="100%">
                  <form name="login" method="post" action="login.php">
                    <tr>
                      <th colspan="2"><h3>Login</h3></th>
                    </tr>
                    <tr>
                      <td width="12%" align="right">Username</td>
                      <td width="19%" ><input type="text" name="username" tabindex="a"></td>
                    </tr>
                    <tr>
                      <td align="right">Password</td>
                      <td><input type="password" name="password" tabindex="b"></td>
                   
                    <tr>
                      <td align="right">
                        <input type="submit" name="submit" value="Login" tabindex="c">
                      </td>
                      <td align="left">
                        <input type="reset" name="reset" value="Reset" tabindex="d">
                      </td>
                  </form>
                  </table>
                </td>
                <td>
                  <table>
                    <form name="register" method="post" action="recaptcha.php">
                  <tr>
                   <th colspan="4"><h3>Register</h3></th>
                  </tr>
                  <tr>
                    <td width="21%" align="right">First Name </td>
                    <td width="24%" align="left"><input type="text" name="fname" tabindex="3"></td>
                    <td width="23%" align="right">Last Name</td>
                    <td width="32%" align="left"><input type="text" name="lname" tabindex="4"></td> 
                  </tr>
                  <tr>
                    <td width="21%" scope="row" align="right">Address</td>
                    <td width="24%" align="left"><input type="text" name="address" tabindex="5"></td>
                    <td width="23%" align="right">Email</td>
                    <td width="32%" align="left"><input type="email" name="email" tabindex="6"></td>
                  </tr>
                  <tr>   
                    <td scope="row" align="right">Grade</td>
                    <td align="left">
                    <select name="class"  tabindex="7">
                     <option></option>
                     <option>9</option>
                     <option>10</option>
                     <option>11</option>
                     <option>12</option>
                    </select>
                    <select name="section" tabindex="8">
                     <option></option>
                     <option>A</option>
                     <option>B</option>
                     <option>C</option>
                     <option>D</option>
                     <option>E</option>
                     <option>F</option>
                     <option>G</option>
                    </select></td>
                    <td align="right">Date of Birth</td>
                    <td align="left">
                    <select name="date" tabindex="9">
                      <option></option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                      <option>11</option>
                      <option>12</option>
                      <option>13</option>
                      <option>14</option>
                      <option>15</option>
                      <option>16</option>
                      <option>17</option>
                      <option>18</option>
                      <option>19</option>
                      <option>20</option>
                      <option>21</option>
                      <option>22</option>
                      <option>23</option>
                      <option>24</option>
                      <option>25</option>
                      <option>26</option>
                      <option>27</option>
                      <option>28</option>
                      <option>29</option>
                      <option>30</option>
                      <option>31</option>
                    </select>
                      <select name="month" tabindex="10">
                        <option></option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                      <select name="year" tabindex="11">
                        <option></option>
                        <option>1991</option>
                        <option>1992</option>
                        <option>1993</option>
                        <option>1994</option>
                        <option>1995</option>
                        <option>1996</option>
                        <option>1997</option>
                        <option>1998</option>
                        <option>1999</option>
                        <option>2000</option>
                      </select></td>
                  </tr>
                  <tr>
                    <td scope="row" align="right">Username </td>
                    <td align="left"><input type="text" name="reg_username" tabindex="12"></td>
                    <td align="right">Password</td>
                    <td align="left"><input name="reg_password" type="password" maxlength="32" tabindex="13"></td>
                  </tr>
                  <tr>
                    <td align="right">Repeat Password</td>
                    <td align="right"><div align="left">
                      <input name="reg_repeat_password" type="password" maxlength="32" tabindex="14">
                    </div></td>
                    <td align="right">Contact (Phone) number</td>
                    <td align="left"><input name="contact_number" type="text"  tabindex="15"></td>
                    </tr>
                  <tr>
                  <td align="right">Security Question </td><td align="left"><input type="text" name="security_question" tabindex="16"></td>
                    <td align="right">Security Answer</td>
                    <td align="left"><input type="text" name="security_answer" tabindex="17"></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="right"><input type="submit" name="register" value="Register" tabindex="18"></td>
                    <td colspan="2" align="left"><input type="reset" name="reset" value="Reset" tabindex="19"></td>
                    </tr>
                  </form>      
                  </table>
                </td>
              </tr>
            </table>
            <?php
		}
		?>
         </center>
		 <!-- InstanceEndEditable -->
      </div>
    </div>
  </body>
<!-- InstanceEnd --></html>