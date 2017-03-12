<?php


function menu(){
    echo '<ul id="tabs">
            <li id="tab_connection">Connection</li>
            <li id="tab_inscription">Inscription</li>
          </ul>';
}

/************************************************************************************************************************************
 *                                          CONNECTION                                                                              *
 ************************************************************************************************************************************/


function validationDeConnection($bd, $pass, $pseudo, $page){

    $pass_encrypt = encrypt_donnee($pass);

    $S = "SELECT *
			FROM USER
			WHERE pseudo = '$pseudo'
			AND password = '$pass_encrypt'";


    $R = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
    $D = mysqli_fetch_assoc($R);


    $count = mysqli_num_rows($R);


    $erreur = array();

    if($count != 1) {
        $erreur[] = "Problème d'authentification";
    }

    if (count($erreur) == 0) {

        session_start();
        $_SESSION['id'] = $D['id'];
        $_SESSION['nom'] = $D['nom'];
        $_SESSION['pseudo'] = $D['pseudo'];
        $_SESSION['isModerateur'] = $D['isModerateur'];


        if ($page=="index.php"){
            header ('location: php/infoperso.php');
        }else {
            header('location: infoperso.php');
        }
        mysqli_close($bd);
        exit();

    }

    else {
        $_POST['txtPseudo'] = '';
        $_POST['txtPasse'] = '';

        form_connection($page, "Login ou password incorrect");

    }
}
function form_connection($page, $wrong_insert="") {
    echo '<form method=POST action="'.$page.'" class="form_with_lbl" id="form_connection">';
    if($wrong_insert!=""){
        echo '<span class="form_wrong_insert">'.$wrong_insert.'</span>';
    }
    echo '<table>
					<tr>
						<td>
							<label>Login</label>
							<input type=text name=txtPseudo id="txtPseudo" size=20 />
						</td>
					</tr>
					<tr>
						<td>
							<label>Mot de passe</label>
							<input type=password name=txtPasse id="txtPasse" size=20 />
						</td>
					</tr>
					<tr>
						<td>
							<span id="forgot_pass">Oubliez mot de passe?</span>
						</td>
					</tr>
					<tr><td><input type=submit name=btnValiderConnection value=Connexion id="btnValiderConnection" /></td></tr>
				</table>
     </form>';
}

/************************************************************************************************************************************
 *                                          INSCRIPTION                                                                             *
 ************************************************************************************************************************************/



function validationDInscription($bd, $erreur, $pseudo, $prenom, $pass, $nom, $mail, $telephone, $page){

    //Si le nombre d'erreur est 0, on va pouvoir insérer dans la base de donnée
    if (count($erreur) == 0) {
        $prenom=mysqli_real_escape_string($bd, $prenom);
        $telephone=mysqli_real_escape_string($bd, $telephone);
        $nom=mysqli_real_escape_string($bd, $nom);
        $pseudo=mysqli_real_escape_string($bd, $pseudo);
        $pass=mysqli_real_escape_string($bd, $pass);
        $mail=mysqli_real_escape_string($bd, $mail);
        $isModerateur = 0;
        if($page=="admin.php") {
            $isModerateur+=2;
        }

        $pass_encrypt = encrypt_donnee($pass);
        $rand=rand(100000,100000000);
        //Requete d'insertion
        //Requete d'insertion
        $S = "INSERT INTO USER 
				(nom, prenom, pseudo, mail, password, telephone, isModerateur)
					VALUES 
				('$nom', '$prenom','$pseudo','$mail','$pass_encrypt','$telephone','$isModerateur')";

        $r = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
        $ID = mysqli_insert_id($bd);


  if ($page!="admin.php") {
      send_msg_after_inscription($bd, $ID, $mail, $rand);


      mysqli_close($bd);

      header('location: '.$page.'');
      exit();
  }else{
      header('location: admin.php');
      exit();
  }
    }

    //Sinon il faudra afficher les erreurs
    else {
        $_POST['txtPseudo'] = '';
        $_POST['txtPasse'] = '';
        $_POST['txtVerif'] = '';
        $_POST['txtNom'] = '';
        $_POST['txtMail'] = '';
        $_POST['txtPrenom'] = '';
        $_POST['txtTelephone'] = '';
        $_POST['txtAdresse'] = '';
        form_inscription($page, $erreur);


    }
}
function show_wrong_insert($erreur){
    $taille = count($erreur);
    echo '<span>Les erreurs suivantes ont ete detectees :</span>';
    echo '<ul>';
    for ($i = 0 ; $i < $taille ; $i++)
        echo '<li>', $erreur[$i], '</li>';
    echo '</ul>';
}
function form_inscription($page, $erreur="") {

        echo '<form method=POST action="'.$page.'" class="form_with_lbl" id="form_inscription">';

    if($erreur!=""){
        show_wrong_insert($erreur);
    }
    echo '<table>
					<tr>
						<td>
							<label>Votre nom</label>
							<input type=text name=txtNom id="txtNom" size=20 />
						</td>
				
						<td>
							<label>Votre prenom</label>
							<input type=text name=txtPrenom id="txtPrenom" size=20 />
						</td>
					</tr>
					<tr >
						<td colspan="2">
							<label>Votre login</label>
							<input type=text name=txtPseudoI id="txtPseudoI" size=20 />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Mot de passe</label>
							<input type=password name=txtPasseI id="txtPasseI" size=20 />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Repetez mot de passe</label>
							<input type=password name=txtVerif id="txtVerif" size=20 />
						</td>
					</tr>
					<tr>
					    <td colspan="2">
							<label>E-mail</label>
							<input type=text name=txtMail id="txtMail" size=30/>
						</td>
					</tr>
					<tr>
					    <td colspan="2">
							<label>Numero de telephone</label>
							<input type=text name=txtTelephone id="txtMail" size=20/>
						</td>
					</tr>
					<tr><td colspan="2"><input type=submit name=btnValiderInscription value=Je&nbsp;m\'inscris id="btnValiderInscription" /></td></tr>
				</table>
     </form>';
}
function form_password($page, $erreur="") {
    echo '<form method=POST action="'.$page.'" class="form_with_lbl" id="form_mail">';
    if($erreur!=""){
        show_wrong_insert($erreur);
    }
    echo '<table> 
                    <tr>		
					    <td>
							<label>Votre e-mail</label>
							<input type=text name=txtMail2 id="txtMail2" size=30/>
						</td>
					</tr>
				
					<tr><td colspan="2"><input type=submit name=btnValiderPass value=valider id="btnValiderPass" /></td></tr>
				</table>
     </form>';
}
function send_pass($bd, $mail){

    $rand=rand(1,100000);
    $rand_encrypt = encrypt_donnee((string)$rand);

    $S = "UPDATE USER SET
                    password = '$rand_encrypt'
                WHERE mail = '$mail'";

    mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);


    $subject = "Oublie de mot de passe re-energetique";
    $headers = "From: no-reply@re-energetique.fr \r\n";
    $headers .= "Reply-To: no-reply@re-energetique.fr \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = "Votre nouveau mot de passe est : $rand";

    mail($mail,$subject,$message,$headers);



    echo '<p>votre mot de passe a &eacute;t&eacute, chang&eacute;, verifiez vos mail ind&eacute;sirable</p>';
}
function send_msg_after_inscription($bd, $ID, $mail, $rand){
$subject = "Email Verification mail";
$headers = "From: corentin_25@hotmail.fr \r\n";
$headers .= "Reply-To: corentin_25@hotmail.fr \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
$message.='<div style="width:550px; background-color:#CC6600; padding:15px; font-weight:bold;">';
    $message.='Email Verification mail';
    $message.='</div>';
$message.='<div ">Confiramtion mail have been sent to your email id<br/>';
    $message.='click on the below link in your verification mail id to verify your account ';
    $message.="<a href='localhost/therapeute/php/confirmation.php?id=$ID&email=$mail&confirmation_code=$rand'>click</a>";
    $message.='</div>';
$message.='</body></html>';

mail($mail,$subject,$message,$headers);

$sql="SELECT mail
FROM USER
WHERE isModerateur > 4 ";
$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);


$headers = "From: no-reply@re-energetique \r\n";
$headers .= "Reply-To: no-reply@re-energetique \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

while($enr = mysqli_fetch_assoc($r)) {
$mail_admin=htmlentities($enr['mail'],ENT_QUOTES,'ISO-8859-1');
mail($mail_admin,"Nouveau therapeute sur re-energetique !", "Un nouveau therapeute est arrivé sur le site, allez dans la partie administration pour l'accepter",$headers);
}

echo '<p>un mail de confirmation vous a &eacute;t&eacute; envoy&eacute;</p>';

}
?>