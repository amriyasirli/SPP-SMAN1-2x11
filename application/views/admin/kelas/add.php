<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tambah <?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Home</a></div>
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
                    <form action="<?= base_url('Kelas/add_action/') ?>" method="post">
                      <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" class="form-control">
                      </div>
                      <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>