    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">


            <!-- Role -->
            <?php foreach ($ruangRapat as $ruang) : ?>
                <?php
                $jmlData = $this->db->get_where('pinjam_ruang_rapat', ['id_ruangan' => $ruang['id_ruangan']])->result_array();
                ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1"><?= $ruang['nama_ruangan']; ?></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Peminjam : <?= count($jmlData); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="far fa-calendar-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->