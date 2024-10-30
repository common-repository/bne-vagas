<?php

/**
 * The job post.
 *
 * Defines the properties to job posts.
 *
 * @package    BNE
 * @subpackage BNE/public;lib
 * @author     Fabrício Pereira<fabriciopereira@bne.com.br>
 */
class Job_Search_Result
{
    /**
    * The job post list.
    *
    * @since    1.0.0
    * @access   private
    * @var      Job_Post[]
    */
    private $jobs;

    /**
    * The total number of jobs in the search.
    *
    * @since    1.0.0
    * @access   private
    * @var      int
    */
    private $count;

    /**
    * The total number of pages.
    *
    * @since    1.0.0
    * @access   private
    * @var      int
    */
    private $pages;
     
    /**
    * Initialize the job post and set its properties.
    *
    * @since    1.0.0
    * @param      string    $BNE       The name of the plugin.
    * @param      string    $version    The version of this plugin.
    */
    public function __construct($jobs, $count, $pages)
    {
         
        $this->jobs = $jobs;
        $this->count = $count;
        $this->pages = $pages;
    }
 
    /**
    * Gets ID
    * @return string
    */
    public function getID()
    {
        return $this->ID;
    }

    /**
    * Gets the jobs.
    * @return Job_Post[]
    */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
    * Gets total number of jobs in the search.
    * @return string
    */
    public function getCount()
    {
        return $this->count;
    }

    /**
    * Gets The total number of pages.
    * @return string
    */
    public function getPages()
    {
        return $this->pages;
    }
}
