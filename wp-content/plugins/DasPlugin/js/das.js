jQuery(document).ready(function() {
	jQuery("#ulnooweg_ad_expiry").datepicker({dateFormat: 'yy-mm-dd'});
	
	var formfield;
	
	jQuery('#ulnooweg_ad_file').click(function() {
		formfield ="#ulnooweg_ad_file";
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery(formfield).val(imgurl);
		tb_remove();
	}
	
	
});