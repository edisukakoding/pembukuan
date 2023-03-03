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
                <h3 class="page-title title-export">Data Transaksi</h3>
            </div>
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="transaction/tambah" class="btn btn-primary btn-sm mb-3">Buat Transaksi</a>
                            <a href="transaction/setting_angsuran" class="btn btn-info btn-sm mb-3">Setting
                                Angsuran</a>
                            <?= Helper::flash_message('flash'); ?>
                            <table class="table table-hover" id="data" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Lunas</th>
                                        <th>Terbayar</th>
                                        <th>Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($transactions as $transaction) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= $transaction['firstname'] . ' ' . $transaction['lastname']; ?></td>
                                        <td><?= $transaction['name']; ?></td>
                                        <td><?= $transaction['qty']; ?></td>
                                        <td>
                                            <?= ($transaction['is_moons'] == 1)
                                                    ? '<i class="mdi mdi-check-circle text-success"></i>'
                                                    : '<i class="mdi mdi-close-circle text-danger"></i>';
                                                ?>
                                        </td>
                                        <td><?= Helper::rupiah(Helper::ambil_terbayar($transaction['id'])); ?></td>
                                        <td><?= date('d F Y', strtotime($transaction['created_at'])); ?></td>
                                        <td class="text-center">
                                            <?php if($transaction['is_moons'] != 1) : ?>
                                                <a href="<?= BASE_URL . 'transaction/piutang/' . $transaction['id']; ?>"
                                                    class="badge badge-warning">
                                                    Bayar Tagihan
                                                </a>
                                            <?php endif; ?>
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