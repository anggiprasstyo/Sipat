    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDataUser"><i class="fas fa-user-plus"></i> Tambah Pengguna</a>
        <h5 class="h5 text-gray-800">Total Pengguna ( <?= count($datauser); ?> )</h5>

        <div class="row">
            <div class="col-lg">

                <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('nip', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('email', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('password1', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
                <?= form_error('password2', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

                <?= $this->session->flashdata('message'); ?>

                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nama</th>
                                        <!-- <th scope="col">NIP</th> -->
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tanggal Daftar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($datauser as $du) : ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?= $i++; ?></th>
                                            <td><img src="<?= base_url('assets/img/profile/') . $du['image']; ?>" alt="<?= $du['name']; ?>" width="70px"></td>
                                            <td><?= $du['name']; ?></td>
                                            <!-- <td><?= $du['nip']; ?></td> -->
                                            <td><?= $du['email']; ?></td>
                                            <?php if ($du['is_active'] == 0) : ?>
                                                <td class="text-center">Tidak Aktif</td>
                                            <?php elseif ($du['is_active'] == 1) : ?>
                                                <td class="text-center">Aktif</td>
                                            <?php endif; ?>
                                            <td class="text-center"><?= date('d F Y', $du['date_created']); ?></td>

                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <?php if ($du['is_active'] == 0) : ?>
                                                        <a class="btn btn-warning" href="<?= base_url('admin/aktifkanUser/') . $du['id']; ?>"><i class="fas fa-check-circle"></i> Aktifkan</a>
                                                    <?php elseif ($du['is_active'] == 1) : ?>
                                                        <a class="btn btn-warning" href="<?= base_url('admin/nonAktifkanUser/') . $du['id']; ?>"><i class="fas fa-times-circle"></i> Nonaktif</a>
                                                    <?php endif; ?>

                                                    <a class="btn btn-danger" href="<?= base_url('admin/deleteUser/') . $du['id']; ?>" onclick="return confirm('Anda yakin menghapus data ini?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                                                </div>
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

    <!-- model -->
    <div class="modal fade" id="newDataUser" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRoleModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form action="<?= base_url('admin/dataUser'); ?>" method="post"> -->
                <?php echo form_open_multipart('admin/dataUser'); ?>
                <div class="modal-body">
                    <div class="form-group row mt-2">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" autocomplete="off">
                        </div>
                    </div>
                    <!-- <div class="form-group row mt-2">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip" placeholder="Masukkan NIP" name="nip" autocomplete="off">
                        </div>
                    </div> -->
                    <div class="form-group row mt-2">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" placeholder="Masukkan E-mail" name="email" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="password1" class="col-sm-3 col-form-label">Kata Sandi</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password1" placeholder="Masukkan Kata Sandi" name="password1" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label for="password2" class="col-sm-3 col-form-label">Konfirmasi</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password2" placeholder="Konfirmasi Kata Sandi" name="password2" autocomplete="off">
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="customFile" class="col-sm-3 col-form-label">Foto</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file">
                                <label class="custom-file-label" for="customFile">Masukkan Foto</label>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>