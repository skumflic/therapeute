<?php
	//This page displays a list of all registered members
	include('config.php');
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
			<title>Liste de tous les utilisateurs</title>
		</head>
		<body>
			<div class="header">
				<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Espace Membre" /></a>
			</div>
			<div class="content">
<?php
				if(isset($_SESSION['pseudo']))
				{
					$nb_new_pm = mysqli_fetch_array(mysqli_query($mydb, 'select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['id'].'" and user1read="no") or (user2="'.$_SESSION['id'].'" and user2read="no")) and id2="1"'));
					$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
					<div class="box">
						<div class="box_left">
							<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; Liste de tous les utilisateurs
						</div>
						<div class="box_right">
							<a href="list_pm.php">Your messages(<?php echo $nb_new_pm; ?>)</a> - <a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><?php echo htmlentities($_SESSION['pseudo'], ENT_QUOTES, 'UTF-8'); ?></a> (<a href="login.php">Logout</a>)
						</div>
						<div class="clean"></div>
					</div>
<?php
				}			
				else
				{
?>
					<div class="box">
						<div class="box_left">
							<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; Liste de tous les utilisateurs
						</div>
						<div class="box_right">
							<a href="signup.php">Sign Up</a> - <a href="login.php">Login</a>
						</div>
						<div class="clean"></div>
					</div>
<?php
				}
?>
				Liste de tous les utilisateurs :
				<table>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Email</th>
					</tr>
<?php
					$req = mysqli_query($mydb, 'select id, pseudo, mail from USER WHERE isModerateur != 2');
					while($dnn = mysqli_fetch_array($req))
					{
?>
						<tr>
							<td><?php echo $dnn['id']; ?></td>
							<td><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['pseudo'], ENT_QUOTES, 'UTF-8'); ?></a></td>
							<td><?php echo htmlentities($dnn['mail'], ENT_QUOTES, 'UTF-8'); ?></td>
						</tr>
<?php
					}
?>
				</table>
			</div>
			<div class="foot"><a href="http://www.webestools.com/scripts_tutorials-code-source-26-simple-php-forum-script-php-forum-easy-simple-script-code-download-free-php-forum-mysql.html">Simple PHP Forum Script</a> - <a href="http://www.webestools.com/">Webestools</a></div>
		</body>
	</html>
