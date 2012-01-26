		<div id="sidebar">
			<h2>Meniu</h2>
			<ul id="menu"><?php
if (!isset($_SERVER['PHP_AUTH_USER'])) echo'
				<li><a href="'.HOME_PAGE.'">Acasa</a></li>
				<li><a href="authentication.php">Autentificare</a></li>
';
else echo'
				<li><a href="index.php">Acasa</a></li>
				<li><a href="volunteer.php">Voluntari</a></li>
				<li><a href="activity.php">Activitati</a></li>
				<li><a href="points.php">Puncte</a></li>
				<li><a href="password.php">Modificare parola</a></li>
';?>
			</ul>
		</div>
