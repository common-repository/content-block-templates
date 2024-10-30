<?php
/*
Plugin Name: Content Block Templates
Plugin URI: http://www.cogitsolutions.com/wordpress-content-block-templates-plugin
Description: Provides different content block templates so that content editor, without html knowledge, can easily add contents which require some html knowledge like left image right floating text or left text and right floating image.
Version: 1.0
Author: COG IT Solutions Pvt. Ltd.
Author URI: http://cogitsolutions.com
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
*/
if(!class_exists('CogsContentBlockTemplates')):

class CogsContentBlockTemplates{
	var $buttonName = 'ContentBlockSelector';
	function addSelector(){
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;

	    if ( get_user_option('rich_editing') == 'true') {
	      add_filter('mce_external_plugins', array($this, 'registerTmcePlugin'));
	      //you can use the filters mce_buttons_2, mce_buttons_3 and mce_buttons_4 
	      //to add your button to other toolbars of your tinymce
	      add_filter('mce_buttons', array($this, 'registerButton'));
	    }
	}
	
	function registerButton($buttons){
		array_push($buttons, "separator", $this->buttonName);
		return $buttons;
	}
	function registerTmcePlugin($plugin_array){
		$plugin_array[$this->buttonName] = plugins_url() . '/content-block-templates/editor_plugin.js.php';
		if ( get_user_option('rich_editing') == 'true') 
		return $plugin_array;
	}
}

endif;

if(!isset($cogs_cbt)){
	$cogs_cbt = new CogsContentBlockTemplates();
	add_action('admin_head', array($cogs_cbt, 'addSelector'));
}