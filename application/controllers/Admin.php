<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function index()
    {
        $this->load->view('templates/admin_header');
        $this->load->view('templates/admin_navigation');
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/v_admin');
        $this->load->view('templates/admin_footer');
    }

    public function managePengguna()
    {
        $data['level'] = ['administrator', 'pengurus'];
        $data['tampiluser'] = $this->User_model->getAllUser();
        $this->load->view('templates/admin_header');
        $this->load->view('templates/admin_navigation');
        $this->load->view('templates/admin_sidebar');
        $this->load->view('admin/v_managepengguna', $data);
        $this->load->view('templates/admin_footer');
    }

    public function tambah_pengguna()
    {
        $data['tampiluser'] = $this->User_model->getAllUser();
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/admin_header');
            $this->load->view('templates/admin_navigation');
            $this->load->view('templates/admin_sidebar');
            $this->load->view('admin/v_managepengguna', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'username' => $this->input->post('username', true),
                'password' => $this->input->post('password'),
                'level' => $this->input->post('level')
            );

            $this->db->insert('tb_pengguna', $data);
            $this->session->set_flashdata('message', 'Di tambahkan');
            redirect('admin/managepengguna'); //lari ke folder menu lalu ke file submenu yg ada di views
        }
    }

    public function edit_pengguna($id)
    {
        $this->User_model->editPengguna($id);
        $this->session->set_flashdata('message', 'Di Edit');
        redirect('admin/managepengguna'); //lari ke folder menu lalu ke file submenu yg ada di views
    }

    public function delete_pengguna($id)
    {
        $this->User_model->deletePengguna($id);
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('admin/managepengguna');
    }

    public function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'Username telah digunakan');
        if ($this->User_model->check_username_exists($username)) {
            return true;
        } else {
            return false;
        }
    }
}
