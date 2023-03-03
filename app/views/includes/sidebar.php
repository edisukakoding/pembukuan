<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="assets/images/faces/face1.jpg" alt="profile">
                    <span class="login-status online"></span> -->
        <!--change to offline or busy as needed-->
        <!-- </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">Wahyu Hartanto</span>
                    <span class="text-secondary text-small">Direktur Utama</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL . 'dashboard'; ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL . 'product'; ?>">
                <span class="menu-title">Produk</span>
                <i class="mdi mdi-tag menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL . 'customer'; ?>">
                <span class="menu-title">Pelanggan</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASE_URL . 'transaction'; ?>">
                <span class="menu-title">Transaksi</span>
                <i class="mdi mdi-book-open-page-variant menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false"
                aria-controls="general-pages">
                <span class="menu-title">Laporan</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-check menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="<?= BASE_URL . 'report/penjualan/' . date('m') . '/' . date('Y'); ?>">
                            Penjualan </a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>