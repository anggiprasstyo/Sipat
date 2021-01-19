<!-- <div class="jumbotron jumbotron-fluid bg-light"> -->
<div class="container col-md-8">
    <div class="card shadow">
        <div class="card-header bg-primary text-light text-center">
            Form Peminjaman
        </div>
        <div class="row no-gutters">
            <div class="col-lg">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <?php echo form_open_multipart(''); ?>
                    <!-- <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                        <div class="col-sm-7">
                            <select class="form-control <?= form_error('unit') ? 'is-invalid' : null ?>" id="unit" name="unit">
                                <option value="">-- Pilih --</option>
                                <option value="BUK">BUK</option>
                                <option value="BAKPK">BAKPK</option>
                                <option value="Teknik Grafika">Teknik Grafika</option>
                                <option value="Desain">Desain</option>
                                <option value="Penerbitan">Penerbitan</option>
                                <option value="Pariwisata">Pariwisata</option>
                                <option value="P3M">P3M</option>
                                <option value="P4MP">P4MP</option>
                                <option value="PSDKU">PSDKU</option>
                                <option value="UPT TIK">UPT TIK</option>
                                <option value="UPT Perpustakaan">UPT Perpustakaan</option>
                                <option value="UPT Desain dan Periklanan">UPT Desain dan Periklanan</option>
                                <option value="UPT Percetakan dan Penerbitan">UPT Percetakan dan Penerbitan</option>
                            </select>
                            <?= form_error('unit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control <?= form_error('unit') ? 'is-invalid' : null ?>" id="unit" placeholder="Nama Kegiatan" name="unit" autocomplete="off" value="<?= $user['name']; ?>" readonly>
                            <?= form_error('unit', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namaKegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control <?= form_error('namaKegiatan') ? 'is-invalid' : null ?>" id="namaKegiatan" placeholder="Nama Kegiatan" name="namaKegiatan" autocomplete="off" value="<?= set_value('namaKegiatan'); ?>">
                            <?= form_error('namaKegiatan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control <?= form_error('tanggal') ? 'is-invalid' : null ?>" id="tanggal" name="tanggal" value="<?= set_value('tanggal'); ?>">
                            <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktuMulai" class="col-sm-3 col-form-label">Waktu Mulai</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control <?= form_error('waktuMulai') ? 'is-invalid' : null ?>" id="waktuMulai" name="waktuMulai" value="<?= set_value('waktuMulai'); ?>">
                            <?= form_error('waktuMulai', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktuSelesai" class="col-sm-3 col-form-label">Waktu Selesai</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control <?= form_error('waktuMulai') ? 'is-invalid' : null ?>" id="waktuSelesai" name="waktuSelesai" value="<?= set_value('waktuSelesai'); ?>">
                            <?= form_error('waktuSelesai', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customFile" class="col-sm-3 col-form-label">File</label>
                        <div class="col-sm-7">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="file">
                                <label class="custom-file-label" for="customFile">Masukkan File</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i> Simpan</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- </div> -->