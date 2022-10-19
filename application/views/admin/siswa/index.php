<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="<?= base_url('Admin') ?>">Home</a></div>
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
                  <?php if ($this->session->userdata('role') == 1) : ?>
                    <div class="card-header">
                      <a href="<?= base_url('Siswa/add')?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>   
                    </div>
                  <?php endif; ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-md" id="myTable">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nis/Nisn</th>
                            <th>Nama siswa</th>
                            <th>Kelas</th>
                            <th>Foto</th>
                            <?php if ($this->session->userdata('role') == 1) : ?>
                              <th>Action</th>
                            <?php endif; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              $no = 1;
                              foreach ($siswa as $row) :
                                // $kelas = $this->db->get_where('nama_kelas', ['id_kelas'=>$row->id_kelas])->row();
                          ?> 
                              <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $row->id_siswa; ?></td>
                              <td><?= $row->nama_siswa; ?></td>
                              <td><?= $row->nama_kelas; ?></td>
                              <td><img src="<?= base_url('./assets/img/'.$row->foto)?>" class="img-fluid rounded" width="80" alt=""></td>
                              <?php if ($this->session->userdata('role') == 1) : ?>
                                <td>
                                    <a href="<?= base_url('Siswa/update_view/'.$row->id_siswa)?>" class="btn btn-info btn-sm">Update</a>
                                    <a href="<?= base_url('Siswa/delete/'.$row->id_siswa)?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                              <?php endif; ?>
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