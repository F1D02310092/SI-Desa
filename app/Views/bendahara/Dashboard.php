<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= $title ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <link rel="stylesheet" href="<?= base_url('assets/css/bendaharaDashboard.css') ?>">
</head>

<body>
   <div class="sekretaris-wrapper">
      <!-- Sidebar -->
      <div class="sidebar" id="sidebar">
         <div class="sidebar-header">
            <h4>SID</h4>
            <p>Bendahara Desa</p>
         </div>
         <ul class="sidebar-menu">
            <li class="active"><a href="<?= base_url('bendahara/dashboard') ?>"><i class="fas fa-tachometer-alt"></i> <span class="menu-text">Dashboard</span></a></li>
            <li><a href="<?= base_url('bendahara/keuangan') ?>"><i class="fas fa-wallet"></i> <span class="menu-text">Data Keuangan</span></a></li>
            <li><a href="<?= base_url('bendahara/transaksi') ?>"><i class="fas fa-money-check-alt"></i> <span class="menu-text">Transaksi</span></a></li>
            <li><a href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> <span class="menu-text">Logout</span></a></li>
         </ul>
      </div>

      <!-- Main Content -->
      <div class="main-content" id="main-content">
         <!-- Header -->
         <header class="header">
            <div class="toggle-sidebar" id="toggle-sidebar">
               <i class="fas fa-bars"></i>
            </div>
            <h5 class="mb-0">Dashboard Bendahara</h5>
            <div class="user-info">
               <span><?= session('nama_lengkap') ?></span>
               <i class="fas fa-user-circle"></i>
            </div>
         </header>

         <!-- Content -->
         <div class="container-fluid p-4">
            <!-- Quick Stats -->
            <div class="row">
               <div class="col-md-4">
                  <div class="card bg-success text-white mb-4">
                     <div class="card-body">
                        <h5 class="card-title">Total Pemasukan</h5>
                        <h2>Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></h2>
                     </div>
                     <div class="card-footer d-flex justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url('bendahara/keuangan') ?>">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card bg-danger text-white mb-4">
                     <div class="card-body">
                        <h5 class="card-title">Total Pengeluaran</h5>
                        <h2>Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></h2>
                     </div>
                     <div class="card-footer d-flex justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url('bendahara/keuangan') ?>">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card bg-primary text-white mb-4">
                     <div class="card-body">
                        <h5 class="card-title">Saldo Akhir</h5>
                        <h2>Rp <?= number_format($saldo_akhir, 0, ',', '.') ?></h2>
                     </div>
                     <div class="card-footer d-flex justify-content-between">
                        <a class="small text-white stretched-link" href="<?= base_url('bendahara/keuangan') ?>">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Transaksi Terbaru -->
            <div class="card mb-4">
               <div class="card-header">
                  <h5>Transaksi Terbaru</h5>
               </div>
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Keterangan</th>
                              <th>Jenis</th>
                              <th>Jumlah</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $no = 1; ?>
                           <?php foreach ($transaksi_terbaru as $trx) : ?>
                              <tr>
                                 <td><?= $no++ ?></td>
                                 <td><?= date('d-m-Y', strtotime($trx['tanggal'])) ?></td>
                                 <td><?= esc($trx['keterangan']) ?></td>
                                 <td>
                                    <span class="badge bg-<?= $trx['jenis'] === 'pemasukan' ? 'success' : 'danger' ?>">
                                       <?= ucfirst($trx['jenis']) ?>
                                    </span>
                                 </td>
                                 <td>Rp <?= number_format($trx['jumlah'], 0, ',', '.') ?></td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script>
      // Sidebar toggle
      const toggleSidebar = () => {
         const sidebar = document.getElementById('sidebar');
         const content = document.getElementById('main-content');
         sidebar.classList.toggle('active');
         content.classList.toggle('active');
         localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('active'));
      };

      document.addEventListener('DOMContentLoaded', () => {
         const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
         const sidebar = document.getElementById('sidebar');
         const content = document.getElementById('main-content');
         if (isCollapsed && window.innerWidth >= 992) {
            sidebar.classList.add('active');
            content.classList.add('active');
         }
         document.getElementById('toggle-sidebar').addEventListener('click', toggleSidebar);
      });
   </script>
</body>

</html>
