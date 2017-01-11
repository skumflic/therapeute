<?php
	
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$title = "Inscription";
	$style = "../style/index.css";
	
	
	gk_cb_html_debut($title, $style);
	echo '<header>',
		'<p id="titre">Inscription </p>',
	'</header>';
	
	
	echo '<div id="connection">';
	
	if(!isset($_POST['btnValider'])) {
		aff_form();
		$_POST['txtPseudo'] = $_POST['txtPasse'] = $_POST['txtVerif'] = '';
		$_POST['txtNom'] = $_POST['txtMail'] = '';
		$_POST['txtPrenom'] = $_POST['txtTelephone'] = '';
	}	
	
	
	//Si le bouton de validation a été demandé
	if(isset($_POST['btnValider'])) {
		
		
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
			$isModerateur = 0;
			
			
			$pass_encrypt = encrypt_donnee($pass);
			
			//Requete d'insertion 
			$S = "INSERT INTO USER 
				(nom, prenom, pseudo, mail, password, telephone, isModerateur)
					VALUES 
				('$nom', '$prenom','$pseudo','$mail','$pass_encrypt','$telephone','$isModerateur')";
			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		
			$S = "INSERT INTO THERAPEUTE
				(id, isAccepted, cleLogiciel, titre, description, isCertified, couleur, skin, lienPhoto)
					VALUES
				('$ID', false, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		
			//On peut démarrer la session 
			session_start();
			
			$_SESSION['id'] = $D['id'];
			$_SESSION['nom'] = $D['nom'];
			$_SESSION['prenom'] = $D['prenom'];
			
			mysqli_close($bd);
			//Redirection vers compte.php
			header ('location: cabinet.php');
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
		
		
	
	
	
	echo '</div>';	
	
	
	
	gk_cb_html_fin();
	
?>

