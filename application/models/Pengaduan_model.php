<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan_model extends CI_Model {

    public function getAll($nik, $limit, $start)
    {        
        $this->db->select('pengaduan.id_pengaduan, pengaduan.tgl_pengaduan, pengaduan.nik, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, tanggapan.tgl_tanggapan, tanggapan.isi_tanggapan, tanggapan.id_tanggapan');
        $this->db->where('nik', $nik);
        $this->db->join('tanggapan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan', 'left');
        return $this->db->get('pengaduan',$limit, $start)->result_array();

    }

    public function countRows($nik)
    {
        $this->db->select('pengaduan.id_pengaduan, pengaduan.tgl_pengaduan, pengaduan.nik, pengaduan.isi_laporan, pengaduan.foto, pengaduan.status, tanggapan.tgl_tanggapan, tanggapan.isi_tanggapan, tanggapan.id_tanggapan');
        $this->db->where('nik', $nik);
        $this->db->join('tanggapan', 'pengaduan.id_pengaduan = tanggapan.id_pengaduan', 'left');
        $this->db->from('pengaduan');
        return $this->db->count_all_results();
        
    }

    public function insertAduan($foto)
    {        
        $aduan = $this->input->post('isi_aduan');
        $nik = $this->session->userdata('nik');             

        $datestring = '%Y-%m-%d';        
        $data = [
            'id_pengaduan' => '',
            'tgl_pengaduan' => mdate($datestring),
            'nik' => $nik,
            'isi_laporan' => $aduan,
            'foto' => $foto,
            'status' => 'Proses'
        ];
        $this->db->insert('pengaduan', $data);
        return $this->db->get('pengaduan')->num_rows();
    }

    public function getAduanbyId($id_pengaduan)
    {
        return $this->db->where('id_pengaduan',$id_pengaduan)->get('pengaduan')->row_array();
    }

    public function updateAduan()
    {
        $id_pengaduan = $this->input->post('id_pengaduan');
        $dt['tgl_pengaduan'] = mdate('%Y-%m-%d');
        $dt['isi_laporan'] = $this->input->post('isi_aduan');
        $dt['status'] = 'proses';

        if (empty($foto)) {
            $foto = $this->input->post('old_foto');
        }

        $this->db->where('id_pengaduan', $id_pengaduan)->update('pengaduan', $dt);
    }

    public function deleteAduan($id)
    {
        $data = $this->getAduanbyId($id);
        @unlink('./assets/img/'.$data['foto']);
        $quary = $this->db->where('id_pengaduan', $id)->delete('pengaduan');
    }

}

/* End of file Pengaduan_model.php */
