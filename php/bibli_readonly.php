<?php 

function html_readonly_start($title, $dir_to_css_color, $path="") {
	echo '<!DOCTYPE HTML>
	<!--
		Read Only by HTML5 UP
		html5up.net | @n33co
		Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
	-->
	<html>
		<head>
		    <title>'.$title.'</title>
		    <meta charset="utf-8"/>
		    <meta name="viewport" content="width=device-width, initial-scale=1"/>
		    <!--[if lte IE 8]>
		    <script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
		    <link rel="stylesheet" href="'.$path.'html5up-read-only/assets/css/main.css"/>
		    <link id="css_color" rel="stylesheet" href='.$path.''.$dir_to_css_color.'>
		    <!--[if lte IE 8]>
		    <link rel="stylesheet" href="html5up-read-only/assets/css/ie8.css"/><![endif]-->
		</head>
		<!-- Scripts -->
		<script src="'.$path.'../assets/js/jquery.min.js"></script>
		<script src="'.$path.'../assets/js/jquery.scrollzer.min.js"></script>
		<script src="'.$path.'../assets/js/jquery.scrolly.min.js"></script>
		<script src="'.$path.'../assets/js/skel.min.js"></script>
		<script src="'.$path.'../assets/js/util.js"></script>
		<!--[if lte IE 8]>
		<script src="../assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="'.$path.'html5up-read-only/assets/js/main.js"></script>
		
		
		<body>';


}


function html_readonly_header($lienPhoto, $nom, $prenom, $titre, $description, $r_reseau, $mail, $path="") {
	echo '<!-- Header -->
	<section id="header" class="top">
	    <header>
		<span class="image avatar"><img src='.$path.'../upload/'.$lienPhoto.' alt=""/></span>

		<h1 id="logo">'. $nom . ' ' . $prenom .'</h1>

		<p class="infoT">'. $titre .'</p>

		<p class="infoT">'. $description .'</p>
	    </header>
	    <nav id="nav">
		<ul>
		    <li><a href="#one" class="active">A propos de moi</a></li>
		    <li><a href="#two">La méthode</a></li>
		    <li><a href="#three">Cabinet</a></li>
		    <li><a href="#four">Contact</a></li>
		</ul>
	    </nav>
	    <footer>
		<ul class="icons">';
			while($enr = mysqli_fetch_assoc($r_reseau)) {
					$URL=htmlentities($enr['URL'],ENT_QUOTES,'ISO-8859-1');
					$idReseau=htmlentities($enr['idReseau'],ENT_QUOTES,'ISO-8859-1');
					
					if($idReseau == 1) 	echo '<li><a href='. $URL. ' class="icon fa-facebook"><span class="label">Facebook</span></a></li>';
					if($idReseau == 2)	echo '<li><a href='. $URL. ' class="icon fa-twitter"><span class="label">Twitter</span></a></li>';
					if($idReseau == 3)	echo '<li><a href='. $URL. ' class="icon fa-google-plus"><span class="label">Google+</span></a></li>';
					

			}
			echo '<li><a href=mailto:'. $mail .' class="icon fa-envelope"><span class="label">Email</span></a></li>';

			    	    
		echo '</ul>
	    </footer>
	</section>
	
	
	<!-- Wrapper -->
	<div id="wrapper">

	    <!-- Main -->
	    <div id="main">';
}

function html_readonly_one($nom, $prenom, $aboutme, $remerciements, $r_formation) {
	echo '<!-- One -->
		<section id="one">
		    <div class="container">
			<header class="major">
			    <h2>'. $nom . ' ' . $prenom .'</h2>

			    <p>A propos de moi.</p>
			</header>
			<p>'. $aboutme .'</p>
		    </div>';
		    if ($remerciements != "") {
                echo '<div class="container">
			<h3>Remerciements</h3>

			<p>' . $remerciements . '</p>
		    </div>';
            }
		    if (mysqli_num_rows($r_formation) > 0) 
				html_readonly_one_formation($r_formation);
		    
		    
		echo '</section>';
}

function html_readonly_one_formation($r_formation) {
	echo '<div class="container">
			<h3>Mes formations</h3>

			<p>Nulla nec augue posuere, ornare elit a, condimentum sapien. Nullam rutrum dui at elit dapibus, quis
			    lobortis ex aliquet. Maecenas sed purus nec nulla mattis interdum.</p>
			<ul class="feature-icons">';
			
				while($enr = mysqli_fetch_assoc($r_formation)) {
					$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
					$annee=htmlentities($enr['annee'],ENT_QUOTES,'ISO-8859-1');
						
					echo '<li class="fa-book">'. $nom. ' ' . $annee .'</li>';	

				}
			    
			echo '</ul>
		    </div>';
}

function html_readonly_two($isCertified) {
	echo '<!-- Two -->
		<section id="two">
		    <div class="container">
			<h2>La methode</h2>

			<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
			    Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
			<ul class="feature-icons">
			    <li class="fa-child">PHYSIQUE</li>
			    <li class="fa-bolt">ÉNERGÉTIQUE</li>
			    <li class="fa-frown-o">ÉMOTIONNEL</li>
			    <li class="fa-comments-o">MENTAL</li>
			</ul>
			<div class="features">
			    <article>
				<div class="row">
				    <div class="6u 12u(small)">
					<section class="box style1">
					    <h3>PHYSIQUE</h3>

					    <p>Le praticien détecte et libère l’énergie bloquée au niveau des zones de tensions 
									(ligaments, muscles, vertèbres, articulations…). La RE est un outil précis et efficace 
									qui permet de résoudre les blocages récurrents, les <b>tensions traumatiques</b> et favorise la 
									<b>récupération</b> ainsi que la <b>rééducation</b>.</p>
					</section>
				    </div>
				    <div class="6u 12u(small)">
					<section class="box style1">
					    <h3>ÉNERGÉTIQUE</h3>

					   <p>Le praticien rétablit les flux d’<i><b>énergie</b></i> et les harmonisent afin de restituer sa force 
									vitale à la personne. L’analyse du rythme vital et l’équilibrage des différents centres énergétiques 
									favorisent une circulation fluide et durable de l’énergie.</p>
					</section>
				    </div>
				</div>
				<div class="row">
				    <div class="6u 12u(small)">
					<section class="box style1">
					    <h3>ÉMOTIONNEL</h3>

					    <p>Le praticien fait le lien entre le blocage physique et la somatisation émotionnelle liée au stress, 
									il propose à la personne de s’en libérer. La RE permet de recouvrir un <i><b>état émotionnel équilibré</b></i> et 
									de se dissocier de ses difficultés. Ce détachement est la clé d’une attitude constructive.</p>
					</section>
				    </div>
				    <div class="6u 12u(small)">
					<section class="box style1">
					    <h3>MENTAL</h3>

					    <p>Le praticien permet à la personne de prendre conscience de ses souffrances du passé, de les conscientiser
									 pour les libérer et les transformer en expériences positives. Pour cela, il utilise la <i><b>reprogrammation 
									 positive</b></i> qui consiste à intégrer par une inspiration profonde un nouveau programme de vie. Il s’agit d’une 
									 technique de visualisation créatrice qui permet à la personne de tourner le dos à son passé, de construire 
									 son avenir immédiat et plus lointain avec la force d’une reprogrammation positive adaptée à sa situation.</p>
					</section>
				    </div>
				</div>
			</article>
			<article>
				<h3>Jean-Michel DEMELT</h3>

				<p><b><i>Jean Michel DEMELT</i></b> est kinésithérapeute, basé en Alsace. Il a développé au cours des vingt dernières années 
						une méthode de traitement manuelle, douce et globale. Elle est complémentaire à un suivi médical, kinésithérapeutique 
						ou ostéopathique. Elle est le résultat de nombreuses expérimentations visant à apporter un réel mieux être ainsi qu’une 
						grille de lecture émotionnelle probante. Cette méthode s’est construite en collaboration avec des heilpraktiker, des 
						psychothérapeutes, des énergéticiens français et étranger et continue d’évoluer sous l’impulsion des thérapeutes de 
						l’être humain d’ores et déjà formés.</p>
						<p>Plus d\'informations sur le travail de Jean-Michel DEMELT ?</p>
				<footer>
				    <a href="http://www.re-energetique.com/FR/" class="button scrolly">Le site de Jean-Michel</a>
				</footer>
			    </article>
			    <article>

				<h3>Déontologie</h3>

				<p>Nulla pretium ipsum dapibus justo scelerisque malesuada.</p>
				<ul class="feature-icons">
				    
					<li class="fa-gavel">A exercer mon activité dans le respect total de l\'intégrité physique et morale de la personne traitée </li>
					<li class="fa-gavel">A respecter une stricte confidentialité</li>
					<li class="fa-gavel">A garder à l\'esprit que la <b><i>Réharmonisation Energétique</i></b> n\'est pas une pratique médicale au sens occidental du terme. Je doit donc : </li>
					<li class="fa-gavel">M\'abstenir d\'établir un quelconque diagnostic médical</li>
					<li class="fa-gavel">Ne pas interrompre ou modifier un traitement médical</li>
					<li class="fa-gavel">Ne pas prescrire ou conseiller de médicaments</li>
					<li class="fa-gavel">Diriger sans délai vers un médecin toute personne se plaignant ou présentant des symptômes anormaux </li>
				</ul>
			    </article>';
			    if ($isCertified == 1) {
				  echo ' <article>

					<h3>Certification</h3>

					<p><span class="image left"><img src="../images/fotolia/fotolia_76292836.jpg" alt=""/></span>Fringilla
					    nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod.
					    Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis
					    volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis
					    sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit
					    adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque
					    praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod.
					    Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis
					    volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis
					    sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit
					    adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque
					    praesent.</p>
				    </article>';
			}	    
			echo '</div>
		    </div>
		</section>';
}

function html_readonly_three($r_tarif, $r_cabinet) {
	echo '<!-- Three -->
		<section id="three">';
			if (mysqli_num_rows($r_cabinet) > 0) {
				echo '<div class="container">
					<h2>Le cabinet</h2>

					<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
					Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>

					<div class="features">';
						while($enr = mysqli_fetch_assoc($r_cabinet)) {
									$idPhoto=htmlentities($enr['idPhoto'],ENT_QUOTES,'ISO-8859-1');
									$titre=htmlentities($enr['titre'],ENT_QUOTES,'ISO-8859-1');
									$description=htmlentities($enr['description'],ENT_QUOTES,'ISO-8859-1');
									
									
								echo '<article>
									<a href="#" class="image"><img src=../upload/cabinet/'.$idPhoto.'.png alt=""/></a>

									<div class="inner">
										<h4>'.$titre.'</h4>

										<p>'.$description.'</p>
									</div>
								</article>';
													

							}
						
					echo'</div>
				</div>';
			}
			html_readonly_three_tarif($r_tarif);
			

		echo '</section>';
}

function html_readonly_three_tarif($r_tarif) {
	echo '<div class="container">
				<h3>Tarifs</h3>

				<div class="table-wrapper">
					<table class="alt">
						<thead>
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>';
							while($enr = mysqli_fetch_assoc($r_tarif)) {
								$libelle=htmlentities($enr['libelle'],ENT_QUOTES,'ISO-8859-1');
								$description=htmlentities($enr['description'],ENT_QUOTES,'ISO-8859-1');
								$prix=htmlentities($enr['prix'],ENT_QUOTES,'ISO-8859-1');

									echo '<tr>
											<td>'. $libelle .'</td>
											<td>'. $description .'</td>
											<td>'. $prix .'</td>
										</tr>';

							}
						
						echo '</tbody>
					</table>
				</div>
			</div>';
}

function html_readonly_four($telephone, $mail) {
	echo '<!-- Four -->
		<section id="four">
		    <div class="container">
			<h3>Contactez Moi</h3>

			<p>Par téléphone : <b>'. $telephone .'</b></p>
						<p>Par mail : <b>'. $mail .'</b></p>
						<p>Ou en utilisant le formulaire ci-dessous :</p>

			<form method="post" action="mailto:'.$mail.'">
			    <div class="row uniform">
				<div class="6u 12u(xsmall)"><input type="text" name="name" id="name" placeholder="Name"/></div>
				<div class="6u 12u(xsmall)"><input type="email" name="email" id="email" placeholder="Email"/>
				</div>
			    </div>
			    <div class="row uniform">
				<div class="12u"><input type="text" name="subject" id="subject" placeholder="Subject"/></div>
			    </div>
			    <div class="row uniform">
				<div class="12u"><textarea name="message" id="message" placeholder="Message"
							   rows="6"></textarea></div>
			    </div>
			    <div class="row uniform">
				<div class="12u">
				    <ul class="actions">
					<li><input type="submit" class="special" value="Send Message"/></li>
					<li><input type="reset" value="Reset Form"/></li>
				    </ul>
				</div>
			    </div>
			</form>
		    </div>
		</section>';
}

function html_readonly_end_main() {
	echo '</div>';
}

function html_readonly_footer() {
	echo '<section id="footer">
		<div class="container">
		    <ul class="copyright">
			<li>&copy; Harmonie. All rights reserved.</li>
			<li>Design: <a href="http://html5up.net">HTML5 UP</a>, <a href="mailto:pprevitali.ke@gmail.com">Pascal
			    PREVITALI</a></li>
		    </ul>
		</div>
	    </section>

	</div>';
}

function html_readonly_end() {
	echo '</body>
	
	</html>';

}

?>
