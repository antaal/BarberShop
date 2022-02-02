<?php
/**
 * CosmosWP Notice Handler
 *
 * @author  wppotter
 * @package potter
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class to handle notices and Advanced Demo Import
 *
 * Class CosmosWP_Potter_Kit
 */
class Potter_Potter_Kit {

	/**
	 * Empty Constructor
	 */
	public function __construct() {}

	/**
	 * Gets an instance of this object.
	 * Prevents duplicate instances which avoid artefacts and improves performance.
	 *
	 * @static
	 * @access public
	 * @since 1.0.0
	 * @return object
	 */
	public static function instance() {
		// Store the instance locally to avoid private static replication
		static $instance = null;

		// Only run these methods if they haven't been ran previously
		if ( null === $instance ) {
			$instance = new self();
		}

		// Always return the instance
		return $instance;
	}

	/**
	 * Initialize the class
	 *
	 * 3 Different Process
	 */
	public function run() {
		$this->advanced_demo_import();
	}

	/**
	 * Help if user use demo import
	 * return array
	 */
	public function advanced_demo_import() {
		add_action( 'potter_kit_replace_post_ids', array( $this, 'replace_post_ids' ), 20 );
		add_action( 'potter_kit_replace_term_ids', array( $this, 'replace_term_ids' ), 20 );
	}

	/**
	 * Advance Demo import process
	 * Active callback of potter_kit_replace_post_ids
	 * return array
	 */
	public function replace_post_ids( $replace_post_ids ) {

		/*Post IDS*/
		$post_ids = array(
			'potter-feature-post-one',
			'potter-feature-post-two',
		);

		return array_merge( $replace_post_ids, $post_ids );
	}

	/**
	 * Advance Demo import process
	 * Active callback of potter_kit_replace_term_ids
	 * return array
	 */
	public function replace_term_ids( $replace_term_ids ) {

		/*Terms IDS*/
		$term_ids = array(
			'potter-feature-cat',
		);

		return array_merge( $replace_term_ids, $term_ids );
	}
}

/**
 * Begins execution of the hooks.
 *
 * @since    1.0.0
 */
function potter_potter_kit() {
	return Potter_Potter_Kit::instance();
}
potter_potter_kit()->run();
