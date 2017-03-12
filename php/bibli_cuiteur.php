<?php 
	require('bib_params.php');
	
	/**
	* Permet de rendre une date claire
	*
	* Fonction qui prend en paramètre un integer 
	* et qui retourne la date dans un format plus jolie
	* exemple : "20140224" donnera "24 Fevrier 2014"
	* 
	* @param	integer		$data 	Date au format AAAAMMDD

	*
	* @return 	string 	$date	Valeur du paramètre ou FALSE
	*/
		
	function gk_cb_amj_clair($data) {
		$annee = (int) substr($data, 0, 4);
		$mois = (int) substr($data, 4, 2);
		$jour = (int) substr($data, 6, 2);
			
		$ma = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
			
		$date = $jour. ' '. $ma[$mois-1]. ' '. $annee;
		return $date;
	}
	
	/**
	* Ecrit les premières lignes nécessaires pour le code html
	*
	* Cette fonction va nous permettre de ne pas 
	* écrire à chaque fois les lignes de code html 
	* en pouvant choisir le titre et le chemin du fichier CSS
	*
	* @param	string 		$title		Titre de la page affiché en haut 		
	* @param 	string		$style		Chemin vers le fichier CSS
	*
	*/
	
	function gk_cb_html_debut($title, $style) {
		echo '<!DOCTYPE html>
		<html>
			<head>
				<meta charset="iso-8859-1">
				<title>', $title, ' </title>
			
				<link rel="stylesheet" href="',$style,'" type="text/css">
				<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
			</head>
	
			<body>
				<div id="bcPage">';
	}
	
	function gk_cb_html_debut_formation($title, $style, $js) {
			echo '<!DOCTYPE html>
		<html>
			<head>
				<meta charset="iso-8859-1">
				<title>', $title, ' </title>
				<link rel="stylesheet" href="',$style,'" type="text/css">
				<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  				<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

				<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
			</head>
	
			<body>
				<div id="bcPage">';
	}

	/**
	* Ecrit les dernières lignes de code html
	*
	* Cette fonction va nous permettre de ne pas 
	* écrire les lignes de code html à chaque fois
	*
	*
	*/
		
	function gk_cb_html_fin() {
	
		echo '			
				</div>
			</body>
		</html>';
	}
	
	/**
	 * Connexion à la base de données.
	 *
	 * @return resource	connecteur à la base de données
	 */
	function gk_cb_bd_connection() {
		$bd = mysqli_connect(BD_SERVEUR, BD_USER, BD_PASS, BD_NOM);

		if ($bd !== FALSE) {
			return $bd;     // Sortie connexion OK
	  	}

		// Erreur de connexion
		// Collecte des informations facilitant le debugage
		$msg = '<h4>Erreur de connexion base MySQL</h4>'
		.'<div style="margin: 20px auto; width: 350px;">'
			.'BD_SERVEUR : '.BD_SERVEUR
			.'<br>BD_USER : '.BD_USER
			.'<br>BD_PASS : '.BD_PASS
			.'<br>BD_NOM : '.BD_NOM
			.'<p>Erreur MySQL numéro : '.mysqli_connect_errno($bd)
			.'<br>'.mysqli_connect_error($bd)
		.'</div>';

		gk_cb_bd_erreurExit($msg);
	}
	
	
	/**
	 * Gestion d'une erreur de requête base de données.
	 *
	 * @param	resource	$bd		Connecteur sur la bd ouverte
	 * @param	string		$sql	requête SQL provoquant l'erreur
	 */
	 	
	function gk_cb_bd_erreur($bd, $sql) {
		$errNum = mysqli_errno($bd);
		$errTxt = mysqli_error($bd);

		// Collecte des informations facilitant le debugage
		$msg = '<h4>Erreur de requête</h4>'
			."<pre><b>Erreur mysql :</b> $errNum"
			."<br> $errTxt"
			."<br><br><b>Requête :</b><br> $sql"
			.'<br><br><b>Pile des appels de fonction</b>';

		// Récupération de la pile des appels de fonction
		$msg .= '<table border="1" cellspacing="0" cellpadding="2">'
			.'<tr><td>Fonction</td><td>Appelée ligne</td>'
			.'<td>Fichier</td></tr>';

		$appels = debug_backtrace();
		for ($i = 0, $iMax = count($appels); $i < $iMax; $i++) {
			$msg .= '<tr align="center"><td>'
				.$appels[$i]['function'].'</td><td>'
				.$appels[$i]['line'].'</td><td>'
				.$appels[$i]['file'].'</td></tr>';
		}

		$msg .= '</table></pre>';

		gk_cb_bd_erreurExit($msg);
	}
	
	/**
	 * Arrêt du script si erreur base de données.
	 * Affichage d'un message d'erreur si on est en phase de
	 * développement, sinon stockage dans un fichier log.
	 *
	 * @param string	$msg	Message affiché ou stocké.
	 */
	 
	function gk_cb_bd_erreurExit($msg) {
		ob_end_clean();		// Supression de tout ce qui
						// a pu être déja généré

		echo '<!DOCTYPE html><html><head><meta charset="ISO-8859-1"><title>',
				'Erreur base de données</title></head><body>',
				$msg,
				'</body></html>';
		exit();
	}
	
	/**
	* Affichage de toute la partie gauche quand il y'a eu un log
	*
	* Cette fonction affiche la partie gauche qui comprend
	* la partie Utilisateur, la partie Tendances, 
	* ainsi que la partie Suggestions
	*
	* @param	resource	$bd			Connecteur sur la bd ouverte
	* @param 	integer		$id			L'ID de l'utilisateur actuel
	* @param 	string 		$pseudo		Pseudo de l'utilisateur actuel
	* @param 	string 		$nom		Nom de l'utilisateur actuel
	* @param	integer		$nbTen		Nombre de tendances à afficher
	* @param	integer		$nbSug		Nombre de suggestions à afficher
	* 
	*/
		
	

	function gk_cb_verifie_session(){ 
		if($_SESSION['id']==0 || $_SESSION['pseudo']==NULL){
			header ('location: connection.php');
			exit();
		}
	}
	
	
	/**
	*	deencrypt les données
	*	@param $maChaineàcCrypter valeur à decrypter
	*/
	
	function de_encrypt_donnee($maChaineCrypter){

		$maCleDeCryptage='omg dat encrypt rositas';//cle de cryptage

		$maCleDeCryptage = md5($maCleDeCryptage);
		
		#echo "Clé de cryptage md5 du PHPSESSID :".$maCleDeCryptage."<br>";
		$letter = -1;
		$newstr = '';
		$maChaineCrypter = base64_decode($maChaineCrypter);
		$strlen = strlen($maChaineCrypter);
		for ( $i = 0; $i < $strlen; $i++ ){
			$letter++;
			if ( $letter > 31 ){
				$letter = 0;
			}
			$neword = ord($maChaineCrypter{$i}) - ord($maCleDeCryptage{$letter});
			if ( $neword < 1 ){
				$neword += 256;
			}
		$newstr .= chr($neword);
		}
	return $newstr;
	}

	/**
	*	encrypt les données
	*	@param $maChaineàcCrypter valeur à crypter
	*/

	function  encrypt_donnee($maChaineACrypter){

		$maCleDeCryptage='omg dat encrypt rositas';//cle de cryptage

		$maCleDeCryptage = md5($maCleDeCryptage);
		
		#echo "Clé de cryptage md5 du PHPSESSID :".$maCleDeCryptage."<br>";
		$letter = -1;
		$newstr = '';
		$strlen = strlen($maChaineACrypter);
		for($i = 0; $i < $strlen; $i++ ){
			$letter++;
			if ( $letter > 31 ){
				$letter = 0;
			}
			$neword = ord($maChaineACrypter{$i}) + ord($maCleDeCryptage{$letter});
			if ( $neword > 255 ){
				$neword -= 256;
			}
			$newstr .= chr($neword);
		}
		return base64_encode($newstr);
	}
	
	/**
	* Fonction qui va faire les diverses 
	* vérifications pour savoir si un utilisateur 
	* s'est correctement enregistré.
	*
	*
	* @return 	array()		$erreur		Retour des erreurs.
	*/
		
	function new_user() {
		
		$bd = gk_cb_bd_connection();

		$nom = trim($_POST['txtNom']);
		$prenom = trim($_POST['txtPrenom']);
		$pass = trim($_POST['txtPasseI']);
		$passVerif = trim($_POST['txtVerif']);
		$pseudo = trim($_POST['txtPseudoI']);
		$mail = trim($_POST['txtMail']);
		$telephone = trim($_POST['txtTelephone']);


	
		$S = "SELECT COUNT(*) as count
			FROM USER
			WHERE pseudo ='$pseudo'";
	
		$R = mysqli_query($bd, $S) or gk_cb_bd_erreur($bd, $S);
		$D = mysqli_fetch_assoc($R);
	
		$count = htmlentities($D['count'], ENT_QUOTES, 'ISO-8859-1');
	
		$erreur = array();
	
		if ($count != 0) 
			$erreur[] = "Le pseudo doit etre change";
		
		else if (strlen($pseudo) < 4 || strlen($pseudo) > 30) {
			$erreur[] = "Le pseudo " . $pseudo . " doit avoir de 4 à 30 caractères";
		}
		
		if ($pass == '') 
			$erreur[] = "Le mot de passe est obligatoire";
			
		if (strlen($telephone) != 10 )
			$erreur[] = "Le numero de telephone est incorrecte";
	
		if ($pass != $passVerif)
			$erreur[] = "Le mot de passe est different dans les 2 zones";
	
		if ($nom == '')
			$erreur[] = "Le nom est obligatoire";
			
		if ($prenom == '') 
			$erreur[] = "Le prenom est obligatoire";
		
		if ((strpos($mail, "@") === false && strpos($mail, ".") === false) || ($mail == ''))
			$erreur[] = "L'adresse mail est obligatoire / L'adresse mail n'est pas valide";
		

		return $erreur;
	}
	
	/**
	* Fonction qui va afficher le formulaire de 
	* la page inscription avec un tableau.
	*
	*/
		
	
	function aff_form($page) {
		
			echo '<form method=POST action="'.$page.'.php">',
				'<table border=1 cellpadding=5>';
					echo gk_cb_from_ligne("<label>Renseigner votre nom</label>", "<input type=text name=txtNom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner votre prenom</label>", "<input type=text name=txtPrenom size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner votre pseudo</label>", "<input type=text name=txtPseudo size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner le mot de passe</label>", "<input type=password name=txtPasse size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Repeter le mot de passe</label>", "<input type=password name=txtVerif size=20 />", "right", "");
					echo gk_cb_from_ligne("<label>Donner une adresse email</label>", "<input type=text name=txtMail size=30/>", "right", "");
					echo gk_cb_from_ligne("<label>Renseigner votre numero de telephone</label>", "<input type=text name=txtTelephone size=20/>", "right", "");
					
					
					
					echo gk_cb_from_ligne("" , "<input class=lesub type=submit name=btnValiderInscription value=Je&nbsp;m'inscris />", "", "right");

				echo '</table>',
			'</form>';

	}
?>
