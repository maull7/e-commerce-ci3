<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_login();
    }
    public function index()
    {
        $data['title'] = 'home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->db->get('barang')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
    public function detail_produk($id)
    {
        $data['title'] = 'home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->db->get_where('barang', ['id' => $id])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('home/detail_produk', $data);
        $this->load->view('templates/footer');
    }
    public function kategori_elektronik()
    {
        $data['title'] = 'home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['elektronik'] = $this->db->get_where('barang', ['kategori' => 'elektronik'])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('home/kategori_elektronik', $data);
        $this->load->view('templates/footer');
    }
    public function kategori_pakaian()
    {
        $data['title'] = 'home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pakaian'] = $this->db->get_where('barang', ['kategori' => 'pakaian'])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('home/kategori_pakaian', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_keranjang($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $barang = $this->db->get_where('barang', ['id' => $id])->row_array();
        $data = array(
            'id'      => $barang['id'],
            'qty'     => 1,
            'price'   => $barang['harga'],
            'name'    => $barang['nama_barang']
        );

        $this->cart->insert($data);
        redirect('home');
    }

    public function detail_keranjang()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'detail keranjang';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('home/keranjang');
        $this->load->view('templates/footer');
    }
    public function hapus_items($rowid)
    {
        $data = array(
            'rowid' => $rowid,
            'qty'   => 0
        );
        $this->cart->update($data);
        redirect('home/detail_keranjang');
    }
    public function hapus_keranjang()
    {
        $this->cart->destroy();
        redirect('home/index');
    }
    public function pembayaran()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'pembayaran belanja';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('home/pembayaran');
        $this->load->view('templates/footer');
    }
    public function pembayaran_pesanan()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        date_default_timezone_set('Asia/Jakarta');
        $data['title'] = 'pembayaran belanja';
        $this->form_validation->set_rules('nama_penerima', 'NamaPenerima', 'required|trim');
        $this->form_validation->set_rules('alamat_penerima', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'Notelepeon', 'required|trim');
        $this->form_validation->set_rules('metode_pembayaran', 'metodePembayaran', 'required');
        $this->form_validation->set_rules('jasa_pengiriman', 'jasaPengirim', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('home/pembayaran');
            $this->load->view('templates/footer');
        } else {
            $this->load->model('Model_admin');
            $this->Model_admin->insertInvoice();
            $this->cart->destroy();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('home/pembayaran_sukses');
            $this->load->view('templates/footer');
        }
        //     $data = [
        //         'nama_penerima' => $this->input->post('nama_penerima', true),
        //         'alamat_penerima' => $this->input->post('alamat_penerima', true),
        //         'no_telepon' => $this->input->post('no_telepon', true),
        //         'metode_pembayaran' => $this->input->post('metode_pembayaran', true),
        //         'jasa_pengiriman' => $this->input->post('jasa_pengiriman', true),
        //         'tanggal_dipesan' => date('Y-m-d H:i:s'),
        //         'batas_dibayar' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y')))
        //     ];
        //     $this->db->insert('invoice', $data);
        //     $id_invoice = $this->db->insert_id();

        //     foreach ($this->cart->contents() as $item) {
        //         $pesanan = [
        //             'id_invoice' => $id_invoice,
        //             'id_brg' => $item['id'],
        //             'nama_barang' => $item['name'],
        //             'jumlah' => $item['qty'],
        //             'harga' => $item['price']
        //         ];
        //         $this->db->insert('pesanan', $pesanan);
        //         return true;
        //     }
        //     var_dump($pesanan);
        //     die;
        // }
    }
}
