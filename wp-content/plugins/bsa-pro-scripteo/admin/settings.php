<?php
if (get_option('bsa_pro_plugin_symbol_position') == 'before') {
	$before = '<small>'.get_option('bsa_pro_plugin_currency_symbol').'</small> ';
} else {
	$before = '';
}
if (get_option('bsa_pro_plugin_symbol_position') != 'before') {
	$after = ' <small>'.get_option('bsa_pro_plugin_currency_symbol').'</small>';
} else {
	$after = '';
}

function selectedOpt($optName, $optValue)
{
	if(get_option('bsa_pro_plugin_'.$optName) == $optValue) {
		echo 'selected="selected"';
	}
}
function validValue($variableName)
{
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		echo $_POST[$variableName];
	} else {
		echo get_option('bsa_pro_plugin_'.$variableName);
	}
}

function selectedSpaceOpt($optName, $optValue)
{
	if ( isset( $_GET['space_id'] ) && bsa_space($_GET['space_id'], $optName) == $optValue || isset($_POST[$optName]) && $_POST[$optName] == $optValue ) {
		echo 'selected="selected"';
	}
}
?>
	<h2><i class="dashicons-before dashicons-admin-settings"></i> Settings</h2>

	<h2 class="nav-tab-white nav-tab-wrapper">
		<a href="#bsaPayment" class="nav-tab nav-tab-active" data-group="bsaTabPayment">Payment Settings</a>
		<a href="#bsaReInstallation" class="nav-tab" data-group="bsaTabReInstallation">Re-installation</a>
		<a href="#bsaHooks" class="nav-tab" data-group="bsaTabHooks">Hooks</a>
		<a href="#bsaAdmin" class="nav-tab" data-group="bsaTabAdmin">Admin Settings</a>
		<a href="#bsaMedia" class="nav-tab" data-group="bsaTabMedia">Media Settings</a>
		<a href="#bsaCustomization" class="nav-tab" data-group="bsaTabOrderForm">Customization</a>
		<a href="#bsaAffiliate" class="nav-tab" data-group="bsaTabAffiliateProgram">Affiliate Program Add-on</a>
		<a href="#bsaAddOn" class="nav-tab" data-group="bsaTabMarketingAgency">Marketing Agency Add-on</a>
	</h2>

	<form action="" method="post">
		<input type="hidden" value="updateSettings" name="bsaProAction">
		<table class="bsaAdminTable bsaMarTopNull form-table">
			<tbody id="bsaPayment" class="bsaTabPayment bsaTbody">
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-cart"></span> Payments Settings</h3>
					</th>
				</tr>
				<tr class="bsaBottomLine">
					<th scope="row"><label for="purchase_code">Purchase Code</label></th>
					<td><input type="text" class="regular-text code" value="<?php validValue('purchase_code'); ?>" id="purchase_code" name="purchase_code">
						<p class="description"><strong style="<?php echo ((validValue('purchase_code') != '') ? '' : 'color:red') ?>">This field is required to unlock all features!</strong> You can download it from <a href="http://codecanyon.net/item/ads-pro-multipurpose-wordpress-ad-manager/10275010?ref=scripteo">CodeCanyon</a></p></td>
				</tr>
				<tr>
					<th scope="row"><label for="paypal">PayPal E-mail</label></th>
					<td><input type="text" class="regular-text code" value="<?php validValue('paypal'); ?>" id="paypal" name="paypal">
						<p class="description">At this address you will receive PayPal payments.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="secret_key">Stripe Secret Key</label></th>
					<td><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'secret_key') ?>" id="stripe_code" name="secret_key">
						<p class="description">Stripe > Your account > Account Settings > API Keys</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="publishable_key">Stripe Publishable Key</label></th>
					<td><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'publishable_key') ?>" id="publishable_key" name="publishable_key">
						<p class="description">Stripe > Your account > Account Settings > API Keys</p></td>
				</tr>
				<tr class="bsaBottomLine">
					<th scope="row"><label for="bank_transfer_content">Bank Transfer Details</label></th>
					<td>
						<textarea id="bank_transfer_content" name="trans_payment_bank_transfer_content" class="regular-text" rows="3" cols="40"><?php validValue('trans_payment_bank_transfer_content'); ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ordering_form_url">URL to the Order Form</label></th>
					<td><input type="url" class="regular-text code" maxlength="1000" value="<?php validValue('ordering_form_url'); ?>" id="ordering_form_url" name="ordering_form_url">
						<p class="description">Order Form you can display by shortcode <strong>[bsa_pro_form_and_stats]</strong></p>
						<p class="description"><strong>Example</strong> http://your_page.com/order_ads</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="currency_code">PayPal Currency Code</label></th>
					<td><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'currency_code') ?>" id="currency_code" name="currency_code">
						<p class="description">More information about PayPal Currency Codes <a href="https://developer.paypal.com/docs/classic/api/currency_codes/">here</a>.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="stripe_code">Stripe Currency Code</label></th>
					<td><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'stripe_code') ?>" id="stripe_code" name="stripe_code">
						<p class="description">More information about Stripe Currency Codes <a href="https://support.stripe.com/questions/which-currencies-does-stripe-support">here</a>.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="currency_symbol">Currency symbol</label></th>
					<td><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'currency_symbol') ?>" id="currency_symbol" name="currency_symbol"></td>
				</tr>
				<tr>
					<th scope="row">Price format (symbol position)</th>
					<td>
						<fieldset>
							<label title="symbol before"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'symbol_position') == 'before') { echo 'checked="checked"'; } ?> value="before" name="symbol_position"><strong>before</strong> price <span>(eg. <strong>$10</strong>)</span></label><br>
							<label title="symbol after"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'symbol_position') == 'after') { echo 'checked="checked"'; } ?>value="after" name="symbol_position"><strong>after</strong> price <span>(eg. <strong>10$</strong>)</span></label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row">Auto-Accept Ads</th>
					<td>
						<fieldset>
							<label title="auto accept ads after purchase"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'auto_accept') == 'yes') { echo 'checked="checked"'; } ?> value="yes" name="auto_accept"><strong>yes</strong></label><br>
							<label title="do not accept ads automatically"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'auto_accept') == 'no') { echo 'checked="checked"'; } ?>value="no" name="auto_accept"><strong>no</strong></label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th class="bsaLast" scope="row">Show calendar in Order Form</th>
					<td class="bsaLast">
						<fieldset>
							<label title="show calendar in order form"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'calendar') == 'yes') { echo 'checked="checked"'; } ?> value="yes" name="calendar"><strong>yes</strong></label><br>
							<label title="hide calendar in order form"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'calendar') == 'no') { echo 'checked="checked"'; } ?>value="no" name="calendar"><strong>no</strong></label>
						</fieldset>
					</td>
				</tr>
			</tbody>
			<tbody id="bsaReInstallation" class="bsaTabReInstallation bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-admin-plugins"></span> Re-installation Settings</h3>
				</th>
			</tr>
			<tr>
				<th class="bsaLast" scope="row">Delete all the data when uninstalling?</th>
				<td class="bsaLast">
					<fieldset>
						<label title="no"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'installation') == 'no') { echo 'checked="checked"'; } ?> value="no" name="installation"><strong>no</strong>, keep all added spaces and ads</label><br>
						<label title="yes"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'installation') == 'yes') { echo 'checked="checked"'; } ?>value="yes" name="installation"><strong>yes</strong>, remove all data (spaces and ads)</label>
					</fieldset>
				</td>
			</tr>
			</tbody>
			<tbody id="bsaHooks" class="bsaTabHooks bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-editor-insertmore"></span> Hooks</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="before_hook">Show Ads before content</label></th>
				<td>
					<textarea id="before_hook" name="before_hook" class="regular-text ltr" rows="7" cols="50"><?php echo get_option('bsa_pro_plugin_'.'before_hook'); ?></textarea>
					<p class="description"><strong>Example:</strong> separate semicolon <strong>;</strong><br>[bsa_pro_ad_space id="1"] ; [bsa_pro_ad_space id="2"] ; [bsa_pro_ad_space id="3"]</p>
				</td>
			</tr>
			<?php for ($i = 1; $i <= 7; $i++): ?>
				<tr>
					<th scope="row"><label for="after_<?php echo $i ?>_paragraph">Show Ads after <?php echo $i ?> paragraph<br> <small>&lt;/p&gt; tag closing each paragraph</small></label></th>
					<td>
						<textarea id="after_<?php echo $i ?>_paragraph" name="after_<?php echo $i ?>_paragraph" class="regular-text ltr" rows="1" cols="50"><?php echo get_option('bsa_pro_plugin_'.'after_' . $i . '_paragraph'); ?></textarea>
						<p class="description"><strong>Example:</strong> separate semicolon <strong>;</strong><br>[bsa_pro_ad_space id="1"] ; [bsa_pro_ad_space id="2"] ; [bsa_pro_ad_space id="3"]</p>
					</td>
				</tr>
			<?php endfor; ?>
			<tr>
				<th class="bsaLast" scope="row"><label for="after_hook">Show Ads after content</label></th>
				<td class="bsaLast">
					<textarea id="after_hook" name="after_hook" class="regular-text ltr" rows="7" cols="50"><?php echo get_option('bsa_pro_plugin_'.'after_hook'); ?></textarea>
					<p class="description"><strong>Example:</strong> separate semicolon <strong>;</strong><br>[bsa_pro_ad_space id="1"] ; [bsa_pro_ad_space id="2"] ; [bsa_pro_ad_space id="3"]</p>
				</td>
			</tr>
			</tbody>
			<tbody id="bsaAdmin" class="bsaTabAdmin bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-admin-settings"></span> Admin Settings</h3>
				</th>
			</tr>
			<tr>
				<th scope="row">RTL Support</th>
				<td>
					<fieldset>
						<label title="no"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'rtl_support') == 'no') { echo 'checked="checked"'; } ?> value="no" name="rtl_support"><strong>no</strong></label><br>
						<label title="yes"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'rtl_support') == 'yes') { echo 'checked="checked"'; } ?>value="yes" name="rtl_support"><strong>yes</strong></label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row">Disable preview for HTML Ad</th>
				<td>
					<fieldset>
						<label title="no"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'html_preview') == 'no') { echo 'checked="checked"'; } ?> value="no" name="html_preview"><strong>no</strong></label><br>
						<label title="yes"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'html_preview') == 'yes') { echo 'checked="checked"'; } ?>value="yes" name="html_preview"><strong>yes</strong></label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row">Hide all ads for logged users</th>
				<td>
					<fieldset>
						<label title="no"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'hide_if_logged') == 'no') { echo 'checked="checked"'; } ?> value="no" name="hide_if_logged"><strong>no</strong></label><br>
						<label title="yes"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'hide_if_logged') == 'yes') { echo 'checked="checked"'; } ?>value="yes" name="hide_if_logged"><strong>yes</strong></label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row">Disable Admin Bar link</th>
				<td class="bsaLast">
					<fieldset>
						<label title="no"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'link_bar') == 'no') { echo 'checked="checked"'; } ?> value="no" name="link_bar"><strong>no</strong></label><br>
						<label title="yes"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'link_bar') == 'yes') { echo 'checked="checked"'; } ?>value="yes" name="link_bar"><strong>yes</strong></label>
					</fieldset>
				</td>
			</tr>
			</tbody>
			<tbody id="bsaMedia" class="bsaTabMedia bsaTbody" style="display:none">
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-format-image"></span> File & Ads Settings</h3>
					</th>
				</tr>
				<tr>
					<th scope="row"><label for="thumb_size">Maximum upload file size <br>(default 400kb)</label></th>
					<td><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'thumb_size') ?>" id="thumb_size" name="thumb_size"> <abbr title="kilobyte">kb</abbr></td>
				</tr>
				<tr>
					<th scope="row"><label for="thumb_w">Image, maximum width <br>(default 1024px)</label></th>
					<td><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'thumb_w') ?>" id="thumb_w" name="thumb_w"> <abbr title="pixels">px</abbr></td>
				</tr>
				<tr class="bsaBottomLine">
					<th class="bsaLast" scope="row"><label for="thumb_h">Image, maximum height <br>(default 800px)</label></th>
					<td class="bsaLast"><input type="text" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'thumb_h') ?>" id="thumb_h" name="thumb_h"> <abbr title="pixels">px</abbr></td>
				</tr>
<!--				<tr>-->
<!--					<th scope="row"><label for="max_title">Maximum length of Ad Title</label></th>-->
<!--					<td><input type="text" class="regular-text ltr" value="--><?php //echo get_option('bsa_pro_plugin_'.'max_title') ?><!--" id="max_title" name="max_title"> <abbr>(40-70 characters)</abbr></td>-->
<!--				</tr>-->
<!--				<tr>-->
<!--					<th scope="row"><label for="max_desc">Maximum length of Ad Description</label></th>-->
<!--					<td><input type="text" class="regular-text ltr" value="--><?php //echo get_option('bsa_pro_plugin_'.'max_desc') ?><!--" id="max_desc" name="max_desc"> <abbr>(80-140 characters)</abbr></td>-->
<!--				</tr>-->
			</tbody>
			<tbody id="bsaCustomization" class="bsaTabOrderForm bsaTbody" style="display:none">
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-admin-appearance"></span> Order Form Customization</h3>
					</th>
				</tr>
				<tr>
					<th scope="row"><label for="form_bg">Form Background</label></th>
					<td>
						<input id="form_bg"
							   name="form_bg"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_bg') ?>"
							   data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_c">Form Text Color</label></th>
					<td>
						<input id="form_c"
							   name="form_c"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_c') ?>"
							   data-default-color="#444444" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_input_bg">Input Background</label></th>
					<td>
						<input id="form_input_bg"
							   name="form_input_bg"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_input_bg') ?>"
							   data-default-color="#f5f5f5" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_input_c">Input Color</label></th>
					<td>
						<input id="form_input_c"
							   name="form_input_c"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_input_c') ?>"
							   data-default-color="#444444" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_price_c">Price Color</label></th>
					<td>
						<input id="form_price_c"
							   name="form_price_c"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_price_c') ?>"
							   data-default-color="#65cc84" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_discount_bg">Discount Background</label></th>
					<td>
						<input id="form_discount_bg"
							   name="form_discount_bg"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_discount_bg') ?>"
							   data-default-color="#df5050" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_discount_c">Discount Color</label></th>
					<td>
						<input id="form_discount_c"
							   name="form_discount_c"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_discount_c') ?>"
							   data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_button_bg">Button Background</label></th>
					<td>
						<input id="form_button_bg"
							   name="form_button_bg"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_button_bg') ?>"
							   data-default-color="#65cc84" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_button_c">Button Color</label></th>
					<td>
						<input id="form_button_c"
							   name="form_button_c"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_button_c') ?>"
							   data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-admin-appearance"></span> Alert Colors</h3>
					</th>
				</tr>
				<tr>
					<th scope="row"><label for="form_alert_c">Alert Text Color</label></th>
					<td>
						<input id="form_alert_c"
							   name="form_alert_c"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_alert_c') ?>"
							   data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_alert_success_bg">Success Background</label></th>
					<td>
						<input id="form_alert_success_bg"
							   name="form_alert_success_bg"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_alert_success_bg') ?>"
							   data-default-color="#65cc84" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="form_alert_failed_bg">Failed Background</label></th>
					<td>
						<input id="form_alert_failed_bg"
							   name="form_alert_failed_bg"
							   value="<?php echo get_option('bsa_pro_plugin_'.'form_alert_failed_bg') ?>"
							   data-default-color="#df5050" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-admin-appearance"></span> Chart Colors</h3>
					</th>
				</tr>
				<tr>
					<th scope="row"><label for="stats_views_line">Stats Views Color</label></th>
					<td>
						<input id="stats_views_line"
							   name="stats_views_line"
							   value="<?php echo get_option('bsa_pro_plugin_'.'stats_views_line') ?>"
							   data-default-color="#673AB7" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="stats_clicks_line">Stats Clicks Color</label></th>
					<td>
						<input id="stats_clicks_line"
							   name="stats_clicks_line"
							   value="<?php echo get_option('bsa_pro_plugin_'.'stats_clicks_line') ?>"
							   data-default-color="#FBCD39" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-admin-appearance"></span> Affiliate Program Customization</h3>
					</th>
				</tr>
				<?php $opt = 'ap_custom'; ?>
				<tr>
					<th scope="row"><label for="general_bg">General Background</label></th>
					<td>
						<input id="general_bg" name="general_bg" value="<?php echo bsa_get_opt($opt, 'general_bg') ?>" data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="general_color">General Color</label></th>
					<td>
						<input id="general_color" name="general_color" value="<?php echo bsa_get_opt($opt, 'general_color') ?>" data-default-color="#000000" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="commission_bg">Commission Section - Background</label></th>
					<td>
						<input id="commission_bg" name="commission_bg" value="<?php echo bsa_get_opt($opt, 'commission_bg') ?>" data-default-color="#673ab7" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="commission_color">Commission Section - Color</label></th>
					<td>
						<input id="commission_color" name="commission_color" value="<?php echo bsa_get_opt($opt, 'commission_color') ?>" data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="balance_bg">Balance Section - Background</label></th>
					<td>
						<input id="balance_bg" name="balance_bg" value="<?php echo bsa_get_opt($opt, 'balance_bg') ?>" data-default-color="#8e6acf" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="balance_color">Balance Section - Color</label></th>
					<td>
						<input id="balance_color" name="balance_color" value="<?php echo bsa_get_opt($opt, 'balance_color') ?>" data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="link_color">Balance Link Color</label></th>
					<td>
						<input id="link_color" name="link_color" value="<?php echo bsa_get_opt($opt, 'link_color') ?>" data-default-color="#ffd71a" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ref_bg">Referral Section - Background</label></th>
					<td>
						<input id="ref_bg" name="ref_bg" value="<?php echo bsa_get_opt($opt, 'ref_bg') ?>" data-default-color="#ffd71a" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ref_color">Referral Section - Color</label></th>
					<td>
						<input id="ref_color" name="ref_color" value="<?php echo bsa_get_opt($opt, 'ref_color') ?>" data-default-color="#000000" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="table_bg">Table Section - Background</label></th>
					<td>
						<input id="table_bg" name="table_bg" value="<?php echo bsa_get_opt($opt, 'table_bg') ?>" data-default-color="#ffd71a" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="table_color">Table Section - Color</label></th>
					<td>
						<input id="table_color" name="table_color" value="<?php echo bsa_get_opt($opt, 'table_color') ?>" data-default-color="#000000" type="text" class="bsaColorPicker">
					</td>
				</tr>
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-admin-appearance"></span> Custom CSS / JS</h3>
					</th>
				</tr>
				<tr>
					<th scope="row"><label for="custom_css">Custom CSS</label></th>
					<td>
						<textarea id="custom_css" name="custom_css" class="regular-text ltr" rows="17" cols="70"><?php echo get_option('bsa_pro_plugin_'.'custom_css') ?></textarea>
					</td>
				</tr>
				<tr>
					<th class="bsaLast" scope="row"><label for="custom_js">Custom JavaScript</label></th>
					<td class="bsaLast">
						<textarea id="custom_js" name="custom_js" class="regular-text ltr" rows="17" cols="70"><?php echo get_option('bsa_pro_plugin_'.'custom_js') ?></textarea>
					</td>
				</tr>
				<?php if ( get_option('bsa_pro_plugin_calendar') == 'yes' ): ?>
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-calendar-alt"></span> Calendar Advanced Settings</h3>
					</th>
				</tr>
				<tr>
					<th class="bsaLast" scope="row"><label for="advanced_calendar">Custom JavaScript</label></th>
					<td class="bsaLast">
						<textarea id="advanced_calendar" name="advanced_calendar" class="regular-text ltr" rows="17" cols="140"><?php echo get_option('bsa_pro_plugin_'.'advanced_calendar') ?></textarea>
					</td>
				</tr>
				<?php endif; ?>
			</tbody>
			<tbody id="bsaAffiliate" class="bsaTabAffiliateProgram bsaTbody" style="display:none">
				<tr>
					<th colspan="2">
						<h3><span class="dashicons dashicons-cart"></span> Affiliate Program Settings (<a href="http://codecanyon.net/user/scripteo?ref=scripteo">Affiliate Program Add-on</a>)</h3>
					</th>
				</tr>
				<tr>
					<th scope="row"><label for="ap_cookie_lifetime">Cookie Lifetime</label></th>
					<td>
						<select id="ap_cookie_lifetime" name="ap_cookie_lifetime">
							<?php

							for ($i = 10; $i <= 90; $i++) {
								echo $i;
								if ( $i <= 10 || $i == 15 || $i == 20 || $i == 25 || $i == 30 || $i == 40 || $i == 50 || $i == 60 || $i == 70 || $i == 80 || $i == 90 ) {
									?>
									<option value="<?php echo $i; ?>" <?php selectedSpaceOpt('ap_cookie_lifetime', $i); ?>> <?php echo $i; ?> <?php if($i == 1) { echo 'day'; } else { echo 'days'; } ?></option>
								<?php
								}
							}

							?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ap_commission">Affiliate Commission</label></th>
					<td><input type="number" class="regular-text code" value="<?php echo get_option('bsa_pro_plugin_'.'ap_commission'); ?>" id="ap_commission" name="ap_commission"> <abbr title="percent">%</abbr></td>
				</tr>
				<tr class="bsaBottomLine">
					<th class="bsaLast" scope="row"><label for="ap_minimum_withdrawal">Minimum amount for Withdrawal</label></th>
					<td class="bsaLast"><?php echo $before ?><input type="number" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'ap_minimum_withdrawal'); ?>" id="ap_minimum_withdrawal" name="ap_minimum_withdrawal"> <?php echo $after ?></td>
				</tr>
			</tbody>
			<tbody id="bsaAddOn" class="bsaTabMarketingAgency bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-cart"></span> Marketing Agency Settings (<a href="http://codecanyon.net/item/ads-pro-1-wordpress-marketing-agency-addon/10665901?ref=scripteo">Marketing Agency Add-on</a>)</h3>
				</th>
			</tr>
			<tr>
				<th scope="row">Privacy<br>(who can add sites to a marketing agency)</th>
				<td>
					<fieldset>
						<label title="no"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'private_ma') == 'no') { echo 'checked="checked"'; } ?> value="no" name="private_ma"><strong>public</strong>, users can add their sites</label><br>
						<label title="yes"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'private_ma') == 'yes') { echo 'checked="checked"'; } ?>value="yes" name="private_ma"><strong>private</strong>, only administrators can add sites</label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="agency_api_url">URL to Agency API</label></th>
				<td><input type="url" class="regular-text code" maxlength="1000" value="<?php echo get_option('bsa_pro_plugin_'.'agency_api_url'); ?>" id="agency_api_url" name="agency_api_url">
					<p class="description">How to configure API page? (<a href="http://adspro.scripteo.info/documentation/#agency">Video Guide</a>)</p>
					<p class="description"><strong>Example</strong> http://your_page.com/api</p></td>
			</tr>
			<tr>
				<th scope="row"><label for="agency_ordering_form_url">URL to Agency Ordering Form</label></th>
				<td><input type="url" class="regular-text code" maxlength="1000" value="<?php echo get_option('bsa_pro_plugin_'.'agency_ordering_form_url'); ?>" id="agency_ordering_form_url" name="agency_ordering_form_url">
					<p class="description">Ordering form you can display by shortcode <strong>[bsa_pro_agency_form]</strong></p>
					<p class="description"><strong>Example</strong> http://your_page.com/agency_order_ads</p></td>
			</tr>
			<tr>
				<th scope="row"><label for="agency_commission">Agency Commission</label></th>
				<td><input type="number" class="regular-text code" value="<?php echo get_option('bsa_pro_plugin_'.'agency_commission'); ?>" id="agency_commission" name="agency_commission"> <abbr title="percent">%</abbr></td>
			</tr>
			<tr>
				<th scope="row">Allow displaying Ads for other Sites (non-wordpress)</th>
				<td>
					<fieldset>
						<label title="ads can be shown only for wordpress via ads pro parser"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'agency_other_sites') == 'no') { echo 'checked="checked"'; } ?> value="no" name="agency_other_sites"><strong>no</strong>, ads can be shown only for wordpress via Ads Pro Parser</label><br>
						<label title="ads can be shown anywhere via iframe also"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'agency_other_sites') == 'yes') { echo 'checked="checked"'; } ?>value="yes" name="agency_other_sites"><strong>yes</strong>, ads can be shown anywhere via iframe also</label>
					</fieldset>
					<p class="description"><strong>Note!</strong><br>For the iframe option, you can use all Ad Templates and default Display Type.</p>
				</td>
			</tr>
			<tr>
				<th scope="row">Agency Auto-Accept Sites</th>
				<td>
					<fieldset>
						<label title="auto accept sites for marketing agency"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'agency_auto_accept') == 'yes') { echo 'checked="checked"'; } ?> value="yes" name="agency_auto_accept"><strong>yes</strong></label><br>
						<label title="do not accept sites automatically"><input type="radio" <?php if(get_option('bsa_pro_plugin_'.'agency_auto_accept') == 'no') { echo 'checked="checked"'; } ?>value="no" name="agency_auto_accept"><strong>no</strong></label>
					</fieldset>
				</td>
			</tr>
			<tr class="bsaBottomLine">
				<th class="bsaLast" scope="row"><label for="agency_minimum_withdrawal">Minimum amount for Withdrawal</label></th>
				<td class="bsaLast"><?php echo $before ?><input type="number" class="regular-text ltr" value="<?php echo get_option('bsa_pro_plugin_'.'agency_minimum_withdrawal'); ?>" id="agency_minimum_withdrawal" name="agency_minimum_withdrawal"> <?php echo $after ?></td>
			</tr>
			</tbody>
		</table>
		<p class="submit"><input type="submit" value="Save Changes" class="button button-primary" id="submit" name="submit"></p>
	</form>

<script>
	(function($){
		// - start - open page
		var bsaItemsWrap = $('.wrap');
		bsaItemsWrap.hide();

		setTimeout(function(){
			bsaItemsWrap.fadeIn(400);
		}, 400);
		// - end - open page

		$(document).ready(function(){

			// open tab after refresh
			var navTab = $('.nav-tab');
			var hash = window.location.hash;
			if(hash != "") {
				navTab.removeClass('nav-tab-active');
				$('a[href="' + hash + '"]').addClass('nav-tab-active');

				$('.bsaTbody').hide();
				$(hash).show();
			}

			// init color picker
			$('.bsaColorPicker').wpColorPicker();

			// menu actions
			navTab.click(function(){
				var attr = $(this).attr("data-group");

				navTab.removeClass('nav-tab-active');
				$(this).addClass('nav-tab-active');

				$('.bsaTbody').hide();
				$('.' + attr).show();
			});

		});

	})(jQuery);
</script>