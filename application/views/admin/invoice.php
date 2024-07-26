<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">id</th>
                        <th scope="col">Nama pembeli</th>
                        <th scope="col">Alamat pemebeli</th>
                        <th scope="col">nomer telepon</th>
                        <th scope="col">pembayaran</th>
                        <th scope="col">pengiriman</th>
                        <th scope="col">tanggal dipesan</th>
                        <th scope="col">tanggal dibayar</th>
                        <th scope="col">aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoice as $inv) : ?>
                        <tr class="text-center">
                            <th scope="row"><?= $inv['id']; ?></th>
                            <td><?= $inv['nama_penerima']; ?></td>
                            <td><?= $inv['alamat_penerima']; ?></td>
                            <td><?= $inv['no_telepon']; ?></td>
                            <td><?= $inv['metode_pembayaran']; ?></td>
                            <td><?= $inv['jasa_pengiriman']; ?></td>
                            <td><?= $inv['tanggal_dipesan']; ?></td>
                            <td><?= $inv['batas_dibayar']; ?></td>
                            <td><a href="<?= base_url('admin/detail_invoice/') . $inv['id']; ?>" class="btn btn-primary">DETAIL</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>