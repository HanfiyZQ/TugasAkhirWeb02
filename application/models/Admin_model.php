<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getLowongan()
    {
        $query = "SELECT `lowongan`.*, `mitra`.`nama`
                    FROM `lowongan` JOIN `mitra`
                    ON `lowongan`.`mitra_id` = `mitra`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getMitra()
    {
        $query = "SELECT `mitra`.*, `bidang_usaha`.`nama`,`sektor_usaha`.`nama`
                    FROM `mitra` 
                    JOIN `bidang_usaha` ON `mitra`.`bidang_usaha_id` = `bidang_usaha`.`id`
                    JOIN `sektor_usaha` ON `mitra`.`sektor_usaha_id` = `sektor_usaha`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getLowonganKeahlian()
    {
        $query = "SELECT `lowongan_keahlian`.*, `keahlian`.`nama`,`lowongan`.`deskripsi_pekerjaan`
                    FROM `lowongan_keahlian` 
                    JOIN `keahlian` ON `lowongan_keahlian`.`keahlian_id` = `keahlian`.`id`
                    JOIN `lowongan` ON `lowongan_keahlian`.`lowongan_id` = `lowongan`.`id`
        ";
        return $this->db->query($query)->result_array();
    }


    public function deleteDataMitraKerja($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mitra');
    }

    public function deleteDataLowongan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('lowongan');
    }

    public function getMitraById($id)
    {
        return $this->db->get_where('mitra', ['id' => $id])->row_array();
    }

    public function editmitrakerja()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "alamat" => $this->input->post('alamat', true),
            "kontak" => $this->input->post('kontak', true),
            "telpon" => $this->input->post('telpon', true),
            "email" => $this->input->post('email', true),
            "web" => $this->input->post('web', true),
            "bidang_usaha_id" => $this->input->post('bidang_usaha_id', true),
            "sektor_usaha_id" => $this->input->post('sektor_usaha_id', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('mitra', $data);
    }

    public function getLowonganById($id)
    {
        return $this->db->get_where('lowongan', ['id' => $id])->row_array();
    }

    public function editlowongan()
    {
        $data = [
            "deskripsi_pekerjaan" => $this->input->post('deskripsi_pekerjaan', true),
            "tanggal_akhir" => $this->input->post('tanggal_akhir', true),
            "email" => $this->input->post('email', true),
            "mitra_id" => $this->input->post('mitra_id', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('lowongan', $data);
    }
}
