<?php
	require_once('authorize.php');
	require_once('header.php');
	require_once('navmenu.php');
?>
		<h1>Modifica voluntar</h1>
<?php
	
	//Grab data
	if (isset($_GET['id'])){
		$id=$_GET['id'];
		//Query database
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "SELECT * FROM voluntar WHERE id='$id'";
		$data = mysqli_query($dbc, $query);
		$row = mysqli_fetch_array($data);
		mysqli_close($dbc);
		$name=$row['nume'];
		$email=$row['email'];
	}
	else if (isset($_POST['modify'])){
		//Update the entry in the database
		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query="UPDATE voluntar SET nume='$name', email='$email' WHERE id='$id'";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);
		echo "		<p>Voluntarul a fost modificat.</p>";
	}
	else if (isset($_POST['delete'])){
		//Delete entry from database
		$id=$_POST['id'];
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query="DELETE FROM voluntar WHERE id=$id";
		mysqli_query($dbc, $query);
		mysqli_close($dbc);
		echo "		<p>Voluntarul a fost sters.</p>";
		
		//Reset form
		$id="";
		$name="";
		$email="";
	}
	else{
		echo "		<p>Nu a fost specificat niciun voluntar</p>\r\n";
	}
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
				<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
				<label for="name">Nume</label>
				<input type="text" name="name" id="name" value="<?php echo $name; ?>" />
			</p>
			<p>
				<label for="email">E-mail</label>
				<input type="text" name="email" id="email" value="<?php echo $email; ?>" />
			</p>
			<p>
				<input type="submit" value="Modifica" name="modify" />
				<input type="submit" value="Sterge" name="delete" />
			</p>
		</form>
		<p><a href="volunteer.php">Mergi înapoi la pagina de voluntari<a></p>
<?php require_once('footer.php'); ?>
