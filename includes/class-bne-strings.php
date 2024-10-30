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
class BNE_Strings {

    const JOB_SEARCH_FORM_SHORTCODE_NAME = 'bne-job-search-form';
    const JOB_SEARCH_RESULTS_SHORTCODE_NAME = 'bne-job-search-results';

    const URL_PROD_OPTION_NAME = 'https://plugin-api.vagas.bne.com.br/api/v1/Lists/Jobs';

    const JOB_SEARCH_RESULT_DEFAULT_URL = '/bne-vagas';
    const JOB_SEARCH_RESULT_URL_OPTION_NAME = 'bne_job_search_result_url';
    const JOB_SEARCH_RESULT_PAGE_ID_OPTION_NAME = 'bne_job_search_result_page_id';
    const JOB_SEARCH_RESULT_REWRITE_REGEX_OPTION_NAME = 'bne_job_search_result_rewrite_regex';
    const JOB_SEARCH_RESULT_REWRITE_DESTIN_OPTION_NAME = 'bne_job_search_result_rewrite_destin';
    const JOB_SEARCH_RESULTS_PER_PAGE_OPTION_NAME = 'bne_job_search_results_per_page';
    const JOB_SEARCH_RESULTS_PER_PAGE_DEFAULT_VALUE = '10';

    const JOB_VIEW_URL_OPTION_NAME = 'bne_job_view_url';
    const JOB_VIEW_PAGE_ID_OPTION_NAME = 'bne_job_view_page_id';
    const JOB_VIEW_REWRITE_REGEX_OPTION_NAME = 'bne_job_view_rewrite_regex';
    const JOB_VIEW_REWRITE_DESTIN_OPTION_NAME = 'bne_job_view_rewrite_destin';

}