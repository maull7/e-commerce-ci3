<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn-success">
                <?php
                $grandTotal = 0;
                if ($keranjang = $this->cart->contents()) {
                    foreach ($keranjang as $item) {
                        $grandTotal = $grandTotal + $item['subtotal'];
                    }
                    echo "<h5>Total belanja anda adalah : Rp. " . number_format($grandTotal, 0, ',', '.');

                ?>
            </div><br><br>

            <h3>Input Untuk Alamat pengiriman</h3>
            <form action="<?= base_url('home/pembayaran_pesanan'); ?>" method="POST">
                <div class="form-group">
                    <label for="nama penerima">Nama Penerima</label>
                    <input type="text" class="form-control" id="namaPenerima" name="nama_penerima">
                    <?= form_error('nama_penerima', '<small class="text-danger">', '  </small>'); ?>
                </div>
                <div class="form-group">
                    <label for="Alamatpenerima">Alamat Penerima</label>
                    <input style="height : 100px ;" type="textarea" class="form-control" id="Alamatpenerima" name="alamat_penerima">
                    <?= form_error('alamat_penerima', '<small class="text-danger">', '  </small>'); ?>
                </div>
                <div class="form-group">
                    <label for="NoTelepon">No. Telepon</label>
                    <input type="number" class="form-control" id="No Telepon" name="no_telepon">
                    <?= form_error('no_telepon', '<small class="text-danger">', '  </small>'); ?>
                </div>

                <div class="form-group">
                    <label for="jasaPengirim">Jasa Pengiriman</label>
                    <select class="form-control" name="jasa_pengiriman" id="jasaPengirim">
                        <option value="JNE">JNE</option>
                        <option value="SHOPE EXPRESS">SHOPE EXPRESS</option>
                        <option value="JD.ID">JD.ID</option>
                        <option value="GRAB">GRAB</option>
                    </select>
                    <?= form_error('jasa_pengiriman', '<small class="text-danger">', '  </small>'); ?>
                </div>
                <div class="form-group">
                    <label for="mbayar">Metode Pembayaran</label>
                    <select class="form-control" name="metode_pembayaran" id="mbayar">
                        <option value="BNI -XXXX">BNI -XXXX</option>
                        <option value="BRI -XXXX ">BRI -XXXX </option>
                        <option value="MANDIRI -XXXX">MANDIRI -XXXX</option>
                        <option value="BCA -XXXX">BCA -XXXX</option>
                        <option value="COD(BAYAR DITEMPAT)">COD(BAYAR DITEMPAT)</option>
                    </select>
                    <?= form_error('metode_pembayaran', '<small class="text-danger">', '  </small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">PESAN SEKARANG</button>
                <a href="<?= base_url('home/detail_keranjang') ?>" class="btn btn-success">KEMBALI</a>
            </form>
        <?php   } else {
                    echo '<h4>Anda belum memesan barang';
                }
        ?>
        </div>
    </div>
</div>