jQuery(document).ready(function() {
	
	

	//on load page
	var number_of_sections = jQuery('#the_chameleon_number_of_sections').val();	
	for (var i=0; i <= 20; i++) {
		if(i <= number_of_sections) {	
			jQuery('#the_chameleon_page_builder_section'+i+'_section').show();
		}else{
			jQuery('#the_chameleon_page_builder_section'+i+'_section').hide();	
		}
	};
	

	jQuery( "#the_chameleon_number_of_sections" ).change(function() {		
 	 var number_of_sections_on_change = jQuery('#the_chameleon_number_of_sections').val();
	 
		for (var i=0; i <= 20; i++) {
			if(i <= number_of_sections_on_change) {	
				jQuery('#the_chameleon_page_builder_section'+i+'_section').show();
			}else{
				jQuery('#the_chameleon_page_builder_section'+i+'_section').hide();	
			}
		};
	
	});
	
	//hide text editor 
	var active_page_builder = jQuery('#the_chameleon_active_page_builder').prop('checked');	
	if(jQuery('#the_chameleon_active_page_builder').prop('checked')){
		jQuery('.wp-editor-expand').hide();
	}
	
	//hide text editor 
	jQuery( "#the_chameleon_active_page_builder:checkbox" ).change(function() {
		if(jQuery('#the_chameleon_active_page_builder').prop('checked')){
			jQuery('.wp-editor-expand').hide();
		}else{
			jQuery('.wp-editor-expand').show();
		}
	
	});
	/*alert('admin.js');*/
	
});