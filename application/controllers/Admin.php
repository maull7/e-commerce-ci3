<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // // $this->load->library('form_validation');
        is_login();
        block();
    }
    public function index()
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->db->get('barang')->result_array();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates_admin/footer');
    }

    public function data()
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->db->get('barang')->result_array();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/data');
        $this->load->view('templates_admin/footer');
    }
    public function tambah()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Admin';
        $data['barang'] = $this->db->get('barang')->result_array();
        $this->form_validation->set_rules('nama_barang', 'Nama', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim');
        $this->form_validation->set_rules('gambar', 'Gambar');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar', $data);
            $this->load->view('admin/data');
            $this->load->view('templates_admin/footer');
            redirect('admin/data');
        } else {
            $namaBarang = $this->input->post('nama_barang', true);
            $keterangan = $this->input->post('keterangan', true);
            $kategori = $this->input->post('kategori', true);
            $harga = $this->input->post('harga', true);
            $stok = $this->input->post('stok', true);
            $gambar = $_FILES['gambar']['name'];
            if ($gambar) {
                $config['upload_path']          = './assets/img/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|jfif';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
                    gagal upload gambar
                    </div>');
                    redirect('admin/data');
                    die;
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            } else {
                $this->session->set_flashdata('messege', '<div class="alert alert-danger" role="alert">
                gagal mengirimkan data!!
                </div>');

                redirect('admin/data');
            }


            $data = [
                'nama_barang' => $namaBarang,
                'keterangan' => $keterangan,
                'kategori' => $kategori,
                'harga' => $harga,
                'stok' => $stok,
                'gambar' => $gambar
            ];

            $this->db->insert('barang', $data);
            redirect('admin/data');
        }
    }

    public function hapus($id)
    {
        $data['title'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->db->get('barang')->result_array();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/data');
        $this->load->view('templates_admin/footer');

        $this->db->where('id', $id);
        $this->db->delete('barang');
        redirect('admin/data');
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
        Berhasil hapus data barang
        </div>');
    }

    public function edit($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['title'] = 'Admin';
        $data['barang'] = $this->db->get_where('barang', ['id' => $id])->row_array();
        $this->form_validation->set_rules('nama_barang', 'Nama', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|trim');
        $this->form_validation->set_rules('gambar', 'Gambar');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates_admin/header', $data);
            $this->load->view('templates_admin/sidebar', $data);
            $this->load->view('admin/editData', $data);
            $this->load->view('templates_admin/footer');
        } else {
            $this->load->model('Model_admin');
            $this->Model_admin->edit();
        }
    }

    public function invoice()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Invoice penjualan';
        $data['invoice'] = $this->db->get('invoice')->result_array();
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/invoice', $data);
        $this->load->view('templates_admin/footer');
    }
    public function detail_invoice($id_invoice)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail invoice penjualan';
        $this->load->model('Model_admin');
        $data['invoice'] = $this->Model_admin->ambil_id_invoice($id_invoice);
        $data['pesanan'] = $this->Model_admin->ambil_id_pesanan($id_invoice);
        $this->load->view('templates_admin/header', $data);
        $this->load->view('templates_admin/sidebar', $data);
        $this->load->view('admin/detail_invoice', $data);
        $this->load->view('templates_admin/footer');
    }
}
