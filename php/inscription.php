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
	
	if(!isset($_POST['btnValiderInscription'])) {
		aff_form("inscription");
		$_POST['txtPseudo'] = $_POST['txtPasse'] = $_POST['txtVerif'] = '';
		$_POST['txtNom'] = $_POST['txtMail'] = '';
		$_POST['txtPrenom'] = $_POST['txtTelephone'] = '';
	}	
	
	
	//Si le bouton de validation a été demandé
	if(isset($_POST['btnValiderInscription'])) {
		
		
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
			
			$rand=rand(100000,100000000);
			
			$pass_encrypt = encrypt_donnee($pass);
			
			//Requete d'insertion 
			$S = "INSERT INTO USER 
				(nom, prenom, pseudo, mail, password, telephone, isModerateur)
					VALUES 
				('$nom', '$prenom','$pseudo','$mail','$pass_encrypt','$telephone','$isModerateur')";
			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		
			$S = "INSERT INTO THERAPEUTE
				(id, isAccepted, cleLogiciel, titre, description, isCertified, couleur, skin, lienPhoto, isVerified, random)
					VALUES
				('$ID', false, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, '$rand')";
			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
	
		
			
				
				
			$subject = "Email Verification mail";
			$headers = "From: corentin_25@hotmail.fr \r\n";
			$headers .= "Reply-To: corentin_25@hotmail.fr \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$message = '<html><body>';
			$message.='<div style="width:550px; background-color:#CC6600; padding:15px; font-weight:bold;">';
			$message.='Email Verification mail';
			$message.='</div>';
			$message.='<div style="font-family: Arial;">Confiramtion mail have been sent to your email id<br/>';
			$message.='click on the below link in your verification mail id to verify your account ';
			$message.="<a href='localhost/therapeute/php/confirmation.php?id=$ID&email=$mail&confirmation_code=$rand'>click</a>";		
			$message.='</div>';
			$message.='</body></html>';

			mail($mail,$subject,$message,$headers);
			
			$sql="SELECT mail
				FROM USER
				WHERE isModerateur = 4";
			$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
			
			
			$headers = "From: no-reply@re-energetique \r\n";
			$headers .= "Reply-To: no-reply@re-energetique \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			while($enr = mysqli_fetch_assoc($r)) {
				$mail_admin=htmlentities($enr['mail'],ENT_QUOTES,'ISO-8859-1');
				mail($mail_admin,"Nouveau therapeute sur re-energetique !", "Un nouveau therapeute est arrivé sur le site, allez dans la partie administration pour l'accepter",$headers);
			}
			
			echo '<p>un mail de confirmation vous a &eacute;t&eacute; envoy&eacute;</p>';
			
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
				echo aff_form("inscription");

		}

	}	
		
		
	
	
	
	echo '</div>';	
	
	
	
	gk_cb_html_fin();
	
?>

