<div class="app-header">
  <nav class="navbar navbar-light navbar-expand-lg">
    <div class="container-fluid">
      <div class="navbar-nav" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
          </li>
        </ul>

      </div>
      <div class="d-flex">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link toggle-search" href="#"><i class="material-icons">search</i></a>
          </li>
          <li class="nav-item hidden-on-mobile">
            <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown"><img src="<?= base_url('assets/images/avatars/profile_1.png'); ?>" alt=""></a>
            <ul class="dropdown-menu dropdown-menu-end language-dropdown" aria-labelledby="languageDropDown">
              <li><a class="dropdown-item" href="<?= base_url('ProfileAdmin') ?>"><img src="<?= base_url('assets/images/avatars/profile_1.png'); ?>" alt="">Profile</a></li>
              <li><a class="dropdown-item logout" href="#"><img src="<?= base_url('assets/images/avatars/logout.jpg'); ?>" alt="">Logout</a></li>
            </ul>
          </li>
          <!-- <li class="nav-item hidden-on-mobile">
            <a class="nav-link nav-notifications-toggle" id="notificationsDropDown" href="#" data-bs-toggle="dropdown">4</a>
            <div class="dropdown-menu dropdown-menu-end notifications-dropdown" aria-labelledby="notificationsDropDown">
              <h6 class="dropdown-header">Notifications</h6>
              <div class="notifications-dropdown-list">
                <a href="#">
                  <div class="notifications-dropdown-item">
                    <div class="notifications-dropdown-item-image">
                      <span class="notifications-badge bg-info text-white">
                        <i class="material-icons-outlined">campaign</i>
                      </span>
                    </div>
                    <div class="notifications-dropdown-item-text">
                      <p class="bold-notifications-text">Donec tempus nisi sed erat vestibulum, eu suscipit ex laoreet</p>
                      <small>19:00</small>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="notifications-dropdown-item">
                    <div class="notifications-dropdown-item-image">
                      <span class="notifications-badge bg-danger text-white">
                        <i class="material-icons-outlined">bolt</i>
                      </span>
                    </div>
                    <div class="notifications-dropdown-item-text">
                      <p class="bold-notifications-text">Quisque ligula dui, tincidunt nec pharetra eu, fringilla quis mauris</p>
                      <small>18:00</small>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="notifications-dropdown-item">
                    <div class="notifications-dropdown-item-image">
                      <span class="notifications-badge bg-success text-white">
                        <i class="material-icons-outlined">alternate_email</i>
                      </span>
                    </div>
                    <div class="notifications-dropdown-item-text">
                      <p>Nulla id libero mattis justo euismod congue in et metus</p>
                      <small>yesterday</small>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="notifications-dropdown-item">
                    <div class="notifications-dropdown-item-image">
                      <span class="notifications-badge">
                        <img src="<?= base_url('assets/images/avatars/avatar.png') ?>" alt="">
                      </span>
                    </div>
                    <div class="notifications-dropdown-item-text">
                      <p>Praesent sodales lobortis velit ac pellentesque</p>
                      <small>yesterday</small>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="notifications-dropdown-item">
                    <div class="notifications-dropdown-item-image">
                      <span class="notifications-badge">
                        <img src="<?= base_url('assets/images/avatars/avatar.png') ?>" alt="">
                      </span>
                    </div>
                    <div class="notifications-dropdown-item-text">
                      <p>Praesent lacinia ante eget tristique mattis. Nam sollicitudin velit sit amet auctor porta</p>
                      <small>yesterday</small>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>
</div>