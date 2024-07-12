<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper('date');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        
        if($this->session->userdata('user')){
            if($this->session->userdata('level') != 'admin' && $this->session->userdata('level') != 'petugas' ){
                redirect('auth/logout','refresh');
            }
       }else{
            redirect('auth','refresh');
       }
        
    }    

    public function tampilUserm()
    {
        $data['title'] = 'Data Masyarakat';
        $data['nik'] = $this->session->userdata('nik');   
        
        $config['base_url'] = 'http://localhost:8080/pengaduan/admin/D_user';
        $config['total_rows'] = $this->Admin_model->countRows('masyarakat', null, null);
        $config['per_page'] = 5;
        $data['start'] = $this->uri->segment(3);
        
        $this->pagination->initialize($config);        
        
        $data['datauser'] = $this->Admin_model->getUserm($config['per_page'], $data['start']);
        $this->load->view('layouts/top', $data);
        $this->load->view('admin/D_user', $data);
        $this->load->view('layouts/footer');      
    }

    public function tampilUserp()
    {
        $data['title'] = 'Data Petugas';
        $data['nik'] = $this->session->userdata('nik');   

        $config['base_url'] = 'http://localhost:8080/pengaduan/admin/D_user';
        $config['total_rows'] = $this->Admin_model->countRows('petugas', null, null);
        $config['per_page'] = 5;
        $data['start'] = $this->uri->segment(3);
        
        $this->pagination->initialize($config);        

        $data['datauser'] = $this->Admin_model->getUserp($config['per_page'], $data['start']);

        $this->load->view('layouts/top', $data);
        $this->load->view('admin/D_user', $data);
        $this->load->view('layouts/footer');      
    }

    public function tampilAduan()
    {
        $data['title'] = 'Aduan Masuk';
        
        $config['base_url'] = 'http://localhost:8080/pengaduan/admin/tampilAduan';
        $config['total_rows'] = $this->Admin_model->countRows(null, 'aduan', null);
        $config['per_page'] = 5;
        $data['start'] = $this->uri->segment(3);
        
        $this->pagination->initialize($config);        
        
        $data['dataaduan'] = $this->Admin_model->getAduan($config['per_page'], $data['start']);
        
        $this->load->view('layouts/top', $data);
        $this->load->view('admin/aduan_masuk', $data);
        $this->load->view('layouts/footer');      
    }

    public function tampilTanggapan()
    {
        $data['title'] = 'Tanggapan';

        $config['base_url'] = 'http://localhost:8080/pengaduan/admin/tampilTanggapan';
        $config['total_rows'] = $this->Admin_model->countRows(null, null, 'tanggapan');
        $config['per_page'] = 5;
        $data['start'] = $this->uri->segment(3);
        
        $this->pagination->initialize($config);        
        
        $data['tanggapan'] = $this->Admin_model->getTanggapan($config['per_page'], $data['start']);
        
        $this->load->view('layouts/top', $data);
        $this->load->view('admin/tanggapan_keluar', $data);
        $this->load->view('layouts/footer');      
    }

    public function tampiltgpbyId()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Admin_model->getTanggapanbyId($id));
    }

    public function tampilAduanbyId()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Admin_model->getAduanbyId($id));
       
    }

    public function tambahTanggapan()
    {
        
        $this->form_validation->set_rules('isi_tanggapan', 'Isi Tanggapan', 'required');
        
        if ($this->form_validation->run() == TRUE) {
            $this->Admin_model->insertTanggapan();
            $this->session->set_flashdata('flash', 'Ditanggapi');
            redirect('admin/tampilAduan','refresh');
        } else {
            $this->session->set_flashdata('form', 'Dikosongkan');
            redirect('admin/tampilAduan','refresh');
        }
        
        
    }

    public function ubahTanggapan()
    {
        $this->form_validation->set_rules('isi_tanggapan', 'Isi Tanggapan', 'required');
        
        if ($this->form_validation->run() == TRUE) {
            $this->Admin_model->updateTanggapan();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('admin/tampilTanggapan','refresh');
        } else {
            $this->session->set_flashdata('form', 'Dikosongkan');
            redirect('admin/tampilTanggapan','refresh');
        }
    }
    
    public function verifAduan($id)
    {
        $this->Admin_model->verifikasi($id);
        $this->session->set_flashdata('flash', 'Diverfikasi');
        redirect('admin/tampilAduan','refresh');
    }

    public function hapusUser($level ,$id)
    {
        $this->Admin_model->delete('user', 'kode_akun', $id);
        $this->session->set_flashdata('flash', 'Dihapus');
        if($level == 'petugas'){
            redirect('admin/tampilUserp','refresh');
        }else{
            redirect('admin/tampilUserm','refresh');
        }
    }

    public function hapusTanggapan($id_tanggapan)
    {
        $this->Admin_model->deleteTanggapan($id_tanggapan);
        // $this->Admin_model->deleteAduan($id_pengaduan);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/tampilTanggapan','refresh');
    }

    public function hapusAduan($id)
    {
        $this->Admin_model->deleteAduan($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('admin/tampilAduan','refresh');
    }

}

/* End of file Admin.php */

?>
