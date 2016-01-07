<?php

/*
 * User Role Editor WordPress plugin
 * Author: Vladimir Garagulya
 * Email: support@role-editor.com
 * License: GPLv2 or later
 */


/**
 * Process AJAX requrest from User Role Editor Pro
 */
class URE_Pro_Ajax_Processor extends URE_Ajax_Processor {
        
    
    protected function get_admin_menu() {
        $admin_menu = new URE_Admin_Menu($this->lib);
        $answer = $admin_menu->get_menu_html();
        
        return $answer;
    }
    // end of get_admin_menu()
    
    
    /**
     * AJAX requests dispatcher
     */    
    protected function _dispatch($action) {
        
        $answer = parent::_dispatch($action);
        if (substr($answer['message'], 0, 14)!='unknown action') {
            return $answer;
        }
        
        switch ($action) {            
            case 'get_admin_menu':
                $answer = $this->get_admin_menu();
                break;
          default:              
                $answer = array('result'=>'error', 'message'=>'unknown action "'. $action .'"');
        }
        
        return $answer;
    }    
    
}
// end of URE_Pro_Ajax_Processor
