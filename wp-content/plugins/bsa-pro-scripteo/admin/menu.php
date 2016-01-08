<?php

function bsa_pro_head_menu()
{
	?>
	<div class="wrap" style="display:none">
		<?php if ( get_option("bsa_pro_plugin_purchase_code") == '' || get_option("bsa_pro_plugin_purchase_code") == null ) {
			echo '
			<div class="updated settings-error">
				<p><strong>NOTE!</strong> Enter the <strong>purchase code</strong> in the settings to use all functions of ADS PRO! Thanks!</p>
			</div>';
		} ?>
		<?php require_once 'dashboard.php'; ?>
	</div>
<?php
}

function bsa_pro_sub_menu_spaces()
{
	?>
	<div class="wrap" style="display:none">
		<?php if ( get_option("bsa_pro_plugin_purchase_code") == '' || get_option("bsa_pro_plugin_purchase_code") == null ) {
			echo '
			<div class="updated settings-error">
				<p><strong>NOTE!</strong> Enter the <strong>purchase code</strong> in the settings to use all functions of ADS PRO! Thanks!</p>
			</div>';
		} ?>
		<?php require_once 'items.php'; ?>
	</div>
<?php
}

function bsa_pro_sub_menu_add_new_space()
{
	?>
	<div class="wrap" style="display:none">
		<?php if ( get_option("bsa_pro_plugin_purchase_code") == '' || get_option("bsa_pro_plugin_purchase_code") == null ) {
			echo '
			<div class="updated settings-error">
				<p><strong>NOTE!</strong> Enter the <strong>purchase code</strong> in the settings to use all functions of ADS PRO! Thanks!</p>
			</div>';
		} ?>
		<?php bsaAddNewSpace(); ?>
		<?php require_once 'add-space.php'; ?>
	</div>
<?php
}

function bsaAddNewSpace()
{

	if ( $_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'updateSpace' ) {

		if ( isset($_SESSION['bsa_space_'.$_GET['space_id']]) ) {
			unset($_SESSION['bsa_space_'.$_GET['space_id']]); // Reset cache
		}

		if ( $_POST["name"] != '' ) {

			if ( $_POST["cpc_price"] != '' || $_POST["cpc_contract_1"] != '' || $_POST["cpc_contract_2"] != '' || $_POST["cpc_contract_3"] != '' ) {

				if ($_POST["cpc_price"] != '' && $_POST["cpc_contract_1"] != '' && $_POST["cpc_contract_2"] == '' && $_POST["cpc_contract_3"] == '' ||
					$_POST["cpc_price"] == 0 ||
					$_POST["cpc_price"] != '' && $_POST["cpc_contract_1"] != '' && $_POST["cpc_contract_2"] != '' && $_POST["cpc_contract_3"] == '' && $_POST["cpc_contract_1"] != $_POST["cpc_contract_2"] ||
					$_POST["cpc_price"] != '' && $_POST["cpc_contract_1"] != '' && $_POST["cpc_contract_2"] != '' && $_POST["cpc_contract_3"] != '' && $_POST["cpc_contract_1"] != $_POST["cpc_contract_2"] && $_POST["cpc_contract_1"] != $_POST["cpc_contract_3"] && $_POST["cpc_contract_2"] != $_POST["cpc_contract_3"] ) {

					$cpc_status = 'isset';

				} else {

					$cpc_status = 'incorrect';
				}

			} else {

				$cpc_status =  'not_isset';
			}

			if ( $_POST["cpm_price"] != '' || $_POST["cpm_contract_1"] != '' || $_POST["cpm_contract_2"] != '' || $_POST["cpm_contract_3"] != '' ) {

				if ($_POST["cpm_price"] != '' && $_POST["cpm_contract_1"] != '' && $_POST["cpm_contract_2"] == '' && $_POST["cpm_contract_3"] == '' ||
					$_POST["cpm_price"] == 0 ||
					$_POST["cpm_price"] != '' && $_POST["cpm_contract_1"] != '' && $_POST["cpm_contract_2"] != '' && $_POST["cpm_contract_3"] == '' && $_POST["cpm_contract_1"] != $_POST["cpm_contract_2"] ||
					$_POST["cpm_price"] != '' && $_POST["cpm_contract_1"] != '' && $_POST["cpm_contract_2"] != '' && $_POST["cpm_contract_3"] != '' && $_POST["cpm_contract_1"] != $_POST["cpm_contract_2"] && $_POST["cpm_contract_1"] != $_POST["cpm_contract_3"] && $_POST["cpm_contract_2"] != $_POST["cpm_contract_3"] ) {

					$cpm_status = 'isset';

				} else {

					$cpm_status = 'incorrect';
				}

			} else {

				$cpm_status =  'not_isset';
			}

			if ( $_POST["cpd_price"] != '' || $_POST["cpd_contract_1"] != '' || $_POST["cpd_contract_2"] != '' || $_POST["cpd_contract_3"] != '' ) {

				if ($_POST["cpd_price"] != '' && $_POST["cpd_contract_1"] != '' && $_POST["cpd_contract_2"] == '' && $_POST["cpd_contract_3"] == '' ||
					$_POST["cpd_price"] == 0 ||
					$_POST["cpd_price"] != '' && $_POST["cpd_contract_1"] != '' &&$_POST["cpd_contract_2"] != '' && $_POST["cpd_contract_3"] == '' && $_POST["cpd_contract_1"] != $_POST["cpd_contract_2"] ||
					$_POST["cpd_price"] != '' && $_POST["cpd_contract_1"] != '' &&$_POST["cpd_contract_2"] != '' && $_POST["cpd_contract_3"] != '' && $_POST["cpd_contract_1"] != $_POST["cpd_contract_2"] && $_POST["cpd_contract_1"] != $_POST["cpd_contract_3"] && $_POST["cpd_contract_2"] != $_POST["cpd_contract_3"] ) {

					$cpd_status = 'isset';

				} else {

					$cpd_status = 'incorrect';
				}

			} else {

				$cpd_status =  'not_isset';
			}

			if ( $cpc_status == 'isset' || $cpc_status == 'incorrect' || $cpm_status == 'isset' || $cpm_status == 'incorrect' || $cpd_status == 'isset' || $cpd_status == 'incorrect' ) {

				if ( $cpc_status == 'incorrect' || $cpm_status == 'incorrect' || $cpd_status == 'incorrect' ) {

					echo '
					<div class="updated settings-error">
						<p><strong>Error, incorrect contract values!</strong> Please enter the price and value for 1st Contract.<br><br>
						Note! If you want to add more contracts, add them one by one (all values must be different).</p>
					</div>';

				} else {

					$model = new BSA_PRO_Model();
					$model->updateSpace(
						$_GET['space_id'],
						$_POST['name'],
						$_POST['title'],
						$_POST['add_new'],
						$_POST['cpc_price'],
						$_POST['cpm_price'],
						$_POST['cpd_price'],
						$_POST['cpc_contract_1'],
						$_POST['cpc_contract_2'],
						$_POST['cpc_contract_3'],
						$_POST['cpm_contract_1'],
						$_POST['cpm_contract_2'],
						$_POST['cpm_contract_3'],
						$_POST['cpd_contract_1'],
						$_POST['cpd_contract_2'],
						$_POST['cpd_contract_3'],
						$_POST['discount_2'],
						$_POST['discount_3'],
						$_POST['grid_system'],
						$_POST['template'],
						$_POST['display_type'],
						$_POST['random'],
						$_POST['max_items'],
						$_POST['col_per_row'],
						$_POST['font'],
						$_POST['font_url'],
						$_POST['header_bg'],
						$_POST['header_color'],
						$_POST['link_color'],
						$_POST['ads_bg'],
						$_POST['ad_bg'],
						$_POST['ad_title_color'],
						$_POST['ad_desc_color'],
						$_POST['ad_url_color'],
						$_POST['ad_extra_color_1'],
						$_POST['ad_extra_color_2'],
						$_POST['animation'],
						( isset($_POST['space_categories']) && $_POST['space_categories'] != '' ? implode(",", $_POST['space_categories']) : null ),
						( isset($_POST['space_tags']) && $_POST['space_tags'] != '' ? implode(",", $_POST['space_tags']) : null ),
						( isset($_POST['show_in_country']) && $_POST['show_in_country'] != '' ? implode(",", $_POST['show_in_country']) : null ),
						( isset($_POST['hide_in_country']) && $_POST['hide_in_country'] != '' ? implode(",", $_POST['hide_in_country']) : null ),
						( isset($_POST['show_in_advanced']) && $_POST['show_in_advanced'] != '' ? $_POST['show_in_advanced'] : null ),
						( isset($_POST['hide_in_advanced']) && $_POST['hide_in_advanced'] != '' ? $_POST['hide_in_advanced'] : null ),
						( isset($_POST['devices']) && $_POST['devices'] != '' ? implode(",", $_POST['devices']) : null ),
						( isset($_POST['unavailable_dates']) && $_POST['unavailable_dates'] != '' ? $_POST['unavailable_dates'] : null ),
						( isset($_POST['show_ads']) && isset($_POST['show_close_btn']) && isset($_POST['close_ads']) ? ($_POST['show_ads'] > 0 ? $_POST['show_ads'] : '0').','.($_POST['show_close_btn'] > 0 ? $_POST['show_close_btn'] : '0').','.($_POST['close_ads'] > 0 ? $_POST['close_ads'] : '0') : '0,0,0' ),
						(($_POST['status'] == 'active') ? 'active' : 'inactive')
					);
					do_action( 'bsa-pro-updateSpace', $_POST, $_GET['space_id'] );
					echo '
					<div class="updated settings-error">
						<p><strong>Space updated.</strong></p>
					</div>';
				}
			} else {

				echo '
				<div class="updated settings-error">
					<p><strong>Error, empty contracts!</strong> You should set at least one contract.</p>
				</div>';
			}

		} else {

			echo '
			<div class="updated settings-error">
				<p><strong>Space not saved.</strong> The name field is required!</p>
			</div>';
		}

	} elseif ( $_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'addNewSpace' ) {

		if ( $_POST["name"] != '' ) {

			if ( $_POST["cpc_price"] != '' || $_POST["cpc_contract_1"] != '' || $_POST["cpc_contract_2"] != '' || $_POST["cpc_contract_3"] != '' ) {

				if ($_POST["cpc_price"] != '' && $_POST["cpc_contract_1"] != '' && $_POST["cpc_contract_2"] == '' && $_POST["cpc_contract_3"] == '' ||
					$_POST["cpc_price"] == 0 ||
					$_POST["cpc_price"] != '' && $_POST["cpc_contract_1"] != '' && $_POST["cpc_contract_2"] != '' && $_POST["cpc_contract_3"] == '' && $_POST["cpc_contract_1"] != $_POST["cpc_contract_2"] ||
					$_POST["cpc_price"] != '' && $_POST["cpc_contract_1"] != '' && $_POST["cpc_contract_2"] != '' && $_POST["cpc_contract_3"] != '' && $_POST["cpc_contract_1"] != $_POST["cpc_contract_2"] && $_POST["cpc_contract_1"] != $_POST["cpc_contract_3"] && $_POST["cpc_contract_2"] != $_POST["cpc_contract_3"] ) {

					$cpc_status = 'isset';

				} else {

					$cpc_status = 'incorrect';
				}

			} else {

				$cpc_status =  'not_isset';
			}

			if ( $_POST["cpm_price"] != '' || $_POST["cpm_contract_1"] != '' || $_POST["cpm_contract_2"] != '' || $_POST["cpm_contract_3"] != '' ) {

				if ($_POST["cpm_price"] != '' && $_POST["cpm_contract_1"] != '' && $_POST["cpm_contract_2"] == '' && $_POST["cpm_contract_3"] == '' ||
					$_POST["cpm_price"] == 0 ||
					$_POST["cpm_price"] != '' && $_POST["cpm_contract_1"] != '' && $_POST["cpm_contract_2"] != '' && $_POST["cpm_contract_3"] == '' && $_POST["cpm_contract_1"] != $_POST["cpm_contract_2"] ||
					$_POST["cpm_price"] != '' && $_POST["cpm_contract_1"] != '' && $_POST["cpm_contract_2"] != '' && $_POST["cpm_contract_3"] != '' && $_POST["cpm_contract_1"] != $_POST["cpm_contract_2"] && $_POST["cpm_contract_1"] != $_POST["cpm_contract_3"] && $_POST["cpm_contract_2"] != $_POST["cpm_contract_3"] ) {

					$cpm_status = 'isset';

				} else {

					$cpm_status = 'incorrect';
				}

			} else {

				$cpm_status =  'not_isset';
			}

			if ( $_POST["cpd_price"] != '' || $_POST["cpd_contract_1"] != '' || $_POST["cpd_contract_2"] != '' || $_POST["cpd_contract_3"] != '' ) {

				if ($_POST["cpd_price"] != '' && $_POST["cpd_contract_1"] != '' && $_POST["cpd_contract_2"] == '' && $_POST["cpd_contract_3"] == '' ||
					$_POST["cpd_price"] == 0 ||
					$_POST["cpd_price"] != '' && $_POST["cpd_contract_1"] != '' &&$_POST["cpd_contract_2"] != '' && $_POST["cpd_contract_3"] == '' && $_POST["cpd_contract_1"] != $_POST["cpd_contract_2"] ||
					$_POST["cpd_price"] != '' && $_POST["cpd_contract_1"] != '' &&$_POST["cpd_contract_2"] != '' && $_POST["cpd_contract_3"] != '' && $_POST["cpd_contract_1"] != $_POST["cpd_contract_2"] && $_POST["cpd_contract_1"] != $_POST["cpd_contract_3"] && $_POST["cpd_contract_2"] != $_POST["cpd_contract_3"] ) {

					$cpd_status = 'isset';

				} else {

					$cpd_status = 'incorrect';
				}

			} else {

				$cpd_status =  'not_isset';
			}

			if ( $cpc_status == 'isset' || $cpc_status == 'incorrect' || $cpm_status == 'isset' || $cpm_status == 'incorrect' || $cpd_status == 'isset' || $cpd_status == 'incorrect' ) {

				if ( $cpc_status == 'incorrect' || $cpm_status == 'incorrect' || $cpd_status == 'incorrect' ) {

					echo '
					<div class="updated settings-error">
						<p><strong>Error, incorrect contract values!</strong> Please enter the price and value for 1st Contract.<br><br>
						Note! If you want to add more contracts, add them one by one (all values must be different).</p>
					</div>';

				} else {

					$model = new BSA_PRO_Model();
					$model->addNewSpace(
						NULL,
						$_POST['name'],
						$_POST['title'],
						$_POST['add_new'],
						$_POST['cpc_price'],
						$_POST['cpm_price'],
						$_POST['cpd_price'],
						$_POST['cpc_contract_1'],
						$_POST['cpc_contract_2'],
						$_POST['cpc_contract_3'],
						$_POST['cpm_contract_1'],
						$_POST['cpm_contract_2'],
						$_POST['cpm_contract_3'],
						$_POST['cpd_contract_1'],
						$_POST['cpd_contract_2'],
						$_POST['cpd_contract_3'],
						$_POST['discount_2'],
						$_POST['discount_3'],
						$_POST['grid_system'],
						$_POST['template'],
						$_POST['display_type'],
						$_POST['random'],
						$_POST['max_items'],
						$_POST['col_per_row'],
						$_POST['font'],
						$_POST['font_url'],
						$_POST['header_bg'],
						$_POST['header_color'],
						$_POST['link_color'],
						$_POST['ads_bg'],
						$_POST['ad_bg'],
						$_POST['ad_title_color'],
						$_POST['ad_desc_color'],
						$_POST['ad_url_color'],
						$_POST['ad_extra_color_1'],
						$_POST['ad_extra_color_2'],
						$_POST['animation'],
						( isset($_POST['space_categories']) && $_POST['space_categories'] != '' ? implode(",", $_POST['space_categories']) : null ),
						( isset($_POST['space_tags']) && $_POST['space_tags'] != '' ? implode(",", $_POST['space_tags']) : null ),
						( isset($_POST['show_in_country']) && $_POST['show_in_country'] != '' ? implode(",", $_POST['show_in_country']) : null ),
						( isset($_POST['hide_in_country']) && $_POST['hide_in_country'] != '' ? implode(",", $_POST['hide_in_country']) : null ),
						( isset($_POST['show_in_advanced']) && $_POST['show_in_advanced'] != '' ? $_POST['show_in_advanced'] : null ),
						( isset($_POST['hide_in_advanced']) && $_POST['hide_in_advanced'] != '' ? $_POST['hide_in_advanced'] : null ),
						( isset($_POST['devices']) && $_POST['devices'] != '' ? implode(",", $_POST['devices']) : null ),
						( isset($_POST['unavailable_dates']) && $_POST['unavailable_dates'] != '' ? $_POST['unavailable_dates'] : null ),
						( isset($_POST['show_ads']) && isset($_POST['show_close_btn']) && isset($_POST['close_ads']) ? ($_POST['show_ads'] > 0 ? $_POST['show_ads'] : '0').','.($_POST['show_close_btn'] > 0 ? $_POST['show_close_btn'] : '0').','.($_POST['close_ads'] > 0 ? $_POST['close_ads'] : '0') : '0,0,0' ),
						(($_POST['status'] == 'active') ? 'active' : 'inactive')
					);
					do_action( 'bsa-pro-addNewSpace', $_POST, $model->getTableName('spaces') );
					$_SESSION['bsa_space_status'] = 'space_added';

					echo '
					<div class="updated settings-error">
						<p><strong>Space saved.</strong> Click <a href="'.admin_url().'admin.php?page=bsa-pro-sub-menu-spaces">here</a> to show all spaces.</p>
					</div>';
				}
			} else {

				echo '
				<div class="updated settings-error">
					<p><strong>Error, empty contracts!</strong> You should set at least one contract.</p>
				</div>';
			}

		} else {

			echo '
			<div class="updated settings-error">
				<p><strong>Space not saved.</strong> The name field is required!</p>
			</div>';
		}
	}
}

function bsa_pro_sub_menu_add_new_ad()
{
	?>
	<div class="wrap" style="display:none">
		<?php if ( get_option("bsa_pro_plugin_purchase_code") == '' || get_option("bsa_pro_plugin_purchase_code") == null ) {
			echo '
			<div class="updated settings-error">
				<p><strong>NOTE!</strong> Enter the <strong>purchase code</strong> in the settings to use all functions of ADS PRO! Thanks!</p>
			</div>';
		} ?>
		<?php bsaAddNewAd(); ?>
		<?php require_once 'add-ad.php'; ?>
	</div>
<?php
}

function bsaAddNewAd()
{
	$plugin_id = 'bsa_pro_plugin_';

	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'updateAd') {

		if ( isset($_SESSION['bsa_ad_'.$_GET['ad_id']]) ) {
			unset($_SESSION['bsa_ad_'.$_GET['ad_id']]); // Reset cache
		}

		// validate form
		foreach ( explode(',', str_replace('desc', 'description', $_POST['inputs_required'])) as $input ) {
			$error = FALSE;
			if ( $input == 'img' ) {
				if ( $_FILES['img']["name"] == '' ) {
					$error = FALSE; // img not required for updateAd Action
				}
			} else {
				if ( $_POST[$input] == '' ) {
					$error = TRUE;
				}
			}
			if ( $error == TRUE ) {
				echo '
				<div class="updated settings-error">
					<p><strong>Ad not saved.</strong> The '.str_replace(',', ', ', str_replace('desc', 'description', $_POST['inputs_required'])).' fields are required!</p>
				</div>';
				return;
			}
		}

		if ( $_POST["buyer_email"] != '' ) {

			// if isset img
			$uploadName = strtolower($_FILES["img"]["name"]);
			if ( $uploadName ) {
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $uploadName);
				$extension = end($temp);
				$fileName = NULL;

				if ((($_FILES["img"]["type"] == "image/gif")
						|| ($_FILES["img"]["type"] == "image/jpeg")
						|| ($_FILES["img"]["type"] == "image/jpg")
						|| ($_FILES["img"]["type"] == "image/pjpeg")
						|| ($_FILES["img"]["type"] == "image/x-png")
						|| ($_FILES["img"]["type"] == "image/png"))
					&& $_FILES["img"]["error"] == 0
					&& in_array($extension, $allowedExts)) {

					$fileName = time().'-'.$uploadName;
					$path     = bsa_upload_url('basedir').$fileName;
					$thumbLoc = $_FILES["img"]["tmp_name"];

					list($width, $height) = getimagesize($thumbLoc);
					$maxSize = get_option($plugin_id.'thumb_size');
					$maxWidth = get_option($plugin_id.'thumb_w');
					$maxHeight = get_option($plugin_id.'thumb_h');

					if (($_FILES["img"]["size"] > $maxSize * 1024) OR $width > $maxWidth OR $height > $maxHeight) {
						echo '
						<div class="updated settings-error">
							<p><strong>Ad not saved.</strong> Images was too high.</p>
						</div>';
						return;
					} else {
						// save img
						move_uploaded_file($thumbLoc, $path);
					}
				} else {
					echo '
					<div class="updated settings-error">
						<p><strong>Ad not saved.</strong> Type of image invalid.</p>
					</div>
					';
					return;
				}
			} else {
				$fileName = NULL;
			}

			$limit = bsa_ad($_GET['ad_id'], 'ad_limit');
			if ( isset($_POST["increase_limit"]) && $_POST["increase_limit"] != '' ) {
				if ( $_POST["increase_limit"] > 0 ) {
					if ( bsa_ad($_GET['ad_id'], 'ad_model') == 'cpd' ) {
						$time = time();
						$increase = $_POST["increase_limit"] * 24 * 60 * 60;
						$diff = $limit - $time;
						$increase_limit = ($diff <= 0) ? $time + $increase : $limit + $increase;
					} else {
						$increase_limit = $limit + $_POST["increase_limit"];
					}
				} else {
					$increase_limit = bsa_ad($_GET['ad_id'], 'ad_limit');
				}
			} else {
				$increase_limit = null;
			}

//			var_dump(stripslashes( wp_filter_post_kses( addslashes( $_POST["html"] ) ) ));
			if ( (bsa_role() == 'user') ) {
				$status = ((get_option('bsa_pro_plugin_auto_accept') == 'no') ? 'pending' : null);
				$increase_limit = null;
			} else {
				$status = null;
			}

			$capping = ( $_POST["capping"] > 0 ? number_format($_POST["capping"], 0, '', '') : 0);

			$model = new BSA_PRO_Model();
			$model->updateAd( $_GET['ad_id'], $_POST["buyer_email"], $_POST["title"], $_POST["description"], $_POST["url"], $fileName, stripslashes( $_POST["html"] ), $capping, $increase_limit, $status );

			echo '
						<div class="updated settings-error">
							<p><strong>Success!</strong> Ad saved.</p>
						</div>';

		} else {

			echo '
			<div class="updated settings-error">
				<p><strong>Ad not saved.</strong> The buyer email field is required!</p>
			</div>';

		}

	} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'addNewAd') {

		// validate form
		foreach ( explode(',', str_replace('desc', 'description', $_POST['inputs_required'])) as $input ) {
			$error = FALSE;
			if ( $input == 'img' ) {
				if ( $_FILES['img']["name"] == '' ) {
					$error = TRUE;
				}
			} else {
				if ( $_POST[$input] == '' ) {
					$error = TRUE;
				}
			}
			if ( $error == TRUE ) {
				echo '
				<div class="updated settings-error">
					<p><strong>Ad not saved.</strong> The '.str_replace(',', ', ', str_replace('desc', 'description', $_POST['inputs_required'])).' fields are required!</p>
				</div>';
				return;
			}
		}

		if ( isset($_POST["buyer_email"]) && $_POST["buyer_email"] != '' && isset($_POST["space_id"]) && $_POST["space_id"] != '' && isset($_POST["ad_model"]) && $_POST["ad_model"] != '' && isset($_POST["ad_limit_" . $_POST["ad_model"]]) && $_POST["ad_limit_" . $_POST["ad_model"]] != '' ) {

			// if isset img
			if ( $_FILES['img']["name"] ) {
				$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG",);
				$temp = explode(".", $_FILES["img"]["name"]);
				$extension = end($temp);
				$fileName = NULL;

				if ((($_FILES["img"]["type"] == "image/gif")
						|| ($_FILES["img"]["type"] == "image/jpeg")
						|| ($_FILES["img"]["type"] == "image/jpg")
						|| ($_FILES["img"]["type"] == "image/pjpeg")
						|| ($_FILES["img"]["type"] == "image/x-png")
						|| ($_FILES["img"]["type"] == "image/png"))
					&& $_FILES["img"]["error"] == 0
					&& in_array($extension, $allowedExts)) {

					$fileName = time().'-'.$_FILES["img"]["name"];
					$path     = bsa_upload_url('basedir').$fileName;
					$thumbLoc = $_FILES["img"]["tmp_name"];

					list($width, $height) = getimagesize($thumbLoc);
					$maxSize = get_option($plugin_id.'thumb_size');
					$maxWidth = get_option($plugin_id.'thumb_w');
					$maxHeight = get_option($plugin_id.'thumb_h');

					if (($_FILES["img"]["size"] > $maxSize * 1024) OR $width > $maxWidth OR $height > $maxHeight) {
						echo '
						<div class="updated settings-error">
							<p><strong>Ad not saved.</strong> Images was too high.</p>
						</div>';
						return;
					} else {
						// save img
						move_uploaded_file($thumbLoc, $path);
					}
				} else {
					echo '
					<div class="updated settings-error">
						<p><strong>Ad not saved.</strong> Type of image invalid.</p>
					</div>
					';
					return;
				}
			} else {
				$fileName = '';
			}

			// set limit for cpd - change days to timestamp
			if ( $_POST["ad_model"] == 'cpd' ) {
				$ad_limit = time() + ($_POST["ad_limit_" . $_POST["ad_model"]] * 24 * 60 * 60);
			} else {
				$ad_limit = $_POST["ad_limit_" . $_POST["ad_model"]];
			}

			$model = new BSA_PRO_Model();

			if ( (bsa_role() == 'user') ) {
				$status = ((get_option('bsa_pro_plugin_auto_accept') == 'no') ? 'pending' : 'active');
			} else {
				$status = 'active';
			}

			$capping = ( $_POST["capping"] > 0 ? number_format($_POST["capping"], 0, '', '') : 0);

			$model->addNewAd(	NULL, $_POST["space_id"], $_POST["buyer_email"], $_POST["title"], $_POST["description"], $_POST["url"], $fileName, stripslashes( $_POST["html"] ), $capping,
				$_POST["ad_model"], $ad_limit, 0.00, 2, $status); // paid 2 - Added via Admin Panel

			$_SESSION['bsa_ad_status'] = 'ad_added';

			echo '
						<div class="updated settings-error">
							<p><strong>Success!</strong> Ad saved.</p>
						</div>';

		} else {

			echo '
			<div class="updated settings-error">
				<p><strong>Ad not saved.</strong> The buyer email, space id, billing model fields are required!</p>
			</div>';

		}
	}
}

function bsa_pro_sub_menu_creator()
{
	?>
	<div class="wrap" style="display:none">
		<?php if ( get_option("bsa_pro_plugin_purchase_code") == '' || get_option("bsa_pro_plugin_purchase_code") == null ) {
			echo '
			<div class="updated settings-error">
				<p><strong>NOTE!</strong> Enter the <strong>purchase code</strong> in the settings to use all functions of ADS PRO! Thanks!</p>
			</div>';
		} ?>
		<?php bsaCreateAdTemplate(); ?>
		<?php require_once 'creator.php'; ?>
	</div>
<?php
}

function bsaCreateAdTemplate($width = null, $height = null)
{
	if( $_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'adCreator' ||
		$width != null && $height != null)
	{

		if( isset($_POST["ad_width"]) && $_POST["ad_width"] != '' && isset($_POST["ad_height"]) && $_POST["ad_height"] != '' ||
			$width != null && $height != null )
		{
			$ad_width = ( $width == null ) ? $_POST["ad_width"] : $width;
			$ad_height = ( $height == null ) ? $_POST["ad_height"] : $height;

			$css_styles = '
/* -- START -- Reset */
#bsa-block-'.$ad_width.'--'.$ad_height.' h3,
#bsa-block-'.$ad_width.'--'.$ad_height.' a,
#bsa-block-'.$ad_width.'--'.$ad_height.' img,
#bsa-block-'.$ad_width.'--'.$ad_height.' span,
#bsa-block-'.$ad_width.'--'.$ad_height.' p {
	margin: 0;
	padding: 0;
	border: 0;
	border-radius: 0;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	text-decoration: none;
	line-height: 1.25;
}
/* -- END -- Reset */


/* -- START -- TEMPLATE */
#bsa-block-'.$ad_width.'--'.$ad_height.'.bsaProContainer .bsaProItem,
#bsa-block-'.$ad_width.'--'.$ad_height.' .bsaProItemInner__thumb,
#bsa-block-'.$ad_width.'--'.$ad_height.' .bsaProAnimateThumb {
	max-width: '.$ad_width.'px;
	max-height: '.$ad_height.'px;
}

#bsa-block-'.$ad_width.'--'.$ad_height.' .bsaProAnimateThumb {
	position: relative;
	width: 100%;
	height: '.$ad_height.'px;
}

#bsa-block-'.$ad_width.'--'.$ad_height.' .bsaProAnimateThumb:before{
	content: "";
	display: block;
}

#bsa-block-'.$ad_width.'--'.$ad_height.' .bsaProItemInner__img {
	position:  absolute;
	width: 100%;
	max-height: '.$ad_height.'px;
	height: auto;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	background-size: 100%;
	background-repeat: no-repeat;
}
/* -- END -- TEMPLATE */';
			file_put_contents(plugin_dir_path( __FILE__ ) . '/../frontend/css/block-'.$ad_width.'--'.$ad_height.'.css', $css_styles);

			$template_code = file_get_contents(plugin_dir_path( __FILE__ ) . '/../frontend/template/block-300--250.php');
			$template_php = str_replace('300', $ad_width, str_replace('250', $ad_height, $template_code));
			file_put_contents(plugin_dir_path( __FILE__ ) . '/../frontend/template/block-'.$ad_width.'--'.$ad_height.'.php', $template_php);

			$custom_templates = get_option('bsa_pro_plugin_custom_templates');
			$exists = strpos($custom_templates, $ad_width.'--'.$ad_height);
			if ($exists === false) {
				update_option('bsa_pro_plugin_custom_templates', $custom_templates.','.$ad_width.'--'.$ad_height);
			}

			if ( $width == null && $height == null ) {
				echo '
				<div class="updated settings-error">
					<p>Ad Template (<strong>block-'.$ad_width.'--'.$ad_height.'</strong>) has been saved.</p>
				</div>';
			}
		} else {
			echo '
			<div class="updated settings-error" id="setting-error-settings_updated">
				<p><strong>Error!</strong> Both fields required!</p>
			</div>';
		}
	}
}

function bsaCreateCustomAdTemplates() {
	$custom_templates = get_option('bsa_pro_plugin_custom_templates');
	if ( $custom_templates ) {
		$custom_templates = explode(',', $custom_templates);
		foreach ( $custom_templates as $custom_template ) {
			if ( $custom_template != '' ) {
				$template = explode('--', $custom_template);
				$width = $template[0];
				$height = $template[1];
				bsaCreateAdTemplate($width, $height);
			}
		}
	}
}

function bsa_pro_sub_menu_settings()
{
	?>
	<div class="wrap">
		<?php if ( get_option("bsa_pro_plugin_purchase_code") == '' || get_option("bsa_pro_plugin_purchase_code") == null ) {
			echo '
			<div class="updated settings-error">
				<p><strong>NOTE!</strong> Enter the <strong>purchase code</strong> in the settings to use all functions of ADS PRO! Thanks!</p>
			</div>';
		}
		if ( is_multisite() && is_main_site() ) {
			if (get_site_option('bsa_pro_plugin_main_basedir') == null ||
				get_site_option('bsa_pro_plugin_main_baseurl') == null ||
				get_site_option('bsa_pro_plugin_order_form_url') == null ||
				get_site_option('bsa_pro_plugin_order_form_url') != get_option('bsa_pro_plugin_ordering_form_url') ||
				get_site_option('bsa_pro_plugin_agency_order_form_url') == null ||
				get_site_option('bsa_pro_plugin_agency_order_form_url') != get_option('bsa_pro_plugin_agency_ordering_form_url')) {
				$upload_dir = wp_upload_dir();
				update_site_option('bsa_pro_plugin_main_basedir', $upload_dir['basedir']);
				update_site_option('bsa_pro_plugin_main_baseurl', $upload_dir['baseurl']);
				update_site_option('bsa_pro_plugin_order_form_url', get_option('bsa_pro_plugin_ordering_form_url'));
				update_site_option('bsa_pro_plugin_agency_order_form_url', get_option('bsa_pro_plugin_agency_ordering_form_url'));
			}
		} ?>
		<?php bsaUpdateSettings(); ?>
		<?php require_once 'settings.php'; ?>
	</div>
<?php
}

function bsaUpdateSettings()
{
	$opt = 'bsa_pro_plugin_';

	if( $_SERVER["REQUEST_METHOD"] == "POST" &&
		$_POST["bsaProAction"] == 'updateSettings' &&
		$_POST["ordering_form_url"] != '' )
	{
		// Settings
		// plugin settings
		update_option($opt.'purchase_code', $_POST['purchase_code']);
		update_option($opt.'paypal', $_POST['paypal']);
		update_option($opt.'secret_key', $_POST['secret_key']);
		update_option($opt.'publishable_key', $_POST['publishable_key']);
		update_option($opt.'trans_payment_bank_transfer_content', $_POST['trans_payment_bank_transfer_content']);
		update_option($opt.'ordering_form_url', $_POST['ordering_form_url']);
		update_option($opt.'currency_code', $_POST['currency_code']);
		update_option($opt.'stripe_code', $_POST['stripe_code']);
		update_option($opt.'currency_symbol', $_POST['currency_symbol']);
		update_option($opt.'symbol_position', $_POST['symbol_position']);
		update_option($opt.'auto_accept', $_POST['auto_accept']);
		update_option($opt.'calendar', $_POST['calendar']);
		// installation settings
		update_option($opt.'installation', $_POST['installation']);
		// hooks settings
		update_option($opt.'before_hook', str_replace('\"', '', $_POST['before_hook']));
		update_option($opt.'after_1_paragraph', str_replace('\"', '', $_POST['after_1_paragraph']));
		update_option($opt.'after_2_paragraph', str_replace('\"', '', $_POST['after_2_paragraph']));
		update_option($opt.'after_3_paragraph', str_replace('\"', '', $_POST['after_3_paragraph']));
		update_option($opt.'after_4_paragraph', str_replace('\"', '', $_POST['after_4_paragraph']));
		update_option($opt.'after_5_paragraph', str_replace('\"', '', $_POST['after_5_paragraph']));
		update_option($opt.'after_6_paragraph', str_replace('\"', '', $_POST['after_6_paragraph']));
		update_option($opt.'after_7_paragraph', str_replace('\"', '', $_POST['after_7_paragraph']));
		update_option($opt.'after_hook', str_replace('\"', '', $_POST['after_hook']));
		// admin panel settings
		update_option($opt.'rtl_support', $_POST['rtl_support']);
		update_option($opt.'html_preview', $_POST['html_preview']);
		update_option($opt.'hide_if_logged', $_POST['hide_if_logged']);
		update_option($opt.'link_bar', $_POST['link_bar']);
		// affiliate program
		update_option($opt.'ap_cookie_lifetime', ($_POST['ap_cookie_lifetime'] >= 10) ? $_POST['ap_cookie_lifetime'] : 30);
		update_option($opt.'ap_commission', ($_POST['ap_commission'] >= 0 && $_POST['ap_commission'] <= 100) ? number_format($_POST['ap_commission'], 0, '', '') : 10);
		update_option($opt.'ap_minimum_withdrawal', ($_POST['ap_minimum_withdrawal'] >= 0) ? $_POST['ap_minimum_withdrawal'] : 50);
		// marketing agency
		update_option($opt.'private_ma', $_POST['private_ma']);
		update_option($opt.'agency_api_url', $_POST['agency_api_url']);
		update_option($opt.'agency_ordering_form_url', $_POST['agency_ordering_form_url']);
		update_option($opt.'agency_commission', $_POST['agency_commission']);
		update_option($opt.'agency_other_sites', $_POST['agency_other_sites']);
		update_option($opt.'agency_auto_accept', $_POST['agency_auto_accept']);
		update_option($opt.'agency_minimum_withdrawal', $_POST['agency_minimum_withdrawal']);
		// thumbnail settings
		update_option($opt.'thumb_size', $_POST['thumb_size']);
		update_option($opt.'thumb_w', $_POST['thumb_w']);
		update_option($opt.'thumb_h', $_POST['thumb_h']);
		// length of inputs
		update_option($opt.'max_title', 40);
		update_option($opt.'max_desc', 80);
		// form customization
		update_option($opt.'form_bg', $_POST['form_bg']);
		update_option($opt.'form_c', $_POST['form_c']);
		update_option($opt.'form_input_bg', $_POST['form_input_bg']);
		update_option($opt.'form_input_c', $_POST['form_input_c']);
		update_option($opt.'form_price_c', $_POST['form_price_c']);
		update_option($opt.'form_discount_bg', $_POST['form_discount_bg']);
		update_option($opt.'form_discount_c', $_POST['form_discount_c']);
		update_option($opt.'form_button_bg', $_POST['form_button_bg']);
		update_option($opt.'form_button_c', $_POST['form_button_c']);
		update_option($opt.'form_alert_c', $_POST['form_alert_c']);
		update_option($opt.'form_alert_success_bg', $_POST['form_alert_success_bg']);
		update_option($opt.'form_alert_failed_bg', $_POST['form_alert_failed_bg']);
		update_option($opt.'stats_views_line', $_POST['stats_views_line']);
		update_option($opt.'stats_clicks_line', $_POST['stats_clicks_line']);
		update_option($opt.'custom_css', stripslashes_deep($_POST['custom_css']));
		update_option($opt.'custom_js', stripslashes_deep($_POST['custom_js']));
		update_option($opt.'advanced_calendar', stripslashes_deep($_POST['advanced_calendar']));
		// affiliate program customization
		update_option($opt.'ap_custom', array(
			'general_bg' 		=> $_POST['general_bg'],
			'general_color' 	=> $_POST['general_color'],
			'commission_bg' 	=> $_POST['commission_bg'],
			'commission_color' 	=> $_POST['commission_color'],
			'balance_bg' 		=> $_POST['balance_bg'],
			'balance_color' 	=> $_POST['balance_color'],
			'link_color' 		=> $_POST['link_color'],
			'ref_bg' 			=> $_POST['ref_bg'],
			'ref_color' 		=> $_POST['ref_color'],
			'table_bg' 			=> $_POST['table_bg'],
			'table_color' 		=> $_POST['table_color']
		));
		file_put_contents(plugin_dir_path( __FILE__ ) . '/../frontend/js/custom.js', stripslashes_deep($_POST['custom_js']));

		echo '
		<div class="updated settings-error">
			<p><strong>Settings saved.</strong></p>
		</div>';

	} else {

		if( $_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'updateSettings' && $_POST["ordering_form_url"] == '' ||
			$_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'updateSettings' && $_POST["ordering_form_url"] == '#' ) {
			echo '
			<div class="updated settings-error">
				<p><strong>Note!</strong> URL to ordering form field is required because is used to display statistics!</p>
			</div>';
		}
	}
}

function bsa_pro_sub_menu_translations()
{
	?>
	<div class="wrap" style="display:none">
		<?php bsaUpdateTranslations(); ?>
		<?php require_once 'translations.php'; ?>
	</div>
<?php
}

function bsaUpdateTranslations()
{
	$opt_trans = 'bsa_pro_plugin_trans_';

	if( $_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'updateTranslations')
	{
		// Translations
		// agency ordering form
		update_option($opt_trans.'agency_title_form', stripslashes($_POST['agency_title_form']));
		update_option($opt_trans.'agency_back_button', stripslashes($_POST['agency_back_button']));
		update_option($opt_trans.'agency_visit_site', stripslashes($_POST['agency_visit_site']));
		update_option($opt_trans.'agency_buy_ad', stripslashes($_POST['agency_buy_ad']));
		// form left
		update_option($opt_trans.'form_left_header', stripslashes($_POST['form_left_header']));
		update_option($opt_trans.'form_left_select_space', stripslashes($_POST['form_left_select_space']));
		update_option($opt_trans.'form_left_email', stripslashes($_POST['form_left_email']));
		update_option($opt_trans.'form_left_eg_email', stripslashes($_POST['form_left_eg_email']));
		update_option($opt_trans.'form_left_title', stripslashes($_POST['form_left_title']));
		update_option($opt_trans.'form_left_eg_title', stripslashes($_POST['form_left_eg_title']));
		update_option($opt_trans.'form_left_desc', stripslashes($_POST['form_left_desc']));
		update_option($opt_trans.'form_left_eg_desc', stripslashes($_POST['form_left_eg_desc']));
		update_option($opt_trans.'form_left_url', stripslashes($_POST['form_left_url']));
		update_option($opt_trans.'form_left_eg_url', stripslashes($_POST['form_left_eg_url']));
		update_option($opt_trans.'form_left_thumb', stripslashes($_POST['form_left_thumb']));
		update_option($opt_trans.'form_left_calendar', stripslashes($_POST['form_left_calendar']));
		update_option($opt_trans.'form_left_eg_calendar', stripslashes($_POST['form_left_eg_calendar']));
		// form right
		update_option($opt_trans.'form_right_header', stripslashes($_POST['form_right_header']));
		update_option($opt_trans.'form_right_cpc_name', stripslashes($_POST['form_right_cpc_name']));
		update_option($opt_trans.'form_right_cpm_name', stripslashes($_POST['form_right_cpm_name']));
		update_option($opt_trans.'form_right_cpd_name', stripslashes($_POST['form_right_cpd_name']));
		update_option($opt_trans.'form_right_clicks', stripslashes($_POST['form_right_clicks']));
		update_option($opt_trans.'form_right_views', stripslashes($_POST['form_right_views']));
		update_option($opt_trans.'form_right_days', stripslashes($_POST['form_right_days']));
		update_option($opt_trans.'form_live_preview', stripslashes($_POST['form_live_preview']));
		update_option($opt_trans.'form_right_button_pay', stripslashes($_POST['form_right_button_pay']));
		// payments
		update_option($opt_trans.'payment_paid', stripslashes($_POST['payment_paid']));
		update_option($opt_trans.'payment_select', stripslashes($_POST['payment_select']));
		update_option($opt_trans.'payment_return', stripslashes($_POST['payment_return']));
		update_option($opt_trans.'payment_stripe_title', stripslashes($_POST['payment_stripe_title']));
		update_option($opt_trans.'payment_paypal_title', stripslashes($_POST['payment_paypal_title']));
		update_option($opt_trans.'payment_bank_transfer_title', stripslashes($_POST['payment_bank_transfer_title']));
		// alerts
		// success
		update_option($opt_trans.'alert_success', stripslashes($_POST['alert_success']));
		update_option($opt_trans.'form_success', stripslashes($_POST['form_success']));
		update_option($opt_trans.'payment_success', stripslashes($_POST['payment_success']));
		// failed
		update_option($opt_trans.'alert_failed', stripslashes($_POST['alert_failed']));
		update_option($opt_trans.'form_invalid_params', stripslashes($_POST['form_invalid_params']));
		update_option($opt_trans.'form_too_high', stripslashes($_POST['form_too_high']));
		update_option($opt_trans.'form_img_invalid', stripslashes($_POST['form_img_invalid']));
		update_option($opt_trans.'form_empty', stripslashes($_POST['form_empty']));
		update_option($opt_trans.'payment_failed', stripslashes($_POST['payment_failed']));
		// stats section
		update_option($opt_trans.'stats_header', stripslashes($_POST['stats_header']));
		update_option($opt_trans.'stats_views', stripslashes($_POST['stats_views']));
		update_option($opt_trans.'stats_clicks', stripslashes($_POST['stats_clicks']));
		update_option($opt_trans.'stats_ctr', stripslashes($_POST['stats_ctr']));
		update_option($opt_trans.'stats_prev_week', stripslashes($_POST['stats_prev_week']));
		update_option($opt_trans.'stats_next_week', stripslashes($_POST['stats_next_week']));
		// others
		update_option($opt_trans.'free_ads', stripslashes($_POST['free_ads']));
		// example ad
		update_option($opt_trans.'example_title', stripslashes($_POST['example_title']));
		update_option($opt_trans.'example_desc', stripslashes($_POST['example_desc']));
		update_option($opt_trans.'example_url', stripslashes($_POST['example_url']));
		// confirmation email
		update_option($opt_trans.'email_sender', stripslashes($_POST['email_sender']));
		update_option($opt_trans.'email_address', stripslashes($_POST['email_address']));
		// buyer email
		update_option($opt_trans.'buyer_subject', stripslashes($_POST['buyer_subject']));
		update_option($opt_trans.'buyer_message', stripslashes($_POST['buyer_message']));
		// seller email
		update_option($opt_trans.'seller_subject', stripslashes($_POST['seller_subject']));
		update_option($opt_trans.'seller_message', stripslashes($_POST['seller_message']));
		// affiliate program trans
		update_option($opt_trans.'affiliate_program', array(
			'commission' 		=> stripslashes($_POST['ap_commission']),
			'each_sale' 		=> stripslashes($_POST['ap_each_sale']),
			'balance' 			=> stripslashes($_POST['ap_balance']),
			'make' 				=> stripslashes($_POST['ap_make']),
			'ref_link' 			=> stripslashes($_POST['ap_ref_link']),
			'ref_notice' 		=> stripslashes($_POST['ap_ref_notice']),
			'ref_users' 		=> stripslashes($_POST['ap_ref_users']),
			'date' 				=> stripslashes($_POST['ap_date']),
			'buyer' 			=> stripslashes($_POST['ap_buyer']),
			'order' 			=> stripslashes($_POST['ap_order']),
			'comm_rate' 		=> stripslashes($_POST['ap_comm_rate']),
			'your_comm' 		=> stripslashes($_POST['ap_your_comm']),
			'empty' 			=> stripslashes($_POST['ap_empty']),
			'affiliate' 		=> stripslashes($_POST['ap_affiliate']),
			'earnings' 			=> stripslashes($_POST['ap_earnings']),
			'payment' 			=> stripslashes($_POST['ap_payment']),
			'button' 			=> stripslashes($_POST['ap_button']),
			'id' 				=> stripslashes($_POST['ap_id']),
			'user_id' 			=> stripslashes($_POST['ap_user_id']),
			'amount' 			=> stripslashes($_POST['ap_amount']),
			'account' 			=> stripslashes($_POST['ap_account']),
			'status' 			=> stripslashes($_POST['ap_status']),
			'pending' 			=> stripslashes($_POST['ap_pending']),
			'done' 				=> stripslashes($_POST['ap_done']),
			'rejected' 			=> stripslashes($_POST['ap_rejected']),
			'withdrawals' 		=> stripslashes($_POST['ap_withdrawals']),
			'success' 			=> stripslashes($_POST['ap_success']),
			'failed' 			=> stripslashes($_POST['ap_failed'])
		));
		do_action( 'bsa-pro-update-translations', $_POST, $opt_trans);
		echo '
		<div class="updated settings-error">
			<p><strong>Translations saved.</strong></p>
		</div>';
	}
}

function bsa_pro_sub_menu_users()
{
	?>
	<div class="wrap" style="display:none">
		<?php $model = new BSA_PRO_Model(); $model->getAdminAction() ?>
		<?php require_once 'users-manager.php'; ?>
	</div>
<?php
}

function bsa_pro_sub_menu_cron()
{
	?>
	<div class="wrap" style="display:none">
		<?php if ( get_option("bsa_pro_plugin_purchase_code") == '' || get_option("bsa_pro_plugin_purchase_code") == null ) {
			echo '
			<div class="updated settings-error">
				<p><strong>NOTE!</strong> Enter the <strong>purchase code</strong> in the settings to use all functions of ADS PRO! Thanks!</p>
			</div>';
		}
		$model = new BSA_PRO_Model(); $model->getAdminAction() ?>
		<?php require_once 'cron.php'; ?>
	</div>
<?php
}

function bsa_pro_sub_menu_ab_tests()
{
	?>
	<div class="wrap" style="display:none">
		<?php $model = new BSA_PRO_Model(); $model->getAdminAction() ?>
		<?php require_once 'ab-tests.php'; ?>
	</div>
<?php
}

function bsa_pro_sub_menu_affiliate()
{
	?>
	<div class="wrap" style="display:none">
		<?php $model = new BSA_PRO_Model(); $model->getAdminAction() ?>
		<?php require_once 'affiliate.php'; ?>
	</div>
<?php
}

function bsa_pro_sub_menu_updates()
{
	?>
	<div class="wrap" style="display:none">
		<?php $model = new BSA_PRO_Model(); $model->getAdminAction() ?>
		<?php require_once 'updates.php'; ?>
	</div>
<?php
}

function bsa_pro_create_menu()
{
	if ( is_multisite() && is_main_site() || !is_multisite() ) {
		$count = strlen(get_option('bsa_pro_plugin_purchase_code'));
		$icon_url = plugins_url('../frontend/img/bsa-icon.png', __FILE__);
		$role = ((bsa_role() == 'admin') ? 'a' : 'u');
		$affiliate_name = bsa_get_trans('affiliate_program', 'affiliate');
		add_menu_page('ADS PRO - Dashboard', 'ADS PRO', 'manage_options', 'bsa-pro-sub-menu', 'bsa_pro_head_menu', $icon_url, 100.77477);
		add_submenu_page('bsa-pro-sub-menu', 'Spaces and Ads', 'Spaces and Ads', 'manage_options', 'bsa-pro-sub-menu-spaces', 'bsa_pro_sub_menu_spaces');
		add_submenu_page('bsa-pro-sub-menu', 'Add new Space', 'Add new Space', 'manage_options', 'bsa-pro-sub-menu-add-new-space', 'bsa_pro_sub_menu_add_new_space');
		add_submenu_page('bsa-pro-sub-menu', 'Add new Ad', 'Add new Ad', 'read', 'bsa-pro-sub-menu-add-new-ad', 'bsa_pro_sub_menu_add_new_ad');
		if ($count == 36) {
			add_submenu_page('bsa-pro-sub-menu', 'Standard Ad Creator', 'Standard Ad Creator', 'manage_options', 'bsa-pro-sub-menu-creator', 'bsa_pro_sub_menu_creator');
			add_submenu_page('bsa-pro-sub-menu', 'Ads Schedule', 'Ads Schedule', 'manage_options', 'bsa-pro-sub-menu-cron', 'bsa_pro_sub_menu_cron');
			add_submenu_page('bsa-pro-sub-menu', 'A/B Tests', 'A/B Tests', 'manage_options', 'bsa-pro-sub-menu-ab-tests', 'bsa_pro_sub_menu_ab_tests');
			add_submenu_page('bsa-pro-sub-menu', (($role == 'a') ? 'Users Manager' : 'Your Ads'), (($role == 'a') ? 'Users Manager' : 'Your Ads'), 'read', 'bsa-pro-sub-menu-users', 'bsa_pro_sub_menu_users');
			if ( is_plugin_active( 'bsa-pro-ap-scripteo/bsa-pro-ap.php' ) ) {
				add_submenu_page('bsa-pro-sub-menu', (($affiliate_name != '') ? $affiliate_name : 'Affiliate Program'), (($affiliate_name != '') ? $affiliate_name : 'Affiliate Program'), 'read', 'bsa-pro-sub-menu-affiliate', 'bsa_pro_sub_menu_affiliate');
			}
		}
		add_submenu_page('bsa-pro-sub-menu', 'Settings', 'Settings', 'manage_options', 'bsa-pro-sub-menu-opts', 'bsa_pro_sub_menu_settings');
		add_submenu_page('bsa-pro-sub-menu', 'Translations', 'Translations', 'manage_options', 'bsa-pro-sub-menu-trans', 'bsa_pro_sub_menu_translations');
//	add_submenu_page('bsa-pro-sub-menu', 'Updates', 'Updates', 'manage_options', 'bsa-pro-sub-menu-upd', 'bsa_pro_sub_menu_updates');
	}
}
add_action('admin_menu', 'bsa_pro_create_menu');

function bsa_pro_pages_body_class( $classes ) {
	$classes[] = 'bsa_pro_pages_body_class';
	return $classes;
}
add_filter( 'admin_body_class ', 'bsa_pro_pages_body_class' );


class AdsProPagination
{
	const PAGE_SIZE = 40;

	private function getCount($list)
	{
		$model = new BSA_PRO_Model();

		if ( $list == 'users' ) {
			return count($model->getUsersList());
		} elseif ( $list == 'tasks' ) {
			return count($model->getCronTasks());
		} else {
			return self::PAGE_SIZE;
		}
	}

	public function getNext($list)
	{
		$page = $this->getPage();

		if ($page * self::PAGE_SIZE >= $this->getCount($list))
			return null;

		return $page + 1;
	}

	public function getPrev()
	{
		$page = $this->getPage();

		if ($page == 1)
			return null;

		return $page - 1;
	}

	private function getPage()
	{
		$page = abs(isset($_GET['pagination']) ? $_GET['pagination'] : 0);

		if ($page < 1)
			$page = 1;

		return $page;
	}

	public function getUsersPages()
	{
		$page = $this->getPage();

		$pages = array();
		$model = new BSA_PRO_Model();

		if ( $model->getUsersList($page, self::PAGE_SIZE) )
			foreach ($model->getUsersList($page, self::PAGE_SIZE) as $entry)
				$pages[] = $entry;

		if ($page > 1 and !count($pages)) {
			return 'not_found';
		}

		return $pages;
	}

	public function getTasksPages()
	{
		$page = $this->getPage();

		$pages = array();
		$model = new BSA_PRO_Model();

		if ( $model->getCronTasks(null, $page, self::PAGE_SIZE) )
			foreach ($model->getCronTasks(null, $page, self::PAGE_SIZE) as $entry)
				$pages[] = $entry;

		if ($page > 1 and !count($pages)) {
			return 'not_found';
		}

		return $pages;
	}
}