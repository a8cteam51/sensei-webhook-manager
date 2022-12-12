<?php

namespace Sensei_Webhook_Manager;

class Admin_View {
	public function admin_menu() {
		add_options_page(
			'Sensei Webhook for Customer.io',
			'Sensei - Customer.io',
			'manage_options',
			't51_sensei_webhook',
			array( &$this, 'options_page' )
		);
	}

	public function options_page() {  ?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h1>Webhook Configuration.</h1>
			<form method="post" action="options.php">
				<?php settings_fields( 'sensei_webhook_options_group' ); ?>
				
				<p>Paste here the webhook URL provided by Customer.io. </p>
				<p>This will allow <strong>Sensei LMS</strong> to push data to Customer.io everytime a student completes a quiz.</p>
				<label for="sensei_webhook_manager_url">
					Webhook URL:
					<input 
						type="text" 
						id="sensei_webhook_manager_url" 
						name="sensei_webhook_manager_url" 
						value="<?php echo get_option( 'sensei_webhook_manager_url' ); ?>"
						class="regular-text code"
						placeholder="https://" 
						/>
				</label>
				<?php submit_button(); ?>
			</form>
		</div>
	
		<small>Team51 - Automattic</small>
		<?php
	}
}
