<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= base_url('Admin') ?>">Home</a></div>
              <div class="breadcrumb-item"><a href="<?= base_url($title) ?>"><?= $title ?></a></div>
              <div class="breadcrumb-item">List <?= $title ?></div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">List Data <?= $title ?></h2>
            <!-- <p class="section-lead">List jumlah <?= $title ?></p> -->

            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <a href="<?= base_url('Mapel/add')?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-md" id="myTable">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Mata Pelajaran</th>
                          <th>Kelas</th>
                          <th>Guru</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $no = 1;
                            foreach ($mapel as $row) :
                        ?> 
                            <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->nama_mapel; ?></td>
                            <td><?= $row->kelas; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td>
                                <a href="<?= base_url('Mapel/update_view/'.$row->id_mapel)?>" class="btn btn-info btn-sm">Update</a>
                                <a href="<?= base_url('Mapel/delete/'.$row->id_mapel)?>" class="btn btn-danger btn-sm">Delete</a>
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