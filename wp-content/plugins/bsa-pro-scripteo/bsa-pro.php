<?php

/*
Plugin Name: ADS PRO – Multi-Purpose WordPress Ad Manager
Plugin URI: http://bsapro.scripteo.info
Description: Premium Multi-Purpose WordPress Ad Plugin, Create Incredible Good Ad Spaces!
Author: Scripteo
Author URI: http://codecanyon.net/user/scripteo
Version: 2.9.0
License: GPL2
*/

// Require files
require_once(plugin_dir_path( __FILE__ ).'lib/countries.php');
require_once(plugin_dir_path( __FILE__ ).'lib/functions.php');
require_once(plugin_dir_path( __FILE__ ).'lib/ajax-functions.php');
require_once(plugin_dir_path( __FILE__ ).'lib/BSA_PRO_Model.php');
require_once(plugin_dir_path( __FILE__ ).'frontend/crop.php');
require_once(plugin_dir_path( __FILE__ ).'admin/menu.php');
require_once(plugin_dir_path( __FILE__ ).'admin-ma/menu.php'); // MA
require_once(plugin_dir_path( __FILE__ ).'lib/MobileDetect/Mobile_Detect.php');

class BuySellAdsPro
{
	private $plugin_id = 'bsa_pro_plugin';
	private $plugin_version = '2.9.0';
	private $model;

	function __construct() {
		$this->model = new BSA_PRO_Model();
		register_activation_hook(__FILE__, array($this, 'onActivate'));
		register_uninstall_hook(__FILE__, array('BuySellAdsPro', 'onUninstall'));
	}

	static function onUninstall()
	{
		$ver_opt = 'bsa_pro_plugin'.'_version';

		if ( get_option('bsa_pro_plugin_'.'installation') == 'yes' ) {
			$model = new BSA_PRO_Model();
			$model->dropTable();

			// Reset dashboard statistics
			delete_option($ver_opt.'_dashboard_clicks');
			delete_option($ver_opt.'_dashboard_views');
		}

		// Stop CRON - views counter
		wp_clear_scheduled_hook( 'bsa_cron_views_stats' );

		// Delete version number
		delete_option($ver_opt);
	}

	function onActivate()
	{
		$opt = 'bsa_pro_plugin';
		$opt_trans = $opt.'_trans';
		$ver_opt = $opt.'_version';
		$installed_version = get_option($ver_opt);

		// Create / upgrade database
		$this->model->createDbTables();

		if($installed_version == NULL) {

			// Update Plugin Version
			update_option($ver_opt, $this->plugin_version);

			// Re-create Custom Ad Templates
			bsaCreateCustomAdTemplates();

			// Start CRON - views counter
			wp_schedule_single_event( time() + (1 * 60 * 60), 'bsa_cron_views_stats', array( time() ) );

			if ( get_option($opt.'_installation') == 'yes' || get_option($opt.'_installation') == NULL ) {
				// stats counters
				update_option($opt.'_dashboard_clicks', 0);
				update_option($opt.'_dashboard_views', 0);

				// Settings
				// plugin settings
				update_option($opt.'_purchase_code', '2b35dec6-5674-314f-5d8d-9fe900dc03b8');
				update_option($opt.'_paypal', 'example_paypal@gmail.com');
				update_option($opt_trans.'_payment_bank_transfer_content', 'Your Name or Company

Bank Number: GB00NWBK000000000000000');
				update_option($opt.'_ordering_form_url', 'http://example.com/ordering_form');
				update_option($opt.'_currency_code', 'USD');
				update_option($opt.'_currency_symbol', '$');
				update_option($opt.'_symbol_position', 'before');
				update_option($opt.'_auto_accept', 'yes');
				update_option($opt.'_calendar', 'no');
				// installation settings
				update_option($opt.'_installation', 'no');
				// hooks settings
				update_option($opt.'_before_hook', '');
				update_option($opt.'_after_1_paragraph', '');
				update_option($opt.'_after_2_paragraph', '');
				update_option($opt.'_after_3_paragraph', '');
				update_option($opt.'_after_4_paragraph', '');
				update_option($opt.'_after_5_paragraph', '');
				update_option($opt.'_after_6_paragraph', '');
				update_option($opt.'_after_7_paragraph', '');
				update_option($opt.'_after_hook', '');
				// admin panel settings
				update_option($opt.'_rtl_support', 'no');
				update_option($opt.'_html_preview', 'no');
				update_option($opt.'_hide_if_logged', 'no');
				update_option($opt.'_link_bar', 'no');
				// marketing agency
				update_option($opt.'_private_ma', 'no');
				update_option($opt.'_agency_api_url', 'http://example.com/api');
				update_option($opt.'_agency_ordering_form_url', 'http://example.com/agency_ordering_form');
				update_option($opt.'_agency_commission', 30); // Default Agency Commission set on 30%
				update_option($opt.'_agency_auto_accept', 'yes'); // Default Auto-Accept set on 'yes'
				update_option($opt.'_agency_minimum_withdrawal', 50); // Default minimum amount to withdrawal set on $50
				update_option($opt.'_agency_other_sites', 'no'); // Allows displaying Ads for other sites (non-wordpress)
				// affiliate program
				update_option($opt.'_ap_cookie_lifetime', 30); // Default cookie lifetime set on 30 days
				update_option($opt.'_ap_commission', 10); // Default Affiliate Program Commission set on 10%
				update_option($opt.'_ap_minimum_withdrawal', 50); // Default minimum amount to withdrawal set on $50
				// thumbnail settings
				update_option($opt.'_thumb_size', 256);
				update_option($opt.'_thumb_w', 1024);
				update_option($opt.'_thumb_h', 800);
				// length of inputs
				update_option($opt.'_max_title', 40);
				update_option($opt.'_max_desc', 80);
				// form customization
				update_option($opt.'_form_bg', '');
				update_option($opt.'_form_c', '');
				update_option($opt.'_form_input_bg', '');
				update_option($opt.'_form_input_c', '');
				update_option($opt.'_form_price_c', '');
				update_option($opt.'_form_discount_bg', '');
				update_option($opt.'_form_discount_c', '');
				update_option($opt.'_form_button_bg', '');
				update_option($opt.'_form_button_c', '');
				update_option($opt.'_form_alert_c', '');
				update_option($opt.'_form_alert_success_bg', '');
				update_option($opt.'_form_alert_failed_bg', '');
				update_option($opt.'_stats_views_line', '#673AB7');
				update_option($opt.'_stats_clicks_line', '#FBCD39');
				update_option($opt.'_custom_css', '');
				update_option($opt.'_custom_js', '');
				update_option($opt.'_advanced_calendar', '
firstDay: 0,
closeText: "Done",
prevText: "Prev",
nextText: "Next",
currentText: "Today",
monthNames: [ "January","February","March","April","May","June","July","August","September","October","November","December" ],
monthNamesShort: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ],
dayNames: [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ],
dayNamesShort: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
dayNamesMin: [ "Su","Mo","Tu","We","Th","Fr","Sa" ],
weekHeader: "Wk",');
				// affiliate program customization
				update_option($opt.'_ap_custom', array(
					'general_bg' 		=> '',
					'general_color' 	=> '',
					'commission_bg' 	=> '',
					'commission_color' 	=> '',
					'balance_bg' 		=> '',
					'balance_color' 	=> '',
					'link_color' 		=> '',
					'ref_bg' 			=> '',
					'ref_color' 		=> '',
					'table_bg' 			=> '',
					'table_color' 		=> ''
				));

				// Translations
				// agency ordering form
				update_option($opt_trans.'_agency_title_form', 'Choose the website, where do you want to buy Ad');
				update_option($opt_trans.'_agency_back_button', 'back to the full list of websites');
				update_option($opt_trans.'_agency_visit_site', 'Visit Site');
				update_option($opt_trans.'_agency_buy_ad', 'Buy Ad');
				// payments
				update_option($opt_trans.'_payment_paid', 'This ad has been paid.');
				update_option($opt_trans.'_payment_select', 'Select a payment method');
				update_option($opt_trans.'_payment_return', 'return to the order form');
				update_option($opt_trans.'_payment_stripe_title', 'Pay via Stripe');
				update_option($opt_trans.'_payment_paypal_title', 'Pay via PayPal');
				update_option($opt_trans.'_payment_bank_transfer_title', 'Pay via Bank Transfer');
				// form left
				update_option($opt_trans.'_form_left_header', 'Create new ad');
				update_option($opt_trans.'_form_left_select_space', 'Where do you want to show your ad?');
				update_option($opt_trans.'_form_left_email', 'Your email');
				update_option($opt_trans.'_form_left_eg_email', 'example@gmail.com');
				update_option($opt_trans.'_form_left_title', 'Ad title');
				update_option($opt_trans.'_form_left_eg_title', 'Example title');
				update_option($opt_trans.'_form_left_desc', 'Ad description');
				update_option($opt_trans.'_form_left_eg_desc', 'Example description');
				update_option($opt_trans.'_form_left_url', 'Ad URL');
				update_option($opt_trans.'_form_left_eg_url', 'http://example.com');
				update_option($opt_trans.'_form_left_thumb', 'Thumbnail: png, jpg, gif');
				update_option($opt_trans.'_form_left_calendar', 'When you want to start displaying ad?');
				update_option($opt_trans.'_form_left_eg_calendar', 'select date');
				// form right
				update_option($opt_trans.'_form_right_header', 'Choose Billing model and Limit display');
				update_option($opt_trans.'_form_right_cpc_name', 'Cost per Click (CPC)');
				update_option($opt_trans.'_form_right_cpm_name', 'Cost per Views (CPM)');
				update_option($opt_trans.'_form_right_cpd_name', 'Cost per Day (CPD)');
				update_option($opt_trans.'_form_right_clicks', 'clicks');
				update_option($opt_trans.'_form_right_views', 'views');
				update_option($opt_trans.'_form_right_days', 'days');
				update_option($opt_trans.'_form_live_preview', 'Your ad will look like below');
				update_option($opt_trans.'_form_right_button_pay', 'Pay now!');
				// alerts
				// success
				update_option($opt_trans.'_alert_success', 'Success!');
				update_option($opt_trans.'_form_success', 'Advertising has been correctly added! Now you will be redirect to payment module.');
				update_option($opt_trans.'_payment_success', 'Congrats! Correctly payment.');
				// failed
				update_option($opt_trans.'_alert_failed', 'Error!');
				update_option($opt_trans.'_form_invalid_params', 'Invalid params for payment!');
				update_option($opt_trans.'_form_too_high', 'Image too high! (maximum file size: 1024x800px & 256kb)');
				update_option($opt_trans.'_form_img_invalid', 'Image invalid!');
				update_option($opt_trans.'_form_empty', 'All fields required!');
				update_option($opt_trans.'_payment_failed', 'Payment failed. Please try again.');
				// stats section
				update_option($opt_trans.'_stats_header', 'Statistics');
				update_option($opt_trans.'_stats_views', 'Views');
				update_option($opt_trans.'_stats_clicks', 'Clicks');
				update_option($opt_trans.'_stats_ctr', 'CTR');
				update_option($opt_trans.'_stats_prev_week', 'previous week');
				update_option($opt_trans.'_stats_next_week', 'next week');
				// others
				update_option($opt_trans.'_free_ads', 'free ads:');
				// example ad
				update_option($opt_trans.'_example_title', 'Example of the Title');
				update_option($opt_trans.'_example_desc', 'Example description. Lorem Ipsum is simply dummy text of the printing and type..');
				update_option($opt_trans.'_example_url', 'http://example.com');
				// confirmation email
				update_option($opt_trans.'_email_sender', 'Sender name');
				update_option($opt_trans.'_email_address', 'example@example.com');
				update_option($opt_trans.'_buyer_subject', 'Advertising was correctly added!');
				update_option($opt_trans.'_buyer_message', 'Congrats! Your advertise is live!

You can follow statistics by url:
[STATS_URL]

Regards,
Your Signature
');
				update_option($opt_trans.'_seller_subject', 'Advertising was sold on your page!');
				update_option($opt_trans.'_seller_message', 'Congrats! Your ad has been sold!

Click <a href="'.get_site_url().'">here</a> to confirm or deny pending advertising.

Regards,
Your Signature
');
				// affiliate program trans
				update_option($opt_trans.'_affiliate_program', array(
					'commission' 		=> 'commission:',
					'each_sale' 		=> 'for each sale',
					'balance' 			=> 'balance:',
					'make' 				=> 'make a withdrawal',
					'ref_link' 			=> 'Your Referral Link',
					'ref_notice' 		=> 'Please login to see your referral link.',
					'ref_users' 		=> 'Referred Users',
					'date' 				=> 'Date',
					'buyer' 			=> 'Buyer',
					'order' 			=> 'Order Amount',
					'comm_rate' 		=> 'Commission Rate',
					'your_comm' 		=> 'Your Commission',
					'empty' 			=> 'List empty.',
					'affiliate' 		=> 'Affiliate Program',
					'earnings' 			=> 'Earnings to Withdrawal',
					'payment' 			=> 'PayPal E-mail',
					'button' 			=> 'Submit Request',
					'id' 				=> 'ID',
					'user_id' 			=> 'User ID',
					'amount' 			=> 'Amount',
					'account' 			=> 'Payment Account',
					'status' 			=> 'Status',
					'pending' 			=> 'pending',
					'done' 				=> 'done',
					'rejected' 			=> 'rejected',
					'withdrawals' 		=> 'Withdrawals',
					'success' 			=> 'Done. Payment request has been sent.',
					'failed' 			=> "Error. Currently you can't make a withdrawal (minimum amount $50). Try again later."
				));
			}

		} else {

			switch(version_compare($installed_version, $this->plugin_version)) {

				case 0;
					// if installed plugin is the same
//					update_option($ver_opt, $this->plugin_version);
					break;

				case 1;
					// if installed plugin is newer
					update_option($ver_opt, $this->plugin_version);
					break;

				case -1;
					// if installed plugin is older
					update_option($ver_opt, $this->plugin_version);

					// update options if empty
					if ( get_option($opt_trans.'_affiliate_program') == null ) {
						// affiliate program
						update_option($opt.'_ap_cookie_lifetime', 30); // Default cookie lifetime set on 30 days
						update_option($opt.'_ap_commission', 10); // Default Affiliate Program Commission set on 10%
						update_option($opt.'_ap_minimum_withdrawal', 50); // Default minimum amount to withdrawal set on $50
						// affiliate program trans
						update_option($opt_trans.'_affiliate_program', array(
							'commission' 		=> 'commission:',
							'each_sale' 		=> 'for each sale',
							'balance' 			=> 'balance:',
							'make' 				=> 'make a withdrawal',
							'ref_link' 			=> 'Your Referral Link',
							'ref_notice' 		=> 'Please login to see your referral link.',
							'ref_users' 		=> 'Referred Users',
							'date' 				=> 'Date',
							'buyer' 			=> 'Buyer',
							'order' 			=> 'Order Amount',
							'comm_rate' 		=> 'Commission Rate',
							'your_comm' 		=> 'Your Commission',
							'empty' 			=> 'List empty.',
							'affiliate' 		=> 'Affiliate Program',
							'earnings' 			=> 'Earnings to Withdrawal',
							'payment' 			=> 'PayPal E-mail',
							'button' 			=> 'Submit Request',
							'id' 				=> 'ID',
							'user_id' 			=> 'User ID',
							'amount' 			=> 'Amount',
							'account' 			=> 'Payment Account',
							'status' 			=> 'Status',
							'pending' 			=> 'pending',
							'done' 				=> 'done',
							'rejected' 			=> 'rejected',
							'withdrawals' 		=> 'Withdrawals',
							'success' 			=> 'Done. Payment request has been sent.',
							'failed' 			=> "Error. Currently you can't make a withdrawal (minimum amount $50). Try again later."
						));
					}

					break;
			}
		}
	}
}

function BSA_PRO_add_stylesheet_and_script()
{
	$rtl = (get_option('bsa_pro_plugin_rtl_support') == 'yes') ? 'rtl-' : null;
	wp_register_style('buy_sell_ads_pro_main_stylesheet', plugins_url('frontend/css/asset/'.$rtl.'style.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_main_stylesheet');
//	$get_templates = array_diff( scandir(plugin_dir_path( __FILE__ )."frontend/template/"), Array( ".", ".." ) );
//	foreach ( $get_templates as $template ) {
//		if ( strpos($template,'block-') !== false ) {
//			wp_register_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet', plugins_url('frontend/css/'.str_replace('.php','',$template).'.css', __FILE__));
//			wp_enqueue_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet');
//		} else {
//			wp_register_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet', plugins_url('frontend/css/'.$rtl.str_replace('.php','',$template).'.css', __FILE__));
//			wp_enqueue_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet');
//		}
//	}
	if ( $rtl == 'rtl-' ) {
		wp_register_style('buy_sell_ads_pro_rtl_template_stylesheet', plugins_url('frontend/css/rtl-template.css.php', __FILE__));
		wp_enqueue_style('buy_sell_ads_pro_rtl_template_stylesheet');
	} else {
		wp_register_style('buy_sell_ads_pro_template_stylesheet', plugins_url('frontend/css/template.css.php', __FILE__));
		wp_enqueue_style('buy_sell_ads_pro_template_stylesheet');
	}
	wp_register_style('buy_sell_ads_pro_materialize_stylesheet', plugins_url('frontend/css/asset/material-design.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_materialize_stylesheet');
	wp_register_style('buy_sell_ads_pro_animate_stylesheet', plugins_url('frontend/css/asset/animate.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_animate_stylesheet');
	wp_register_style('buy_sell_ads_pro_chart_stylesheet', plugins_url('frontend/css/asset/chart.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_chart_stylesheet');
	wp_register_style('buy_sell_ads_pro_owl_carousel_stylesheet', plugins_url('frontend/css/asset/owl.carousel.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_owl_carousel_stylesheet');
	wp_register_script('buy_sell_ads_pro_js_script', plugins_url('frontend/js/script.js', __FILE__), array('jquery','media-upload','thickbox'));
	wp_enqueue_script('buy_sell_ads_pro_js_script');
	wp_register_script('buy_sell_ads_pro_viewport_checker_js_script', plugins_url('frontend/js/jquery.viewportchecker.js', __FILE__), array('jquery','media-upload','thickbox'));
	wp_enqueue_script('buy_sell_ads_pro_viewport_checker_js_script');
	wp_register_script('buy_sell_ads_pro_chart_js_script', plugins_url('frontend/js/chart.js', __FILE__), array('jquery','media-upload','thickbox'));
	wp_enqueue_script('buy_sell_ads_pro_chart_js_script');
	wp_register_script('buy_sell_ads_pro_owl_carousel_js_script', plugins_url('frontend/js/owl.carousel.js', __FILE__), array('jquery','media-upload','thickbox'));
	wp_enqueue_script('buy_sell_ads_pro_owl_carousel_js_script');
	wp_register_script('buy_sell_ads_pro_simply_scroll_js_script', plugins_url('frontend/js/jquery.simplyscroll.js', __FILE__), array('jquery','media-upload','thickbox'));
	wp_enqueue_script('buy_sell_ads_pro_simply_scroll_js_script');
	if (get_option('bsa_pro_plugin_secret_key') !== '' && get_option('bsa_pro_plugin_publishable_key') !== '') {
		wp_register_script('buy_sell_ads_pro_stripe_js_script', 'https://js.stripe.com/v2/', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('buy_sell_ads_pro_stripe_js_script');
	}
	if ( file_exists(plugin_dir_path( __FILE__ ).'frontend/js/custom.js') ) {
		wp_register_script('buy_sell_ads_pro_custom_js', plugins_url('frontend/js/custom.js', __FILE__), array('jquery','media-upload','thickbox'));
		wp_enqueue_script('buy_sell_ads_pro_custom_js');
	}
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );
	wp_register_style('jquery-ui', plugins_url('frontend/css/asset/ui-datapicker.css', __FILE__));
	wp_enqueue_style( 'jquery-ui' );
}
add_action('wp_enqueue_scripts', 'BSA_PRO_add_stylesheet_and_script');

function BSA_PRO_add_admin_stylesheet_and_script() {
	$rtl = (get_option('bsa_pro_plugin_rtl_support') == 'yes') ? 'rtl-' : null;
//	$get_templates = array_diff( scandir(plugin_dir_path( __FILE__ )."frontend/template/"), Array( ".", ".." ) );
//	foreach ( $get_templates as $template ) {
//		if ( strpos($template,'block-') !== false ) {
//			wp_register_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet', plugins_url('frontend/css/'.str_replace('.php','',$template).'.css', __FILE__));
//			wp_enqueue_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet');
//		} else {
//			wp_register_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet', plugins_url('frontend/css/'.$rtl.str_replace('.php','',$template).'.css', __FILE__));
//			wp_enqueue_style('buy_sell_ads_pro_'.str_replace('.php','',$template).'_stylesheet');
//		}
//	}
	if ( $rtl == 'rtl-' ) {
		wp_register_style('buy_sell_ads_pro_rtl_template_stylesheet', plugins_url('frontend/css/rtl-template.css.php', __FILE__));
		wp_enqueue_style('buy_sell_ads_pro_rtl_template_stylesheet');
	} else {
		wp_register_style('buy_sell_ads_pro_template_stylesheet', plugins_url('frontend/css/template.css.php', __FILE__));
		wp_enqueue_style('buy_sell_ads_pro_template_stylesheet');
	}
	wp_register_style('buy_sell_ads_pro_admin_materialize_stylesheet', plugins_url('frontend/css/asset/material-design.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_admin_materialize_stylesheet');
	wp_register_style('buy_sell_ads_pro_admin_stylesheet', plugins_url('frontend/css/asset/'.$rtl.'admin.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_admin_stylesheet');
	wp_register_style('buy_sell_ads_pro_admin_animate_stylesheet', plugins_url('frontend/css/asset/animate.css', __FILE__));
	wp_enqueue_style('buy_sell_ads_pro_admin_animate_stylesheet');
	wp_register_script('buy_sell_ads_pro_admin_js_script', plugins_url('frontend/js/admin-script.js', __FILE__));
	wp_enqueue_script('buy_sell_ads_pro_admin_js_script');
	wp_register_script('buy_sell_ads_pro_admin_jquery_ui_js_script', plugins_url('frontend/js/jquery-ui.js', __FILE__));
	wp_enqueue_script('buy_sell_ads_pro_admin_jquery_ui_js_script');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );
	wp_register_style('jquery-ui', plugins_url('frontend/css/asset/ui-datapicker.css', __FILE__));
	wp_enqueue_style( 'jquery-ui' );
}
add_action( 'admin_enqueue_scripts', 'BSA_PRO_add_admin_stylesheet_and_script' );

function bsaProGetOpt($name, $type) {
	$get_opt = 'bsa_pro_plugin_';
	$get_color = get_option($get_opt.$name);
	if ( $get_color ) {
		if ( $type == 'bg' ) {
			return 'background-color: '.$get_color.' !important;';
		} elseif ( $type == 'c' ) {
			return 'color: '.$get_color.' !important;';
		} elseif ( $type == 's' ) {
			return 'stroke: '.$get_color.' !important;';
		} elseif ( $type == 'a' ) {
			if ( $get_color ) {
				return 'color: '.$get_color.' !important;';
			} else {
				return 'color: inherit;';
			}
		} elseif ( $type == 'a:h' ) {
			if ( $get_color ) {
				return 'color: '.$get_color.' !important;';
			} else {
				return 'color: inherit;';
			}
		} elseif ( $type == 'bc' ) {
			return 'border-color: '.$get_color.' !important;';
		}
	} else {
		return NULL;
	}
}

function BSA_PRO_add_custom_stylesheet()
{
echo "<style>
	/* Custom BSA_PRO Styles */

	/* fonts */
";
	$model = new BSA_PRO_Model();
	if ( $model->getSpaces('active') ) {
		foreach ( $model->getSpaces('active') as $space ) {
			if ( $space["font"] != '' && $space["font_url"] != '' ) {
				echo $space["font_url"];
				echo ".bsaProContainer.bsa-".$space["template"]. "{
				".$space["font"]."
			}";
			}
		}
	}
	echo "
	/* form */
	.bsaProOrderingForm { ".bsaProGetOpt('form_bg', 'bg')." ".bsaProGetOpt('form_c', 'c')." }
	.bsaProInput input,
	.bsaProInput input[type='file'],
	.bsaProSelectSpace select,
	.bsaProInputsRight .bsaInputInner,
	.bsaProInputsRight .bsaInputInner label { ".bsaProGetOpt('form_input_bg', 'bg')." ".bsaProGetOpt('form_input_c', 'c')." }
	.bsaProPrice  { ".bsaProGetOpt('form_price_c', 'c')." }
	.bsaProDiscount  { ".bsaProGetOpt('form_discount_bg', 'bg')." ".bsaProGetOpt('form_discount_c', 'c')." }
	.bsaProOrderingForm .bsaProSubmit,
	.bsaProOrderingForm .bsaProSubmit:hover,
	.bsaProOrderingForm .bsaProSubmit:active { ".bsaProGetOpt('form_button_bg', 'bg')." ".bsaProGetOpt('form_button_c', 'c')." }

	/* allerts */
	.bsaProAlert,
	.bsaProAlert > a,
	.bsaProAlert > a:hover,
	.bsaProAlert > a:focus { ".bsaProGetOpt('form_alert_c', 'c')." }
	.bsaProAlertSuccess { ".bsaProGetOpt('form_alert_success_bg', 'bg')." }
	.bsaProAlertFailed { ".bsaProGetOpt('form_alert_failed_bg', 'bg')." }

	/* stats */
	.bsaStatsWrapper .ct-chart .ct-series.ct-series-b .ct-bar,
	.bsaStatsWrapper .ct-chart .ct-series.ct-series-b .ct-line,
	.bsaStatsWrapper .ct-chart .ct-series.ct-series-b .ct-point,
	.bsaStatsWrapper .ct-chart .ct-series.ct-series-b .ct-slice.ct-donut { ".bsaProGetOpt('stats_views_line', 's')." }

	.bsaStatsWrapper  .ct-chart .ct-series.ct-series-a .ct-bar,
	.bsaStatsWrapper .ct-chart .ct-series.ct-series-a .ct-line,
	.bsaStatsWrapper .ct-chart .ct-series.ct-series-a .ct-point,
	.bsaStatsWrapper .ct-chart .ct-series.ct-series-a .ct-slice.ct-donut { ".bsaProGetOpt('stats_clicks_line', 's')." }


	/* Custom CSS */
	".get_option('bsa_pro_plugin_custom_css')."
</style>";
}
add_action('wp_enqueue_scripts', 'BSA_PRO_add_custom_stylesheet');

function BSA_PRO_load_color_picker() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'BSA_PRO_load_color_picker' );

class BSA_PRO_ShortCode_Init extends WP_Widget {
	public function __construct() {
		parent::__construct('bsa_shortcode_widget', 'ADS PRO - Shortcode', array(
			'description' => 'Here you can add shortcode from ADS PRO.',
		));
	}
	public function widget( $args, $instance ) {

		extract( $args );
		// these are the widget options
		$shortcode = $instance['shortcode'];

		// -- Start -- Content
		if ( $shortcode != '' ) {
			echo do_shortcode( $shortcode );
		} else {
			//echo 'Shortcode field is empty!';
		}
		// -- END -- Content
	}
	public function form( $instance ) {

		if ( bsa_role() == 'admin' ) {

			// Check values
			if( $instance) {
				$shortcode = esc_attr($instance['shortcode']);
			} else {
				$shortcode = '';
			}
			?>

			<p>
				<label for="<?php echo $this->get_field_id('shortcode'); ?>"><?php _e('Shortcode', 'wp_widget_plugin'); ?></label><br>
				<input id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>" style="width:100%;" value="<?php echo $shortcode; ?>" />
			</p>
			<?php

		} else {

			echo "<p>You haven't permission to manage ads.</p>";

		}
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// Fields
		$instance['shortcode'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['shortcode']) ) );
		return $instance;
	}
}

add_action('widgets_init',
	create_function('', 'return register_widget("BSA_PRO_ShortCode_Init");')
);

class BuySellAdsApiTemplate {

	/**
	 * A Unique Identifier
	 */
	protected $plugin_slug;

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;


	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if( null == self::$instance ) {
			self::$instance = new BuySellAdsApiTemplate();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();


		// Add a filter to the attributes metabox to inject template into the cache.
		add_filter(
			'page_attributes_dropdown_pages_args',
			array( $this, 'register_project_templates' )
		);


		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_project_templates' )
		);


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_project_template')
		);


		// Add your templates to this array.
		$this->templates = array(
			'/api/get.php'     => 'ADS PRO - API',
		);

	}


	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 */

	public function register_project_templates( $atts ) {

		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// Retrieve the cache list.
		// If it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// New cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	/**
	 * Checks if the template is assigned to the page
	 */
	public function view_project_template( $template ) {

		global $post;

		if (!isset($this->templates[get_post_meta(
				$post->ID, '_wp_page_template', true
			)] ) ) {

			return $template;

		}

		$file = plugin_dir_path(__FILE__). get_post_meta(
				$post->ID, '_wp_page_template', true
			);

		// Just to be safe, we check if the file exist first
		if( file_exists( $file ) ) {
			return $file;
		}
		else { echo $file; }

		return $template;

	}


}

add_action( 'plugins_loaded', array( 'BuySellAdsApiTemplate', 'get_instance' ) );

$BuySellAdsPlugin = new BuySellAdsPro();