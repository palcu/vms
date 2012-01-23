<?php
	require_once('authorize.php');
	//Get data
	$id=$_GET['id'];
	//Query database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "DELETE FROM points WHERE id='$id'";
	mysqli_query($dbc, $query);
	mysqli_close($dbc);
?>
<script type="text/javascript">window.location = "points.php"</script>