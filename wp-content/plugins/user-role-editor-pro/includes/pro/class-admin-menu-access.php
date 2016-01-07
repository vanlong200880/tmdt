<?php

/*
 * User Role Editor WordPress plugin
 * Class URE_Admin_Menu_Access - prohibit selected menu items for role or user
 * Author: Vladimir Garagulya
 * Author email: vladimir@shinephp.com
 * Author URI: http://shinephp.com
 * License: GPL v3 
 */

class URE_Admin_Menu_Access {

// reference to the code library object
    private $lib = null;    
    private $admin_menu = null;
    private $notice = '';

    public function __construct($lib) {
        
        $this->lib = $lib;
        $this->admin_menu = new URE_Admin_Menu($this->lib);
        
        add_action('ure_role_edit_toolbar_service', array(&$this, 'add_toolbar_buttons'));
        add_action('ure_load_js', array(&$this, 'add_js'));
        add_action('ure_dialogs_html', array(&$this, 'dialog_html'));
        add_action('ure_process_user_request', array(&$this, 'update_menu_access'));
        add_action('ure_process_user_request', array(&$this, 'update_menu_access_notification'));        
        add_action('admin_head', array($this, 'remove_blocked_menu_items'), 10);
        add_action('admin_head', array($this, 'redirect_blocked_urls'), 10);
        
    }
    // end of __construct()

    
    public function add_toolbar_buttons() {
        global $current_user;
        
        if ($this->lib->user_has_capability($current_user, 'administrator')) {            
            $this->admin_menu->update_menu_copy();
        }
?>
                
        <button id="ure_admin_menu_access" class="ure_toolbar_button" title="Prohibit access to selected menu items">User Menu</button> 
        <hr />
               
<?php

    }
    // end of add_toolbar_buttons()


    public function add_js() {
        wp_register_script( 'ure-admin-menu-access', plugins_url( '/js/pro/ure-pro-admin-menu-access.js', URE_PLUGIN_FULL_PATH ) );
        wp_enqueue_script ( 'ure-admin-menu-access' );
        wp_localize_script( 'ure-admin-menu-access', 'ure_data_admin_menu_access', 
                array(
                    'admin_menu' => esc_html__('Admin Menu', 'ure'),
                    'dialog_title' => esc_html__('Backend menu', 'ure'),
                    'update_button' => esc_html__('Update', 'ure')
                    
                ));
    }
    // end of add_js()    
    
    
    public function dialog_html() {
        
?>
        <div id="ure_admin_menu_access_dialog" class="ure-modal-dialog">
            <div id="ure_admin_menu_access_container">
            </div>    
        </div>
<?php        
        
    }
    // end of dialog_html()

            
    public function update_menu_access() {
    
        if (!isset($_POST['action']) || $_POST['action']!=='ure_update_admin_menu_access') {
            return;
        }
        
        $ure_object_type = filter_input(INPUT_POST, 'ure_object_type', FILTER_SANITIZE_STRING);
        if ($ure_object_type!=='role' && $ure_object_type!=='user') {
            $this->notice = 'URE: administrator menu access: Wrong object type. Data was not updated.';
            return;
        }
        $ure_object_name = filter_input(INPUT_POST, 'ure_object_name', FILTER_SANITIZE_STRING);
        if (empty($ure_object_name)) {
            $this->notice = 'URE: administrator menu access: Empty object name. Data was not updated';
            return;
        }
                        
        if ($ure_object_type=='role') {
            $this->admin_menu->save_menu_access_data_for_role($ure_object_name);
        } else {
            $this->admin_menu->save_menu_access_data_for_user($ure_object_name);
        }
        
    }
    // end of update_menu()
    
    
    public function update_menu_access_notification() {
        $this->lib->show_message($this->notice);
    }
    // end of update_menu_access_notification()
    
    
    public function remove_blocked_menu_items() {
        global $current_user, $menu, $submenu;
        
        if ($this->lib->user_has_capability($current_user, 'administrator')) {
            return;
        }
        
        $blocked = $this->admin_menu->load_menu_access_data_for_user($current_user);
        if (empty($blocked)) {
            return;
        }
        
        foreach($menu as $key=>$menu_item) {
            $item_id = $this->admin_menu->calc_menu_item_id('menu', $menu_item[2]);
            if (in_array($item_id, $blocked)) {
                unset($submenu[$menu_item[2]]);
                unset($menu[$key]);
            }
        }
        foreach($submenu as $key=>$menu_item) {
            $submenu_modified = false;
            foreach($menu_item as $key1=>$menu_item1) {
                $item_id = $this->admin_menu->calc_menu_item_id('submenu', $menu_item1[2]);
                if (in_array($item_id, $blocked)) {
                    unset($submenu[$key][$key1]);
                    $submenu_modified = true;
                }
            }    
        }
        
    }
    // end of remove_blocked_menu_items()
    
    
    public function redirect_blocked_urls() {
        
        global $current_user, $pagenow;
        
        if ($this->lib->user_has_capability($current_user, 'administrator')) {
            return;
        }
        
        $url = strtolower($_SERVER['REQUEST_URI']);
        $path = parse_url($url, PHP_URL_PATH);
        $path_parts = explode('/', $path);
        $url_script = end($path_parts);
        $url_query = parse_url($url, PHP_URL_QUERY);
        
        if ($url_script=='admin.php') { 
            $command = $url_query;
        } else {
            $command = $url_script;
            if (!empty($url_query)) {
                $command .= '?'. $url_query;
            }
        }
        $command = str_replace('&', '&amp;', $command);
        $item_id1 = $this->admin_menu->calc_menu_item_id('menu', $command);
        $item_id2 = $this->admin_menu->calc_menu_item_id('submenu', $command);
        $blocked = $this->admin_menu->load_menu_access_data_for_user($current_user);
        if (!in_array($item_id1, $blocked) && !in_array($item_id2, $blocked)) {
            return;            
        }
                        
        if (headers_sent()) {            
            echo '<div style="width: 600px;margin-top: 50px;margin-left: auto;margin-right: auto;text-align: center;">';
            echo '<h2>'. esc_html__('You do not have sufficient permissions to access this page', 'ure') .'</h2>';
            echo '<a href="'.site_url().'/wp-admin">Return to the dashboard</a>';
            echo '</div>';
            die;
        } else {
            wp_redirect(get_option('siteurl') . '/wp-admin/index.php');
        }
        
    }
    // end of redirect_blocked_urls()
            
    
}
// end of URE_Admin_Menu_Access class
