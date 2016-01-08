<?php
function getSpaceValue($val) {
	$ret = NULL;
	$ret = apply_filters( "bsa-pro-getspacevalue", $ret, ((isset($_GET['space_id'])) ? $_GET['space_id'] : null), $val);
	if($ret!=NULL) {
		return $ret;
	}
	if (isset($_GET['space_id'])) {
		if ( $val == 'cpc_contract_1' or $val == 'cpc_contract_2' or $val == 'cpc_contract_3' or
			$val == 'cpm_contract_1' or $val == 'cpm_contract_2' or $val == 'cpm_contract_3' or
			$val == 'cpd_contract_1' or $val == 'cpd_contract_2' or $val == 'cpd_contract_3') {
			if ( bsa_space($_GET['space_id'], $val) == '' or bsa_space($_GET['space_id'], $val) == 0 ) {
				return '0';
			} else {
				return bsa_space($_GET['space_id'], $val);
			}
		} else {
			return bsa_space($_GET['space_id'], $val);
		}
	} else {
		if ( isset($_POST[$val]) || isset($_SESSION['bsa_space_status']) ) {
			if ( isset($_SESSION['bsa_space_status']) == 'space_added' ) {
				$_SESSION['bsa_clear_form'] = 'space_added';
				unset($_SESSION['bsa_space_status']);
			}
			$status = (isset($_SESSION['bsa_clear_form']) ? $_SESSION['bsa_clear_form'] : '');
			if ( $status == 'space_added' ) {
				return '';
			} else {
				return $_POST[$val];
			}
		} else {
			return '';
		}
	}
}

function selectedSpaceOpt($optName, $optValue)
{
	if ( $optName == 'show_ads' || $optName == 'show_close_btn' || $optName == 'close_ads' ) {
		if ( isset( $_GET['space_id'] ) || isset( $_POST['show_ads'] ) && isset( $_POST['show_close_btn'] )&& isset( $_POST['close_ads'] ) ) {
			if ( isset( $_GET['space_id'] ) ) {
				$action = explode(',', (bsa_space($_GET['space_id'], 'close_action') != null ? bsa_space($_GET['space_id'], 'close_action') : '0,0,0'));
			} else {
				$action = explode(',', ($_POST['show_ads'] > 0 ? $_POST['show_ads'] : '0').','.($_POST['show_close_btn'] > 0 ? $_POST['show_close_btn'] : '0').','.($_POST['close_ads'] > 0 ? $_POST['close_ads'] : '0'));
			}
			if ( $optName == 'show_ads' ) {
				if ( isset($action[0]) && $action[0] == $optValue ) {
					echo 'selected="selected"';
				}
			} elseif ( $optName == 'show_close_btn' ) {
				if ( isset($action[1]) && $action[1] == $optValue ) {
					echo 'selected="selected"';
				}
			} elseif ( $optName == 'close_ads' ) {
				if ( isset($action[2]) && $action[2] == $optValue ) {
					echo 'selected="selected"';
				}
			}
		}
	} else {
		if ( isset( $_GET['space_id'] ) && bsa_space($_GET['space_id'], $optName) == $optValue || isset($_POST[$optName]) && $_POST[$optName] == $optValue ) {
			echo 'selected="selected"';
		}
	}
}

function checkedSpaceOpt($optName, $optValue)
{
	if( isset( $_GET['space_id'] ) && in_array($optValue, explode(',', bsa_space($_GET['space_id'], $optName))) OR isset($_POST[$optName]) && in_array($optValue, $_POST[$optName]) ) {
		echo 'checked="checked"';
	}
}
?>
<h2>
	<?php if ( isset($_GET['space_id']) ): ?>
		<span class="dashicons dashicons-edit"></span> Edit <strong>Space ID <?php echo $_GET['space_id']; ?></strong>
		<p><span class="dashicons dashicon-14 dashicons-arrow-left-alt"></span> <a href="<?php echo admin_url(); ?>admin.php?page=bsa-pro-sub-menu-spaces<?php echo ((isset( $_GET['space_id'] )) ? '&space_id='.$_GET['space_id'] : null) ?>">back to <strong>spaces / ads list</strong></a></p>
	<?php else: ?>
		<span class="dashicons dashicons-plus-alt"></span> Add new Space
		<p><span class="dashicons dashicon-14 dashicons-arrow-left-alt"></span> <a href="<?php echo admin_url(); ?>admin.php?page=bsa-pro-sub-menu-spaces">back to <strong>spaces / ads list</strong></a></p>
	<?php endif; ?>
</h2>

<?php if ( isset($_GET['space_id']) && bsa_space($_GET['space_id'], 'id') != NULL || !isset($_GET['space_id']) ): ?>

<form action="" method="post" enctype="multipart/form-data">
	<?php if ( isset($_GET['space_id']) ): ?>
		<input type="hidden" value="updateSpace" name="bsaProAction">
	<?php else: ?>
		<input type="hidden" value="addNewSpace" name="bsaProAction">
	<?php endif; ?>
	<table class="bsaAdminTable bsaSpaces form-table">
		<tbody class="bsaTbody">
			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-welcome-widgets-menus"></span> Space Settings</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_status">Status</label></th>
				<td>
					<select id="bsa_pro_status" name="status">
						<option value="active" <?php selectedSpaceOpt('status', 'active'); ?>>active</option>
						<option value="inactive" <?php selectedSpaceOpt('status', 'inactive'); ?>>inactive</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_name">Space Name (used in ordering form)</label></th>
				<td>
					<input type="text" class="regular-text code" maxlength="255" value="<?php echo getSpaceValue('name') ?>"
						   id="bsa_pro_name" name="name" placeholder="Sidebar Ad Section">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_title">Space Title (shows in space)</label></th>
				<td>
					<input type="text" class="regular-text code" maxlength="255" value="<?php echo getSpaceValue('title') ?>"
						   id="bsa_pro_title" name="title" placeholder="Featured section">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_add_new">Add Button (shows in space)</label></th>
				<td>
					<input type="text" class="regular-text code" maxlength="255" value="<?php echo getSpaceValue('add_new') ?>"
						   id="bsa_pro_add_new" name="add_new" placeholder="add advertising here">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_cpc_price">Billing Models</label></th>
				<td>
					<p class="description"><strong>NOTE!</strong> Price for 1st contract is enough because prices for other contracts will be generated in automatically containing discount.</p>

					<div class="billing-col">
						<h3>CPC - Cost per Click</h3>

						<label for="bsa_pro_cpc_price" class="billing-label"><strong>CPC Price</strong> (contract 1st)</label>
						<?php if ( get_option('bsa_pro_plugin_'.'symbol_position') == 'before' ): echo get_option('bsa_pro_plugin_'.'currency_symbol'); endif; ?>
						<input type="text" class="regular-text code billing-input" id="bsa_pro_cpc_price" name="cpc_price"
							   maxlength="10" value="<?php echo (getSpaceValue('cpc_price') >= 0) ? bsa_number_format(getSpaceValue('cpc_price')) : getSpaceValue('cpc_price') ; ?>" placeholder="1.00">
						<?php if ( get_option('bsa_pro_plugin_'.'symbol_position') == 'after' ): echo get_option('bsa_pro_plugin_'.'currency_symbol'); endif; ?>
						<br>

						<label for="bsa_pro_cpc_contract_1" class="billing-label"><strong>Contract 1st</strong> (target clicks)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpc_contract_1" name="cpc_contract_1"
							   maxlength="10" value="<?php echo getSpaceValue('cpc_contract_1') ?>" placeholder="10"> clicks
						<br>

						<label for="bsa_pro_cpc_contract_2" class="billing-label"><strong>Contract 2nd</strong> (target clicks)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpc_contract_2" name="cpc_contract_2"
							   maxlength="10" value="<?php echo getSpaceValue('cpc_contract_2') ?>" placeholder="100"> clicks
						<br>

						<label for="bsa_pro_cpc_contract_3" class="billing-label"><strong>Contract 3rd</strong> (target clicks)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpc_contract_3" name="cpc_contract_3"
							   maxlength="10" value="<?php echo getSpaceValue('cpc_contract_3') ?>" placeholder="1000"> clicks

						<?php do_action( 'bsa-pro-addcontract', 'cpc' ); ?>
					</div>

					<div class="billing-col">
						<h3>CPM - Cost per Mille (Views)</h3>

						<label for="bsa_pro_cpm_price" class="billing-label"><strong>CPM Price</strong> (contract 1st)</label>
						<?php if ( get_option('bsa_pro_plugin_'.'symbol_position') == 'before' ): echo get_option('bsa_pro_plugin_'.'currency_symbol'); endif; ?>
						<input type="text" class="regular-text code billing-input" id="bsa_pro_cpm_price" name="cpm_price"
							   maxlength="10" value="<?php echo (getSpaceValue('cpm_price') >= 0) ? bsa_number_format(getSpaceValue('cpm_price')) : getSpaceValue('cpm_price') ; ?>" placeholder="1.00">
						<?php if ( get_option('bsa_pro_plugin_'.'symbol_position') == 'after' ): echo get_option('bsa_pro_plugin_'.'currency_symbol'); endif; ?>
						<br>

						<label for="bsa_pro_cpm_contract_1" class="billing-label"><strong>Contract 1st</strong> (target views)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpm_contract_1" name="cpm_contract_1"
							   maxlength="10" value="<?php echo getSpaceValue('cpm_contract_1') ?>" placeholder="1000"> views
						<br>

						<label for="bsa_pro_cpm_contract_2" class="billing-label"><strong>Contract 2nd</strong> (target views)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpm_contract_2" name="cpm_contract_2"
							   maxlength="10" value="<?php echo getSpaceValue('cpm_contract_2') ?>" placeholder="10000"> views
						<br>

						<label for="bsa_pro_cpm_contract_3" class="billing-label"><strong>Contract 3rd</strong> (target views)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpm_contract_3" name="cpm_contract_3"
							   maxlength="10" value="<?php echo getSpaceValue('cpm_contract_3') ?>" placeholder="100000"> views

						<?php do_action( 'bsa-pro-addcontract', 'cpm' ); ?>
					</div>

					<div class="billing-col">
						<h3>CPD - Cost per Days</h3>

						<label for="bsa_pro_cpd_price" class="billing-label"><strong>CPD Price</strong> (contract 1st)</label>
						<?php if ( get_option('bsa_pro_plugin_'.'symbol_position') == 'before' ): echo get_option('bsa_pro_plugin_'.'currency_symbol'); endif; ?>
						<input type="text" class="regular-text code billing-input" id="bsa_pro_cpd_price" name="cpd_price"
							   maxlength="10" value="<?php echo (getSpaceValue('cpd_price') >= 0) ? bsa_number_format(getSpaceValue('cpd_price')) : getSpaceValue('cpd_price') ; ?>" placeholder="1.00">
						<?php if ( get_option('bsa_pro_plugin_'.'symbol_position') == 'after' ): echo get_option('bsa_pro_plugin_'.'currency_symbol'); endif; ?>
						<br>

						<label for="bsa_pro_cpd_contract_1" class="billing-label"><strong>Contract 1st</strong> (target days)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpd_contract_1" name="cpd_contract_1"
							   maxlength="10" value="<?php echo getSpaceValue('cpd_contract_1') ?>" placeholder="30"> days
						<br>

						<label for="bsa_pro_cpd_contract_2" class="billing-label"><strong>Contract 2nd</strong> (target days)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpd_contract_2" name="cpd_contract_2"
							   maxlength="10" value="<?php echo getSpaceValue('cpd_contract_2') ?>" placeholder="60"> days
						<br>

						<label for="bsa_pro_cpd_contract_3" class="billing-label"><strong>Contract 3rd</strong> (target days)</label>
						<input type="number" class="regular-text code billing-input" id="bsa_pro_cpd_contract_3" name="cpd_contract_3"
							   maxlength="10" value="<?php echo getSpaceValue('cpd_contract_3') ?>" placeholder="90"> days

						<?php do_action( 'bsa-pro-addcontract', 'cpd' ); ?>
					</div>
					<?php do_action( 'bsa-pro-addbilling' ); ?>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="bsa_pro_discount_2">Discount (contract <strong>2nd</strong>)</label>
				</th>
				<td>
					<input type="number" class="regular-text code" id="bsa_pro_discount_2" name="discount_2"
						   maxlength="2" value="<?php echo getSpaceValue('discount_2') ?>" placeholder="10"> <em>%</em>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="bsa_pro_discount_3">Discount (contract <strong>3rd</strong>)</label>
				</th>
				<td>
					<input type="number" class="regular-text code" id="bsa_pro_discount_3" name="discount_3"
						   maxlength="2" value="<?php echo getSpaceValue('discount_3') ?>" placeholder="25"> <em>%</em>
				</td>
			</tr>

			<tr>
				<th colspan="2">
					<h3><span class="dashicons dashicons-admin-appearance"></span> Space Layout Settings</h3>
				</th>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_grid_system">Grid System</label></th>
				<td>
					<select id="bsa_pro_grid_system" name="grid_system">
						<option value="bsaGridGutter" <?php selectedSpaceOpt('grid_system', 'bsaGridGutter'); ?>>Grid with Gutter between Ads</option>
						<option value="bsaGridGutVer" <?php selectedSpaceOpt('grid_system', 'bsaGridGutVer'); ?>>Grid with Vertical Gutter between Ads</option>
						<option value="bsaGridGutHor" <?php selectedSpaceOpt('grid_system', 'bsaGridGutHor'); ?>>Grid with Horizontal Gutter between Ads</option>
						<option value="bsaGridNoGutter" <?php selectedSpaceOpt('grid_system', 'bsaGridNoGutter'); ?>>Grid without Gutter between Ads</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_template">Template</label></th>
				<td>
					<select id="bsa_pro_template" name="template" onchange="bsaGetTemplate()">
						<?php

						$styles = array();
						foreach (glob(plugin_dir_path( __FILE__ )."../frontend/template/*") as $file) {
							$files = $file;
							$styles = explode('/',$files);
							$style = array_reverse($styles);
							$name = explode('.', $style[0]);
							if ($name[0] != 'asset') {
								?>
								<option value="<?php echo $name[0]; ?>" <?php selectedSpaceOpt('template', $name[0]); ?>> <?php echo ucfirst ( str_replace('-',' ',$name[0]) ); ?></option>
							<?php
							}
						}

						?>
					</select>

					<h3>Ad Live Preview <span class="bsaLoader" style="display:none;"></span></h3>
					<div class="bsaTemplatePreview">
						<div class="bsaTemplatePreviewInner"></div>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_display_type">Display Type</label></th>
				<td>
					<select id="bsa_pro_display_type" name="display_type">
						<option value="default" <?php selectedSpaceOpt('display_type', 'default'); ?>>default</option>
						<option value="carousel" <?php selectedSpaceOpt('display_type', 'carousel'); ?>>carousel - slider</option>
						<option value="top_scroll_bar" <?php selectedSpaceOpt('display_type', 'top_scroll_bar'); ?>>top scroll bar</option>
						<option value="bottom_scroll_bar" <?php selectedSpaceOpt('display_type', 'bottom_scroll_bar'); ?>>bottom scroll bar</option>
						<option value="floating-bottom-right" <?php selectedSpaceOpt('display_type', 'floating-bottom-right'); ?>>floating - bottom right</option>
						<option value="floating-bottom-left" <?php selectedSpaceOpt('display_type', 'floating-bottom-left'); ?>>floating - bottom left</option>
						<option value="floating-top-right" <?php selectedSpaceOpt('display_type', 'floating-top-right'); ?>>floating - top right</option>
						<option value="floating-top-left" <?php selectedSpaceOpt('display_type', 'floating-top-left'); ?>>floating - top left</option>
						<option value="popup" <?php selectedSpaceOpt('display_type', 'popup'); ?>>pop-up</option>
						<option value="corner" <?php selectedSpaceOpt('display_type', 'corner'); ?>>corner peel</option>
						<option value="layer" <?php selectedSpaceOpt('display_type', 'layer'); ?>>layer</option>
						<option value="background" <?php selectedSpaceOpt('display_type', 'background'); ?>>background</option>
						<option value="exit_popup" <?php selectedSpaceOpt('display_type', 'exit_popup'); ?>>exit pop-up</option>
						<option value="link" <?php selectedSpaceOpt('display_type', 'link'); ?>>link</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">Show Ads Randomly</th>
				<td>
					<fieldset>
						<label title="show all ads in space"><input type="radio" <?php if(!isset( $_GET['space_id'] ) or bsa_space($_GET['space_id'], 'random') == 0) { echo 'checked="checked"'; } ?>value="0" name="random"> <strong>no</strong>, show all ads in space</label><br>
						<label title="show randomly ads in one row"><input type="radio" <?php if(isset( $_GET['space_id'] ) && bsa_space($_GET['space_id'], 'random') == 1) { echo 'checked="checked"'; } ?> value="1" name="random"> <strong>yes</strong>, show randomly ads in one row</label>
					</fieldset>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_max_items">Maximum Ads in Space</label></th>
				<td>
					<select id="bsa_pro_max_items" name="max_items">
						<?php
						for ($i = 1; $i <= 24; $i++) {
							echo $i;
							?>
							<option value="<?php echo $i; ?>" <?php selectedSpaceOpt('max_items', $i); ?>> <?php echo $i; ?> item<?php if($i != 1) { echo 's'; } ?></option>
						<?php
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_col_per_row">Number of Ads per Row (columns per row)</label></th>
				<td>
					<select id="bsa_pro_col_per_row" name="col_per_row">
						<?php

						for ($i = 1; $i <= 12; $i++) {
							echo $i;
							if ( $i <= 4 || $i == 8 || $i == 12 ) {
								?>
								<option value="<?php echo $i; ?>" <?php selectedSpaceOpt('col_per_row', $i); ?>> <?php echo $i; ?> <?php if($i == 1) { echo 'column'; } else { echo 'columns'; } ?></option>
							<?php
							}
						}

						?>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_animation">Ads Animation if visible</label></th>
				<td>
					<select id="bsa_pro_animation" name="animation">
						<option value="none" <?php selectedSpaceOpt('animation', 'none'); ?>>none</option>
						<optgroup label="Attention Seekers">
							<option value="bounce" <?php selectedSpaceOpt('animation', 'bounce'); ?>>bounce</option>
							<option value="flash" <?php selectedSpaceOpt('animation', 'flash'); ?>>flash</option>
							<option value="pulse" <?php selectedSpaceOpt('animation', 'pulse'); ?>>pulse</option>
							<option value="rubberBand" <?php selectedSpaceOpt('animation', 'rubberBand'); ?>>rubberBand</option>
							<option value="shake" <?php selectedSpaceOpt('animation', 'shake'); ?>>shake</option>
							<option value="swing" <?php selectedSpaceOpt('animation', 'swing'); ?>>swing</option>
							<option value="tada" <?php selectedSpaceOpt('animation', 'tada'); ?>>tada</option>
							<option value="wobble" <?php selectedSpaceOpt('animation', 'wobble'); ?>>wobble</option>
						</optgroup>

						<optgroup label="Bouncing Entrances">
							<option value="bounceIn" <?php selectedSpaceOpt('animation', 'bounceIn'); ?>>bounceIn</option>
							<option value="bounceInDown" <?php selectedSpaceOpt('animation', 'bounceInDown'); ?>>bounceInDown</option>
							<option value="bounceInLeft" <?php selectedSpaceOpt('animation', 'bounceInLeft'); ?>>bounceInLeft</option>
							<option value="bounceInRight" <?php selectedSpaceOpt('animation', 'bounceInRight'); ?>>bounceInRight</option>
							<option value="bounceInUp" <?php selectedSpaceOpt('animation', 'bounceInUp'); ?>>bounceInUp</option>
						</optgroup>

						<optgroup label="Fading Entrances">
							<option value="fadeIn" <?php selectedSpaceOpt('animation', 'fadeIn'); ?>>fadeIn</option>
							<option value="fadeInDown" <?php selectedSpaceOpt('animation', 'fadeInDown'); ?>>fadeInDown</option>
							<option value="fadeInDownBig" <?php selectedSpaceOpt('animation', 'fadeInDownBig'); ?>>fadeInDownBig</option>
							<option value="fadeInLeft" <?php selectedSpaceOpt('animation', 'fadeInLeft'); ?>>fadeInLeft</option>
							<option value="fadeInLeftBig" <?php selectedSpaceOpt('animation', 'fadeInLeftBig'); ?>>fadeInLeftBig</option>
							<option value="fadeInRight" <?php selectedSpaceOpt('animation', 'fadeInRight'); ?>>fadeInRight</option>
							<option value="fadeInRightBig" <?php selectedSpaceOpt('animation', 'fadeInRightBig'); ?>>fadeInRightBig</option>
							<option value="fadeInUp" <?php selectedSpaceOpt('animation', 'fadeInUp'); ?>>fadeInUp</option>
							<option value="fadeInUpBig" <?php selectedSpaceOpt('animation', 'fadeInUpBig'); ?>>fadeInUpBig</option>
						</optgroup>

						<optgroup label="Flippers">
							<option value="flip" <?php selectedSpaceOpt('animation', 'flip'); ?>>flip</option>
							<option value="flipInX" <?php selectedSpaceOpt('animation', 'flipInX'); ?>>flipInX</option>
							<option value="flipInY" <?php selectedSpaceOpt('animation', 'flipInY'); ?>>flipInY</option>
						</optgroup>

						<optgroup label="Lightspeed">
							<option value="lightSpeedIn" <?php selectedSpaceOpt('animation', 'lightSpeedIn'); ?>>lightSpeedIn</option>
						</optgroup>

						<optgroup label="Rotating Entrances">
							<option value="rotateIn" <?php selectedSpaceOpt('animation', 'rotateIn'); ?>>rotateIn</option>
							<option value="rotateInDownLeft" <?php selectedSpaceOpt('animation', 'rotateInDownLeft'); ?>>rotateInDownLeft</option>
							<option value="rotateInDownRight" <?php selectedSpaceOpt('animation', 'rotateInDownRight'); ?>>rotateInDownRight</option>
							<option value="rotateInUpLeft" <?php selectedSpaceOpt('animation', 'rotateInUpLeft'); ?>>rotateInUpLeft</option>
							<option value="rotateInUpRight" <?php selectedSpaceOpt('animation', 'rotateInUpRight'); ?>>rotateInUpRight</option>
						</optgroup>

						<optgroup label="Specials">
							<option value="hinge" <?php selectedSpaceOpt('animation', 'hinge'); ?>>hinge</option>
							<option value="rollIn" <?php selectedSpaceOpt('animation', 'rollIn'); ?>>rollIn</option>
						</optgroup>

						<optgroup label="Zoom Entrances">
							<option value="zoomIn" <?php selectedSpaceOpt('animation', 'zoomIn'); ?>>zoomIn</option>
							<option value="zoomInDown" <?php selectedSpaceOpt('animation', 'zoomInDown'); ?>>zoomInDown</option>
							<option value="zoomInLeft" <?php selectedSpaceOpt('animation', 'zoomInLeft'); ?>>zoomInLeft</option>
							<option value="zoomInRight" <?php selectedSpaceOpt('animation', 'zoomInRight'); ?>>zoomInRight</option>
							<option value="zoomInUp" <?php selectedSpaceOpt('animation', 'zoomInUp'); ?>>zoomInUp</option>
						</optgroup>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_devices">Show in specific devices</label></th>
				<td>
					<ul id="inside-hide-countries" data-wp-lists="list:countries" class="countrieschecklist form-no-clear">
						<li class="bsaProSpecificDevice">
							<label class="selectit">
								<input value="mobile" type="checkbox" name="devices[]" <?php checkedSpaceOpt('devices', 'mobile'); ?>><br><br>
								<img src="<?php echo plugins_url('/bsa-pro-scripteo/frontend/img/icon-mobile.png'); ?>"/><br>
								Mobile
							</label>
						</li>
						<li class="bsaProSpecificDevice">
							<label class="selectit">
								<input value="tablet" type="checkbox" name="devices[]" <?php checkedSpaceOpt('devices', 'tablet'); ?>><br><br>
								<img src="<?php echo plugins_url('/bsa-pro-scripteo/frontend/img/icon-tablet.png'); ?>"/><br>
								Tablet
							</label>
						</li>
						<li class="bsaProSpecificDevice">
							<label class="selectit">
								<input value="desktop" type="checkbox" name="devices[]" <?php checkedSpaceOpt('devices', 'desktop'); ?>><br><br>
								<img src="<?php echo plugins_url('/bsa-pro-scripteo/frontend/img/icon-desktop.png'); ?>"/><br>
								Desktop
							</label>
						</li>
					</ul>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_show_ads">Show Ad Space after X seconds</label></th>
				<td>
					<select id="bsa_pro_show_ads" name="show_ads">
						<?php

						for ($i = 0; $i <= 250; $i++) {
							echo $i;
							if ( $i <= 10 || $i == 15 || $i == 20 || $i == 25 || $i == 30 || $i == 40 || $i == 50 || $i == 75 || $i == 100 || $i == 125 || $i == 150 || $i == 200 || $i == 250 ) {
								?>
								<option value="<?php echo $i; ?>" <?php selectedSpaceOpt('show_ads', $i); ?>> <?php echo $i; ?> <?php if($i == 1) { echo 'second'; } else { echo 'seconds'; } ?></option>
							<?php
							}
						}

						?>
					</select>
					<p class="description">You can use it for <strong>default, carousel, sliding bar, floating, pop-up, corner peel, layer</strong> and <strong>pop-up</strong> display types.</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_show_close_btn">Show Close Button after X seconds</label></th>
				<td>
					<select id="bsa_pro_show_close_btn" name="show_close_btn">
						<?php

						for ($i = 0; $i <= 60; $i++) {
							echo $i;
							if ( $i <= 10 || $i == 15 || $i == 20 || $i == 25 || $i == 30 || $i == 40 || $i == 50 || $i == 60 ) {
								?>
								<option value="<?php echo $i; ?>" <?php selectedSpaceOpt('show_close_btn', $i); ?>> <?php echo $i; ?> <?php if($i == 1) { echo 'second'; } else { echo 'seconds'; } ?></option>
							<?php
							}
						}

						?>
					</select>
					<p class="description">You can use it for <strong>sliding bar, floating, layer</strong> and <strong>pop-up</strong> display types.</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="bsa_pro_close_ads">Close Ad Space after X seconds</label></th>
				<td>
					<select id="bsa_pro_close_ads" name="close_ads">
						<?php

						for ($i = 0; $i <= 250; $i++) {
							echo $i;
							if ( $i <= 10 || $i == 15 || $i == 20 || $i == 25 || $i == 30 || $i == 40 || $i == 50 || $i == 75 || $i == 100 || $i == 125 || $i == 150 || $i == 200 || $i == 250 ) {
								?>
								<option value="<?php echo $i; ?>" <?php selectedSpaceOpt('close_ads', $i); ?>> <?php echo $i; ?> <?php if($i == 1) { echo 'second'; } else { echo 'seconds'; } ?></option>
							<?php
							}
						}

						?>
					</select>
					<p class="description">You can use it for <strong>default, carousel, sliding bar, floating, corner peel, layer</strong> and <strong>pop-up</strong> display types.</p>
				</td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row">Displays only for specific <br>Categories / Tags</th>
				<td class="bsaLast">
					<div id="bsaShowSpecific" style="max-width: 400px;">
						<div class="inside">
							<div id="taxonomy-category" class="categorydiv">
								<ul id="category-tabs" class="category-tabs">
									<li class="tabs bsaProTab" data-tab="bsaAllCategories"><a href="#bsaShowSpecific">Select Categories</a></li>
									<li class="bsaProTab" data-tab="bsaAllTags"><a href="#bsaShowSpecific">Select Tags</a></li>
								</ul>

								<div class="bsaAllTags tabs-panel" style="display: none;">
									<ul id="inside-list-tags" class="categorychecklist form-no-clear">
										<?php
										if ( is_multisite() ) {

											// Current Site
											$current = get_current_site();

											// All Sites
											$blogs = wp_get_sites();

											foreach ( $blogs as $blog ) {

												// switch to the blog
												switch_to_blog( $blog['blog_id'] );

												// get_categories args
												$args = array(
													'hide_empty' => true
												);

												$posttags = get_tags();
												if ($posttags) {
													foreach($posttags as $tag) {
														?>
														<li class="bsaProSpecificItem">
															<label class="selectit"><input value="<?php echo $tag->name; ?>" type="checkbox" name="space_tags[]" <?php checkedSpaceOpt('has_tags', $tag->name); ?>>
																<?php echo $tag->name; ?> (site id: <?php echo $blog['blog_id']; ?>)</label>
														</li>
													<?php
													}
												}

											}

											// return to the current site
											switch_to_blog( $current->id );

										} else {

											$posttags = get_tags();
											if ($posttags) {
												foreach($posttags as $tag) {
													?>
													<li class="bsaProSpecificItem">
														<label class="selectit"><input value="<?php echo $tag->name; ?>" type="checkbox" name="space_tags[]" <?php checkedSpaceOpt('has_tags', $tag->name); ?>>
															<?php echo $tag->name; ?></label>
													</li>
												<?php
												}
											}

										}
										?>
									</ul>
								</div>

								<div class="bsaAllCategories tabs-panel" style="display: block;">
									<ul id="inside-list-categories" data-wp-lists="list:category" class="categorychecklist form-no-clear">
										<?php
										if ( is_multisite() ) {

											// Current Site
											$current = get_current_site();

											// All Sites
											$blogs = wp_get_sites();

											foreach ( $blogs as $blog ) {

												// switch to the blog
												switch_to_blog( $blog['blog_id'] );

												// get_categories args
												$args = array(
													'hide_empty' => true
												);

												$postcategories = get_categories();
												if ($postcategories) {
													foreach($postcategories as $postcategory) {
														?>
														<li class="bsaProSpecificItem">
															<label class="selectit"><input value="<?php echo $postcategory->term_id; ?>" type="checkbox" name="space_categories[]" <?php checkedSpaceOpt('in_categories', $postcategory->term_id); ?>>
																<?php echo $postcategory->name; ?> (site id: <?php echo $blog['blog_id']; ?>)</label>
														</li>
													<?php
													}
												}

											}

											// return to the current site
											switch_to_blog( $current->id );

										} else {

											$postcategories = get_categories();
											if ($postcategories) {
												foreach($postcategories as $postcategory) {
													?>
													<li class="bsaProSpecificItem">
														<label class="selectit"><input value="<?php echo $postcategory->term_id; ?>" type="checkbox" name="space_categories[]" <?php checkedSpaceOpt('in_categories', $postcategory->term_id); ?>>
															<?php echo $postcategory->name; ?></label>
													</li>
												<?php
												}
											}

										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<th class="bsaLast" scope="row">Show / Hide in specific <br>Countries</th>
				<td class="bsaLast">
					<div id="bsaShowSpecific" style="max-width: 400px;">
						<div class="inside">
							<div id="taxonomy-category" class="categorydiv">
								<ul id="category-tabs" class="category-tabs">
									<li class="tabs bsaProTabCountry" data-tab="bsaShowCountries"><a href="#inside-show-countries">Show in Countries</a></li>
									<li class="bsaProTabCountry" data-tab="bsaHideCountries"><a href="#inside-hide-countries">Hide in Countries</a></li>
									<li class="bsaProTabCountry" data-tab="bsaAdvanced"><a href="#inside-advanced">Advanced</a></li>
								</ul>

								<div id="bsaAdvanced" class="bsaAdvanced tabs-panel" style="display: none;">
									<ul id="inside-advanced" data-wp-lists="list:countries" class="countrieschecklist form-no-clear">
										<li class="bsaProSpecificItem">
											<div style="margin-bottom: 10px"><strong>Show</strong> in states / provinces, cities or zip-codes</div>
											<input type="text" class="regular-text code" id="show_in_advanced" name="show_in_advanced"
												   value="<?php echo getSpaceValue('show_in_advanced') ?>" placeholder="Boston,Los Angeles,New York">
										</li>
										<li class="bsaProSpecificItem">
											<div style="margin: 10px 0"><strong>Hide</strong> in states / provinces, cities or zip-codes</div>
											<input type="text" class="regular-text code" id="hide_in_advanced" name="hide_in_advanced"
												   value="<?php echo getSpaceValue('hide_in_advanced') ?>" placeholder="London,Glasgow">
										</li>
										<li>
											<br><strong>Note!</strong><br>
											We recommend to use Advanced options really carefully. Introduced rules can really restrict your ads. Also remember that Internet Providers don't always show the real position of the user (it all depends on the panel to which is attached).
											<br><br>
											Every rule should be separated by a comma without spaces (e.g. London,Glasgow).
										</li>
									</ul>
								</div>

								<div id="bsaHideCountries" class="bsaHideCountries tabs-panel" style="display: none;">
									<ul id="inside-hide-countries" data-wp-lists="list:countries" class="countrieschecklist form-no-clear">
										<?php
										$postcategories = bsa_get_country_codes();
										if ($postcategories) {
											foreach($postcategories as $postcategory) {
												?>
												<li class="bsaProSpecificItem">
													<label class="selectit"><input value="<?php echo $postcategory['Code']; ?>" type="checkbox" name="hide_in_country[]" <?php checkedSpaceOpt('hide_in_country', $postcategory['Code']); ?>>
														<?php echo $postcategory['Name']; ?></label>
												</li>
											<?php
											}
										}
										?>
									</ul>
								</div>

								<div id="bsaShowCountries" class="bsaShowCountries tabs-panel" style="display: block;">
									<ul id="inside-show-countries" data-wp-lists="list:countries" class="countrieschecklist form-no-clear">
										<?php
										$postcategories = bsa_get_country_codes();
										if ($postcategories) {
											foreach($postcategories as $postcategory) {
												?>
												<li class="bsaProSpecificItem">
													<label class="selectit"><input value="<?php echo $postcategory['Code']; ?>" type="checkbox" name="show_in_country[]" <?php checkedSpaceOpt('show_in_country', $postcategory['Code']); ?>>
														<?php echo $postcategory['Name']; ?></label>
												</li>
											<?php
											}
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<?php if ( get_option('bsa_pro_plugin_calendar') == 'yes' ): ?>
			<tr>
				<th scope="row"><label for="bsa_pro_unavailable_dates">Unavailable Dates in Calendar</label></th>
				<td>
					<input type="text" class="regular-text code" maxlength="1000" value="<?php echo getSpaceValue('unavailable_dates') ?>"
						   id="bsa_pro_unavailable_dates" name="unavailable_dates" placeholder="2015-10-17,2015-10-21">
					<p class="description"><strong>Example</strong> 2015-10-17,2015-10-21,2015-10-24</p>
				</td>
			</tr>
			<?php endif; ?>
			<tr>
				<th>Customization</th>
				<td>
					<div id="postbox-container-1" class="postbox-container">
						<div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
							<div id="bsaSpaceCustomization" class="postbox closed">
								<div class="handlediv bsaSpaceCustomization" title="Click to toggle"><br></div><p class="hndle ui-sortable-handle bsaSpaceCustomization" style="margin: 0; padding: 10px; cursor: pointer;"><span>Options</span></p>
								<div class="inside">
									<table>
										<tbody>
										<tr>
											<th scope="row"><label for="bsa_pro_font">Google Font</label></th>
											<td>
												<input type="text" class="regular-text code" value="<?php echo str_replace("\\'", "", getSpaceValue('font')) ?>" id="bsa_pro_font" name="font">
												<p class="description">
													Example: <strong>font-family: 'Open Sans', sans-serif;</strong><br>
													Choose from 650+ fonts available here <a href="https://www.google.com/fonts" target="_blank">https://www.google.com/fonts</a>
												</p>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_font_url">Google Font URL</label></th>
											<td>
												<input type="text" class="regular-text code" value="<?php echo getSpaceValue('font_url') ?>" id="bsa_pro_font_url" name="font_url">
												<p class="description">Example: <strong>@import url(http://fonts.googleapis.com/css?family=Open+Sans);</strong></p>
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_header_bg">Header Background</label></th>
											<td>
												<input id="bsa_pro_header_bg"
													   name="header_bg"
													   value="<?php echo getSpaceValue('header_bg') ?>"
													   data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_header_color">Header Color</label></th>
											<td>
												<input id="bsa_pro_header_color"
													   name="header_color"
													   value="<?php echo getSpaceValue('header_color') ?>"
													   data-default-color="#000000" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_link_color">Header Link Color</label></th>
											<td>
												<input id="bsa_pro_link_color"
													   name="link_color"
													   value="<?php echo getSpaceValue('link_color') ?>"
													   data-default-color="#000000" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_ads_bg">Ads Whole Section Background</label></th>
											<td>
												<input id="bsa_pro_ads_bg"
													   name="ads_bg"
													   value="<?php echo getSpaceValue('ads_bg') ?>"
													   data-default-color="#f5f5f5" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_ad_bg">Ad Background</label></th>
											<td>
												<input id="bsa_pro_ad_bg"
													   name="ad_bg"
													   value="<?php echo getSpaceValue('ad_bg') ?>"
													   data-default-color="#f5f5f5" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_ad_title_color">Ad Title Color</label></th>
											<td>
												<input id="bsa_pro_ad_title_color"
													   name="ad_title_color"
													   value="<?php echo getSpaceValue('ad_title_color') ?>"
													   data-default-color="#000000" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_ad_desc_color">Ad Description Color</label></th>
											<td>
												<input id="bsa_pro_ad_desc_color"
													   name="ad_desc_color"
													   value="<?php echo getSpaceValue('ad_desc_color') ?>"
													   data-default-color="#000000" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_ad_url_color">Ad URL Color</label></th>
											<td>
												<input id="bsa_pro_ad_url_color"
													   name="ad_url_color"
													   value="<?php echo getSpaceValue('ad_url_color') ?>"
													   data-default-color="#000000" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_ad_extra_color_1">Ad Extra Color 1</label></th>
											<td>
												<input id="bsa_pro_ad_extra_color_1"
													   name="ad_extra_color_1"
													   value="<?php echo getSpaceValue('ad_extra_color_1') ?>"
													   data-default-color="#FFFFFF" type="text" class="bsaColorPicker">
											</td>
										</tr>
										<tr>
											<th scope="row"><label for="bsa_pro_ad_extra_color_2">Ad Extra Color 2</label></th>
											<td>
												<input id="bsa_pro_ad_extra_color_2"
													   name="ad_extra_color_2"
													   value="<?php echo getSpaceValue('ad_extra_color_2') ?>"
													   data-default-color="#444444" type="text" class="bsaColorPicker">
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<input type="submit" value="Save Space" class="button button-primary" id="bsa_pro_submit" name="bsa_pro_submit">
	</p>
</form>

<?php else: ?>

	<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Error!</strong> Space not exists!</p>
	</div>

<?php endif; ?>

<script>
	(function($){
		// - start - open page
		var bsaItemsWrap = $('.wrap');
		bsaItemsWrap.hide();

		setTimeout(function(){
			bsaItemsWrap.fadeIn(400);
		}, 400);
		// - end - open page

		bsaGetTemplate();
		$(document).ready(function(){
			$('.bsaColorPicker').wpColorPicker();
			bsaGetTemplate();

			var bsaAnimation = $("#bsa_pro_animation");
			var bsaTemplatePreviewInner = $(".bsaTemplatePreviewInner");
			bsaAnimation.bind('change',function() {
				bsaTemplatePreviewInner.addClass(('animated ' + bsaAnimation.val()));
				setTimeout(function(){
					bsaTemplatePreviewInner.removeClass().addClass('bsaTemplatePreviewInner');
				}, 1500);
			});
			bsaAnimation.trigger('change');
		});

		$('.bsaProTab').click(function() {
			var clicked = $(this).attr('data-tab');
			$('.bsaProTab').removeClass('tabs');
			$(this).addClass('tabs');
			if ( clicked == 'bsaAllCategories' ) {
				$('.bsaAllCategories').show();
				$('.bsaAllTags').hide();
			} else {
				$('.bsaAllTags').show();
				$('.bsaAllCategories').hide();
			}
		});

		$('.bsaProTabCountry').click(function() {
			var clicked = $(this).attr('data-tab');
			$('.bsaProTabCountry').removeClass('tabs');
			$(this).addClass('tabs');
			if ( clicked == 'bsaShowCountries' ) {
				$('.bsaShowCountries').show();
				$('.bsaHideCountries').hide();
				$('.bsaAdvanced').hide();
			} else if ( clicked == 'bsaHideCountries' ) {
				$('.bsaHideCountries').show();
				$('.bsaShowCountries').hide();
				$('.bsaAdvanced').hide();
			} else {
				$('.bsaAdvanced').show();
				$('.bsaShowCountries').hide();
				$('.bsaHideCountries').hide();
			}
		});

		$('.bsaSpaceCustomization').click(function() {
			var bsaSpaceCustomization = $('#bsaSpaceCustomization');
			if ( bsaSpaceCustomization.hasClass('closed') ) {
				bsaSpaceCustomization.removeClass('closed');
			} else {
				bsaSpaceCustomization.addClass('closed');
			}
		});

	})(jQuery);

	function bsaGetTemplate()
	{
		(function($) {
			var bsaTemplatePreviewInner = $('.bsaTemplatePreviewInner');
			var bsaLoader = $('.bsaLoader');

			bsaTemplatePreviewInner.slideUp(400);
			bsaLoader.fadeIn(400);
			setTimeout(function(){
				$.post(ajaxurl, {action:'bsa_preview_callback',bsa_template:$("#bsa_pro_template").val()}, function(result) {
					bsaTemplatePreviewInner.html(result).slideDown(400);
					bsaLoader.fadeOut(400);
				});
			}, 1100);
		})(jQuery);
	}
</script>