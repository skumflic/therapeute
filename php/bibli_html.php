<?php

function html_debut($title){
    echo '<!doctype html>
        <html>
            <head>
            <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
            <title>'.$title.'</title>
       

            <link rel="stylesheet" type="text/css" href="../style/main.css" />
            <link rel="stylesheet" id="size-stylesheet" type="text/css" href="../style/wide.css" />
           <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

            </head>
            <body><div id="bg_page">';
}
function w_html_debut($title){
    echo '<!doctype html>
        <html>
            <head>
            <meta charset="utf-8">
            <title>'.$title.'</title>

  
            <link rel="stylesheet" type="text/css" href="style/main.css" />
            
            <link rel="stylesheet" id="size-stylesheet" type="text/css" href="style/narrow.css" />
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKmYwZao_s-Pov_59MrtJkdlwIAjWPQIk"></script> <!-- là j\'ai mis ma propre clef api google, faudra que tu generes la tienne -->
             <script type="text/javascript" src="js/map.js"></script>
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  			<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  			

            </head>
            <body>';
}

function html_header($connection=""){
    echo '<header>
            <div id="h_logo_part">
                  <img id="h_logo" src="../images/logo.png">
                  <span id="site_name">Re-energetique</span>
            </div>
            <div id="h_trianle_left"></div>
            <a href="deconnection.php" id="h_log_out"';

            if ($connection!="") {
                echo ' style="background: #565658;"';
            }
            echo '><a href="deconnection.php" id="h_log_out_img"></a ><div id="h_trianle_right"></div>
     <span id="navbar_open_menu"></span>    
    </header>';
}

function html_header_espace_admin(){
    echo '<header>
            <div id="h_logo_part">
                <img id="h_logo" src="../images/logo.png">
                <span id="site_name">Re-energetique</span>
            </div>
            <div id="h_trianle_left"></div>
            <div id="h_log_out">
                    <div="h_log_out_img"></div>
            </div>
            <div id="h_trianle_right"></div>
 
</header>';
}

function html_nav($active, $moderator, $supp_class, $mod_espace=""){

    echo '<div id="tmp"><nav>
             <div id="menu" class="overlay '.$supp_class.'">
             <a class="closebtn"></a>
             <ul class=nav-container>';
            if ($moderator>3){
                echo '<li class="espace_mod_menu_narrow ';
        if ($active == -2) echo ' m_active';
        echo '">                
                <a href="admin.php">
                    <span class=name>Espace administrateur</span>
                </a>
            </li>';
            }
    if ($moderator>1){
        echo '<li class="espace_mod_menu_narrow';
        if ($active == -1) echo ' m_active';
        echo '">                
                <a href="moderateur.php">
                    <span class=name>Espace moderatuer</span>
                </a>
            </li>';
    }
    if ($moderator % 2 == 1) {
        if($mod_espace==1){
            echo '<li id="li_infoperso" class="wide_menu_mod ';
            if ($active == 1) {
                echo ' m_active';
            }
            echo '">
                    <a href="infoperso.php">
                        <span class=icon ></span>
                        <span class=name>Information presonnelle</span>
                    </a>
                </li>
                 <li id="li_formation" class="wide_menu_mod ';
            if ($active == 2) {
                echo ' m_active';
            }
            echo '">
                    <a href="formation.php">
                        <span class=icon ></span>
                        <span class=name>Formation et experience</span>
                    </a>
                </li> 
                 <li id="li_cabinet" class="wide_menu_mod ';
            if ($active == 3) {
                echo ' m_active';
            }
            echo '">
                    <a href="cabinet.php">
                        <span class=icon ></span>
                        <span class=name>Cabinet</span>
                    </a>
                </li> 
                 <li id="li_tarif" class="wide_menu_mod ';
            if ($active == 4) {
                echo ' m_active';
            }
            echo '">
                    <a href="tarif.php">
                        <span class=icon ></span>
                        <span class=name>Tarif</span>
                    </a>
                </li> 
                 <li id="li_preview" class="wide_menu_mod ';
            if ($active == 5) {
                echo ' m_active';
            }
            echo '">
                    <a href="preview.php">
                        <span class=icon ></span>
                        <span class=name>Preview</span>
                    </a>
                </li>';
        } else {
        if ($moderator % 2 == 1) {
            echo '<li id="li_infoperso"';
            if ($active == 1) {
                echo ' class="m_active"';
            }
            echo '>
                    <a href="infoperso.php">
                        <span class=icon ></span>
                        <span class=name>Information presonnelle</span>
                    </a>
                </li>
                 <li id="li_formation"';
            if ($active == 2) echo ' class="m_active"';
            echo '>
                    <a href="formation.php">
                        <span class=icon ></span>
                        <span class=name>Formation et experience</span>
                    </a>
                </li> 
                 <li id="li_cabinet"';
            if ($active == 3) echo ' class="m_active"';
            echo '>
                    <a href="cabinet.php">
                        <span class=icon ></span>
                        <span class=name>Cabinet</span>
                    </a>
                </li> 
                 <li id="li_tarif"';
            if ($active == 4) echo ' class="m_active"';
            echo '>
                    <a href="tarif.php">
                        <span class=icon ></span>
                        <span class=name>Tarif</span>
                    </a>
                </li> 
                 <li id="li_preview"';
            if ($active == 5) echo ' class="m_active"';
            echo '>
                    <a href="preview.php">
                        <span class=icon ></span>
                        <span class=name>Preview</span>
                    </a>
                </li>';
        }
    }
    }
    echo '<li class="espace_mod_menu_narrow" id="li_deconnection">                
                <a href="deconnection.php">
                    <span class=name>Se deconnecter</span>
                </a>
            </li>';
       echo '</ul>
</nav></div> ';
}



function html_menu_espace($moderator, $part_mod){
    if ($moderator<3){
        return;
    }
    if ($part_mod==1){
        echo '<ul class="menu_espace_left ">';
    }else{
        echo '<ul class="menu_espace_right ">';
    }
    switch ($moderator){
        case 3:
                mod();
                thera();
                break;
        case 4:
                admin();
                mod();
                break;
        case 5:
                admin();
                mod();
                thera();
    }


       echo '</ul>';

}


function admin(){
    echo '<li id="me_admin"><a href="admin.php">
                      <span class="me_icon"></span>
                       <span class="me_text">Administrateur</span>
                       </a>
            </li>';
}
function mod(){
    echo '<li id="me_mod"><a href="moderateur.php">
                      <span class="me_icon"></span>
                       <span class="me_text">Moderateur</span>
                       </a>
            </li>';
}
function thera(){
    echo '<li id="me_thera"><a href="infoperso.php">
                      <span class="me_icon"></span>
                       <span class="me_text">Thérapeute</span>
                       </a>
            </li>';
}
function html_espace($to, $text, $right){
if ($right==1) {
    echo '<a href="'. $to .'" id="espace_right_shape"><div id="espace_right"><span>'.$text.'</span><img id="espace_right_img" src="../images/arrow-right.png"> </div></a>';
}else{
    echo '<a href="' . $to . '" id="espace_left_shape"><div id="espace_left"><span>'.$text.'</span><img id="espace_left_img" src="../images/arrow-left.png"> </div></a>';
}

}

function html_footer($border_color){
    echo '<footer style="border-color: '.$border_color.'">
<span id="copyright">© Re-energetique.fr 2017 by Guzal KHUSANOVA & Corentin BOURVON</span>
</footer>';
}

function html_fin($welcome=""){
    echo '</div>';
    echo '
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  <script type="text/javascript" src="';
    if($welcome==""){
        echo '../js/js_functions.js';
    }else{
        echo 'js/js_functions.js';
    }
   echo '"></script></body>
</html>';
}

/*
 *   		      			 <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
 */
?>