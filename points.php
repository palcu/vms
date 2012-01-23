<?php
	require_once('authorize.php');
	require_once('header.php');
	require_once('navmenu.php');
?>
		<h1>Adaugă puncte</h1>
<?php
	require_once('connect_vars.php');

	if(isset($_POST['submit'])){
		//Grab values
		$volunteer=$_POST['volunteer'];
		$admin=$_SERVER['PHP_AUTH_USER'];
		$activity=$_POST['activity'];
		$points=$_POST['points'];
		$description=$_POST['description'];

		//Verify
		if ($volunteer && !empty($activity) && !empty($points) && !empty($description)){
			//Query database
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			foreach($volunteer as $v){
				$query="INSERT INTO points (id_volunteer,id_activity,points,description,admin) VALUES ('$v','$activity','$points','$description','$admin')";
				mysqli_query($dbc, $query);
			}
			mysqli_close($dbc);

			//Confirm
			echo '<p>Operația a avut succes.</p>';

			//Clear values
			$volunteer="";
			$activity="";
			$points="";
			$description="";
		}
		else{
			//Error
			echo'<p>Operația nu a avut succes.</p>';
		}
	}
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
				<label for="volunteer">Voluntar</label>
				<select name="volunteer[]" multiple="multiple" size="10">
<?php
	//Query database for volunteers
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query="SELECT id,nume FROM voluntar";
	$result=mysqli_query($dbc, $query);
	mysqli_close($dbc);
	while($row=mysqli_fetch_array($result)){
		echo '					<option value="'.$row['id'].'">'.$row['nume'].'</option>'."\r\n";
	}
?>
				</select>
			</p>
			<p>
				<label for="activity">Activitate</label>
				<select name="activity">
<?php
	//Query database for activities
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query="SELECT id,name,date FROM activity";
	$result=mysqli_query($dbc, $query);
	mysqli_close($dbc);
	while($row=mysqli_fetch_array($result)){
		echo '					<option value="'.$row['id'].'">'.$row['name'].' - '.date("d.m.Y",$row['date']).'</option>'."\r\n";
	}
?>
				</select>
			</p>
			<p>
				<label for="points">Puncte</label>
				<input type="text" name="points" maxlength="3" />
			</p>
			<p>
				<label for="description">Descriere</label>
				<textarea name="description"></textarea>
			</p>
			<p>
				<input type="submit" value="Adaugă" name="submit" />
			</p>
		</form>
		<hr />

		<h1>Modifică puncte</h1>
		<table>
<?php
	//Query database for points
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT p.id, a.name as activity, v.nume as volunteer, p.points, p.description, p.admin, p.date_creation
FROM points as p
INNER JOIN activity as a ON p.id_activity=a.id
INNER JOIN voluntar as v ON p.id_volunteer=v.id
ORDER BY p.date_creation DESC";
	$data = mysqli_query($dbc, $query);
	mysqli_close($dbc);

	//Cycle through points
	while ($row=mysqli_fetch_array($data)){
		echo'			<tr>
				<td>'.$row['activity'].'</td>
				<td>'.$row['volunteer'].'</td>
				<td>'.$row['points'].'</td>
				<td>'.$row['description'].'</td>
				<td>'.$row['admin'].'</td>
				<td>'.$row['date_creation'].'</td>
				<td><a href="points_delete.php?id='.$row['id'].'">Șterge</a></td>
			</tr>
';
	}
?>
		</table>
<?php require_once('footer.php'); ?>