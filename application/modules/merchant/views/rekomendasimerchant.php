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
                  <h1>Rekomendasi Merchant</h1>
                  <span>Buatlah rekomendasi merchant disini.</span>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Table Merchant</h5>
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
                    <div class="example-container">
                      <div class="example-content">
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th scope="col">No.</th>
                              <th scope="col">Logo</th>
                              <th scope="col">Nama Merchant</th>
                              <th scope="col">Deskripsi</th>
                              <th scope="col">Status Rekomendasi</th>
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
                                <td><?= $merchant['deskripsi'] ?></td>
                                <td>
                                  <?php if ($merchant['sts_rekomendasi'] == 1) : ?>
                                    Rekomendasi
                                  <?php else : ?>
                                    Belum di Rekomendasi
                                  <?php endif; ?>
                                </td>
                                <td class="text-center">
                                  <button type="button" name="btnCheckRekomen" class="btn btn-sm btn-info btn-burger"><i class="material-icons">task_alt</i></button>
                                  <button type="button" name="btnDontRekomen" class="btn btn-sm btn-danger btn-burger"><i class="material-icons">close</i></button>
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

  <script>
    $("button[name='btnCheckRekomen']").click(function(e) {
      e.preventDefault();
      let id_merchant = $(this).closest("tr").find("#id_merchant").val();

      let formData = new FormData();
      formData.append("id_merchant", id_merchant);

      Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin Merekomendasikan Merchant ini!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#19A87E",
        cancelButtonColor: "#ff3d60",
        confirmButtonText: "Ya, Lanjutkan!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "merchant/insert_rekomendasi_merchant/merchant.php",
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

  <script>
    $("button[name='btnDontRekomen']").click(function(e) {
      e.preventDefault();
      let id_merchant = $(this).closest("tr").find("#id_merchant").val();

      let formData = new FormData();
      formData.append("id_merchant", id_merchant);

      Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin Merekomendasikan Merchant ini!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#19A87E",
        cancelButtonColor: "#ff3d60",
        confirmButtonText: "Ya, Lanjutkan!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "merchant/update_dont_rekomendasi_merchant/merchant.php",
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