<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainset extends MY_Controller {

   

    function index()
        {
		

    // return 'medical_view/site/main2';
    $this->load->view('frames/main/header');
    $this->load->view('medical_view/site/main2');
    $this->load->view('frames/main/footer');
    
}
}

?>