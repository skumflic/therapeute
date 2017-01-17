<?php 

function html_prologue_start($title, $dir_to_css_color) {
	echo '<!DOCTYPE HTML>
	<!--
		Prologue by HTML5 UP
		html5up.net | @n33co
		Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
	-->
	<html>
		<head>
			<title>'.$title.'</title>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
			<link rel="stylesheet" href="html5up-prologue/assets/css/main.css" />
			<link id="css_color" rel="stylesheet" href='.$dir_to_css_color.'>
			<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
			<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		</head>
		
		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			<script src="../assets/js/jquery.scrollzer.min.js"></script>
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			
		<body>';
}

function html_prologue_header($lienPhoto, $nom, $prenom, $titre, $r_reseau, $mail) {
	echo '<!-- Header -->
		<div id="header">

			<div class="top">

				<!-- Logo -->
					<div id="logo">
						<span class="image avatar48"><img src=../upload/'.$lienPhoto.' alt="" /></span>
						<h1 id="title">'. $nom . ' ' . $prenom .'</h1>
						<p>'. $titre .'</p>
					</div>

				<!-- Nav -->
					<nav id="nav">
						<!--

							Prologue\'s nav expects links in one of two formats:

							1. Hash link (scrolls to a different section within the page)

							   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

							2. Standard link (sends the user to another page/site)

							   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>

						-->
						<ul>
							<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Accueil</span></a></li>
							<li><a href="#methode" id="methode-link" class="skel-layers-ignoreHref"><span class="icon fa-info">La méthode</span></a></li>
							<li><a href="#cabinet" id="cabinet-link" class="skel-layers-ignoreHref"><span class="icon fa-map-marker">Cabinet</span></a></li>
							<li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contact</span></a></li>
						</ul>
					</nav>
				<!-- Social Icons -->
				<ul class="icons social">';
					while($enr = mysqli_fetch_assoc($r_reseau)) {
						$URL=htmlentities($enr['URL'],ENT_QUOTES,'ISO-8859-1');
						$idReseau=htmlentities($enr['idReseau'],ENT_QUOTES,'ISO-8859-1');
						
						if($idReseau == 1) 	echo '<li><a href='. $URL. ' class="icon fa-facebook"><span class="label">Facebook</span></a></li>';
						if($idReseau == 2)	echo '<li><a href='. $URL. ' class="icon fa-twitter"><span class="label">Twitter</span></a></li>';
						if($idReseau == 3)	echo '<li><a href='. $URL. ' class="icon fa-google-plus"><span class="label">Google+</span></a></li>';
					
					}
					echo '<li><a href=mailto:'. $mail .' class="icon fa-envelope"><span class="label">Email</span></a></li>';
				echo '</ul>

			</div>

			<div class="bottom">


			</div>

		</div>';
}

function html_prologue_intro($nom, $prenom, $titre, $description) {
	echo '<!-- Main -->
		<div id="main">

			<!-- Intro -->
				<section id="top" class="one dark cover">
					<div class="container">

						<header>
							<h2 class="alt">'. $nom . ' ' . $prenom .'</h2>
							<p class="infoT">'. $titre .'</p>
							<p class="infoT">'. $description .'</p>
						</header>

						<footer>
							<a href="#formation" class="button scrolly">Mes formations</a>
						</footer>

					</div>
				</section>';
}

function html_prologue_about($aboutme, $remerciements, $r_formation) {
	echo '<!-- about -->
			<section id="about" class="two">
				<div class="container">

					<header>
						<h2>A propos de moi</h2>
					</header>

					<p>'. $aboutme .'</p>

					<div class="row">
						<div class="12u 12u$(mobile)">
							<article class="item ssPara">
								<h3>Remerciements</h3>

								<p>'. $remerciements .'</p>
							</article>
						</div>';
						
						if (mysqli_num_rows($r_formation) > 0) 
							html_prologue_about_formation($r_formation);
							
					echo'</div>
				</div>
			</section>';
}

function html_prologue_about_formation($r_formation) {
	echo '<div id="formation" class="12u 12u$(mobile)">
							<article class="item ssPara">
								<h3>Mes formations</h3>

								<p>Nulla nec augue posuere, ornare elit a, condimentum sapien. Nullam rutrum dui at elit dapibus, quis
									lobortis ex aliquet. Maecenas sed purus nec nulla mattis interdum.</p>
								<ul class="feature-icons">';
								
									while($enr = mysqli_fetch_assoc($r_formation)) {
										$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
										$annee=htmlentities($enr['annee'],ENT_QUOTES,'ISO-8859-1');
										$descriptif=htmlentities($enr['descriptif'],ENT_QUOTES,'ISO-8859-1');
										
										echo '<li class="fa-stethoscope">'.$nom . ' '. $annee.' </li>';	

									}
									
									
								echo '</ul>
							</article>
						</div>';
}

function html_prologue_methode() {
	echo '	<!-- methode -->
		<section id="methode" class="three">
			<div class="container">
				<header>
					<h2>La methode</h2>
				</header>

				<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
					Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
				<ul class="feature-icons">
					<li class="fa-child">PHYSIQUE</li>
					<li class="fa-bolt">ÉNERGÉTIQUE</li>
					<li class="fa-frown-o">ÉMOTIONNEL</li>
					<li class="fa-comments-o">MENTAL</li>
				</ul>
				<div class="row">
					<div class="6u 12u$(mobile)">
						<section class="box style1">
							<h3>PHYSIQUE</h3>

							<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
								Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
								gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
								ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
								tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
						</section>
					</div>
					<div class="6u 12u$(mobile)">
						<section class="box style1">
							<h3>ÉNERGÉTIQUE</h3>

							<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
								Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
								gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
								ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
								tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
						</section>
					</div>
				</div>
				<div class="row">
					<div class="6u 12u$(mobile)">
						<section class="box style1">
							<h3>ÉMOTIONNEL</h3>

							<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
								Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
								gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
								ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
								tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
						</section>
					</div>
					<div class="6u 12u$(mobile)">
						<section class="box style1">
							<h3>MENTAL</h3>

							<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
								Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
								gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
								ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
								tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
						</section>
					</div>
				</div>
			</div>
			<div class="container ssPara">
				<header><h3>Jean-Michel DEMELT</h3></header>


				<p>Nunc dapibus libero eu justo ornare rutrum. Aenean in enim mauris. Mauris tristique dui quis
					augue mollis, id imperdiet quam imperdiet. Morbi euismod fermentum mi, et mollis sapien pretium
					nec. Cras consequat porttitor purus sed dapibus. Cum sociis natoque penatibus et magnis dis
					parturient montes, nascetur ridiculus mus. Mauris ullamcorper dolor sapien, quis pharetra felis
					faucibus accumsan. Nunc faucibus non mi id sollicitudin. Praesent lacinia diam est, quis luctus
					urna sollicitudin id. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
					inceptos himenaeos. Donec porta magna nibh, sit amet convallis tellus ornare non. Praesent eget
					sollicitudin quam. Curabitur urna purus, imperdiet in diam at, imperdiet elementum nunc.
					Suspendisse urna libero, imperdiet at ligula id, mollis finibus est. Curabitur non leo vitae mi
					mollis euismod.</p>
				<footer>
					<a href="http://www.re-energetique.com/FR/" class="button scrolly">Le site de Jean-Michel</a>
				</footer>

			</div>
			<div class="container ssPara">
				<header><h3>Déontologie</h3></header>

				<p>Nulla pretium ipsum dapibus justo scelerisque malesuada.</p>
				<ul class="feature-icons">
					<li class="fa-gavel">Aliquam at mi in ipsum sodales varius ut et est.</li>
					<li class="fa-gavel">Nullam ipsum elit, finibus ac enim a, malesuada ultrices est.</li>
					<li class="fa-gavel">Nulla nisi nisl, convallis quis pretium vel, consequat non ante. Phasellus
						hendrerit elit ac lectus placerat, eget semper nulla rutrum.
					</li>
				</ul>
			</div>
			<div class="container ssPara">
				<header><h3>Certification</h3></header>

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
			</div>

		</section>';
}

function html_prologue_cabinet($r_tarif, $r_cabinet) {
	echo '<!-- cabinet -->
		<section id="cabinet" class="two">';
			if (mysqli_num_rows($r_cabinet) {
				echo '<div class="container">
						<header>
							<h2>Le cabinet</h2>
							<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
							Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>
						</header>';
						
						$i=0;
						while($enr = mysqli_fetch_assoc($r_formation)) {
							$idPhoto=htmlentities($enr['idPhoto'],ENT_QUOTES,'ISO-8859-1');
							$titre=htmlentities($enr['titre'],ENT_QUOTES,'ISO-8859-1');
							$description=htmlentities($enr['description'],ENT_QUOTES,'ISO-8859-1');
							
							//le i % 2 est pour que tout s'affiche bien
							if($i % 2 == 0) 
								echo '<div class="row">';
									echo '<div class="6u 12u$(mobile)">
											<article class="item">
												<a href="#" class="image fit"><img src=../upload/cabinet/'.$idPhoto.'.png alt=""/></a>

												<header>
													<h4>'.$titre.'</h4>

													<p>'.$description.'</p>
												</header>
											</article>
									</div>';
								
								$i++;
							if($i % 2 == 0) 
								echo '</div>';	
							
							
						}				
				
						
					echo '</div>';
			}
			html_prologue_cabinet_tarif($r_tarif);
			
			echo '</div>
		</section>';
}

function html_prologue_cabinet_tarif($r_tarif) {
	echo '<div class="container ssPara">
				<h3>Tarifs</h3>
				<div class="row">
					<div class="12u">
						<article class="box">
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
						</article>
					</div>
				</div>';
}

function html_prologue_contact() {
	echo '<!-- Contact -->
		<section id="contact" class="four">
			<div class="container">
				<header>
					<h2>Contact</h2>
				</header>

				<p>Elementum sem parturient nulla quam placerat viverra
				mauris non cum elit tempus ullamcorper dolor. Libero rutrum ut lacinia
				donec curae mus. Eleifend id porttitor ac ultricies lobortis sem nunc
				orci ridiculus faucibus a consectetur. Porttitor curae mauris urna mi dolor.</p>

				<form method="post" action="#">
					<div class="row">
						<div class="6u 12u$(mobile)"><input type="text" name="name" placeholder="Name" /></div>
						<div class="6u$ 12u$(mobile)"><input type="text" name="email" placeholder="Email" /></div>
						<div class="12u$">
							<textarea name="message" placeholder="Message"></textarea>
						</div>
						<div class="12u$">
							<input type="submit" value="Send Message" />
						</div>
					</div>
				</form>

			</div>
		</section>';
}

function html_prologue_end_main() {
	echo '</div>';
}

function html_prologue_footer() {
	echo '<!-- Footer -->
			<div id="footer">

				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy; Harmonie. All rights reserved.</li>
						<li>Design: <a href="http://html5up.net">HTML5 UP</a>, <a href="mailto:pprevitali.ke@gmail.com">Pascal
							PREVITALI</a></li>
					</ul>

			</div>';
}

function html_prologue_end() {
	echo '</body>
	
	</html>';

}


?>
