<?= $this->extend('Layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/Kota/create" class="btn btn-primary mt-3">Tambah Data Kota</a>
            <h1 class="mt-2">Daftar Kota Di Indonesia</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($kota as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $k['icon']; ?>" alt="" class="icon"></td>
                            <td><?= $k['kota']; ?></td>
                            <td>
                                <a href="/kota/<?= $k['provinsi']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>