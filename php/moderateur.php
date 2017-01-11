<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$bd = gk_cb_bd_connection();
	
	$title = "Espaces Mod&eacute;ration";
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
	
	if ($moderateur_user < 2) {
		header('location: accueil.php');
		exit();
	}
	
	echo '<header>',
		'<p id="titre">Espace mod&eacute;ration </p>',
	'</header>';	
	
	
	
	echo '<h3>Rechercher un therapeute</h3>';
	
	
	echo '<form method=POST action="moderateur.php">',
		'<table id=larecherche border=1 cellpadding=5>';
			echo gk_cb_from_ligne("<input type=text name=txtRecherche  size=30 />", "<input class=lesub type=submit name=btnRecherche value=Recherche />", "right", "");

		echo '</table>';	
	echo '</form>';
		
	
	
	
	
	if(isset($_POST['btnRecherche'])) {
		
		$needle = $_POST['txtRecherche'];

		//On recherche l'aiguille dans la botte de foin (haystack)
		$sql="SELECT DISTINCT USER.id, nom, prenom, pseudo, THERAPEUTE.isBlocked, isModerateur
			FROM USER, THERAPEUTE
			WHERE USER.id = THERAPEUTE.id
			AND pseudo LIKE '%$needle%'
			OR nom LIKE '%$needle%'
			OR prenom LIKE '%$needle%'
			GROUP BY USER.id";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	
		
		afficherForm($r);
	
	}
	
	
	
	
	
	
	echo '<h3>G&eacute;rer les th&eacute;rapeutes  </h3>';
	
	
	$sql="SELECT USER.id, nom, prenom, pseudo, THERAPEUTE.isBlocked, isModerateur
			FROM USER, THERAPEUTE
			WHERE USER.id = THERAPEUTE.id";
			
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	afficherBloquer($r);
	
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	afficherModerateur($r);
	
	
	
	
	

	
	
	function afficherBloquer($r) {
		
		echo '<h4>Bloquer/Debloquer un therapeute</h4>';
			echo '<table border=1 cellpadding=5>';
			while($enr = mysqli_fetch_assoc($r)) {
				$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
				$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
				$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
				$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
				$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
				$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
				
				echo '<form method="POST" action="moderateur.php">';
					
					if ($bloque == 0) 
						echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. "</label>", "<input type=hidden name=btnValiderBloquer value='$id'> <input type=submit value='Bloquer'>", "right", "");
					else
						echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. "</label>", "<input type=hidden name=btnValiderBloquer value='$id'> <input type=submit value='D&eacute;bloquer'>", "right", "");

						
				echo '</form>';
			}
		echo '</table>';
		

	}
	
	function afficherModerateur($r) {
				
		echo '<h4>Ajouter un moderateur</h4>';
			echo '<table border=1 cellpadding=5>';
			while($enr = mysqli_fetch_assoc($r)) {
				$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
				$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
				$pseudo=htmlentities($enr['pseudo'],ENT_QUOTES,'ISO-8859-1');
				$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
				$bloque=htmlentities($enr['isBlocked'],ENT_QUOTES, 'ISO-8859-1');
				$moderateur=htmlentities($enr['isModerateur'],ENT_QUOTES, 'ISO-8859-1');
				echo '<form method="POST" action="moderateur.php">';

					if ($moderateur == 1) 
						echo gk_cb_from_ligne("<label>"	.$nom. " " .$prenom. "</label>", "<input type=hidden name=btnValiderAddMod value='$id'> <input type=submit value='Ajouter moderateur'>", "right", "");
				
				
						
				echo '</form>';
			}
		echo '</table>';
	}
	
	if(isset($_POST['btnValiderBloquer'])) {
		$bd = gk_cb_bd_connection();
		
		$id = trim($_POST['btnValiderBloquer']);	

		$S = "UPDATE THERAPEUTE, USER SET
				isBlocked = (case when isBlocked = 0 then 1 else 0 end)
				WHERE THERAPEUTE.id = USER.id
				AND USER.id = '$id'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		header('location: moderateur.php');
		
	
	}
	
	if(isset($_POST['btnValiderAddMod'])) {
		$bd = gk_cb_bd_connection();
		
		$id = trim($_POST['btnValiderAddMod']);
	
		$S = "UPDATE THERAPEUTE, USER SET
					isModerateur = isModerateur + 2
					WHERE THERAPEUTE.id = USER.id
					AND USER.id = '$id'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		
		header('location: moderateur.php');
	}
	
	mysqli_close($bd);
	gk_cb_html_fin();
	ob_end_flush();
?>
