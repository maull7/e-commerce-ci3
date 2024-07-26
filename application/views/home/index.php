<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block" src="<?= base_url('assets/img/') ?>masak.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block" src="<?= base_url('assets/img/') ?>baju.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block" src="<?= base_url('assets/img/') ?>background_elektronik.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($barang as $brg) : ?>
            <div class="col-lg-3 col-md-3 col-xs-3 mt-4">
                <div class="card shadow text-center">
                    <img class="card-img" src="<?= base_url('assets/img/') . $brg['gambar']; ?>" alt="Card image cap" class="width : 200px ; height : 200px ;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $brg['nama_barang'] ?></h5>
                        <p class="card-text"><?= $brg['keterangan']; ?></p>
                        <div class="row d-flex mb-2">
                            <div class="col-lg-12 justify-content-center">
                                <a href="<?= base_url('home/detail_produk/') . $brg['id']; ?>" class="btn btn-warning">DETAIL</a>
                                <button class="btn btn-primary">Rp.<?= number_format($brg['harga'], 0, ',', '.'); ?></button>
                            </div>
                        </div>
                        <a href="<?= base_url('home/tambah_keranjang/') . $brg['id']; ?>" class="btn btn-success">Tambah Keranjang</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



</div>