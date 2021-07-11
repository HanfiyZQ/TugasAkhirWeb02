<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];


            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your profile has been updated</div>');
            redirect('user');
        }
    }


    public function peminatLowongan()
    {
        $data['title'] = 'Peminat Lowongan';
        $data['user'] = $this->db->get_where('prodi', ['id' =>
        $this->session->userdata('id')])->row_array();
        $data['user'] = $this->db->get_where('lowongan', ['id' =>
        $this->session->userdata('id')])->row_array();
        $this->load->model('User_model', 'nama');
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();


        $data['peminat_lowongan'] = $this->nama->getPeminatLowongan();
        $data['peminatlowongan'] = $this->db->get('peminat_lowongan')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['lowongan'] = $this->db->get('lowongan')->result_array();


        $this->form_validation->set_rules('nim', 'Nim', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required');
        $this->form_validation->set_rules('prodi_id', 'Prodi_id', 'required');
        $this->form_validation->set_rules('lowongan_id', 'Lowongan_id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/peminatlowongan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'alasan' => $this->input->post('alasan'),
                'prodi_id' => $this->input->post('prodi_id'),
                'lowongan_id' => $this->input->post('lowongan_id')
            ];
            $this->db->insert('peminat_lowongan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New sub menu has been added</div>');
            redirect('user/peminatlowongan');
        }
    }

    public function deletepeminatlowongan($id)
    {
        $this->load->model('User_model');
        $this->User_model->deleteDataPeminatLowongan($id);
        $this->session->set_flashdata('peminat_lowongan', 'deleted');
        redirect('user/peminatlowongan');
    }


    public function editpeminatlowongan($id)
    {
        $this->load->model('User_model');
        $data['title'] = 'Edit Peminat Lowongan';
        $data['peminat_lowongan'] = $this->User_model->getPeminatLowonganById($id);

        $this->form_validation->set_rules('nim', 'Nim', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alasan', 'Alasan', 'required');
        $this->form_validation->set_rules('prodi_id', 'Prodi_id', 'required');
        $this->form_validation->set_rules('lowongan_id', 'Lowongan_id', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/editpeminatlowongan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->User_model->editpeminatlowongan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Peminat lowongan has been edited</div>');
            redirect('user/peminatlowongan');
        }
    }
}
