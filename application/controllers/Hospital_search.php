<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital_search extends MY_Controller {

   

    function index()
        {
		

    // return 'medical_view/site/main2';
    $this->load->view('frames/hospital_search/header');
    $this->load->view('medical_view/site/hospital_search');
    $this->load->view('frames/hospital_search/footer');
    
}
}

?>