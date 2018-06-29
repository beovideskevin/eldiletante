<?php

class Altibox_Admin {

	private $plugin_name;
	private $version;
	private $messages = array();

	/**
	 * constructor
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Add submenu to left page in admin
	 */
	public function add_submenu_page() {
		add_submenu_page( 'upload.php', $this->plugin_name, 'Altibox <span class="dashicons dashicons-format-gallery" style="font-size:15px;"></span>', 'manage_options', $this->plugin_name . '-settings-page', array($this, 'render_settings_page') );
	}

	/**
	 * Render settings page for plugin
	 */
	public function render_settings_page() {
		require plugin_dir_path( __FILE__ ) . 'views/' . $this->plugin_name . '-admin-settings-page.php';
	}

	/**
	 * prepare enqueue styles for wordpress hook
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/altibox-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * prepare enqueue scripts for wordpress hook
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/altibox-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * add a settings link to plugin page.
	 * @param string $links array of links
	 */
	public function add_settings_link( $links ) {
	    $settings_link = '<a href="upload.php?page=' . $this->plugin_name . '-settings-page">' . __( 'Settings' ) . '</a>';
	    array_unshift($links, $settings_link);
	  	return $links;
	}

	/**
	 * display messages manager
	 * @return array push array messages in to partial view
	 */
	public function display_messages() {

		foreach ($this->messages as $name => $messages) {
			foreach ($messages as $message) {
				require plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/includes/altibox-admin-message.php';
			}
		}

	}

	/**
	 * Set selectors
	 */
	public function set_selectors($value) {
		// escaped characters . $ ^ { [ ( | ) * + ? \
		$match = preg_match('/^([a-z0-9,-_="~>#\(\)\|\\\ \.\$\^\+\*\[\]]*)$/i', $value, $matches);
		if( $matches[1] != '' ) {
			return stripslashes($value);
		}
		else {
			$this->messages['file'][] = array(
				'message' => 'Your selector is not valid.',
				'type' => 'error',
				'id' => '5'
			);
			return FALSE;
		}
	}

	/**
	 * generate js string
	 */
	public function generate_js() {

			if( !is_bool(self::set_selectors($_POST['altibox_selectors'])) && $jsfile_content = file_get_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'public/assets/js/altibox-public.js' ) ) {
				$jsfile_content = preg_replace("/\/\*custom-selectors-start\*\/'([^']*)'\/\*custom-selectors-end\*\//i", "/*custom-selectors-start*/'" . self::set_selectors($_POST['altibox_selectors']) . "'/*custom-selectors-end*/", $jsfile_content);
			}

			if( !empty($jsfile_content) && !file_put_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'public/assets/js/altibox-public.js', $jsfile_content ) ) {
				$this->messages['file'][] = array(
					'message' => 'Impossible to create or modified the js file.',
					'type' => 'error',
					'id' => '4'
				);
			}
			else {
				update_option('altibox_selectors', self::set_selectors($_POST['altibox_selectors']));
				$this->messages['file'][] = array(
					'message' => 'Js file has been regenerated.',
					'type' => 'updated',
					'id' => ''
				);
			}

	}

	/**
	 * Get custom selectors from js
	 */
	public function get_custom_selectors() {
		if( $jsfile_content = file_get_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'public/assets/js/altibox-public.js' ) ) {

			if(  preg_match("/\/\*custom-selectors-start\*\/'([^']*)'\/\*custom-selectors-end\*\//i", $jsfile_content, $matches) ) {
				return $matches[1];
			}
			else {
				$this->messages['file'][] = array(
					'message' => __('Impossible to get the CSS selector(s).', $this->plugin_name),
					'type' => 'error',
					'id' => '3'
				);
				return '';
			}

		}
		else {
			return '';
		}
	}

}