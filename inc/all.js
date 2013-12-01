function hidel_old_handle() {
	if(jQuery('input[name=wp_ex_show]:checked').val() == 'hide') {
		jQuery('.wp_ex_handle_old').hide();
	} else {
		jQuery('.wp_ex_handle_old').show();
	}
}

jQuery(document).ready(function($) {

	//Hide old handle
	hidel_old_handle();
	$('.wp_ex_show').change(function() { hidel_old_handle(); });
});