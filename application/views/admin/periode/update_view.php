
      <!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Ubah <?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Home</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url($title) ?>"><?= $title ?></a></div>
                <div class="breadcrumb-item">Ubah <?= $title ?></div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Ubah <?= $title ?></h2>
            <p class="section-lead">Ubah data <?= $title ?></p>

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('Periode/update/'.$periode->id_periode) ?>" method="post">
                      <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" name="semester" id="semester">
                          <option value="<?= $periode->semester; ?>"><?= $periode->semester; ?></option>
                          <option disabled></option>
                          <option value="I (satu)">I (satu)</option>
                          <option value="II (dua)">II (dua)</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <select class="form-control" name="tahun_ajaran" id="tahun_ajaran" required>
                          <option value="<?= $periode->tahun_ajaran ?>">T.A <?= $periode->tahun_ajaran ?></option>
                          <option disabled></option>
                          <?php 
                            $tahun = date('Y');
                            $tahunStart = $tahun - 3;
                            $tahunEnd = $tahunStart+1;
                            for ($i=0; $i < 5; $i++) { 
                              # code...
                              $tahunStart += 1;
                              $tahunEnd += 1;
                              echo '<option value="'.$tahunStart.'/'.$tahunEnd.'">T.A '.$tahunStart.'/'.$tahunEnd.'</option>';
                            }  
                          ?>
                        </select>
                      </div>
                      <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Perubahan">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>