<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/login_header');
            $this->load->view('admin/v_login');
            $this->load->view('templates/login_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        //query kan dlu
        $user = $this->db->get_where('tb_pengguna', ['username' => $username])->row_array();

        if ($password == $user['password']) {
            $data = [
                'username' => $user['username'],
                'level' => $user['level']
            ];
            //jika lolos masukkan ke session
            $this->session->set_userdata($data);

            //lalu cek role
            if ($user['level'] == 'administrator') {
                redirect('admin'); //diarahkan ke method index admin
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password/Username Salah</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Keluar! </div>');
        redirect('auth');
    }
}
