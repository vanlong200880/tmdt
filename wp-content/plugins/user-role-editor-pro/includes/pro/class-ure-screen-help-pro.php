<?php

/* 
 * User Role Editor On Screen Help class
 * 
 */

class URE_Screen_Help_Pro {

    public function __construct() {
        
        add_filter('ure_get_settings_overview_tab_help', array($this, 'get_settings_overview_tab_help'));
    }
    // end of __construct()
    
    public function get_settings_overview_tab_help($text) {
    
        $text .= '            
            <li><strong>' . esc_html__('User Role Editor full access capability', 'ure'). '</strong> - ' .
                esc_html__('if it is empty, then default rule is in action: user should have "administrator" role - ' .
                           'for single site WordPress installation, "manage_network_users" capability or be the "super administrator" - for multisite one. '.
                           'Input here your own user capability to change this logic.','ure') . '</li>';
        if (is_multisite()) {
            $text .= '<li><strong>' . esc_html__('Allow site administrators access to User Role Editor', 'ure') . '</strong> - '.
                     esc_html__('Super administator only has access to the User Role Editor under multi-site WordPress installation by default.' .
                     'Turn on this option if you wish to make User Role Editor available for subsite administrators .', 'ure') . '</li>';
        }
        $text .= '<li><strong>' . esc_html__('Activate "Create Post/Page" capability', 'ure'). '</strong> - ' .
                esc_html__('Turning on this option you automatically add "create_posts" and "create_pages" '.
                           'capabilities to the list of WordPress core user capabilities. After that user with "edit_posts" capability '.
                           '(even administrator) will can not create new post or page until you apparently include this capability '. 
                           'to his user role. "edit_posts" will permit just to edit posts. Go to "User Role Editor" and turn on "create_posts", "create_pages" capability" '.
                           'for "Administrator" role and other roles of your choice after this option activation.', 'ure') . '</li>
            <li><strong>' . esc_html__('Activate user access management to editing selected posts and pages', 'ure'). '</strong> - ' .
                esc_html__('This way you may have for example the user with limited "Editor" role, who may edit just 2-3 posts or pages, but has no access '.
                           'to all the rest. After this option activation go to the user profile and input allowed posts/pages ID '.
                           'to the correspondent text input field. That\'s it.', 'ure') . ' (<a href="http://role-editor.com/allow-user-edit-selected-posts">'.esc_html__('more info...', 'ure').')</a></li>
            <li><strong>' . esc_html__('Activate per plugin user access management for plugins activation', 'ure'). '</strong> - ' .
                esc_html__('this feature is useful when you need to allow different users activate/deactivate different plugins. '.
                'When this option is turned on you may input, what plugins are available for the user with "activate_plugins" capability. ' .
                'Go to such user profile and select plugins you allow him to manage.', 'ure') . '</li>
                <li><strong>' . esc_html__('Activate per form user access management for Gravity Forms', 'ure'). '</strong> - ' .
                esc_html__('after turning on this option you may see the new “Gravity Forms Restrictions” section at the user profile '.
                           'with input field “Allow access to forms with ID (comma separated)”. This field will appear at profile '.
                           'of those users only who have at least one capability from the “Gravity Forms” capabilities list, '.
                           'e.g. “gravityforms_edit_forms”, “gravityforms_view_entries”, etc. Look ', 'ure') .
                           '<a href="http://role-editor.com/restrict-users-access-gravity-forms/">' .
                            esc_html__('support video', 'ure'). '</a> ' . 
                            esc_html__('for your reference.', 'ure') . '</li>
                <li><strong>' . esc_html__('Activate [user_role_editor roles="role1, role2, ..."] shortcode:', 'ure') .'</strong> - ' .
                esc_html__('Allows view the content enclosed inside [user_role_editor roles="role1, role2"] Some restricted content [/user-role-editor] '.
                'just to users who have one of roles listed in the "roles" attribute. "role1" or "role2" in this case. '. 
                 'Other users (except administrator) will not see the "restricted content" at the post or page. '.
                 'When this option is turned off, all restricted content input earlier, becomes available as usual content.', 'ure').'</li>
                <li><strong>' . esc_html__('License key', 'ure') .'</strong> - ' .
                'Input here the license key taken from your role-editor.com member account. This will turn on automatic updates for the User Role Editor Pro.'.
                'It will get information about available updates from role-editor.com directly and report about them the same way as any other plugin '.
                'from the wordpress.org plugins repository does.</li>';
        
        return $text;
    }
    // end of get_settings_overview_tab_help()
    
   
    
}
// end of URE_Screen_Help_Pro
