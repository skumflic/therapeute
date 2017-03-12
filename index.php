<?php
require("php/bibli_html.php");
require ("php/bibli_for_connection.php");
require  ("php/bibli_cuiteur.php");
require  ("php/bibli_generale.php");

$title="Welcome";
w_html_debut($title);
echo '<div id="content_wellcome_page">
    <div id="w_overlay">';

    echo '<div id="w_div_logo">
<img src="images/logo.png" id="img_logo"> 
        <span id="bienvue_text">Bienvenue au Re-energetique<span>
        <input type="hidden" id="isIndex" value="1">
   </div>';
w_menu();
echo '</div>
    
</div>';

content_demelt();
content_about();

/********************************************************************************************************
 *                                         user                                                          *
 *********************************************************************************************************/
$bd = gk_cb_bd_connection();
$result = mysqli_query($bd,"SELECT CABINET.nom, adresse, ville, codePostal, isCertified, pseudo
				FROM CABINET, THERAPEUTE, THERA_CAB, USER
				WHERE THERAPEUTE.id = THERA_CAB.idTherapeute
				AND THERA_CAB.idCabinet = CABINET.id
				AND THERAPEUTE.id = USER.id
				AND isPrincipal = 1");

while ($row = mysqli_fetch_array($result))
{
    $movies[] = array('adresse' => $row['adresse'],
        'nom' => $row['nom'],
        'ville' => $row['ville'],
        'codePostal' => $row['codePostal'],
        'isCertified' => $row['isCertified'],
        'pseudo' => $row['pseudo'],
    );
}

content_user($movies);

echo '</div>
<div id="w_footer"><span id="copyright">© Re-energetique.fr 2017 by Guzal KHUSANOVA & Corentin BOURVON</span></div> ';


/********************************************************************************************************
 *                                          Thera_part                                                  *
 *********************************************************************************************************/

echo '<div class="wo_content" id="wo_thera">
  <a class="w_btn_annuler" id="w_close_thera">close</a>
<div id="content_not_user">';
/**
 *      connection
 **/
echo '<div id="con_ins_field">';
menu();
echo '<div id="div_connection">';

if(!isset($_POST['btnValiderConnection'])) {

    form_connection("index.php");
}
if(isset($_POST['btnValiderConnection'])) {
    $pseudo = trim($_POST['txtPseudo']);
    $pass = trim($_POST['txtPasse']);
    validationDeConnection($bd, $pass, $pseudo, "index.php");
}
echo '</div><div id="div_password"> ';
if(isset($_POST['btnValiderPass'])) {
    $mail = trim($_POST['txtMail2']);
    send_pass($bd, $mail);
}
form_password("index.php");
echo '</div>';

/*********************************************************************************************************
 *                                                 INSCRIPTION                                           *
 **********************************************************************************************************/
echo '<div id=div_inscription>';
if(!isset($_POST['btnValiderInscription'])) {
    form_inscription("index.php");
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
    validationDInscription($bd, $erreur, $pseudo, $prenom, $pass, $nom, $mail, $telephone, "index.php");
}

echo '</div></div>';

echo '</div></div>';
/***********************************************************************************************************
 *                                              map                                             *
*************************************************************************************************************/
/*echo '  $(document).ready(function(){
            adjustStyle($(window).width());
            $(window).resize(function() {
            adjustStyle($(window).width());
        });';*/
html_fin(1);



function w_menu(){
    echo '<div id="w_menu_div"> <ul id="w_menu">

<li class="w_menu_li" id="w_about">
<span class="wm_title">Qui sommes nous?</span></li>
<li class="w_menu_li" id="w_demelt">
<span class="wm_title"> Methode demelte</span></li>
<li class="w_menu_li" id="w_thera">
<span class="wm_title">Vous êtes thèrapeute?</span></li>
<li class="w_menu_li" id="w_visitor">
<span class="wm_title">Vous cherchez des thèrapeutes?</span></li>
</ul></div>';
}


function content_demelt(){
    echo '<div class="wo_content" id="wo_demelt">
  <a class="w_btn_annuler" id="w_close_demelt">close</a>
    <div id="methode_desc">      
    <h1>La méthode DEMELT</h1>
    <img id="methode_img" src="images/logoDEMELT.png">
    <p>
        La Réharmonisation Énergétique (RE) telle qu’enseignée par Jean-Michel DEMELT, 
        est une méthode de traitement globale, manuelle et douce et qui prend en compte la dimension physique, 
        énergétique, émotionnelle, mentale et se propose d’élargir le champ de conscience et de voir l’homme entier (méthode holistique)
    </p>
    <h2>La Réharmonisation Énergétique en bref</h2>
    <p>
        Jean Michel DEMELT est kinésithérapeute, basé en Alsace. Il a développé au cours des vingt dernières années une méthode de traitement manuelle, douce et globale. Elle est complémentaire à un suivi médical, kinésithérapeutique ou ostéopathique. Elle est le résultat de nombreuses expérimentations visant à apporter un réel mieux être ainsi qu’une grille de lecture émotionnelle probante. Cette méthode s’est construite en collaboration avec des heilpraktiker, des psychothérapeutes, des énergéticiens français et étranger et continue d’évoluer sous l’impulsion des thérapeutes de l’être humain d’ores et déjà formés.
        
        <span id="methode_jm">Plus d\'informations sur le travail de Jean-Michel DEMELT ?<br><a href="http://www.re-energetique.com/FR/">Visiter le Site de Jean-Michel DEMELT </a></span>
    </p>
</div>

    <div>
</div>
</div>';
}

function content_about(){
    echo '<div class="wo_content" id="wo_about">
  <a class="w_btn_annuler" id="w_close_about">close</a>
    <div></div>
</div>';
}
/*style="width:750px; height:450px;"*/
function content_user($movies){
    echo '<div class="wo_content" id="wo_visitor">
  <a class="w_btn_annuler" id="w_close_visitor">close</a>
  <span id="map_text">Les thérapeutes enregistrés dans notre site!</span>';
    echo '<div id="map_canvas" style="width:80%; height:60%;">
	            <script type="text/javascript">		
		        var locations = new Array();';
    foreach ($movies as $cabinet) {
        echo 'n = locations.length;
            locations.push(new Array());
            locations[n].push(\''; echo $cabinet["nom"]; echo'\');
            locations[n].push(\''; echo $cabinet["adresse"].','.$cabinet["ville"]; echo'\');
            locations[n].push(\''; echo 'http://'.$cabinet["pseudo"].'.re-energetique.fr'; echo'\');
            locations[n].push(\''; echo $cabinet["isCertified"]; echo '\');
                initialize(locations);';
    }


    echo ' </script>
               </div>';
   echo' <div></div>
</div>';
}
?>


