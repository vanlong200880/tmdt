<?php
$crop = (isset($crop) && $crop == 'no') ? 'no' : 'yes';

if ( isset($_POST['bsa_get_required_inputs']) ) {

	// -- START -- GET REQUIRED INPUTS
	return 'url,img'; // inputs shows in form (default: 'title,desc,url,img or html')
	// -- END -- GET REQUIRED INPUTS

} else {

// -- START -- IF EXAMPLE TEMPLATE
	if (  !isset($ads) && !isset($sid) ) {
		if ( !isset($_POST['bsa_ad_id']) ) { // example content if new ad
			$ads = array(
				array(
					"template" => "image-1",
					"id" => 0,
					"url" => get_option('bsa_pro_plugin_trans_example_url'),
					"img" => plugins_url('/bsa-pro-scripteo/frontend/img/example.jpg')
				)
			);
		} else { // get ad content if edit ad
			$ads = array(
				array(
					"template" => "image-1",
					"id" => 0,
					"url" => bsa_ad($_POST['bsa_ad_id'], "url"),
					"img" => bsa_ad($_POST['bsa_ad_id'], "img")
				)
			);
		}
		$sid = NULL; 		$col_per_row = 1;
	} else { // if ads exists
		$col_per_row = bsa_space($sid, 'col_per_row');
	}
// -- END -- IF EXAMPLE TEMPLATE


// -- START -- TEMPLATE HTML
	echo '<div id="bsa-image-1" class="bsaProContainer '.((isset($sid)) ? "bsaProContainer-".$sid." " : "").((!isset($sid)) ? "bsaProContainerExample " : "").'bsa-image-1 bsa-pro-col-'.$col_per_row.'">'; // -- START -- CONTAINER

	if ( isset($sid) && bsa_space($sid, 'title') != '' OR isset($sid) &&  bsa_space($sid, 'add_new') != '' ) {
		// -- START -- HEADER
		echo '<div class="bsaProHeader" style="background-color:'.bsa_space($sid, 'header_bg').'">'; // -- START -- HEADER

		echo '<h3 class="bsaProHeader__title" style="color:'.bsa_space($sid, 'header_color').'">
					<span>'.bsa_space($sid, 'title').'</span>
				  </h3>'; // -- HEADER -- TITLE

		$ofu = get_option('bsa_pro_plugin_ordering_form_url');
		$mfu = get_site_option('bsa_pro_plugin_order_form_url');
		$oau = get_option('bsa_pro_plugin_agency_ordering_form_url');
		$mau = get_site_option('bsa_pro_plugin_agency_order_form_url');
		$form_url = ( ( isset($type) && $type == 'agency') ? ((is_multisite()) ? $mau : $oau) : ((is_multisite()) ? $mfu : $ofu ) );
		echo '	<a class="bsaProHeader__formUrl" href="'.$form_url.(( strpos($form_url, '?') == TRUE ) ? '&' : '?').'sid='.$sid.'" target="_blank" style="color:'.bsa_space($sid, 'link_color').'">
					<span>'.bsa_space($sid, 'add_new').'</span>
				</a>'; // -- HEADER -- LINK TO ORDER FORM

		echo '</div>'; // -- END -- HEADER
	}

	echo '<div class="bsaProItems '.bsa_space($sid, "grid_system").' '.((bsa_space($sid, "display_type") == 'carousel') ? 'bsa-owl-carousel bsa-owl-carousel-'.$sid : '').'" style="background-color:'.bsa_space($sid, 'ads_bg').'">'; // -- START -- ITEMS

	foreach ( $ads as $key => $ad ) {

		if ( $ad['id'] != 0 && bsa_ad($ad['id']) != NULL ) {  // -- COUNTING FUNCTION (DO NOT REMOVE!)
			$model = new BSA_PRO_Model();
			$model->bsaProCounter($ad['id']);
		}

		echo '<div class="bsaProItem '.(($key % $col_per_row == 0) ? "bsaReset" : "").'" data-animation="'.bsa_space($sid, "animation").'" style="'.((bsa_space($sid, "animation") == "none" OR bsa_space($sid, "animation") == NULL) ? "opacity:1" : "").'">'; // -- START -- ITEM

		$url = parse_url($ad['url']); // -- START -- LINK
		$agency_form = get_option('bsa_pro_plugin_agency_ordering_form_url');
		if ( $ad['url'] != '' ) {

			if ( isset($type) && $type == 'agency' ) {
				echo '<a class="bsaProItem__url" href="'.$agency_form.( (strpos($agency_form, '?')) ? '&' : '?' ).'bsa_pro_id='.$ad['id'].'&bsa_pro_url=1" target="_blank">';
			} else {
				echo '<a class="bsaProItem__url" href="'.get_site_url().( (strpos(get_site_url(), '?')) ? '&' : '?' ).'bsa_pro_id='.$ad['id'].'&bsa_pro_url=1" target="_blank">';
			}

		} else {

			echo '<a href="#">';
		}

		echo '<div class="bsaProItemInner" style="background-color:'.bsa_space($sid, 'ad_bg').'">'; // -- START -- ITEM INNER



		echo '<div class="bsaProItemInner__thumb">'; // -- START -- ITEM THUMB

		echo '<div class="bsaProAnimateThumb animated">';

		echo '<div class="bsaProItemInner__img" style="background-image: url(&#39;'.bsa_crop_tool($crop, ((!isset($sid) && !isset($_POST['bsa_ad_id'])) ? $ad['img'] : bsa_upload_url().$ad['img']), 400, 300).'&#39;)"></div>'; // -- ITEM -- IMG

		echo '</div>';

		echo '</div>'; // -- END -- ITEM THUMB



		echo '</div>'; // -- END -- ITEM INNER

		echo '</a>'; // -- END -- LINK

		echo '</div>'; // -- END -- ITEM

	}
	echo '</div>'; // -- END -- ITEMS

	echo '</div>'; // -- END -- CONTAINER
// -- END -- TEMPLATE HTML


// -- START -- SCRIPT JS
	echo '<script>
(function($){
	$(document).ready(function(){



	});
})(jQuery);
</script>';
// -- END -- SCRIPT JS
}