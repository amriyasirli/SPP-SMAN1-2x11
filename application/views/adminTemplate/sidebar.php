<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <img src="<?= base_url('assets/') ?>/img/logo-1.png" alt="logo" width="210" class="bg-white rounded shadow-light p-1 mb-5 mt-2">
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('Dashboard/') ?>">
              <img src="<?= base_url('assets/') ?>/img/logo.png" alt="logo" width="60" class="bg-white rounded shadow-light p-1 mb-5 mt-2">
            </a>
          </div>
          <ul class="sidebar-menu">

            <?php 
              $role = $this->session->userdata('role');
            ?>
              
              <?php if($role == 1): ?>
                <li class="menu-header">Administrator</li>
                <li><a class="nav-link" href="<?= base_url('Dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                <li><a class="nav-link beep beep-sidebar" href="<?= base_url('Pembayaran') ?>"><i class="fas fa-coins"></i> <span>Pembayaran</span></a></li>
                <li><a class="nav-link" href="<?= base_url('Laporan') ?>"><i class="far fa-file-pdf"></i> <span>Download PDF</span></a></li>
                <!-- <li><a class="nav-link" href="<?= base_url('Grafik') ?>"><i class="fas fa-chart-line"></i> <span>Grafik</span></a></li> -->
                <li class="nav-item dropdown">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i><span>Master Data</span></a>
                  <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('Siswa') ?>"><i class="far fa-square"></i> <span>Siswa</span></a></li>
                    <li><a class="nav-link" href="<?= base_url('Guru') ?>"><i class="far fa-square"></i> <span>Guru</span></a></li>
                    <li><a class="nav-link" href="<?= base_url('Kelas') ?>"><i class="far fa-square"></i> <span>Kelas</span></a></li>
                    <li><a class="nav-link" href="<?= base_url('Periode') ?>"><i class="far fa-square"></i> <span>Periode</span></a></li>
                  </ul>
                </li>
                
              <?php else: ?>
                <li class="menu-header">Guru Pengelola</li>
                <li><a class="nav-link" href="<?= base_url('Dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
                <li><a class="nav-link beep beep-sidebar" href="<?= base_url('Pembayaran') ?>"><i class="fas fa-coins"></i> <span>Pembayaran</span></a></li>
                <li><a class="nav-link" href="<?= base_url('Laporan') ?>"><i class="far fa-file-pdf"></i> <span>Download PDF</span></a></li>
                <li><a class="nav-link" href="<?= base_url('Siswa') ?>"><i class="far fa-user"></i> <span>Data Siswa</span></a></li>
              <?php endif; ?>
              <br>
              <br>
              <li><a class="nav-link text-danger" href="<?= base_url('Auth/logout') ?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
            </ul>
        </aside>
      </div>