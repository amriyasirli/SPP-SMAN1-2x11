<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= base_url('Dashboard') ?>">Home</a></div>
              <div class="breadcrumb-item"><a href=""><?= $title ?></a></div>
              <!-- <div class="breadcrumb-item">List Data <?= $title ?></div> -->
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <p class="section-lead">Filter file berdasarkan kriteria</p>

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-3">
                        <form action="<?= base_url('Laporan/filterKelas') ?>" method="post">
                            <div class="form-group">
                              <label for="kelas">Berdasarkan kelas</label>
                              <select class="form-control" name="kelas" id="kelas" required>
                                <option value="">- Pilih Kelas -</option>
                                <?php 
                                  foreach ($kelas as $row) {
                                    # code...
                                    echo "<option value='$row->id_kelas'>$row->nama_kelas</option>";
                                  } ?>
                              </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-file-pdf"></i> Download PDF</button>
                          </form>
                        </div>
                        <div class="col-md-3">
                          <form action="<?= base_url('Laporan/filterBulan') ?>" method="post">
                            <div class="form-group">
                              <label for="bulan">Berdasarkan bulan</label>
                              <select class="form-control" name="bulan" id="bulan" required>
                                <option value="">- Pilih Bulan -</option>
                                <?php 
                                  foreach ($bulan as $key => $value) {
                                    # code...
                                    echo "<option value='$value'>$value</option>";
                                  } ?>
                              </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-file-pdf"></i> Download PDF</button>
                          </form>
                        </div>
                        
                        <div class="col-md-3 text-center mt-5">
                          <img src="<?= base_url('assets/img/illustration/download.png') ?>" class="img-fluid"  alt="">
                        </div>
                        
                          <!-- <form action="<?= base_url('Laporan/filterBulan') ?>" method="post">
                            <div class="form-group">
                              <label for="bulan">Berdasarkan Bulan</label>
                              <select class="form-control" name="bulan" id="bulan">
                                <option>- Pilih -</option>
                                <?php 
                                  for ($i=0; $i < count($bulan); $i++) {
                                    # code...
                                    echo "<option value='$bulan[$i]'>$bulan[$i]</option>";
                                  } ?>
                              </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Download</button>
                          </form> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>