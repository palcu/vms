<?php
	require_once('authorize.php');
	require_once('header.php');
	require_once('navmenu.php');
?>
		<h1>Adaugă voluntari</h1>
<?php
	require_once('constants.php');
	
	if (isset($_POST['submit'])){
		
		//Grab values
		$name=$_POST['name'];
		$email=$_POST['email'];
		$admin=$_SERVER['PHP_AUTH_USER'];
		
		//Verify values
		if(!empty($name) && !empty($email)) {
			
			//Query database
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$query = "INSERT INTO voluntar (nume,email,admin) VALUES ('$name','$email','$admin')";
			mysqli_query($dbc, $query);
			mysqli_close($dbc);
			
			//Confirm
			echo '<p>Operatia a avut succes.</p>';
			
			// Clear the score data to clear the form
      $name = "";
      $email = "";
		}
		else{
			//Error
			echo '<p class="error">Mai verifica o data formularul!</p>';
		}
	}
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
				<label for="name">Nume:</label>
				<input type="text" name="name" id="name" />
			</p>
			<p>
				<label for="email">E-mail:</label>
				<input type="text" name="email" id="email" />
			</p>
			<p>
				<input type="submit" value="Adauga" name="submit" />
			</p>
		</form>
		<hr />

		<h1>Modifică voluntari</h1>
		<table>
<?php
	//Query database for volunteers
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT id,nume,email,data_adaugare,admin FROM voluntar";
	$data = mysqli_query($dbc, $query);
	mysqli_close($dbc);
	
	//Cycle through volunteers
	while ($row = mysqli_fetch_array($data)){
		echo '			<tr>
				<td>'.$row['id'].'</td>
				<td>'.$row['nume'].'</td>
				<td>'.$row['email'].'</td>
				<td><a href="volunteer_modify.php?id='.$row['id'].'">Modifica</a></td>
			</tr>'."\n";
	}
?>
		</table>
<?php require_once('footer.php'); ?>