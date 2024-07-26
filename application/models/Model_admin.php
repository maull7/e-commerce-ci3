<?php
class Model_admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function edit()
    {
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
                $data = [
                    'nama_barang' => $namaBarang,
                    'keterangan' => $keterangan,
                    'kategori' => $kategori,
                    'harga' => $harga,
                    'stok' => $stok,
                    'gambar' => $gambar
                ];
            }
        } else {

            $data = [
                'nama_barang' => $namaBarang,
                'keterangan' => $keterangan,
                'kategori' => $kategori,
                'harga' => $harga,
                'stok' => $stok
            ];
        }




        $this->db->where('id', $this->input->post('id'));
        $this->db->update('barang', $data);
        $this->session->set_flashdata('messege', '<div class="alert alert-success" role="alert">
        berhasil mengubah data!!
        </div>');
        redirect('admin/data');
    }
    public function insertInvoice()
    {
        $data = [
            'nama_penerima' => $this->input->post('nama_penerima', true),
            'alamat_penerima' => $this->input->post('alamat_penerima', true),
            'no_telepon' => $this->input->post('no_telepon', true),
            'metode_pembayaran' => $this->input->post('metode_pembayaran', true),
            'jasa_pengiriman' => $this->input->post('jasa_pengiriman', true),
            'tanggal_dipesan' => date('Y-m-d H:i:s'),
            'batas_dibayar' => date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y')))
        ];
        $this->db->insert('invoice', $data);
        $id_invoice = $this->db->insert_id();

        foreach ($this->cart->contents() as $items) {
            $pesanan = [
                'id_invoice' => $id_invoice,
                'id_brg' => $items['id'],
                'nama_barang' => $items['name'],
                'jumlah' => $items['qty'],
                'harga' => $items['price'],
            ];
            $this->db->insert('pesanan', $pesanan);
        }
        return true;
    }

    public function ambil_id_invoice($id_invoice)
    {
        $result = $this->db->where('id', $id_invoice)->limit(1)->get('invoice');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
    public function ambil_id_pesanan($id_invoice)
    {
        $result = $this->db->where('id_invoice', $id_invoice)->get('pesanan');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}
