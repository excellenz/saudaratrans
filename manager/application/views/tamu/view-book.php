
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title; ?></li>
            </ol>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-body">
          <div class="box-header">
            <?= $this->session->flashdata('message'); ?>
            <a class="btn btn-info mb-3" href="<?= base_url('user/book') ?>">Rental Mobil</a>
          </div>
          <div class="box-body">
            <?php 
              if ($booking == NULL) : 
            ?>
            <div class="alert alert-warning" role="alert">
              Anda belum melakukan rental mobil. Silahkan klik tombol Rental Mobil untuk melakukan pemesanan.
            </div>
            <?php else : ?>
            <table class="table table-striped table-hover table-responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tanggal Rental</th>
                  <th>Nama Tamu</th>
                  <th>Layanan Rental</th>
                  <th>Tanggal penggunaan</th>
                  <th>Biaya</th>
                  <th>Status Pesanan</th>
                  <th>Rincian Pesanan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  foreach ($booking as $b) :
                ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= date('d-M-Y', $b['tgl_inv']); ?></td>
                  <td><?= $b['nama_depan'] . ' ' . $b['nama_belakang']; ?></td>
                  <td><?= $b['nomor_kamar']; ?></td>
                  <td><?= date('d-m-Y', $b['tgl_c_in']); ?></td>
                  <td><?= rupiah($b['biaya']); ?></td>
                  <td>
                    <?php if ($b['status'] == 1) : ?>
                      <span class="btn btn-xs btn-success"><i class="fas fa-check"></i></span>
                    <?php elseif ($b['status'] == 2) : ?>
                      <span class="btn btn-xs btn-warning"><i class="far fa-circle text-white"></i></span>
                    <?php else : ?>
                      <span class="btn btn-xs btn-danger"><i class="fas fa-times"></i></span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?= base_url('user/bookdetail/') . $b['id_book']; ?>" class="badge badge-info">lihat</a>
                  </td>
                </tr>
                <?php
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
