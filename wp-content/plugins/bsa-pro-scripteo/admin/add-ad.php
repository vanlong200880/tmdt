<?php
$model = new BSA_PRO_Model();
$role = ((bsa_role() == 'admin') ? 'a' : 'u');
$decode_ids = $model->getUserCol(get_current_user_id());
$get_ids = json_decode($decode_ids['ad_ids']);
$get_free_ads = $model->getUserCol(get_current_user_id(), 'free_ads');

function getAdValue($val) {
	if (isset($_GET['ad_id'])) {
		return bsa_ad($_GET['ad_id'], $val);
	} else {
		if ( isset($_POST[$val]) || isset($_SESSION['bsa_ad_status']) ) {
			if ( isset($_SESSION['bsa_ad_status']) == 'ad_added' ) {
				$_SESSION['bsa_clear_form'] = 'ad_added';
				unset($_SESSION['bsa_ad_status']);
			}
			$status = (isset($_SESSION['bsa_clear_form']) ? $_SESSION['bsa_clear_form'] : '');
			if ( $status == 'ad_added' ) {
				return '';
			} else {
				return $_POST[$val];
			}
		} else {
			return '';
		}
	}
}
?>
<h2>
	<?php if ( isset($_GET['ad_id']) ): ?>
		<span class="dashicons dashicons-edit"></span> Edit <strong>Ad ID <?php echo $_GET['ad_id']; ?></strong> added to <strong>Space ID <?php echo getAdValue('space_id'); ?></strong> <small>(<strong><?php echo bsa_ad($_GET['ad_id'], 'ad_model') ?></strong> billing model)</small>
		<?php if ( $role == 'a' ): ?>
		<p><span class="dashicons dashicon-14 dashicons-arrow-left-alt"></span> <a href="<?php echo admin_url(); ?>admin.php?page=bsa-pro-sub-menu-spaces<?php echo ((getAdValue('space_id')) ? '&space_id='.getAdValue('space_id') : null) ?>">back to <strong>spaces / ads list</strong></a></p>
		<?php endif; ?>
	<?php else: ?>
		<span class="dashicons dashicons-plus-alt"></span> Add new Ad
		<?php if ( $role == 'a' ): ?>
			<p><span class="dashicons dashicon-14 dashicons-arrow-left-alt"></span> <a href="<?php echo admin_url(); ?>admin.php?page=bsa-pro-sub-menu-spaces">back to <strong>spaces / ads list</strong></a></p>
		<?php endif; ?>
	<?php endif; ?>
</h2>

<?php if (  isset($_GET['ad_id']) && bsa_ad($_GET['ad_id'], 'id') != NULL && $role == 'a' ||
			!isset($_GET['ad_id']) && $role == 'a' ||
			isset($_GET['ad_id']) && bsa_ad($_GET['ad_id'], 'id') != NULL && array_search($_GET['ad_id'], $get_ids) !== false && $role == 'u' ||
			!isset($_GET['ad_id']) && $get_free_ads['free_ads'] > 0 && $role == 'u' ):

	$spaces = (($model->getSpaces('active')) ? $model->getSpaces('active') : NULL);
	$count_ads = NULL;
	$space_verify = NULL;
	if (is_array($spaces))
	{
		foreach ( $spaces as $key => $space ) {
			$count_ads = $model->countAds($space["id"]);
			if ( $model->countAds($space["id"]) < bsa_space($space["id"], 'max_items') ) {
				$space_verify .= (( $key > 0 ) ? ','.$space["id"] : $space["id"]);
			} else {
				$space_verify .= '';
			}
		}
	}
	$space_verify = (( $space_verify != '') ? explode(',', $space_verify) : FALSE );

	if ( $space_verify && $spaces || isset($_GET['ad_id']) && bsa_space(bsa_ad($_GET['ad_id'], 'space_id'), 'max_items') == $count_ads ): ?>
		<form action="" method="post" enctype="multipart/form-data" class="bsaNewAd">
			<?php if ( isset($_GET['ad_id']) ): ?>
				<input type="hidden" value="updateAd" name="bsaProAction">
			<?php else: ?>
				<input type="hidden" value="addNewAd" name="bsaProAction">
			<?php endif; ?>
			<table class="bsaAdminTable form-table">
				<tbody class="bsaTbody">
					<tr>
						<th colspan="2">
							<?php if ( isset($_GET['ad_id']) ): ?>
								<h3><span class="dashicons dashicons-exerpt-view"></span> Edit Ad Content</h3>
							<?php else: ?>
								<h3><span class="dashicons dashicons-exerpt-view"></span> Create new Ad</h3>
							<?php endif; ?>
						</th>
					</tr>
					<tr>
						<th scope="row"><label for="bsa_pro_buyer_email">E-mail</label></th>
						<td>
							<input id="bsa_pro_buyer_email" name="buyer_email" type="email" class="regular-text" maxlength="255" value="<?php echo getAdValue('buyer_email') ?>">
							<p class="description">E-mail address is need to generate statistics.</p>
						</td>
					</tr>
					<?php if ( !isset($_GET['ad_id']) ): ?>
					<tr>
						<th scope="row"><label for="bsa_pro_space_id">Choose Space</label></th>
						<td>
							<select id="bsa_pro_space_id" name="space_id" onchange="bsaGetBillingMethods()">

								<?php

								if ( $model->getSpaces('active') != NULL ) {
									foreach ( $model->getSpaces('active') as $space ) {
										if ( $role == 'a' || $role == 'u' && $space['template'] != 'html' ) {
											if ( $model->countAds($space["id"]) < bsa_space($space["id"], 'max_items') ) {
												echo '<option value="'.$space["id"].'" '.((isset($_POST) && $_POST["space_id"] == $space["id"]) ? 'selected="selected"' : "").'>'.$space["name"].'</option>';
											} else {
												echo '<option value="" disabled>'.$space["name"].' ('.$model->countAds($space["id"]).'/'.bsa_space($space["id"], 'max_items').')'.'</option>';
											}
										}
									}
								}

								?>
							</select> <span class="bsaLoader" style="display:none;"></span>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>Billing model <br>(display limit)</label></th>
						<td>
							<h3 style="margin-top:0;">Choose Billing Model and Display Limit <span class="bsaLoader" style="display:none;"></span></h3>
							<div class="bsaGetBillingModels"></div>
						</td>
					</tr>
					<?php endif ?>
					<tr>
						<th scope="row">Live Preview</th>
						<td>
							<?php if ( isset($_GET['ad_id']) ): ?>
								<input id="bsa_pro_space_id" type="hidden" value="<?php echo getAdValue('space_id'); ?>">
								<input id="bsa_pro_ad_id" type="hidden" value="<?php echo $_GET['ad_id']; ?>">
							<?php endif ?>
							<h3 style="margin-top:0;">Ad Live Preview <span class="bsaLoader" style="display:none;"></span></h3>
							<div class="bsaTemplatePreview">
								<div class="bsaTemplatePreviewInner"></div>
							</div>
						</td>
					</tr>
					<tr class="bsa_title_inputs_load" style="display: none">
						<th scope="row"><label for="bsa_pro_title">Title <small>(<span class="bsa_pro_sign_title"><?php echo get_option('bsa_pro_plugin_max_title') ?></span>)</small></label></th>
						<td>
							<input id="bsa_pro_title" name="title" type="text" class="regular-text" maxlength="<?php echo get_option('bsa_pro_plugin_max_title') ?>" value="<?php echo getAdValue('title') ?>">
						</td>
					</tr>
					<tr class="bsa_desc_inputs_load" style="display: none">
						<th scope="row"><label for="bsa_pro_desc">Description <small>(<span class="bsa_pro_sign_desc"><?php echo get_option('bsa_pro_plugin_max_desc') ?></span>)</small></label></th>
						<td>
							<input id="bsa_pro_desc" name="description" type="text" class="regular-text" maxlength="<?php echo get_option('bsa_pro_plugin_max_desc') ?>" value="<?php echo getAdValue('description') ?>">
						</td>
					</tr>
					<tr class="bsa_url_inputs_load" style="display: none">
						<th scope="row"><label for="bsa_pro_url">URL <small>(<span class="bsa_pro_sign_url">255</span>)</small></label></th>
						<td>
							<input id="bsa_pro_url" name="url" type="url" class="regular-text" maxlength="255" value="<?php echo getAdValue('url') ?>">
						</td>
					</tr>
					<tr class="bsa_img_inputs_load" style="display: none">
						<th scope="row"><label for="bsa_pro_img">Image</label></th>
						<td>
							<input type="file" id="bsa_pro_img" name="img" onchange="bsaPreviewThumb(this)">
							<p class="description"><?php echo get_option('bsa_pro_plugin_trans_form_left_thumb'); ?></p>
							<p class="description"><strong>Note!</strong> If you editing the ad and do not want to change the image, skip this field.</p>
						</td>
					</tr>
					<tr class="bsa_html_inputs_load" style="display: none">
						<th scope="row"><label for="bsa_pro_html">HTML</label></th>
						<td>
							<textarea id="bsa_pro_html" name="html" class="regular-text ltr" rows="14" cols="70"><?php echo getAdValue('html') ?></textarea>
							<p class="description"><strong>Note!</strong> Use this URL (<?php echo get_option('bsa_pro_plugin_ordering_form_url') ?>?bsa_pro_id=<strong>AD_ID</strong>&bsa_pro_url=<strong>1</strong>) to keep statistics.</p>
						</td>
					</tr>
					<?php do_action( 'bsa-pro-add-input-ads'); ?>
					<tr>
						<th scope="row"><label for="bsa_pro_capping">Capping - Number of views per user / session</label></th>
						<td>
							<input id="bsa_pro_capping" name="capping" type="text" class="regular-text" maxlength="3" value="<?php echo getAdValue('capping') ?>">
						</td>
					</tr>
					<?php if ( isset($_GET['ad_id']) && $role == 'a' ): ?>
					<tr>
						<th colspan="2">
								<h3><span class="dashicons dashicons-plus"></span> Increase / Decrease limit display</h3>
						</th>
					</tr>
					<tr>
						<?php $diffTime = '';
						if ( bsa_ad($_GET['ad_id'], 'ad_model') == 'cpc' ) {
							$model_type = 'clicks';
							$limit_value = ( bsa_ad($_GET['ad_id'], 'ad_limit') <= 0 ) ? 0 : bsa_ad($_GET['ad_id'], 'ad_limit');
						} elseif ( bsa_ad($_GET['ad_id'], 'ad_model') == 'cpm' ) {
							$model_type = 'views';
							$limit_value = ( bsa_ad($_GET['ad_id'], 'ad_limit') <= 0 ) ? 0 : bsa_ad($_GET['ad_id'], 'ad_limit');
						} else { // if ( bsa_ad($_GET['ad_id'], 'ad_model') == 'cpd' ) // IF CPD BILLING MODEL
							$time = time();
							$limit = bsa_ad($_GET['ad_id'], 'ad_limit');
							$diff = $limit - $time;
							$limit_value = ( $diff < 86400 /* 1 day in sec */ ) ? ( $diff > 0 ) ? 'less than 1' : '0' : number_format($diff / 24 / 60 / 60);
							$diffTime = date('Y M D (H:m:s)', time() + $diff);
							$model_type = ( $diff > 86400 || $diff == -0 ) ? 'days' : 'day';
						} ?>
						<th scope="row"><label>Currently limit display <br>(<?php echo $model_type ?> to finish)</label></th>
						<td>
							<input name="limit" type="text" class="regular-text" placeholder="<?php echo $limit_value ?>" disabled> <em><?php echo $model_type ?></em>
							<p class="description"><?php echo ( bsa_ad($_GET['ad_id'], 'ad_model') == 'cpd' ) ? $diffTime : ''; ?></p>
						</td>
					</tr>
					<tr>
						<th class="bsaLast" scope="row"><label for="increase_limit">Increase limit display <br>(add <?php echo $model_type ?> to currently limit)</label></th>
						<td class="bsaLast">
							<input id="increase_limit" name="increase_limit" type="number" class="regular-text" value=""> <em><?php echo $model_type ?></em>
							<p class="description">Skip this field if you do not want increase limit display.</p>
						</td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
			<input class="bsa_inputs_required" name="inputs_required" type="hidden" value="">
			<p class="submit">
				<input type="submit" value="Save Ad" class="button button-primary" id="bsa_pro_submit" name="submit">
			</p>
		</form>
	<?php else: ?>

		<div class="updated settings-error" id="setting-error-settings_updated">
			<p><strong>Ad Spaces full or not exists!</strong> Go <a href="<?php echo admin_url(); ?>admin.php?page=bsa-pro-sub-menu-add-new-space">here</a> to add first space.</p>
		</div>

	<?php endif; ?>

<?php else: ?>

	<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Error!</strong> Ad Space not exists or you can't manage this section!</p>
	</div>

<?php endif; ?>

<script>
	(function($) {
		// - start - open page
		var bsaItemsWrap = $(".wrap");
		setTimeout(function(){
			bsaItemsWrap.fadeIn(400);
		}, 400);
		// - end - open page

		var inputTitle = $("#bsa_pro_title");
		var inputDesc = $("#bsa_pro_desc");
		var inputUrl = $("#bsa_pro_url");
		var inputHtml = $("#bsa_pro_html");
		inputTitle.keyup(function() { bsaPreviewInput("title"); });
		inputDesc.keyup(function() { bsaPreviewInput("desc"); });
		inputUrl.keyup(function() { bsaPreviewInput("url"); });
		inputHtml.keyup(function() { bsaPreviewInput("html"); });

		bsaTemplatePreview();
		var sid = $("#bsa_pro_space_id");
		sid.bind("change",function() {
			bsaGetBillingMethods();
			bsaTemplatePreview();
			$(".bsaUrlSpaceId").html($("#bsa_pro_space_id").val());
		});
		sid.trigger("change");
	})(jQuery);

	function bsaGetBillingMethods()
	{
		(function($) {
			var getBillingModels = $(".bsaGetBillingModels");
			var bsaLoader = $(".bsaLoader");

			getBillingModels.slideUp();
			bsaLoader.fadeIn(400);
			setTimeout(function(){
				$.post(ajaxurl, {action:"bsa_get_billing_models_callback",bsa_space_id:$("#bsa_pro_space_id").val()}, function(result) {

					getBillingModels.html(result).slideDown();
					bsaLoader.fadeOut(400);

				});
			}, 1100);
		})(jQuery);
	}

	function bsaTemplatePreview()
	{
		(function($) {
			var bsaTemplatePreviewInner = $(".bsaTemplatePreviewInner");
			var bsaLoader = $(".bsaLoader");

			bsaTemplatePreviewInner.slideUp(400);
			bsaLoader.fadeIn(400);
			setTimeout(function(){
				$.post(ajaxurl, {action:"bsa_preview_callback",bsa_space_id:$("#bsa_pro_space_id").val(),bsa_ad_id:$("#bsa_pro_ad_id").val()}, function(result) {

					bsaTemplatePreviewInner.html(result).slideDown(400);

					bsaGetRequiredInputs();
					var inputTitle = $("#bsa_pro_title");
					var inputDesc = $("#bsa_pro_desc");
					var inputUrl = $("#bsa_pro_url");
					var inputHtml = $("#bsa_pro_html");
					if ( inputTitle.val().length > 0 ) { bsaPreviewInput("title"); }
					if ( inputDesc.val().length > 0 ) { bsaPreviewInput("desc"); }
					if ( inputUrl.val().length > 0 ) { bsaPreviewInput("url"); }
					if ( inputHtml.val().length > 0 ) { bsaPreviewInput("html"); }

					bsaLoader.fadeOut(400);

				});
			}, 1100);
		})(jQuery);
	}

	function bsaGetRequiredInputs()
	{
		(function($) {
			$.post(ajaxurl, {action:"bsa_required_inputs_callback",bsa_space_id:$("#bsa_pro_space_id").val(),bsa_get_required_inputs:1}, function(result) {
				$(".bsa_inputs_required").val($.trim(result));

				if ( result.indexOf('title') != -1 ) { // show if title required
					$(".bsa_title_inputs_load").fadeIn();
				} else {
					$(".bsa_title_inputs_load").fadeOut();
				}
				if ( result.indexOf('desc') != -1 ) { // show if description required
					$(".bsa_desc_inputs_load").fadeIn();
				} else {
					$(".bsa_desc_inputs_load").fadeOut();
				}
				if ( result.indexOf('url') != -1 ) { // show if url required
					$(".bsa_url_inputs_load").fadeIn();
				} else {
					$(".bsa_url_inputs_load").fadeOut();
				}
				if ( result.indexOf('img') != -1 ) { // show if img required
					$(".bsa_img_inputs_load").fadeIn();
				} else {
					$(".bsa_img_inputs_load").fadeOut();
				}
				if ( result.indexOf('html') != -1 ) { // show if html required
					$(".bsa_html_inputs_load").fadeIn();
				} else {
					$(".bsa_html_inputs_load").fadeOut();
				}
			});
		})(jQuery);
	}

	function bsaPreviewInput(inputName)
	{
		(function($){
			var input = $("#bsa_pro_" + inputName);
			var sign = $(".bsa_pro_sign_" + inputName);
			var limit = input.attr("maxLength");
			var bsaProContainerExample = $(".bsaProContainerExample");
			var exampleTitle = "<?php echo get_option("bsa_pro_plugin_trans_form_left_eg_title"); ?>";
			var exampleDesc = "<?php echo get_option("bsa_pro_plugin_trans_form_left_eg_desc"); ?>";
			var exampleUrl = "<?php echo get_option("bsa_pro_plugin_trans_form_left_eg_url"); ?>";
			var exampleHTML = "HTML Code Here";

			sign.text(limit - input.val().length);

			input.keyup(function() {
				if (input.val().length > limit) {
					input.val($(this).val().substring(0, limit));
				}
			});

			if (input.val().length > 0) {
				if ( inputName == "title" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(input.val());
				} else if ( inputName == "desc" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(input.val());
				} else if ( inputName == "url" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html("http://" + input.val().replace("http://","").replace("https://","").replace("www.","").split(/[/?#]/)[0]);
				} else if ( inputName == "html" ) {
					<?php if ( get_option('bsa_pro_plugin_'.'html_preview') == 'no' || get_option('bsa_pro_plugin_'.'html_preview') == NULL ): ?>
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(input.val());
					<?php endif; ?>
				}
			} else {
				if ( inputName == "title" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(exampleTitle);
				} else if ( inputName == "desc" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(exampleDesc);
				} else if ( inputName == "url" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html("http://" + exampleUrl.val().replace("http://","").replace("https://","").replace("www.","").split(/[/?#]/)[0]);
				} else if ( inputName == "html" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(exampleHTML);
				}
			}
		})(jQuery);
	}

	function bsaPreviewThumb(input)
	{
		(function($){
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$(".bsaProItemInner__img").css({"background-image" : "url(" + e.target.result + ")"});
				};
				reader.readAsDataURL(input.files[0]);
			}
		})(jQuery);
	}
</script>