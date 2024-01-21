<body>
  <div class="app align-content-stretch d-flex flex-wrap">

    <?= $this->load->view('templates/leftbar/leftbar'); ?>

    <div class="app-container">
      <div class="search">
        <form>
          <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
        </form>
        <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
      </div>

      <?= $this->load->view('templates/topbar/topbar'); ?>

      <div class="app-content">
        <div class="content-wrapper">
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <div class="page-description">
                  <h1>Detail Package Merchant</h1>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Form Detail Package Merchant</h5>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <div class="col-md-4"></div>
                  </div>

                  <div class="card-body">
                    <p class="card-description"></p>
                    <!-- <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button> -->

                    <div class="row">
                      <div class="col-md-12">
                        <label for="nama_merchant" class="form-label">Nama Merchant</label>
                        <input type="text" value="<?= $data_merchant['nama_merchant'] ?>" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-md-12">
                        <div class="row mt-3">
                          <label for="nama_service" class="form-label">Service</label>
                          <ul class="list-group">
                            <li class="list-group-item active" aria-current="true">List Services</li>
                            <?php foreach ($data_packagemerchant as $service) : ?>
                              <li class="list-group-item"><?php echo $service['nama_service'] ?></li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <label for="harga_paket_service" class="form-label">Harga Paket Service</label>
                      <input type="number" name="harga_paket_service" id="harga_paket_service" class="form-control" value="<?= $data_merchant['total_harga_package_merchant'] ?>" readonly>
                    </div>

                  </div>
                  <div class="card-footer">
                    <a href="<?= base_url('packagemerchant') ?>" class="btn btn-secondary">Kembali</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>