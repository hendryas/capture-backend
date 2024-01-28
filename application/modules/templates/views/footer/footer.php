<!-- Javascripts -->
<script>
  $(".logout").click(function(e) {
    e.preventDefault();
    Swal.fire({
      title: "Apakah Anda Yakin Ingin Keluar?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#19A87E",
      cancelButtonColor: "#ff3d60",
      confirmButtonText: "Ya, Lanjutkan!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "http://localhost/capture/auth/login/logout/login.php",
          cache: false,
          contentType: false,
          processData: false,
          success: (response) => {
            let obj = JSON.parse(response);
            if (obj.status == "OK") {
              Swal.fire("Sukses!", obj.message, "success").then(() => {
                // window.location.href = "login";
                window.location.replace("http://localhost/capture/auth/login");
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
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/perfectscroll/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pace/pace.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/js/main.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/dashboard.js') ?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/flatpickr.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/datepickers.js') ?>"></script>
<script src="<?= base_url('assets/js/sweetalert2/sweetalert2.all.min.js') ?>"></script>
<!-- <script src="</?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script> -->
<script src="<?= base_url('assets/js/pages/select2.js') ?>"></script>
</body>

</html>