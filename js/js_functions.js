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

  $(document).ready(function(){
	 
	
	$( '.datepicker' ).datepicker({ dateFormat: 'yy-mm-dd'}); 
	$('#form_cabinet_radio').hide();
		
	$('.btn_changer_cabinet').click(function(ev){
		ev.preventDefault();
		  	$(".aff_lbl").hide();
			$(".aff_input").hide();
			$(".cabinetSecond").hide();
			$('#form_cabinet_radio').show();
	});
	
	  $('.aff_input').hide();
	  $('.form_hidden').hide();
	  $('.btn_consulter').click(function(ev){
		  	ev.preventDefault();
		  	$(ev.target.form).find(".form_hidden").toggle();
		  })
		$('.btn_modifier').click(function(ev){
		  	ev.preventDefault();
		  	$(ev.target.form).find(".aff_lbl").hide();
			$(ev.target.form).find(".aff_input").show();
		  })
		  	$('.btn_annuler').click(function(ev){
		  	ev.preventDefault();
			$(ev.target.form).find(".aff_input").hide();
		  	$(ev.target.form).find(".aff_lbl").show();	
		  })
		  $('.btn_supprimer').click(function(ev){
			  if (confirm('Are you sure you want to save this thing into the database?')) {
				$(ev.target.form).find(".btn_supprimer").submit(); 
 			
				} else {
			ev.preventDefault();
				}
		  	
			
		  })
		
	  })
	 
/*
$(function(){
                if(!Modernizr.inputtypes.date) {
                    console.log("The 'date' input type is not supported, so using JQueryUI datepicker instead.");
                    $("#theDate").datepicker();
                }
            });
			$(function(){
             if ( $('[type="date"]').prop('type') != 'date' ) {
    $('[type="date"]').datepicker();
}
            });
$(function(){
               if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
        jQuery(function($){ //on document.ready
            $(document.getElementById('#theDate').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $('#end_date').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        })
    }
            });*/
					
/*
function aff_formation_exist($idFormation, $nom, $annee, $etablissement, $descriptif, $afficher) {
	echo '<form method=POST  action="formation.php">
			<table>
				<tr>
					<td><label>'.$nom.'</label></td>
					<td><label>'.$annee.'</label></td>
				</tr>
				<tr>
					<td><label class=\"form_hidden\">L\'etablissement d\'obtention</label></td>
					<td><label class=\"form_hidden\">'.$etablissement.'</label></td>
				</tr>
				<tr>
					<td><label class=\"form_hidden\">'.$descriptif.'</label></td>
				</tr>
				<tr>
					<td><input type=submit name=btn_consulter value=consulter class=\"btn_consulter\" /></td>
					<td><input type=submit name=btn_modifier value=modifier class=\"btn_modifier\"/></td>
				</tr>
			</table>

		</form>';
			
}

function aff_table(){
			echo '<form method=POST  action="formation.php">
			<table>
				<tr>
					<td><label>'.$nom.'</label></td>
					<td><label>'.$annee.'</label></td>
				</tr>
				<tr>
					<td><label class=\"form_hidden\">L\'etablissement d\'obtention</label></td>
					<td><label class=\"form_hidden\">'.$etablissement.'</label></td>
				</tr>
				<tr>
					<td><label class=\"form_hidden\">'.$descriptif.'</label></td>
				</tr>
				<tr>
					<td><input type=submit name=btn_consulter value=consulter class=\"btn_consulter\" /></td>
					<td><input type=submit name=btn_modifier value=modifier class=\"btn_modifier\"/></td>
				</tr>
			</table>

		</form>';
			

}*/