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
                    Laporan Penjualan
                </h3>
            </div>
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class=" title-export mb-3">Laporan Penjualan Bulan <?= Helper::string_month($month); ?> Tahun
                                <?= $year; ?></h3>
                            <form action="<?= BASE_URL . 'report/penjualan'; ?>" class="form-inline" method="POST"
                                id="report-transaction">
                                <select name="bulan" id="bulan" class="form-control form-control-sm">
                                    <?php for ($bulan = 1; $bulan <= 12; $bulan++) : ?>
                                    <option value="<?= $bulan; ?>" <?= $bulan == $month ? 'selected' : ''; ?>>
                                        <?= $bulan; ?>
                                    </option>
                                    <?php endfor; ?>
                                </select>&nbsp;&nbsp;
                                <select name="tahun" id="tahun" class="form-control form-control-sm">
                                    <?php for ($tahun = date('Y') - 1; $tahun <= date('Y') + 5; $tahun++) : ?>
                                    <option value="<?= $tahun; ?>" <?= $tahun == $year ? 'selected' : ''; ?>>
                                        <?= $tahun; ?>
                                    </option>
                                    <?php endfor; ?>
                                </select>&nbsp;&nbsp;
                                <button type="submit" class="btn btn-primary">Lihat</button>
                            </form>

                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="data" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($transactions as $transaction) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= date('d F Y', strtotime($transaction['created_at'])); ?></td>
                                        <td><?= $transaction['firstname'] . ' ' . $transaction['lastname']; ?></td>
                                        <td><?= $transaction['name']; ?></td>
                                        <td><?= $transaction['qty']; ?></td>
                                        <td>
                                            <?= ($transaction['is_moons'] == 1)
                                                    ? 'Lunas'
                                                    : 'Piutang';
                                                ?>
                                        </td>
                                        <td><?= Helper::rupiah($transaction['grand_total_price']); ?></td>
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