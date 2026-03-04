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
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Enqueue Scripts
	 *
	 * @param string $hook_suffix Current admin page.
	 */
	public function admin_enqueue_scripts( $hook_suffix ) {

		global $post_id;

		$allowed_hooks = apply_filters(
			'mkdo_lpfc_allowed_admin_hooks',
			array(
				'post.php',
				'post-new.php',
				'profile.php',
				'user-edit.php',
				'term.php',
				'edit-tags.php',
				'comment.php',
				'nav-menus.php',
			)
		);

		if ( ! in_array( $hook_suffix, $allowed_hooks, true ) ) {
			return;
		}

		/* CSS */
		$plugin_css_url = plugins_url( 'css/plugin.css', MKDO_LPFC_ROOT );
		wp_enqueue_style( 'link-picker-for-cmb2', $plugin_css_url, array(), MKDO_LPFC_VERSION );

		/* Media */
		if ( ! empty( $post_id ) ) {
			wp_enqueue_media( array( 'post' => absint( $post_id ) ) );
		} else {
			wp_enqueue_media();
		}

		/* JS */
		$plugin_js_url = plugins_url( 'js/plugin.js', MKDO_LPFC_ROOT );
		wp_enqueue_script( 'link-picker-for-cmb2', $plugin_js_url, array( 'jquery', 'thickbox', 'wplink' ), MKDO_LPFC_VERSION, true );
	}
}
