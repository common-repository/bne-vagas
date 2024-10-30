<?php

/**
 * The job integration for BNE.
 *
 * @package    BNE
 * @subpackage BNE/public;lib
 * @author     Fabrício Pereira<fabriciopereira@bne.com.br>
 */
class BNE_Job_Integration implements I_Job_Integration
{
	public function __construct() {}

    /**
    * Gets the job posts in bne database
    *
    * @since    1.0.0
    * @param      string    $query              The query.
    * @param      int       $page               The page to be retrieved (first page = 1)
    * @param      int       $results_per_page   The number of records per page
    */
    public function GetJobs($query, $page, $results_per_page, $sigla_estados, $cidade)
    {
	    $url = BNE_Strings::URL_PROD_OPTION_NAME."?Page={$page}&ItemsPerPage={$results_per_page}";

	    if(trim($query) != "")
		    $url = $url . "&Title=$query";
	    if(trim($sigla_estados) != "")
		    $url = $url . "&State=$sigla_estados";
	    if(trim($cidade) != "")
		    $url = $url . "&City=$cidade";

	    $data = json_decode(file_get_contents($url));
			
	    if($data == null) return null;
		
        $jobs = array();
        $bne_jobs = $data->data->listVagas;

        foreach ($bne_jobs as $key => $bne_job) {
	        array_push($jobs, BNE_Job_Integration::GetJobPostFromVagaBne($bne_job) );
        }

        return new Job_Search_Result($jobs, $data->data->pagination->TotalCount, $data->data->pagination->TotalPages);
    }

	public static function GetJobPostFromVagaBne($bne_job){
		$title = $bne_job->Title;
		$location = $bne_job->City . "/" . $bne_job->State;
		$shortDescription = $bne_job->Description;

		if($shortDescription == "") $shortDescription = $title . " em " . $location . " área ". $bne_job->Area;
		
		$linkArea = mb_strtolower(preg_replace('/[ -]+/' , '-' , BNE_Job_Integration::TirarAcentos($bne_job->Area)));
		$linkCity = mb_strtolower(preg_replace('/[ -]+/' , '-' , BNE_Job_Integration::TirarAcentos($bne_job->City)));
		$linkState = mb_strtolower($bne_job->State);
		$linkFuncao = mb_strtolower(preg_replace('/[ -]+/' , '-' , BNE_Job_Integration::TirarAcentos($title)));
		$linkIdf = mb_strtolower($bne_job->Idf_Vaga);
		$url = "https://www.bne.com.br/vaga-de-emprego-na-area-{$linkArea}-em-{$linkCity}-{$linkState}/{$linkFuncao}/{$linkIdf}";

		return new Job_Post($bne_job->Id, $title, $location, $bne_job->Description, $shortDescription, $url);
	}

	public static function TirarAcentos($string){
		return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
	}
}
