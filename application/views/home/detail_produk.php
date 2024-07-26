<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <img src="<?= base_url('assets/img/') . $barang['gambar']; ?>" alt="" class="img-thumbnail">
        </div>
        <div class="col-lg-8">
            <table class="table table-striped">
                <tr>
                    <td>NAMA BARANG :</td>
                    <td><?= $barang['nama_barang']; ?></td>
                </tr>
                <tr>
                    <td>KETERANGAN BARANG :</td>
                    <td><?= $barang['keterangan']; ?></td>
                </tr>
                <tr>
                    <td>KATEGORI BARANG :</td>
                    <td><?= $barang['kategori']; ?></td>
                </tr>
                <tr>
                    <td>HARGA BARANG :</td>
                    <td>Rp. <?= number_format($barang['harga'], 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>STOK BARANG :</td>
                    <td><?= $barang['stok']; ?></td>
                </tr>
                <tr>
                    <td><a href="<?= base_url('home'); ?>" class="btn btn-warning">KEMBALI</a></td>
                    <td><a href="<?= base_url('home/tambah_keranjang/') . $barang['id']; ?>" class="btn btn-primary">TAMBAH KERANJANG</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>