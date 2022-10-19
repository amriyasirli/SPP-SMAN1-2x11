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
            <h2 class="section-title">List Data <?= $title ?></h2>
            <!-- <p class="section-lead">List jumlah <?= $title ?></p> -->

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <a href="<?= base_url('Transaksi/add')?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-md" id="myTable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Jumlah</th>
                          <th>Satuan</th>
                          <th>Debit</th>
                          <th>Kredit</th>
                          <th>Total</th>
                          <th>Customer</th>
                          <th>Keterangan</th>
                          <th>Tanggal</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $no = 1;
                            foreach ($transaksi as $row) :
                        ?> 
                            <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->nama_barang; ?></td>
                            <td><?= $row->jumlah ?></td>
                            <td><?= $row->satuan ?></td>
                            <td><?= $row->debit; ?></td>
                            <td><?= $row->kredit; ?></td>
                            <td><?= $row->total; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td><?= $row->keterangan; ?></td>
                            <td><?= $row->tanggal; ?></td>
                            <td>
                                <a href="<?= base_url('Transaksi/update_view/'.$row->id_transaksi)?>" class="btn btn-info btn-sm">Update</a>
                                <a href="<?= base_url('Transaksi/delete/'.$row->id_transaksi)?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                            </tr>

                        <?php endforeach; ?>
                      </tbody>

                      </table>
                    </div>
                  </div>
                  <!-- <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                      </ul>
                    </nav>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>