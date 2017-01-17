<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$bd = gk_cb_bd_connection();
	
	$title = "Reseaux";
	$style = "../style/index.css";
	
	gk_cb_html_debut($title, $style);

	
	session_start();
	
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
	
	$id_user = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	
	echo '<header>',
		'<p id="titre">Mes reseaux sociaux </p>',
	'</header>';	
	
	

	
	$sql="SELECT *
			FROM RESEAU";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		
		
	while($enr = mysqli_fetch_assoc($r)) {
		$libelle=htmlentities($enr['libelle'],ENT_QUOTES,'ISO-8859-1');
		$idReseau=htmlentities($enr['idReseau'],ENT_QUOTES,'ISO-8859-1');
		
		$sql_url="SELECT THERA_RESEAU.URL
			FROM THERA_RESEAU
			WHERE THERA_RESEAU.idReseau = '$idReseau'
			AND THERA_RESEAU.idTherapeute = '$id_user'";
		$r_url = mysqli_query($bd, $sql_url) or gk_bd_erreur($bd, $sql_url);
		
		
		if (mysqli_num_rows($r_url) > 0) {
			$enr_url = mysqli_fetch_assoc($r_url);
			$URL=htmlentities($enr_url['URL'],ENT_QUOTES,'ISO-8859-1');
			echo '<form method=POST action="reseau.php">';
				echo '<table border=1 cellpadding=5>';
					echo gk_cb_from_ligne("<label>$libelle</label>",  "<input type=text name=txtURL value='$URL' size=30/>", "right", "");
					
					echo gk_cb_from_ligne("" , "<input type=hidden name=btnValiderUpdate value='$idReseau'> <input type=submit value='Go'>", "", "right");
				echo '</table>';	
			echo '</form>';
		}
		else {
			echo '<form method=POST action="reseau.php">';
				echo '<table border=1 cellpadding=5>';
					echo gk_cb_from_ligne("<label>$libelle</label>",  "<input type=text name=txtURL size=30/>", "right", "");
					
					echo gk_cb_from_ligne("" , "<input type=hidden name=btnValiderInsert value='$idReseau'> <input type=submit value=Go />", "", "right");
				echo '</table>';	
			echo '</form>';
		}
	}
	
	
	
	
	if(isset($_POST['btnValiderUpdate'])) {
		
		$URL = trim($_POST['txtURL']);

		$URL=mysqli_real_escape_string($bd, $URL);
		
		$id = $_POST['btnValiderUpdate'];
		
		$S = "UPDATE THERA_RESEAU SET
				URL = '$URL'
				WHERE THERA_RESEAU.idTherapeute = '$id_user'
				AND THERA_RESEAU.idReseau = '$id'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		header('location: reseau.php');
		
	
	}
	
	if(isset($_POST['btnValiderInsert'])) {
		
		$URL = trim($_POST['txtURL']);

		$URL=mysqli_real_escape_string($bd, $URL);
		
		$id = $_POST['btnValiderInsert'];
		
		$S = "INSERT INTO THERA_RESEAU
				(idTherapeute, idReseau, URL)
					VALUES 
				('$id_user', '$id', '$URL')";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		header('location: reseau.php');
		
	
	}
	
	

	

	gk_cb_html_fin();
?>
