<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();

        if(empty($this->session->userdata('user'))){
            if($this->session->userdata('level') != 'masyarakat'){
                redirect('auth','refresh');
            }
        }
    }
    
    
    public function index()
    {                          
        $data['title'] = 'Dasboard';
        
        $this->load->view('layouts/top', $data);       
        $this->load->view('layouts/side' , $data);    
        $this->load->view('Home/dashboard');     
        $this->load->view('layouts/footer');  
    }
}

/* End of file Home.php */
