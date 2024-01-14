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
                  <h1>Merchant</h1>
                  <span>Halaman Management Merchant menyediakan berbagai fitur untuk mengelola data merchant</span>
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
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah</button>
                    <div class="example-container">
                      <div class="example-content">
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th scope="col">No.</th>
                              <th scope="col">Logo</th>
                              <th scope="col">Nama Merchant</th>
                              <th scope="col">Deskripsi</th>
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
                                <td class="text-center">
                                  <button type="button" class="btn btn-sm btn-success btn-burger" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $merchant['id_merchant']; ?>"><i class="material-icons">edit</i></button>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Add Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <label for="nama_merchant" class="form-label">Nama Merchant</label>
            <input type="text" class="form-control" name="nama_merchant" id="nama_merchant" required>
          </div>
          <div class="row mb-3">
            <label for="logo" class="col-sm-2 col-form-label">Gambar Logo</label>
            <input class="form-control" type="file" accept="image/jpeg, image/png" placeholder="Input Gambar Barang" name="logo" id="logo">
          </div>
          <div class="row mt-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required></textarea>
          </div>
          <div class="row mt-3">
            <label for="link_youtube" class="form-label">Link Youtube</label>
            <input type="text" class="form-control" name="link_youtube" id="link_youtube" required>
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
            <h5 class="modal-title" id="modalEditLabel">Form Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('merchant/edit_data'); ?>" method="post" enctype="multipart/form-data" id="myForm">
              <div class="row">
                <label for="nama_merchant" class="form-label">Nama Merchant</label>
                <input type="hidden" name="id_merchant" id="id_merchant" value="<?= $merchant['id_merchant'] ?>">
                <input type="text" class="form-control" name="nama_merchant" id="nama_merchant" value="<?= $merchant['nama_merchant'] ?>" required>
              </div>
              <div class="row mt-3">
                <label for="preview" class="col-sm-2 col-form-label">Preview</label>
                <div class="col-sm-10">
                  <img id="preview_logo" src="<?= base_url('assets/images/logo/' . $merchant['logo']) ?>" width="200">
                </div>
                <label for="logo" class="col-sm-2 col-form-label mt-2">Gambar Logo</label>
                <div class="col-sm-10 mt-2">
                  <input class="form-control" type="file" accept="image/jpeg, image/png" placeholder="Input Gambar Logo" name="logo" id="logo">
                </div>
              </div>
              <div class="row mt-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required><?php echo $merchant['deskripsi']; ?></textarea>
              </div>
              <div class="row mt-3">
                <label class="col-sm-2 col-form-label">Preview Video Promosi</label>
                <div class="col-sm-10">
                  <iframe width="400" height="250" src="<?php echo $merchant['link_youtube']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <label for="link_youtube" class="col-sm-2 col-form-label mt-2">Link Youtube</label>
                <div class="col-sm-10 mt-2">
                  <input type="text" class="form-control" name="link_youtube" id="link_youtube" value="<?php echo $merchant['link_youtube']; ?>" required>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

  <script>
    function validateInput(input) {
      // Menghapus karakter selain angka
      input.value = input.value.replace(/[^0-9]/g, '');
    }

    $(".flatpickr1").flatpickr();
  </script>

  <script>
    $("button[name='btnSubmit']").click(function(e) {
      e.preventDefault();
      let nama_merchant = $("input[name=nama_merchant]").val().trim();
      let deskripsi = $("textarea[name=deskripsi]").val().trim();
      let link_youtube = $("input[name=link_youtube]").val().trim();
      let logo = $("input[name=logo]");
      let cek_gambar = logo[0].files[0];

      let formData = new FormData();
      formData.append("nama_merchant", nama_merchant);
      formData.append("deskripsi", deskripsi);
      formData.append("link_youtube", link_youtube);
      formData.append("logo", logo[0].files[0]);

      if (nama_merchant == undefined || nama_merchant == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom nama merchant tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (deskripsi == undefined || deskripsi == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom deskripsi tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (link_youtube == undefined || link_youtube == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom link youtube tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (cek_gambar == undefined || cek_gambar == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom gambar logo tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else {
        Swal.fire({
          title: "Apakah Anda Yakin?",
          text: "Ingin Menyimpan Data!",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#19A87E",
          cancelButtonColor: "#ff3d60",
          confirmButtonText: "Ya, Lanjutkan!",
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "merchant/insert_data/merchant.php",
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
      }
    });
  </script>

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
            url: "merchant/delete_data/merchant.php",
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