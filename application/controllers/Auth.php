<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');                 
    }
    
    public function index()
    {
        $data['title'] = 'Login';
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
                
        
        if ($this->form_validation->run() == TRUE)
        {            
           
            if ($this->Auth_model->autentifikasi() != null) 
            {                                              
                $data = $this->Auth_model->autentifikasi();                                            
                $array = [
                    'user' => $data['nama_lengkap'],
                    'nik' => $data['kode_akun'],
                    'level' => $data['level']
                ];      
                $this->session->set_userdata($array);         
                redirect('Home','refresh');                
            }
        }
        //user failed     
        $this->load->view('login', $data);
    }
    
    public function register()
    {
        $data['title'] = 'Registrasi';
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('telp', 'No. Telepon', 'required|numeric');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|min_length[5]');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

    
        if ($this->form_validation->run() == FALSE) 
        {            
            $this->load->view('register',$data);               
        } else {                
            $this->Auth_model->insertUser();
            redirect('auth','refresh');
        }    
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth','refresh');
    }
}
/* End of file Auth.php */
