<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function getPeminatLowongan()
    {
        $query = "SELECT `peminat_lowongan`.*, `prodi`.`nama`,`lowongan`.`deskripsi_pekerjaan`
                    FROM `peminat_lowongan` 
                    JOIN `prodi` ON `peminat_lowongan`.`prodi_id` = `prodi`.`id`
                    JOIN `lowongan` ON `peminat_lowongan`.`lowongan_id` = `lowongan`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function deleteDataPeminatLowongan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('peminat_lowongan');
    }

    public function getPeminatLowonganById($id)
    {
        return $this->db->get_where('peminat_lowongan', ['id' => $id])->row_array();
    }

    public function editpeminatlowongan()
    {
        $data = [
            "nim" => $this->input->post('nim', true),
            "nama" => $this->input->post('nama', true),
            "alasan" => $this->input->post('alasan', true),
            "prodi_id" => $this->input->post('prodi_id', true),
            "lowongan_id" => $this->input->post('lowongan_id', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('peminat_lowongan', $data);
    }
}
