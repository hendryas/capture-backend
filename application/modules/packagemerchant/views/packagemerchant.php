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
                  <h1>Package Merchant</h1>
                  <span>Halaman Package Merchant menyediakan berbagai fitur untuk mengelola data Package Merchant</span>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Table Package Merchant</h5>
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
                    <a href="<?= base_url('PackageMerchant/addpage'); ?>" class="btn btn-primary mb-4">Tambah</a>
                    <div class="example-container">
                      <div class="example-content">
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th scope="col">No.</th>
                              <th scope="col">Logo Merchant</th>
                              <th scope="col">Nama Merchant</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php $no = 1; ?>
                            <?php foreach ($data_merchant as $merchant) : ?>
                              <tr>
                                <th scope="row"><?= $no; ?>.</th>
                                <td>
                                  <input type="hidden" id="id_merchant" name="id_merchant" value="<?= $merchant['id_merchant']; ?>">
                                  <img id="preview_logo" src="<?= base_url('assets/images/logo/' . $merchant['logo']) ?>" width="200">
                                </td>
                                <td><?= $merchant['nama_merchant'] ?></td>
                                <td class="text-center">
                                  <!-- <button type="button" class="btn btn-sm btn-info btn-burger" data-bs-toggle="modal" data-bs-target="#modalLihat</?php echo $merchant['id_merchant']; ?>"><i class="material-icons">visibility</i></button> -->
                                  <button type="button" class="btn btn-sm btn-info btn-burger" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $merchant['id_merchant']; ?>"><i class="material-icons">visibility</i></button>
                                  <button type="button" name="btnHapusData" class="btn btn-sm btn-danger btn-burger"><i class="material-icons">delete_outline</i></button>
                                </td>
                              </tr>
                              <?php $no++; ?>
                            <?php endforeach; ?>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>


  <!-- Add Modal -->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Form Add Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row mt-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" name="gender" id="gender" aria-label="Default select example">
              <option value="1">Laki-Laki</option>
              <option value="2">Perempuan</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" name="btnSubmit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Modal -->
  <?php
  foreach ($data_merchant as $merchant) :  ?>
    <div class="modal fade" id="modalEdit<?= $merchant['id_merchant'] ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLabel">Form Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('packagemerchant/edit_data'); ?>" method="post" id="myForm">
              <div class="row">
                <label for="nama_merchant" class="form-label">Nama Merchant</label>
                <input type="hidden" name="id_merchant" id="id_merchant" value="<?= $merchant['id_merchant'] ?>">
                <input type="text" class="form-control" name="nama_merchant" id="nama_merchant" value="<?= $merchant['nama_merchant'] ?>" required>
              </div>
              <div class="row mt-3">
                <label for="nama_service" class="form-label">Service</label>
                <ul class="list-group">
                  <li class="list-group-item active" aria-current="true">List Services</li>
                  <?php
                  $id_merchant = $merchant['id_merchant'];
                  $data_service = $this->db->get_where('packagemerchant', ['id_merchant => ' . $id_merchant, 'delete_sts' => 0])->result_array();
                  ?>
                  <?php foreach ($data_service as $service) : ?>
                    <li class="list-group-item"><?php echo $service['nama_service'] ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>


  <script>
    $("button[name='btnHapusData']").click(function(e) {
      e.preventDefault();
      let id_merchant = $(this).closest("tr").find("#id_merchant").val();

      let formData = new FormData();
      formData.append("id_merchant", id_merchant);

      Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin Menghapus Data Ini!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#19A87E",
        cancelButtonColor: "#ff3d60",
        confirmButtonText: "Ya, Lanjutkan!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "packagemerchant/delete_data/packagemerchant.php",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: () => {
              $.LoadingOverlay("show");
            },
            complete: () => {
              $.LoadingOverlay("hide");
            },
            success: (response) => {
              let obj = JSON.parse(response);
              if (obj.status == "OK") {
                Swal.fire("Sukses!", obj.message, "success").then(() => {
                  window.location.reload();
                });
              } else {
                Swal.fire("Oops!", obj.message, "error");
              }
            },
          });
        }
      });
    });
  </script>