/*$(window).scroll(function() {
    if ( $(this).scrollTop() > 70) {
        document.getElementsByTagName("nav")[0].style.top="30px";

    } else {
        document.getElementsByTagName("nav")[0].style.top="100px";
    }
});*/

window.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("form_changer_skin");
    if(document.getElementById("skin_1"))
        document.getElementById("skin_1").addEventListener("click", function () {
        document.getElementById("skin").value='1';
        form.submit();
    });
    if(document.getElementById("skin_2"))
    document.getElementById("skin_2").addEventListener("click", function () {
        document.getElementById("skin").value='2';
        form.submit();
    });
    if(document.getElementById("skin_3"))
    document.getElementById("skin_3").addEventListener("click", function () {
        document.getElementById("skin").value='3';
        form.submit();
    });
    if(document.getElementById("skin_4"))
    document.getElementById("skin_4").addEventListener("click", function () {
        document.getElementById("skin").value='4';
        form.submit();
    });

   document.getElementById("color_bleu").addEventListener("click", bleu);
   document.getElementById("color_jaune").addEventListener("click", jaune);
   document.getElementById("color_orange").addEventListener("click", orange);
   document.getElementById("color_rouge").addEventListener("click", rouge);
   document.getElementById("color_vert").addEventListener("click", vert);
   document.getElementById("color_rose").addEventListener("click", rose);
    document.getElementById("tab_inscription").addEventListener("click", function () {
        document.getElementById("tab_inscription").style.background='#fbfbfb';


    });

});


  $(document).ready(function(){
      form_validate_formation();
      form_validate_experience();
      form_validate_tarif();
     form_validate_cabinet();
      //  form_validate_photo();
      adjustStyle($(window).width());
      $(window).resize(function() {
          adjustStyle($(window).width());
          if($( window ).width()>1800) {
              $("#bg_page").css("transform", "translateX(0%)");
          }else {
              $("#bg_page").css("transform", "none");
          }
      });

    if($('.datepicker').datepicker)
	$('.datepicker').datepicker({
	    dateFormat: 'yy-mm-dd',
         inline: true,
        showOtherMonths: true,
        dayNamesMin: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam']});

	$('.btn_changer_cabinet').click(changerCabinetPrincipal);
	$('.btn_consulter').click(consulterFormation);
	$('.btn_modifier').click( montrerFormDeModification);
	$('.btn_annuler').click(annulerModification);
	//$('.btn_supprimer').click(supprimer);
	$('.btn_change_photo').click(changerPhoto);
	$('.btn_modifier_text').click(modifierTextePhoto);
	$('.btn_annuler_photo').click(annulerModificationTextePhoto);
	$('.btn_annuler_changement').click(annulerChangerPhoto);
      show_sm_infoperso();
      show_sm_photo();
     show_sm_reseau();
        show_sm_site_vitrine();
      show_sm_password();
      show_inscription();
      show_connection();
      show_password_div();

      show_cab_insert_cabinet();

      show_cab_insert_photo();
      $(".input_file_button").click(file_upload);

      $(".input_file").on("change", function (ev) {
          $(".input_file_name").val(ev.target.value);
      });

      welcome_page();
      admin_page();

      $("#navbar_open_menu").click(openNav);
      $(".closebtn").click(closeNav);
       $("#btn_cab_new_photo").click(photo_validation);

      $("#cab_new_photo").change(function(e) {
          $(".photo_extension").hide();
          $(".photo_size").hide();
          $(".photo_wh").hide();
          $(".photo_required").hide();
      });
/*
      $(".table_admin_more").on('mouseover', function (ev) {
          //$(".table_admin_more").css("background", "red");
          $(ev.target).closest("form").find(".admin_table_narrow").css("display", "block");
      }).bind('mouseout',  function(){
          $(".table_admin_more").css("background", "yellow");
      });
*/

      $(".table_admin_more").click(function (ev) {
          $(ev.target).closest("form").find(".table_admin_buttons").toggle();
      });
  })

function photo_validation(ev) {
    ev.preventDefault();
    var file=$("#cab_new_photo");
    var ok=true;
    if(file.val()!="") {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray(file.val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            ok=false;
            $(ev.target.form).find(".photo_extension").show();
        }

        if (typeof (file[0].files) != "undefined") {
            var size = parseFloat(file[0].files[0].size / 1024).toFixed(2);
            if (file[0].files[0].size > 500000) {
                $(ev.target.form).find(".photo_size").show();
                ok=false;
            }
        } else {
            alert("This browser does not support HTML5.");
            ok=false;
        }
        var _URL = window.URL || window.webkitURL;

        var file, img;
        if ((file = file[0].files[0])) {
            img = new Image();
            img.onload = function () {
                if (this.width != this.height) {
                    $(ev.target.form).find(".photo_wh").show();
                    ok=false;
                }
            };
            img.src = _URL.createObjectURL(file);
        }
    }else{
        $(ev.target.form).find(".photo_required").show();
        ok=false;
    }
    if (ok){
       // alert("Tok");
    /* $("#btn_cab_new_photo").submit();
        $("#form_cab_photo").find('input[type="submit"]').css("color","green");
        $("#form_cab_photo").find('input[type="submit"]').submit();*/
        $("#form_cab_photo").submit();
    }

}

function file_upload(ev) {
    ev.preventDefault();
    var input_file=$(ev.target).closest("form").find(".input_file");

    input_file.click();

}
/*onkeypress='return isNumericInput(event);'/*/
function bleu () {
    document.getElementById("css_color").href = '../style/color/bleu.css';
    document.getElementById("color").value='1';
}

function jaune() {
    document.getElementById("css_color").href = '../style/color/jaune.css';
    document.getElementById("color").value='2';
}
function orange () {
    document.getElementById("css_color").href = '../style/color/orange.css';
    document.getElementById("color").value='3';
}

function vert () {
    document.getElementById("css_color").href = '../style/color/vert.css';
    document.getElementById("color").value='6';
}

function rose () {
    document.getElementById("css_color").href = '../style/color/rose.css';
    document.getElementById("color").value='4';
}

function rouge () {
    document.getElementById("css_color").href = '../style/color/rouge.css';
    document.getElementById("color").value='5';
}

function init_skin2() {
    document.getElementById("skin").value='2';
    var form = document.getElementById("form_changer_skin");

    document.getElementById("changer_skin").addEventListener("click", function () {
        form.submit();
    });
}

function changerPhoto(ev){
    ev.preventDefault();
    $(ev.target.form).find(".cabinet_download_photo").show();
    $(ev.target.form).find(".cabinet_aff_lbl").hide();
    $(ev.target.form).find(".cabinet_aff_input").hide();
}

function annulerChangerPhoto(ev){
    ev.preventDefault();
    $(ev.target.form).find(".cabinet_download_photo").hide();
    $(ev.target.form).find(".cabinet_aff_lbl").show();
    $(ev.target.form).find(".cabinet_aff_input").hide();
    $(ev.target.form).find(".lbl_buttons").show();
}


function modifierTextePhoto(ev){
    ev.preventDefault();
    $(ev.target).closest("form").find(".cabinet_aff_input").show();
    $(ev.target.form).find(".lbl_buttons").hide();
    $(ev.target).closest("form").find(".cabinet_aff_lbl").hide();

}

function annulerModificationTextePhoto(ev){
    ev.preventDefault();
    $(ev.target).closest("form").find(".cabinet_aff_input").hide();
    $(ev.target).closest("form").find(".cabinet_aff_lbl").show();

}

function changerCabinetPrincipal(ev){
    ev.preventDefault();
   // $(".aff_lbl").hide();
 //  $(".aff_input").hide();
    $("#form_cabinet_principal").hide();
    $('#form_cabinet_radio').show();
}

function consulterFormation(ev){
    ev.preventDefault();
    $(ev.target.form).find(".form_hidden").toggle();
}

function  montrerFormDeModification(ev){
    ev.preventDefault();
    $(ev.target.form).find(".aff_lbl").hide();
   $(ev.target.form).find(".lbl_buttons").hide();
    $(ev.target.form).find(".aff_input").show();
}


function annulerModification(ev){
    ev.preventDefault();
    $(ev.target.form).find(".aff_input").hide();
    $(ev.target.form).find(".aff_lbl").show();
    $(ev.target.form).find(".lbl_buttons").show();
    $(ev.target.form).find(".lbl_buttons").style.visibility="hidden";
}

function supprimer(ev){
    ev.preventDefault();
    if (confirm('Are you sure you want to save this thing into the database?')) {
        $(ev.target.form).find(".btn_supprimer").submit();

    } else {
        ev.preventDefault();
    }

}
function isNumericInput(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode == 8 || event.keyCode == 46
        || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    }
    else if ( key < 48 || key > 57 ) {
        return false;
    }
    else return true;
};

function show_sm_infoperso() {
    $('#sm_infoperso').click(function () {
        $('#div_site_vitrine').hide();
        $('#div_photo').hide();
        $('#div_reseau').hide();
        $('#div_infoperso').show();
        $('#div_password').hide();
        $('.sub_li').css("background", "#6E7378");
        $('#sm_infoperso').css("background", "url(\"../images/left-triangle.png\") #6E7378 right no-repeat");
        $('#sm_infoperso').css("background-size", "auto 50%");
    });


}

function show_sm_photo() {
    $('#sm_photo').click(function () {
        $('#div_site_vitrine').hide();
        $('#div_photo').show();
        $('#div_reseau').hide();
        $('#div_infoperso').hide();
        $('#div_password').hide();
        $('.sub_li').css("background", "#6E7378");
        $('#sm_photo').css("background", "url(\"../images/left-triangle.png\") #6E7378 right no-repeat");
        $('#sm_photo').css("background-size", "auto 50%");

    });

}

function show_sm_reseau() {
    $('#sm_reseau').click(function () {
        $('#div_site_vitrine').hide();
        $('#div_photo').hide();
        $('#div_reseau').show();
        $('#div_infoperso').hide();
        $('#div_password').hide();
        $('.sub_li').css("background", "#6E7378");
        $('#sm_reseau').css("background", "url(\"../images/left-triangle.png\") #6E7378 right no-repeat");
        $('#sm_reseau').css("background-size", "auto 50%");
    });

}

function show_sm_site_vitrine() {
    $('#sm_site_vitrine').click(function () {
        $('#div_site_vitrine').show();
        $('#div_photo').hide();
        $('#div_reseau').hide();
        $('#div_infoperso').hide();
        $('#div_password').hide();
        $('.sub_li').css("background", "#6E7378");
        $('#sm_site_vitrine').css("background", "url(\"../images/left-triangle.png\") #6E7378 right no-repeat");
        $('#sm_site_vitrine').css("background-size", "auto 50%");
    });

}

function show_sm_password() {
    $('#sm_password').click(function () {
        $('#div_site_vitrine').hide();
        $('#div_photo').hide();
        $('#div_reseau').hide();
        $('#div_infoperso').hide();
        $('#div_password').show();

        $('.sub_li').css("background", "#6E7378");
        $('#sm_password').css("background", "url(\"../images/left-triangle.png\") #6E7378 right no-repeat");
        $('#sm_password').css("background-size", "auto 50%");
    });
}

function show_inscription() {
    $('#tab_inscription').click(function () {
        $('#div_inscription').show();
        $('#div_connection').hide();
        $('#div_password').hide();

        $('#tab_inscription').css("background", "white");
        $('#tab_inscription').css("color", "#6E7378");
        $('#tab_connection').css("color", "white");
        $('#tab_connection').css("background", "#3EB6D1");
    })
}

function show_connection() {
    $('#tab_connection').click(function () {
        $('#div_inscription').hide();
        $('#div_connection').show();
        $('#div_password').hide();


        $('#tab_connection').css("background", "white");
        $('#tab_connection').css("color", "#548687");
        $('#tab_inscription').css("color", "white");
        $('#tab_inscription').css("background", "#3EB6D1");

    })
}


function show_password_div(){
    $('#forgot_pass').click(function () {
        $('#div_inscription').hide();
        $('#div_connection').hide();
        $('#div_password').show();
        $('#tab_connection').css("color", "white");
        $('#tab_connection').css("background", "#3EB6D1");

    })

}

function show_cab_insert_cabinet() {
    $('#cab_new').click(function () {
        $('#div_cabinet_cab_part').show();
        $('#div_cabinet_photo_part').hide();

        $('#cab_new').css("background", "white");
        $('#cab_new').css("color", "#43b863");
        $('#cab_photo').css("background", "#6E7378");
        $('#cab_photo').css("color", "white");
    });
}
function show_cab_insert_photo() {
    $('#cab_photo').click(function () {
        $('#div_cabinet_cab_part').hide();
        $('#div_cabinet_photo_part').show();

        $('#cab_photo').css("background", "white");
        $('#cab_photo').css("color", "#43b863");
        $('#cab_new').css("background", "#6E7378");
        $('#cab_new').css("color", "white");
    });
}

function welcome_page() {
    $('#w_demelt').click(function () {
        $('#wo_demelt').css("height", "auto");
    })
    $('#w_close_demelt').click(function () {
        $('#wo_demelt').css("height", "0");
    });

    $('#w_about').click(function () {
        $('#wo_about').css("height", "auto");
    })
    $('#w_close_about').click(function () {
        $('#wo_about').css("height", "0");
    });

    $('#w_thera').click(function () {
        $('#wo_thera').css("height", "100%");
    })
    $('#w_close_thera').click(function () {
        $('#wo_thera').css("height", "0");
    });

    $('#w_visitor').click(function () {
        $('#wo_visitor').css("height", "100%");
    })
    $('#w_close_visitor').click(function () {
        $('#wo_visitor').css("height", "0");
    });
}

function admin_page() {
    $('#ad_user_list').click(function () {
        $('#admin_div_user_list').show();
        $('#admin_div_new_user').hide();
        $('#admin_div_moderatheur').hide();
        $('#ad_user_list').css("background", "white");
        $('#ad_new_user').css("background", "#CCCCCC");
        $('#ad_moderator').css("background", "#CCCCCC");
    })
    $('#ad_new_user').click(function () {
        $('#admin_div_user_list').hide();
        $('#admin_div_new_user').show();
        $('#admin_div_moderatheur').hide();
        $('#ad_user_list').css("background", "#CCCCCC");
        $('#ad_new_user').css("background", "white");
        $('#ad_moderator').css("background", "#CCCCCC");
    })
    $('#ad_moderator').click(function () {
        $('#admin_div_user_list').hide();
        $('#admin_div_new_user').hide();
        $('#admin_div_moderatheur').show();
        $('#ad_user_list').css("background", "#CCCCCC");
        $('#ad_new_user').css("background", "#CCCCCC");
        $('#ad_moderator').css("background", "white");
    })


}

//do with id
function openNav() {
    document.getElementById("menu").style.height = "100%";
    document.getElementById("menu").style.width = "210px";

}

function closeNav() {
    document.getElementById("menu").style.height = "0%";
    document.getElementById("menu").style.width = "0";
}

function adjustStyle(width) {
    width = parseInt(width);
    if (width < 900) {
        $("#size-stylesheet").attr("href", "../style/narrow.css");
        $(".closebtn").show();
    }else{
        $("#size-stylesheet").attr("href", "../style/wide.css");
        $(".closebtn").hide();
    }
};



function form_validate_formation() {
    $("#form_formation_ajout").validate({
        rules: {
            txtNom: {
                required: true,
                maxlength:100,
            },
            txtEtablissement: {
                required: true,
                maxlength:100,
            },
            txtAnnee: {
                required: true,
                minlength:4,
                min: 1900,
            },
            txtDesc: {
                required: false,
                maxlength:600,
            },

        },
        messages: {
            txtNom: "Le nom de la formation est requise et maximum de 100 caractères",

            txtEtablissement: "Le nom de l'etablissement est requise et maximum de 100 caractères",
            txtAnnee: "Entrez une date valide",
            txtDesc: "La description est trop longue maximum de 600 caractères",
        },
        submitHandler: function(form) {
            $("#form_formation_ajout").submit();
        }
    });

}
function form_validate_tarif() {
    $("#form_tarif_new").validate({
        rules: {
            txtLibelle: {
                required: true,
                maxlength:100,
            },
            txtPrix: {
                required: true,
                min:0,
            },
            txtDescription: {
                required: false,
                maxlength:200,
            },

        },
        messages: {
            txtLibelle: "Libelle est requise et maximum de 100 caractères",
            txtPrix: "Entrez un prix valide",
            txtDescription: "La description est trop longue maximum 200 caractères ",
        },
        submitHandler: function(form) {
            $("#form_tarif_new").submit();
        }
    });

}

function form_validate_cabinet() {
    $("#form_new_cab").validate({
        rules: {
            txtNom: {
                required: true,
                maxlength:100,
            },
            txtAdresse: {
                required: true,
                maxlength:100,
            },
            txtCodePostal: {
                required: false,
                maxlength:10,
                min:0,
            },
            txtVille: {
                required: true,
                maxlength:100,
            },
            txtAcces: {
                required: false,
                maxlength:600,
            },

        },
        messages: {
            txtNom: "Nom requis et maximum de 100 caractères",
            txtAdresse: "Adresse requise et maximum de 100 caractères",
            txtVille: "Ville requise et maximum de 100 caractères",
            txtCodePostal: "Entrez un codepostal valide et seulement des chiffres",
            txtAcces: "Maximum de 600 caractères",
        },
        submitHandler: function(form) {
            $("#form_new_cab").submit();
        }
    });

}
function form_validate_experience() {
    $("#form_exp_ajout").validate({
        rules: {
            txtPoste: {
                required: true,
                maxlength:100,
            },
            txtEntreprise: {
                required: true,
                maxlength:100,
            },
            dateDebut: {
                required: true,
            },
            dateFin: {
                required: false,
            },

        },
        messages: {
            txtPoste: "Le poste occupe requis et maximum de 100 caractères",
            txtEntreprise: "Le nom de l'etablissement est requis et maximum de 100 caractères",
            dateDebut: "Entrez une date valide",
            dateFin: "Entrez une date valide",
        },
        submitHandler: function(form) {
            $("#form_exp_ajout").submit();
        }
    });

}

function form_validate_existing_info_formation() {
  /* $('.form_exist_formation').each(function() {
        $(this).rules('add', {
            required: true,
            number: true,
            messages: {
                required:  "your custom message",
                number:  "your custom message"
            }
        });
    });
*/
    $(".form_exist_formation").validate({
        rules: {
            txtNom: {
                required: true,
                maxlength:100,
            },
            txtEtablissement: {
                required: true,
                maxlength:100,
            },
            txtAnnee: {
                required: true,
                minlength:4,
                min: 1900,
            },
            txtDesc: {
                required: false,
                maxlength:600,
            },

        },
        messages: {
            txtNom: "Le nom de la formation est requis et maximum de 100 caractères",
            txtEtablissement: "Le nom de l'etablissement est requis et maximum de 100 caractères",
            txtAnnee: "Entrez une date valide",
            txtDesc: "La description est trop longue maximum de 200 caracètres",
        },
        submitHandler: function(form) {
            $(".form_exist_formation").submit();
        }
    });
}



