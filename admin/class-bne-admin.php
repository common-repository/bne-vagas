<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    BNE
 * @subpackage BNE/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the bne, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BNE
 * @subpackage BNE/admin
 * @author     Your Name <email@example.com>
 */
class BNE_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $BNE    The ID of this plugin.
	 */
	private $BNE;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $BNE       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $BNE, $version ) {

		$this->BNE = $BNE;
		$this->version = $version;

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for plugin admin area.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		
		/**
			* Creating admin area.
			*/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bne-option-page.php';
		$this->option_page = new BNE_Option_Page();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bne-strings.php';		
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BNE_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BNE_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->BNE, plugin_dir_url( __FILE__ ) . 'css/bne-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in BNE_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The BNE_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->BNE, plugin_dir_url( __FILE__ ) . 'js/bne-admin.js', array( 'jquery' ), $this->version, false );

	}

}
