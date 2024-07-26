<div class="container">
    <h5>Keranjang belanja</h5>

    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">NO</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">JUMLAH</th>
                <th scope="col">HARGA</th>
                <th scope="col">SUB-TOTAL</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($this->cart->contents() as $items) : ?>
                <tr class="text-center">
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $items['name']; ?></td>
                    <td><?= $items['qty']; ?></td>
                    <td>Rp.<?= number_format($items['price'], 0, ',', '.'); ?></td>
                    <td>Rp.<?= number_format($items['subtotal'], 0, ',', '.'); ?></td>
                    <td><a href="<?= base_url('home/hapus_items/') . $items['rowid']; ?>">HAPUS ITEM</a></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
            <tr>
                <td class="align-right">Total Harga : Rp. <?= number_format($this->cart->total(), 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
    <div>
        <a href="<?= base_url('home/hapus_keranjang'); ?>" class="btn btn-danger">HAPUS KERANJANG</a>
        <a href="<?= base_url('home/index'); ?>" class="btn btn-primary">LANJUTKAN BELANJA</a>
        <a href="<?= base_url('home/pembayaran'); ?>" class="btn btn-success">LANJUTKAN PEMBAYARAN</a>
    </div>
</div>