<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
    }
    


    public function autentifikasi()
    {
        //ambil post
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //cek autentifikasi
        $this->db->like('username',$username, 'none');
        $data = $this->db->get('user')->row_array();  
        $key = 'super-secret-key';

        if($data != null){
            if($this->encrypt->decode($data['password'], $key) == $password){                
                return $data;                              
            }
        }else{
            return $data = null;            
        }
    }    


    public function insertUser()
    {
        $key = 'super-secret-key';
        $nik = $this->input->post('nik');
        $nama_lengkap = $this->input->post('nama_lengkap');
        $password = $this->encrypt->encode($this->input->post('password'), $key);
        $username = $this->input->post('username');
        $telp = $this->input->post('telp');
        

        $data = [
            'kode_akun' => $nik,
            'nama_lengkap' => $nama_lengkap,
            'username' => $username,
            'password' => $password,
            'telp' => $telp,
            'level' => 'masyarakat'
        ];
        $this->db->insert('user', $data);
        
    }

}

/* End of file Auth_model.php */

 ?>