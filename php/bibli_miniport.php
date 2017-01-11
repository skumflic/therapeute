<?php

function html_miniport_start($title, $dir_to_css_color, $body_class = "") {
	echo '
	<!DOCTYPE HTML>
	<!--
		Miniport by HTML5 UP
		html5up.net | @n33co
		Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
	-->
	<html>
		<head>
			<title>'. $title . '</title>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
			<link rel="stylesheet" href="html5up-miniport/assets/css/main.css" />
			<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
			<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
			<link id="css_color" rel="stylesheet" href="html5up-miniport/assets/css/' .$dir_to_css_color. '" />
		</head>
		
		<!-- Scripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/jquery.scrolly.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/skel-viewport.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="html5up-miniport/assets/js/main.js"></script>
		
		<body>';

}

function html_miniport_nav() {
	echo '<!-- Nav -->
		<nav id="nav" class="nav">
			<ul class="container">
				<li><a href="#accueil">Accueil</a></li>
				<li><a href="#methode">La méthode</a></li>
				<!--					<li><a href="#JM">Jean-Michel DEMELT</a></li>
					    <li><a href="#deontologie">Déontologie</a></li>
					    <li><a href="#certif">Certification</a></li>-->
				<li><a href="#cabinet">Cabinet</a></li>
				<li><a href="#contact">Contact</a></li>
				<!--					<li><a href="#cta" class="button">Newsletter</a></li>-->
			</ul>
		</nav>';
}

function html_miniport_home($img, $nom, $prenom, $titre) {
	echo '<!-- Home -->
		<div class="wrapper style1 first">
			<article class="container" id="accueil">
				<div class="row">
					<div class="4u(tablet)">
						<span class="image fit"><img class="logo" src=../upload/'.$img.' alt=""  itemprop="logo"/></span>
					</div>
					<div class="8u(tablet)">
						<header>
							<h1><strong>'. $nom . ' ' . $prenom . '</strong></h1>
						</header>
						<p>'. $titre .'</p>
						<p>Unde Rufinus ea tempestate praefectus praetorio ad discrimen trusus est ultimum.</p>
						<a href="#methode" class="button big scrolly">En savoir +</a>
					</div>
				</div>
			</article>
		</div>';
}

function html_miniport_presentation($description) {
	echo '<!-- presentation -->
		<div class="wrapper style2">
			<article id="presentation">
				<header>
					<h2>A propos de moi.</h2>
				</header>
				<div class="container">
					<div class="row">
						<p>'. $description .'</p>
					</div>
				</div>
			</article>
		</div>';
}
		
function html_miniport_remerciements() {
	echo '<!-- Remerciements -->
		<div class="wrapper style3">
			<article id="Remerciements">
				<header>
					<h3>Remerciements</h3>
				</header>
				<div class="container">
					<div class="row">
						<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
							Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
					</div>
				</div>
			</article>
		</div>';
}	

function html_miniport_formation() {
		echo '<!-- formations -->
		<div class="wrapper style3">
			<article id="formations">
				<header>
					<h3>Mes formations</h3>
				</header>
				<div class="container">
					<div class="row">
						<p>Nulla nec augue posuere, ornare elit a, condimentum sapien. Nullam rutrum dui at elit dapibus, quis
							lobortis ex aliquet. Maecenas sed purus nec nulla mattis interdum.</p>
					</div>
					<div class="row">
						<div class="4u 4u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-stethoscope accent"></span>

								<h4>orci</h4>

								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
									phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
						<div class="4u 4u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-cubes accent"></span>

								<h4>porttitor</h4>

								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
									phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
						<div class="4u 4u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-book accent"></span>

								<h4>lacinia</h4>

								<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
									Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
							</section>
						</div>
					</div>
					<div class="row">
						<div class="4u 4u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-medkit accent"></span>

								<h4>ultricies</h4>

								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
									phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
						<div class="4u 4u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-ambulance accent"></span>

								<h4>nec</h4>

								<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
									Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
							</section>
						</div>
						<div class="4u 4u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-users accent"></span>

								<h4>interdum</h4>

								<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
									phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
							</section>
						</div>
					</div>
				</div>
			</article>
		</div>';
}

function html_miniport_methode() {
	echo '<!-- methode -->
		<div class="wrapper style2">
			<article id="methode">
				<header>
					<h2>La méthode DEMELT</h2>
					<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
						Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
				</header>
				<div class="container">
					<div class="row">
						<div class="6u 6u(tablet) 12u(mobile)">
							<section class="box style2">
								<span class="icon featured fa-child "></span>
								<h3>PHYSIQUE</h3>
								<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
									Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
									gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
									ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
									tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
							</section>
						</div>
						<div class="6u 6u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-bolt "></span>
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
						<div class="6u 6u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-frown-o "></span>
								<h3>ÉMOTIONNEL</h3>
								<p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
									Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
									gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
									ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
									tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
							</section>
						</div>
						<div class="6u 6u(tablet) 12u(mobile)">
							<section class="box style1">
								<span class="icon featured fa-comments-o "></span>
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
			</article>
		</div>';
}
	
function html_miniport_delmet() {
	echo '<!-- DEMELT -->
		<div class="wrapper style3">
			<article id="DEMELT">
				<header>
					<h3>Jean-Michel DEMELT</h3>
				</header>
				<div class="container">
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
				</div>
				<footer>
					<a href="http://www.re-energetique.com/FR/" class="button scrolly">Le site de Jean-Michel</a>
				</footer>
			</article>
		</div>';
}
		
function html_miniport_deontologie() {
	echo '<!-- Déontologie -->
		<div class="wrapper style3">
			<article id="Déontologie">
				<header>
					<h3>Déontologie</h3>
				</header>
				<div class="container">
					<p>Nulla pretium ipsum dapibus justo scelerisque malesuada.</p>
					<ul class="feature-icons">
						<li class="fa-gavel">Aliquam at mi in ipsum sodales varius ut et est.</li>
						<li class="fa-gavel">Nullam ipsum elit, finibus ac enim a, malesuada ultrices est.</li>
						<li class="fa-gavel">Nulla nisi nisl, convallis quis pretium vel, consequat non ante. Phasellus
							hendrerit elit ac lectus placerat, eget semper nulla rutrum.
						</li>
					</ul>
				</div>
			</article>
		</div>';
}

function html_miniport_certification() {
	echo '<!-- Certification -->
		<div class="wrapper style3">
			<article id="Certification">
				<header>
					<h3>Certification</h3>
				</header>
				<div class="container">
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
			</article>
		</div>';
}

function html_miniport_cabinet() {
	echo '<!-- cabinet -->
		<div class="wrapper style2">
			<article id="cabinet">
				<header>
					<h2>Le cabinet</h2>
					<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
						Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>
				</header>
				<div class="container">
					<div class="row">
						<div class="6u 12u(mobile)">
							<article class="box style2">
								<a href="#" class="image featured"><img src="../images/fotolia/fotolia_88327670.jpg" alt="" /></a>
								<h4><a href="#">Possibly broke spacetime</a></h4>
								<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus
									integer adipiscing ornare amet.</p>
							</article>
						</div>
						<div class="6u 12u(mobile)">
							<article class="box style2">
								<a href="#" class="image featured"><img src="../images/fotolia/fotolia_84543149.jpg" alt="" /></a>
								<h4><a href="#">Terraformed a small moon</a></h4>
								<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus
									integer adipiscing ornare amet.</p>
							</article>
						</div>
					</div>
					<div class="row">
						<div class="6u 12u(mobile)">
							<article class="box style2">
								<a href="#" class="image featured"><img src="../images/fotolia/fotolia_79923444.jpg" alt="" /></a>
								<h4><a href="#">Snapped dark matter in the wild</a></h4>
								<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus
									integer adipiscing ornare amet.</p>
							</article>
						</div>
					</div>
				</div>
			</article>
		</div>';
}

function html_miniport_tarif() {
	echo '<!-- Tarifs -->
		<div class="wrapper style3">
			<article id="Tarifs">
				<header>
					<h3>Tarifs</h3>
				</header>
				<div class="container">
					<div class="row">
						<div class="12u 12u(mobile)">
							<article class="box style2">
								<div class="table-wrapper">
									<table class="alt">
										<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Price</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>Item One</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item Two</td>
											<td>Vis ac commodo adipiscing arcu aliquet.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item Three</td>
											<td> Morbi faucibus arcu accumsan lorem.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item Four</td>
											<td>Vitae integer tempus condimentum.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item Five</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
										</tbody>
									</table>
								</div>
							</article>
						</div>
					</div>
				</div>
			</article>
		</div>';
}

function html_miniport_contact() {
	echo '<!-- Contact-->
		<div class="wrapper style2">
			<article id="contact" class="container 75%">
				<header>
					<h2>Contactez Moi</h2>

					<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
						Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>
				</header>
				<div>
					<div class="row">
						<div class="12u">
							<form method="post" action="#">
								<div>
									<div class="row">
										<div class="6u 12u(mobile)">
											<input type="text" name="name" id="name" placeholder="Name" />
										</div>
										<div class="6u 12u(mobile)">
											<input type="text" name="email" id="email" placeholder="Email" />
										</div>
									</div>
									<div class="row">
										<div class="12u">
											<input type="text" name="subject" id="subject" placeholder="Subject" />
										</div>
									</div>
									<div class="row">
										<div class="12u">
											<textarea name="message" id="message" placeholder="Message"></textarea>
										</div>
									</div>
									<div class="row 200%">
										<div class="12u">
											<ul class="actions">
												<li><input type="submit" value="Send Message" /></li>
												<li><input type="reset" value="Clear Form" class="alt" /></li>
											</ul>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="12u">
							<hr />
							<h3>Find me on ...</h3>
							<ul class="social">
								<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
								<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
								<!--
					<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
					<li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
					<li><a href="#" class="icon fa-tumblr"><span class="label">Tumblr</span></a></li>
					<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>

					<li><a href="#" class="icon fa-rss"><span>RSS</span></a></li>
					<li><a href="#" class="icon fa-instagram"><span>Instagram</span></a></li>
					<li><a href="#" class="icon fa-foursquare"><span>Foursquare</span></a></li>
					<li><a href="#" class="icon fa-skype"><span>Skype</span></a></li>
					<li><a href="#" class="icon fa-soundcloud"><span>Soundcloud</span></a></li>
					<li><a href="#" class="icon fa-youtube"><span>YouTube</span></a></li>
					<li><a href="#" class="icon fa-blogger"><span>Blogger</span></a></li>
					<li><a href="#" class="icon fa-flickr"><span>Flickr</span></a></li>
					<li><a href="#" class="icon fa-vimeo"><span>Vimeo</span></a></li>
					-->
							</ul>
							<hr />
						</div>
					</div>
				</div>
				<footer>
					<ul id="copyright">
						<li>&copy; Harmonie. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a>, <a href="mailto:pprevitali.ke@gmail.com">Pascal PREVITALI</a></li>
					</ul>
				</footer>
			</article>
		</div>-->';
}

function html_miniport_end() {
	echo '</body>
	</html>';
}


?>