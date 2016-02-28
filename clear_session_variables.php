<?
$past = time() - 3600;
session_start();
foreach ( $_SESSION as $key => $value )
{
    echo $key." ".$value." ";
	#unset($_SESSION[$key]);
	if (isset($_SESSION[$key])){
		echo "  not deleted";
	}
	echo"<br />";
}
?>