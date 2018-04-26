<?php
/*
Plugin Name: Wordpress Plugin Template OOP
Plugin URI: https://github.com/KamranSyed/Wordpress-Plugin-Template-OOP
Description: It is a ready made template for Wordpress and Woocommerce to give you a head start.
Version: 2.0
Author: Kamran Syed
Author URI: http://agilesolutionspk.com/author/kamran-syed/
*/

/*
if you have more than one plugin based on this template in a site, 
you need append a number to class name like W_Plugin_Template2 etc. 
In the same site your class names needs to be unique.
*/

//uncomment following two lines to see php errors
/*
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
*/

if ( !class_exists( 'W_Plugin_Template' )){   
	class W_Plugin_Template{

		function __construct() {
			
			//Plugin activation and deactivation hooks if you need them
			
			//register_activation_hook( __FILE__, array(&$this, 'install') ); 
			//runs when plugin is activated
			//register_deactivation_hook( __FILE__, array(&$this, 'uninstall') );  
			//runs when plugin is deactivated
			
			//Wordpress hooks
			//add_action('plugins_loaded', array(&$this, 'plugins_loaded') );
			//add_action( 'admin_menu', array(&$this, 'admin_menu') );
			add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts') );
			//add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts') );
			add_action('init', array(&$this, 'fe_init'));
			//add_action('admin_init', array(&$this, 'admin_init'));
			//add_action('wp_head', array(&$this,'wp_head'));
			//add_action( 'wp_footer', array(&$this,'wp_footer') );			
			//add_action('wp_login', array(&$this,'wp_login'));
			
			//Wordpress filters
			//None so far, let's see who contributes here first
			
			//AJAX hooks
			//add_action( 'wp_ajax_feAjax', array(&$this, 'feAjax') );   //Ajax for logged in user
			//add_action( 'wp_ajax_nopriv_feAjax', array(&$this, 'feAjax') );  //Ajax for visitor
			
			//Woocommerce hooks
			//add_action('woocommerce_before_single_product', array(&$this, 'woocommerce_before_single_product') );
			//add_action( 'woocommerce_product_set_stock', array(&$this, 'woocommerce_product_set_stock') );
			//add_action( 'woocommerce_after_order_notes' , array(&$this,'woocommerce_after_order_notes') );
			//add_action( 'woocommerce_checkout_update_order_meta' , array(&$this,'woocommerce_checkout_update_order_meta'), 10, 2 );
			//add_action( 'woocommerce_view_order', array(&$this,'woocommerce_view_order'), 20 );
			//add_action( 'woocommerce_thankyou', array(&$this,'woocommerce_thankyou'), 20 );
			//add_action( 'woocommerce_admin_order_data_after_order_details', array(&$this,'woocommerce_admin_order_data_after_order_details') );
			//add_action( 'woocommerce_process_shop_order_meta', array(&$this,'woocommerce_process_shop_order_meta'), 45, 2 );
			//add_action('woocommerce_email_customer_details', array(&$this,'woocommerce_email_customer_details'), 30, 3 );
			//add_action( 'woocommerce_order_status_processing',array(&$this, 'woocommerce_order_status_processing'));
			//add_action( 'woocommerce_product_query',array(&$this, 'woocommerce_product_query'));
			
			//Woocommerce filters
			//add_filter( 'woocommerce_checkout_fields' , array(&$this,'woocommerce_checkout_fields') );
			//add_filter( 'woocommerce_email_recipient_new_order' , array(&$this,'woocommerce_email_recipient_new_order'), 10, 2 );
			//add_filter( 'woocommerce_email_recipient_failed_order' , array(&$this,'woocommerce_email_recipient_failed_order'), 10, 2 );
			//add_filter( 'woocommerce_email_recipient_cancelled_order' , array(&$this,'woocommerce_email_recipient_cancelled_order'), 10, 2 );
			
			//Wordpress and Woocommerce Shortcodes
			add_shortcode('showcity', array(&$this, 'sc_showcity'));
			
		}
		
		function admin_menu(){
			add_menu_page('Common Inventory', 'Common Inventory', 'manage_options', 'qna_W_Plugin_Template', array(&$this, 'common_inventory'),'dashicons-admin-multisite');
			add_submenu_page('qna_W_Plugin_Template','Inventory Settings', 'Inventory Settings', 'manage_options', 'qna_wc_common_inv_settings', array(&$this,'settings'));
			
			
		}
		
		function admin_init(){}
		
		function wp_enqueue_scripts(){
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('popper', plugins_url('/js/popper.min.js', __FILE__), array( 'jquery' ));
			wp_enqueue_script('bootstrap', plugins_url('/js/bootstrap.min.js', __FILE__), array( 'jquery','popper' ));
			wp_enqueue_style( 'bootstrap', plugins_url('css/bootstrap.min.css', __FILE__) );
			wp_enqueue_style( 'myPlugin', plugins_url('css/plugin.css', __FILE__) );
		}
		
		function woocommerce_email_recipient_new_order($recipient, $order){
			//add your code
			return $recipient; //must return being a filter
		}
		
		function woocommerce_email_recipient_failed_order($recipient, $order){
			//add your code
			return $recipient; //must return being a filter
		}
		
		function woocommerce_email_recipient_cancelled_order($recipient, $order){
			//add your code
			return $recipient; //must return being a filter
		}
		
		/*
			query object is passed by reference so any change you make to $q object changes actual query and does not need a return. 
			In newer php version passing by reference requires function defination to have & prepended to variable
			So you may need to change woocommerce_product_query($q) to woocommerce_product_query(&$q)
		*/
		function woocommerce_product_query($q){}
		
		function woocommerce_order_status_processing($order_id){}
		
		function wp_footer(){} 
		
		function woocommerce_email_customer_details($order, $sent_to_admin, $plain_text){}
		
		function woocommerce_process_shop_order_meta($post_id, $post){}
		
		function woocommerce_admin_order_data_after_order_details(){}
		
		function woocommerce_thankyou(){}
		
		function woocommerce_view_order(){}
		
		function woocommerce_checkout_update_order_meta($order_id, $posted){}
		
		function woocommerce_checkout_fields(){}
		
		function woocommerce_after_order_notes() { }
		
		function wp_head() { }
		
		function wp_login() { }
		
		function plugins_loaded(){ }
		
		function woocommerce_before_single_product(){ }
		
		function install(){
			//activation hook
		}
		
		function uninstall(){
			//deactivation hook
		}
		
		function woocommerce_product_set_stock($prod){
			
		}
		
		
		function settings(){
			$this->handle_settings();
			$this->show_settings();
		}
		
		function admin_enqueue_scripts(){ }
		
		function show_settings(){

		}
		
		function fe_init(){
			//uncomment following if you need php session
			//if(!session_id()) session_start();
		}
		
		function feAjax(){
			//write your code.
			exit; //do not remove this line
		}

		function handle_settings(){

		}
		
		function sc_showcity(){
			ob_start();
			
			?>
			<p>This is city shortcode being tested and found working :) </p>
			<?php
			$ret = ob_get_clean();
			
			return $ret;
		}
		
	}//class ends
}//existing class ends

new W_Plugin_Template();

?>