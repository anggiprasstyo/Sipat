<!-- <div class="jumbotron jumbotron-fluid bg-light"> -->
<div class="container">
    <?= $this->session->flashdata('message'); ?>
</div>
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-light text-center">
            Ruang Rapat
        </div>
        <div class="row no-gutters">
            <?php foreach ($ruangRapat as $ruangan) : ?>

                <div class="col-sm-6">
                    <div class="card-body">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/noruangan/') . $ruangan['foto']; ?>" class="card-img" alt="<?= $ruangan['nama_ruangan']; ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $ruangan['nama_ruangan']; ?></h5>
                                        <p class="card-text">Silahkan melihat jadwal terlebih dahulu, sebelum meminjam ruangan.</p>
                                        <?php if ($ruangan['id_ruangan'] == 1) : ?>
                                            <div class="alert alert-warning" role="alert">
                                                <b>Batas Maksimum Peserta : 10 orang</b>
                                            </div>
                                        <?php elseif ($ruangan['id_ruangan'] == 2) : ?>
                                            <div class="alert alert-warning" role="alert">
                                                <b>Batas Maksimum Peserta : 20 orang</b>
                                            </div>
                                        <?php elseif ($ruangan['id_ruangan'] == 3) : ?>
                                            <div class="alert alert-warning" role="alert">
                                                <b>Batas Maksimum Peserta : 50 orang</b>
                                            </div>
                                        <?php endif; ?>

                                        <a href="<?= base_url('ruangan/jadwalRapat/') . $ruangan['id_ruangan']; ?>" class="btn btn-primary mr-4 mt-2"><i class="far fa-calendar-alt"></i> Jadwal</a>
                                        <a href="<?= base_url('ruangan/peminjaman/') . $ruangan['id_ruangan']; ?>" class="btn btn-success mt-2"><i class="fas fa-pen"></i> Pinjam</a>
                                        <?php if ($user['role_id'] == 1) : ?>
                                            <a href="<?= base_url('ruangan/dataJadwalPinjam/') . $ruangan['id_ruangan']; ?>" class="btn btn-secondary mt-2"><i class="far fa-calendar-check"></i> Data Jadwal Pinjam</a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php endforeach; ?>
            <!-- <div class="col-sm-6">
                <div class="card-body">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="<?= base_url('assets/img/noruangan/A26.jpg'); ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Ruang Rapat A.26</h5>
                                    <p class="card-text">Silahkan melihat jadwal terlebih dahulu, sebelum meminjam ruangan.</p>
                                    <a href="<?= base_url('ruangan/jadwalRapat'); ?>" class="btn btn-primary mr-4"><i class="far fa-eye"></i> Jadwal</a>
                                    <a href="<?= base_url('ruangan/peminjaman'); ?>" class="btn btn-success"><i class="fas fa-pen"></i> Pinjam</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

    </div>
</div>
<!-- </div> -->