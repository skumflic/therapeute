<?php 

function html_readonly_start($title, $dir_to_css_color) {
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
		    <link rel="stylesheet" href="html5up-read-only/assets/css/main.css"/>
		    <link id="css_color" rel="stylesheet" href='.$dir_to_css_color.'>
		    <!--[if lte IE 8]>
		    <link rel="stylesheet" href="html5up-read-only/assets/css/ie8.css"/><![endif]-->
		</head>
		<!-- Scripts -->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/jquery.scrollzer.min.js"></script>
		<script src="../assets/js/jquery.scrolly.min.js"></script>
		<script src="../assets/js/skel.min.js"></script>
		<script src="../assets/js/util.js"></script>
		<!--[if lte IE 8]>
		<script src="../assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="html5up-read-only/assets/js/main.js"></script>
		
		
		<body>';


}


function html_readonly_header($lienPhoto, $nom, $prenom, $titre, $description) {
	echo '<!-- Header -->
	<section id="header" class="top">
	    <header>
		<span class="image avatar"><img src=../upload/'.$lienPhoto.' alt=""/></span>

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
		<ul class="icons">
		    <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
		    <li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
		    <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
		    <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
		</ul>
	    </footer>
	</section>
	
	
	<!-- Wrapper -->
	<div id="wrapper">

	    <!-- Main -->
	    <div id="main">';
}

function html_readonly_one($nom, $prenom) {
	echo '<!-- One -->
		<section id="one">
		    <div class="container">
			<header class="major">
			    <h2>'. $nom . ' ' . $prenom .'</h2>

			    <p>A propos de moi.</p>
			</header>
			<p>Mauris accumsan metus velit, quis molestie ligula pellentesque ac. Suspendisse feugiat lectus ex, nec
			    finibus ligula ornare quis. Praesent in facilisis orci, eu fermentum ex. Praesent maximus libero nec
			    felis aliquam feugiat. Proin tempor lobortis blandit. Duis ut tortor commodo, egestas massa at,
			    dictum felis. Phasellus blandit condimentum dolor, a ornare leo varius eget. Suspendisse quis
			    posuere ligula, id tristique orci. Proin porttitor lacus ante, vitae lacinia metus sagittis at.
			    Mauris bibendum non turpis eu semper. Quisque pharetra est at felis consectetur, ac varius purus
			    tristique. Donec dapibus dictum ultricies.</p>
		    </div>
		    <div class="container">
			<h3>Remerciements</h3>

			<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
			    Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
		    </div>
		    <div class="container">
			<h3>Mes formations</h3>

			<p>Nulla nec augue posuere, ornare elit a, condimentum sapien. Nullam rutrum dui at elit dapibus, quis
			    lobortis ex aliquet. Maecenas sed purus nec nulla mattis interdum.</p>
			<ul class="feature-icons">
			    <li class="fa-stethoscope">orci</li>
			    <li class="fa-cubes">porttitor</li>
			    <li class="fa-book">lacinia</li>
			    <li class="fa-medkit">ultricies</li>
			    <li class="fa-ambulance">nec</li>
			    <li class="fa-users">interdum</li>
			</ul>
		    </div>
		</section>';
}

function html_readonly_two() {
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

					    <p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
						Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
						gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
						ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
						tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
					</section>
				    </div>
				    <div class="6u 12u(small)">
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
				    <div class="6u 12u(small)">
					<section class="box style1">
					    <h3>ÉMOTIONNEL</h3>

					    <p>Duis congue felis at ligula blandit pretium. Nulla lacinia nulla a porta auctor.
						Quisque quis neque sed ipsum ornare bibendum. Phasellus et finibus ante. Sed
						gravida, nisl lacinia ornare convallis, erat est lacinia mauris, vitae ultrices orci
						ex vel leo. Pellentesque non nisi at mi porta vehicula in mattis lacus. Suspendisse
						tempus nulla mi, vitae ullamcorper metus bibendum at.</p>
					</section>
				    </div>
				    <div class="6u 12u(small)">
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
			</article>
			<article>
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
			    </article>
			    <article>

				<h3>Déontologie</h3>

				<p>Nulla pretium ipsum dapibus justo scelerisque malesuada.</p>
				<ul class="feature-icons">
				    <li class="fa-gavel">Aliquam at mi in ipsum sodales varius ut et est.</li>
				    <li class="fa-gavel">Nullam ipsum elit, finibus ac enim a, malesuada ultrices est.</li>
				    <li class="fa-gavel">Nulla nisi nisl, convallis quis pretium vel, consequat non ante. Phasellus
					hendrerit elit ac lectus placerat, eget semper nulla rutrum.
				    </li>
				</ul>
			    </article>
			    <article>

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
			    </article>
			</div>
		    </div>
		</section>';
}

function html_readonly_three() {
	echo '<!-- Three -->
		<section id="three">
		    <div class="container">
			<h2>Le cabinet</h2>

			<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
			    Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>

			<div class="features">
			    <article>
				<a href="#" class="image"><img src="../images/fotolia/fotolia_88327670.jpg" alt=""/></a>

				<div class="inner">
				    <h4>Possibly broke spacetime</h4>

				    <p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus
					integer adipiscing ornare amet.</p>
				</div>
			    </article>
			    <article>
				<a href="#" class="image"><img src="../images/fotolia/fotolia_84543149.jpg" alt=""/></a>

				<div class="inner">
				    <h4>Terraformed a small moon</h4>

				    <p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus
					integer adipiscing ornare amet.</p>
				</div>
			    </article>
			    <article>
				<a href="#" class="image"><img src="../images/fotolia/fotolia_79923444.jpg" alt=""/></a>

				<div class="inner">
				    <h4>Snapped dark matter in the wild</h4>

				    <p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus
					integer adipiscing ornare amet.</p>
				</div>
			    </article>
			</div>
		    </div>
		    <div class="container">
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
		    </div>

		</section>';
}

function html_readonly_four() {
	echo '<!-- Four -->
		<section id="four">
		    <div class="container">
			<h3>Contactez Moi</h3>

			<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
			    Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>

			<form method="post" action="#">
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
