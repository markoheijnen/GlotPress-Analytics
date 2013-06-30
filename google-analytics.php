<?php

class Google_Analytics extends GP_Plugin {
	public $id = 'google_an';

	private $tracking_id = false;
	private $tracking_domain = '';

	public function __construct() {
		parent::__construct();

		$this->add_action( 'gp_head' );

		$this->add_filter( 'glotpress_menu' );
		$this->add_action( 'plugins_loaded' );
	}

	public function gp_head() {
		$this->tracking_id = GP::$plugins->google_analytics->get_option( 'trackingscode' );

		if( ! $this->tracking_id )
			return;

		$this->tracking_domain = $_SERVER['SERVER_NAME'];
		?>


		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo esc_js( $this->tracking_id ); ?>', '<?php echo esc_js( $this->tracking_domain ); ?>');
			ga('send', 'pageview');

		</script>

		<?php
	}


	public function glotpress_menu( $items ) {
		if( GP::$user->current()->admin() )
			$items[ gp_url( '/settings/google-analytics' ) ] = 'Google Analytics';

		return $items;
	}

	public function plugins_loaded() {
		if( ! GP::$user->current()->admin() )
			return;

		include 'router.php';

		GP::$router->add( "/settings/google-analytics", array( 'Google_Analytics_Route', 'settings_get' ), 'get' );
		GP::$router->add( "/settings/google-analytics", array( 'Google_Analytics_Route', 'settings_post' ), 'post' );
	}

}

GP::$plugins->google_analytics = new Google_Analytics;