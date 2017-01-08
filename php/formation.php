<?php
	
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");

	session_start();
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
	
	$title = "Formation et experience personnelle";
	$style = "../style/index.css";
	$js="../js/js_functions.js";
	gk_cb_html_debut_formation($title, $style, $js);

	
	$bd = gk_cb_bd_connection();
	$id_user = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	
	
	echo '<div class="content">
		<h1>Formation</h1>
				<div class="leftside">';
				
	/***************************************************************************************************************
	*																												*
	*											Formation															*																												
	*																												*
	****************************************************************************************************************/
	
			$sql="SELECT idFormation, nom, annee, etablissement, descriptif, afficher
					FROM formation
					WHERE idTherapeute = '$id_user'";
				
			$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
				
			while($enr = mysqli_fetch_assoc($r)) {
				$idFormation=htmlentities($enr['idFormation'],ENT_QUOTES,'ISO-8859-1');
				$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
				$annee=htmlentities($enr['annee'],ENT_QUOTES,'ISO-8859-1');
				$etablissement=htmlentities($enr['etablissement'],ENT_QUOTES,'ISO-8859-1');
				$descriptif=htmlentities($enr['descriptif'],ENT_QUOTES,'ISO-8859-1');
				$afficher=htmlentities($enr['afficher'],ENT_QUOTES,'ISO-8859-1');
				
				aff_form_formation_existant($idFormation, $nom, $annee, $etablissement, $descriptif, $afficher);
			}
			
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
				update_formation($bd, $idFormation, $nom, $annee, $etablissement, $descriptif, $afficher);
			}
			
			if(isset($_POST['btn_supprimer_formation'])){
				$idFormation=trim($_POST['txtFormation']);
				supprimer_formation($bd, $idFormation);
			}
	echo '</div>';
	echo '<div class="rightside">';
			aff_form_formation_ajout();
				
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
				ajouter_formation($bd, $id_user, $nom, $annee, $etablissement, $descriptif, $afficher);
		
			}
			
	echo '</div>
	</div>
	<div class="content">
		<h1>Experience professionelle</h1>
		<div class="leftside">';
		
	/***************************************************************************************************************
	*																												*
	*											Experience															*																												
	*																												*
	****************************************************************************************************************/
	
			$sql="SELECT idExperience, poste, nomEntreprise, dateDebut, dateFin, afficher
					FROM experience
					WHERE idTherapeute = '$id_user'";
				
			$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
				
			while($enr = mysqli_fetch_assoc($r)) {
				$idExperience=htmlentities($enr['idExperience'],ENT_QUOTES,'ISO-8859-1');
				$poste=htmlentities($enr['poste'],ENT_QUOTES,'ISO-8859-1');
				$nomEntreprise=htmlentities($enr['nomEntreprise'],ENT_QUOTES,'ISO-8859-1');
				$dateDebut=htmlentities($enr['dateDebut'],ENT_QUOTES,'ISO-8859-1');
				$dateFin=htmlentities($enr['dateFin'],ENT_QUOTES,'ISO-8859-1');
				$afficher=htmlentities($enr['afficher'],ENT_QUOTES,'ISO-8859-1');
				
				aff_form_experience_existant($idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher);
			}
			
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
				update_experience($bd, $idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher);
			}
			if(isset($_POST['btn_supprimer_exp'])){
				$idExperience=trim($_POST['txtExp']);
				supprimer_experience($bd, $idExperience);
			}
	echo '</div>
		<div class="rightside">';
			aff_form_experience_ajout();
			
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
				ajouter_experience($bd, $id_user, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher);
			}
	echo '</div>
	</div>';


mysqli_close($bd);
	
			
	echo '</div>';	
	echo '<script type="text/javascript" src="', $js, '"></script>';
 
	
	gk_cb_html_fin();
	
/***************************************************************************************************************
*							Functions Formation: ajout, update, supprimer										*																																																																			***************************************************************************************************************/
function ajouter_formation($bd, $id_user, $nom, $annee, $etablissement, $descriptif, $afficher) {
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
			header('location: formation.php');
			
}

function update_formation($bd, $idFormation, $nom, $annee, $etablissement, $descriptif, $afficher) {
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
	
}

function supprimer_formation($bd, $id_formation) {
	
			$sql = "DELETE FROM formation
					WHERE idFormation='$id_formation'";
			
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			header('location: formation.php');

}
/***************************************************************************************************************
*							Functions Formation: affichage														*																																																																			***************************************************************************************************************/
function aff_form_formation_existant($idFormation, $nom, $annee, $etablissement, $descriptif, $afficher) {
	
	echo '<form method=POST  action="formation.php">
			<table class="aff_lbl">
				<tr>
					<td><label>'.$nom.'</label></td>
					<td><label>'.$annee.'</label></td>
				</tr>
				<tr>
					<td><label class="form_hidden">L\'etablissement d\'obtention</label></td>
					<td><label class="form_hidden">'.$etablissement.'</label></td>
				</tr>
				<tr >
					<td colspan=2><label class="form_hidden" style=" width: 30vw;">'.$descriptif.'</label></td>
				</tr>
				<tr>
					<td colspan=2>
						<input type=submit name=btn_consulter value=consulter class="btn_consulter" />
						<input type=submit name=btn_modifier value=modifier class="btn_modifier"/>
					</td>
				</tr>
			</table>
			
			<table class="aff_input">
				
				<tr>
					<input type="text" name="txtFormation" style="display:none;" value='. $idFormation .' >
					<td><input type="text" name="txtNom" value='.$nom.'></td>';
					echo aff_form_afficher($afficher);					
				echo '</tr>
				<tr>
					<td><input type="text" name="txtAnnee" value='.$annee.'></td>
					<td><input type="text" name="txtEtablissement" value='.$etablissement.'></td>
				</tr>
				<tr>
					<td colspan=2><textarea rows=4 cols=40 name="txtDesc">'.$descriptif.'</textarea></td>
				</tr>
				<tr>
					<td colspan=2>
						<input type=submit name=btn_supprimer_formation value=supprimer  class="btn_supprimer"/>
						<input type=submit name=btn_sauvegarder_formation value=sauvegarder class="btn_sauvegarder"/>
						<input type=submit name=btn_annuler_formation value=annuler class="btn_annuler" />
						
					</td>
				</tr>
			</table>
		</form>';	
}

function aff_form_afficher($afficher){
	if($afficher==1){
		return "<td>Afficher <input type=checkbox name=chbxAff checked></td>";
	}else{
		return "<td>Afficher <input type=checkbox name=chbxAff></td>";	
	}
}

function aff_form_formation_ajout() {
		echo '<form method=POST  action="formation.php">
			<table>
				<tr>
					<td><label>Souhaitez vous afficher cette formation</label></td>
					<td><input type=checkbox name=chbxAff></td>
				</tr>
				<tr>
					<td colspan=2><input type=text name=txtNom size=70 placeholder="Entrez le nom de votre formation"/></td>
				</tr>
				<tr><td colspan=2>
					<input type=text name=txtEtablissement size=70 placeholder="Entrez l\'etablissement d\'obtention"/>	
				</td></tr>
				
				<tr>
					<td><label>L\'année d\'obtention:</label></td>
					<td><input type=text name=txtAnnee maxlength=4 onkeypress=\'return isNumericInput(event);\'/></td>
				</tr>
				<tr><td colspan=2>
					<textarea rows=4 cols=50 name=txtDesc placeholder="Decrivez"></textarea>
				</td></tr>
				<tr>
					<td><input type=submit name="bnt_ajouter_formation" value="ajouter"/></td>
				</tr>
			</table>
		</form>';	
}

/***************************************************************************************************************
*							Functions Experience: ajout, update, supprimer										*																																																																			***************************************************************************************************************/

function ajouter_experience($bd, $id_user, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher) {
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
		
}

function update_experience($bd, $idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher) {
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
	
}

function supprimer_experience($bd, $idExperience) {
	
			$sql = "DELETE FROM experience
					WHERE idExperience='$idExperience'";
			
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
		header('location: formation.php');
}
/***************************************************************************************************************
*							Functions Experience: affichage														*																																																																			***************************************************************************************************************/	
function aff_form_experience_existant($idExperience, $poste, $nomEntreprise, $dateDebut, $dateFin, $afficher) {
	echo '<form method=POST action="formation.php">
		<table class="aff_lbl">
			<tr>
				<td><label>'.$poste.'</label></td>
				<td><label>'.$nomEntreprise.'</label></td>
			</tr>
			<tr>
				<td colspan=2>
					<label class="form_hidden">De '.$dateDebut.' à '. $dateFin.'</label>
				</td>	
			</tr>
			<tr>
				<td><input type=submit name=btn_consulter value=consulter class="btn_consulter" /></td>
				<td><input type=submit name=btn_modifier value=modifier class="btn_modifier"/></td>	
			</tr>
		</table>
			
		<table class="aff_input">
			<tr>
				<input type="text" name="txtExp" style="display:none;" value='. $idExperience.' >
				<td><input type="text" name="txtPoste" value='.$poste.'></td>';
				echo aff_form_afficher($afficher);					
				echo '</tr>
			<tr>
				<td colspan=2><input type="text" name="txtEntreprise" value='.$nomEntreprise.'></td>
			</tr>
			<tr>
				<td><input type="date" class=datepicker name="dateDebut" value='.$dateDebut.'></td>
				<td><input type="date" class=datepicker name="dateFin" value='.$dateFin.'></td>
			</tr>	
			<tr>
				<td colspan=2>
					<input type=submit name=btn_supprimer_exp value=supprimer  class="btn_supprimer"/>
					<input type=submit name=btn_sauvegarder_exp value=sauvegarder class="btn_sauvegarder"/>
					<input type=submit name=btn_annuler_exp value=annuler class="btn_annuler" />					
				</td>
			</tr>
		</table>
	</form>';	
}
	
function aff_form_experience_ajout() {
	echo '<form method=POST  action="formation.php">
		<table>
			<tr>
				<td><label>Souhaitez vous afficher cette experience</label></td>
				<td><input type=checkbox name=chbxAff></td>
			</tr>
			<tr>
				<td colspan=2><input type=text name=txtPoste size=70 placeholder="Entrez le nom de votre poste"/></td>
			</tr>
			<tr><td colspan=2>
				<input type=text name=txtEntreprise size=70 placeholder="Entrez le nom de l\'entreprise"/>	
			</td></tr>		
			<tr>
				<td><input type="date" class=datepicker name="dateDebut" placeholder="Date debut"></td>
				<td><input type="date" class=datepicker name="dateFin" placeholder="Date fin"></td>
			</tr>
			<tr>
				<td><input type=submit name="btn_ajouter_exp" value="ajouter"/></td>
			</tr>		
		</table>
	</form>';	
}
	
?>
