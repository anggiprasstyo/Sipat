    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Pembatalan Jadwal <?= $ruangan['nama_ruangan']; ?></h1>

        <div class="row">
            <div class="col-lg">


                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Nama Kegiatan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Waktu Mulai</th>
                                        <th scope="col">Waktu Selesai</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Tanggal Boking</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($dataPeminjaman as $d) : ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?= $i++; ?></th>
                                            <td><?= $d['unit']; ?></td>
                                            <td><?= $d['nama_kegiatan']; ?></td>
                                            <td><?= date('d F Y', strtotime($d['tanggal'])); ?></td>
                                            <td><?= date('H:i', strtotime($d['waktu_mulai'])); ?></td>
                                            <td><?= date('H:i', strtotime($d['waktu_selesai'])); ?></td>
                                            <td><?= $d['file']; ?></td>
                                            <td><?= date('d F Y H:i:s', strtotime($d['tgl_boking'])); ?></td>
                                            <td>
                                                <a class="btn btn-danger" href="<?= base_url('ruangan/batalkanJadwal/') . $d['id_pinjam']; ?>" onclick="return confirm('Anda yakin ingin membatalkan?');"><i class="fas fa-times-circle"></i> Batalkan</a>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->