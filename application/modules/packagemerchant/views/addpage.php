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
                  <h1>Add Package Merchant</h1>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Form Add Package Merchant</h5>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <div class="col-md-4"></div>
                  </div>

                  <form action="<?= base_url('packagemerchant/add') ?>" method="post">
                    <div class="card-body">
                      <p class="card-description"></p>
                      <!-- <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah</button> -->

                      <div class="row">
                        <div class="col-md-12">
                          <label for="nama_merchant" class="form-label">Nama Merchant</label>
                          <select class="form-select" aria-label="Default select example" name="nama_merchant">
                            <option value="">-- All --</option>
                            <?php foreach ($data_merchant as $merchant) : ?>
                              <option value="<?= $merchant['id_merchant'] ?>"><?= $merchant['nama_merchant'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="row mt-3">
                        <div class="col-md-12">
                          <label for="nama_service" class="form-label">Nama Service</label>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="nama_service[]" id="inlineCheckbox1" value="Pre Wedding">
                                <label class="form-check-label" for="inlineCheckbox1">Pre Wedding</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="nama_service[]" id="inlineCheckbox1" value="Wedding">
                                <label class="form-check-label" for="inlineCheckbox1">Wedding</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="nama_service[]" id="inlineCheckbox1" value="Studio">
                                <label class="form-check-label" for="inlineCheckbox1">Studio</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="nama_service[]" id="inlineCheckbox1" value="Videography">
                                <label class="form-check-label" for="inlineCheckbox1">Videography</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="nama_service[]" id="inlineCheckbox1" value="Book and Soft Copy">
                                <label class="form-check-label" for="inlineCheckbox1">Book and Soft Copy</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mt-3">
                        <label for="harga_paket_service" class="form-label">Harga Paket Service</label>
                        <input type="number" name="harga_paket_service" id="harga_paket_service" class="form-control" required>
                      </div>

                    </div>
                    <div class="card-footer">
                      <a href="<?= base_url('packagemerchant') ?>" class="btn btn-secondary">Kembali</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>