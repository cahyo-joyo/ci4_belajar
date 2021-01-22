<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Kota</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $kota['icon']; ?>" class="card-img" alt=" ...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $kota['kota']; ?></h5>
                            <p class="card-text"><b>Sejarah : </b><?= $kota['sejarah']; ?></p>
                            <p class="card-text"><b>Provinsi : </b><?= $kota['provinsi']; ?></p>

                            <a href="/kota/edit/<?= $kota['provinsi']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/kota/<?= $kota['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?')">Delete</button>
                            </form>
                            <br><br>
                            <a href="/kota">Kembali ke Daftar Kota</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>