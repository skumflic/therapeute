<?php

ob_start();

require("bibli_cuiteur.php");
require("bibli_generale.php");
require("bibli_html.php");
require ("bibli_for_connection.php");

$bd = gk_cb_bd_connection();

$title = "Espace Mod&eacute;ration";

session_start();
if(!isset($_SESSION['id'])) {
    header('location: connection.php');
    exit();
}

$id_user = $_SESSION['id'];
$pseudo = $_SESSION['pseudo'];
$moderateur_user=$_SESSION['isModerateur'];

if ($moderateur_user <4) {
    header('location: accueil.php');
    exit();
}
/****************************************************************************************************************************
 * 									AFFICHAGE																				*
 ****************************************************************************************************************************/
html_debut($title);

$page_principal_color="#3eb6d1";
html_header();
html_menu_espace($moderateur_user, 1);
html_nav(-2, $moderateur_user, "menu_infoperso", 1);

echo '<div id="content" ><div class="sub_content">';
menu_ad();
echo '<div id="admin_div_user_list"> ';
   $new_users= list_des_users($bd);
echo '</div><div id="admin_div_new_user">';
    if($new_users==""){
        echo '<h3>Il n\'y a pas de nouvelles utilisateurs!</h3>';
    }else{
        echo $new_users;
    }
echo '</div><div id="admin_div_moderatheur">';
if(!isset($_POST['btnValiderInscription'])) {
    form_inscription("admin.php");
}

//Si le bouton de validation a été demandé
if(isset($_POST['btnValiderInscription'])) {
    $pseudo = trim($_POST['txtPseudoI']);
    $prenom = trim($_POST['txtPrenom']);
    $pass = trim($_POST['txtPasseI']);
    $passVerif = trim($_POST['txtVerif']);
    $nom = trim($_POST['txtNom']);
    $mail = trim($_POST['txtMail']);
    $telephone = trim($_POST['txtTelephone']);
    $erreur = array();
    $erreur = new_user($_POST);
    validationDInscription($bd, $erreur, $pseudo, $prenom, $pass, $nom, $mail, $telephone, "admin.php");
}

echo '</div></div></div>';
html_footer($page_principal_color);

html_fin();


function menu_ad(){
	echo '<ul id=admin_menu><!--
	--><li id="ad_user_list">Liste des utilisateurs</li><!--
	--><li id="ad_new_user">Les utilisateurs en attente</li><!--
	--><li id="ad_moderator">Ajouter des modérateurs</li>
</ul>';
}


if(isset($_POST['btn_certify'])) {
    // print_r($_POST);die();
    $id=$_POST['userID'];
    $S = "UPDATE THERAPEUTE SET
                    isCertified = 1
                    WHERE THERAPEUTE.id = '$id'";
    $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

    header('location: admin.php');
    exit();

}

if(isset($_POST['btnBloquer'])) {
   // print_r($_POST);die();
    $id=$_POST['userID'];
    $S = "UPDATE THERAPEUTE, USER SET
                    isBlocked = (case when isBlocked = 0 then 1 else 0 end)
                    WHERE THERAPEUTE.id = USER.id
                    AND USER.id = '$id'";
    $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

    header('location: admin.php');
    exit();

}
if(isset($_POST['btnBloquerModNonThera'])) {

    $id=$_POST['userID'];
    $isModerateur=$_POST['isModerateur'];
    $isModerateurNew=2;
    if ($isModerateur==2){
        $isModerateurNew=-2;
    }
   // print_r($isModerateurNew); print_r($_POST);die();
    echo $isModerateurNew;
    $S = "UPDATE USER SET
                    isModerateur = '$isModerateurNew'
                    WHERE USER.id = '$id'";
    $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

    header('location: admin.php');
    exit();

}

	if(isset($_POST['btnAddThera'])) {
		$bd = gk_cb_bd_connection();
		
		$id = $_POST['userID'];
        $isModerateur= $_POST['isModerateur'];
        $rand=rand(100000,100000000);
        $S = "INSERT INTO THERAPEUTE
				(id, isAccepted, cleLogiciel, titre, description, isCertified, couleur, skin, lienPhoto, isVerified, random, isBlocked)
					VALUES
				('$id', true, NULL, NULL, NULL, 0, 2, 1, NULL, 0, '$rand', false)";

        $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
        $S = "UPDATE USER SET
				isModerateur = '$isModerateur'+1
				WHERE USER.id = '$id'";
        $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

        $sql="SELECT pseudo
        FROM USER
        WHERE USER.id = '$id'";
        $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
        $enr = mysqli_fetch_assoc($r);
        $pseudo=htmlentities($enr['pseudo'],ENT_QUOTES, 'ISO-8859-1');

        mkdir('../therapeute/'.$pseudo.'', 0777);
        mkdir('../therapeute/'.$pseudo.'/images', 0777);

        $monFichier = fopen('../therapeute/'.$pseudo.'/index.php', "w");
        $txt = "<?php \$profil_id = $id; include '../../php/therapeute.php'; ?>";
        fwrite($monFichier, $txt);
        fclose($monFichier);

        header('location: admin.php');
		exit();

	}

	if(isset($_POST['btnAddMod'])) {
		$bd = gk_cb_bd_connection();

		$id = trim($_POST['userID']);

		$S = "UPDATE USER SET
						isModerateur = isModerateur + 2
						WHERE USER.id = '$id'";
		$r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

		header('location: admin.php');
		exit();
	}

	if(isset($_POST['btnRemoveMod'])) {
        $bd = gk_cb_bd_connection();

        $id = trim($_POST['userID']);

        $S = "UPDATE USER SET
						isModerateur = isModerateur - 2
						WHERE USER.id = '$id'";
        $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

        header('location: admin.php');
        exit();
	}

if(isset($_POST['btn_supprimer'])) {
    $bd = gk_cb_bd_connection();

    $id = trim($_POST['userID']);

    $S = "DELETE FROM USER
			WHERE USER.id = '$id'";
    $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

    header('location: admin.php');
    exit();
}

function list_des_users($bd){
    $new_ones="";
    $sql="SELECT USER.id, nom, prenom, pseudo, isModerateur, therapeute.isBlocked, isCertified
			FROM user LEFT JOIN therapeute ON user.id = therapeute.id
			ORDER BY isModerateur ASC";
    $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);

    $i=1;$content="";
    $new_ones='<ul class="moderator_list" id="admin_list">';
    echo  $new_ones;
    while($enr = mysqli_fetch_assoc($r)) {
        $id_t = htmlentities($enr['id'], ENT_QUOTES, 'ISO-8859-1');
        $nom = htmlentities($enr['nom'], ENT_QUOTES, 'ISO-8859-1');
        $pseudo = htmlentities($enr['pseudo'], ENT_QUOTES, 'ISO-8859-1');
        $prenom = htmlentities($enr['prenom'], ENT_QUOTES, 'ISO-8859-1');
        $bloque = htmlentities($enr['isBlocked'], ENT_QUOTES, 'ISO-8859-1');
        $moderateur = htmlentities($enr['isModerateur'], ENT_QUOTES, 'ISO-8859-1');
        $isCertified = htmlentities($enr['isCertified'], ENT_QUOTES, 'ISO-8859-1');

        $form=form_ligne($id_t, $nom, $prenom, $bloque, $moderateur, $isCertified);
        if ($moderateur==0){
            $content.='<li>'.$form.'</li>';
        }

        echo '<li>'.$form.'</li>';

        $i++;
    }
    echo '</ul>';

    if($content==""){
        return "";
    }
        $new_ones.=$content.'</ul>';
    return $new_ones;
}

/**********************************************************************************************************
 *											Forms
 *
 */

function btnCertify($isCertidfied, $moderateur){
    if($moderateur%2==1) {
        if ($isCertidfied == 0) {
            return '<li class="admin_table_narrow">
                        <div class="tooltip"><input type=submit name="btn_certify" class="btn_certify" value="certifeir" />
                        <span class="tooltiptext">Appuyer pour certifier</span></div></li>';
        } else {
            return '<li class="admin_table_narrow">
                    <label>certifié</label></li>';
        }
    }else{
        return '<li  class="admin_table_narrow"></li>';
    }

}
function btnBloquerOrRemove($bloque, $moderateur)
{
    switch ($moderateur) {
        case 0:
            return '<li class="admin_table_narrow">
                <div class="tooltip"><input type=submit name="btn_supprimer" class="btnRemoveModNonThera btn_supprimer" value="supprimer">
                <span class="tooltiptext">Appuyer pour supprimer</span></div></li>';
            break;
        case 1:
        case 3:
            if ($bloque == 0) {
                return '<li class="admin_table_narrow">
                         <div class="tooltip">
                         <input type=submit name=btnBloquer value ="bloquer" class="btnBlocker" >
                         <span class="tooltiptext">Status courant: Thérapeute debloqué<br>Appuyer pour bloquer</span></div></li>';
            } else {
                return '<li class="admin_table_narrow">
                        <div class="tooltip">
                        <input type=submit name=btnBloquer value ="débloquer" class="btnDeblocker">
                        <span class="tooltiptext">Status courant: Thérapeute bloqué<br>Appuyer pour debloquer</span></div></li>';
            }
            break;
        case 2:
            return '<li class="admin_table_narrow">
                         <div class="tooltip" class="admin_table_narrow">
                         <input type=submit name=btnBloquerModNonThera value ="bloquer" class="btnBlocker">
                         <span class="tooltiptext">Status courant: Moderateur debloqué<br>Appuyer pour bloquer</span></div></li>';
        case -2:
            return '<li class="admin_table_narrow">
                        <div class="tooltip" class="admin_table_narrow">
                        <input type=submit name=btnBloquerModNonThera  value ="débloquer" class="btnDeblocker">
                        <span class="tooltiptext">Status courant: Moderateur bloqué<br>Appuyer pour debloquer</span></div></li>';
        default:
            return '<li  class="admin_table_narrow"></li>';
    }

}


function btnModerator($moderateur){
	if ($moderateur>3) {
        return '<li class="admin_table_narrow"></li>';
    }else{
        if ($moderateur == 0 || $moderateur == 1) {
            return '<li class="admin_table_narrow">
                    <div class="tooltip">
                    <input type=submit name="btnAddMod" value="rendre moderateur" class="btnMod">
                    <span class="tooltiptext">Status courant: utilisateur simple<br>Appuyer pour le rendre moderateur</span></div></li>';
        } else {
           return'<li class="admin_table_narrow">
                    <div class="tooltip">
                    <input type=submit name="btnRemoveMod" value="rendre simple utilisateur" class="btnSimpleUser">
                    <span class="tooltiptext">Status courant: moderateur<br>Appuyer pour le rendre utilisateur simple</span></div></li>';
        }
    }
}

function newUser($moderateur){
    if ($moderateur==0){
       return '<li class="admin_table_narrow">
                <div class="tooltip">
                <input type=submit name="btnAddThera" value="rendre thérapeute" class="btnAcceptUser">
                 <span class="tooltiptext">Accepter le thérapeute</span></div></li>';
    }else if ($moderateur==2 ){
        return '<li class="admin_table_narrow">
                <div class="tooltip">
                <input type=submit name="btnAddThera" value="rendre thérapeute-moderateur" class="btnAcceptUser">
                <span class="tooltiptext">Rendre moderateur thérapeute</span></div></li>';
    }else{
        return '<li  class="admin_table_narrow"></li>';
    }
}
function UserStatus($moderateur){
	switch ($moderateur){

		case 0 : return'<li class="admin_table_narrow"><label>en attente</label></li>';
        break;
		case 1 : return '<li class="admin_table_narrow"><label>thérapeute</label></li>';
		break;
        case -2:
        case 2 :  return '<li class="admin_table_narrow"><label>modérateur-non thérapeute</label></li>';
        break;
        case 3 :  return '<li class="admin_table_narrow"><label>modérateur-thérapeute</label></li>';
        break;
        case 4 :  return '<li class="admin_table_narrow"><label>adminstrateur</label></li>';
        break;
        case 5: return '<li class="admin_table_narrow"><label>adminstrateur-thérapeute</label></li>';
        break;
	}

}
function form_ligne($id,  $nom, $prenom, $bloque, $moderateur, $isCertified){

    return '<form method=POST action="admin.php" class="form_moderator">
				<input type="hidden"  name="userID" value="'.$id.'" class="modHidden"/>
				<input type="hidden"  name="isModerateur" value="'.$moderateur.'" class="modHidden"/>
				<ul class="table_admin">
				
				
						<li><label>'.$nom.'</label></li>
						<li><label>'.$prenom.'</label></li>
						<li class="table_admin_more"><a ></a></li>
						<li ><ul class="table_admin_buttons">'.UserStatus($moderateur).btnCertify($isCertified, $moderateur).newUser($moderateur).btnBloquerOrRemove($bloque, $moderateur).
        btnModerator($moderateur).'</ul></li>
	</ul></form>';
}



mysqli_close($bd);
	gk_cb_html_fin();
	ob_end_flush();
?>
