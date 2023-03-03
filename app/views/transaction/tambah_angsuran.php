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
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Setting Angsuran</h4>
                            <?= Helper::flash_message('flash'); ?>
                            <form class="forms-sample" action="<?= BASE_URL . 'transaction/simpan_angsuran'; ?>"
                                method="POST">
                                <div class="form-group">
                                    <label for="max_moon">Max Bulan</label>
                                    <input type="text" class="form-control" id="max_moon" name="max_moon"
                                        placeholder="Maksimal Angsuran" required>
                                </div>
                                <div class="form-group">
                                    <label for="dp">DP</label>
                                    <input type="text" class="form-control" id="dp" name="dp" placeholder="DP" required>
                                </div>
                                <div class="form-group">
                                    <label for="dp">Persentase</label>
                                    <input type="text" class="form-control" id="persen" name="persen"
                                        placeholder="persen" required>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Simpan</button>
                            </form>
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