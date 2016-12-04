<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$bd = gk_cb_bd_connection();
	
	$title = "Cabinet";
	$style = "../style/index.css";
	
	gk_cb_html_debut($title, $style);

	
	session_start();
	
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
	
	$id = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	
	echo '<header>',
		'<p id="titre">Mes cabinets </p>',
	'</header>';	
	
	
	echo '<h3>Mes cabinets  </h3>';

	
	$sql="SELECT DISTINCT CABINET.nom, adresse, acces
			FROM THERAPEUTE, THERA_CAB, CABINET
			WHERE idTherapeute='$id'
			AND idCabinet = CABINET.id";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		
		
	while($enr = mysqli_fetch_assoc($r)) {
		$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
		$adresse=htmlentities($enr['adresse'],ENT_QUOTES,'ISO-8859-1');
		$acces=htmlentities($enr['acces'],ENT_QUOTES,'ISO-8859-1');
		
		
		echo '<form method=POST action="cabinet.php">';
			echo '<table border=1 cellpadding=5>';
				echo gk_cb_from_ligne("<label>Nom</label>", "<input type=text name=txtNom value='$nom' size=37 />", "right", "");
				echo gk_cb_from_ligne("<label>L'adresse</label>",  "<input type=text name=txtAdresse value='$adresse' size=30/>", "right", "");
				echo gk_cb_from_ligne("<label>Acces</label>", "<input type=text name=txtVille value='$acces' size=37 />", "right", "");
						
				echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValider1 value=Valider />", "", "right");
			echo '</table>';	
		echo '</form>';

	}
	
	
	
	
	
	
	echo '</br>';
	echo '</br>';
	echo '<h3>Ajouter cabinet d&eacute;j&agrave;</h3>';
	
	$sql="SELECT DISTINCT id, nom, adresse, acces
			FROM THERA_CAB, CABINET
			WHERE idCabinet = CABINET.id
			AND '$id' != idTherapeute ";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		
		
	
		
		
		
	echo '<select name="cabinet" id="cabinet">';
		while($enr = mysqli_fetch_assoc($r)) {
			$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
			$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
			$adresse=htmlentities($enr['adresse'],ENT_QUOTES,'ISO-8859-1');
			echo "<option value=".$id.">".$nom."</option>";
		}

	echo '</select>';		
	echo "<input class=lesub type=submit name=btnValider2 value=Valider />";
	
	
	
	
	echo '</br>';
	echo '</br>';
	echo '<h3>Nouveau cabinet</h3>';
	cbl_aff_form();
	
	
	
	
	function cbl_aff_form() {
		
			echo '<form method=POST action="cabinet.php">',
				'<table border=1 cellpadding=5>';
					echo gk_cb_from_ligne("<label>Renseigner nom cabinet</label>", "<input type=text name=txtNom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Donner une adresse physique</label>", "<input type=text name=txtAdresse size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Donner la ville</label>", "<input type=text name=txtVille size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Donner le code postal</label>", "<input type=text name=txtCodePostal size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner les acces du cabinet</label>", "<input type=text name=txtAcces size=40/>", "right", "");
					
					
					
					echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValider3 value=Je&nbsp;m'inscris />", "", "right");

				echo '</table>',
			'</form>';

	}
	
	
	//Si des modifications sont apporter au cabinet
	//~ if(isset($_POST['btnValider1'])) {
		//~ 
		//~ $bd = gk_cb_bd_connection();
	//~ 
		//~ $nom = trim($_POST['txtNom']);
		//~ $adresse = trim($_POST['txtAdresse']);
		//~ $ville = trim($_POST['txtVille']);
		//~ $codePostal = trim($_POST['txtCodePostal'];
		//~ $acces = trim($_POST['txtAcces']);
		//~ 
		//~ 
		//~ 
		//~ $nom=mysqli_real_escape_string($bd, $nom);
		//~ $adresse=mysqli_real_escape_string($bd, $adresse);
		//~ $ville=mysqli_real_escape_string($bd, $ville);
		//~ $codePostal=mysqli_real_escape_string($bd, $codePostal);
		//~ $acces=mysqli_real_escape_string($bd, $acces);
//~ 
//~ 
		//~ $S = "UPDATE CABINET SET 
					//~ nom = '$txtNom',
					//~ adresse = $adresse,
					//~ Ville = '$ville',
					//~ CodePostal = '$codePostal',
					//~ acceq = '$acces'
				//~ WHERE usID = $id";
				//~ 
				//~ 
		//~ 
		//~ 
		//~ mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
	//~ 
	//~ 
	//~ 
	//~ }
	
	//Si le bouton pour ajouter un cabinet dans la base est demandé 
	if(isset($_POST['btnValider3'])) {
		
		
		$bd = gk_cb_bd_connection();
	
		$nom = trim($_POST['txtNom']);
		$adresse = trim($_POST['txtAdresse']);
		$ville = trim($_POST['txtVille']);
		$codePostal = trim($_POST['txtCodePostal'];
		$acces = trim($_POST['txtAcces']);
		
		
		
		$nom=mysqli_real_escape_string($bd, $nom);
		$adresse=mysqli_real_escape_string($bd, $adresse);
		$ville=mysqli_real_escape_string($bd, $ville);
		$codePostal=mysqli_real_escape_string($bd, $codePostal);
		$acces=mysqli_real_escape_string($bd, $acces);
		
		//Requete d'insertion 
		$S = "INSERT INTO CABINET 
				(nom, adresse, ville, CodePostal acces)
					VALUES 
				('$nom', '$adresse', '$ville', '$CodePostal','$acces')";
			
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		$ID = mysqli_insert_id($bd);
		
		
		//Requete d'insertion 
		$S = "INSERT INTO THERA_CAB 
			(idTherapeute, idCabinet, isPrincipal)
				VALUES 
			('$id', '$ID','true')";			
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		$ID = mysqli_insert_id($bd);
		
		
		
	}	
		
	
	gk_cb_aff_footer();
	mysqli_close($bd);
	gk_cb_html_fin();
	ob_end_flush();
?>
