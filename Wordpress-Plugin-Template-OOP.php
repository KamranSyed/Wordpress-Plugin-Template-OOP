<?php
/*
Plugin Name: Wordpress Plugin Template
Plugin URI: https://github.com/KamranSyed/Wordpress-Plugin-Template-OOP
Description: It is a ready made template for Wordpress and Woocommerce to give you a head start.
Version: 1.0
Author: Kamran Syed
Author URI: http://agilesolutionspk.com/author/kamran-syed/
*/

/*
if you have more than one plugin based on this template in a site, 
you need append a number to class name like W_Plugin_Template2 etc. 
In the same site your class names needs to be unique.
*/

if ( !class_exists( 'W_Plugin_Template' )){   
	class W_Plugin_Template{

		function __construct() {
			//add_action( 'admin_menu', array(&$this, 'admin_menu') );
			add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts') );
			add_action('init', array(&$this, 'fe_init'));
			//add_action( 'wp_ajax_qnawccominv', array(&$this, 'peer_req') );   //Ajax for logged in user
			//add_action( 'wp_ajax_nopriv_qnawccominv', array(&$this, 'peer_req') );  //Ajax for visitor
			//add_action( 'woocommerce_product_set_stock', array(&$this, 'stock_updated') );
		}
		
		function admin_menu(){
			add_menu_page('Common Inventory', 'Common Inventory', 'manage_options', 'qna_W_Plugin_Template', array(&$this, 'common_inventory'),'dashicons-admin-multisite');
			add_submenu_page('qna_W_Plugin_Template','Inventory Settings', 'Inventory Settings', 'manage_options', 'qna_wc_common_inv_settings', array(&$this,'settings'));
			
			
		}
		
		function stock_updated($prod){
			
		}
		
		
		function settings(){
			$this->handle_settings();
			$this->show_settings();
		}
		
		function admin_enqueue_scripts(){
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('popper', plugins_url('/js/popper.min.js', __FILE__), array( 'jquery' ));
			wp_enqueue_script('bootstrap', plugins_url('/js/bootstrap.min.js', __FILE__), array( 'jquery','popper' ));
			wp_enqueue_style( 'bootstrap', plugins_url('css/bootstrap.min.css', __FILE__) );
			wp_enqueue_style( 'myPlugin', plugins_url('css/plugin.css', __FILE__) );
			
		}
		
		function show_settings(){

		}
		
		function fe_init(){

		}
		

		function handle_settings(){

		}
		
		
		
	}//class ends
}//existing class ends

new W_Plugin_Template();
