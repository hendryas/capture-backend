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
                <div class="page-description page-description-tabbed">
                  <h1>Profile</h1>

                  <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="hoaccountme" aria-selected="true">Data Diri</button>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <img src="<?= base_url('assets/images/avatars/profile_1.png'); ?>" alt="" width="100">
                          </div>
                          <label for="settingsInputEmail" class="form-label mb-3"> <b><?= $data_user['nama'] ?></b> </label>
                          <p>Username : <?= $data_user['username'] ?></p>
                          <p>Email : <?= $data_user['email'] ?></p>
                          <p>No. Handphone : <?= $data_user['phone'] ?></p>
                          <p>Tanggal Lahir : <?= tgl_indo($data_user['tgl_lahir'])  ?></p>
                          <p>Status : <?= $data_user['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></p>
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
  </div>
  </div>