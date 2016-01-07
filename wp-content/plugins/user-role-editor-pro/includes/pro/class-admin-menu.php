<?php

/*
 * User Role Editor WordPress plugin
 * Class URE_Admin_Menu - support stuff for manipulations with WP admin dashboard menu
 * Author: Vladimir Garagulya
 * Author email: vladimir@shinephp.com
 * Author URI: http://shinephp.com
 * License: GPL v3 
 */

class URE_Admin_Menu {

    private $lib = null;
    const ADMIN_MENU_COPY_KEY = 'ure_admin_menu_copy';
    const ADMIN_SUBMENU_COPY_KEY = 'ure_admin_sub_menu_copy';
    const ADMIN_MENU_ACCESS_DATA_KEY = 'ure_admin_menu_access_data';
    
    
    public function __construct($lib) {
        
        $this->lib = $lib;
        
    }
    // end of __construct()
    
    
    /**
     * Save current WordPress admin menu for future use via AJAX requests
     * 
     */
    public function update_menu_copy() {
        global $menu, $submenu;
        
        $menu_copy = $menu;
        foreach($menu_copy as $key=>$item) {
            for($i=3; $i<count($item); $i++) {
                unset($menu_copy[$key][$i]);
            }
        }
        update_option(self::ADMIN_MENU_COPY_KEY, $menu_copy);
        update_option(self::ADMIN_SUBMENU_COPY_KEY, $submenu);
    }
    // end of update_menu_copy()

    
    public function load_menu_access_data_for_role($role_id) {
        
        $ure_menu_access_data = get_option(self::ADMIN_MENU_ACCESS_DATA_KEY);
        if (is_array($ure_menu_access_data) && array_key_exists($role_id, $ure_menu_access_data)) {
            $result =  $ure_menu_access_data[$role_id];
        } else {
            $result = array();
        }
        
        return $result;
    }
    // end of load_menu_access_data_for_role()
    
    
    public function load_menu_access_data_for_user($user) {
    
        if (is_object($user)) {
            $id = $user->ID;
        } else if (is_int($user)) {
            $id = $user;
            $user = get_user_by('id', $user);
        } else {
            $user = get_user_by('login', $user);
            $id = $user->ID;
        }
        
        $blocked = get_user_meta($user->ID, self::ADMIN_MENU_ACCESS_DATA_KEY, true);
        if (!is_array($blocked)) {
            $blocked = array();
        }
        
        $ure_menu_access_data = get_option(self::ADMIN_MENU_ACCESS_DATA_KEY);
        if (empty($ure_menu_access_data)) {
            $ure_menu_access_data = array();
        }
        
        foreach ($user->roles as $role) {
            if (isset($ure_menu_access_data[$role])) {
                $blocked = array_merge($blocked, $ure_menu_access_data[$role]);
            }
        }
        
        $blocked = array_unique ($blocked);
        
        return $blocked;
    }
    // end of load_menu_access_data_for_role()

    
    protected function get_menu_access_post_data() {
        
        $keys_to_skip = array('action', 'ure_nonce', '_wp_http_referer', 'ure_object_type', 'ure_object_name', 'user_role');
        $menu_access_data = array();
        foreach ($_POST as $key=>$value) {
            if (in_array($key, $keys_to_skip)) {
                continue;
            }
            $menu_access_data[] = $key;
        }
        
        return $menu_access_data;
    }
    // get_menu_access_post_data()
        
    
    public function save_menu_access_data_for_role($role_id) {
        $menu_access_for_role = $this->get_menu_access_post_data();
        $menu_access_data = get_option(self::ADMIN_MENU_ACCESS_DATA_KEY);        
        if (!is_array($menu_access_data)) {
            $menu_access_data = array();
        }
        if (count($menu_access_for_role)>0) {
            $menu_access_data[$role_id] = $menu_access_for_role;
        } else {
            unset($menu_access_data[$role_id]);
        }
        update_option(self::ADMIN_MENU_ACCESS_DATA_KEY, $menu_access_data);
    }
    // end of save_menu_access_data_for_role()
    
    
    public function save_menu_access_data_for_user($user_login) {
        $menu_access = $this->get_menu_access_post_data();
    }
    // end of save_menu_access_data_for_role()   
    
    
    protected function get_allowed_roles($user) {
        $allowed_roles = array();
        if (empty($user)) {   // request for Role Editor - work with currently selected role
            $current_role = filter_input(INPUT_POST, 'current_role', FILTER_SANITIZE_STRING);
            $allowed_roles[] = $current_role;
        } else {    // request from user capabilities editor - work with that user roles
            $allowed_roles = $user->roles;
        }
        
        return $allowed_roles;
    }
    // end of get_allowed_roles()
    
    
    protected function get_allowed_caps($allowed_roles, $user) {
        global $wp_roles;
        
        $allowed_caps = array();        
        foreach($allowed_roles as $allowed_role) {
            $allowed_caps = array_merge($allowed_caps, $wp_roles->roles[$allowed_role]['capabilities']);
            if (!empty($user)) {
                $allowed_caps = array_merge($allowed_caps, $user->allcaps);
            }
        }
        
        return $allowed_caps;
    }
    // end of get_allowed_caps()
        
    
    public static function calc_menu_item_id($menu_kind, $menu_item) {
        
        $item_id = md5($menu_kind . $menu_item);
        
        return $item_id;
    }
    // end calc_menu_item_id()

    
    protected function user_allowed($cap_required, $allowed_roles, $allowed_caps) {        

        if (in_array($cap_required, $allowed_roles) || array_key_exists($cap_required, $allowed_caps)) {
            return true;
        }
        if ( $cap_required=='switch_themes' && 
            (in_array('edit_theme_options', $allowed_roles) || array_key_exists('edit_theme_options', $allowed_caps)) ) {
            return true;    // permissions extension for "Appearance" and "Themes" menu items
        }
                
        return false;   

    }
    // end of user_allowed()        
    
    /**
     * 
     * @param array $current_menu
     * @param array $current_submenu
     */     
    protected function update_profile_menu(&$current_menu, &$current_submenu) {
    
        $current_menu[70] = array( __('Profile'), 'read', 'profile.php');
        unset($current_submenu['users.php']);
        $current_submenu['profile.php'][5] = array(__('Your Profile'), 'read', 'profile.php');
        if ( current_user_can('create_users') ) {
            $current_submenu['profile.php'][10] = array(__('Add New User'), 'create_users', 'user-new.php');
        } else {
            $current_submenu['profile.php'][10] = array(__('Add New User'), 'promote_users', 'user-new.php');
        }        
        
    }
    // end of update_profile_menu()

    /**
     * Returns 1st required capability which exists at the list of allowed capabilities
     * @param array $allowed_caps
     * @param array $required_caps
     * @return string
     */
    protected function min_cap($allowed_caps, $required_caps) {
        
        foreach($required_caps as $rqc) {
            if (array_key_exists($rqc, $allowed_caps)) {
                return $rqc;
            }
        }
        
        return 'do-not-allow';
    }
    // end of min_cap()
    
    /**
     * Update Gravity Forms menu permissions as it may has gf_full_access got for the superadmin user under WP multisite
     * @param array $current_menu
     * @param array $current_submenu
     */
    protected function update_gravity_forms_menu(&$current_menu, &$current_submenu, $allowed_caps) {
                
        $min_cap = $this->min_cap($allowed_caps, GFCommon::all_caps());
        $gf_caps_map = array(
            'gf_edit_forms'=>'gravityforms_edit_forms',
            'gf_new_form'=>'gravityforms_create_form',
            'gf_entries'=>'gravityforms_view_entries',
            'gf_settings'=>'gravityforms_view_settings',
            'gf_export'=>'gravityforms_export_entries',
            'gf_update'=>'gravityforms_view_updates',
            'gf_addons'=>'gravityforms_view_addons',
            'gf_help'=>$min_cap            
        );
        $addon_menus = array();
        $addon_menus = apply_filters("gform_addon_navigation", $addon_menus);
        if (count($addon_menus)>0) {
            foreach($addon_menus as $addon_menu) {
                $gf_caps_map[esc_html($addon_menu['name'])] = $addon_menu['permission'];
            }
        }
        $current_menu['16.9'][1] = $min_cap;
        foreach($current_submenu['gf_edit_forms'] as $key=>$item) {
            $current_submenu['gf_edit_forms'][$key][1] = $gf_caps_map[$item[2]];
        }
    }
    // end of update_gravity_forms_menu()
    
    
    public function get_menu_html($user=null) {        
                
        $allowed_roles = $this->get_allowed_roles($user);
        $allowed_caps = $this->get_allowed_caps($allowed_roles, $user);
        $current_menu = get_option(self::ADMIN_MENU_COPY_KEY);
        $current_submenu = get_option(self::ADMIN_SUBMENU_COPY_KEY);
        if (!array_key_exists('list_users', $allowed_caps)) {
            $this->update_profile_menu($current_menu, $current_submenu);
        }
        if (/*is_multisite() && */array_key_exists('16.9', $current_menu) && 
            !array_key_exists('gform_full_access', $allowed_caps)) {  // Gravity Forms
            $this->update_gravity_forms_menu($current_menu, $current_submenu, $allowed_caps);
        }
        
        
        if (empty($user)) {
            $ure_object_type = 'role';
            $ure_object_name = $allowed_roles[0];
            $blocked_items = $this->load_menu_access_data_for_role($ure_object_name);
        } else {
            $ure_object_type = 'user';
            $ure_object_name = $user->user_login;
            $blocked_items = $this->load_menu_access_data_for_user($ure_object_name);
        }
        
        ob_start();
?>
<form name="ure_admin_menu_access_form" id="ure_admin_menu_access_form" method="POST"
      action="<?php echo URE_WP_ADMIN_URL . URE_PARENT.'?page=users-'.URE_PLUGIN_FILE;?>" >
<table id="ure_admin_menu_access_table">    
    <th style="color:red;"><?php esc_html_e('Block', 'ure');?></th>
    <th><?php esc_html_e('Menu', 'ure');?></th>
    <th><?php esc_html_e('Submenu','ure');?></th>
    <th><?php esc_html_e('User capability');?></th>
    <th><?php esc_html_e('URL');?></th>
<?php
        foreach($current_menu as $menu_item) {            
            if (substr($menu_item[2], 0, 9)=='separator') {
                continue;
            }
            if (!$this->user_allowed($menu_item[1], $allowed_roles, $allowed_caps)) {
                continue;   // user has no access to this menu item - skip it
            }                        
            $item_id = $this->calc_menu_item_id('menu', $menu_item[2]);
            $key_pos = strpos($menu_item[0], '<span');
            $menu_title = ($key_pos===false) ? $menu_item[0] : substr($menu_item[0], 0, $key_pos);
?>
    <tr>
        <td>   
<?php 
    if ($allowed_roles[0]!='administrator') {
        $checked = in_array($item_id, $blocked_items) ? 'checked' : '';
?>
            <input type="checkbox" name="<?php echo $item_id;?>" id="<?php echo $item_id;?>" <?php echo $checked;?> />
<?php
    }
?>
        </td>
        <td><?php echo $menu_title;?></td>
        <td></td>
        <td style="color:#cccccc;"><?php echo $menu_item[1];?></td>
        <td style="color:#cccccc; padding-left:10px;"><?php echo $menu_item[2];?></td>
    </tr>        
<?php
            if (isset($current_submenu[$menu_item[2]])) {
                foreach($current_submenu[$menu_item[2]] as $submenu_item) {
                    $cap_required = $submenu_item[1];
                    if (!in_array($cap_required, $allowed_roles) && !array_key_exists($cap_required, $allowed_caps)) {
                        continue;   // user has not access to this submenu item- skip it
                    }                    
                    $item_id = $this->calc_menu_item_id('submenu', $submenu_item[2]);
                    $key_pos = strpos($submenu_item[0], '<span');
                    $menu_title = ($key_pos===false) ? $submenu_item[0] : substr($submenu_item[0], 0, $key_pos);
?> 
    <tr>        
        <td>   
<?php 
                    if ($allowed_roles[0]!='administrator') {
                        $checked = in_array($item_id, $blocked_items) ? 'checked' : '';
?>                      
            <input type="checkbox" name="<?php echo $item_id;?>" id="<?php echo $item_id;?>" <?php echo $checked;?> />
<?php
    }
?>
        </td>
        <td></td>
        <td><?php echo $menu_title;?></td>
        <td style="color:#cccccc;"><?php echo $submenu_item[1];?></td>
        <td style="color:#cccccc; padding-left:10px;"><?php echo $submenu_item[2];?></td>
    </tr>    
<?php    
                }   // foreach($submenu
            }
        }   // foreach($current_menu)
?>
</table> 
    <input type="hidden" name="action" id="action" value="ure_update_admin_menu_access" />
    <input type="hidden" name="ure_object_type" id="ure_object_type" value="<?php echo $ure_object_type;?>" />
    <input type="hidden" name="ure_object_name" id="ure_object_name" value="<?php echo $ure_object_name;?>" />
<?php
    if ($ure_object_type=='role') {
?>
    <input type="hidden" name="user_role" id="ure_role" value="<?php echo $ure_object_name;?>" />
<?php
    }
?>
    <?php wp_nonce_field('user-role-editor', 'ure_nonce'); ?>
</form>    
<?php    
        $html = ob_get_contents();
        ob_end_clean();
        
        if (!empty($user)) {
            $current_object = $user->user_login;
        } else {
            $current_object = $allowed_roles[0];
        }
     
        return array('result'=>'success', 'message'=>'Admin menu permissions for '+ $current_object, 'html'=>$html);
    }
    // end of get_menu_html()

}
// end of URE_Admin_Menu class
