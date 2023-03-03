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
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Buat Transaksi</h4>
                            <?= Helper::flash_message('flash'); ?>
                            <form class="forms-sample" action="<?= BASE_URL . 'transaction/simpan'; ?>" method="POST">
                                <div class="form-group">
                                    <label for="customer_id">Pelanggan</label>
                                    <select name="customer_id" id="customer_id" class="form-control" required>
                                        <option value="">Pilih Pelanggan...</option>
                                        <?php foreach ($customers as $customer) : ?>
                                        <option value="<?= $customer['id']; ?>">
                                            <?= $customer['firstname'] . ' ' . $customer['lastname']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product_id">Item</label>
                                    <select name="product_id" id="product_id" class="form-control" required>
                                        <option value="">Pilih Item...</option>
                                        <?php foreach ($products as $product) : ?>
                                        <option value="<?= $product['id']; ?>">
                                            <?= $product['name'] . ' [' . Helper::rupiah($product['price']) . ']';  ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="qty">Jumlah</label>
                                    <input type="text" class="form-control" id="qty" name="qty"
                                        placeholder="Jumlah item" required>
                                </div>

                                <div class="form-group" id="input-dp">
                                    <label for="installment_id">Angsuran</label>
                                    <select name="installment_id" id="installment_id" class="form-control" required>
                                        <option value="">Pilih Angsuran...</option>
                                        <?php foreach ($installments as $installment) : ?>
                                        <option value="<?= $installment['id']; ?>">
                                            <?= $installment['max_moon'] . ' Angsuran';  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div style="width: 30%;margin-top: 10px;" id="tabel-angsuran">

                                    </div>
                                </div>

                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="is_moons" name="is_moons"
                                            value="1" checked>
                                        Lunas? <i class="input-helper"></i></label>
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
        <?php include('app/views/includes/footer.php') ?>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
<!-- scripts disini -->
<?php include('app/views/includes/scripts.php') ?>