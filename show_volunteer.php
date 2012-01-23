<?php
	require_once('header.php');
	require_once('navmenu.php'); 
	require_once('connect_vars.php');		
	//Retrieve data and validate
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$id=mysqli_real_escape_string($dbc,trim($_GET['id']));
	$name=mysqli_real_escape_string($dbc,trim($_GET['name']));
	mysqli_close($dbc);
	if(empty($name)||!is_numeric($id))
		die ("Bad idea");
	
	//Query database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT p.points AS points, a.name AS name, a.date AS date, p.description AS description
FROM points AS p
INNER JOIN activity AS a ON p.id_activity=a.id
WHERE p.id_volunteer=$id
ORDER BY date";
	$data = mysqli_query($dbc, $query);
	mysqli_close($dbc);
?>
		<h1><?php echo $name; ?></h1>
		<table>
<?php
	echo '			<tr>
				<td>Puncte</td>
				<td>Activitate</td>
				<td>Data</td>
				<td>Detalii</td>
			</tr>';
	while($row=mysqli_fetch_array($data)){
		echo '			<tr>
				<td>'.$row['points'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.date("d.m.Y",$row['date']).'</td>
				<td>'.$row['description'].'</td>
			</tr>'."\r\n";
	}
?>
		</table>
		<p><a href="index.php">Mergi înapoi la pagina principală<a></p>
<?php require_once('footer.php'); ?>