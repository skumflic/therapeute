<?php
	
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	require("bibli_alpha.php");
	require("bibli_miniport.php");
	require("bibli_readonly.php");
	require("bibli_prologue.php");
	
	$bd = gk_cb_bd_connection();
	$profil_id = 14;
	
	
	$sql="SELECT *
		FROM USER, THERAPEUTE
		WHERE USER.id = '$profil_id'
		AND USER.id = THERAPEUTE.id";
	$r = mysqli_query($bd, $sql) or gk_bd_erreur($bd, $sql);
	$enr = mysqli_fetch_assoc($r);
	
	$titre = htmlentities($enr['titre'],ENT_QUOTES, 'ISO-8859-1');
	$description = htmlentities($enr['description'],ENT_QUOTES, 'ISO-8859-1');
	$nom = htmlentities($enr['nom'],ENT_QUOTES, 'ISO-8859-1');
	$prenom = htmlentities($enr['prenom'],ENT_QUOTES, 'ISO-8859-1');
	$lienPhoto = htmlentities($enr['lienPhoto'],ENT_QUOTES, 'ISO-8859-1');
	$remerciements = htmlentities($enr['remerciements'],ENT_QUOTES, 'ISO-8859-1');
	$aboutme = htmlentities($enr['aboutme'],ENT_QUOTES, 'ISO-8859-1');
	$couleur = htmlentities($enr['couleur'],ENT_QUOTES, 'ISO-8859-1');
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
		
	
	if ($skin == 1) 
		afficher_alpha($color_to_string);
	if ($skin == 2) 
		afficher_miniport($color_to_string);
	if ($skin == 3) 
		afficher_prologue($color_to_string);
	if ($skin == 4)
		afficher_readonly($color_to_string);	
	
	
	
	
	function afficher_alpha($color) {
		global $title, $titre, $description, $nom, $prenom, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_experience;
		
		$dir_to_css_color = "../style/color/$color.css";
		
		
		html_alpha_start($title, $dir_to_css_color, "landing");
		
		html_alpha_header_menu();
		html_alpha_section_banner($nom, $prenom, $titre, $description);
		html_alpha_main($lienPhoto, $aboutme, $remerciements, $r_formation);
		html_alpha_two();
		html_alpha_three();
		html_alpha_cta();	
		
		html_alpha_footer();
		html_alpha_end();
		
	}
	
	function afficher_miniport($color) {
		global $title, $titre, $description, $nom, $prenom, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_experience;
	
		$dir_to_css_color = "$color.css";
		html_miniport_start($title, $dir_to_css_color);
		
		html_miniport_nav();
		html_miniport_home($lienPhoto, $nom, $prenom, $titre, $description);
		html_miniport_presentation($aboutme);
		html_miniport_remerciements($remerciements); 
		if (mysqli_num_rows($r_formation) > 0) 
			html_miniport_formation($r_formation);
		html_miniport_tarif();
		html_miniport_contact();
		
		
		html_miniport_end();
	}
	
	function afficher_prologue($color) {
		global $title, $titre, $description, $nom, $prenom, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_experience;
	
		$dir_to_css_color = "../style/color/$color.css";	
		html_prologue_start($title, $dir_to_css_color);
		
		html_prologue_header($lienPhoto, $nom, $prenom, $titre);
		
		html_prologue_intro($nom, $prenom, $titre, $description);
		html_prologue_about($remerciements, $aboutme, $r_formation);
		html_prologue_methode();
		html_prologue_cabinet();
		html_prologue_contact();
		
		html_prologue_end_main();
		html_prologue_footer();
		
		html_prologue_end();
	}
	
	function afficher_readonly($color) {
		global $title, $titre, $description, $nom, $prenom, $lienPhoto, $remerciements, $aboutme, $r_formation, $r_experience;
	
		$dir_to_css_color = "../style/color/$color.css";	
		html_readonly_start($title, $dir_to_css_color);
		
		html_readonly_header($lienPhoto, $nom, $prenom, $titre, $description);
		
		html_readonly_one($nom, $prenom, $aboutme, $remerciements, $r_formation);
		html_readonly_two();
		html_readonly_three();
		
		
		html_readonly_end_main();
		html_readonly_footer();
		
		
		html_readonly_end();

	}	
		

	
	mysqli_close($bd);
	

?>
