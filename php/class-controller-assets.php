<?php
/**
 * Class Controller_Assets
 *
 * @package mkdo\link_picker_for_cmb2
 */

namespace mkdo\link_picker_for_cmb2;

/**
 * Sets up the JS and CSS needed for this plugin
 */
class Controller_Assets {

	/**
	 * Constructor
	 */
	function __construct() {
	}

	/**
	 * Do Work
	 */
	public function run() {
		global $pagenow;
		if ( 'media-new.php' !== $pagenow ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}
	}

	/**
	 * Enqeue Scripts
	 */
	public function admin_enqueue_scripts() {

		global $post_id;

		/* CSS */
		$plugin_css_url = plugins_url( 'css/plugin.css', MKDO_LPFC_ROOT );
		wp_enqueue_style( 'link-picker-for-cmb2', $plugin_css_url, array(), '1.3.0' );

		/* Media */
		if ( isset( $post_id ) && $post_id <> 0 ) {
			wp_enqueue_media( array( 'post' => $post_id ) );
		}

		/* JS */
		$plugin_js_url  = plugins_url( 'js/plugin.js', MKDO_LPFC_ROOT );
		wp_enqueue_script( 'link-picker-for-cmb2', $plugin_js_url, array( 'jquery', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'thickbox', 'wpdialogs', 'wplink' ), '1.3.0', true );
	}
}
