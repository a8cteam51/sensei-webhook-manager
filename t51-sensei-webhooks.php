<?php
/*
Plugin Name: Sensei Webhook Manager
Plugin URI:
Description: Define a webhook URL and a list of Sensei actions to push data to a third-party.
Author: Team51
Version: 1.0.0
*/

namespace Sensei_Webhook_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

if ( ! class_exists( 'Sensei_Webhook_Manager_Plugin' ) ) {
	class Sensei_Webhook_Manager_Plugin {

		public static function load_dependencies() {
			include_once 'includes/register_settings.php';
			include_once 'views/admin.php';
		}

		public static function init() {

			add_action( 'admin_menu', array( new Admin_View(), 'admin_menu' ) );

			/**
			 * Adds a 'Settings' link from the Plugins page
			 */
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 't51_sensei_webhook_add_plugin_page_settings_link' );
			function t51_sensei_webhook_add_plugin_page_settings_link( $links ) {
				$links[] = '<a href="' .
					admin_url( 'options-general.php?page=t51_sensei_webhook' ) . '">' . __( 'Settings' ) . '</a>';
				return $links;
			}
		}


	}

	Sensei_Webhook_Manager_Plugin::load_dependencies();
	Sensei_Webhook_Manager_Plugin::init();

}



