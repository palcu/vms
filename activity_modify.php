<?php
	require_once('authorize.php');
	require_once('header.php');
	require_once('navmenu.php');
?>
		<h1>Modifică activitate</h1>
<?php
	require_once('constants.php');
	
	//Grab data
	if (isset($_GET['id'])){
		$id=$_GET['id'];
		//Query database
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "SELECT * FROM activity WHERE id=$id";
		$data = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($data);
		mysqli_close($dbc);
		$name=$row['name'];
		$date=$row['date'];
	}
	else if (isset($_POST['modify'])){
		//Update the entry in the database
		$id=$_POST['id'];
		$name=$_POST['name'];
		$date=strtotime($_POST['date']);
		$admin=$_SERVER['PHP_AUTH_USER'];
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query="UPDATE activity SET name='$name', date='$date', admin='$admin' WHERE id='$id'";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);
		echo "		<p>Activitatea a fost modificată.</p>";
	}
	else if (isset($_POST['delete'])){
		//Delete entry from database
		$id=$_POST['id'];
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query="DELETE FROM activity WHERE id=$id";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);
		echo "		<p>Activitatea a fost ștearsă.</p>";
		
		//Reset form
		$name="";
		$date="";
	}
	else{
		echo "		<p>Nu a fost specificată nicio activitate</p>\r\n";
	}
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
				<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
				<label for="name">Nume</label>
				<input type="text" name="name" id="name" value="<?php echo $name; ?>" />
			</p>
			<p>
				<label for="email">Data</label>
				<input type="text" name="date" id="date" value="<?php if ($date) echo date("d.m.Y",$date); ?>" />
			</p>
			<p>
				<input type="submit" value="Modifica" name="modify" />
				<input type="submit" value="Sterge" name="delete" />
			</p>
		</form>
		<p><a href="activity.php">Mergi înapoi la pagina de activități<a></p>
<?php require_once('footer.php'); ?>