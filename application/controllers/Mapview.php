<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapview extends MY_Controller {

   

    function index()
        {
		

    // return 'medical_view/site/main2';
    $this->load->view('frames/category_map_view/header');
    $this->load->view('medical_view/site/category_map_view');
    $this->load->view('frames/category_map_view/footer');
    
}
}

?>