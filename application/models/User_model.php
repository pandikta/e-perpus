<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->get('tb_pengguna')->result_array();
    }

    // Check username exists
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('tb_pengguna', array('username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function editPengguna($id)
    {
        $data = array(
            'nama' => $this->input->post('nama', true),
            'username' => $this->input->post('username', true),
            'password' => $this->input->post('password'),
            'level' => $this->input->post('level')
        );

        $this->db->where('id', $id);
        $this->db->update('tb_pengguna', $data);
    }

    public function deletePengguna($id)
    {
        $this->db->delete('tb_pengguna', ['id' => $id]);
    }
}
