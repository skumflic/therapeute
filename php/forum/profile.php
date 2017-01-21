<?php
	//This page display the profile of an user
	include('config.php');
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link href="<?php echo $design; ?>/style.css" rel="stylesheet" title="Style" />
			<title>Profil d'un utilisateur</title>
		</head>
		<body>
			<div class="header">
				<a href="<?php echo $url_home; ?>"><img src="<?php echo $design; ?>/images/logo.png" alt="Forum" /></a>
			</div>
			<div class="content">
<?php
				if(isset($_SESSION['pseudo']))
				{
					$nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['id'].'" and user1read="no") or (user2="'.$_SESSION['id'].'" and user2read="no")) and id2="1"'));
					$nb_new_pm = $nb_new_pm['nb_new_pm'];
?>
					<div class="box">
						<div class="box_left">
							<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <a href="users.php">Liste des utilisateurs</a> &gt; Profile of an user
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
							<a href="<?php echo $url_home; ?>">Forum Index</a> &gt; <a href="users.php">Liste des utilisateurs</a> &gt; Profile of an user
						</div>
						<div class="box_right">
							<a href="signup.php">Sign Up</a> - <a href="login.php">Login</a>
						</div>
						<div class="clean"></div>
					</div>
<?php
				}
				if(isset($_GET['id']))
				{
					$id = intval($_GET['id']);
					$dn = mysql_query('select pseudo, mail, lienPhoto from USER, THERAPEUTE where THERAPEUTE.id = USER.id AND THERAPEUTE.id = "'.$id.'" AND USER.id="'.$id.'"');
					if(mysql_num_rows($dn)>0)
					{
						$dnn = mysql_fetch_array($dn);
?>
						This is the profile of "<?php echo htmlentities($dnn['pseudo']); ?>" :
<?php
						if($_SESSION['id']==$id)
						{
?>
							<br /><div class="center"><a href="edit_profile.php" class="button">Edit my profile</a></div>
<?php
						}
?>
						<table style="width:500px;">
							<tr>
								<td><?php
									if($dnn['lienPhoto']!='')
									{
										echo '<img src="../../upload/'.htmlentities($dnn['lienPhoto'], ENT_QUOTES, 'UTF-8').'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
									}
									else
									{
										echo 'This user has no avatar.';
									}
?>								</td>
								<td class="left">
									<h1><?php echo htmlentities($dnn['pseudo'], ENT_QUOTES, 'UTF-8'); ?></h1><br />
									Email: <?php echo htmlentities($dnn['mail'], ENT_QUOTES, 'UTF-8'); ?><br />
								</td>
							</tr>
						</table>
<?php
						if(isset($_SESSION['pseudo']) and $_SESSION['pseudo']!=$dnn['pseudo'])
						{
?>
							<br /><a href="new_pm.php?recip=<?php echo urlencode($dnn['pseudo']); ?>" class="big">Envoyer un MP à "<?php echo htmlentities($dnn['pseudo'], ENT_QUOTES, 'UTF-8'); ?>"</a>
<?php
						}
					}
					else
					{
						echo 'This user doesn\'t exist.';
					}
				}
				else
				{
					echo 'The ID of this user is not defined.';
				}
?>
			</div>
			<div class="foot"><a href="http://www.webestools.com/scripts_tutorials-code-source-26-simple-php-forum-script-php-forum-easy-simple-script-code-download-free-php-forum-mysql.html">Simple PHP Forum Script</a> - <a href="http://www.webestools.com/">Webestools</a></div>
		</body>
	</html>
