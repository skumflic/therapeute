<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	require("bibli_html.php");
	
	$bd = gk_cb_bd_connection();
	session_start();
	
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
	
	$id = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
$photo_msg="";
if(isset($_POST['btnValiderPhoto'])) {

    $target_dir = "../upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $imageName = $id. '.' . $imageFileType;
    $target_file = $target_dir.$imageName;
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $photo_msg.="File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $photo_msg.= "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $photo_msg.="Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $photo_msg.= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $photo_msg.= "The file ". $imageName. " has been uploaded.";

            $S = "UPDATE THERAPEUTE 
					SET lienPhoto = '". $imageName . "'
					WHERE id = '$id'";
            mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
            header('location: infoperso.php');
            exit();
        } else {
            $photo_msg.="Sorry, there was an error uploading your file.";
        }
    }
}
	$title = "Information personnelle";
	html_debut($title);
	html_header();
$moderateur_user=$_SESSION['isModerateur'];
html_nav(1, $moderateur_user, "menu_infoperso");


$page_principal_color="#3eb6d1";
html_menu_espace($moderateur_user, 1);

	echo '<div id="content">
			<div class="sub_content" id="info_perso_sub_content">
				<div class="left_side">';
html_sub_menu();

			echo '</div><div class="right_side">';
			echo '<div id="div_infoperso">';
			echo '<h1>Information personnelle</h1>';
			part_info_perso($bd, $id);
			echo '</div>
				<div id="div_password">';
echo '<h1>Changer mot de passe</h1>';
			part_password($bd, $id);
;
			echo '</div><div id="div_photo">';

echo '<h1>Votre photo de profil</h1>';
			part_photo($bd, $id, $photo_msg);
			echo '</div>
				<div id="div_reseau">';
			echo '<h1>Reseau sociaux</h1>';
			part_reseau($bd, $id);
			echo '</div>
				<div id="div_site_vitrine">';
echo '<h1>Information pour la site vitrine</h1>';
part_info_therapeute($bd, $id);

	echo '</div></div></div></div>';

html_footer($page_principal_color);
html_fin();
	

		
function html_sub_menu(){
	echo '<ul id="infoperso_sub_menu">
			<li id="sm_infoperso" class="sub_li">Information personnelle</li>
			<li id="sm_password" class="sub_li">Changer mot de passe</li>
			<li id="sm_photo" class="sub_li">Profile photo</li>
			<li id="sm_reseau" class="sub_li">Reseaux sociaux</li>
			<li id="sm_site_vitrine" class="sub_li">Information pour la page vitrine</li>
</ul>';
}



	
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
		$remerciements = trim($_POST['txtRemerciements']);
		$aboutme = trim($_POST['txtAboutme']);
		
		
		
		$cleLogiciel=mysqli_real_escape_string($bd, $cleLogiciel);
		$titre=mysqli_real_escape_string($bd, $titre);
		$description=mysqli_real_escape_string($bd, $description);
		$couleur=mysqli_real_escape_string($bd, $couleur);
		$skin=mysqli_real_escape_string($bd, $skin);
		$remerciements=mysqli_real_escape_string($bd, $remerciements);
		$aboutme=mysqli_real_escape_string($bd, $aboutme);

		$S = "UPDATE THERAPEUTE SET
					cleLogiciel = '$cleLogiciel',
					description = '$description',
					titre = '$titre',
					remerciements = '$remerciements',
					aboutme = '$aboutme'
				WHERE id = '$id'";

		
		mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
	
		header ('location: infoperso.php');
	
	}
		
	

	
	
	if(isset($_POST['btnValiderUpdate'])) {
		
		$URL = trim($_POST['txtURL']);

		$URL=mysqli_real_escape_string($bd, $URL);
		
		$idReseau = $_POST['btnValiderUpdate'];
		
		$S = "UPDATE THERA_RESEAU SET
				URL = '$URL'
				WHERE THERA_RESEAU.idTherapeute = '$id'
				AND THERA_RESEAU.idReseau = '$idReseau'";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		header('location: infoperso.php');
		
	
	}
	
	if(isset($_POST['btnValiderInsert'])) {
		
		$URL = trim($_POST['txtURL']);

		$URL=mysqli_real_escape_string($bd, $URL);
		
		$idReseau = $_POST['btnValiderInsert'];
		
		$S = "INSERT INTO THERA_RESEAU
				(idTherapeute, idReseau, URL)
					VALUES 
				('$id', '$idReseau', '$URL')";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
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


	function part_info_perso($bd, $id){

        $sql="SELECT nom, prenom, mail, telephone
			FROM USER
			WHERE id = '$id'";
        $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
        $enr = mysqli_fetch_assoc($r);

        $nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
        $prenom=htmlentities($enr['prenom'],ENT_QUOTES,'ISO-8859-1');
        $mail=htmlentities($enr['mail'],ENT_QUOTES,'ISO-8859-1');
        $telephone=htmlentities($enr['telephone'],ENT_QUOTES,'ISO-8859-1');
        form_info_perso($nom, $prenom, $mail, $telephone);
    }

    function form_info_perso($nom, $prenom, $mail, $telephone){
        echo '
			<form method=POST action="infoperso.php" class="form_with_lbl">
				<table>
					<tr>
						<td>
							<label>Nom</label>
							<input type=text name=txtNom value='.$nom.' size=37 >
						</td>
					</tr>
					<tr>
						<td>
							<label>Prenom</label>
							<input type=text name=txtPrenom value='.$prenom.' size=30>
						</td>
					</tr>
					<tr>
						<td>
							<label>E-mail</label>
							<input type=text name=txtMail value='.$mail.' size=30>
						</td>
					</tr>
					<tr>
						<td>
							<label>Telephone</label>
							<input type=text name=txtTelephone value='.$telephone.' size=30>
						</td>
					</tr>
					<tr><td><input type=submit name=btnValiderPerso value=Valider /></td></tr>
				</table>
     </form>';
	}

    function part_info_therapeute($bd, $id){
        $sql="SELECT cleLogiciel, titre, description, couleur, skin, remerciements, aboutme
			FROM THERAPEUTE
			WHERE id = '$id'";
        $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
        $enr = mysqli_fetch_assoc($r);

        $cleLogiciel=htmlentities($enr['cleLogiciel'],ENT_QUOTES,'ISO-8859-1');
        $titre=htmlentities($enr['titre'],ENT_QUOTES,'ISO-8859-1');
        $description=htmlentities($enr['description'],ENT_QUOTES,'ISO-8859-1');
        $couleur=htmlentities($enr['couleur'],ENT_QUOTES,'ISO-8859-1');
        $skin=htmlentities($enr['skin'],ENT_QUOTES,'ISO-8859-1');
        $remerciements=htmlentities($enr['remerciements'],ENT_QUOTES,'ISO-8859-1');
        $aboutme=htmlentities($enr['aboutme'],ENT_QUOTES,'ISO-8859-1');
        form_therapeute_part($titre, $description, $aboutme, $remerciements, $cleLogiciel);
	}

	function form_therapeute_part($titre, $description, $aboutme, $remerciements, $cleLogiciel){
        echo '
			<form method=POST action="infoperso.php" class="form_with_lbl">
				<table>
					<tr>
						<td>
							<label>Votre titre de page</label>
							<input type=text name=txtTitre value="'.$titre.'" size=37 />
						</td>
					</tr>
					<tr>
						<td>
							<label>Description</label>
							<textarea name=txtDescription rows=6 cols=53>'.$description.'</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<label>A propos de moi</label>
							<textarea name=txtAboutme rows=6 cols=53>'.$aboutme.'</textarea>
						</td>
					</tr>
				
					<tr>
						<td>
							<label>Remerciements</label>
							<textarea name=txtRemerciements rows=6 cols=53>'.$remerciements.'</textarea>
						</td>
					</tr>
				
					<tr>
						<td>
							<label>La cl&eacute; logicielle</label>
							<input type=text name=txtLogiciel value="'.$cleLogiciel.'" size=30/>
						</td>
					</tr>
					<tr><td><input  type=submit name=btnValiderThera value=Valider /></td></tr>
				</table>
     </form>';

	}

function part_reseau($bd, $id){
    $sql="SELECT *
			FROM RESEAU";
    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);


    while($enr = mysqli_fetch_assoc($r)) {
        $libelle=htmlentities($enr['libelle'],ENT_QUOTES,'ISO-8859-1');
        $idReseau=htmlentities($enr['idReseau'],ENT_QUOTES,'ISO-8859-1');
        $sql_url="SELECT THERA_RESEAU.URL
			FROM THERA_RESEAU
			WHERE THERA_RESEAU.idReseau = '$idReseau'
			AND THERA_RESEAU.idTherapeute = '$id'";
        $r_url = mysqli_query($bd, $sql_url) or gk_bd_erreur($bd, $sql_url);
		$URL="";
		$is_exists=false;
        if (mysqli_num_rows($r_url) > 0) {
            $enr_url = mysqli_fetch_assoc($r_url);
            $URL=htmlentities($enr_url['URL'],ENT_QUOTES,'ISO-8859-1');
            $is_exists=true;
        }
        form_reseau($libelle,  $idReseau, $is_exists, $URL);
    }
}
function form_reseau($libelle,  $idReseau, $is_exists, $URL=""){
echo '<form method=POST action="infoperso.php" class="form_with_lbl form_social_network">	';
    insert_or_update($is_exists, $idReseau);
		echo '
			<table>
				<tr>				
					<td class="sn_url"><label>'.$libelle.'</label><input type=text name=txtURL value="'.$URL.'" size=30/> <input type=submit value=save></td>
					
				</tr>
			</table></form>';
}

function insert_or_update($is_exists, $idReseau){
    if($is_exists==true){
        echo '<input type=hidden name=btnValiderUpdate value='.$idReseau.'> ';
    }else{
        echo '<input type=hidden name=btnValiderInsert value='.$idReseau.'> ';
    }
}

function part_password($bd, $id){

    $sql="SELECT password
			FROM USER
			WHERE id = '$id'";
    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
    $enr = mysqli_fetch_assoc($r);

    $ancienPass = htmlentities($enr['password'],ENT_QUOTES,'ISO-8859-1');
    $ancienPass = de_encrypt_donnee($ancienPass);

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

            header('location: infoperso.php');

        }
    }
    form_password();
}

function form_password(){
    echo '<form method=POST action="infoperso.php" class="form_with_lbl">
				<table>
					<tr>
						<td>
							<label>Ancien mot de pass</label>
							<input type=password name=txtAncien size=20 >
						</td>
					</tr>
					<tr>
						<td>
							<label>Nouveau mot de passe</label>
							<input type=password name=txtPasse size=20 >
						</td>
					</tr>
					<tr>
						<td>
							<label>Répetér nouveau mot de passe</label>
							<input type=password name=txtVerif size=20 >
						</td>
					</tr>
					
					<tr><td><input class=lesub type=submit name=btnValiderPass value=Valider /></td></tr>
				</table>
     </form>';

}
function part_photo($bd, $id, $photo_msg){
    $sql="SELECT lienPhoto
			FROM THERAPEUTE
			WHERE id = '$id'";
    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
    $enr = mysqli_fetch_assoc($r);

    $lienPhoto=htmlentities($enr['lienPhoto'],ENT_QUOTES,'ISO-8859-1');
    form_photo($lienPhoto, $photo_msg);
}

function form_photo($lienPhoto, $photo_msg){
    actual_photo($lienPhoto, $photo_msg);
    echo '<form method=POST action="infoperso.php" enctype="multipart/form-data" class="form_with_lbl">';

    echo '<span>Telecharger une nouvele photo de profil</span>
			<input type=file name=fileToUpload id=fileToUpload class="input_file"> 
    		<span class="input_file_container"><input type="text" class="input_file_name" disabled="disabled">
    		<label class="input_file_button">Selectionner</label></span>
			<input  type=submit name=btnValiderPhoto value=Sauvegarder >
     </form>';

}
function actual_photo($lienPhoto, $photo_msg){

	echo '<label class="photo_upload_msg">'.$photo_msg.'</label><div>';
	if($lienPhoto==""){
		echo '<label>Vous n\'avez pas encore choisi votre photo de profil</label>
				<img id="profile_photo_anonym" src="../images/user-avatar.png"> ';

	}else{
        echo '<label>Votre photo actuelle:</label>
			<img id="profile_photo" src="../upload/'.$lienPhoto.'" >';
	}
	echo '</div>';
}

?>
