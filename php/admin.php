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
	$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
	
	echo '</br>';
	echo '<h4>Utilisateur en demande</h4>';
	echo '<form method="GET" action="admin.php?id=',$id,'&amp;">';
		echo '<table border=1 cellpadding=5>';
		
		
		while($enr = mysqli_fetch_assoc($r)) {
			$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
			$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
			$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
			$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
			$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
			$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
			$mail=htmlentities($enr['mail'],ENT_QUOTES, 'ISO-8859-1');
			
			if ($moderateur == 0) {
				echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. " - " .$mail. "</label>", "<input type=submit name=btnValider1 value='Accepter $pseudo'>", "right", "");
			}
			else break;
	
		}
		echo '</table>';	
	echo '</form>';
	
	echo '</br>';
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	
	echo '<h4>Ajouter mod&eacute;rateur</h4>';
	echo '<form method="GET" action="admin.php?id=',$id,'&amp;">';
		echo '<table border=1 cellpadding=5>';
		
		
		while($enr = mysqli_fetch_assoc($r)) {
			$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
			$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
			$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
			$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
			$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
			$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
			$mail=htmlentities($enr['mail'],ENT_QUOTES, 'ISO-8859-1');
			
			if ($moderateur == 1) {
				echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. " - " .$mail. "</label>", "<input type=submit name=btnValider2 value='Ajouter moderateur $pseudo'>", "right", "");
			}
	
		}		
		
		echo '</table>';	
	echo '</form>';
	
	echo '</br>';
	
	
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	
	echo '<h4>Enlever moderateur</h4>';
	echo '<form method="GET" action="admin.php?id=',$id,'&amp;">';
		echo '<table border=1 cellpadding=5>';
		
		
		while($enr = mysqli_fetch_assoc($r)) {
			$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
			$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
			$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
			$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
			$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
			$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
			$mail=htmlentities($enr['mail'],ENT_QUOTES, 'ISO-8859-1');
			
			if ($moderateur > 1 && $moderateur < 4) {
				echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. " - " .$mail. "</label>", "<input type=submit name=btnValider3 value='Enlever moderateur $pseudo'>", "right", "");
			}
	
		}		
		
		echo '</table>';	
	echo '</form>';
	
	echo '</br>';
	echo '</br>';
	echo '<h3>Ajouter moderateur  </h3>';
	
	
	if(!isset($_POST['btnValider4'])) {
		cbl_aff_form();
		$_POST['txtPseudo'] = $_POST['txtPasse'] = $_POST['txtVerif'] = '';
		$_POST['txtNom'] = $_POST['txtMail'] = '';
		$_POST['txtPrenom'] = $_POST['txtTelephone'] = '';
	}	
	
	function cbl_aff_form() {
		
			echo '<form method=POST action="admin.php">',
				'<table border=1 cellpadding=5>';
					echo gk_cb_from_ligne("<label>Renseigner nom</label>", "<input type=text name=txtNom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner prenom</label>", "<input type=text name=txtPrenom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner pseudo</label>", "<input type=text name=txtPseudo size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner le mot de passe</label>", "<input type=password name=txtPasse size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Repeter le mot de passe</label>", "<input type=password name=txtVerif size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Donner une adresse email</label>", "<input type=text name=txtMail size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner numero de telephone</label>", "<input type=text name=txtTelephone size=20/>", "right", "");
					
					
					
					echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValider4 value=Go />", "", "right");

				echo '</table>',
			'</form>';

	}
	
	function cbl_new_user() {
		
		$bd = gk_cb_bd_connection();

		$nom = trim($_POST['txtNom']);
		$prenom = trim($_POST['txtPrenom']);
		$pass = trim($_POST['txtPasse']);
		$passVerif = trim($_POST['txtVerif']);
		$pseudo = trim($_POST['txtPseudo']);
		$mail = trim($_POST['txtMail']);
		$telephone = trim($_POST['txtTelephone']);


	
		$S = "SELECT COUNT(*) as count
			FROM USER
			WHERE pseudo ='$pseudo'";
	
		$R = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		$D = mysqli_fetch_assoc($R);
	
		$count = htmlentities($D['count'], ENT_QUOTES, 'ISO-8859-1');
	
		$erreur = array();
	
		if ($count != 0) 
			$erreur[] = "Le pseudo doit etre change";
		
		else if (strlen($pseudo) < 4 || strlen($pseudo) > 30) {
			$erreur[] = "Le pseudo " . $pseudo . " doit avoir de 4 à 30 caractères";
		}
		
		if ($pass == '') 
			$erreur[] = "Le mot de passe est obligatoire";
			
		if (strlen($telephone) != 10)
			$erreur[] = "Le numero de telephone est incorrecte";
	
		if ($pass != $passVerif)
			$erreur[] = "Le mot de passe est different dans les 2 zones";
	
		if ($nom == '')
			$erreur[] = "Le nom est obligatoire";
			
		if ($prenom == '') 
			$erreur[] = "Le prenom est obligatoire";
		
		if ((strpos($mail, "@") === false && strpos($mail, ".") === false) || ($mail == ''))
			$erreur[] = "L'adresse mail est obligatoire / L'adresse mail n'est pas valide";
		

		return $erreur;
	}
	
	if(isset($_POST['btnValider4'])) {
		
		
		$bd = gk_cb_bd_connection();
	
		$pseudo = trim($_POST['txtPseudo']);
		$prenom = trim($_POST['txtPrenom']);
		$pass = trim($_POST['txtPasse']);
		$passVerif = trim($_POST['txtVerif']);
		$nom = trim($_POST['txtNom']);
		$mail = trim($_POST['txtMail']);
		$telephone = trim($_POST['txtTelephone']);
		
		

		$erreur = cbl_new_user($_POST);
		
		
		
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
				$erreur = cbl_new_user($_POST);	
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
				echo cbl_aff_form();

		}

	}
	
	
	echo '</br>';
	
	
	echo '<h3>Supprimer un moderateur  </h3>';
	

	$sql="SELECT USER.id, nom, prenom, pseudo, THERAPEUTE.isBlocked, isModerateur, mail
			FROM USER, THERAPEUTE
			WHERE USER.id = THERAPEUTE.id
			ORDER BY isModerateur";
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	
	
	
	echo '</br>';
	echo '<form method="GET" action="admin.php?id=',$id,'&amp;">';
		echo '<table border=1 cellpadding=5>';
		
		
		while($enr = mysqli_fetch_assoc($r)) {
			$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
			$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
			$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
			$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
			$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
			$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
			$mail=htmlentities($enr['mail'],ENT_QUOTES, 'ISO-8859-1');
			
			if ($moderateur == 2) {
				echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. " - " .$mail. "</label>", "<input type=submit name=btnValider5 value='Supprimer $pseudo'>", "right", "");
			}
			//~ else break;
	
		}
		echo '</table>';	
	echo '</form>';

	
	if(isset($_GET['btnValider1'])) {
		$bd = gk_cb_bd_connection();
		
		$res = $_GET['btnValider1'];
		
		
		
		$pseudo = substr($res, 9);
		$S = "UPDATE USER SET
				isModerateur = 1
				WHERE USER.pseudo = '$pseudo'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		header('location: admin.php');
		
	
	}
	
	if(isset($_GET['btnValider2'])) {
		$bd = gk_cb_bd_connection();
		
		$res = $_GET['btnValider2'];
	
		$pseudo = substr($res, 19);
		$S = "UPDATE THERAPEUTE, USER SET
					isModerateur = isModerateur + 2
					WHERE THERAPEUTE.id = USER.id
					AND USER.pseudo = '$pseudo'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		
		header('location: admin.php');
	}
	
	if(isset($_GET['btnValider3'])) {
		$bd = gk_cb_bd_connection();
		
		$res = $_GET['btnValider3'];
	
		$pseudo = substr($res, 19);
		$S = "UPDATE THERAPEUTE, USER SET
					isModerateur = isModerateur - 2
					WHERE THERAPEUTE.id = USER.id
					AND USER.pseudo = '$pseudo'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		
		header('location: admin.php');
	}
	
	
	if(isset($_GET['btnValider5'])) {
		$bd = gk_cb_bd_connection();
		
		$res = $_GET['btnValider5'];
	
		$pseudo = substr($res, 10);
		$S = "DELETE FROM USER
			WHERE USER.pseudo = '$pseudo'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		
		header('location: admin.php');
	}
	mysqli_close($bd);
	gk_cb_html_fin();
	ob_end_flush();
?>
