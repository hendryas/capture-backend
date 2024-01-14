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
                        <i class="material-icons-outlined">person</i>
                      </div>
                      <div class="widget-stats-content flex-fill">
                        <span class="widget-stats-title">Active Users</span>
                        <span class="widget-stats-amount">23,491</span>
                        <span class="widget-stats-info">790 unique this month</span>
                      </div>
                      <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                        <i class="material-icons">keyboard_arrow_up</i> 12%
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
                        <i class="material-icons-outlined">photo_camera</i>
                      </div>
                      <div class="widget-stats-content flex-fill">
                        <span class="widget-stats-title">All Service</span>
                        <span class="widget-stats-amount">23,491</span>
                        <span class="widget-stats-info">790 unique this month</span>
                      </div>
                      <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                        <i class="material-icons">keyboard_arrow_up</i> 12%
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
                    <h5 class="card-title">All Users<span class="badge badge-success badge-style-light">14 completed</span></h5>
                  </div>
                  <div class="card-body">
                    <span class="text-muted m-b-xs d-block">showing 5 out of 23 active tasks.</span>
                    <ul class="widget-list-content list-unstyled">
                      <li class="widget-list-item widget-list-item-green">
                        <span class="widget-list-item-icon"><i class="material-icons-outlined">article</i></span>
                        <span class="widget-list-item-description">
                          <a href="#" class="widget-list-item-description-title">
                            Dashboard UI optimisations
                          </a>
                          <span class="widget-list-item-description-subtitle">
                            Oskar Hudson
                          </span>
                        </span>
                      </li>
                      <li class="widget-list-item widget-list-item-blue">
                        <span class="widget-list-item-icon"><i class="material-icons-outlined">verified_user</i></span>
                        <span class="widget-list-item-description">
                          <a href="#" class="widget-list-item-description-title">
                            Mailbox cleanup
                          </a>
                          <span class="widget-list-item-description-subtitle">
                            Woodrow Hawkins
                          </span>
                        </span>
                      </li>
                      <li class="widget-list-item widget-list-item-purple">
                        <span class="widget-list-item-icon"><i class="material-icons-outlined">watch_later</i></span>
                        <span class="widget-list-item-description">
                          <a href="#" class="widget-list-item-description-title">
                            Header scroll bugfix
                          </a>
                          <span class="widget-list-item-description-subtitle">
                            Sky Meyers
                          </span>
                        </span>
                      </li>
                      <li class="widget-list-item widget-list-item-yellow">
                        <span class="widget-list-item-icon"><i class="material-icons-outlined">extension</i></span>
                        <span class="widget-list-item-description">
                          <a href="#" class="widget-list-item-description-title">
                            Localization for file manager
                          </a>
                          <span class="widget-list-item-description-subtitle">
                            Oskar Hudson
                          </span>
                        </span>
                      </li>
                      <li class="widget-list-item widget-list-item-red">
                        <span class="widget-list-item-icon"><i class="material-icons-outlined">invert_colors</i></span>
                        <span class="widget-list-item-description">
                          <a href="#" class="widget-list-item-description-title">
                            New E-commerce UX/UI design
                          </a>
                          <span class="widget-list-item-description-subtitle">
                            Oskar Hudson
                          </span>
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>