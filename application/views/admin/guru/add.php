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
                    <?= form_open_multipart('Guru/add_action/') ?>
                      <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                        <small id="helpId" class="form-text text-danger"><?= form_error('username') ?></small>
                      </div>
                      <div class="form-group">
                          <label for="password1">Password</label>
                        <input type="password" name="password1" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="password2">Ulangi Password</label>
                        <input type="password" name="password2" class="form-control">
                        <small id="helpId" class="form-text text-muted"><?= form_error('password2') ?></small>
                      </div>
                      <div class="form-group">
                          <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control">
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