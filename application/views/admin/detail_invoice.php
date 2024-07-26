<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4>detail pesanan</h4>
            <?= $invoice->id; ?>

            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">id</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">jumlah</th>
                        <th scope="col">harga</th>
                        <th scope="col">total harga</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($pesanan as $psn) :
                        $subtotal = $psn->jumlah * $psn->harga;
                        $total += $subtotal;
                    ?>
                        <tr class="text-center">
                            <th scope="row"><?= $psn->id; ?></th>
                            <td><?= $psn->nama_barang; ?></td>
                            <td><?= $psn->jumlah; ?></td>
                            <td><?= number_format($psn->harga, 0, ',', '.'); ?></td>
                            <td><?= number_format($subtotal, 0, ',', '.'); ?></td>

                        </tr>
                    <?php endforeach; ?>
                    <td colspan="5" class="text-right me-2">
                        Total semua pesanan Rp. : <?= number_format($total, 0, ',', '.'); ?>
                    </td>


                </tbody>
            </table>
        </div>

    </div>
</div>