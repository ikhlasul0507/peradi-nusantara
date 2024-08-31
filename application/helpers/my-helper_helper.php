<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function getAPI()
    {
    	$CI = get_instance();
    	$CI->load->model('Mbg');
    	if($CI->Mbg->getParameter('@usingDataWithAPI') == 1){
        	return "http://localhost/MASTER-VOTE-API/API/";
    	}
    }

    function helperGetParameter($value)
    {
    	$CI = get_instance();
    	$CI->load->model('Mbg');
    	return $CI->Mbg->getParameter($value);
    }   
}