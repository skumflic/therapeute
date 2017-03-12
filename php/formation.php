<?php
	
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	require("bibli_html.php");

	session_start();
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}

	$bd = gk_cb_bd_connection();
	$user_id = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	$moderateur_user=$_SESSION['isModerateur'];

	$page_principal_color="#f38c25";
	/************************************************************************************************************************************
	 * 												ISSET																				*
	 ************************************************************************************************************************************/
	/*
	 * FORMATION
	 */
	if(isset($_POST['btn_sauvegarder_formation'])){
		$idFormation=trim($_POST['txtFormation']);
		$nom=trim($_POST['txtNom']);
		$annee=trim($_POST['txtAnnee']);
		$etablissement=trim($_POST['txtEtablissement']);
		$descriptif=trim($_POST['txtDesc']);

		if(isset($_POST['chbxAff'])){
			$afficher=1;
		}else{
			$afficher=0;
		}
		modifier_formation($bd, $idFormation, $nom, $annee, $etablissement, $descriptif, $afficher);
	}

	if(isset($_POST['btn_supprimer_formation'])){
		$idFormation=trim($_POST['txtFormation']);
		supprimer_formation($bd, $idFormation);
	}

	if(isset($_POST['bnt_ajouter_formation'])){
		$nom=trim($_POST['txtNom']);
		$annee=trim($_POST['txtAnnee']);
		$etablissement=trim($_POST['txtEtablissement']);
		$descriptif=trim($_POST['txtDesc']);

		if(isset($_POST['chbxAff'])){
			$afficher=1;
		}else{
			$afficher=0;
		}
		ajouter_nouvelle_formation($bd, $user_id, $nom, $annee, $etablissement, $descriptif, $afficher);

	}
	/*
	 * 			Experience professionelle
	 */
	if(isset($_POST['btn_sauvegarder_exp'])){
		$idExperience=trim($_POST['txtExp']);
		$poste=trim($_POST['txtPoste']);
		$nomEntreprise=trim($_POST['txtEntreprise']);
		$dateDebut=trim($_POST['dateDebut']);
		$dateFin=trim($_POST['dateFin']);

		if(isset($_POST['chbxAff'])){
			$afficher=1;
		}else{
			$afficher=0;
		}
		modifier_experience($bd, $idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher);
	}

	if(isset($_POST['btn_supprimer_exp'])){
		$idExperience=trim($_POST['txtExp']);
		supprimer_experience($bd, $idExperience);
	}

	if(isset($_POST['btn_ajouter_exp'])){
		$poste=trim($_POST['txtPoste']);
		$nomEntreprise=trim($_POST['txtEntreprise']);
		$dateDebut=trim($_POST['dateDebut']);
		$dateFin=trim($_POST['dateFin']);

		if(isset($_POST['chbxAff'])){
			$afficher=1;
		}else{
			$afficher=0;
		}
		ajouter_nouvau_experience($bd, $user_id, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher);
	}

	/***************************************************************************************************************
	 *											AFFICHAGE															*
	 ****************************************************************************************************************/
	$title = "Formation et experience personnele";
	html_debut($title);
	html_header();
	html_nav(2, $moderateur_user, "menu_formation");
	$aff=0;
	/*
	 * 		Content
	 */
html_menu_espace($moderateur_user, 1);
	echo '<div id="content" class="content_formation">
		
			<div class="sub_content">
				<h1>Formation</h1>
				<div class="left_side">';
					$aff=affichage_des_formations_existantes($bd, $user_id);
	echo '		</div>';
	if ($aff==0){
        echo '		<div class="right_side" style="width: 100%">';
	}else{
	echo '		<div class="right_side">';}
					aff_form_nouvelle_formation();
	echo '		</div>
			</div>';
	echo '<div class="sub_content">
				<h1>Experience professionelle</h1>
				<div class="left_side">';
					$aff=affichage_des_experiences_existants($bd, $user_id);
	echo '		</div>';
	if ($aff==0){
		echo '		<div class="right_side" style="width: 100%">';
	}else{
		echo '		<div class="right_side">';
	}
					aff_form_nouveau_experience();
	echo '		</div>
			</div>';
	echo 	'</div>';
html_footer($page_principal_color);
	html_fin();

/****************************************************************************************************************
 *											FONCTION : SQL														*
 ****************************************************************************************************************/	

/*
 * 			FORMATION
 */
function ajouter_nouvelle_formation($bd, $id_user, $nom, $annee, $etablissement, $descriptif, $afficher) {
			$nom=mysqli_real_escape_string($bd, $nom);
			$annee=mysqli_real_escape_string($bd, $annee);
			$etablissement=mysqli_real_escape_string($bd, $etablissement);
			$descriptif=mysqli_real_escape_string($bd, $descriptif);
			$afficher=mysqli_real_escape_string($bd, $afficher);

			
			//Requete d'insertion 
			$sql = "INSERT INTO formation 
				(idTherapeute, nom, annee, etablissement, descriptif, afficher)
					VALUES 
				('$id_user', '$nom', '$annee', '$etablissement', '$descriptif', '$afficher')";
			
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			$ID = mysqli_insert_id($bd);
    		mysqli_close($bd);
			header('location: formation.php');
			exit();
			
}

function modifier_formation($bd, $idFormation, $nom, $annee, $etablissement, $descriptif, $afficher) {
			$nom=mysqli_real_escape_string($bd, $nom);
			$annee=mysqli_real_escape_string($bd, $annee);
			$etablissement=mysqli_real_escape_string($bd, $etablissement);
			$descriptif=mysqli_real_escape_string($bd, $descriptif);
			$afficher=mysqli_real_escape_string($bd, $afficher);
			$idFormation=mysqli_real_escape_string($bd, $idFormation);
			$sql = "UPDATE formation 
			SET
					nom = '$nom',
					annee = '$annee',
					etablissement = '$etablissement',
					descriptif = '$descriptif',
					afficher = '$afficher'
				WHERE idFormation = '$idFormation'";		
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			header('location: formation.php');
    exit();
	
}

function supprimer_formation($bd, $id_formation) {
	
			$sql = "DELETE FROM formation
					WHERE idFormation='$id_formation'";
			
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			header('location: formation.php');
    exit();
}

/*
 * 			EXPERIENCE PROFESSIONELLE
 */

function ajouter_nouvau_experience($bd, $id_user, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher) {
    $poste=mysqli_real_escape_string($bd, $poste);
    $nomEntreprise=mysqli_real_escape_string($bd, $nomEntreprise);
    $dateDebut=mysqli_real_escape_string($bd, $dateDebut);
    $dateFin=mysqli_real_escape_string($bd, $dateFin);
    $afficher=mysqli_real_escape_string($bd, $afficher);


    //Requete d'insertion 
    $sql = "INSERT INTO experience 
				(idTherapeute, poste, nomEntreprise, dateDebut, dateFin, afficher)
					VALUES 
				('$id_user', '$poste', '$nomEntreprise', '$dateDebut', '$dateFin', '$afficher')";

    $r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
    $ID = mysqli_insert_id($bd);
    header('location: formation.php');
    exit();
}

function modifier_experience($bd, $idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher) {
    $poste=mysqli_real_escape_string($bd, $poste);
    $nomEntreprise=mysqli_real_escape_string($bd, $nomEntreprise);
    $dateDebut=mysqli_real_escape_string($bd, $dateDebut);
    $dateFin=mysqli_real_escape_string($bd, $dateFin);
    $afficher=mysqli_real_escape_string($bd, $afficher);
    $idExperience=mysqli_real_escape_string($bd, $idExperience);

    $sql = "UPDATE experience 
			SET
					poste = '$poste',
					nomEntreprise = '$nomEntreprise',
					dateDebut = '$dateDebut',
					dateFin = '$dateFin',
					afficher = '$afficher'
				WHERE idExperience = '$idExperience'";
    $r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
    header('location: formation.php');
    exit();
}

function supprimer_experience($bd, $idExperience) {

    $sql = "DELETE FROM experience
					WHERE idExperience='$idExperience'";

    $r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
    header('location: formation.php');
    exit();
}

/****************************************************************************************************************
 *											FONCTION : AFFICHAGE														*
 ****************************************************************************************************************/

/*
 * 					FORMATION
 */
function affichage_des_formations_existantes($bd, $user_id){
    $sql="SELECT idFormation, nom, annee, etablissement, descriptif, afficher
					FROM formation
					WHERE idTherapeute = '$user_id'";

    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	$i=0;
    while($enr = mysqli_fetch_assoc($r)) {
        $idFormation=htmlentities($enr['idFormation'],ENT_QUOTES,'ISO-8859-1');
        $nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
        $annee=htmlentities($enr['annee'],ENT_QUOTES,'ISO-8859-1');
        $etablissement=htmlentities($enr['etablissement'],ENT_QUOTES,'ISO-8859-1');
        $descriptif=htmlentities($enr['descriptif'],ENT_QUOTES,'ISO-8859-1');
        $afficher=htmlentities($enr['afficher'],ENT_QUOTES,'ISO-8859-1');

        aff_form_formation_existante($idFormation, $nom, $annee, $etablissement, $descriptif, $afficher, $i);
        $i++;
    }
    return $i;
}

// 		FORMS
function aff_form_formation_existante($idFormation, $nom, $annee, $etablissement, $descriptif, $afficher, $chbx_id) {
	
	echo '<form method=POST  action="formation.php" class="form_existing_info form_exist_formation">
			<input type=hidden name="txtFormation" value='. $idFormation .' >
		
			<table class="aff_lbl">
			<input type=submit name=btn_modifier value="modifier" class="lbl_buttons btn_modifier"/>
			<input type=submit name=btn_supprimer_formation value=supprimer  class="lbl_buttons btn_supprimer"/>';
	echo aff_form_lbl_afficher($afficher, "Cette formation ");
	echo '<tr >
					<td width="70%"><label >'.$nom.'</label></td>
					<td width="30%"><label style="text-align:right;" >'.$annee.'</label></td>
				</tr>
				<tr>
					<td colspan="2"><label>'.$etablissement.'</label></td>
				</tr>
				<tr >
					<td colspan=2><label class="form_hidden">'.$descriptif.'</label></td>
				</tr>
				<input type=submit name=btn_consulter value="voir la descritiption" class="lbl_buttons btn_consulter" />
			</table>
			
			
			<table class="aff_input" >
				';
				
				echo aff_form_afficher($afficher, 'f'.$chbx_id);
				echo '<tr>
					<td width="80%"><input type="text" name="txtNom" value="'.$nom.'"></td>
					<td><input type="text" name="txtAnnee" value="'.$annee.'"></td>
				</tr>
				<tr>	
					<td colspan="2"><input type="text" name="txtEtablissement" value="'.$etablissement.'"></td>
				</tr>
				<tr>
					<td colspan=2><textarea rows=4 cols=40 name="txtDesc">'.$descriptif.'</textarea></td>
				</tr>
				<tr><td colspan="2">
					<input type=submit name=btn_sauvegarder_formation value=sauvegarder class="btn_sauvegarder"/>
					<input type=submit name=btn_annuler_formation value=annuler class="btn_annuler" />

				</td></tr>
			
			</table>
		</form>';
}

function aff_form_afficher($afficher, $chbx_id){
    if($afficher==1){
        return "<tr><td colspan=2><input id='.$chbx_id.' type=checkbox name=chbxAff checked><label for='.$chbx_id.' > Je souhaite afficher dans ma page</label></td><tr>";
    }else{
        return "<tr><td colspan=2><input id='.$chbx_id.' type=checkbox name=chbxAff ><label for='.$chbx_id.'>Je souhaite afficher dans ma page</label></td><tr>";
    }
}

function aff_form_lbl_afficher($afficher, $element){
	if($afficher==1) {
        return '<tr><td colspan="=2"><label>'.$element.' sera affichée dans votre page!</label></td></tr>';
    }else{
        return '<tr><td colspan="2"><label>'.$element.'ne sera pas affichée dans votre page!</label></td></tr>';
	}
}

function aff_form_nouvelle_formation() {
		echo '<form method=POST  action="formation.php" class="form_new_insert" id="form_formation_ajout">
			<h3>Ajouter nouvelle formation</h3>
			<table >
				<tr>
					<td><input id=chbx_new_fm type=checkbox name=chbxAff><label for=chbx_new_fm > Je souhaite afficher dans ma page</label></td>
				</tr>
				<tr>
					<td><input type=text name=txtNom id="txtNom" size=100 placeholder="Nom de votre formation"/></td>
				</tr>
				<tr><td >
					<input type=text  name=txtEtablissement id="txtEtablissement" size=70 placeholder="Nom d\'etablissement d\'obtention"/>	
				</td></tr>
				
				<tr >

					<td ><label style="width: 50%;">L\'année d\'obtention:</label><input type=text name=txtAnnee id="txtAnnee" class="date_input_right" maxlength=4></td>
				</tr>
				<tr><td >
					<textarea rows=4 cols=50 name=txtDesc id="txtDesc" placeholder="Description de votre formation"></textarea>
				</td></tr>
				<tr>
					<td ><input type=submit name="bnt_ajouter_formation" value="Ajouter"/></td>
				</tr>
			</table>
		</form>';
}

/*
 * 					EXPERIENCE PROFESSIONEL
 */

function affichage_des_experiences_existants($bd, $user_id){
    $sql="SELECT idExperience, poste, nomEntreprise, dateDebut, dateFin, afficher
					FROM experience
					WHERE idTherapeute = '$user_id'";

    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	$i=0;
    while($enr = mysqli_fetch_assoc($r)) {
        $idExperience=htmlentities($enr['idExperience'],ENT_QUOTES,'ISO-8859-1');
        $poste=htmlentities($enr['poste'],ENT_QUOTES,'ISO-8859-1');
        $nomEntreprise=htmlentities($enr['nomEntreprise'],ENT_QUOTES,'ISO-8859-1');
        $dateDebut=htmlentities($enr['dateDebut'],ENT_QUOTES,'ISO-8859-1');
        $dateFin=htmlentities($enr['dateFin'],ENT_QUOTES,'ISO-8859-1');
        $afficher=htmlentities($enr['afficher'],ENT_QUOTES,'ISO-8859-1');

        aff_form_experience_existant($idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher, $i);
		$i++;
    }
  	return $i;
}

// 				FORMS
function aff_form_experience_existant($idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher, $chbx_id) {
	echo '<form method=POST action="formation.php" class="form_existing_info">
		<input type="text" name="txtExp" style="display:none;" value='. $idExperience.' >
		<table class="aff_lbl">

			<input type=submit name=btn_supprimer_exp value=supprimer  class="btn_supprimer lbl_buttons"/>
			<input type=submit name=btn_modifier value=modifier class="btn_modifier lbl_buttons"/>';
			echo aff_form_lbl_afficher($afficher, "C'experience ");

			echo '<tr>
				<td><label>'.$poste.'</label></td>
			</tr>
			<tr>
				<td><label >'.$nomEntreprise.'</label></td>
			</tr>
			<tr>
				<td >
					<label >De  '.$dateDebut.'  à  '. $dateFin.'</label>
				</td>	
			</tr>
		</table>
			
		<table class="aff_input">';
			echo aff_form_afficher($afficher, 'e'.$chbx_id);
			echo '<tr>
					<td><input type="text" name="txtPoste" value='.$poste.'></td>
				</tr>
			<tr>
				<td><input type="text" name="txtEntreprise" value='.$nomEntreprise.'></td>
			</tr>
			<tr>
				<td><input type="date" class="datepicker date_input_left" name="dateDebut"  value='.$dateDebut.'>
				<input type="date" class="datepicker date_input_right" name="dateFin" value='.$dateFin.'></td>
			</tr>	
			<tr>
				<td colspan="2">			
					<input type=submit name=btn_sauvegarder_exp value=sauvegarder class="btn_sauvegarder"/>
					<input type=submit name=btn_annuler_exp value=annuler class="btn_annuler" />					
				</td>
			</tr>
		</table>
	</form>';	
}
	
function aff_form_nouveau_experience() {
	echo '<form method=POST  action="formation.php" class="form_new_insert" id="form_exp_ajout">
		<table>
			<h3 >Ajouter nouvel experience</h3>
			<tr>
				<td ><input id="chbx_new_e" type="checkbox" name=chbxAff /><label for="chbx_new_e">Je souhaite afficher dans ma page</label></td>
			</tr>
			<tr>
				<td c><input type=text name=txtPoste id="txtPoste" size=100 placeholder="Entrez le nom de votre poste"/></td>
			</tr>
			<tr><td >
				<input type=text name=txtEntreprise id="txtEntreprise" size="100" placeholder="Entrez le nom de l\'entreprise"/>	
			</td></tr>		
			<tr>
				<td>
					<input type="date" id="dateDebut" class="datepicker date_input_left" name="dateDebut" placeholder="Date debut">
					<input type="date" id="dateFin" class="datepicker date_input_right" name="dateFin" placeholder="Date fin">
				</td>
			</tr>
			<tr>
				<td ><input type=submit  name="btn_ajouter_exp" value="ajouter"/></td>
			</tr>		
		</table>
	</form>';	
}

?>
