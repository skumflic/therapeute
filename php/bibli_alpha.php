<?php
function html_alpha_start($title, $dir_to_css_color, $body_class = "")
{
    /*
     <!--
    Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
    -->
     */
    echo '<!DOCTYPE HTML>  
           <html>
            <head>
                <title>' . $title . '</title>
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
               
                <link rel="stylesheet" href="html5up-alpha/assets/css/main.css"/>
                <link id="css_color" rel="stylesheet" href=' . $dir_to_css_color .'>
                
            </head>
            
            
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
	echo '<section id="page-wrapper">';
}


function html_alpha_header_menu() {
    echo '<header id="header" class="alt">
		<h1><a href="index.html">Alpha</a> by Harmonie</h1>
		<nav id="nav">
			<ul>
				<li><a href="index.html">Accueil</a></li>
				<li>
				<a href="#" class="icon fa-angle-down">R&eacute;harmonisation Energ&eacute;tique</a>
				<ul>
					<li><a href="#methode">La m&eacute;thode</a></li>
					<li>
					<a href="#plans">Les 4 plans</a>
					<ul>
						<li><a href="#m_physique">Physique</a></li>
						<li><a href="#m_energetique">Energ&eacute;tique</a></li>
						<li><a href="#m_emotion">Emotionnel</a></li>
						<li><a href="#m_mental">Mental</a></li>
					</ul>
					</li>
					<li><a href="#cabinet">Le cabinet</a></li>
				</ul>
				</li>
				<li><a href="#cta">Contact</a></li>
				<!--<li><a href="#cta" class="button">Newsletter</a></li>-->
			</ul>
		</nav>
	</header>';
}

function html_alpha_section_banner($nom, $prenom, $titre, $description) {
    echo ' <section id="banner">
		<h2>' . $nom . ' ' . $prenom . '</h2>

		<p>'. $titre. '</p>

		<p>'. $description .'</p>
		<ul class="actions">
		    <li><a href="#" class="button">En savoir +</a></li>
		</ul>
	    </section>';
}

function html_alpha_main($lienPhoto, $aboutme, $remerciements, $r_formation) {
	echo '<section id="main" class="container">

			<section class="box special">
				<header class="major">
					<h2>A propos de moi.</h2>

					<p><span class="image left"><img src=../upload/'.$lienPhoto.' alt=""/></span>'. $aboutme .'</p>
				</header>    
			</section>
		       
		       $
			<section class="box special features">
				<h3>Remerciements</h3>

				<p>'. $remerciements .'</p>
			</section>';
			
			if (mysqli_num_rows($r_formation) > 0) 
				html_alpha_main_formation($r_formation);
			
	 echo '</section>';
}

function html_alpha_main_formation($r_formation) {
	echo '		<section class="box special features">
			
				<h3>Mes formations</h3>

				<div class="features-row">';
				
					while($enr = mysqli_fetch_assoc($r_formation)) {
						$nom=htmlentities($enr['nom'],ENT_QUOTES,'ISO-8859-1');
						$annee=htmlentities($enr['annee'],ENT_QUOTES,'ISO-8859-1');
						$descriptif=htmlentities($enr['descriptif'],ENT_QUOTES,'ISO-8859-1');
						
						echo '<section>
								<span class="icon major fa-stethoscope accent"></span>

								<h4><strong>'. $nom. ' '. $annee. '</strong></h4>

								<p>'. $descriptif. '</p>
							</section>';	

					}
					
					
				echo '</div>
			</section>';
}

function html_alpha_two($isCertified) {
	echo '<section id="methode" class="container">
		<section class="box special">
		    <header class="major">
			<h2>La methode</h2>

			<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
			    Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
		    </header>
		</section>
		<section id="plans" class="box special features">
			<h3>Les 4 plans</h3>

			 <div class="features-row">
				<section id="m_physique">
					<span class="icon major fa-child accent"></span>

					<h2>PHYSIQUE</h2>

					<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
					Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
					gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
					ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
					tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
				</section>
				<section id="m_energetique">
					<span class="icon major fa-bolt accent"></span>

					<h2>ÉNERGÉTIQUE</h2>

					<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
					Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
					gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
					ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
					tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
				</section>
			</div>
			<div class="features-row">
				<section id="m_emotion">
					<span class="icon major fa-frown-o accent"></span>

					<h2>ÉMOTIONNEL</h2>

					<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
					Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
					gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
					ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
					tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
				</section>
				<section id="m_mental">
					<span class="icon major fa-comments-o accent"></span>
	
					<h2>MENTAL</h2>

					<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
					Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
					gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
					ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
					tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
				</section>
			</div>
		</section>
		<section id="JM" class="box special features">
			<h3>Jean-Michel DEMELT</h3>

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
		</section>
		<section id="deontologie" class="box special features">
			<h3>Déontologie</h3>

			<p>Nulla pretium ipsum dapibus justo scelerisque malesuada.</p>
			<ul class="feature-icons">
				<li class="fa-gavel">Aliquam at mi in ipsum sodales varius ut et est.</li>
				<li class="fa-gavel">Nullam ipsum elit, finibus ac enim a, malesuada ultrices est.</li>
				<li class="fa-gavel">Nulla nisi nisl, convallis quis pretium vel, consequat non ante. Phasellus
				    hendrerit elit ac lectus placerat, eget semper nulla rutrum.</li>
			</ul>
		</section>';
		if ($isCertified == 1) {
			echo '
				<section class="box special features">
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
				</section>';
		}

	echo '</section>';
}

function html_alpha_three($r_tarif, $r_cabinet) {
	echo '<section id="cabinet" class="container">
			<section class="box special">';
			
				if (mysqli_num_rows($r_cabinet) > 0) {

					echo '<header class="major">
						<h2>Le cabinet</h2>

						<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
						Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>
					</header>


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
						
						
						
						
					echo '</div>';
				}
				html_alpha_three_tarif($r_tarif);
			echo '</section>
			
		</section>';
}

function html_alpha_three_tarif($r_tarif) {
	echo '<section id="tarifs" class="box special features">
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

				</section>';
}


function html_alpha_cta() {
	echo '<!-- CTA -->
		<section id="cta">

			<h2>Contactez Moi</h2>

			<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
			Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>

			<form method="post" action="#">
				<div class="row uniform">
					<div class="6u 12u(xsmall)"><input type="text" name="name" id="name" placeholder="Name"/></div>
					<div class="6u 12u(xsmall)"><input type="email" name="email" id="email" placeholder="Email"/></div>
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

	     </section>';
}

function html_alpha_footer($r_reseau, $mail) {
	echo '	<!-- Footer -->
		<footer id="footer">
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
			<ul class="copyright">
				<li>&copy; Harmonie. All rights reserved.</li>
				<li>Design: <a href="http://html5up.net">HTML5 UP</a>, <a href="mailto:pprevitali.ke@gmail.com">Pascal
			    PREVITALI</a></li>
			</ul>
		</footer>';
}

function htlm_end() {
	echo '		</div>
		</body>
	</html>';
}
