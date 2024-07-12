<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function getUserm($limit, $start)
    {        
        return $this->db->where('level', 'masyarakat')->get('user', $limit, $start)->result_array();
    }

    public function countRows($level = null, $rowaduan = null, $rowtanggapan = null)
    {
        if ($level != null) {
            $this->db->where('level', $level)->get('user')->num_rows();
        }elseif($rowaduan != null){
            $this->db->join('user', 'pengaduan.nik = user.kode_akun', 'left');
            $this->db->where_not_in('status', 'selesai');
            $this->db->from('pengaduan');
            return $this->db->count_all_results();    
        }elseif($rowtanggapan != null){
            $this->db->join('user', 'user.kode_akun = tanggapan.id_petugas', 'left');
            $this->db->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan', 'left');
            $this->db->from('tanggapan');
            return $this->db->count_all_results();    
        }
    }

    public function getUserp($limit, $start)
    {        
        return $this->db->where('level', 'petugas')->get('user', $limit, $start)->result_array();
    }

    public function getAduan($limit, $start)
    {
        $this->db->join('user', 'pengaduan.nik = user.kode_akun', 'left');
        $this->db->where_not_in('status', 'selesai');
        return $this->db->get('pengaduan', $limit, $start)->result_array();
    }

    public function getTanggapan($limit, $start)
    {
        $this->db->join('user', 'user.kode_akun = tanggapan.id_petugas', 'left');
        $this->db->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan', 'left');
        return $this->db->get('tanggapan', $limit, $start)->result_array();
    
    }
    public function getTanggapanbyId($id)
    {
        $this->db->where('id_tanggapan', $id);
        $this->db->join('user', 'user.kode_akun = tanggapan.id_petugas', 'left');
        $this->db->join('pengaduan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan', 'left');
        return $this->db->get('tanggapan')->row_array();
    }

    public function getAduanbyId($id)
    {
        return $this->db->where('id_pengaduan', $id)->get('pengaduan')->row_array();
    }

    public function verifikasi($id)
    {
        $this->db->set('status', 'verifikasi');
        $this->db->where('id_pengaduan', $id)->update('pengaduan');
    }

    public function insertTanggapan()
    {
        $id_pengaduan = $this->input->post('id_pengaduan');
        $tgl_tanggapan = '%Y-%m-%d';
        $isi_tanggapan = $this->input->post('isi_tanggapan');
        $id_petugas = $this->session->userdata('nik');

        $data = [
            'id_pengaduan' => $id_pengaduan,
            'tgl_tanggapan' => mdate($tgl_tanggapan),
            'isi_tanggapan' => $isi_tanggapan,
            'id_petugas' => $id_petugas
            ];
        $this->db->insert('tanggapan', $data);

        //mengubah status pengaduan
        $this->db->set('status', 'selesai');
        $this->db->where('id_pengaduan', $id_pengaduan);
        $this->db->update('pengaduan');
        
    }

    public function updateTanggapan()
    {
        $data['id_tanggapan'] = $this->input->post('id_tanggapan');
        $data['tgl_tanggapan'] = mdate('%Y-%m-%d');
        $data['isi_tanggapan'] = $this->input->post('isi_tanggapan');
        $data['id_petugas'] = $this->session->userdata('nik');
        
        $this->db->where('id_tanggapan', $data['id_tanggapan']);
        $this->db->update('tanggapan', $data);
    }

    public function delete($table ,$field, $params)
    {
        $this->db->where($field, $params)->delete($table);
    }

    public function deleteTanggapan($id_tanggapan)
    {
        $this->db->where('id_tanggapan', $id_tanggapan)->delete('tanggapan');
    }

    public function deleteAduan($id)
    {
        $data = $this->getAduanbyId($id);
        @unlink('./assets/img/'.$data['foto']);
        $this->db->where('id_pengaduan', $id)->delete('pengaduan');
    }

}

/* End of file Admin_model.php */

?>