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
                            <h4 class="card-title">Tambah Data Customer</h4>
                            <?= Helper::flash_message('flash'); ?>
                            <form class="forms-sample" action="<?= BASE_URL . 'customer/simpan'; ?>" method="POST">
                                <div class="form-group">
                                    <label for="firstname">Nama Depan</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Nama Depan">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Nama Belakang</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Nama Belakang">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">Pilih Gender...</option>
                                        <?php $genders = ['Laki - laki', 'Perempuan']; ?>
                                        <?php foreach($genders as $gender) : ?>
                                        <option value="<?= $gender; ?>"><?= $gender; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone">HP</label>
                                    <input type="text" class="form-control" required id="phone" name="phone"
                                        placeholder="Nomor HP">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" required id="email" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" cols="30" rows="10"
                                        class="form-control"></textarea>
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="is_member" name="is_member"
                                            value="1">
                                        Member <i class="input-helper"></i></label>
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