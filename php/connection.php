<?php
ob_start();

require("bibli_cuiteur.php");
require("bibli_generale.php");
require("bibli_html.php");
require ("bibli_for_connection.php");

$bd = gk_cb_bd_connection();
$title = "Connectez-vous !";
$title = "Formation et experience personnele";
html_debut($title);
html_header(1);

echo '<div id="content_not_user">';
/**
 *      connection
 **/
echo '<div id="con_ins_field">';
menu();
echo '<div id="div_connection">';

if(!isset($_POST['btnValiderConnection'])) {

    form_connection("connection.php");
}
if(isset($_POST['btnValiderConnection'])) {
    $pseudo = trim($_POST['txtPseudo']);
    $pass = trim($_POST['txtPasse']);
    validationDeConnection($bd, $pass, $pseudo, "connection.php");
}
echo '</div><div id="div_password"> ';
if(isset($_POST['btnValiderPass'])) {
    $mail = trim($_POST['txtMail2']);
    send_pass($bd, $mail);
}
form_password("connection.php");
echo '</div>';

/*********************************************************************************************************
 *                                                 INSCRIPTION                                           *
 **********************************************************************************************************/
echo '<div id=div_inscription>';
if(!isset($_POST['btnValiderInscription'])) {
    form_inscription("connection.php");
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
    validationDInscription($bd, $erreur, $pseudo, $prenom, $pass, $nom, $mail, $telephone, "connection.php");
}

echo '</div></div>';

echo '</div>';
//html_footer();
html_fin();




?>