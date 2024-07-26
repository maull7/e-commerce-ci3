<div class="container">
    <!-- Button trigger modal -->
    <div class="row">
        <div class="col-6">
            <?= $this->session->flashdata('messege'); ?>
        </div>
    </div>

    <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#exampleModal">
        <i class="bi bi-plus-square mr-2"></i>Tambah Data
    </button>


    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">id</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">kategori</th>
                        <th scope="col">harga</th>
                        <th scope="col">stok</th>
                        <th scope="col">aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($barang as $brg) : ?>
                        <tr class="text-center">
                            <th scope="row"><?= $brg['id']; ?></th>
                            <td><?= $brg['nama_barang']; ?></td>
                            <td><?= $brg['keterangan']; ?></td>
                            <td><?= $brg['kategori']; ?></td>
                            <td><?= $brg['harga']; ?></td>
                            <td><?= $brg['stok']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/hapus/') . $brg['id']; ?>"><i class="mr-2 text-danger bi bi-trash3-fill"></i></a>
                                <a href="<?= base_url('admin/edit/') . $brg['id']; ?>"><i class="text-warning bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukan Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('admin/tambah'); ?>
                <div class="form-group">
                    <label for="namaBarang">NAMA BARANG</label>
                    <input type="text" class="form-control" id="namaBarang" placeholder="masukan nama barang" name="nama_barang">
                    <small class="text-danger"> <?= form_error('nama_barang'); ?></small>

                </div>
                <div class="form-group">
                    <label for="ketBarang">KETERANGAN BARANG</label>
                    <input type="text" class="form-control" id="ketBarang" placeholder="masukan keterangan barang" name="keterangan">
                    <small class="text-danger"> <?= form_error('keterangan'); ?></small>
                </div>
                <div class="form-group">
                    <label for="katBarang">KATEGORI BARANG</label>
                    <select class="form-control" name="kategori" id="jasaPengirim">
                        <option value="elektronik">elektronik</option>
                        <option value="pakaian">pakaian</option>
                        <option value="peralatan dapur">peralatan dapur</option>
                        <option value="peralatan masak">peralatan masak</option>
                    </select>
                    <small class="text-danger"> <?= form_error('kategori'); ?></small>
                </div>
                <div class="form-group">
                    <label for="harga">HARGA BARANG</label>
                    <input type="number" class="form-control" id="harga" placeholder="masukan harga barang" name="harga">
                    <small class="text-danger"> <?= form_error('harga'); ?></small>
                </div>
                <div class="form-group">
                    <label for="harga">STOK BARANG</label>
                    <input type="number" class="form-control" id="harga" placeholder="masukan jumlah stok barang" name="stok">
                    <small class="text-danger"> <?= form_error('harga'); ?></small>
                </div>
                <div class="input-group">

                    <input type="file" name="gambar">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>