<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the bne, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    BNE
 * @subpackage BNE/public
 * @author     Your Name <email@example.com>
 */
class BNE_Public
{

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
     * The integrator that's responsible integrations
     *
     * @since    1.0.0
     * @access   protected
     * @var      I_Job_Integration    $integrator    Maintains and registers all hooks for the plugin.
     */
    protected $integrator;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $BNE       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     * @param      I_Job_Integration    $integrator    The integrator object.
     */
    public function __construct($BNE, $version, $integrator)
    {
        $this->BNE = $BNE;
        $this->version = $version;
        $this->integrator = $integrator;
    }

    public function add_rewrite_rule()
    {
        // Loading rules
        $rules = get_option( 'rewrite_rules' );
        
        // Adds job view rule
        $rewriteRegex = get_option(BNE_Strings::JOB_VIEW_REWRITE_REGEX_OPTION_NAME);
        add_rewrite_rule($rewriteRegex,  get_option(BNE_Strings::JOB_VIEW_REWRITE_DESTIN_OPTION_NAME), 'top');

        // Adds search results rule
        $rewriteRegex = get_option(BNE_Strings::JOB_SEARCH_RESULT_REWRITE_REGEX_OPTION_NAME);
        add_rewrite_rule($rewriteRegex,  get_option(BNE_Strings::JOB_SEARCH_RESULT_REWRITE_DESTIN_OPTION_NAME), 'top');

        //update_option('rewrite_rules', $rules);
        flush_rewrite_rules();
    }

    /**
     * Defines the rewrite rules
    */
    public function insert_rewrite_rules($rules)
    {
        $newrules = array();
        $newrules[get_option(BNE_Strings::JOB_SEARCH_RESULT_REWRITE_REGEX_OPTION_NAME)+'/?\?$q=([^&]+)'] = get_option( BNE_Strings::JOB_SEARCH_RESULT_REWRITE_DESTIN_OPTION_NAME );
        return $newrules + $rules;
    }

    function when_rewrite_rules($wp_rewrite)
    {
        $new_rules = array();
        $new_rules[get_option(BNE_Strings::JOB_SEARCH_RESULT_REWRITE_REGEX_OPTION_NAME)] = get_option( BNE_Strings::JOB_SEARCH_RESULT_REWRITE_DESTIN_OPTION_NAME );
        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    }
    
    /**
     * flush_rules() if our rules are not yet included
    */
    function flush_rewrite_rules()
    {
        $rules = get_option( 'rewrite_rules' );

        if (! isset( $rules[get_option(BNE_Strings::JOB_SEARCH_RESULT_REWRITE_REGEX_OPTION_NAME)] )) {
            global $wp_rewrite;
            $wp_rewrite->flush_rules();
        }
    }

    /**
     * Adding the id var so that WP recognizes it
    */
    function insert_query_vars($vars)
    {
        array_push($vars, 'q', 'page_num', 'job-id', 'estado', 'cidade');
        return $vars;
    }

    /**
     * Job Search Result shortcode callback.
     *
     * @since    1.0.0
     */
    public function job_search_result_shortcode()
    {
        define("IMG_LOGO", plugin_dir_url( __FILE__ ). 'img/logo-bne.png');
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/lib/class-job-post.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/lib/class-job-search-result.php';
        
        $query = get_query_var('q');
		$sigla_estados = get_query_var('estado');
        $cidade = get_query_var('cidade')  == 'Selecione uma Cidade' ? '' : get_query_var('cidade');

        $job_search_result_url = get_home_url() .
          get_option( BNE_Strings::JOB_SEARCH_RESULT_URL_OPTION_NAME ) .
          "?q=" . urlencode($query);

	    if($sigla_estados != "") $job_search_result_url = $job_search_result_url . "&estado=" . $sigla_estados;
		if($cidade != "") $job_search_result_url = $job_search_result_url . "&cidade=" . $cidade;
        $page = get_query_var('page_num');
        if (empty($page)) {
            $page = 1;
        }

        $job_view_url = get_site_url() . get_option( BNE_Strings::JOB_VIEW_URL_OPTION_NAME );

        $search_result =  $this->integrator->GetJobs($query, $page, get_option( BNE_Strings::JOB_SEARCH_RESULTS_PER_PAGE_OPTION_NAME ), $sigla_estados, $cidade );

        wp_enqueue_style('bne-job-search-result-style', plugin_dir_url( __FILE__ ) . 'css/bne-public.css' );
        wp_enqueue_script('bne-job-search-result-script', plugin_dir_url( __FILE__ ) . 'js/cidade-estados.js', '', '', true );
        ob_start();
        include(plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/bne-job-search-result-shortcode.php');
        $content = ob_get_clean();
        return $content;
    }
}
