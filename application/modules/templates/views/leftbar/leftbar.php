<div class="app-sidebar">
  <div class="logo">
    <a href="index.html" class="logo-icon"><span class="logo-text">CAPTURE</span></a>
    <div class="sidebar-user-switcher user-activity-online">
      <a href="#">
        <img src="<?= base_url('assets/images/avatars/avatar.png') ?>">
        <span class="activity-indicator"></span>
        <span class="user-info-text">Chloe<br><span class="user-state-info">On a call</span></span>
      </a>
    </div>
  </div>
  <div class="app-menu">
    <ul class="accordion-menu">
      <li class="sidebar-title">
        Apps
      </li>
      <li class="active-page">
        <a href="<?= base_url('dashboard') ?>" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
      </li>

      <li>
        <a href=""><i class="material-icons-two-tone">star</i>Management<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
        <ul class="sub-menu">
          <li>
            <a href="<?= base_url('user') ?>">User</a>
          </li>
          <li>
            <a href="<?= base_url('merchant') ?>">Merchant</a>
          </li>
          <li>
            <a href="<?= base_url('packagemerchant') ?>">Package Merchant</a>
          </li>
          <li>
            <a href="<?= base_url('category') ?>">Kategori</a>
          </li>
          <li>
            <a href="<?= base_url('merchant/rekomendasi_merchant') ?>">Rekomendasi Merchant</a>
          </li>
          <li>
            <a href="#">History Pembayaran Customer</a>
          </li>
          <li>
            <a href="#">Authentication<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
            <ul class="sub-menu">
              <li>
                <a href="sign-in.html">Sign In</a>
              </li>
              <li>
                <a href="sign-up.html">Sign Up</a>
              </li>
              <li>
                <a href="lock-screen.html">Lock Screen</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="error.html">Error</a>
          </li>
        </ul>
      </li>


    </ul>
  </div>
</div>