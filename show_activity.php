<?php
	require_once('header.php');
	require_once('navmenu.php'); 
	require_once('constants.php');		
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$id=mysqli_real_escape_string($dbc,trim($_GET['id']));
	$name=mysqli_real_escape_string($dbc,trim($_GET['name']));
	$date=mysqli_real_escape_string($dbc,trim($_GET['date']));
	mysqli_close($dbc);
	if(empty($name)||!is_numeric($id)||!is_numeric($date))
		die ("Bad idea");
	
		//Query database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query = "SELECT v.nume name, p.points points, p.description description
FROM points AS p
INNER JOIN voluntar AS v ON p.id_volunteer=v.id
WHERE p.id_activity=$id
ORDER BY points DESC";
	$data = mysqli_query($dbc, $query);
	mysqli_close($dbc);
?>
		<h1><?php echo $name.' - '.date("d.m.Y",$date); ?></h1>
		<table>
<?php
	echo'			<tr>
				<td>Nume</td>
				<td>Puncte</td>
				<td>Descriere</td>
			</tr>
';
	while($row=mysqli_fetch_array($data)){
		echo'			<tr>
				<td>'.$row['name'].'</td>
				<td>'.$row['points'].'</td>
				<td>'.$row['description'].'</td>
			</tr>
';
	}
?>
		</table>
		<p><a href="index.php">Mergi înapoi la pagina principală<a></p>
<?php require_once('footer.php'); ?>