<?php
wp_enqueue_script('jquery-ui-core');
wp_enqueue_script('jquery-ui-widget');
wp_enqueue_script('jquery-ui-position');
wp_enqueue_script('jquery');
global $wp_scripts;
?>
<!DOCTYPE html>
<head>
<title>Bootstrap Glyphicon Shortcodes</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<LINK rel="stylesheet" href="<?php echo plugins_url('admin.min.css', __FILE__ ); ?>" type="text/css">
<LINK rel="stylesheet" href="<?php echo plugins_url('../css/bgiiwpve.css', __FILE__ ); ?>" type="text/css">
<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo plugins_url('tech509tinymce.js', __FILE__ ); ?>"></script>
<base target="_self" />
<?php wp_print_scripts(); ?>
</head>
<body id="link">
<h4>Select a Glyphicon</h4><p></p>
<div>
<?php
	$glyphicons = array("adjust","align-center","align-justify","align-left","align-right","arrow-down","arrow-left","arrow-right","arrow-up","asterisk","backward","ban-circle","barcode","bell","bold","book","bookmark","briefcase","bullhorn","calendar","camera","certificate","check","chevron-down","chevron-left","chevron-right","chevron-up","circle-arrow-down","circle-arrow-left","circle-arrow-right","circle-arrow-up","cloud","cloud-download","cloud-upload","cog","collapse-down","collapse-up","comment","compressed","copyright-mark","credit-card","cutlery","dashboard","download","download-alt","earphone","edit","eject","envelope","euro","exclamation-sign","expand","export","eye-close","eye-open","facetime-video","fast-backward","fast-forward","file","film","filter","fire","flag","flash","floppy-disk","floppy-open","floppy-remove","floppy-save","floppy-saved","folder-close","folder-open","font","forward","gbp","gift","glass","globe","hand-down","hand-left","hand-right","hand-up","hd-video","hdd","header","headphones","heart","heart-empty","home","import","inbox","indent-left","indent-right","info-sign","italic","leaf","link","list","list-alt","lock","log-in","log-out","magnet","map-marker","minus","minus-sign","move","music","new-window","off","ok","ok-circle","ok-sign","open","paperclip","pause","pencil","phone","phone-alt","picture","plane","play","play-circle","plus","plus-sign","print","pushpin","qrcode","question-sign","random","record","refresh","registration-mark","remove","remove-circle","remove-sign","repeat","resize-full","resize-horizontal","resize-small","resize-vertical","retweet","road","save","saved","screenshot","sd-video","search","send","share","share-alt","shopping-cart","signal","sort","sort-by-alphabet","sort-by-alphabet-alt","sort-by-attributes","sort-by-attributes-alt","sort-by-order","sort-by-order-alt","sound-5-1","sound-6-1","sound-7-1","sound-dolby","sound-stereo","star","star-empty","stats","step-backward","step-forward","stop","subtitles","tag","tags","tasks","text-height","text-width","th","th-large","th-list","thumbs-down","thumbs-up","time","tint","tower","transfer","trash","tree-conifer","tree-deciduous","unchecked","upload","usd","user","volume-down","volume-off","volume-up","warning-sign","wrench","zoom-in","zoom-out");
	foreach ($glyphicons as $glyph) {
		echo '<button type="button" onClick="insertbgiiwpveshortcode(\'' . $glyph . '\');" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-' . $glyph . '"></span></br>' . $glyph . '</button>';
	}
?>
</div>
</body>
</html>