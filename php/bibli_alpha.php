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

function html_alpha_section_banner($nom, $prenom) {
    echo ' <section id="banner">
		<h2>' . $nom . ' ' . $prenom . '</h2>

		<p>Thérapeute en Réharmonisation Energ&eacute;tique</p>

		<p>Je vous propose de soulager vos douleurs physiques ou vos chocs &eacute;motionnels importants.</p>
		<ul class="actions">
		    <li><a href="#" class="button">En savoir +</a></li>
		</ul>
	    </section>';
}

function html_alpha_main($lienPhoto, $description) {
	echo '   <section id="main" class="container">

        <section class="box special">
            <header class="major">
                <h2>A propos de moi.</h2>

                <p><span class="image left"><img src=../upload/'.$lienPhoto.' alt=""/></span>'. $description .'</p>
            </header>
            </header>
<!--            <span class="image featured"><img src="../images/fotolia/fotolia_69319557.jpg" alt=""/></span>-->
        </section>
        <section class="box special features">
            <h3>Remerciements</h3>

            <p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
                Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
        </section>

        <section class="box special features">
            <h3>Mes formations</h3>

            <div class="features-row">
                <section>
                    <span class="icon major fa-stethoscope accent"></span>

                    <h4><strong>orci</strong></h4>

                    <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
                        phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
                </section>
                <section>
                    <span class="icon major fa-cubes accent"></span>

                    <h4><strong>porttitor</strong></h4>

                    <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
                        phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
                </section>
            </div>
            <div class="features-row">
                <section>
                    <span class="icon major fa-book accent"></span>

                    <h4><strong>lacinia</strong></h4>

                    <p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
                        Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
                </section>
                <section>
                    <span class="icon major fa-medkit accent"></span>

                    <h4><strong>ultricies</strong></h4>

                    <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
                        phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
                </section>
            </div>
            <div class="features-row">
                <section>
                    <span class="icon major fa-ambulance accent"></span>

                    <h4><strong>nec</strong></h4>

                    <p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
                        Adipiscing cubilia elementum integer lorem ipsum dolor sit amet.</p>
                </section>
                <section>
                    <span class="icon major fa-users accent"></span>

                    <h4><strong>interdum</strong></h4>

                    <p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum
                        phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
                </section>
            </div>
        </section>
    </section>';
}

function html_alpha_two() {
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
		</section>
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
		</section>

	</section>';
}

function html_alpha_three() {
	echo '<section id="cabinet" class="container">
			<section class="box special">
				<header class="major">
					<h2>Le cabinet</h2>

					<p>Integer eu ante ornare amet commetus vestibulum blandit integer in curae ac faucibus integer non.
					Adipiscing cubilia elementum integer. Integer eu ante ornare amet commetus.</p>
				</header>


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
				<section id="tarifs" class="box special features">
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
									<td>Something</td>
									<td>Ante turpis integer aliquet porttitor.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>Nothing</td>
									<td>Vis ac commodo adipiscing arcu aliquet.</td>
									<td>19.99</td>
								</tr>
								<tr>
									<td>Something</td>
									<td> Morbi faucibus arcu accumsan lorem.</td>
									<td>29.99</td>
								</tr>
								<tr>
									<td>Nothing</td>
									<td>Vitae integer tempus condimentum.</td>
									<td>19.99</td>
								</tr>
								<tr>
									<td>Something</td>
									<td>Ante turpis integer aliquet porttitor.</td>
									<td>29.99</td>
								</tr>
							</tbody>

						</table>
					</div>

				</section>

			</section>
			
		</section>';
}

function html_copyright() {
    echo '<ul class="copyright">
                <li>&copy; Harmonie. All rights reserved.</li>
                <li>Design: <a href="http://html5up.net">HTML5 UP</a>, <a href="mailto:pprevitali.ke@gmail.com">Pascal
                    PREVITALI</a></li>
            </ul>';
}

function html_social_network_get_icon_class($name) {
    switch ($name) {
        case "Twitter":
            return '"icon fa-twitter"';
        case "Facebook":
            return '"icon fa-facebook"';
        case "Google+":
            return '"icon fa-google-plus"';
        case "Email":
            return '"icon fa-envelope"';
    }
}

function html_social_network($href, $name) {
    $icon=html_social_network_get_icon_class($name);
    echo ' <li><a href='.$href.' class='.$icon.'><span class="label">'.$name.'</span></a></li>';
}

function htlm_end() {
	echo '		</div>
		</body>
	</html>';
}
