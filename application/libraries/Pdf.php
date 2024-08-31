<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'libraries/fpdf/fpdf.php';

class Pdf extends FPDF
{
    // You can add customizations here if needed
    function __construct()
    {
        parent::__construct();
    }
}
