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
class Job_Post
{
    
    /**
     * The job post ID.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
    private $ID;

    /**
     * The job post title.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
    private $title;
    
    /**
     * The job post location.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
    private $location;

    /**
     * The job post description.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
    private $description;

    /**
     * The job post short description.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
     private $short_description;
    
    /**
     * The job post url.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
    private $url;
    
    /**
     * Initialize the job post and set its properties.
     *
     * @since    1.0.0
     * @param      string    $BNE       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($ID, $title, $location, $description, $short_description, $url)
    {
        
        $this->ID = $ID;
        $this->title = $title;
        $this->location = $location;
        $this->description = $description;
        $this->short_description = $short_description;
        $this->url = $url;

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
     * Gets Title
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

     /**
     * Gets Location
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Gets Description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Gets Assignments
     * @return string
     */
     public function getShortDescription($limita = 100, $limpar = true)
     {
	     if($limpar = true){
		     $this->short_description = strip_tags($this->short_description);
	     }

        if(strlen($this->short_description) < $limita){
            return $this->short_description;
        }
        return mb_substr($this->short_description, 0, $limita) . "...";
    }

    /**
     * Gets Url
     * @return string
     */
     public function getUrl()
     {
         return $this->url;
     }

}
