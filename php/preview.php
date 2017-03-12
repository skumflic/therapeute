<?php
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	require("bibli_alpha.php");
	require("bibli_miniport.php");
	require("bibli_readonly.php");
	require("bibli_prologue.php");
	session_start();

	if(!isset($_SESSION['id'])) {
		header('location: connection.php');
		exit();
	}
 	$profil_id = $_SESSION['id'];
	$bd = gk_cb_bd_connection();
	$sql="SELECT *
		FROM USER, THERAPEUTE
		WHERE USER.id = '$profil_id'
		AND USER.id = THERAPEUTE.id";
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	$enr = mysqli_fetch_assoc($r);

	$titre = htmlentities($enr['titre'],ENT_QUOTES, 'ISO-8859-1');
    $telephone = htmlentities($enr['telephone'],ENT_QUOTES, 'ISO-8859-1');
	$description = htmlentities($enr['description'],ENT_QUOTES, 'ISO-8859-1');
	$nom = htmlentities($enr['nom'],ENT_QUOTES, 'ISO-8859-1');
	$prenom = htmlentities($enr['prenom'],ENT_QUOTES, 'ISO-8859-1');
	$mail = htmlentities($enr['mail'],ENT_QUOTES, 'ISO-8859-1');
	$lienPhoto = htmlentities($enr['lienPhoto'],ENT_QUOTES, 'ISO-8859-1');
	$remerciements = htmlentities($enr['remerciements'],ENT_QUOTES, 'ISO-8859-1');
	$aboutme = htmlentities($enr['aboutme'],ENT_QUOTES, 'ISO-8859-1');
	$color = htmlentities($enr['couleur'],ENT_QUOTES, 'ISO-8859-1');
	$skin = htmlentities($enr['skin'],ENT_QUOTES, 'ISO-8859-1');

	$title = "$nom $prenom";

	//FORMATION
	$sql_formation="SELECT *
			FROM FORMATION
			WHERE idTherapeute = '$profil_id'
			AND afficher = 1";
	$r_formation = mysqli_query($bd, $sql_formation) or gk_bd_erreur($bd, $sql_formation);



	//EXPERIENCE
	$sql_experience="SELECT *
			FROM EXPERIENCE
			WHERE idTherapeute = '$profil_id'
			AND afficher = 1";
	$r_experience = mysqli_query($bd, $sql_experience) or gk_bd_erreur($bd, $sql_fexperience);



	//TARIF
	$sql_tarif="SELECT * 
			FROM TARIF 
			WHERE idTherapeute = '$profil_id'";
	$r_tarif = mysqli_query($bd, $sql_tarif) or gk_bd_erreur($bd, $sql_tarif);

	//CABINET
	$sql_cabinet="SELECT * 
				FROM PHOTO
				WHERE idTherapeute = '$profil_id'
				AND afficher = 1";
	$r_cabinet = mysqli_query($bd, $sql_cabinet) or gk_bd_erreur($bd, $sql_cabinet);


//RESEAU
	$sql_reseau="SELECT * 
			FROM THERA_RESEAU
			WHERE idTherapeute = '$profil_id'";
	$r_reseau = mysqli_query($bd, $sql_reseau) or gk_bd_erreur($bd, $sql_tarif);
/************************************************************************************************************************************************
 * 																																				*
 * 																																				*
 * 																																				*
*************************************************************************************************************************************************/
/*if($GLOBALS['skin']!=1 && $GLOBALS['skin']!=2 && $GLOBALS['skin']!=3 && $GLOBALS['skin']!=4){
    $GLOBALS['skin']=$skin;
}*/
	if(isset($_POST['skin'])){
        $skin=$_POST['skin'];
	}
	if(isset($_POST['choisir_skin'])){
		$skin=trim($_POST['skin_for_submit']);
		$color=trim($_POST['color']);

        update_skin($bd, $profil_id, $skin, $color);
	}
if ($color == 1)
    $color_to_string = "bleu";
if ($color == 2)
    $color_to_string = "jaune";
if ($color == 3)
    $color_to_string = "orange";
if ($color == 4)
    $color_to_string = "rose";
if ($color == 5)
    $color_to_string = "rouge";
if ($color == 6)
    $color_to_string = "vert";

	$dir_to_css_main_alpha="html5up-alpha/assets/css/main.css";
	$dir_to_css_main_miniport="html5up-miniport/assets/css/main.css";
	$dir_to_css_main_prologue="html5up-prologue/assets/css/main.css";
	$dir_to_css_main_readonly="html5up-read-only/assets/css/main.css";
	$dir_to_css_color = '../style/color/'.$color_to_string.'.css';


switch ($skin) {
    case 1:
        html_start($title, $dir_to_css_main_alpha, $dir_to_css_color, "landing");
        menu($color);
        echo '<div id=vitrine_part style="margin-top: 50px;">';
        afficher_alpha();
        echo '<script src="../js/js_functions.js"></script>';
		//html_end();
        break;
    case 2:
        html_start($title, $dir_to_css_main_miniport, $dir_to_css_color, "");
        menu($color);
        echo '<div id=vitrine_part style="margin-top: 50px;">';
        afficher_miniport();
        break;
    case 3:
		html_start($title, $dir_to_css_main_prologue, $dir_to_css_color, "");
        menu($color);
        echo '<div id=vitrine_part style="margin-top: 50px;">';
        afficher_prologue();
		break;
    case 4:
        html_start($title, $dir_to_css_main_readonly, $dir_to_css_color, "");
        menu($color);
        echo '<div id=vitrine_part style="margin-top: 50px;">';
        afficher_readonly();
        break;
}




function menu($color){
	global $skin;
    echo '<div id="menu_theme">
            <ul>    
              <li class="dropdown">
                <a class="dropbtn">themes</a>
                <div class="dropdown-content">
                  <a id="skin_1">alpha</a>
                  <a id="skin_2" href="#">miniport</a>
                  <a id="skin_3" href="#">prologue</a>
                  <a id="skin_4"  href="#">readonly</a>
                   <form  method="post" action="preview.php" id="form_changer_skin" style="display: none;">
                   	<input type="hidden" id="skin" name="skin" value="'.$skin.'">              
                  </form>
                  
                </div>
              </li>
              <li class="dropdown">
                <a  class="dropbtn">Color</a>
                <div class="dropdown-content">
                  <a id="color_bleu" href="#">bleu</a>
                  <a id="color_jaune"  href="#">jaune</a>
                  <a id="color_orange"  href="#">orange</a>
                  <a id="color_rouge" href="#">rouge</a>            
                  <a id="color_rose" href="#">rose</a>
                  <a id="color_vert"  href="#">vert</a>
                </div>
              </li>
              <li>
                 <form method="post" action="preview.php">  
                    <input type="hidden" id="color" name="color" value="'.$color.'">
                    <input type="hidden" name="skin_for_submit" value="'.$skin.'">
                    <input type="submit" name="choisir_skin" value="Sauvegarder" id="chosisir_preview">
                </form>
               </li>
            </ul>
            </div>';
}


function afficher_alpha() {
    global $title, $telephone, $titre, $description, $nom, $prenom, $isCertified, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_cabinet, $r_experience, $r_tarif, $r_reseau, $mail;

    html_alpha_header_menu();
    html_alpha_section_banner($nom, $prenom, $titre, $description);
    html_alpha_main($lienPhoto, $aboutme, $remerciements, $r_formation);
    html_alpha_two($isCertified);
    html_alpha_three($r_tarif, $r_cabinet);
    html_alpha_cta($telephone, $mail);
    html_alpha_footer($r_reseau, $mail);
    html_end();
}

function afficher_miniport() {
    global $title, $titre, $telephone, $description, $nom, $prenom, $isCertified, $r_cabinet, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_experience, $r_tarif, $r_reseau, $mail;
    html_miniport_nav();
    html_miniport_home($lienPhoto, $nom, $prenom, $titre, $description);
    html_miniport_presentation($aboutme);
    html_miniport_remerciements($remerciements);
    if (mysqli_num_rows($r_formation) > 0)
        html_miniport_formation($r_formation);
    html_miniport_methode();
    html_miniport_delmet();
    html_miniport_deontologie();
    if ($isCertified == 1)
        html_miniport_certification();
    if (mysqli_num_rows($r_cabinet) > 0)
        html_miniport_cabinet($r_cabinet);
    html_miniport_tarif($r_tarif);
    html_miniport_contact($r_reseau, $mail, $telephone);
    html_end();
}

function afficher_prologue() {
    global $title, $titre, $telephone, $description, $isCertified, $r_cabinet, $nom, $prenom, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_experience, $r_tarif, $r_reseau, $mail;

    html_prologue_header($lienPhoto, $nom, $prenom, $titre, $r_reseau, $mail);
    html_prologue_intro($nom, $prenom, $titre, $description);
    html_prologue_about($remerciements, $aboutme, $r_formation);
    html_prologue_methode($isCertified);
    html_prologue_cabinet($r_tarif, $r_cabinet);
    html_prologue_contact($telephone, $mail);
    html_prologue_end_main();
    html_prologue_footer();

    html_end();
}

function afficher_readonly() {
    global $title, $titre, $description, $r_cabinet, $nom, $prenom, $isCertified, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_experience, $r_tarif, $r_reseau, $mail;

    html_readonly_header($lienPhoto, $nom, $prenom, $titre, $description, $r_reseau, $mail);
    html_readonly_one($nom, $prenom, $aboutme, $remerciements, $r_formation);
    html_readonly_two($isCertified);
    html_readonly_three($r_tarif, $r_cabinet);
    html_readonly_end_main();
    html_readonly_footer();

    html_end();

}
mysqli_close($bd);
function html_start($title, $dir_to_css_main, $dir_to_css_color, $body_class = "")
{
    echo '<!DOCTYPE HTML>  
           <html>
            <head>
                <title>' . $title . '</title>
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
               
                <link rel="stylesheet" href="'.$dir_to_css_main.'"/>
                <link rel="stylesheet" href="../style/preview.css"/>
                <link id="css_color" rel="stylesheet" href=' . $dir_to_css_color .'>
                
            </head>
            <script src="../js/js_functions.js"></script>
            <script src="../assets/js/jquery.min.js"></script>
	    <script src="../assets/js/jquery.dropotron.min.js"></script>
	    <script src="../assets/js/jquery.scrollgress.min.js"></script>
	    <script src="../assets/js/skel.min.js"></script>
	    <script src="../assets/js/util.js"></script>
	    <!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
	    <script src="html5up-alpha/assets/js/main.js"></script>';
    if ($body_class == "") {
        echo '<body>';
    } else {
        echo '<body class=' . $body_class . '>';
    }

}
function html_end() {
    echo '</div>		
		</body>
	</html>';
}

function update_skin($bd, $user_id, $skin, $color){
    $skin=mysqli_real_escape_string($bd, $skin);
    $color=mysqli_real_escape_string($bd, $color);

    $sql = "UPDATE `therapeute` SET `skin`='$skin', `couleur`='$color' WHERE `id` = $user_id";
    $r = mysqli_query($bd, $sql) or gk_cb_bd_erreur($bd, $sql);
    header('location: infoperso.php');
    exit();

}
?>
