<?php
/**
 * fired on activation
 */
class Altibox_Activator extends Altibox {

	/**
	 * set option for plugin
	 */
	public function run() {

		// set option selectors
		if( !get_option('altibox_selectors') ) {
			add_option( 'altibox_selectors', 'a[href$="jpg"], a[href$="jpeg"], a[href$="png"], a[href$="gif"], a[href$="bmp"]', '', 'yes' );
		}
		// set version
		if( !get_option('altibox_version') ) {
			add_option( 'altibox_version', $this->get_version(), '', 'yes' );
		}
		// update steps
		if( get_option('altibox_version') && get_option('altibox_version') != $this->get_version() ) {

			// run update js file
			$jsfile_content = file_get_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'public/assets/js/altibox-public.js' );
			$jsfile_content = preg_replace("/\/\*custom-selectors-start\*\/'([^']*)'\/\*custom-selectors-end\*\//i", "/*custom-selectors-start*/'" . get_option('altibox_selectors') . "'/*custom-selectors-end*/", $jsfile_content);
			file_put_contents( plugin_dir_path( dirname( __FILE__ ) ) . 'public/assets/js/altibox-public.js', $jsfile_content );

		}
		// update version
		if( get_option('altibox_version') != $this->get_version() ) {
			update_option( 'altibox_version', $this->get_version() );
		}

	}

}