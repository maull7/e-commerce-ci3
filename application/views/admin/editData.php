<div class="container">
    <div class="col-lg-8">
        <?php echo form_open_multipart(''); ?>
        <div class="form-group">
            <label for="namaBarang">NAMA BARANG</label>
            <input type="text" class="form-control" id="namaBarang" placeholder="masukan nama barang" name="nama_barang" value="<?= $barang['nama_barang'] ?>">
            <small class="text-danger"> <?= form_error('nama_barang'); ?></small>

        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?= $barang['id']; ?>">
            <label for="ketBarang">KETERANGAN BARANG</label>
            <input type="text" class="form-control" id="ketBarang" placeholder="masukan keterangan barang" name="keterangan" value="<?= $barang['keterangan']; ?>">
            <small class="text-danger"> <?= form_error('keterangan'); ?></small>
        </div>
        <div class="form-group">
            <label for="katBarang">KATEGORI BARANG</label>
            <input type="text" class="form-control" id="katBarang" placeholder="masukan kategori barang" name="kategori" value="<?= $barang['kategori']; ?>">
            <small class="text-danger"> <?= form_error('kategori'); ?></small>
        </div>
        <div class="form-group">
            <label for="harga">HARGA BARANG</label>
            <input type="number" class="form-control" id="harga" placeholder="masukan harga barang" name="harga" value="<?= $barang['harga']; ?>">
            <small class="text-danger"> <?= form_error('harga'); ?></small>
        </div>
        <div class="form-group">
            <label for="harga">STOK BARANG</label>
            <input type="number" class="form-control" id="harga" placeholder="masukan jumlah stok barang" name="stok" value="<?= $barang['stok']; ?>">
            <small class="text-danger"> <?= form_error('harga'); ?></small>
        </div>
        <div class="input-group">

            <input type="file" name="gambar">
            <img src="<?= base_url('assets/img/') . $barang['gambar']; ?>" style="width : 400px ; height : 400px ;">

        </div>
        <button type="submit" class="btn btn-primary">simpan</button>
        </form>
    </div>
</div>