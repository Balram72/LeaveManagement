<?php
session_start();
if(isset($_SESSION['manage_name']))
{
	session_destroy();
	?>
		<script>
			alert("logout succcessfully")
			window.location.assign("../index.php");
		</script>
	<?php
}
else
{
	?>
		<script>
			alert("you are login frist")
			window.location.assign("login.php");
		</script>
	<?php
}
