<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Home</a></div>
              <div class="breadcrumb-item"><a href="<?= base_url($title) ?>"><?= $title ?></a></div>
              <div class="breadcrumb-item">List Data <?= $title ?></div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title"> <?= $title ?> SPP</h2>
            <p class="section-lead">Ketikan NIS/NISN untuk mencari nama siswa</p>

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    

                  </div>
                  <div class="card-body">
                    <!-- <form action="#" method="post"> -->
                    <div class="row">

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="id_siswa">NISN/NIS</label>
                            <!-- <input type="text" name="id_siswa" id="id_siswa"> -->
                            <input type="number" class="form-control" name="id_siswa" id="id_siswa">
                            <small id="helpId" class="form-text text-success">Ketikan NISN/NIS</small>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" readonly>
                            <small id="helpId" class="form-text text-danger">Otomatis terisi*</small>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="id_kelas">Kelas</label>
                            <input type="text" class="form-control" name="id_kelas" id="id_kelas" readonly>
                            <small id="helpId" class="form-text text-danger">Otomatis terisi*</small>
                          </div>
                        </div>
                        <!-- <div class="col-md-3 text-center">
                          <img src="<?= base_url('assets/img/illustration/download.png') ?>" class="img-fluid"  alt="">
                        </div> -->
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <button id="btnNext" class="btn btn-secondary disabled"> Selanjutnya <i class="fas fa-arrow-right"></i></button>
                        </div>
                      </div>
                      <div class="alert alert-light alert-has-icon d-none mt-3" id="notfound">
                        <div class="alert-icon text-danger"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                          <div class="alert-title">Not found !</div>
                          Data tidak ditemukan !
                        </div>
                      </div>
                    </div>
                    <!-- </form> -->
                    
                  </div>
                </div>
              </div>
            </div>




            <!-- Card Biodata Siswa -->
            <div class="row mt-sm-4 d-none" id="tampil">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header" id="profil">
                      <!-- load via Ajax -->
                    <!-- </div> -->
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name" id="nama">
                      <!-- Load Via Ajax -->
                    </div>
                    <div id="accordion">
                      <div class="accordion">
                        <div class="accordion-header bg-success" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                          <h4>Lihat Riwayat Pembayaran >></h4>
                        </div>
                        <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                          <div class="table">
                            <table class="table table-bordered table-sm">
                              <thead class="bg-secondary">
                                <tr>
                                  <th class="text-dark text-center">Bulan</th>
                                  <th class="text-dark text-center">Nominal</th>
                                  <!-- <th class="text-dark">Aksi</th> -->
                                </tr>
                              </thead>
                              <tbody id="table">
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <!-- <div class="card-footer text-center">
                    <div class="font-weight-bold mb-2">Follow Ujang On</div>
                    <a href="#" class="btn btn-icon">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-icon">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-icon">
                      <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="btn btn-icon">
                      <i class="fab fa-instagram"></i>
                    </a>
                  </div> -->
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Form Pembayaran</h4>
                    </div>
                    <div class="card-body">
                      <!-- <form action="" method="post"> -->
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label for="bulan">Pembayaran Bulan</label>
                                <select class="form-control" name="bulan" id="bulan">
                                  <option>- Pilih -</option>
                                  <?php foreach ($arrayBulan as $key => $value) : ?>
                                    
                                    <option value="<?= $value; ?>"><?= $value ;?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label for="jumlah">Nominal (Rp)</label>
                              <input type="text"
                                class="form-control form-control" style="border: solid #6f42c1 2px; height: 80px; font-size: 24px" name="jumlah" id="jumlah"  aria-describedby="helpId" placeholder="Masukan Nominal...">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="keterangan">Tulis Keterangan</label>
                              <textarea name="keterangan" placeholder="Ketik Keterangan" id="keterangan" class="form-control summernote-simple"></textarea>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div>
                    <div class="alert alert-danger alert-dismissible" id="cancel" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div>
                    <div class="card-footer text-left">
                      <button class="btn btn-danger">Cancel</button>
                      <button type="submit" id="btnInsert" class="btn btn-primary">Bayar</button>
                    </div>
                  <!-- </form> -->
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <datalist id="data_siswa">
          <?php
            foreach ($record->result() as $b) {
                echo "<option value='$b->id_siswa'>$b->nama_siswa</option>";
            } 
          ?>
      </datalist>

      