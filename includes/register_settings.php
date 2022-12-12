<?php
namespace Sensei_Webhook_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

add_action(
	'admin_init',
	function () {
		register_setting( 'sensei_webhook_options_group', 'swm_url' );

		$sensei_hooks = array(
			'sensei_user_quiz_submitted',
		);

		foreach ( $sensei_hooks as $hook_name ) {
			register_setting( 'sensei_webhook_options_group', 'swm_' . $hook_name );
		}
	}
);

function add_options() {
	add_option( 'sensei_webhook_manager_url', '' );
}
