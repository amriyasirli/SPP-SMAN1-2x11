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
                    <form action="<?= base_url('Transaksi/add_action/') ?>" method="post">
                      <div class="form-group">
                        <label for="id_barang">Nama Barang</label>
                        <select class="form-control" name="id_barang" id="id_barang" required>
                          <option value="" class="text-secondary">- Pilih -</option>
                          <?php foreach ($barang as $row) : ?> 
                            <option value="<?= $row->id_barang; ?>"><?= $row->nama_barang; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="debit">Debit</label>
                        <input type="text" name="debit" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="kredit">Kredit</label>
                        <input type="text" name="kredit" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="id_customer">Nama Pelanggan</label>
                        <select class="form-control" name="id_customer" id="id_customer" required>
                          <option value="" class="text-secondary">- Pilih -</option>
                          <?php foreach ($customer as $row) : ?> 
                            <option value="<?= $row->id_customer; ?>"><?= $row->nama; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
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