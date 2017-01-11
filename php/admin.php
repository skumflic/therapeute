<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$bd = gk_cb_bd_connection();

	$title = "Espaces Admin";
	$style = "../style/index.css";
	
	gk_cb_html_debut($title, $style);

	
	session_start();
	
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
	
	$id_user = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	
	$sql="SELECT isModerateur
		FROM USER
		WHERE USER.id = '$id_user'";
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	$enr = mysqli_fetch_assoc($r);
	$moderateur_user=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
	
	if ($moderateur_user < 4) {
		header('location: accueil.php');
		exit();
	}
	
	
	echo '<header>',
		'<p id="titre">Espace administration </p>',
	'</header>';	
	
	
		
	
	
	echo '<h3>G&eacute;rer les utilisateurs  </h3>';
	
	
	

	$sql="SELECT USER.id, nom, prenom, pseudo, THERAPEUTE.isBlocked, isModerateur, mail
			FROM USER, THERAPEUTE
			WHERE USER.id = THERAPEUTE.id
			ORDER BY isModerateur";
			
	cbl_utilisateur_en_demande($sql);
	
	cbl_ajouter_moderateur($sql);
	
	cbl_supprimer_moderateur($sql);
	
	
	
	
	echo '<h3>Ajouter moderateur  </h3>';
	
	
	if(!isset($_POST['btnValiderAjout'])) {
		aff_form();
		$_POST['txtPseudo'] = $_POST['txtPasse'] = $_POST['txtVerif'] = '';
		$_POST['txtNom'] = $_POST['txtMail'] = '';
		$_POST['txtPrenom'] = $_POST['txtTelephone'] = '';
	}	
	

	
	
	
	if(isset($_POST['btnValiderAjout'])) {
		
		
		$bd = gk_cb_bd_connection();
	
		$pseudo = trim($_POST['txtPseudo']);
		$prenom = trim($_POST['txtPrenom']);
		$pass = trim($_POST['txtPasse']);
		$passVerif = trim($_POST['txtVerif']);
		$nom = trim($_POST['txtNom']);
		$mail = trim($_POST['txtMail']);
		$telephone = trim($_POST['txtTelephone']);
		
		

		$erreur = new_user($_POST);
		
		
		
		//Si le nombre d'erreur est 0, on va pouvoir insérer dans la base de donnée
		if (count($erreur) == 0) {

			$prenom=mysqli_real_escape_string($bd, $prenom);
			$telephone=mysqli_real_escape_string($bd, $telephone);
			$nom=mysqli_real_escape_string($bd, $nom);
			$pseudo=mysqli_real_escape_string($bd, $pseudo);
			$pass=mysqli_real_escape_string($bd, $pass);
			$mail=mysqli_real_escape_string($bd, $mail);
			$isModerateur = 2;
			
			//Requete d'insertion 
			$S = "INSERT INTO USER 
				(nom, prenom, pseudo, mail, password, telephone, isModerateur)
					VALUES 
				('$nom', '$prenom','$pseudo','$mail','$pass','$telephone','$isModerateur')";
			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		
			$S = "INSERT INTO THERAPEUTE
				(id, isAccepted, cleLogiciel, titre, description, isCertified, couleur, skin, lienPhoto)
					VALUES
				('$ID', true, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		
			//On peut démarrer la session 
			session_start();
			
			$_SESSION['id'] = $D['id'];
			$_SESSION['nom'] = $D['nom'];
			$_SESSION['prenom'] = $D['prenom'];
			

			//Redirection vers compte.php
			header ('location: admin.php');
			exit();
		}
		
		//Sinon il faudra afficher les erreurs
		else {
				$erreur = array();
				$erreur = new_user($_POST);	
				$taille = count($erreur);

				echo '<h3>Les erreurs suivantes ont ete detectees :</h3>';
					echo '<ul>';
						for ($i = 0 ; $i < $taille ; $i++) 
							echo '<li>', $erreur[$i], '</li>';
					echo '</ul>';
						
			
				
					$_POST['txtPseudo'] = '';
					$_POST['txtPasse'] = '';
					$_POST['txtVerif'] = '';
					$_POST['txtNom'] = '';
					$_POST['txtMail'] = '';
					$_POST['txtPrenom'] = '';
					$_POST['txtTelephone'] = '';
					$_POST['txtAdresse'] = '';

				
				echo '</br>';
				echo aff_form();

		}

	}
	
	
	echo '</br>';
	
	
	echo '<h3>Supprimer un moderateur non therapeute  </h3>';
	

	$sql="SELECT USER.id, nom, prenom, pseudo, THERAPEUTE.isBlocked, isModerateur, mail
			FROM USER, THERAPEUTE
			WHERE USER.id = THERAPEUTE.id
			ORDER BY isModerateur";
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	
	
	

		echo '<table border=1 cellpadding=5>';
		while($enr = mysqli_fetch_assoc($r)) {
			$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
			$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
			$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
			$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
			$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
			$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
			echo '<form method="POST" action="admin.php">';

				if ($moderateur == 2)
					echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. "</label>", "<input type=hidden name=btnValiderRemoveModNotTherapeute value='$id'> <input type=submit value='Supprimer moderateur'>", "right", "");
			
			
					
			echo '</form>';
		}
	echo '</table>';

	
	
	
	
	
	if(isset($_POST['btnValiderAccept'])) {
		$bd = gk_cb_bd_connection();
		
		$id = $_POST['btnValiderAccept'];
		
		
		$S = "UPDATE USER SET
				isModerateur = 1
				WHERE USER.id = '$id'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		header('location: admin.php');
		
	
	}
	
	if(isset($_POST['btnValiderAddMod'])) {
		$bd = gk_cb_bd_connection();
		
		$id = $_POST['btnValiderAddMod'];
		$S = "UPDATE THERAPEUTE, USER SET
					isModerateur = isModerateur + 2
					WHERE THERAPEUTE.id = USER.id
					AND USER.id = '$id'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		
		header('location: admin.php');
	}
	
	if(isset($_POST['btnValiderRemoveMod'])) {
		$bd = gk_cb_bd_connection();
		
		$id = trim($_POST['btnValiderRemoveMod']);
		$S = "UPDATE THERAPEUTE, USER SET
					isModerateur = isModerateur - 2
					WHERE THERAPEUTE.id = USER.id
					AND USER.id = '$id'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		
		header('location: admin.php');
	}
	
	
	if(isset($_POST['btnValiderRemoveModNotTherapeute'])) {
		$bd = gk_cb_bd_connection();
		
		$id = $_GET['btnValiderRemoveModNotTherapeute'];
		$S = "DELETE FROM USER
			WHERE USER.pseudo = '$pseudo'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		
		header('location: admin.php');
	}
	
	
	
	
	
	function cbl_utilisateur_en_demande($sql) {
		//--------------------------------	UTILISATEUR EN DEMANDE
		$bd = gk_cb_bd_connection();
		$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			
			echo '</br>';
			echo '<h4>Accepter un utilisateur</h4>';
					echo '<table border=1 cellpadding=5>';
					while($enr = mysqli_fetch_assoc($r)) {
						$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
						$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
						$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
						$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
						$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
						$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
						$mail=htmlentities($enr['mail'],ENT_QUOTES, 'ISO-8859-1');
						echo '<form method="POST" action="admin.php">';

							if ($moderateur == 0) 
								echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. "-" .$mail ."</label>", "<input type=hidden name=btnValiderAccept value='$id'> <input type=submit value='Accepter'>", "right", "");
						
						
								
						echo '</form>';
					}
				echo '</table>';	
			
	
		echo '</br>';
	}
	
	
	function cbl_ajouter_moderateur($sql) {
		//--------------------------------	AJOUTER UN MODERATEUR
			$bd = gk_cb_bd_connection();
			$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
			
			
			echo '<h4>Ajouter un moderateur</h4>';
					echo '<table border=1 cellpadding=5>';
					while($enr = mysqli_fetch_assoc($r)) {
						$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
						$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
						$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
						$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
						$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
						$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
						echo '<form method="POST" action="admin.php">';

							if ($moderateur == 1) 
								echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. "</label>", "<input type=hidden name=btnValiderAddMod value='$id'> <input type=submit value='Ajouter moderateur'>", "right", "");
						
						
								
						echo '</form>';
					}
				echo '</table>';
	
		echo '</br>';
	}
	
	
	function cbl_supprimer_moderateur($sql) {
		//--------------------------------	SUPPRIMER UN MODERATEUR
			$bd = gk_cb_bd_connection();
			$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
				
			
			echo '<h4>Enlever un moderateur</h4>';
					echo '<table border=1 cellpadding=5>';
					while($enr = mysqli_fetch_assoc($r)) {
						$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
						$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
						$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
						$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
						$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
						$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
						echo '<form method="POST" action="admin.php">';

							if ($moderateur > 1 && $moderateur < 4)
								echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. "</label>", "<input type=hidden name=btnValiderRemoveMod value='$id'> <input type=submit value='Enlever moderateur'>", "right", "");
						
						
								
						echo '</form>';
					}
				echo '</table>';
	
		echo '</br>';
		echo '</br>';
	}
	
	
	
	mysqli_close($bd);
	gk_cb_html_fin();
	ob_end_flush();
?>
