<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Ubah Data Kota</h2>
            <form action="/kota/update/<?= $kota['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="provinsi" value="<?= $kota['provinsi']; ?>">
                <input type="hidden" name="iconLama" value="<?= $kota['icon']; ?>">
                <div class="row mb-3">
                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('kota')) ?
                                                                    'is-invalid' : ''; ?>" id="kota" name="kota" autofocus value="<?= (old('kota')) ?
                                                                                                                                        old('kota') : $kota['kota'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kota'); ?>.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= (old('provinsi')) ?
                                                                                                            old('provinsi') : $kota['provinsi'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sejarah" class="col-sm-2 col-form-label">Sejarah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sejarah" name="sejarah" value="<?= (old('sejarah')) ?
                                                                                                        old('sejarah') : $kota['sejarah'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-2"><img src="/img/<?= $kota['icon']; ?>" class="img-thumbnail img-preview"></div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('icon')) ?
                                                                            'is-invalid' : ''; ?>" id="icon" name="icon" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('icon'); ?>.
                            </div>
                            <label class="custom-file-label" for="icon"><?= $kota['icon']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>