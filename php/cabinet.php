<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	session_start();
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
	$bd = gk_cb_bd_connection();
	$id_user = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	
	$title = "Cabinet";
	$style = "../style/index.css";
	$js="../js/js_functions.js";
	gk_cb_html_debut_formation($title, $style, $js);

	
	
	echo '<header>',
		'<p id="titre">Mes cabinets </p>',
	'</header>';
	echo '<div class="content">
			<div class="leftside">';

	$sql="SELECT id, nom, adresse, acces, ville, codePostal, isPrincipal
			FROM THERA_CAB, CABINET
			WHERE idTherapeute = '$id_user'
			AND idCabinet = CABINET.id";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
		
		$forms_pas_principal="";
		$radio_buttons="";
		$idCabinetPrincipal=-1;
	while($enr = mysqli_fetch_assoc($r)) {
		$isPrincipal=htmlentities($enr['isPrincipal'],ENT_QUOTES,'ISO-8859-1');
		$idCabinet=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
		$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
		$adresse=htmlentities($enr['adresse'],ENT_QUOTES,'ISO-8859-1');
		$acces=htmlentities($enr['acces'],ENT_QUOTES,'ISO-8859-1');
		$ville=htmlentities($enr['ville'],ENT_QUOTES,'ISO-8859-1');
		$codePostal=htmlentities($enr['codePostal'],ENT_QUOTES,'ISO-8859-1');
		
		$radio_buttons.=input_radio_line($idCabinet, $nom, $ville, $isPrincipal);
		
		if($isPrincipal==1){
			$idCabinetPrincipal=$idCabinet;
			echo '<h3>Mon cabinet principal</h3>';
			echo aff_cabinet_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
		}else{
		  $forms_pas_principal.=aff_cabinet_pas_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
		}
	}
	echo '</br></br><h3 class="cabinetSecond">Mes cabinet secondaires<h3>';
	echo $forms_pas_principal;
	aff_radio_buttons($radio_buttons);
	echo '</div><div class="rightside">
			<h3>Ajouter cabinet d&eacute;j&agrave;</h3>';
	aff_list_des_cabinets($bd, $id_user);
	echo '</br>';
	echo '</br>';
	echo '<h3>Nouveau cabinet</h3>';
	cbl_aff_form_new();

	echo '</div>
	</div>';
	//Si des modifications sont apporter au cabinet
	if(isset($_POST['btn_sauvegarder'])) {
		$idCabinet = trim($_POST['txtCabinet']);
		$nom = trim($_POST['txtNom']);
		$adresse = trim($_POST['txtAdresse']);
		$ville = trim($_POST['txtVille']);
		$codePostal = trim($_POST['txtCodePostal']);
		$acces = trim($_POST['txtAcces']);
		update_cabinet($bd, $idCabinet, $nom, $adresse, $acces, $ville, $codePostal);

	}
	echo '<script type="text/javascript" src="', $js, '"></script>';
	gk_cb_html_fin();
	if(isset($_POST['btn_sauvegarder_radio'])) {
		$idCabinet = trim($_POST['radioCabinet']);
		if($idCabinet!=$idCabinetPrincipal)	{
			change_cabinet_principal($bd, $id_user, $idCabinet , $idCabinetPrincipal);
		}else{
			header ('location: cabinet.php');
		}
		
	}
	
	if(isset($_POST['btn_supprimer'])) {
		$idCabinet = trim($_POST['txtCabinet']);	
		delete_cabinet($bd, $idCabinet, $id_user);
	}
	
	
	//Si le bouton pour ajouter un cabinet déjà existant est demande 
	if(isset($_POST['btn_ajouterCE'])) {
		$bd = gk_cb_bd_connection();
		$isPrincipal=0;
		if($idCabinetPrincipal==-1){
			$isPrincipal=1;
		}
		$idCabinet = $_POST['cabinet'];
echo $idCabinet;
		$S = "INSERT INTO THERA_CAB 
				(idTherapeute, idCabinet, isPrincipal)
					VALUES 
				('$id_user', '$idCabinet', '$isPrincipal')";	
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		mysqli_close($bd);
		header('location: cabinet.php');
	}
	
	//Si le bouton pour ajouter un cabinet dans la base est demandé 
	if(isset($_POST['btnAjouter'])) {
	
		$nom = trim($_POST['txtNom']);
		$adresse = trim($_POST['txtAdresse']);
		$ville = trim($_POST['txtVille']);
		$codePostal = trim($_POST['txtCodePostal']);
		$acces = trim($_POST['txtAcces']);
		
		insert_cabinet($bd, $id_user, $nom, $adresse, $acces, $ville, $codePostal);
		
	}
	//ob_end_flush();
	mysqli_close($bd);
	
	/*******************************************************************************************
	*
	*							Les fonctions affichages des forms
	*
	********************************************************************************************/
	
function cbl_aff_form_new() {
		
			echo '<form method=POST action="cabinet.php">',
				'<table border=1 cellpadding=5>';
					echo gk_cb_from_ligne("<label>Renseigner nom cabinet</label>", "<input type=text name=txtNom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Donner une adresse physique</label>", "<input type=text name=txtAdresse size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Donner la ville</label>", "<input type=text name=txtVille size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Donner le code postal</label>", "<input type=text name=txtCodePostal size=30 maxlength=5 onkeypress=\'return isNumericInput(event);\'/>", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner les acces du cabinet</label>", "<input type=text name=txtAcces size=40/>", "right", "");
					
					
					
					echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnAjouter value=Je&nbsp;m'inscris />", "", "right");

				echo '</table>',
			'</form>';

	}
	
function aff_cabinet_pas_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal) {
	return '<form method=POST action="cabinet.php">
		<table class="aff_lbl">
			<tr>
				<td colspan=2><label>' .$nom.'</label></td>
			</tr>
			<tr>
				<td colspan=2><label class="form_hidden">'.$adresse.'</label></td>
			</tr>
			<tr>
				<td><label class="form_hidden">'.$codePostal.'</label></td>
				<td><label class="form_hidden">'.$ville.'</label></td>
			</tr>
			<tr >
				<td colspan=2><label class="form_hidden" style=" width: 30vw;">'.$acces.'</label></td>
			</tr>
				<tr>
					<td colspan=2>
						<input type=submit name=btn_consulter value=consulter class="btn_consulter" />
						<input type=submit name=btn_modifier value=modifier class="btn_modifier"/>
					</td>
				</tr>
		</table>'.aff_cabinet_input_part($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
		
	}
	
	function aff_cabinet_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal) {
	return '<form method=POST action="cabinet.php">
		<table class="aff_lbl">
			<tr>
				<td colspan=2><label>' .$nom.'</label></td>
			</tr>
			<tr>
				<td colspan=2><label>'.$adresse.'</label></td>
			</tr>
			<tr>
				<td><label>'.$codePostal.'</label></td>
				<td><label>'.$ville.'</label></td>
			</tr>
	
				<tr>
					<td colspan=2>
						<input type=submit name=btn_changer value="changer cabinet" class="btn_changer_cabinet" />
						<input type=submit name=btn_modifier value=modifier class="btn_modifier"/>
					</td>
				</tr>
		</table>'.aff_cabinet_input_part($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
	}
	
	function aff_cabinet_input_part($idCabinet, $nom, $adresse, $acces, $ville, $codePostal){
		return '<table class="aff_input">
			<tr>
				<input type="text" name="txtCabinet" style="display:none;" value='. $idCabinet.' >
				<td colspan=2><input type="text" name="txtNom" value='.$nom.'></td>
			</tr>
			<tr>
				<td colspan=2><input type="text" name="txtAdresse" value='.$adresse.'></td>
			</tr>
			<tr>
				<td><input type="text" name="txtCodePostal" maxlength=5 onkeypress=\'return isNumericInput(event);\' value='. $codePostal.'></td>
				<td><input type="text" name="txtVille" value='.$ville.'></td>
			</tr>
			<tr>
				<td colspan=2><textarea rows=4 cols=40 name="txtAcces">'.$acces.'</textarea></td>
			</tr>
			<tr>
				<td colspan=2>
					<input type=submit name=btn_supprimer value=supprimer  class="btn_supprimer"/>
					<input type=submit name=btn_sauvegarder value=sauvegarder class="btn_sauvegarder"/>
					<input type=submit name=btn_annuler value=annuler class="btn_annuler" />					
				</td>
			</tr>
		</table>
	</form>';	
	}
	/*******************************************************************************************
	*
	*							Les fonction SQL
	*
	********************************************************************************************/
	function update_cabinet($bd, $idCabinet, $nom, $adresse, $acces, $ville, $codePostal){
		$idCabinet=mysqli_real_escape_string($bd, $idCabinet);
		$nom=mysqli_real_escape_string($bd, $nom);
		$adresse=mysqli_real_escape_string($bd, $adresse);
		$ville=mysqli_real_escape_string($bd, $ville);
		$codePostal=mysqli_real_escape_string($bd, $codePostal);
		$acces=mysqli_real_escape_string($bd, $acces);


		$S = "UPDATE CABINET SET 
					nom = '$nom',
					adresse = '$adresse',
					ville = '$ville',
					codePostal = '$codePostal',
					acces = '$acces'
				WHERE id = '$idCabinet'";
		
		mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		mysqli_close($bd);
		header ('location: cabinet.php');
	}
	
	function delete_cabinet($bd, $idCabinet, $id_user){
		$S = "DELETE FROM thera_cab
		 		WHERE idTherapeute = '$id_user' 
				AND idCabinet = '$idCabinet'";
		
		mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		mysqli_close($bd);
		header ('location: cabinet.php');
	}
	
	function change_cabinet_principal($bd, $id_user, $idCabinetNew, $idCabinetPrev){
		$S = "UPDATE thera_cab 
				SET isPrincipal = 0
				WHERE idTherapeute = '$id_user' 
				AND idCabinet = '$idCabinetPrev'";
		
		mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		
		$S = "UPDATE thera_cab 
				SET isPrincipal = 1
				WHERE idTherapeute = '$id_user' 
				AND idCabinet = '$idCabinetNew'";
		
		mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		mysqli_close($bd);
		header ('location: cabinet.php');
	}
	
	/*******************************************************************************************
	*
	*							Nouveau cabinet
	*
	********************************************************************************************/
	function insert_cabinet($bd, $id_user, $nom, $adresse, $acces, $ville, $codePostal){
		
		$nom=mysqli_real_escape_string($bd, $nom);
		$adresse=mysqli_real_escape_string($bd, $adresse);
		$ville=mysqli_real_escape_string($bd, $ville);
		$codePostal=mysqli_real_escape_string($bd, $codePostal);
		$acces=mysqli_real_escape_string($bd, $acces);
		
		//Requete d'insertion 
		$S = "INSERT INTO CABINET 
				(nom, adresse, ville, CodePostal, acces)
					VALUES 
				('$nom', '$adresse', '$ville', '$codePostal','$acces')";
			
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		$ID = mysqli_insert_id($bd);
		
		
		//Requete qui va savoir si le therapeute a déjà un cabinet principal
		$S = "SELECT COUNT(*) as count
			FROM THERA_CAB
			WHERE idTherapeute ='$id_user'
			AND idCabinet = '$ID'
			AND isPrincipal = '1'";
	
		$R = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		$D = mysqli_fetch_assoc($R);
	
		$count = htmlentities($D['count'], ENT_QUOTES, 'ISO-8859-1');

		//Si le therapeute n'a pas de cabinet, celui ajouté sera son principal
		if ($count == 0) {
			//Requete d'insertion 
			$S = "INSERT INTO THERA_CAB 
				(idTherapeute, idCabinet, isPrincipal)
					VALUES 
				('$id_user', '$ID', '1')";			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		}
		//Sinon ça ne sera pas son principal
		else {
			//Requete d'insertion 
			$S = "INSERT INTO THERA_CAB 
				(idTherapeute, idCabinet, isPrincipal)
					VALUES 
				('$id_user', '$ID', '0')";			
			$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
			$ID = mysqli_insert_id($bd);
		}

	}
	
	/*******************************************************************************************
	*
	*							List des cabinet exist
	*
	********************************************************************************************/
	function aff_list_des_cabinets($bd, $id_user){
		
	
	$sql="SELECT DISTINCT id, nom, ville
			FROM cabinet
			WHERE id NOT IN (SELECT thera_cab.idCabinet
                               FROM thera_cab
                               WHERE thera_cab.idTherapeute='$id_user')";
		$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
			
		
	echo '<form method=POST action="cabinet.php">
			<select name="cabinet">';
			while($enr = mysqli_fetch_assoc($r)) {
				$id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
				$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
				$ville=htmlentities($enr['ville'],ENT_QUOTES,'ISO-8859-1');
				echo "<option value=".$id.">".$nom." (".$ville.") </option>";
			}

		echo '</select>';		
		echo "<input type=submit name=btn_ajouterCE value=ajouter />";
	echo '</form>';
	}
	/*******************************************************************************************
	*
	*							Affichage des radio buttons
	*
	********************************************************************************************/
	function input_radio_line($idCabinet, $nom, $ville, $isPrincipal){
		$checked="";
		if($isPrincipal==1){
			$checked="checked";
		}
		return "<input type=radio name=radioCabinet ".$checked." value=".$idCabinet.">".$nom." (".$ville.")<br>";
	}
	
	function aff_radio_buttons($radio_buttons){
		echo '<form method=POST action="cabinet.php" id="form_cabinet_radio">';
		echo $radio_buttons;
		echo '<input type=submit name=btn_sauvegarder_radio value=sauvegarder ></form>';
	}
?>
