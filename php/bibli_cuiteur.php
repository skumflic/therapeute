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
			header ('location: inscription.php');
			exit();
		}
	}
	
	
?>
