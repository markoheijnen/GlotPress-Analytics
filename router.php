<?php
class Google_Analytics_Route extends GP_Route_Main {

	public function __construct() {
		$this->template_path = dirname( __FILE__ );
	}

	function settings_get() {
		if( ! GP::$user->current()->admin() )
			return;

		$this->tmpl( 'settings-page', get_defined_vars() );
	}

}