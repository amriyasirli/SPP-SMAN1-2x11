<!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Ubah <?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('Admin') ?>">Home</a></div>
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
                    <form action="<?= base_url('Guru/update/'.$guru->id_guru) ?>" method="post">
                    <div class="form-group">
                        <label for="nama_guru">Nama Guru</label>
                        <input type="text" name="nama_guru" value="<?= $guru->nama_guru ?>" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="hp">Nomor HP</label>
                        <input type="text" name="hp" value="<?= $guru->hp ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" name="status" value="<?= $guru->status ?>" class="form-control">
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