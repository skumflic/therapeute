<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	
	$bd = gk_cb_bd_connection();

	$title = "Tarif";
	$style = "../style/index.css";
	$js="../js/js_functions.js";
	gk_cb_html_debut_formation($title, $style, $js);
	
	session_start();
	
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
	
	$id_user = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	
	
	
	
	
	echo '<header>',
		'<p id="titre">Informations complémentaires </p>',
	'</header>';	
	
	
		
	
echo '<div class="content">
		<h1>Tarif</h1>
				<div class="leftside">';
				
	/***************************************************************************************************************
	*																												*
	*											Tarif															*																												
	*																												*
	****************************************************************************************************************/
	
			$sql="SELECT idTarif, libelle, description, prix
					FROM TARIF
					WHERE idTherapeute = '$id_user'";
				
			$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
				
			while($enr = mysqli_fetch_assoc($r)) {
				$idTarif=htmlentities($enr['idTarif'],ENT_QUOTES,'ISO-8859-1');
				$libelle=htmlentities($enr['libelle'],ENT_QUOTES,'ISO-8859-1');
				$description=htmlentities($enr['description'],ENT_QUOTES,'ISO-8859-1');
				$prix=htmlentities($enr['prix'],ENT_QUOTES,'ISO-8859-1');
				
				
				aff_form_tarif_existant($idTarif, $libelle, $description, $prix);
			}
			
			if(isset($_POST['btn_sauvegarder_tarif'])){
				$idTarif=trim($_POST['txtTarif']);
				$libelle=trim($_POST['txtLibelle']);
				$description=trim($_POST['txtDesc']);
				$prix=trim($_POST['txtPrix']);
				
				if(isset($_POST['chbxAff'])){
						$afficher=1;
				}else{
						$afficher=0;
				}
				update_tarif($bd, $idTarif, $libelle, $description, $prix);
			}
			
			if(isset($_POST['btn_supprimer_tarif'])){
				$idTarif=trim($_POST['txtTarif']);
				supprimer_tarif($bd, $idTarif);
			}
	echo '</div>';
	echo '<div class="rightside">';
			aff_form_tarif_ajout();
				
			if(isset($_POST['bnt_ajouter_tarif'])){
				$libelle=trim($_POST['txtLibelle']);
				$description=trim($_POST['txtDescription']);
				$prix=trim($_POST['txtPrix']);
				
				if(isset($_POST['chbxAff'])){
						$afficher=1;
				}else{
						$afficher=0;
				}
				ajouter_tarif($bd, $id_user, $libelle, $description, $prix);
		
			}
			
	echo '</div>
	</div>';
		
	mysqli_close($bd);
	
			
	echo '</div>';	
	echo '<script type="text/javascript" src="', $js, '"></script>';
 
	
	gk_cb_html_fin();
	
function ajouter_tarif($bd, $id_user, $libelle, $description, $prix) {
			$libelle=mysqli_real_escape_string($bd, $libelle);
			$description=mysqli_real_escape_string($bd, $description);
			$prix=mysqli_real_escape_string($bd, $prix);

			
			//Requete d'insertion 
			$sql = "INSERT INTO TARIF 
				(idTherapeute, libelle, description, prix)
					VALUES 
				('$id_user', '$libelle', '$description', '$prix')";
			
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			$ID = mysqli_insert_id($bd);
			header('location: tarif.php');
			
}

function update_tarif($bd, $idTarif, $libelle, $description, $prix) {
			$libelle=mysqli_real_escape_string($bd, $libelle);
			$description=mysqli_real_escape_string($bd, $description);
			$prix=mysqli_real_escape_string($bd, $prix);
			$idTarif=mysqli_real_escape_string($bd, $idTarif);
			$sql = "UPDATE TARIF 
			SET
					libelle = '$libelle',
					description = '$description',
					prix = '$prix'
				WHERE idTarif = '$idTarif'";		
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			header('location: tarif.php');
	
}

function supprimer_tarif($bd, $idTarif) {
	
			$sql = "DELETE FROM TARIF
					WHERE idTarif='$idTarif'";
			
			$r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
			header('location: tarif.php');

}		
		
/***************************************************************************************************************
*							Functions Tarif: affichage														*																																																																			***************************************************************************************************************/
function aff_form_tarif_existant($idTarif, $libelle, $description, $prix) {
	
	echo '<form method=POST  action="tarif.php">
			<table class="aff_lbl">
				<tr>
					<td><label>'.$libelle.'</label></td>
					<td><label>'.$prix.'</label></td>
				</tr>
				
				<tr >
					<td colspan=2><label class="form_hidden" style=" width: 30vw;">'.$description.'</label></td>
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
					<input type="text" name="txtTarif" style="display:none;" value='. $idTarif .' >
					<td><input type="text" name="txtLibelle" value='.$libelle.'></td>
					<td><input type="text" name="txtPrix" value='.$prix.'></td>
				</tr>
				
				<tr>
					<td colspan=2><textarea rows=4 cols=40 name="txtDesc">'.$description.'</textarea></td>
				</tr>
				<tr>
					<td colspan=2>
						<input type=submit name=btn_supprimer_tarif value=supprimer  class="btn_supprimer"/>
						<input type=submit name=btn_sauvegarder_tarif value=sauvegarder class="btn_sauvegarder"/>
						<input type=submit name=btn_annuler_tarif value=annuler class="btn_annuler" />
						
					</td>
				</tr>
			</table>
		</form>';	
}

function aff_form_tarif_ajout() {
		echo '<form method=POST  action="tarif.php">
			<table>
				<tr>
					<td colspan=2><input type=text name=txtLibelle size=70 placeholder="Entrez le libelle du tarif"/></td>
				</tr>
				<tr><td colspan=2>
					<input type=text name=txtDescription size=70 placeholder="Entrez une description "/>	
				</td></tr>
				
				<tr><td colspan=2>
					<input type=text name=txtPrix size=70 placeholder="Entrez prix "/>	
				</td></tr>
				<tr>
					<td><input type=submit name="bnt_ajouter_tarif" value="ajouter"/></td>
				</tr>
			</table>
		</form>';	
}	
		
		
		
		
		
	
		
		
		
	
?>
