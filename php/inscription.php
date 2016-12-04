<?php
	
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$title = "Inscription";
	$style = "../styles/index.css";
	
	gk_cb_html_debut($title, $style);
	echo '<header>',
		'<p id="expli">Pour vous inscrire il suffit de :</p>',
	'</header>';
	
	echo '<aside>',
	'</aside>';
	
	echo '<div id="connection">';
	
	if(!isset($_POST['btnValider'])) {
		cbl_aff_form();
		$_POST['txtPseudo'] = $_POST['txtPasse'] = $_POST['txtVerif'] = '';
		$_POST['txtNom'] = $_POST['txtMail'] = '';
		$_POST['txtPrenom'] = $_POST['txtTelephone'] = $_POST['txtAdresse'] = '';
	}	
		
			
	/**
	* Fonction qui va afficher le formulaire de 
	* la page inscription avec un tableau.
	*
	*/
		
	
	function cbl_aff_form() {
		
			echo '<form method=POST action="inscription.php">',
				'<table border=1 cellpadding=5>';
					echo gk_cb_from_ligne("<label>Renseigner votre nom</label>", "<input type=text name=txtNom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner votre prenom</label>", "<input type=text name=txtPrenom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner votre pseudo</label>", "<input type=text name=txtPseudo size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner le mot de passe</label>", "<input type=password name=txtPasse size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Repeter le mot de passe</label>", "<input type=password name=txtVerif size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Donner une adresse email</label>", "<input type=text name=txtMail size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Donner une adresse physique</label>", "<input type=text name=txtAdresse size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner votre numero de telephone</label>", "<input type=text name=txtTelephone size=20/>", "right", "");
					
					
					
					echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValider value=Je&nbsp;m'inscris />", "", "right");

				echo '</table>',
			'</form>';

	}

	
	/**
	* Fonction qui va faire les diverses 
	* vérifications pour savoir si un utilisateur 
	* s'est correctement enregistré.
	*
	*
	* @return 	array()		$erreur		Retour des erreurs.
	*/
		
	function cbl_new_user() {
		
		$bd = gk_cb_bd_connection();

		$nom = trim($_POST['txtNom']);
		$prenom = trim($_POST['txtPrenom']);
		$pass = trim($_POST['txtPasse']);
		$passVerif = trim($_POST['txtVerif']);
		$pseudo = trim($_POST['txtPseudo']);
		$mail = trim($_POST['txtMail']);
		$telephone = trim($_POST['txtTelephone']);
		$adresse = trim($_POST['txtAdresse']);


	
		$S = "SELECT COUNT(*) as count
			FROM USER
			WHERE login ='$pseudo'";
	
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
		mysqli_close($bd);
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
		$adresse = trim($_POST['txtAdresse']);
		
		

		$erreur = cbl_new_user($_POST);
		
		
		
		//Si le nombre d'erreur est 0, on va pouvoir insérer dans la base de donnée
		if (count($erreur) == 0) {

			$prenom=mysqli_real_escape_string($bd, $prenom);
			$telephone=mysqli_real_escape_string($bd, $telephone);
			$nom=mysqli_real_escape_string($bd, $nom);
			$pseudo=mysqli_real_escape_string($bd, $pseudo);
			$pass=mysqli_real_escape_string($bd, $pass);
			$mail=mysqli_real_escape_string($bd, $mail);
			$adresse=mysqli_real_escape_string($bd, $adresse);
			$isModerateur = 0;
			
			//Requete d'insertion 
			$S = "INSERT INTO USER 
				(nom, prenom, login, mail, password, adresse, telephone, isModerateur)
					VALUES 
				('$nom', '$prenom','$pseudo','$mail','$pass','$adresse','$telephone','$isModerateur')";
			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		
			//On peut démarrer la session 
			session_start();
			
			$_SESSION['id'] = $D['id'];
			$_SESSION['nom'] = $D['nom'];
			$_SESSION['prenom'] = $D['prenom'];
			

			//Redirection vers compte.php
			header ('location: compte.php');
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
				
	echo '</div>';	
	

	
	gk_cb_html_fin();
	

?>

