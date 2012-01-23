<?php
	require_once('authorize.php');
	require_once('header.php');
	require_once('navmenu.php');
?>
		<h1>Adaugă activitate</h1>
<?php
	require_once('connect_vars.php');
	
	if(isset($_POST['submit'])){
		//Grab values
		$name=$_POST['name'];
		$admin=$_SERVER['PHP_AUTH_USER'];
		$date=$_POST['date'];
		$date=strtotime($date);
		
		//Verify
		if (!empty($name)){
			//Query database
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$query="INSERT INTO activity (name,date,admin) VALUES ('$name','$date','$admin')";
			mysqli_query($dbc, $query);
			mysqli_close($dbc);
			
			//Confirm
			echo '<p>Activitatea a fost adăugată.</p>';
			
			//Clear values
			$name="";
			$date="";
		}
		else{
			//Error
			echo'<p>Operația nu a avut succes.</p>';
		}
	}
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
				<label for="name">Denumire</label>
				<input type="text" name="name" />
			</p>
			<p>
				<label for="date">Data</label>
				<input type="text" name="date" />
			</p>
			<p>
				<input type="submit" value="Adaugă" name="submit" />
			</p>
		</form>
		<hr />

		<h1>Modifică activități</h1>
		<table>
<?php
	//Query database for activities
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT id,name,date,admin,date_creation FROM activity";
	$data = mysqli_query($dbc, $query);
	mysqli_close($dbc);
	
	//Cycle through activities
	while ($row=mysqli_fetch_array($data)){
		echo'			<tr>
				<td>'.$row['id'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.date("d.m.Y",$row['date']).'</td>
				<td>'.$row['admin'].'</td>
				<td>'.$row['date_creation'].'</td>
				<td><a href="activity_modify.php?id='.$row['id'].'">Modifică</a></td>
			</tr>
';
	}
?>
		</table>
<?php require_once('footer.php'); ?>