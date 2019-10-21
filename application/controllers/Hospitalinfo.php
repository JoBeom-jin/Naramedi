<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospitalinfo extends MY_Controller {

   

    function index()
        {
		

    // return 'medical_view/site/main2';
    $this->load->view('frames/main/header');
    $this->load->view('medical_view/site/hospital_info');
    $this->load->view('frames/main/footer');
    
}
}

?>