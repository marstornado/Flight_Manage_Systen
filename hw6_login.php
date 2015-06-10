<?php session_start();?>
<?php
		mb_internal_encoding('UTF-8');
		mb_http_output('UTF-8');

		if ($_GET["username"] !== NULL && $_GET["username"] != "" &&
			$_GET["password"] !== NULL && $_GET["password"] != "")
		{
       		include 'sunapeedb.php';
			$db = new SunapeeDB();
			$db->connect();
			$returnVal = $db->hw6_login($_GET["username"], $_GET["password"]);
			if ($returnVal == 1) {
				$_SESSION["username"] = $_GET["username"];
				$_SESSION["id"] = $db->get_my_id($_GET["username"]);

				if ($db->is_emp($_SESSION["id"])) {
					header('Location: hw6_emp.php');
				}
				else {
					header('Location: hw6_customer.php');
				}
			}
			else if ($returnVal == 0) {
				echo '<p align="center">'. "Wrong username or Password!\n" .'</p>';
				print "<form action='login.html'>
					   <center><button type='submit' name='return'>Return</center>
					   </form>";
			}
			$db->disconnect();
		}
		else {
			print("Input Invalid. Try Again!\n");
		}
?>