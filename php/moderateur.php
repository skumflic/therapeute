<?php

	ob_start();
	
	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	require("bibli_html.php");

	$bd = gk_cb_bd_connection();

	$title = "Espaces Mod&eacute;ration";

session_start();
	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}

	$id_user = $_SESSION['id'];
	$pseudo = $_SESSION['pseudo'];
    $moderateur_user=$_SESSION['isModerateur'];

	if ($moderateur_user < 2) {
		header('location: accueil.php');
		exit();
	}
    if(isset($_POST['btnBloquer'])) {

        $id=$_POST['modID'];
       $S = "UPDATE THERAPEUTE, USER SET
                    isBlocked = (case when isBlocked = 0 then 1 else 0 end)
                    WHERE THERAPEUTE.id = USER.id
                    AND USER.id = '$id'";
        $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

       header('location: moderateur.php');
      exit();

    }

/****************************************************************************************************************************
 * 									AFFICHAGE																				*
 ****************************************************************************************************************************/
html_debut($title);
$page_principal_color="#3eb6d1";
html_header();
html_menu_espace($moderateur_user, 1);
html_nav(-1, $moderateur_user, "menu_infoperso", 1);
echo '<div id="content" ><div class="sub_content mod_content"> ';


form_search();
if(isset($_POST['btnRecherche'])) {
    $needle = $_POST['txtRecherche'];
    search_result($bd, $needle);

}else{
    list_des_moderateur($bd);

}

echo '</div></div>';
html_footer($page_principal_color);
html_fin();





if(isset($_POST['btnAddMod'])) {
    $bd = gk_cb_bd_connection();

    $id = trim($_POST['modID']);

    $S = "UPDATE THERAPEUTE, USER SET
					isModerateur = isModerateur + 2
					WHERE THERAPEUTE.id = USER.id
					AND USER.id = '$id'";
    $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);

    header('location: moderateur.php');
    exit();
}


function list_des_moderateur($bd){
        $sql="SELECT USER.id, nom, prenom, mail, THERAPEUTE.isBlocked, isModerateur
			FROM USER, THERAPEUTE
			WHERE USER.id = THERAPEUTE.id
			AND isModerateur>0";
        $r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);

    	$i=1;
    	echo '<ul class="moderator_list"><li id="mod_li_header">List des therapeutes  ';
 echo '</li>';
			while($enr = mysqli_fetch_assoc($r)) {
                $id_t = htmlentities($enr['id'], ENT_QUOTES, 'ISO-8859-1');
                $nom = htmlentities($enr['nom'], ENT_QUOTES, 'ISO-8859-1');
                $mail = htmlentities($enr['mail'], ENT_QUOTES, 'ISO-8859-1');
                $prenom = htmlentities($enr['prenom'], ENT_QUOTES, 'ISO-8859-1');
                $bloque = htmlentities($enr['isBlocked'], ENT_QUOTES, 'ISO-8859-1');
                $moderateur = htmlentities($enr['isModerateur'], ENT_QUOTES, 'ISO-8859-1');

                echo '<li>';
                form_ligne($id_t,  $nom, $prenom, $mail, $moderateur, $bloque);
                echo '</li>';
                $i++;
            }
            echo '</ul>';

	}

function btnBloquer($bloque){

    if ($bloque == 0) {
        echo '<td>
                     <div class="tooltip">
                     <input type=submit name=btnBloquer value ="Bloquer" class="btnBlocker">
                     <span class="tooltiptext">Status courant: Debloqué<br>Appuyer pour bloquer</span></div></td>';
    }else{
        echo '<td>
                    <div class="tooltip">
                    <input type=submit name=btnBloquer value ="Debloquer" class="btnDeblocker">
                    <span class="tooltiptext">Status courant: Bloqué<br>Appuyer pour debloquer</span></div></td>';
    }
}

function btnModerator($moderateur){
	if ($moderateur==1){
        echo '<td>
                 <div class="tooltip">
                 <input type=submit name="btnAddMod" value="Ajouter moderateur" class="btnMod">
                 <span class="tooltiptext">Status courant: utilisateur simple<br>Appuyer pour le rendre moderateur</span></div></td>';
	}
	if ($moderateur>1){
		echo '<td><label class="isMod">moderateur</label></td>';

	}
}
function form_ligne($id,  $nom, $prenom, $mail, $moderateur,  $bloque){

    echo '<form method=POST action="moderateur.php" class="form_moderator">
				<input type="hidden"  name="modID" value="'.$id.'" class="modHidden"/>
				<table class="table_moderator">
				
					<tr>
						<td><label>'.$nom.'</label></td>
						<td><label>'.$prenom.'</label></td>
						<td><label>'.$mail.'</label></td>';
    btnModerator($moderateur);
    btnBloquer($bloque);

    echo	'</tr>
	</table></form>';
}

function search_result($bd, $needle){
    //On recherche l'aiguille dans la botte de foin (haystack)

    $sql="SELECT DISTINCT USER.id, nom, prenom, pseudo, mail, THERAPEUTE.isBlocked, isModerateur
			FROM USER, THERAPEUTE
			WHERE USER.id = THERAPEUTE.id
			AND USER.id IN (
			        SELECT USER.id 
			        FROM USER 
			        WHERE pseudo LIKE '%$needle%'
		            OR nom LIKE '%$needle%'
			        OR prenom LIKE '%$needle%')";

    $r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
    $i=1;
    echo '<ul class="moderator_list"><li id="mod_li_header">Resultat de la recherche</li>';
    while($enr = mysqli_fetch_assoc($r)) {
        $id = htmlentities($enr['id'], ENT_QUOTES, 'ISO-8859-1');
        $nom = htmlentities($enr['nom'], ENT_QUOTES, 'ISO-8859-1');
        $pseudo = htmlentities($enr['pseudo'], ENT_QUOTES, 'ISO-8859-1');
        $prenom = htmlentities($enr['prenom'], ENT_QUOTES, 'ISO-8859-1');
        $bloque = htmlentities($enr['isBlocked'], ENT_QUOTES, 'ISO-8859-1');
        $moderateur = htmlentities($enr['isModerateur'], ENT_QUOTES, 'ISO-8859-1');
        $mail = htmlentities($enr['mail'], ENT_QUOTES, 'ISO-8859-1');
        echo '<li>';
        form_ligne($id,  $nom, $prenom, $mail, $moderateur, $bloque);
        echo '</li>';
        $i++;
    }
    echo '</ul>';


}



	function form_search(){
        echo '<form method=POST action="moderateur.php" class="form_search">',
        '<table>
            <tr><td><input type=text name=txtRecherche  id="search" size=30 placeholder="Entrez mot clé" /></td>
                <td><input id="search_submit" type=submit name=btnRecherche value=Recherche /></td>
                </tr>

       </table>
      </form>';
	}

mysqli_close($bd);

ob_end_flush();
?>
