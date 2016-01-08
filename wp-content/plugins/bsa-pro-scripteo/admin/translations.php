<?php

function validValue($variableName)
{
	if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST[$variableName] != '') {
		echo stripslashes($_POST[$variableName]);
	} else {
		echo stripslashes(get_option('bsa_pro_plugin_trans_'.$variableName));
	}
}

?>
<h2><i class="dashicons dashicons-translation"></i> Translations</h2>

<h2 class="nav-tab-white nav-tab-wrapper">
	<a href="#bsaTabOrderForm" class="nav-tab nav-tab-active" data-group="bsaTabOrderForm">Order Form Translations</a>
	<a href="#bsaTabPayments" class="nav-tab" data-group="bsaTabPayments">Payments</a>
	<a href="#bsaTabAlerts" class="nav-tab" data-group="bsaTabAlerts">Alerts</a>
	<a href="#bsaTabStats" class="nav-tab" data-group="bsaTabStats">Statistics</a>
	<a href="#bsaTabSample" class="nav-tab" data-group="bsaTabSample">Sample</a>
	<a href="#bsaTabEmails" class="nav-tab" data-group="bsaTabEmails">Sender / E-mails</a>
	<a href="#bsaTabOthers" class="nav-tab" data-group="bsaTabOthers">Others</a>
	<a href="#bsaTabAffiliate" class="nav-tab" data-group="bsaTabAffiliateProgram">Affiliate Program Add-on</a>
	<a href="#bsaTabMarketingAgency" class="nav-tab" data-group="bsaTabMarketingAgency">Marketing Agency Add-on</a>
</h2>

<form action="" method="post">
	<input type="hidden" value="updateTranslations" name="bsaProAction">
	<table class="bsaAdminTable bsaMarTopNull form-table">
		<tbody id="bsaTabOrderForm" class="bsaTabOrderForm bsaTbody">
		<tr>
			<th colspan="2">
				<h3><span class="dashicons dashicons-editor-spellcheck"></span> Order Form (left section)</h3>
			</th>
		</tr>
		<tr class="bsaBottomLine">
			<th scope="row"><label for="bsa_pro_trans_form_left_header">Header</label></th>
			<td><input id="bsa_pro_trans_form_left_header" name="form_left_header" value="<?php validValue('form_left_header'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_select_space">Label for Ad Space</label></th>
			<td><input id="bsa_pro_trans_form_left_select_space" name="form_left_select_space" value="<?php validValue('form_left_select_space'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_email">Label for e-mail</label></th>
			<td><input id="bsa_pro_trans_form_left_email" name="form_left_email" value="<?php validValue('form_left_email'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_eg_email"></label>E-mail placeholder</th>
			<td><input id="bsa_pro_trans_form_left_eg_email" name="form_left_eg_email" value="<?php validValue('form_left_eg_email'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_title">Label for title</label></th>
			<td><input id="bsa_pro_trans_form_left_title" name="form_left_title" value="<?php validValue('form_left_title'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_eg_title"></label>Title</th>
			<td><input id="bsa_pro_trans_form_left_eg_title" name="form_left_eg_title" value="<?php validValue('form_left_eg_title'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_desc">Label for description</label></th>
			<td><input id="bsa_pro_trans_form_left_desc" name="form_left_desc" value="<?php validValue('form_left_desc'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_eg_desc"></label>Description</th>
			<td><input id="bsa_pro_trans_form_left_eg_desc" name="form_left_eg_desc" value="<?php validValue('form_left_eg_desc'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_url">Label for URL</label></th>
			<td><input id="bsa_pro_trans_form_left_url" name="form_left_url" value="<?php validValue('form_left_url'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_eg_url">URL placeholder</label></th>
			<td><input id="bsa_pro_trans_form_left_eg_url" name="form_left_eg_url" value="<?php validValue('form_left_eg_url'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_thumb">Label for thumbnail</label></th>
			<td><input id="bsa_pro_trans_form_left_thumb" name="form_left_thumb" value="<?php validValue('form_left_thumb'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_left_calendar">Label for calendar</label></th>
			<td><input id="bsa_pro_trans_form_left_calendar" name="form_left_calendar" value="<?php validValue('form_left_calendar'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th class="bsaLast" scope="row"><label for="bsa_pro_trans_form_left_eg_calendar">Select date</label></th>
			<td class="bsaLast"><input id="bsa_pro_trans_form_left_eg_calendar" name="form_left_eg_calendar" value="<?php validValue('form_left_eg_calendar'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th colspan="2">
				<h3><span class="dashicons dashicons-editor-spellcheck"></span> Order Form (right section)</h3>
			</th>
		</tr>
		<tr class="bsaBottomLine">
			<th scope="row"><label for="bsa_pro_trans_form_right_header">Header</label></th>
			<td><input id="bsa_pro_trans_form_right_header" name="form_right_header" value="<?php validValue('form_right_header'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_right_cpc_name">CPC Model</label></th>
			<td><input id="bsa_pro_trans_form_right_cpc_name" name="form_right_cpc_name" value="<?php validValue('form_right_cpc_name'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_right_cpm_name">CPM Model</label></th>
			<td><input id="bsa_pro_trans_form_right_cpm_name" name="form_right_cpm_name" value="<?php validValue('form_right_cpm_name'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_right_cpd_name">CPD Model</label></th>
			<td><input id="bsa_pro_trans_form_right_cpd_name" name="form_right_cpd_name" value="<?php validValue('form_right_cpd_name'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_right_clicks">"clicks"</label></th>
			<td><input id="bsa_pro_trans_form_right_clicks" name="form_right_clicks" value="<?php validValue('form_right_clicks'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_right_views">"views"</label></th>
			<td><input id="bsa_pro_trans_form_right_views" name="form_right_views" value="<?php validValue('form_right_views'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_form_right_days">"days"</label></th>
			<td><input id="bsa_pro_trans_form_right_days" name="form_right_days" value="<?php validValue('form_right_days'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr class="bsaBottomLine">
			<th scope="row"><label for="bsa_pro_trans_form_live_preview">Live Preview</label></th>
			<td><input id="bsa_pro_trans_form_live_preview" name="form_live_preview" value="<?php validValue('form_live_preview'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th class="bsaLast" scope="row"><label for="bsa_pro_trans_form_right_button_pay">Payment Button</label></th>
			<td class="bsaLast"><input id="bsa_pro_trans_form_right_button_pay" name="form_right_button_pay" value="<?php validValue('form_right_button_pay'); ?>" type="text" class="regular-text"></td>
		</tr>
		</tbody>
		<tbody id="bsaTabPayments" class="bsaTabPayments bsaTbody" style="display:none">
		<tr>
			<th colspan="2">
				<h3><span class="dashicons dashicons-cart"></span> Payments</h3>
			</th>
		</tr>
		<tr>
			<th scope="row"><label for="payment_paid">"This ad has been paid."</label></th>
			<td><input id="payment_paid" name="payment_paid" value="<?php validValue('payment_paid'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="payment_select">"Select a payment method"</label></th>
			<td><input id="payment_select" name="payment_select" value="<?php validValue('payment_select'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="payment_return">"return to the order form"</label></th>
			<td><input id="payment_return" name="payment_return" value="<?php validValue('payment_return'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="payment_stripe_title">"Pay via Stripe"</label></th>
			<td><input id="payment_stripe_title" name="payment_stripe_title" value="<?php validValue('payment_stripe_title'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="payment_paypal_title">"Pay via PayPal"</label></th>
			<td><input id="payment_paypal_title" name="payment_paypal_title" value="<?php validValue('payment_paypal_title'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th class="bsaLast" scope="row"><label for="payment_bank_transfer_title">"Pay via Bank Transfer"</label></th>
			<td class="bsaLast"><input id="payment_bank_transfer_title" name="payment_bank_transfer_title" value="<?php validValue('payment_bank_transfer_title'); ?>" type="text" class="regular-text"></td>
		</tr>
		</tbody>
		<tbody id="bsaTabAlerts" class="bsaTabAlerts bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-testimonial"></span> Alerts</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_alert_success">Alert header "Success!"</label></th>
				<td><input id="bsa_pro_trans_alert_success" name="alert_success" value="<?php validValue('alert_success'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_form_success">Message if "Correctly added"</label></th>
				<td><input id="bsa_pro_trans_form_success" name="form_success" value="<?php validValue('form_success'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr class="bsaBottomLine">
				<th scope="row"><label for="bsa_pro_trans_payment_success">Message if "Payment success"</label></th>
				<td><input id="bsa_pro_trans_payment_success" name="payment_success" value="<?php validValue('payment_success'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_alert_failed">Alert header "Error!"</label></th>
				<td><input id="bsa_pro_trans_alert_failed" name="alert_failed" value="<?php validValue('alert_failed'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_form_invalid_params">Message if "Invalid payment params"</label></th>
				<td><input id="bsa_pro_trans_form_invalid_params" name="form_invalid_params" value="<?php validValue('form_invalid_params'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_form_too_high">Message if "Image too large"</label></th>
				<td><input id="bsa_pro_trans_form_too_high" name="form_too_high" value="<?php validValue('form_too_high'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_form_img_invalid">Message if "Invalid img file"</label></th>
				<td><input id="bsa_pro_trans_form_img_invalid" name="form_img_invalid" value="<?php validValue('form_img_invalid'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_form_empty">Message if "Form empty"</label></th>
				<td><input id="bsa_pro_trans_form_empty" name="form_empty" value="<?php validValue('form_empty'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row"><label for="bsa_pro_trans_payment_failed">Message if "Payment failed"</label></th>
				<td class="bsaLast"><input id="bsa_pro_trans_payment_failed" name="payment_failed" value="<?php validValue('payment_failed'); ?>" type="text" class="regular-text"></td>
			</tr>
		</tbody>
		<tbody id="bsaTabStats" class="bsaTabStats bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-chart-area"></span> Statistics</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_stats_header">"Statistics"</label></th>
				<td><input id="bsa_pro_trans_stats_header" name="stats_header" value="<?php validValue('stats_header'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_stats_views">"Views"</label></th>
				<td><input id="bsa_pro_trans_stats_views" name="stats_views" value="<?php validValue('stats_views'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_stats_clicks">"Clicks"</label></th>
				<td><input id="bsa_pro_trans_stats_clicks" name="stats_clicks" value="<?php validValue('stats_clicks'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_stats_ctr">"CTR"</label></th>
				<td><input id="bsa_pro_trans_stats_ctr" name="stats_ctr" value="<?php validValue('stats_ctr'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_stats_prev_week">"previous week"</label></th>
				<td><input id="bsa_pro_trans_stats_prev_week" name="stats_prev_week" value="<?php validValue('stats_prev_week'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row"><label for="bsa_pro_trans_stats_next_week">"next week"</label></th>
				<td class="bsaLast"><input id="bsa_pro_trans_stats_next_week" name="stats_next_week" value="<?php validValue('stats_next_week'); ?>" type="text" class="regular-text"></td>
			</tr>
		</tbody>
		<tbody id="bsaTabSample" class="bsaTabSample bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-exerpt-view"></span> Sample Ad Content</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_example_title">Example of the Title</label></th>
				<td><input id="bsa_pro_trans_example_title" name="example_title" value="<?php validValue('example_title'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_example_desc">Example of the Description</label></th>
				<td><input id="bsa_pro_trans_example_desc" name="example_desc" value="<?php validValue('example_desc'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row"><label for="bsa_pro_trans_example_url">Example of the URL</label></th>
				<td class="bsaLast"><input id="bsa_pro_trans_example_url" name="example_url" value="<?php validValue('example_url'); ?>" type="text" class="regular-text"></td>
			</tr>
		</tbody>
		<tbody id="bsaTabEmails" class="bsaTabEmails bsaTbody" style="display:none">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-email-alt"></span> E-mails</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_email_sender">Sender Name</label></th>
				<td><input id="bsa_pro_trans_email_sender" name="email_sender" value="<?php validValue('email_sender'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_email_address">Sender E-mail</label></th>
				<td><input id="bsa_pro_trans_email_address" name="email_address" value="<?php validValue('email_address'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-email-alt"></span> Buyer message, after payment</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_buyer_subject">Subject</label></th>
				<td><input id="bsa_pro_trans_buyer_subject" name="buyer_subject" value="<?php validValue('buyer_subject'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row"><label for="bsa_pro_trans_buyer_message">Message</label></th>
				<td class="bsaLast">
					<p class="description">Use the message variable <strong>[STATS_URL]</strong> to display url statistics.</p>
					<textarea id="bsa_pro_trans_buyer_message" name="buyer_message" class="regular-text" rows="11" cols="47"><?php validValue('buyer_message'); ?></textarea>
				</td>
			</tr>
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-email-alt"></span> Seller message, after the sale of Ad</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_trans_seller_subject">Subject</label></th>
				<td><input id="bsa_pro_trans_seller_subject" name="seller_subject" value="<?php validValue('seller_subject'); ?>" type="text" class="regular-text"></td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row"><label for="bsa_pro_trans_seller_message">Message</label></th>
				<td class="bsaLast">
					<p class="description">Use the message variable <strong>[STATS_URL]</strong> to display url statistics.</p>
					<textarea id="bsa_pro_trans_seller_message" name="seller_message" class="regular-text" rows="11" cols="47"><?php validValue('seller_message'); ?></textarea>
				</td>
			</tr>
		</tbody>
		<tbody id="bsaTabOthers" class="bsaTabOthers bsaTbody" style="display:none">
		<tr>
			<th colspan="2">
				<h3><span class="dashicons dashicons-format-status"></span> Others</h3>
			</th>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_free_ads">"free ads:"</label></th>
			<td><input id="bsa_pro_trans_free_ads" name="free_ads" value="<?php validValue('free_ads'); ?>" type="text" class="regular-text"></td>
		</tr>
		</tbody>
		<tbody id="bsaTabAffiliate" class="bsaTabAffiliateProgram bsaTbody" style="display:none">
		<tr>
			<th colspan="2">
				<h3><span class="dashicons dashicons-editor-spellcheck"></span> Affiliate Program (<a href="http://codecanyon.net/user/scripteo?ref=scripteo">Affiliate Program Add-on</a>)</h3>
			</th>
		</tr>
		<tr>
			<th scope="row"><label for="ap_commission">"commission:"</label></th>
			<td><input id="ap_commission" name="ap_commission" value="<?php echo bsa_get_trans('affiliate_program', 'commission'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_each_sale">"for each sale"</label></th>
			<td><input id="ap_each_sale" name="ap_each_sale" value="<?php echo bsa_get_trans('affiliate_program', 'each_sale'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_balance">"balance:"</label></th>
			<td><input id="ap_balance" name="ap_balance" value="<?php echo bsa_get_trans('affiliate_program', 'balance'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_make">"make a withdrawal"</label></th>
			<td><input id="ap_make" name="ap_make" value="<?php echo bsa_get_trans('affiliate_program', 'make'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_ref_link">"Your Referral Link"</label></th>
			<td><input id="ap_ref_link" name="ap_ref_link" value="<?php echo bsa_get_trans('affiliate_program', 'ref_link'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_ref_notice">"Please login to see your referral link."</label></th>
			<td><input id="ap_ref_notice" name="ap_ref_notice" value="<?php echo bsa_get_trans('affiliate_program', 'ref_notice'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_ref_users">"Referred Users"</label></th>
			<td><input id="ap_ref_users" name="ap_ref_users" value="<?php echo bsa_get_trans('affiliate_program', 'ref_users'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_date">"Date"</label></th>
			<td><input id="ap_date" name="ap_date" value="<?php echo bsa_get_trans('affiliate_program', 'date'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_buyer">"Buyer"</label></th>
			<td><input id="ap_buyer" name="ap_buyer" value="<?php echo bsa_get_trans('affiliate_program', 'buyer'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_order">"Order Amount"</label></th>
			<td><input id="ap_order" name="ap_order" value="<?php echo bsa_get_trans('affiliate_program', 'order'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_comm_rate">"Commission Rate"</label></th>
			<td><input id="ap_comm_rate" name="ap_comm_rate" value="<?php echo bsa_get_trans('affiliate_program', 'comm_rate'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_your_comm">"Your Commission"</label></th>
			<td><input id="ap_your_comm" name="ap_your_comm" value="<?php echo bsa_get_trans('affiliate_program', 'your_comm'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_empty">"List empty."</label></th>
			<td><input id="ap_empty" name="ap_empty" value="<?php echo bsa_get_trans('affiliate_program', 'empty'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_affiliate">"Affiliate Program"</label></th>
			<td><input id="ap_affiliate" name="ap_affiliate" value="<?php echo bsa_get_trans('affiliate_program', 'affiliate'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_earnings">"Earnings to Withdrawal"</label></th>
			<td><input id="ap_earnings" name="ap_earnings" value="<?php echo bsa_get_trans('affiliate_program', 'earnings'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_payment">"PayPal E-mail"</label></th>
			<td><input id="ap_payment" name="ap_payment" value="<?php echo bsa_get_trans('affiliate_program', 'payment'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_button">"Submit Request"</label></th>
			<td><input id="ap_button" name="ap_button" value="<?php echo bsa_get_trans('affiliate_program', 'button'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_id">"ID"</label></th>
			<td><input id="ap_id" name="ap_id" value="<?php echo bsa_get_trans('affiliate_program', 'id'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_user_id">"User ID"</label></th>
			<td><input id="ap_user_id" name="ap_user_id" value="<?php echo bsa_get_trans('affiliate_program', 'user_id'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_amount">"Amount"</label></th>
			<td><input id="ap_amount" name="ap_amount" value="<?php echo bsa_get_trans('affiliate_program', 'amount'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_account">"Payment Account"</label></th>
			<td><input id="ap_account" name="ap_account" value="<?php echo bsa_get_trans('affiliate_program', 'account'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_status">"Status"</label></th>
			<td><input id="ap_status" name="ap_status" value="<?php echo bsa_get_trans('affiliate_program', 'status'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_pending">"pending"</label></th>
			<td><input id="ap_pending" name="ap_pending" value="<?php echo bsa_get_trans('affiliate_program', 'pending'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_done">"done"</label></th>
			<td><input id="ap_done" name="ap_done" value="<?php echo bsa_get_trans('affiliate_program', 'done'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_rejected">"rejected"</label></th>
			<td><input id="ap_rejected" name="ap_rejected" value="<?php echo bsa_get_trans('affiliate_program', 'rejected'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_withdrawals">"Withdrawals"</label></th>
			<td><input id="ap_withdrawals" name="ap_withdrawals" value="<?php echo bsa_get_trans('affiliate_program', 'withdrawals'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="ap_success">Success Status</label></th>
			<td><input id="ap_success" name="ap_success" value="<?php echo bsa_get_trans('affiliate_program', 'success'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th class="bsaLast" scope="row"><label for="ap_failed">Failed Status</label></th>
			<td class="bsaLast"><input id="ap_failed" name="ap_failed" value="<?php echo bsa_get_trans('affiliate_program', 'failed'); ?>" type="text" class="regular-text"></td>
		</tr>
		</tbody>
		<tbody id="bsaTabMarketingAgency" class="bsaTabMarketingAgency bsaTbody" style="display:none">
		<tr>
			<th colspan="2">
				<h3><span class="dashicons dashicons-editor-spellcheck"></span> Marketing Agency (<a href="http://codecanyon.net/item/ads-pro-1-wordpress-marketing-agency-addon/10665901?ref=scripteo">Marketing Agency Add-on</a>)</h3>
			</th>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_agency_title_form">Marketing Agency Title Form</label></th>
			<td><input id="bsa_pro_trans_agency_title_form" name="agency_title_form" value="<?php validValue('agency_title_form'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr class="bsaBottomLine">
			<th scope="row"><label for="bsa_pro_trans_agency_back_button">Back Button</label></th>
			<td><input id="bsa_pro_trans_agency_back_button" name="agency_back_button" value="<?php validValue('agency_back_button'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th scope="row"><label for="bsa_pro_trans_agency_visit_site">"Visit Site"</label></th>
			<td><input id="bsa_pro_trans_agency_visit_site" name="agency_visit_site" value="<?php validValue('agency_visit_site'); ?>" type="text" class="regular-text"></td>
		</tr>
		<tr>
			<th class="bsaLast" scope="row"><label for="bsa_pro_trans_agency_buy_ad">"Buy Ad"</label></th>
			<td class="bsaLast"><input id="bsa_pro_trans_agency_buy_ad" name="agency_buy_ad" value="<?php validValue('agency_buy_ad'); ?>" type="text" class="regular-text"></td>
		</tr>
		</tbody>
		<?php do_action( 'bsa-pro-translation-view' ); ?>
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