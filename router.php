<?php
class Google_Analytics_Route extends GP_Route_Main {

	public function __construct() {
		$this->template_path = dirname( __FILE__ );
	}

	function settings_get() {
		if( ! GP::$user->current()->admin() )
			return;

		$trackingscode = GP::$plugins->google_analytics->get_option( 'trackingscode' );

		$this->tmpl( 'settings-page', get_defined_vars() );
	}


	function settings_post() {
		if( ! GP::$user->current()->admin() )
			return;

		$trackingscode = $_POST['trackingscode'];

		if( preg_match( '/^[a-zA-Z0-9-;]+$/', $trackingscode ) ) {
			GP::$plugins->google_analytics->update_option( 'trackingscode', $trackingscode );

			$this->notices[] = __( 'The trackingscode was saved.' );
		}
		else {
			$this->errors[] = __( "The trackingscode couldn't be saved." );
		}

		$this->redirect( gp_url( '/settings/google-analytics' ) );
	}

}