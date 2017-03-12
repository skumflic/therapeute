<?php

	ob_start();
	require("bibli_html.php");
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
    $moderateur_user=$_SESSION['isModerateur'];
    $page_principal_color="#43b863";

/****************************************************************************************************
 *
 *                          ISSET : PHOTO
 *
 ****************************************************************************************************/
/*if(count($_POST) > 0 ){print_r($_POST);die();}*/
if(isset($_POST['btn_ajouter_photo'])){

    $titre=trim($_POST['txtTitre']);
    $description=trim($_POST['txtDescription']);

    $idcab=trim($_POST['btn_ajouter_photo']);
    if(isset($_POST['chbxAff'])){
        $afficher=1;
    }else{
        $afficher=0;
    }
    $photo_telecharge=upload_photo("newPhoto");
    if($photo_telecharge!==false){
        $idPhoto=insert_photo($bd, $id_user, $idcab, $titre, $description, $afficher);

        $new_name='../upload/cabinet/'.$idPhoto.'.png';
        rename ("../upload/cabinet/newPhoto.png", $new_name);
        mysqli_close($bd);
       header('location: cabinet.php');
        exit();
    }
}
if(isset($_POST['btn_supprimer_photo'])) {
    $idPhoto = trim($_POST['idPhoto']);
    supprimer_photo($bd, $idPhoto);
}

if(isset($_POST['btn_remplacer_photo'])){
    $idPhoto = trim($_POST['idPhoto']);
    upload_photo($idPhoto);
    mysqli_close($bd);
    header('location: cabinet.php');
    exit();
}

if(isset($_POST['btn_sauvegarder_photo'])){

    $idPhoto = trim($_POST['idPhoto']);
    $titre=trim($_POST['txtTitre']);
    $description=trim($_POST['txtDescription']);
    if(isset($_POST['chbxAff'])){
        $afficher=1;
    }else{
        $afficher=0;
    }
    update_photo_info($bd, $idPhoto, $titre, $description, $afficher);

}

/****************************************************************************************************
 *
 *                          ISSET : CABINET
 *
 ****************************************************************************************************/

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


if(isset($_POST['btn_supprimer'])) {
    $idCabinet = trim($_POST['txtCabinet']);
    delete_cabinet($bd, $idCabinet, $id_user);
}
if(isset($_POST['btn_sauvegarder_radio'])) {
    $idCabinet = trim($_POST['radioCabinet']);
    $idCabinetPrincipal=trim($_POST['idCabinetPrincipal']);
    if($idCabinet!=$idCabinetPrincipal)	{
        change_cabinet_principal($bd, $id_user, $idCabinet , $idCabinetPrincipal);
        $idCabinetPrincipal=$idCabinet;
    }
    header('location: cabinet.php');
    exit();

}
//Si le bouton pour ajouter un cabinet déjà existant est demande
if(isset($_POST['btn_ajouterCE'])) {
    $bd = gk_cb_bd_connection();
    $idCabinetPrincipal=trim($_POST['idCabinetPrincipal']);
    $isPrincipal=0;
    if($idCabinetPrincipal==-1){
        $isPrincipal=1;
    }
    $idCabinet = $_POST['cabinet'];
    $S = "INSERT INTO THERA_CAB 
				(idTherapeute, idCabinet, isPrincipal)
					VALUES 
				('$id_user', '$idCabinet', '$isPrincipal')";
    $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

    mysqli_close($bd);
    header('location: cabinet.php');
    exit();
}

//Si le bouton pour ajouter un cabinet dans la base est demandé
if(isset($_POST['btnAjouter'])) {
    $idCabinetPrincipal=trim($_POST['idCabinetPrincipal']);
    $nom = trim($_POST['txtNom']);
    $adresse = trim($_POST['txtAdresse']);
    $ville = trim($_POST['txtVille']);
    $codePostal = trim($_POST['txtCodePostal']);
    $acces = trim($_POST['txtAcces']);

    insert_cabinet($bd, $id_user, $nom, $adresse, $acces, $ville, $codePostal, $idCabinetPrincipal);

}
/*************************************************************************
 *                        AFFICHAGE
 *************************************************************************/
$title = "Mes cabinets";
html_debut($title);
html_header();
html_nav(3, $moderateur_user, "menu_cabinet");
$moderateur_user=$_SESSION['isModerateur'];
html_menu_espace($moderateur_user, 1);
/*
 * 		Content
 */
echo '<div id="content" class="content_cabinet">

			<div class="sub_content">';


        $aff_cabinet_principal="";
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
                $aff_cabinet_principal.=aff_cabinet_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
            }else{
                $forms_pas_principal.=aff_cabinet_pas_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
            }
        }
        if ($forms_pas_principal!=""){
            echo '<h1>Mes cabinets</h1>';
            echo '<div class="left_side">';
        }
        echo $aff_cabinet_principal;
            aff_radio_buttons($radio_buttons, $idCabinetPrincipal);
        if ($forms_pas_principal!=""){
            echo '</div><div class="right_side">';
            echo $forms_pas_principal;
            echo '</div>';
        }
        echo '</div>';

        if($idCabinetPrincipal!=-1 && ($photos= aff_les_photos_de_cabinet($bd, $id_user, $idCabinetPrincipal))!=false) {
            echo '<div class="sub_content" id="div_cabinet_photos">';
            echo '<h1>Des photos du cabinet principal</h1>';
            echo $photos;
            echo '</div>';
        }

    echo '<div class="sub_content">';
            
        cabinet_sub_menu();
            echo '<div id="div_cabinet_cab_part">';
            aff_list_des_cabinets($bd, $id_user, $idCabinetPrincipal);
            cbl_aff_form_new($idCabinetPrincipal);
            echo '</div><div id="div_cabinet_photo_part">';
            if ($idCabinetPrincipal==-1){
                echo '<h2>Pour pouvoir ajouter une photo il faut avoir un cabinet principal, Veillez ajouter cabinet d\'abord</h2>';
            }else{
                aff_form_insert_new_photo($idCabinetPrincipal);
            }



echo '</div></div></div>';
html_footer($page_principal_color);
html_fin();


function cabinet_sub_menu(){
    echo '<ul id="cabinet_sub_menu">

<li id="cab_new" class="cab_li">Ajouter un cabinet</li>
<li id="cab_photo" class="cab_li">Ajouter un photo pour cabinet principal</li>
        
</ul>';
}






/*******************************************************************************************
 *
 *							Les fonction SQL : CABINET
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
    header('location: cabinet.php');
    exit();
}

function delete_cabinet($bd, $idCabinet, $id_user){
    $S = "DELETE FROM thera_cab
		 		WHERE idTherapeute = '$id_user' 
				AND idCabinet = '$idCabinet'";

    mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

    mysqli_close($bd);
    header('location: cabinet.php');
    exit();

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
    header('location: cabinet.php');
    exit();
}

function insert_cabinet($bd, $id_user, $nom, $adresse, $acces, $ville, $codePostal, $idCabinetPrincipal){

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
    echo $ID;

    $isPrincipal=0;
    if($idCabinetPrincipal==-1){
        $isPrincipal=1;
    }

    //Requete d'insertion
    $S = "INSERT INTO THERA_CAB 
				(idTherapeute, idCabinet, isPrincipal)
					VALUES 
				('$id_user', '$ID', '$isPrincipal')";
    $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
    $ID = mysqli_insert_id($bd);

    mysqli_close($bd);
    header('location: cabinet.php');
    exit();
}
/*******************************************************************************************
 *
 *							Les fonctions affichages des forms SQL: PHOTO
 *
 ********************************************************************************************/

function insert_photo($bd, $id_user, $idCabinet, $titre, $description, $afficher){
    $titre=mysqli_real_escape_string($bd, $titre);
    $description=mysqli_real_escape_string($bd, $description);

    //Requete d'insertion
    $sql="INSERT INTO `photo`
					(`idCabinet`, `titre`, `description`, `idTherapeute`, afficher) 
					VALUES 
					('$idCabinet','$titre','$description', '$id_user', '$afficher')";

    $r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
    $ID = mysqli_insert_id($bd);
     return $ID;
}

function supprimer_photo($bd, $idPhoto){
    //Requete d'insertion
    $sql="DELETE FROM `photo` WHERE idPhoto='$idPhoto'";

    $r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);

    mysqli_close($bd);
    header('location: cabinet.php');
    exit();

}

function update_photo_info($bd, $idPhoto, $titre, $description, $afficher){
    $idPhoto=mysqli_real_escape_string($bd, $idPhoto);
    $titre=mysqli_real_escape_string($bd, $titre);
    $description=mysqli_real_escape_string($bd, $description);
    $afficher=mysqli_real_escape_string($bd, $afficher);


    $S = "UPDATE `photo` SET 
              `titre`='$titre',
              `description`='$description',
              `afficher`='$afficher' 
              WHERE idPhoto= '$idPhoto'";

    mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
    mysqli_close($bd);
    header('location: cabinet.php');
    exit();
}

/*******************************************************************************************
 *
 *							Les fonctions affichages des forms : CABINET
 *
 ********************************************************************************************/
function cbl_aff_form_new($idCabinetPrincipal) {

    echo '<form method=POST  action="cabinet.php" class="form_new_insert" id="form_new_cab">
            <input type="hidden" name="idCabinetPrincipal" value="'.$idCabinetPrincipal.'">
			<h3 >Ajouter nouveau cabinet</h3>
			<table >
				<tr>
					<td><input type=text name=txtNom id="txtNom" size=70 placeholder="Nom de cabinet"/></td>
				</tr>
				<tr><td >
					<input type=text name=txtAdresse id="txtAdresse" size=70 placeholder="Rue, batiment"/>	
				</td></tr>
				
				<tr >
					<td >
                        <input style="width: 47%; float:left;" type=text name=txtCodePostal id="txtCodePostal" size=10 maxlength=5 placeholder="Code postal">
                        <input style="width: 47%; float: right;" type=text name=txtVille id="txtVille" size=30 placeholder="Nom de la ville">
					</td>
				</tr>
				<tr><td >
					<textarea rows=4 cols=50 name=txtAcces id="txtAcces" placeholder="Donner acces"></textarea>
				</td></tr>
				<tr>
					<td ><input type=submit name="btnAjouter" value="Ajouter"/></td>
				</tr>
			</table>
		</form>';

	}
	
function aff_cabinet_pas_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal) {
	return '<form method=POST action="cabinet.php" class="form_existing_info">
		<table class="aff_lbl">
			<tr>
				<td colspan=2><label>' .$nom.'</label></td>
			</tr>
			<tr>
				<td colspan=2><label >'.$adresse.'</label></td>
			</tr>
			<tr>
				<td><label>'.$codePostal.'</label></td>
				<td><label>'.$ville.'</label></td>
			</tr>
			<tr >
				<td colspan=2><label class="form_hidden" style=" width: 30vw;">'.$acces.'</label></td>
			</tr>
			<input type=submit name=btn_supprimer value=supprimer  class="btn_supprimer lbl_buttons"/>
			<input type=submit name=btn_consulter value=consulter class="btn_consulter lbl_buttons" />
			<input type=submit name=btn_modifier value=modifier class="btn_modifier lbl_buttons"/>
			
		</table>'.aff_cabinet_input_part($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
		
	}
	
	function aff_cabinet_principal($idCabinet, $nom, $adresse, $acces, $ville, $codePostal) {
	return '<form method=POST action="cabinet.php" class="form_existing_info" id="form_cabinet_principal">
		<table class="aff_lbl">
		    <tr><td><span id="text_principal">Ce cabinet est principal</span></td></tr>
			<tr>
				<td ><label>' .$nom.'</label></td>
			</tr>
			<tr>
				<td><label>'.$adresse.'</label></td>
			</tr>
			<tr>
				<td><label style="width:48%; float:left;">'.$codePostal.'</label>
			    <label style="width:48%; float:right;">'.$ville.'</label></td>
			</tr>
	
				<tr>
					<td >
					    <input style="float:left;" type=submit name=btn_modifier value=modifier class="btn_modifier"/>
						<input style="float:right;" type=submit name=btn_changer value="changer cabinet" class="btn_changer_cabinet" />
						
					</td>
				</tr>
		</table>'.aff_cabinet_input_part($idCabinet, $nom, $adresse, $acces, $ville, $codePostal);
	}
	
	function aff_cabinet_input_part($idCabinet, $nom, $adresse, $acces, $ville, $codePostal){
		return '<table class="aff_input">
			<tr>
				<input type="text" name="txtCabinet" style="display:none;" value='. $idCabinet.' >
				<td ><input type="text" name="txtNom" value="'.$nom.'"></td>
			</tr>
			<tr>
				<td><input type="text" name="txtAdresse" value="'.$adresse.'"></td>
			</tr>
			<tr>
				<td><input type="text" name="txtCodePostal" maxlength=5  value='. $codePostal.'>
				<input type="text" name="txtVille" value="'.$ville.'"></td>
			</tr>
			<tr>
				<td ><textarea rows=4 cols=40 name="txtAcces">'.$acces.'</textarea></td>
			</tr>
			<tr>
				<td >
	
					<input type=submit name=btn_sauvegarder value=sauvegarder class="btn_sauvegarder"/>
					<input type=submit name=btn_annuler value=annuler class="btn_annuler" />					
				</td>
			</tr>
		</table>
	</form>';	
	}

/*******************************************************************************************
 *
 *          Les functions pour gerer cabinets principals et secondaire
 *
 *******************************************************************************************/


/*******************************************************************************************
 *							Affichage des radio buttons
 ********************************************************************************************/
function input_radio_line($idCabinet, $nom, $ville, $isPrincipal){
    $checked="";
    if($isPrincipal==1){
        $checked="checked";
    }
    return "<tr><td><input type=radio name=radioCabinet ".$checked." value=".$idCabinet.">".$nom." (".$ville.")</td></tr>";
}

function aff_radio_buttons($radio_buttons, $idCabinetPrincipal){
    echo '<form method=POST action="cabinet.php" id="form_cabinet_radio">
        <input type="hidden" name="idCabinetPrincipal" value="'.$idCabinetPrincipal.'"/>
            <table>';
    echo $radio_buttons;
    echo '<tr><td><input type=submit name=btn_sauvegarder_radio value=sauvegarder ></td></tr>
            </table></form>';
}

/*******************************************************************************************
 *							List des cabinet exist
 ********************************************************************************************/
function aff_list_des_cabinets($bd, $id_user, $idCabinetPrincipal){

    $sql="SELECT DISTINCT id, nom, ville
			FROM cabinet
			WHERE id NOT IN (SELECT thera_cab.idCabinet
                               FROM thera_cab
                               WHERE thera_cab.idTherapeute='$id_user')";
    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);


    echo '<form method=POST action="cabinet.php" class="form_insert_existing_cabinet" id="form_cab_exist">
        <input type="hidden" name="idCabinetPrincipal" value="'.$idCabinetPrincipal.'">
    <h3>Ajouter un cabinet existant</h3>
    <table><tr><td>
			<select  name="cabinet">';
    while($enr = mysqli_fetch_assoc($r)) {
        $id=htmlentities($enr['id'],ENT_QUOTES,'ISO-8859-1');
        $nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
        $ville=htmlentities($enr['ville'],ENT_QUOTES,'ISO-8859-1');
        echo "<option value=".$id.">".$nom." (".$ville.") </option>";
    }

    echo '</select>
<input  type=submit name=btn_ajouterCE value=Ajouter /></td></tr>';
    echo '</table></form>';
}


/*******************************************************************************************
 *
 *							Les fonctions affichages des forms : PHOTO
 *
 ********************************************************************************************/

function aff_form_afficher($afficher, $chbx_id){
    if($afficher==1){
        return "<tr><td colspan=2><input id='.$chbx_id.' type=checkbox name=chbxAff checked><label for='.$chbx_id.' > Je souhaite afficher dans ma page</label></td><tr>";
    }else{
        return "<tr><td colspan=2><input id='.$chbx_id.' type=checkbox  name=chbxAff ><label for='.$chbx_id.'>Je souhaite afficher dans ma page</label></td><tr>";
    }
}


function photo_err_msg(){
    return '<tr class="photo_required"><td>La photo est requise</td></tr>
            <tr class="photo_extension"><td>Seul jpeg, jpg, png, gif, bmp est accepte</td></tr>
            <tr class="photo_size"><td>L\'image est trop grand</td></tr>
            <tr class="photo_wh"><td>L\'image doit être carré</td></tr>';
}

function aff_form_insert_new_photo($cabinetPrincipal){
    echo '<form method=POST  action="cabinet.php"  enctype="multipart/form-data" class="form_new_insert" name="form_cab_photo" id="form_cab_photo">
<h3 >Ajouter un photo</h3>
			<table>
			    
				<tr>
					<td><input id=chbx_new  type=checkbox  name=chbxAff ><label for=chbx_new> 
					Je souhaite afficher dans ma page</label></td>
				</tr>
				<tr><td ><input type="text" name="txtTitre" size="50" placeholder="Entrez le titre de l\'image"></td></tr>
				<tr><td ><textarea name="txtDescription" rows=4 cols=50 placeholder="Entrez description"></textarea></td></tr>
				<tr><td ><input type=file name=photoCabinet id="cab_new_photo" > </td></tr>
				'.photo_err_msg().'
				<input type="hidden" name="btn_ajouter_photo" value="'.$cabinetPrincipal.'"/>
				<tr><td><input type=submit name="btn_ajouter" value="submit" id="btn_cab_new_photo" /></td></tr>
			</table>
		</form>';
}




function aff_form_existing_photos($idPhoto, $titre, $description, $afficher, $chbx_id){
    $res= '<form method=POST  action="cabinet.php" enctype="multipart/form-data" class="form_existing_info">
				<input type="hidden" name="idPhoto" value="'.$idPhoto.'">';
    $res.=aff_form_existing_photo_part($idPhoto);
    $res.=aff_form_existing_label_part($titre, $description);
    $res.=aff_form_existing_input_part($titre, $description, $afficher, $chbx_id);

    $res.= '</form>';
    return $res;
}

function aff_form_existing_photo_part($idPhoto){
    return '<label><img class="imgCabinet" class="cabinet_photos" src="../upload/cabinet/'.$idPhoto.'.png"></label>
				<table class="cabinet_download_photo">
					<tr >
						<td><input type=file name=photoCabinet id=photoCabinet ></td>
						
						<td>
					
						<input type=submit name="btn_remplacer_photo" value="submit" class="btn_cab_photo" /></td>	
					</tr>
					<tr><td><input type=submit name=btn_annuler_photo value="annuler" class="btn_annuler_changement " /></td></tr>
				</table>';
}

function aff_form_existing_label_part($titre, $description){
    return '<table class="cabinet_aff_lbl aff_lbl">
					<tr >
						<td><label>'.$titre.'</label></td>
					</tr>
					<tr>
						<td><label">'.$description.'</label></td>
					</tr>	
						<input type=submit name=btn_modifier_text value="modifier textes" class="btn_modifier_text lbl_buttons btn_cab_photo"/>
						<input type=submit name=btn_supprimer_photo value=supprimer class="btn_supprimer lbl_buttons btn_cab_photo" />						
				</table>';
}

function aff_form_existing_input_part($titre, $description, $afficher, $chbx_id){
    $res= '<table class="cabinet_aff_input aff_input" >';
    $res.= aff_form_afficher($afficher, $chbx_id);
					$res.= '<tr >
						<td><input type="text" name="txtTitre" value="'.$titre.'"></td>
					</tr>
					<tr>
						<td><input type="text" name="txtDescription" value="'.$description.'"></td>
					</tr>
					<tr>
						<td>
						  
							<input type=submit name=btn_annuler_photo value="annuler" class="btn_annuler_photo btn_annuler" />
							<input type=submit name=btn_sauvegarder_photo value="sauvegarder" class="btn_sauvegarder_cab btn_cab_photo" />
							  <input type=submit name=btn_changer_photo value="changer la photo" class="btn_change_photo btn_cab_photo" />
						</td>
					</tr>
				</table>';
					return $res;
}


/*******************************************************************************************
 *
 *          Les functions pour gerer des PHOTOS
 *
 *******************************************************************************************/
function aff_les_photos_de_cabinet($bd, $id_user, $idCabinetPrincipal)
{
    $sql = "SELECT `idPhoto`, `titre`, `description`, `afficher` 
        FROM `photo`
        WHERE idTherapeute='$id_user' 
        AND idCabinet='$idCabinetPrincipal'";

    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
    $i=0;

    $res='<table id="table_aff_photos_of_cabinet" >';
    $prev_photo="";

    while ($enr = mysqli_fetch_assoc($r)) {
        $curr_photo="";
        $i++;
        $idPhoto = htmlentities($enr['idPhoto'], ENT_QUOTES, 'ISO-8859-1');
        $titre = htmlentities($enr['titre'], ENT_QUOTES, 'ISO-8859-1');
        $description = htmlentities($enr['description'], ENT_QUOTES, 'ISO-8859-1');
        $afficher = htmlentities($enr['afficher'], ENT_QUOTES, 'ISO-8859-1');

        $curr_photo.=aff_form_existing_photos($idPhoto, $titre, $description, $afficher, $i);
        if($i%2==1){
            $prev_photo=$curr_photo;
        }
        if($i%2==0){

            $res.='<tr><td>'.$prev_photo.'</td><td>'.$curr_photo.'</td></tr>';
            $prev_photo="";$curr_photo="";
        }
    }
    if($i%2==1){
        $res.='<tr class="last_odd_photo"><td colspan="2">'.$prev_photo.'</td></tr>';
    }
    $res.='</table>';
    if ($i==0){
        return false;
    }else{
        return $res;

    }
}

function upload_photo( $idPhoto)
{
    $target_dir = "../upload/cabinet/";
    $target_file = $target_dir . basename($_FILES['photoCabinet']['name']);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photoCabinet"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["photoCabinet"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        return false;
        // if everything is ok, try to upload file
    } else {
        $imageName=$idPhoto.'.png';
        $target_file = $target_dir.$imageName;
        if (move_uploaded_file($_FILES["photoCabinet"]["tmp_name"], $target_file)) {
            echo "The file ". $imageName. " has been uploaded.";

        } else {
            echo "Sorry, there was an error uploading your file.";
            return false;
        }
    }
    /*
    if($idPhoto!="newPhoto"){
        header("Refresh:0");
    }
    */
}

?>
