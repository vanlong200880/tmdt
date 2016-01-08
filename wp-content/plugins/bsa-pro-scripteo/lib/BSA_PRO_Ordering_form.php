<?php
$bsaTrans = 'bsa_pro_plugin_trans_';

$model = new BSA_PRO_Model();
if ( isset($_POST) && isset($_POST['bsaProSubmit']) ) {
	$getForm = $model->getForm();
} else {
	$getForm = '';
}

// get notify action
if (isset($_GET['bsa_pro_payment']) && $_GET['bsa_pro_payment'] == 'notify' || isset($_POST['stripeToken'])) {
	$model->notifyAction();
}

echo '
<div class="bsaProOrderingForm">
	<div class="bsaProOrderingFormInner">
		';

	if (isset($_GET["bsa_pro_notice"]) && $_GET["bsa_pro_notice"] == 'success'): ?>
		<div class="bsaProAlert bsaProAlertSuccess bsaProAlertSuccessNotice">
			<strong><?php echo get_option($bsaTrans."alert_success"); ?></strong>
			<p><?php echo get_option($bsaTrans."payment_success"); ?></p>
		</div>
	<?php elseif (isset($_GET["bsa_pro_notice"]) && $_GET["bsa_pro_notice"] == 'failed'): ?>
		<div class="bsaProAlert bsaProAlertFailed bsaProAlertFailedNotice">
			<strong><?php echo get_option($bsaTrans."alert_failed"); ?></strong>
			<p><?php echo get_option($bsaTrans."payment_failed"); ?></p>
		</div>
	<?php endif; ?>

	<?php if ($getForm == "invalidParams"): ?>
		<div class="bsaProAlert bsaProAlertFailed">
			<strong><?php echo get_option($bsaTrans."alert_failed"); ?></strong>
			<p><?php echo get_option($bsaTrans."form_invalid_params"); ?></p>
		</div>
	<?php elseif ($getForm == "invalidSizeFile"): ?>
		<div class="bsaProAlert bsaProAlertFailed">
			<strong><?php echo get_option($bsaTrans."alert_failed"); ?></strong>
			<p><?php echo get_option($bsaTrans."form_too_high"); ?></p>
		</div>
	<?php elseif ($getForm == "invalidFile"): ?>
		<div class="bsaProAlert bsaProAlertFailed">
			<strong><?php echo get_option($bsaTrans."alert_failed"); ?></strong>
			<p><?php echo get_option($bsaTrans."form_img_invalid"); ?></p>
		</div>
	<?php elseif ($getForm == "fieldsRequired"): ?>
		<div class="bsaProAlert bsaProAlertFailed">
			<strong><?php echo get_option($bsaTrans."alert_failed"); ?></strong>
			<p><?php echo get_option($bsaTrans."form_empty"); ?></p>
		</div>
	<?php elseif ($getForm == "successAdded"): ?>
		<div class="bsaProAlert bsaProAlertSuccess">
			<strong><?php echo get_option($bsaTrans."alert_success"); ?></strong>
			<p><?php echo get_option($bsaTrans."form_success"); ?></p>
		</div>
		<div id="bsaSuccessProRedirect">
			<div class="bsaPayPalSectionBg"></div>
			<div class="bsaPayPalSectionCenter">
				<span class="bsaLoaderRedirect" style="margin-top:200px;"></span>
			</div>
			<form><input id="bsa_payment_url" type="hidden" name="bsa_payment_url" value="<?php echo (isset($_SESSION['bsa_payment_url'])) ? $_SESSION['bsa_payment_url'] : '' ?>"></form>
		</div>
	<?php endif;

	$spaces = $model->getSpaces('active', 'html');
	$space_verify = NULL;
	if (is_array($spaces))
	{
		foreach ( $spaces as $key => $space ) {
			if ( $model->countAds($space["id"]) < bsa_space($space["id"], 'max_items') ) {
				$space_verify .= (( $key > 0 ) ? ','.$space["id"] : $space["id"]);
			} else {
				$space_verify .= '';
			}
		}
	}
	$space_verify = (( $space_verify != '') ? explode(',', $space_verify) : FALSE );

	if ( isset($_GET['oid']) && $_GET['oid'] != '' && bsa_ad($_GET['oid'], 'id') != null ) { // Payments

		if (empty($_GET)) {
			$checkGET = '?';
		} else {
			$checkGET = '&';
		}
		$orderId = $_GET['oid'];
		$userEmail = bsa_ad($_GET['oid'], 'buyer_email');
		$amount = bsa_ad($_GET['oid'], 'cost');
		// reset cache sessions
		unset($_SESSION['bsa_ad_'.$orderId]);
		if ( bsa_ad($_GET['oid'], 'paid') == 1 || bsa_ad($_GET['oid'], 'paid') == 2 ) {
			?>
			<div class="bsaProAlert bsaProAlertSuccess">
				<strong><?php echo get_option($bsaTrans."alert_success"); ?></strong>
				<p><?php echo get_option($bsaTrans."payment_paid"); ?></p>
			</div>
			<small style="margin-top: -10px;display: block;text-align: center;">
				<a href="<?php echo get_option("bsa_pro_plugin_ordering_form_url") ?>" style="font-size:12px;font-weight: normal;text-decoration: none;">&lt; <?php echo get_option($bsaTrans."payment_return"); ?></a>
			</small>
			<?php
		} else {
			$payments_Stripe 		= ( (get_option("bsa_pro_plugin_secret_key") != '' && get_option("bsa_pro_plugin_publishable_key") != '' && get_option('bsa_pro_plugin_stripe_code') != '') ? 1 : 0 );
			$payments_PayPal 		= ( (get_option("bsa_pro_plugin_paypal") != '' && get_option("bsa_pro_plugin_currency_code") != '') ? 1 : 0 );
			$payments_BankTransfer 	= ( (get_option("bsa_pro_plugin_trans_payment_bank_transfer_content") != '') ? 1 : 0 );
			$payments_count = $payments_Stripe + $payments_PayPal + $payments_BankTransfer;
			?>
			<div class="bsaProContainer bsa-pro-col-<?php echo $payments_count ?>">
				<div class="bsaProItems bsaGridGutter">

					<div style="text-align:center;">
						<h2><?php echo get_option($bsaTrans."payment_select"); ?></h2>
						<small style="margin-top: -10px;display: block;">
							<a href="<?php echo get_option("bsa_pro_plugin_ordering_form_url") ?>" style="font-size:12px;font-weight: normal;text-decoration: none;">&lt; <?php echo get_option($bsaTrans."payment_return"); ?></a>
						</small>
					</div>

					<?php if ( get_option("bsa_pro_plugin_secret_key") != '' && get_option("bsa_pro_plugin_publishable_key") != '' && get_option('bsa_pro_plugin_stripe_code') != '' ): ?>
						<div class="bsaProItem" data-animation="zoomInDown" style="text-align: center; margin-left:0;">
							<h2><?php echo get_option($bsaTrans."payment_stripe_title"); ?></h2>

							<form action="" method="POST">
								<script
									src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-key="<?php echo get_option('bsa_pro_plugin_publishable_key') ?>"
									data-amount="<?php echo number_format(bsa_number_format($amount), 2, '', '') ?>"
									data-currency="<?php echo get_option('bsa_pro_plugin_stripe_code') ?>"
									data-item_number="<?php echo $orderId ?>"
									data-name="<?php echo $userEmail ?>"
									data-description="<?php echo $userEmail ?> (<?php echo bsa_number_format($amount) ?>)">
								</script>
							</form>

						</div>
					<?php endif; ?>

					<?php if ( get_option("bsa_pro_plugin_paypal") != '' && get_option("bsa_pro_plugin_currency_code") != '' ): ?>
					<div class="bsaProItem" data-animation="zoomInDown" style="text-align: center; margin-left:0;">
						<h2><?php echo get_option($bsaTrans."payment_paypal_title"); ?></h2>

						<form id="bsa-Pro-PayPal-Payment" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="<?php echo (get_option("bsa_pro_plugin_purc"."hase_code") != '' && get_option("bsa_pro_plugin_purc"."hase_code") != null) ? get_option("bsa_pro_plugin_paypal") : 'scripteo@gmail.com' ?>">
							<input type="hidden" name="item_name" value="<?php echo $userEmail ?>">
							<input type="hidden" name="item_number" value="<?php echo $orderId ?>">
							<input type="hidden" name="tax" value="0">
							<input type="hidden" name="no_note" value="1">
							<input type="hidden" name="no_shipping" value="1">
							<input type="hidden" name="amount" value="<?php echo bsa_number_format($amount) ?>">
							<input type="hidden" name="custom" value="<?php echo md5($orderId.bsa_number_format($amount)) ?>">
							<input type="hidden" name="currency_code" value="<?php echo get_option("bsa_pro_plugin_currency_code") ?>">
							<input type="hidden" name="return" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$checkGET ?>bsa_pro_notice=success">
							<input type="hidden" name="cancel_return" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$checkGET ?>bsa_pro_notice=failed">
							<input type="hidden" name="notify_url" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].$checkGET ?>bsa_pro_payment=notify">
							<input type="image" name="submit" border="0" class="bsaProImgSubmit" src="https://www.paypalobjects.com/webstatic/en_US/logo/pp_cc_mark_111x69.png" alt="PayPal">
						</form>

					</div>
					<?php endif; ?>

					<?php if ( get_option("bsa_pro_plugin_trans_payment_bank_transfer_content") != '' ): ?>
					<div class="bsaProItem" data-animation="zoomInDown" style="text-align: center">
						<h2><?php echo get_option($bsaTrans."payment_bank_transfer_title"); ?></h2>
						<p style="white-space: pre-wrap"><?php echo get_option($bsaTrans."payment_bank_transfer_content"); ?></p>
					</div>
					<?php endif; ?>

				</div>
			</div>
			<?php
		}

	} else { // Form

		if ( $space_verify && $spaces ) {
			echo '
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="bsaProInputs bsaProInputsLeft">
						<input type="hidden" name="bsaProAction" value="buyNewAd">
						<input class="bsa_inputs_required" name="inputs_required" type="hidden" value="">
						<h3>'. get_option($bsaTrans."form_left_header").' <span class="bsaLoader bsaLoaderInputs" style="display:none;"></span></h3>
						<div class="bsaProInput">
							<label for="bsa_pro_space_id">'. get_option($bsaTrans."form_left_select_space").'</label>
							<div class="bsaProSelectSpace">
								<select id="bsa_pro_space_id" name="space_id">
								';
			foreach ( $model->getSpaces('active', 'html') as $space ) {
				if ( ($model->countAds($space["id"]) < bsa_space($space["id"], 'max_items')) || bsa_space($space["id"], 'max_items') == 1 && get_option('bsa_pro_plugin_calendar') == 'yes' ) {
					echo '<option value="'.$space["id"].'" '.((isset($_POST["space_id"]) && $_POST["space_id"] == $space["id"] or isset($_GET['sid']) && $_GET['sid'] == $space["id"]) ? 'selected="selected"' : "").'>'.$space["name"].'</option>';
				} else {
					echo '<option value="" disabled>'.$space["name"].' ('.$model->countAds($space["id"]).'/'.bsa_space($space["id"], 'max_items').')'.'</option>';
				}
			}
			echo '
								</select>
							</div>
						</div>
						<div class="bsaProInput">
							<label for="bsa_pro_buyer_email">'. get_option($bsaTrans."form_left_email").'</label>
							<input id="bsa_pro_buyer_email" name="buyer_email" type="email" value="'.bsaGetPost('buyer_email').'" placeholder="'.get_option($bsaTrans."form_left_eg_email").'">
						</div>
						<div class="bsaProInput bsa_title_inputs_load" style="display: none">
							<label for="bsa_pro_title">'. get_option($bsaTrans."form_left_title").' (<span class="bsa_pro_sign_title">'.get_option('bsa_pro_plugin_max_title').'</span>)</label>
							<input id="bsa_pro_title" name="title" type="text" value="'.bsaGetPost('title').'" placeholder="'.get_option($bsaTrans."form_left_eg_title").'" maxlength="'.get_option('bsa_pro_plugin_max_title').'">
						</div>
						<div class="bsaProInput bsa_desc_inputs_load" style="display: none">
							<label for="bsa_pro_desc">'. get_option($bsaTrans."form_left_desc").' (<span class="bsa_pro_sign_desc">'.get_option('bsa_pro_plugin_max_desc').'</span>)</label>
							<input id="bsa_pro_desc" name="description" type="text" value="'.bsaGetPost('description').'" placeholder="'.get_option($bsaTrans."form_left_eg_desc").'" maxlength="'.get_option('bsa_pro_plugin_max_desc').'">
						</div>
						<div class="bsaProInput bsa_url_inputs_load" style="display: none">
							<label for="bsa_pro_url">'. get_option($bsaTrans."form_left_url").' (<span class="bsa_pro_sign_url">255</span>)</label>
							<input id="bsa_pro_url" name="url" type="url" value="'.bsaGetPost('url').'" placeholder="'.get_option($bsaTrans."form_left_eg_url").'" maxlength="255">
						</div>
						<div class="bsaProInput bsa_img_inputs_load" style="display: none">
							<label for="bsa_pro_img">'. get_option($bsaTrans."form_left_thumb").'</label>
							<input type="file" name="img" id="bsa_pro_img" onchange="bsaPreviewThumb(this)">
						</div>
						';
						if ( get_option('bsa_pro_plugin_'.'calendar') == 'yes' ) {
						echo '
						<div class="bsaProInput">
							<label for="bsa_pro_calendar">'. get_option($bsaTrans."form_left_calendar").'</label>
							<input type="text" class="bsa_pro_calendar" id="bsa_pro_calendar" name="calendar"  value="'.bsaGetPost('calendar').'" placeholder="'.get_option($bsaTrans."form_left_eg_calendar").'">
						</div>';
						}
					echo '
					</div>
					<div class="bsaProInputs bsaProInputsRight">
						<h3>'. get_option($bsaTrans."form_right_header").' <span class="bsaLoader bsaLoaderModels" style="display:none;"></span></h3>
						<div class="bsaGetBillingModels"></div>

						<h3>'. get_option($bsaTrans."form_live_preview").' <span class="bsaLoader bsaLoaderPreview" style="display:none;"></span></h3>
						<div class="bsaTemplatePreview bsaTemplatePreviewForm">
							<div class="bsaTemplatePreviewInner"></div>
						</div>
					</div>

					<button type="submit" name="bsaProSubmit" value="1" class="bsaProSubmit clearfix">'.get_option($bsaTrans.'form_right_button_pay').'</button>
			</form>
		';
		} else {
			echo "<strong>ADS Notice!</strong> Spaces are full or doesn't exists. Add new Space in Admin Panel.";
		}
	}
echo '
	</div>
</div>';
$getUnavailableDates 	= $model->getUnavailableDates();
?>
<script>
	(function($) {
		$(document).ready(function(){
			var bsaProCalendar = $(".bsa_pro_calendar");
			var sid = $("#bsa_pro_space_id");
			var dates = <?php echo ($getUnavailableDates != null && $getUnavailableDates != '') ? $getUnavailableDates : '' ?>;
			if ( dates && dates != null && dates != '' ) {
				sid.bind("change",function() {
					bsaProCalendar.datepicker({
						dateFormat : "yy-mm-dd",
						<?php echo (get_option('bsa_pro_plugin_advanced_calendar') != '' ? get_option('bsa_pro_plugin_advanced_calendar') : null) ?>
						isRTL: <?php echo (get_option('bsa_pro_plugin_rtl_support') == 'yes' ? get_option('bsa_pro_plugin_rtl_support') : 'false' ) ?>,
						minDate: 0,
						beforeShowDay: function(date){
							var string = jQuery.datepicker.formatDate("yy-mm-dd", date);
							return [ dates[sid.val()].indexOf(string) == -1, "bsaProUnavailableDate" ]
						}
					});
				});
			} else {
				var d = new Date();
				bsaProCalendar.datepicker({
					dateFormat : "yy-mm-dd",
					<?php echo (get_option('bsa_pro_plugin_advanced_calendar') != '' ? get_option('bsa_pro_plugin_advanced_calendar') : null) ?>
					isRTL: <?php echo (get_option('bsa_pro_plugin_rtl_support') == 'yes' ? get_option('bsa_pro_plugin_rtl_support') : 'false' ) ?>,
					minDate: 0,
					beforeShowDay: function(date){
						var string = jQuery.datepicker.formatDate("yy-mm-dd", date);
						return [ (d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + (d.getDay() - 1) ).indexOf(string) == -1, "bsaProUnavailableDate" ]
					}
				});
			}
			var inputTitle = $("#bsa_pro_title");
			var inputDesc = $("#bsa_pro_desc");
			var inputUrl = $("#bsa_pro_url");
			inputTitle.keyup(function() { bsaPreviewInput("title"); });
			inputDesc.keyup(function() { bsaPreviewInput("desc"); });
			inputUrl.keyup(function() { bsaPreviewInput("url"); });
			sid.bind("change",function() {
				bsaGetBillingModels();
				bsaTemplatePreview();
				$(".bsaUrlSpaceId").html($("#bsa_pro_space_id").val());
			});
			sid.trigger("change");
		});
	})(jQuery);
	function bsaGetBillingModels() {
		(function($) {
			var getBillingModels = $(".bsaGetBillingModels");
			var bsaLoaderModels = $(".bsaLoaderModels");
			getBillingModels.slideUp();
			bsaLoaderModels.fadeIn(400);
			setTimeout(function(){
				$.post("<?php echo admin_url("admin-ajax.php") ?>", {action:"bsa_get_billing_models_callback",bsa_space_id:$("#bsa_pro_space_id").val(),bsa_order:1}, function(result) {
					getBillingModels.html(result).slideDown();
					bsaLoaderModels.fadeOut(400);
				});
			}, 700);
		})(jQuery);
	}
	function bsaTemplatePreview() {
		(function($) {
			var bsaTemplatePreviewInner = $(".bsaTemplatePreviewInner");
			var bsaLoaderPreview = $(".bsaLoaderPreview");
			bsaTemplatePreviewInner.slideUp(400);
			bsaLoaderPreview.fadeIn(400);
			setTimeout(function(){
				$.post("<?php echo admin_url("admin-ajax.php") ?>", {action:"bsa_preview_callback",bsa_space_id:$("#bsa_pro_space_id").val(),bsa_ad_id:$("#bsa_pro_ad_id").val()}, function(result) {
					bsaTemplatePreviewInner.html(result).slideDown(400);
					bsaGetRequiredInputs();
					var inputTitle = $("#bsa_pro_title");
					var inputDesc = $("#bsa_pro_desc");
					var inputUrl = $("#bsa_pro_url");
					if ( inputTitle.val().length > 0 ) { bsaPreviewInput("title"); }
					if ( inputDesc.val().length > 0 ) { bsaPreviewInput("desc"); }
					if ( inputUrl.val().length > 0 ) { bsaPreviewInput("url"); }
					bsaLoaderPreview.fadeOut(400);
				});
			}, 700);
		})(jQuery);
	}
	function bsaGetRequiredInputs() {
		(function($) {
			var bsaLoaderInputs = $(".bsaLoaderInputs");
			bsaLoaderInputs.fadeIn(400);
			$.post("<?php echo admin_url("admin-ajax.php") ?>", {action:"bsa_required_inputs_callback",bsa_space_id:$("#bsa_pro_space_id").val(),bsa_get_required_inputs:1}, function(result) {
				$(".bsa_inputs_required").val($.trim(result));

				if ( result.indexOf("title") != -1 ) { // show if title required
					$(".bsa_title_inputs_load").fadeIn();
				} else {
					$(".bsa_title_inputs_load").fadeOut();
				}
				if ( result.indexOf("desc") != -1 ) { // show if description required
					$(".bsa_desc_inputs_load").fadeIn();
				} else {
					$(".bsa_desc_inputs_load").fadeOut();
				}
				if ( result.indexOf("url") != -1 ) { // show if url required
					$(".bsa_url_inputs_load").fadeIn();
				} else {
					$(".bsa_url_inputs_load").fadeOut();
				}
				if ( result.indexOf("img") != -1 ) { // show if img required
					$(".bsa_img_inputs_load").fadeIn();
				} else {
					$(".bsa_img_inputs_load").fadeOut();
				}
				if ( result.indexOf("html") != -1 ) { // show if html required
					$(".bsa_html_inputs_load").fadeIn();
				} else {
					$(".bsa_html_inputs_load").fadeOut();
				}
				bsaLoaderInputs.fadeOut(400);
			});
		})(jQuery);
	}
	function bsaPreviewInput(inputName) {
		(function($){
  			$(document);
			var input = $("#bsa_pro_" + inputName);
			var sign = $(".bsa_pro_sign_" + inputName);
			var limit = input.attr("maxLength");
			var bsaProContainerExample = $(".bsaProContainerExample");
			var exampleTitle = "<?php echo get_option("bsa_pro_plugin_trans_form_left_eg_title") ?>";
			var exampleDesc = "<?php echo get_option("bsa_pro_plugin_trans_form_left_eg_desc") ?>";
			var exampleUrl = "<?php echo get_option("bsa_pro_plugin_trans_form_left_eg_url") ?>";
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
				}
			} else {
				if ( inputName == "title" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(exampleTitle);
				} else if ( inputName == "desc" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html(exampleDesc);
				} else if ( inputName == "url" ) {
					bsaProContainerExample.find(".bsaProItemInner__" + inputName).html("http://" + exampleUrl.val().replace("http://","").replace("https://","").replace("www.","").split(/[/?#]/)[0]);
				}
			}
		})(jQuery);
	}
	function bsaPreviewThumb(input) {
		(function($){
			if (input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$(".bsaTemplatePreviewForm .bsaProItemInner__img").css({"background-image" : "url(" + e.target.result + ")"});
				};
				reader.readAsDataURL(input.files[0]);
			}
		})(jQuery);
	}
</script>