<?php

// Declares the interface to integrate with other systems
interface I_Job_Integration
{
    /**
    * Gets the job posts in database
    *
    * @since    1.0.0
    * @param      string    $query              The query.
    * @param      int       $page               The page to be retrieved (first page = 1)
    * @param      int       $results_per_page   The number of records per page
    */
    public function GetJobs($query, $page, $results_per_page, $sigla_estados, $cidade);
}