<!-- header disini -->
<?php include('app/views/includes/header.php'); ?>
<!-- navbar disini -->
<?php include('app/views/includes/navbar.php'); ?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- side bar disini -->
    <?php include('app/views/includes/sidebar.php'); ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Barang</h4>
                            <?= Helper::flash_message('flash'); ?>
                            <form class="forms-sample" action="<?= BASE_URL . 'product/simpan'; ?>" method="POST">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Nama Barang">
                                </div>
                                <div class="form-group">
                                    <label for="unit">Satuan</label>
                                    <select name="unit" id="unit" class="form-control" required>
                                        <option value="">Pilih Satuan...</option>
                                        <?php $units = ['PCS', 'PACK']; ?>
                                        <?php foreach($units as $unit) : ?>
                                        <option value="<?= $unit; ?>"><?= $unit; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="type">Model / Tipe</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Pilih Model...</option>
                                        <?php $types = ['PCS', 'PACK']; ?>
                                        <?php foreach($types as $type) : ?>
                                        <option value="<?= $type; ?>"><?= $type; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock Awal</label>
                                    <input type="text" class="form-control" required id="stock" name="stock"
                                        placeholder="Stock Awal">
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="text" class="form-control" required id="price" name="price"
                                        placeholder="Harga">
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