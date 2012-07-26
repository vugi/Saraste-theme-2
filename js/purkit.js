jQuery().ready(function() {
		
		/* Purkit */
		
		jQuery("input:radio[name=status]").change(function(){
			if(jQuery('input:radio[name=status]:checked').val() == 1){
				jQuery(".loytyi, .ei_loytynyt").slideDown()
			} else if(jQuery('input:radio[name=status]:checked').val() == 0) {
				jQuery(".loytyi").slideUp()
				jQuery(".ei_loytynyt").slideDown()
			}	 else {
				jQuery(".loytyi, .ei_loytynyt").slideUp()
			}		
		})
		
		jQuery(".tahti").hover(
			function(){
				jQuery(this).prevAll(".tahti").andSelf().addClass("sini")
				jQuery(this).nextAll(".tahti").removeClass("sini")
			},
			function(){
				jQuery(".tahti").removeClass("sini")
				var arvio = jQuery("#arvio").val()
				jQuery(".tahti:lt(" + arvio + ")").addClass("sini")
			}
		)
})