<div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
  <div class="app-auth-background">

  </div>
  <div class="app-auth-container">
    <?php echo $this->session->flashdata('message'); ?>
    <div class="logo">
      <a href="<?= base_url(); ?>">Capture</a>
    </div>
    <!-- <p class="auth-description">Please sign-in to your account and continue to the dashboard.<br>Don't have an account? <a href="sign-up.html">Sign Up</a></p> -->

    <form action="<?= base_url('auth/login/signin') ?>" method="post">
      <div class="auth-credentials m-b-xxl">
        <label for="signInEmail" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@neptune.com">
        <small class="text-danger"><?php echo form_error('email'); ?></small>

        <label for="signInPassword" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="signInPassword" aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
        <small class="text-danger"><?php echo form_error('password'); ?></small>
      </div>

      <div class="auth-submit">
        <button type="submit" class="btn btn-primary">Sign In</button>
        <!-- <a href="#" class="auth-forgot-password float-end">Forgot password?</a> -->
      </div>
    </form>
    <!-- <div class="divider"></div> -->
    <div class="auth-alts">
      <!-- <a href="#" class="auth-alts-google"></a>
      <a href="#" class="auth-alts-facebook"></a>
      <a href="#" class="auth-alts-twitter"></a> -->
    </div>
  </div>
</div>