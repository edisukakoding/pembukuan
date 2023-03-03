<!-- header disini -->
<?php include('app/views/includes/header.php'); ?>
<!-- navbar disini -->
<?php include('app/views/includes/navbar.php') ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- side bar disini -->
    <?php include('app/views/includes/sidebar.php') ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title title-export">Data Barang ATK</h3>
            </div>
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="product/tambah" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
                            <?= Helper::flash_message('flash'); ?>
                            <table class="table table-hover" id="data">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Satuan</th>
                                        <th>Tipe</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($frames as $frame) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= $frame['name']; ?></td>
                                        <td><?= $frame['unit']; ?></td>
                                        <td><?= $frame['type']; ?></td>
                                        <td><?= $frame['stock']; ?></td>
                                        <td><?= Helper::rupiah($frame['price']); ?></td>
                                        <td class="text-center">
                                            <a href="<?= BASE_URL . 'product/edit/' . $frame['id']; ?>"
                                                class="badge badge-warning">Edit</a>
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
        <!-- content-wrapper ends -->
        <!-- footer disini -->
        <?php include('app/views/includes/footer.php') ?>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
<!-- scripts disini -->
<?php include('app/views/includes/scripts.php') ?>