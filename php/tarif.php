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
	
	$id_user = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
	$moderateur_user=$_SESSION['isModerateur'];

	$page_principal_color="#705ea9";

				
	/***************************************************************************************************************
	*											AFFICHAGE															*
	****************************************************************************************************************/
$title = "Tarif";
html_debut($title);
html_menu_espace($moderateur_user, 1);
html_header();
html_nav(4, $moderateur_user, "menu_tarif");
$aff=0;
/*
 * 		Content
 */

echo '<div id="content" class="content_tarif">

			<div class="sub_content">
				<h1>Tarif pour des procedures</h1>
				<div class="left_side">';
				$aff=afficher_tarifs_existants($bd, $id_user);
				echo $aff;
echo '		</div>';
if ($aff==""){
    echo '		<div class="right_side" style="width: 100%">';
}else{
    echo '		<div class="right_side">';}
aff_form_tarif_ajout();
echo '		</div>
			</div>	</div>';
html_footer($page_principal_color);
	html_fin();


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

	mysqli_close($bd);

	
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
	
	return '<form method=POST  action="tarif.php" class="form_existing_info" >
			<input type="text" name="txtTarif" style="display:none;" value='. $idTarif .' >
			<table class="aff_lbl">
				<tr>
					<td>
						<label style="width: 60%;">'.$libelle.'</label>
						<label style="width:40%;">'.$prix.'</label>
					</td>
				</tr>
				
				<tr >
					<td ><label>'.$description.'</label></td>
				</tr>
				
						<input type=submit name=btn_supprimer_tarif value=supprimer  class="btn_supprimer lbl_buttons "/>
						<input type=submit name=btn_modifier value=modifier class="btn_modifier lbl_buttons "/>
		
			</table>
			
			<table class="aff_input">	
				<tr>	
					<td><input style="width:58%; float:left;" type="text" name="txtLibelle" value='.$libelle.'>
					<input style="width:40%; float:right;" type="text" name="txtPrix" value='.$prix.'></td>
				</tr>
				
				<tr>
					<td ><textarea rows=4 cols=40 name="txtDesc">'.$description.'</textarea></td>
				</tr>
				<tr>
					<td >
					
						<input type=submit name=btn_sauvegarder_tarif value=sauvegarder class="btn_sauvegarder"/>
						<input type=submit name=btn_annuler_tarif value=annuler class="btn_annuler" />
						
					</td>
				</tr>
			</table>
		</form>';	
}

function aff_form_tarif_ajout() {
		echo '<form method=POST  action="tarif.php" class="form_new_insert" id="form_tarif_new">
	<h3 >Ajouter nouveau tarif</h3>
			<table>
				<tr>
					<td ><input type=text name=txtLibelle id="txtLibelle" size=70 placeholder="Entrez le libelle du tarif"/></td>
				</tr>
				<tr><td>
					<input type=text name=txtPrix id="txtPrix" size=70 placeholder="Entrez prix "/>	
				</td></tr>
				<tr><td >
					<textarea rows=4 name=txtDescription id="txtDescription" placeholder="Entrez une description "></textarea>	
				</td></tr>
				
				
				<tr>
					<td><input type=submit  name="bnt_ajouter_tarif" value="ajouter"/></td>
				</tr>
			</table>
		</form>';	
}	
		
		
function afficher_tarifs_existants($bd, $id_user){
    $sql="SELECT idTarif, libelle, description, prix
					FROM TARIF
					WHERE idTherapeute = '$id_user'";

    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	$res="";
    while($enr = mysqli_fetch_assoc($r)) {
        $idTarif=htmlentities($enr['idTarif'],ENT_QUOTES,'ISO-8859-1');
        $libelle=htmlentities($enr['libelle'],ENT_QUOTES,'ISO-8859-1');
        $description=htmlentities($enr['description'],ENT_QUOTES,'ISO-8859-1');
        $prix=htmlentities($enr['prix'],ENT_QUOTES,'ISO-8859-1');


        $res.=aff_form_tarif_existant($idTarif, $libelle, $description, $prix);

    }
    return $res;
}
		

	
?>
