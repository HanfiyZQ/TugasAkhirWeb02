<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result =  $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access has been Changed</div>');
    }


    public function Lowongan()
    {
        $data['title'] = 'Lowongan';
        $data['user'] = $this->db->get_where('mitra', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');


        $data['lowongan'] = $this->admin->getLowongan();
        $data['admin'] = $this->db->get('mitra')->result_array();
        $data['mitra'] = $this->db->get('mitra')->result_array();



        $this->form_validation->set_rules('deskripsi_pekerjaan', 'Deskripsi_pekerjaan', 'required');
        $this->form_validation->set_rules('tanggal_akhir', 'Tanggal_akhir', 'required');
        $this->form_validation->set_rules('mitra_id', 'Mitra_id', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/lowongan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'deskripsi_pekerjaan' => $this->input->post('deskripsi_pekerjaan'),
                'tanggal_akhir' => $this->input->post('tanggal_akhir'),
                'mitra_id' => $this->input->post('mitra_id'),
                'email' => $this->input->post('email')
            ];
            $this->db->insert('lowongan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New lowongan has been added</div>');
            redirect('admin/lowongan');
        }
    }


    public function mitraKerja()
    {
        $data['title'] = 'Mitra Kerja';
        $data['user'] = $this->db->get_where('bidang_usaha', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get_where('sektor_usaha', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model');

        $data['mitra'] = $this->Admin_model->getMitra();
        $data['mitra'] = $this->db->get('mitra')->result_array();
        $data['bidangusaha'] = $this->db->get('bidang_usaha')->result_array();
        $data['sektorusaha'] = $this->db->get('sektor_usaha')->result_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_rules('telpon', 'Telpon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('web', 'Web', 'required');
        $this->form_validation->set_rules('bidang_usaha_id', 'Bidang_usaha_id', 'required');
        $this->form_validation->set_rules('sektor_usaha_id', 'Sektor_usaha_id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/mitrakerja', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kontak' => $this->input->post('kontak'),
                'telpon' => $this->input->post('telpon'),
                'email' => $this->input->post('email'),
                'web' => $this->input->post('web'),
                'bidang_usaha_id' => $this->input->post('bidang_usaha_id'),
                'sektor_usaha_id' => $this->input->post('sektor_usaha_id')
            ];
            $this->db->insert('mitra', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New mitra kerja has been added</div>');
            redirect('admin/mitrakerja');
        }
    }


    public function lowonganKeahlian()
    {
        $data['title'] = 'Lowongan Keahlian';
        $data['user'] = $this->db->get_where('keahlian', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get_where('lowongan', ['id' =>
        $this->session->userdata('id')])->row_array();
        $this->load->model('Admin_model', 'nama');
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['lowongan_keahlian'] = $this->nama->getLowonganKeahlian();
        $data['lowongan_keahlian'] = $this->db->get('lowongan_keahlian')->result_array();
        $data['keahlian'] = $this->db->get('keahlian')->result_array();
        $data['lowongan'] = $this->db->get('lowongan')->result_array();


        $this->form_validation->set_rules('keahlian_id', 'Keahlian_id', 'required');
        $this->form_validation->set_rules('lowongan_id', 'Lowongan_id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/lowongankeahlian', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'keahlian_id' => $this->input->post('keahlian_id'),
                'lowongan_id' => $this->input->post('lowongan_id')
            ];
            $this->db->insert('mitra', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New lowongan keahlian has been added</div>');
            redirect('admin/lowongankeahlian');
        }
    }


    public function deletemitrakerja($id)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->deleteDataMitraKerja($id);
        $this->session->set_flashdata('mitra', 'deleted');
        redirect('admin/mitrakerja');
    }

    public function deletelowongan($id)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->deleteDataLowongan($id);
        $this->session->set_flashdata('lowongan', 'deleted');
        redirect('admin/lowongan');
    }


    public function editmitrakerja($id)
    {
        $this->load->model('Admin_model');
        $data['title'] = 'Edit Data Mitra';
        $data['mitra'] = $this->Admin_model->getMitraById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_rules('telpon', 'Telpon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('web', 'Web', 'required');
        $this->form_validation->set_rules('bidang_usaha_id', 'Bidang_usaha_id', 'required');
        $this->form_validation->set_rules('sektor_usaha_id', 'Sektor_usaha_id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editmitrakerja', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editmitrakerja();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data mitra kerja has been edited</div>');
            redirect('admin/mitrakerja');
        }
    }


    public function editlowongan($id)
    {
        $this->load->model('Admin_model');
        $data['title'] = 'Edit Lowongan';
        $data['lowongan'] = $this->Admin_model->getLowonganById($id);
        $data['mitra_id'] = ['PT Rekayasa Indusri', 'PT Bukalapak'];

        $this->form_validation->set_rules('deskripsi_pekerjaan', 'Deskripsi_pekerjaan', 'required');
        $this->form_validation->set_rules('tanggal_akhir', 'Tanggal_akhir', 'required');
        $this->form_validation->set_rules('mitra_id', 'Mitra_id', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editlowongan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Admin_model->editlowongan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data lowongan has been edited</div>');
            redirect('admin/lowongan');
        }
    }
}
