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
        $data['title'] = 'Login';
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/index');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                switch ($user['role_id']) {
                    case 1:
                        redirect('home/index');
                        break;
                    case 2:
                        redirect('admin/index');
                        break;
                    default:
                        break;
                }
            } else {
                $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
                gagal mengirimkan data!!
                </div>');;
            }
        } else {
            $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
                gagal mengirimkan data!!
                </div>');;
        }
    }



    public function registrasi()
    {
        $data['title'] = 'Registrasi';
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'Data email sudah tersimpan']);
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|matches[password2]|min_length[3]',
            [
                'matches' => 'password tidak sama',
                'min_length' => 'minimal password 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password2]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'image' => 'default.jpg'
            ];
            $this->db->insert('user', $data);
            redirect('auth/index');
        }
    }
    public function registrasi_admin()
    {
        $data['title'] = 'Registrasi admin';
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'Data email sudah tersimpan']);
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|matches[password2]|min_length[3]',
            [
                'matches' => 'password tidak sama',
                'min_length' => 'minimal password 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password2]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi_admin');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'image' => 'default.jpg'
            ];
            $this->db->insert('user', $data);
            redirect('auth/index');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        redirect('auth');
    }
}
