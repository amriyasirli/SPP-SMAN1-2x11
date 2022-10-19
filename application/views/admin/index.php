
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="">Dashboard</a></div>
              <div class="breadcrumb-item"><?= $title?></div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Selamat Datang di Sistem Informasi Pembayaran SPP <img src="<?= base_url('assets/img/logo-1.png')?>" class="img-fluid rounded" width="150" alt=""></h2> 
            <!-- <p class="section-lead">Halaman ini merupakan halaman admin.</p> -->
            <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Siswa</h4>
                    </div>
                    <div class="card-body">
                      <?= $siswa; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-danger">
                    <i class="far fa-building"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Kelas</h4>
                    </div>
                    <div class="card-body">
                      <?= $kelas; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Guru Pengelola</h4>
                    </div>
                    <div class="card-body">
                      <?= $guru; ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-success">
                    <i class="far fa-calendar"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Tahun Ajaran</h4>
                    </div>
                    <div class="card-body">
                      <?= $periode->tahun_ajaran; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="card">
                  <img src="<?= base_url('assets/img/illustration/spp.png') ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text"><strong>Sistem informasi pembayaran SPP</strong> berbasis website, SMAN 1 2x11 Enam Lingkung, Kab. Padang Pariaman, Sumatera Barat .</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-9">
                <div class="card">
                  <div class="card-header">
                    <h4>Riwayat Pembayaran Bulan Ini</h4>
                  </div>
                  <div class="card-body">
                    <div class="summary">
                      <div class="summary-info">
                        <h4 id="jml">IDR <?= $jumlahTot ?></h4>
                        <div class="text-muted"><?= $bulan ?></div>
                        <!-- <div class="d-block mt-2">                              
                          <a href="#">View All</a>
                        </div> -->
                      </div>
                      <div class="summary-item">
                        <h6>Item List <span class="text-muted">(<?= $totalBulan->num_rows() ?> items)</span></h6>
                        <ul class="list-unstyled list-unstyled-border">
                          <?php
                            $hari = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
                            foreach ($totalBulan->result() as $row) : ?>
                          <li class="media">
                            <a href="#">
                              <!-- <img class="mr-3 rounded" width="50" src="<?= base_url() ?>assets/img/products/product-1-50.png" alt="product"> -->
                            </a>
                            <div class="media-body">
                              <div class="media-right"><?= $row->jumlah ?></div>
                              <div class="media-title"><span href="#"><?= $row->nama_siswa ?></span></div>
                              <!-- <div class="text-muted text-small">Tanggal <a href="#"><?= $row->tanggal_pembayaran ?></a> <div class="bullet"></div> </div> -->
                              <small id="helpId" class="form-text text-muted">Tanggal <?= $row->tanggal_pembayaran ?></small>
                            </div>
                          </li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Grafik Pembayaran</h4>
                    </div>
                    <div class="card-body">
                      <div>
                        <canvas id="myChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </section>
      </div>
      
      <!-- Modal -->
      <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Atur timer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <form class="form-inline" action="<?= base_url('Admin/timer') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                      <input type="number" name="timer" value="" class="form-control" placeholder="Masukan angka timer" aria-describedby="helpId">
                      <small id="helpId" class="text-danger">Angka akan berhitung mundur untuk mengganti halaman display informasi secara otomatis. 1 Menit (60)</small>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
              </form>
          </div>
        </div>
      </div>


      <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->


      <script>
        const labels = [
          'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember',
        ];

        const data = {
          labels: labels,
          datasets: [{
            label: 'Total Pembayaran',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?= $dataChart ?>,
          }]
        };

        const config = {
          type: 'line',
          data: data,
          options: {}
        };
      </script>


      <script>
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
      </script>


