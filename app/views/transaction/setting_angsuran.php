<!-- header disini -->
<?php include('app/views/includes/header.php'); ?>
<!-- navbar disini -->
<?php include('app/views/includes/navbar.php')?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- side bar disini -->
    <?php include('app/views/includes/sidebar.php')?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Setting Angsuran
                </h3>
            </div>
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= BASE_URL . 'transaction/tambah_angsuran'; ?>"
                                class="btn btn-primary btn-sm mb-3">Tambah
                                Pengaturan</a>
                            <?= Helper::flash_message('flash'); ?>
                            <table class="table table-hover" id="data" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Maksimal</th>
                                        <th>DP</th>
                                        <th>Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=0; foreach($installments as $angsuran) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= $angsuran['max_moon'] . ' Angsuran'; ?></td>
                                        <td><?= $angsuran['dp']; ?></td>
                                        <td><?= $angsuran['persen'] . '%'; ?></td>
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
        <?php include('app/views/includes/footer.php')?>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
<!-- scripts disini -->
<?php include('app/views/includes/scripts.php')?>