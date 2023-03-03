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
                <h3 class="page-title title-export">Data Customer</h3>
            </div>
            <div class="row">
                <!-- konten utama disini -->
                <div class="col-lg grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <a href="customer/tambah" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
                            <?= Helper::flash_message('flash'); ?>
                            <table class="table table-hover" id="data" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Depan</th>
                                        <th>Nama Belakang</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Member</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=0; foreach($customers as $customer) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= $customer['firstname']; ?></td>
                                        <td><?= $customer['lastname']; ?></td>
                                        <td><?= $customer['gender']; ?></td>
                                        <td><?= $customer['phone']; ?></td>
                                        <td><?= $customer['email']; ?></td>
                                        <td><?= $customer['address']; ?></td>
                                        <td>
                                            <?= ($customer['is_member'] == 1) 
                                            ? '<i class="mdi mdi-check-circle text-success"></i>'
                                            : '<i class="mdi mdi-close-circle text-danger"></i>'; 
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= BASE_URL . 'customer/edit/' .$customer['id']; ?>"
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
        <?php include('app/views/includes/footer.php')?>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
<!-- scripts disini -->
<?php include('app/views/includes/scripts.php')?>