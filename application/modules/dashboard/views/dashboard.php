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
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="page-description">
                  <h1>Dashboard</h1>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4">
                <div class="card widget widget-stats">
                  <div class="card-body">
                    <div class="widget-stats-container d-flex">
                      <div class="widget-stats-icon widget-stats-icon-warning">
                        <i class="material-icons-outlined">people</i>
                      </div>
                      <div class="widget-stats-content flex-fill">
                        <span class="widget-stats-title">All Users</span>
                        <span class="widget-stats-amount"><?= count($data_all_users) ?></span>
                        <span class="widget-stats-info"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card widget widget-stats">
                  <div class="card-body">
                    <div class="widget-stats-container d-flex">
                      <div class="widget-stats-icon widget-stats-icon-warning">
                        <i class="material-icons-outlined">storefront</i>
                      </div>
                      <div class="widget-stats-content flex-fill">
                        <span class="widget-stats-title">All Merchants</span>
                        <span class="widget-stats-amount"><?= count($data_merchant) ?></span>
                        <span class="widget-stats-info"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card widget widget-stats">
                  <div class="card-body">
                    <div class="widget-stats-container d-flex">
                      <div class="widget-stats-icon widget-stats-icon-warning">
                        <i class="material-icons-outlined">design_services</i>
                      </div>
                      <div class="widget-stats-content flex-fill">
                        <span class="widget-stats-title">All Service</span>
                        <span class="widget-stats-amount"><?= count($data_package_merchants)  ?></span>
                        <span class="widget-stats-info"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card widget widget-stats">
                  <div class="card-body">
                    <div class="widget-stats-container d-flex">
                      <div class="widget-stats-icon widget-stats-icon-warning">
                        <i class="material-icons-outlined">category</i>
                      </div>
                      <div class="widget-stats-content flex-fill">
                        <span class="widget-stats-title">All Categories</span>
                        <span class="widget-stats-amount"><?= count($data_categories) ?></span>
                        <span class="widget-stats-info"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4">
                <div class="card widget widget-list">
                  <div class="card-header">
                    <h5 class="card-title">All Users Active<span class="badge badge-success badge-style-light"><?= count($data_users_active); ?> completed</span></h5>
                  </div>
                  <div class="card-body">
                    <span class="text-muted m-b-xs d-block"> Showing <?= count($data_users_active); ?> active users from total <?= count($data_all_users); ?> users data.</span>
                    <ul class="widget-list-content list-unstyled">
                      <?php foreach ($data_users_active as $user) : ?>
                        <li class="widget-list-item widget-list-item-green">
                          <span class="widget-list-item-icon">
                            <img src="<?= base_url('assets/images/avatars/profile_1.png') ?>" alt="" width="30" class="pt-2">
                          </span>
                          <span class="widget-list-item-description">
                            <a href="#" class="widget-list-item-description-title">
                              <?= $user['nama'] ?>
                            </a>
                            <span class="widget-list-item-description-subtitle">
                              <?php if ($user['id_role'] == 1) : ?>
                                Admin
                              <?php elseif ($user['id_role'] == 2) : ?>
                                Merchant
                              <?php elseif ($user['id_role'] == 3) : ?>
                                Customer
                              <?php endif; ?>
                            </span>
                          </span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card widget widget-list">
                  <div class="card-header">
                    <h5 class="card-title">All Users Not Active<span class="badge badge-success badge-style-light"><?= count($data_users_not_active); ?> completed</span></h5>
                  </div>
                  <div class="card-body">
                    <span class="text-muted m-b-xs d-block"> Showing <?= count($data_users_not_active); ?> not active users from total <?= count($data_all_users); ?> users data.</span>
                    <ul class="widget-list-content list-unstyled">
                      <?php foreach ($data_users_not_active as $user) : ?>
                        <li class="widget-list-item widget-list-item-green">
                          <span class="widget-list-item-icon">
                            <img src="<?= base_url('assets/images/avatars/profile_1.png') ?>" alt="" width="30" class="pt-2">
                          </span>
                          <span class="widget-list-item-description">
                            <a href="#" class="widget-list-item-description-title">
                              <?= $user['nama'] ?>
                            </a>
                            <span class="widget-list-item-description-subtitle">
                              <?php if ($user['id_role'] == 1) : ?>
                                Admin
                              <?php elseif ($user['id_role'] == 2) : ?>
                                Merchant
                              <?php elseif ($user['id_role'] == 3) : ?>
                                Customer
                              <?php endif; ?>
                            </span>
                          </span>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- <div class="col-xl-4">
                <div class="card widget widget-list">
                  <div class="card-header">
                    <h5 class="card-title">All Package Merchants<span class="badge badge-success badge-style-light"><?= count($data_package_merchants); ?> completed</span></h5>
                  </div>
                  <div class="card-body">
                    <span class="text-muted m-b-xs d-block"> Showing all service from merchants</span>
                    <ul class="widget-list-content list-unstyled">
                      <?php
                      $temp_nama_merchant = '';
                      $nomor = 1;
                      ?>
                      <?php foreach ($data_package_merchants as $service_merchant) : ?>
                        <?php if ($nomor == 1) : ?>
                          <li class="widget-list-item widget-list-item-green">
                            <span class="widget-list-item-icon">
                              <img src="<?= base_url('assets/images/logo/') . $service_merchant['logo'] ?>" alt="" width="30" class="pt-2">
                            </span>
                            <span class="widget-list-item-description">
                              <a href="#" class="widget-list-item-description-title">
                                <?= $service_merchant['nama_merchant'] ?>
                              </a>
                              <span class="widget-list-item-description-subtitle">
                                service 1 <br>
                                service 2
                              </span>
                            </span>
                          </li>
                        <?php else : ?>
                          <?php if ($temp_nama_merchant == $service_merchant['nama_merchant']) : ?>
                            <li class="widget-list-item widget-list-item-green">
                              <span class="widget-list-item-icon">

                              </span>
                              <span class="widget-list-item-description">
                                <a href="#" class="widget-list-item-description-title">
                                  Nama Merchant
                                </a>
                                <span class="widget-list-item-description-subtitle">
                                  service 1 <br>
                                  service 2
                                </span>
                              </span>
                            </li>
                          <?php else : ?>
                            <li class="widget-list-item widget-list-item-green">
                              <span class="widget-list-item-icon">
                                <img src="<?= base_url('assets/images/logo/') . $service_merchant['logo'] ?>" alt="" width="30" class="pt-2">
                              </span>
                              <span class="widget-list-item-description">
                                <a href="#" class="widget-list-item-description-title">
                                  Nama Merchant
                                </a>
                                <span class="widget-list-item-description-subtitle">
                                  service 1 <br>
                                  service 2
                                </span>
                              </span>
                            </li>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php $temp_nama_merchant = $service_merchant['nama_merchant'];  ?>
                        <?php $nomor++; ?>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>