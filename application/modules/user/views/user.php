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
                  <h1>Users</h1>
                  <span>Halaman Management User menyediakan berbagai fitur untuk mengelola data user</span>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Table Users</h5>
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
                              <th scope="col">Nama</th>
                              <th scope="col">Tgl. Lahir</th>
                              <th scope="col">Username</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>Mark</td>
                              <td>Otto</td>
                              <td>@mdo</td>
                              <td>Mark</td>
                              <td>Otto</td>
                              <td>@mdo</td>
                              <td>@mdo</td>
                            </tr>
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
          </div>
          <div class="row mt-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" required>
          </div>
          <div class="row mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="row mt-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" oninput="validateInput(this)" required>
          </div>
          <div class="row mt-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="text" class="form-control flatpickr1" name="tgl_lahir" id="tgl_lahir" required>
          </div>
          <div class="row mt-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" name="gender" id="gender" aria-label="Default select example">
              <option value="1">Laki-Laki</option>
              <option value="2">Perempuan</option>
            </select>
          </div>
          <div class="row mt-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" id="role" aria-label="Default select example">
              <option value="2">Merchant</option>
              <option value="3">Customer</option>
            </select>
          </div>
          <div class="row mt-3">
            <label for="is_active" class="form-label">User Aktif</label>
            <select class="form-select" name="is_active" id="is_active" aria-label="Default select example">
              <option value="1">Aktif</option>
              <option value="2">Tidak Aktif</option>
            </select>
          </div>
          <div class="row mt-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" id="password" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" name="btnSubmit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>

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
      let nama = $("input[name=nama]").val().trim();
      let username = $("input[name=username]").val().trim();
      let email = $("input[name=email]").val().trim();
      let phone = $("input[name=phone]").val().trim();
      let tgl_lahir = $("input[name=tgl_lahir]").val().trim();
      let gender = $("select[name=gender]").val();
      let role = $("select[name=role]").val();
      let is_active = $("select[name=is_active]").val();
      let password = $("input[name=password]").val().trim();
      console.log(nama);
      console.log(username);
      console.log(email);
      console.log(phone);
      console.log(tgl_lahir);
      console.log(gender);
      console.log(role);
      console.log(is_active);
      console.log(password);
      // console.log(title);
      // console.log(icon);

      let formData = new FormData();
      formData.append("nama", nama);
      formData.append("username", username);
      formData.append("email", email);
      formData.append("phone", phone);
      formData.append("tgl_lahir", tgl_lahir);
      formData.append("gender", gender);
      formData.append("role", role);
      formData.append("is_active", is_active);
      formData.append("password", password);

      if (nama == undefined || nama == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom nama tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (username == undefined || username == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom username tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (email == undefined || email == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom icon tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (phone == undefined || phone == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom phone tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (tgl_lahir == undefined || tgl_lahir == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom tgl_lahir tidak boleh kosong!",
          icon: "question",
          confirmButtonColor: "#5664d2",
        });
      } else if (email == undefined || email == "") {
        Swal.fire({
          title: "Inputan Kosong!",
          text: "Kolom icon tidak boleh kosong!",
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
              url: "menulevel1/insert_data/menulevel1.php",
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