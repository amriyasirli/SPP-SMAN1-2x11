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
                    <form action="<?= base_url('Transaksi/update/'.$transaksi->id_transaksi) ?>" method="post">
                      <div class="form-group">
                        <label for="id_barang">Nama Barang</label>
                        <select class="form-control" name="id_barang" id="id_barang" required>
                          <option value="<?= $transaksi->id_barang; ?>"><?= $transaksi->nama_barang; ?></option>
                          <?php foreach ($barang as $row) : ?> 
                            <option value="<?= $row->id_barang; ?>"><?= $row->nama_barang; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" value="<?= $transaksi->jumlah; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" name="satuan" value="<?= $transaksi->satuan; ?>" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="debit">Debit</label>
                        <input type="text" name="debit" value="<?= $transaksi->debit; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="kredit">Kredit</label>
                        <input type="text" name="kredit" value="<?= $transaksi->kredit; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" name="total" value="<?= $transaksi->total; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" value="<?= $transaksi->tanggal; ?>" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="id_customer">Nama Pelanggan</label>
                        <select class="form-control" name="id_customer" id="id_customer" required>
                          <option value="<?= $transaksi->id_customer; ?>" class="text-secondary"><?= $transaksi->nama; ?></option>
                          <?php foreach ($customer as $row) : ?> 
                            <option value="<?= $row->id_customer; ?>"><?= $row->nama; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" value="<?= $transaksi->keterangan; ?>" class="form-control">
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