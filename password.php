<?php
	require_once('authorize.php');
	require_once('header.php');
	require_once('navmenu.php');
?>
		<h1>Modifică parola</h1>
<?php
	require_once('connect_vars.php');
	//Verify password
	if (isset($_POST['submit'])){
		$old=$_POST['old'];
		$new=$_POST['new'];
		$new2=$_POST['new2'];
		$user=$_SERVER['PHP_AUTH_USER'];
		
		//Query database for old password
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$query = "SELECT user_password FROM admin WHERE user_name='$user'";
		$data = mysqli_query($dbc, $query);
		mysqli_close($dbc);
		$old_db=mysqli_fetch_array($data);
		
		if ($old==$old_db['user_password'] && $new==$new2){
			//Update database with new password
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$query="UPDATE admin SET user_password='$new' WHERE user_name='$user'";
			mysqli_query($dbc, $query);
			mysqli_close($dbc);
			echo '<p>Parola a fost schimbată.</p>';
		}
		else{
			echo '<p>Operația nu a avut succes.</p>';
		}
	}
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<p>
				<label for="old">Parola veche</label>
				<input type="password" id="old" name="old" />
			</p>
			<p>
				<label for="new">Parola nouă</label>
				<input type="password" id="new" name="new" />
			</p>
			<p>
				<label for="new2">Confirmare parolă</label>
				<input type="password" id="new2" name="new2" />
			</p>
			<p>
				<input type="submit" value="Trimite" name="submit" />
			</p>
		</form>
<?php require_once('footer.php'); ?>