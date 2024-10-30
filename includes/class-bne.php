<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    BNE
 * @subpackage BNE/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    BNE
 * @subpackage BNE/includes
 * @author     Your Name <email@example.com>
 */
class BNE
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      BNE_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;
        
		/**
     * The integrator that's responsible integrations
     *
     * @since    1.0.0
     * @access   protected
     * @var      I_Job_Integration    $integrator    Maintains and registers all hooks for the plugin.
     */
    protected $integrator;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $BNE    The string used to uniquely identify this plugin.
     */
    protected $BNE;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the bne and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {

        $this->BNE = 'bne';
				$this->version = '1.0.0';
				
				$this->load_dependencies();
        $this->set_locale();
				
				/**
        * Loding integration with BNE
        */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/BNE_Job_Integration.php';
        $this->integrator = new BNE_Job_Integration();

        $this->define_admin_hooks();
        $this->define_public_hooks();
				
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - BNE_Loader. Orchestrates the hooks of the plugin.
     * - BNE_i18n. Defines internationalization functionality.
     * - BNE_Admin. Defines all hooks for the admin area.
     * - BNE_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class thar contains the strings with the names used in plugin
         */
         require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/interface-bne-integration.php';

        /**
         * The class thar contains the strings with the names used in plugin
         */
         require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bne-strings.php';

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bne-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bne-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bne-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-bne-public.php';

        $this->loader = new BNE_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the BNE_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new BNE_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        if (!is_admin()) {
            return;
        }

        $plugin_admin = new BNE_Admin( $this->get_BNE(), $this->get_version() );
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_public = new BNE_Public( $this->get_BNE(), $this->get_version(), $this->integrator );
        
        $this->loader->add_action('init', $plugin_public, 'add_rewrite_rule');
        $this->loader->add_action('admin_post_nopriv_login_cv', $plugin_public, 'login_post');
        $this->loader->add_action('admin_post_login_cv', $plugin_public, 'login_post');
        $this->loader->add_action('admin_post_nopriv_apply_to_job', $plugin_public, 'apply_to_job_post');
        $this->loader->add_action('admin_post_apply_to_job', $plugin_public, 'apply_to_job_post');
        $this->loader->add_action('admin_post_nopriv_register_cv', $plugin_public, 'register_cv_post');
        $this->loader->add_action('admin_post_register_cv', $plugin_public, 'register_cv_post');
        
        $this->loader->add_filter('generate_rewrite_rules', $plugin_public, 'when_rewrite_rules');
        $this->loader->add_filter('wp_loaded', $plugin_public, 'flush_rewrite_rules');
        $this->loader->add_filter('query_vars', $plugin_public, 'insert_query_vars');
        
        $this->loader->add_shortcode(BNE_Strings::JOB_SEARCH_FORM_SHORTCODE_NAME, $plugin_public, 'job_search_form_shortcode');
        $this->loader->add_shortcode(BNE_Strings::JOB_SEARCH_RESULTS_SHORTCODE_NAME, $plugin_public, 'job_search_result_shortcode');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_BNE()
    {
        return $this->BNE;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    BNE_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
