<?php
	
	ob_start();

	require("bibli_cuiteur.php");
	require("bibli_generale.php");
	require("bibli_alpha.php");
	require("bibli_miniport.php");
	require("bibli_readonly.php");
	
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
	
	$title = "$nom $prenom";
	
	
	
	
	$dir_to_css_color = "../style/color/bleu.css";	
	html_readonly_start($title, $dir_to_css_color);
	
	html_readonly_header();
	
	html_readonly_one();
	html_readonly_two();
	html_readonly_three();
	
	
	html_readonly_end_main();
	html_readonly_footer();
	
	
	html_readonly_end();
	
	
	
	
	
	
	
	
	
	
	
	
	/*MINIPORT
	$dir_to_css_color = "bleu.css";
	html_miniport_start($title, $dir_to_css_color);
	
	html_miniport_nav();
	html_miniport_home($lienPhoto, $nom, $prenom, $titre);
	html_miniport_presentation($description);
	html_miniport_remerciements(); 
	html_miniport_formation();
	html_miniport_tarif();
	html_miniport_contact();
	
	
	html_miniport_end();
	
	
	
	*/
	
	
	
	
	
	
	
	
	/* ALPHA
	$dir_to_css_color = "../style/color/bleu.css";
	
	
	html_alpha_start($title, $dir_to_css_color, "landing");
	
	html_alpha_header_menu();
	html_alpha_section_banner($nom, $prenom);
	html_alpha_main($lienPhoto, $description);
	html_alpha_two();
	html_alpha_three();
	
	html_alpha_end();
	*/ 
	
	mysqli_close($bd);
	

?>
