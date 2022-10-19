<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tambah <?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= base_url('Admin') ?>">Home</a></div>
              <div class="breadcrumb-item"><a href="<?= base_url($title) ?>"><?= $title ?></a></div>
              <div class="breadcrumb-item">Tambah <?= $title ?></div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Tambah <?= $title ?></h2>
            <p class="section-lead">Tambah data <?= $title ?></p>

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <?= form_open_multipart('Siswa/add_action/') ?>
                      <div class="form-group">
                        <label>Nis/Nisn</label>
                        <input type="text" name="id_siswa" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select class="form-control" name="id_kelas" id="id_kelas">
                          <option>- Pilih - </option>
                          <?php
                            $kelas = $this->db->order_by('nama_kelas', 'ASC')->get('tbl_kelas')->result();
                            foreach ($kelas as $row) :
                          ?>
                            
                            <option value="<?= $row->id_kelas?>"><?= $row->nama_kelas?></option>
                            
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                          <option>- Pilih -</option>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control">
                      </div>
                      <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                    <?= form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>