<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengaduan_model');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->library('pagination');
        
       if($this->session->userdata('user')){
            if($this->session->userdata('level') != "masyarakat"){
                redirect('auth/logout','refresh');
            }
       }else{
            redirect('auth/logout','refresh');
       }
    }
    

    public function index()
    {
        $data['title'] = 'Pengaduan';
        $data['nik'] = $this->session->userdata('nik');   
        
        $config['base_url'] = 'http://localhost:8080/pengaduan/pengaduan/index';
        $config['total_rows'] = $this->Pengaduan_model->countRows($data['nik']);
        $config['per_page'] = 5;
        $data['start'] = $this->uri->segment(3);

        $this->pagination->initialize($config);        

        $data['aduan'] = $this->Pengaduan_model->getAll($data['nik'], $config['per_page'], $data['start']);
        $this->load->view('layouts/top', $data);
        $this->load->view('pengaduan/index', $data);
        $this->load->view('layouts/footer');      
    }
   
    public function tambahAduan()
    {
        // olah foto
        $this->form_validation->set_rules('isi_aduan', 'Isi Aduan', 'required|min_length[5]|max_length[100]');
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2000;
        
        
        $this->load->library('upload', $config);
        
        $this->upload->do_upload('bukti_foto');
        $data = array('upload_data' => $this->upload->data());

        //identifikasi params
        $foto = $data['upload_data']['orig_name'];
        
        if ($this->form_validation->run() == TRUE) {
            if($this->Pengaduan_model->insertAduan($foto) > 0 ){
                $this->session->set_flashdata('flash', 'Ditambahkan');            
                redirect('pengaduan','refresh');            
            }else{
                $this->session->set_flashdata('flash', 'gagal');            
                redirect('pengaduan','refresh');
            }
        } else {
            $this->session->set_flashdata('form', 'Dikosongkan');
            redirect('pengaduan','refresh');
            
        }
        
    }

    public function tampilAduanbyId()
    {
        $id = $this->input->post('id');
        $this->Pengaduan_model->getAduanbyId($id);
    }

    public function ubahAduan()
    {
        $this->form_validation->set_rules('isi_aduan', 'Isi Aduan', 'required|min_length[5]|max_length[100]');
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 2000;
        
        
        $this->load->library('upload', $config);
        
        $this->upload->do_upload('bukti_foto');
        $data = array('upload_data' => $this->upload->data());

        //identifikasi params
        $foto = $data['upload_data']['orig_name'];

        if ($this->form_validation->run() == TRUE) {
            
            $this->Pengaduan_model->updateAduan($foto);
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('pengaduan','refresh');
        } else {
            $this->session->set_flashdata('form', 'Dikosongkan');
            redirect('pengaduan','refresh');
        }
        
    }

    public function hapusAduan($id)
    {        
        $this->Pengaduan_model->deleteAduan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('pengaduan','refresh');        
    }


}

/* End of file Pengaduan.php */
