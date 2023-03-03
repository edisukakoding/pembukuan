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
                <h3 class="page-title">
                    Piutang <?= $transaction['firstname'] . ' ' . $transaction['lastname']; ?>
                </h3>
            </div>
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="<?= BASE_URL . 'transaction'; ?>" class="btn btn-primary btn-sm mb-3">Kembali</a>
                            <?= Helper::flash_message('flash'); ?>
                            <table class="table table-hover" id="data" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Angsuran ke</th>
                                        <th>Jumlah</th>
                                        <th class="text-center">Dibayar</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    $terbayar = 0;
                                    foreach ($details as $piutang) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= $piutang['installments']; ?></td>
                                        <td><?= Helper::rupiah($piutang['nominal']); ?></td>
                                        <td class="text-center">
                                            <?= ($piutang['is_paid'] == 1)
                                                    ? '<i class="mdi mdi-check-circle text-success"></i>'
                                                    : '<i class="mdi mdi-close-circle text-danger"></i>';
                                                ?>
                                        </td>
                                        <td class="text-center">
                                            <?= isset($piutang['created_at']) ? date('d F Y', strtotime($piutang['created_at'])) : '-' ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($piutang['is_paid'] != 1) : ?>
                                            <a href="<?= BASE_URL . 'transaction/dibayar/' . $piutang['transaction_id'] . '/' . $piutang['id']; ?>"
                                                class="badge badge-info">Bayar</a>
                                            <?php else : ?>
                                            <a href="#" class="badge badge-secondary">Bayar</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php
                                        if ($piutang['is_paid'] == 1) {
                                            $terbayar = $terbayar + $piutang['nominal'];
                                        }

                                        ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <th colspan="5" class="text-right">Terbayar</th>
                                        <th><?= Helper::rupiah($terbayar); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Kurang</th>
                                        <th><?= Helper::rupiah($transaction['grand_total_price'] - $terbayar); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">DP</th>
                                        <th><?= Helper::rupiah($transaction['dp']); ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">Grand Total</th>
                                        <th><?= Helper::rupiah($transaction['grand_total_price'] - $transaction['dp']); ?>
                                        </th>
                                    </tr>
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