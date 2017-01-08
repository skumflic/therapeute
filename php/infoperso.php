<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$bd = gk_cb_bd_connection();
	
	$title = "Informations";
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
		'<p id="titre">Informations personnels</p>',
	'</header>';	
	
	
	echo '<h3>Information personnel  </h3>';

	
	$sql="SELECT nom, prenom, mail, telephone
			FROM USER
			WHERE id = '$id'";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		$enr = mysqli_fetch_assoc($r);		
		
		$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
		$prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
		$mail=htmlentities($enr['mail'],ENT_QUOTES,'ISO-8859-1');
		$telephone=htmlentities($enr['telephone'],ENT_QUOTES,'ISO-8859-1');
		
		echo '<form method=POST action="infoperso.php">';
			echo '<table border=1 cellpadding=5>';
				echo gk_cb_from_ligne("<label>Nom</label>", "<input type=text name=txtNom value='$nom' size=37 />", "right", "");
				echo gk_cb_from_ligne("<label>Prenom</label>",  "<input type=text name=txtPrenom value='$prenom' size=30/>", "right", "");
				echo gk_cb_from_ligne("<label>Mail</label>", "<input type=text name=txtMail value='$mail' size=30/>", "right", "");
				echo gk_cb_from_ligne("<label>Telephone</label>", "<input type=text name=txtTelephone value='$telephone' size=30/>", "right", "");
				
				echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValiderPerso value=Valider />", "", "right");
			echo '</table>';	
		echo '</form>';

	
	
	
	
	
	
	echo '<h3>Informations therapeute</h3>';
	
	
	$sql="SELECT cleLogiciel, titre, description, couleur, skin
			FROM THERAPEUTE
			WHERE id = '$id'";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		$enr = mysqli_fetch_assoc($r);		

		$cleLogiciel=htmlentities($enr['cleLogiciel'],ENT_QUOTES,'ISO-8859-1');
		$titre=htmlentities($enr['titre'],ENT_QUOTES,'ISO-8859-1');
		$description=htmlentities($enr['description'],ENT_QUOTES,'ISO-8859-1');
		$couleur=htmlentities($enr['couleur'],ENT_QUOTES,'ISO-8859-1');
		$skin=htmlentities($enr['skin'],ENT_QUOTES,'ISO-8859-1');
		
		echo '<form method=POST action="infoperso.php">';
			echo '<table border=1 cellpadding=5>';
				echo gk_cb_from_ligne("<label>Votre titre de page</label>", "<input type=text name=txtTitre value='$titre' size=37 />", "right", "");
				echo gk_cb_from_ligne("<label>Description</label>",  "<textarea id=txtBio class=text name=txtDescription rows=12 cols=53>$description</textarea>", "right", "");
				echo gk_cb_from_ligne("<label>La cl&eacute; logicielle</label>", "<input type=text name=txtLogiciel value='$cleLogiciel' size=30/>", "right", "");
				
				
				
				echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValiderThera value=Valider />", "", "right");
			echo '</table>';	
		echo '</form>';
	
	
	
	
	
	
	
	
	
	
	
	echo '<h3>Param&egrave;tres</h3>';
	
	
	$sql="SELECT password
			FROM USER
			WHERE id = '$id'";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		$enr = mysqli_fetch_assoc($r);	
		
		$ancienPass = htmlentities($enr['password'],ENT_QUOTES,'ISO-8859-1');
		$ancienPass = de_encrypt_donnee($ancienPass);
		
	echo '<form method=POST action="infoperso.php" enctype="multipart/form-data">';
			echo '<table border=1 cellpadding=5>';
				if (isset($_POST['btnValiderPass'])) {
					if (changePass($ancienPass) == false) {
						echo "<p>Le mot de passe n'est pas pareil dans les deux </p>";
					}
					else {
						$e = changePass($ancienPass);
						$S = "UPDATE USER SET
							password = '$e'
						WHERE id = '$id'";
		
						mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			
						header ('location: infoperso.php');
						
					}
					
				}
				echo gk_cb_from_ligne("<label>Ancien mot de passe </label>", "<input type=password name=txtAncien size=20 />", "right", "");
				
				echo gk_cb_from_ligne("<label>Changer le mot de passe</label>", "<input type=password name=txtPasse size=20 />", "right", "");
				echo gk_cb_from_ligne("<label>R&eacutepeter le mot de passe</label>", "<input type=password name=txtVerif size=20 />", "right", "");
				echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValiderPass value=Valider />", "", "right");
			echo '</table>';	
		echo '</form>';
		
		
	$sql="SELECT lienPhoto
			FROM THERAPEUTE
			WHERE id = '$id'";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		$enr = mysqli_fetch_assoc($r);	
		
		$lienPhoto=htmlentities($enr['lienPhoto'],ENT_QUOTES,'ISO-8859-1');	
				
	echo '<form method=POST action="infoperso.php" enctype="multipart/form-data">';
			echo '<table border=1 cellpadding=5>';			
				echo gk_cb_from_ligne("<label>Votre photo actuelle</label>", "<img src='../upload/$lienPhoto' > 
												<p style=font-size:12px;>Images JPG</p> 
												<input type=file name=fileToUpload id=fileToUpload>", "right", "");
  
				echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValiderPhoto value=Valider />", "", "right");
			echo '</table>';	
		echo '</form>';
	
	
	
	
	//Si des modifications sont apportés aux informations personnelles
	if(isset($_POST['btnValiderPerso'])) {
		
		$bd = gk_cb_bd_connection();
	
		$nom = trim($_POST['txtNom']);
		$prenom = trim($_POST['txtPrenom']);
		$mail = trim($_POST['txtMail']);
		$telephone = trim($_POST['txtTelephone']);
		
		
		
		$nom=mysqli_real_escape_string($bd, $nom);
		$prenom=mysqli_real_escape_string($bd, $prenom);
		$mail=mysqli_real_escape_string($bd, $mail);
		$telephone=mysqli_real_escape_string($bd, $telephone);


		$S = "UPDATE USER SET
					nom = '$nom',
					prenom = '$prenom',
					mail = '$mail',
					telephone = '$telephone'
				WHERE id = '$id'";
				
				
		
		
		mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
	
		header ('location: infoperso.php');
	
	}
	
	//Si des modifications sont apportés pour le therapeute
	if(isset($_POST['btnValiderThera'])) {
		
		$bd = gk_cb_bd_connection();
	
		$cleLogiciel = trim($_POST['txtLogiciel']);
		$description = trim($_POST['txtDescription']);
		$titre = trim($_POST['txtTitre']);
		$couleur = trim($_POST['txtCouleur']);
		$skin = trim($_POST['txtSkin']);
		
		
		
		$cleLogiciel=mysqli_real_escape_string($bd, $cleLogiciel);
		$titre=mysqli_real_escape_string($bd, $titre);
		$description=mysqli_real_escape_string($bd, $description);
		$couleur=mysqli_real_escape_string($bd, $couleur);
		$skin=mysqli_real_escape_string($bd, $skin);


		$S = "UPDATE THERAPEUTE SET
					cleLogiciel = '$cleLogiciel',
					description = '$description',
					titre = '$titre'
				WHERE id = '$id'";
				
				
		
		
		mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
	
		header ('location: infoperso.php');
	
	}
	
	
	if(isset($_POST['btnValiderPhoto'])) {
		$target_dir = "../upload/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			$S = "UPDATE THERAPEUTE 
					SET lienPhoto = '". basename( $_FILES["fileToUpload"]["name"]). "'
					WHERE id = '$id'";
			
			mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			
			
			
		    } else {
			echo "Sorry, there was an error uploading your file.";
		    }
		}
		
		
		header('location: infoperso.php');
		
	}
	
	function changePass ($ancienPass) {
		
		
		if(isset($_POST['btnValiderPass'])) {
			
			$bd = gk_cb_bd_connection();
			
			$passAvant = trim($_POST['txtAncien']);	
			$passAvant = mysqli_real_escape_string($bd, $passAvant);
			
			$pass = trim($_POST['txtPasse']);	
			$pass = mysqli_real_escape_string($bd, $pass);
			
			$passVerif = trim($_POST['txtVerif']);	
			$passVerif = mysqli_real_escape_string($bd, $passVerif);
			
			if ($pass != $passVerif || $passAvant != $ancienPass) {
				return false;
			}
			else {
				$pass_encrypt = encrypt_donnee($pass);
				return $pass_encrypt;

			}
		}
	}
	

	gk_cb_html_fin();
?>
