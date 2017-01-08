<?php
	
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$title = "Connectez-vous !";
	$style = "../style/index.css";
	
	
	gk_cb_html_debut($title, $style);
	echo '<header>',
		'<p id="titre">Connectez-vous </p>',
	'</header>';
	
	echo '<aside>',
	'</aside>';
	
	echo '<div id="connection">';	
	
	if(!isset($_POST['btnValider'])) {
		cbl_aff_form();
	}
	
	function cbl_aff_form() {
			
				echo '<form method=POST action="connection.php">',
					'<table border=1 cellpadding=5>';
						echo gk_cb_from_ligne("Pseudo", "<input type=text name=txtPseudo size=20 />", "right", "");
						echo gk_cb_from_ligne("Mot de passe", "<input type=password name=txtPasse size=20 />", "right", "");
						
						
						echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValider value=Connexion />", "", "right");
					echo  '</table>',
				'</form>';	
				
				
	}
	
	
	
	
	

	if(isset($_POST['btnValider'])) {
		$bd = gk_cb_bd_connection();
	
		
		$pseudo = trim($_POST['txtPseudo']);
		$pass = trim($_POST['txtPasse']);
	
		$pass_encrypt = encrypt_donnee($pass);
		
		$S = "SELECT *
			FROM USER
			WHERE pseudo = '$pseudo'
			AND password = '$pass_encrypt'";
			
	
		$R = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		$D = mysqli_fetch_assoc($R);
	
		
		
		$count = mysqli_num_rows($R);
		
		
		$erreur = array();
	
		if($count != 1) {
			$erreur[] = "Problème d'authentification";
		}
		


		if (count($erreur) == 0) {
			
			session_start();
			
			$_SESSION['id'] = $D['id'];
			$_SESSION['nom'] = $D['nom'];
			$_SESSION['pseudo'] = $D['pseudo'];
		

			mysqli_close($bd);
			header ('location: cabinet.php');
			exit();
		}

		else {
				
				$_POST['txtPseudo'] = '';
				$_POST['txtPasse'] = '';


				
				echo '</br>';
				echo cbl_aff_form();

		}

	}	

	gk_cb_html_fin();
	

?>
