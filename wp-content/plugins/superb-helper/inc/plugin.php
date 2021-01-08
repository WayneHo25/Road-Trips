<?php
if (!class_exists('spbhlpr_plugin')) {
final class spbhlpr_plugin{
	private $plugin_name;
	private $plugin_prefix;
	private $plugin_version;
	private $user_caps;
	private $page_hook;
	private $base_url;
	private $base_dir;
	private $plugin_dir;

	function __construct($_information, $_base) {
		$this->plugin_name = $_information[0];
		$this->plugin_prefix = $_information[1];
		$this->plugin_version = $_information[2];
		$this->user_caps = 'manage_categories';
		$this->base_url = $_base[0];
		$this->base_dir = $_base[1];
		$this->plugin_dir = $_base[2];
		add_action('admin_menu', array($this, 'spbhlpr_add_menu_items'));
		add_action('admin_enqueue_scripts', array($this, 'spbhlpr_backend_enqueue'));
	}

	function spbhlpr_add_menu_items() {
		$user_caps = apply_filters('spbhlpr_user_capabilities', $this->user_caps);
			add_menu_page($this->plugin_name, $this->plugin_name, $user_caps, $this->plugin_prefix, array($this, 'spbhlpr_base'), $this->base_url . "assets/img/icon-small.png");
	}

	function spbhlpr_backend_enqueue($hook) {
		if( $this->page_hook == $hook || 'toplevel_page_spbhlpr' == $hook){
			wp_enqueue_style('spbhlpr-stylesheet', $this->base_url . 'assets/css/backend.css', false, $this->plugin_version, 'all' );
			wp_enqueue_style('spbhlpr-fontawesome', $this->base_url . 'assets/fontawesome/css/fontawesome.css', false, $this->plugin_version, 'all' );
			wp_enqueue_style('spbhlpr-fontawesome-s', $this->base_url . 'assets/fontawesome/css/solid.css', false, $this->plugin_version, 'all' );
			wp_enqueue_style('spbhlpr-lato', 'https://fonts.googleapis.com/css?family=Lato:400,700&display=swap', false, $this->plugin_version, 'all' );

			wp_enqueue_script('superbfw-script', $this->base_url . '/assets/js/backend.js',false,$this->plugin_version);
			
		}
	}

	function spbhlpr_base(){
		include_once $this->base_dir . "inc/backend.php";
	}

	private	function spbhlpr_eventHandler(){
	require $this->base_dir . "inc/data/plugins-data.php";
		if(isset($_POST['spbhlprq']))
			$q = sanitize_text_field($_POST['spbhlprq']);

		if(isset($q) && isset($_POST['_wpnonce_spbhlpr'])){
			switch ($q) {
				case 'activate':
					if(isset($_POST['path']) && wp_verify_nonce($_POST['_wpnonce_spbhlpr'], 'spbhlpr_activate_plugin')){
						$path = sanitize_text_field($_POST['path']);
						$validated = false;
						foreach($recommended_plugins as $array)
						{
						    if(in_array($path, $array, true))
						        $validated = true;
						}
						if($validated)
							activate_plugin($path);
					}
					break;

				case 'install':
					if(isset($_POST['slug']) && isset($_POST['path']) && wp_verify_nonce($_POST['_wpnonce_spbhlpr'], 'spbhlpr_install_plugin')){
						$path = sanitize_text_field($_POST['path']);
						$slug = sanitize_text_field($_POST['slug']);
						$target = array($slug,$path);
						$validated = false;
						foreach($recommended_plugins as $array)
						{
						    if(count(array_intersect($array, $target)) == count($target))
						        $validated = true;
						}
						if($validated)
							$this->install_plugin($slug, $path);
					}
					break;
				
				default:
					# no parameters
					break;
			}
		}
	}


	private function is_plugin_installed( $path ) {
		$all_plugins = get_plugins();
		return !empty($all_plugins[$path]) ? true : false;
	}

	private function install_plugin( $slug, $path ) {
		include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		$upgrader = new Plugin_Upgrader();
		$installed = $upgrader->install( 'https://downloads.wordpress.org/plugin/'.$slug.'.latest-stable.zip' );
		if ( !is_wp_error( $installed ) && $installed ) {
			activate_plugin( $path );
		}
	}

}
}
?>